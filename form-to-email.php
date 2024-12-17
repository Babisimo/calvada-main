<?php
require './libs/vendor/autoload.php'; // Composer autoloader (for PHPMailer installed via Composer)

date_default_timezone_set('America/Los_Angeles');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!isset($_POST['Submit'])) {
    echo "error; you need to submit the form!";
    exit;
}

// Capture the reCAPTCHA response from the form
$recaptcha_secret = '6Le4_WkqAAAAAJMr8X82D1GjfC4mZHb172XEpNIh'; // Use the secret key from reCAPTCHA admin console
$recaptcha_response = $_POST['g-recaptcha-response'];

// Verify the reCAPTCHA response
$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptcha_secret&response=$recaptcha_response");
$response_keys = json_decode($response, true);

// Check if the reCAPTCHA is valid and the score is above a certain threshold (0.5 is a common threshold)
if (!$response_keys['success'] || $response_keys['score'] < 0.5) {
    echo "Error: reCAPTCHA verification failed. Please try again.";
    exit;
}

$visitor_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$name = trim(strip_tags($_POST['name']));
$phone = trim(strip_tags($_POST['phone']));
$service = trim(strip_tags($_POST['service'])); // New field from dropdown
$message = trim(strip_tags($_POST['message']));

$honeypot = $_POST['honeypot'];
$timestamp = (int) $_POST['timestamp'];
$current_time = time();

// Phone validation: Adjust as needed; currently checks for + and 10-15 digits
if (!preg_match('/^\+?[0-9]{10,15}$/', $phone)) {
    echo "Invalid phone number!";
    exit;
}

// Honeypot check
if (!empty($honeypot)) {
    echo "error; suspicious activity detected!";
    exit;
}

// Timing check to prevent quick spam
if (($current_time - $timestamp) < 5) {
    echo "error; form submitted too quickly!";
    exit;
}

// Check all required fields
if (trim($name) == '' || trim($phone) == '' || trim($message) == '' || trim($visitor_email) == '' || trim($service) == '') {
    echo "All fields are mandatory";
    exit;
}

// Email format and injection checks
if (IsInjected($visitor_email)) {
    echo "Invalid email value!";
    exit;
}

if (!filter_var($visitor_email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format!";
    exit;
}

// Spam checks
if (containsSpamKeywords($message)) {
    echo "error; spam content detected!";
    exit;
}

if (containsUrl($message)) {
    echo "error; no links allowed in the message!";
    exit;
}

// Database connection and data insertion
$servername = "localhost";
$username = "contact_form_db";
$password = "MariContact_US@DB2023";
$dbname = "contact_form_db";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Insert with `service` field included
$stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, service, message) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $visitor_email, $phone, $service, $message);

if (!$stmt->execute()) {
    echo "Error: " . $stmt->error;
} else {
    echo "Record successfully saved.";
}

$stmt->close();
$conn->close();

// Email body with Service included
$email_body = "Name: $name\n" .
    "Phone: $phone\n" .
    "E-mail: $visitor_email\n" .
    "Service: $service\n" .
    "Message: $message\n";

// Send email using Gmail SMTP via PHPMailer
$mail = new PHPMailer(true);  // Create a new PHPMailer instance

try {
    // SMTP server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'admindb@calvada.com';           // Gmail account
    $mail->Password = 'ckye dyfj rvlu nyyn';           // Gmail App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;                                 // TCP port for STARTTLS

    // Email settings
    $mail->setFrom('noreply@calvada.com', 'Calvada Surveying');   // Sender address and name
    $mail->addAddress('gfong@calvada.com');                        
    $mail->addAddress('glenn@calvada.com');
    $mail->addAddress('rgonzalez@calvada.com');
    $mail->addAddress('adupont.jr@calvada.com');
    $mail->addAddress('ogonzalez@calvada.com');

    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Email From Calvada.com';            // Email subject
    $mail->Body = nl2br($email_body);                     // Email body, convert newlines to <br>
    $mail->AltBody = $email_body;                         // Plain text alternative for non-HTML mail clients

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

header('Location: /thank-you.html');

// Email validation function
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

// Spam keyword function
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
        'DodikErwansyah.com',
        'seo',
        'cheap',
        'free',
        'offer',
        'loan',
        'bitcoin',
        'cryptocurrency',
        'pharmacy',
        'discount',
        'weight loss',
        'adult',
        'cbd',
        'webcam',
        'escort',
        'dating',
        'price',
        'lowest price',
        'Tedbap',
        'price',
        'prezo',
        'árát'
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
    $url_pattern = '/\b(?:https?:\/\/|www\.)\S+\b/i';
    if (preg_match($url_pattern, $message)) {
        return true;
    }
    return false;
}
