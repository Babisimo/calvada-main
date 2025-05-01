<?php
require 'vendor/autoload.php'; // Load SendGrid SDK

use SendGrid\Mail\Mail;

// Set timezone
date_default_timezone_set('America/Los_Angeles');

// Enable error reporting (only for debugging, remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if form was submitted
if (!isset($_POST['Submit'])) {
    echo "error; you need to submit the form!";
    exit;
}

// Capture the reCAPTCHA response
$recaptcha_secret = '6Le4_WkqAAAAAJMr8X82D1GjfC4mZHb172XEpNIh';
$recaptcha_response = $_POST['g-recaptcha-response'];

// Verify reCAPTCHA
$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptcha_secret&response=$recaptcha_response");
$response_keys = json_decode($response, true);

if (!$response_keys['success'] || $response_keys['score'] < 0.5) {
    echo "Error: reCAPTCHA verification failed. Please try again.";
    exit;
}

// Capture form data
$name = trim(strip_tags($_POST['name']));
$phone = trim(strip_tags($_POST['phone']));
$visitor_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$service = trim(strip_tags($_POST['service']));
$message = trim(strip_tags($_POST['message']));

// Honeypot and timing validation
$honeypot = $_POST['honeypot'];
$timestamp = (int) $_POST['timestamp'];
$current_time = time();

if (!preg_match('/^\+?[0-9]{10,15}$/', $phone)) {
    echo "Invalid phone number!";
    exit;
}

// Honeypot check
if (!empty($honeypot)) {
    echo "error; suspicious activity detected!";
    exit;
}

// Timing check (must take at least 5 seconds to submit)
if (($current_time - $timestamp) < 5) {
    echo "error; form submitted too quickly!";
    exit;
}

// Required fields check
if (empty($name) || empty($phone) || empty($message) || empty($visitor_email) || empty($service)) {
    echo "All fields are mandatory";
    exit;
}

// Email validation
if (!filter_var($visitor_email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format!";
    exit;
}

// Spam filters
if (containsSpamKeywords($message)) {
    echo "error; spam content detected!";
    exit;
}

if (containsUrl($message)) {
    echo "error; no links allowed in the message!";
    exit;
}

// Database Connection
$servername = "localhost";
$username = "contact_form_db";
$password = "MariContact_US@DB2023";
$dbname = "contact_form_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Insert data into database
$stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, service, message) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $visitor_email, $phone, $service, $message);

if (!$stmt->execute()) {
    echo "Error: " . $stmt->error;
} else {
    echo "Record successfully saved.";
}

$stmt->close();
$conn->close();

// Email body
$email_body = "Name: $name\n" .
    "Phone: $phone\n" .
    "E-mail: $visitor_email\n" .
    "Service: $service\n" .
    "Message: $message\n";

// SendGrid Email Configuration
$email = new Mail();
$email->setFrom("admin@calvada.com", "Calvada Surveying"); // Verified Sender Identity
$email->setSubject("New Contact Form Submission");
$email->addTo("gfong@calvada.com", "Glenn Fong");
$email->addTo("glenn@calvada.com", "Glenn");
$email->addTo("rgonzalez@calvada.com", "Ramon Gonzalez");
$email->addTo("adupont.jr@calvada.com", "Armando Dupont Jr.");
$email->addTo("ogonzalez@calvada.com", "Daniel Oswaldo Gonzalez");

$email->addContent("text/plain", $email_body);
$email->addContent("text/html", nl2br($email_body));

// Get SendGrid API Key (secure method with fallback)
$api_key = getenv('SENDGRID_API_KEY') ?: 'your_actual_sendgrid_api_key'; // Replace with actual key if needed
$sendgrid = new \SendGrid($api_key);

try {
    $response = $sendgrid->send($email);
    
    // Log the SendGrid response
    file_put_contents('/var/www/calvada/sendgrid_log.txt', json_encode([
        'statusCode' => $response->statusCode(),
        'headers' => $response->headers(),
        'body' => $response->body()
    ], JSON_PRETTY_PRINT) . "\n", FILE_APPEND);

    if ($response->statusCode() == 202) {
        echo "Email sent successfully!";
    } else {
        echo "Email failed to send. Response: " . $response->body();
    }
} catch (Exception $e) {
    file_put_contents('/var/www/calvada/sendgrid_log.txt', "Error: " . $e->getMessage() . "\n", FILE_APPEND);
    echo 'Error: ' . $e->getMessage();
}

// Redirect after successful submission
header('Location: /thank-you.html');
exit;

// Function to check for spam keywords
function containsSpamKeywords($message)
{
    $spam_keywords = array(
        'купить', 'кокаин', 'мефедрон', 'Москва', 'casino', 'gambling', 'roulette', 
        'plumber', 'seo', 'bitcoin', 'cryptocurrency', 'pharmacy', 'discount', 
        'weight loss', 'adult', 'cbd', 'webcam', 'escort', 'dating', 'price', 
        'lowest price', 'loan', 'cheap', 'free', 'offer'
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
    return preg_match($url_pattern, $message);
}
?>
