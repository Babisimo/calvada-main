<?php
require './libs/simplexlsxgen-1.4.12/src/SimpleXLSXGen.php'; // Include the SimpleXLSXGen library

if (!isset($_POST['Submit'])) {
    echo "error; you need to submit the form!";
    exit;
}

$visitor_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$name = trim(strip_tags($_POST['name']));
$phone = trim(strip_tags($_POST['phone']));
$message = trim(strip_tags($_POST['message']));

$honeypot = $_POST['honeypot'];
$timestamp = (int) $_POST['timestamp']; // Cast timestamp to integer
$current_time = time();

// Honeypot validation
if (!empty($honeypot)) {
    echo "error; suspicious activity detected!";
    exit;
}

// Timestamp validation
if (($current_time - $timestamp) < 5) {  // Now, this will work correctly
    echo "error; form submitted too quickly!";
    exit;
}

// Validate required fields
if (trim($name) == '' || trim($phone) == '' || trim($message) == '' || trim($visitor_email) == '') {
    echo "all fields are mandatory";
    exit;
}

// Validate email
if (IsInjected($visitor_email)) {
    echo "Bad email value!";
    exit;
}

// Check for spam keywords
if (containsSpamKeywords($message)) {
    echo "error; spam content detected!";
    exit;
}

// Check for URLs in the message
if (containsUrl($message)) {
    echo "error; no links allowed in the message!";
    exit;
}

// Validate email format
if (!filter_var($visitor_email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format!";
    exit;
}

// Verify reCAPTCHA
$recaptcha_secret = '6LcCNgEqAAAAAFYg3iOojgGJolOmVodtfT95swu2';
$recaptcha_response = $_POST['g-recaptcha-response'];

$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptcha_secret&response=$recaptcha_response");
$response_keys = json_decode($response, true);

if (intval($response_keys["success"]) !== 1) {
    echo 'Please complete the reCAPTCHA.';
    exit;
}

$email_from = 'noreply@calvada.com';
$email_subject = "Email From Calvada.com";
$email_body = "Name: $name\n" .
    "Phone: $phone\n" .
    "E-mail: $visitor_email\n" .
    "Message: $message\n";

$to = "adupont.jr@calvada.com,gfong@calvada.com,rgonzalez@calvada.com,ogonzalez@calvada.com";
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $visitor_email \r\n";

mail($to, $email_subject, $email_body, $headers);

// Save to XLSX
// $file_path = 'contact_submissions.xlsx';

// if (file_exists($file_path)) {
//     $xlsx = \Shuchkin\SimpleXLSXGen::fromFile($file_path);
//     $sheet_data = $xlsx->rows();
//     $sheet_data[] = [$name, $phone, $visitor_email, $message, date("Y-m-d H:i:s", $current_time)];
//     $xlsx = \Shuchkin\SimpleXLSXGen::fromArray($sheet_data);
// } else {
//     $xlsx = new \Shuchkin\SimpleXLSXGen();
//     $xlsx->addSheet([['Name', 'Phone', 'Email', 'Message', 'Timestamp'], [$name, $phone, $visitor_email, $message, date("Y-m-d H:i:s", $current_time)]], 'Sheet1');
// }

// $xlsx->saveAs($file_path);


header('Location: /thank-you.html');

// Function to validate against any email injection attempts
function IsInjected($str)
{
    $injections = array(
        '(\n+)',
        '(\r+)',
        '(\t+)',
        '(%0A+)',
        '(%0D+)',
        '(%08+)',
        '(%09+)'
    );
    $inject = join('|', $injections);
    $inject = "/$inject/i";
    if (preg_match($inject, $str)) {
        return true;
    } else {
        return false;
    }
}

// Function to check for spam keywords
function containsSpamKeywords($message)
{
    $spam_keywords = array(
        'купить',
        'кокаин',
        'мефедрон',
        'Москва',
        'химмед',
        'casino',
        'gambling',
        'roulette',
        'plumber',
        'сантехника',
        'seo',
        'plumber in san jose',
        'cyclopropanecarboxylic acid',
        'diphenyl disulfide',
        '4-chlorobenzoylacetonitrile',
        '7-chloro-5-methyl 1,2,4 triazolo 4,3-c pyrimidine',
        'methyl',
        'internet-magazine',
        'отилор',
        'цена',
        'ташкент',
        'Ты',
        'жизни',
        'Симферополе',
        'жителей',
        'Министр',
        'и',
        'DodikErwansyah.com'
    );

    foreach ($spam_keywords as $keyword) {
        if (stripos($message, $keyword) !== false) {
            return true;
        }
    }
    return false;
}

// Function to check for URLs in the message
function containsUrl($message)
{
    // Regular expression to match URLs
    $url_pattern = '/\b(?:https?:\/\/|www\.)\S+\b/i';

    if (preg_match($url_pattern, $message)) {
        return true;
    }
    return false;
}
?>