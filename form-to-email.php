<?php
if (!isset($_POST['Submit'])) {
  echo "error; you need to submit the form!";
  exit;
}

$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
$phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
$visitor_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
$honeypot = $_POST['honeypot'];
$timestamp = $_POST['timestamp'];
$current_time = time();

// Honeypot validation
if (!empty($honeypot)) {
  echo "error; suspicious activity detected!";
  exit;
}

// Timestamp validation
if (($current_time - $timestamp) < 5) {
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

header('Location: thank-you.html');

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
    'internet-magazine'
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