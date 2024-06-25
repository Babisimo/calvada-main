<?php
if(!isset($_POST['Submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "error; you need to submit the form!";
}
$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
$phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
$visitor_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

//Validate first
if (trim($name) == '') {
    echo "all fields are mandatory";
	exit;
}
if (trim($phone) == '') {
    echo "all fields are mandatory";
	exit;
}
if (trim($message) == '') {
    echo "all fields are mandatory";
  exit;
}
if (trim($visitor_email) == '') {
    echo "all fields are mandatory";
	exit;
}
if(IsInjected($visitor_email))
{
    echo "Bad email value!";
    exit;
}

$email_from = 'noreply@jellysecureforms.com';//<== update the email address
$email_subject = "Calvada Contact Form Submission";
$email_body = "Name: $name\n".
	"Phone: $phone\n".
	"E-mail: $visitor_email\n".
	"Message: $message\n";
	    
//$to = "adupont@calvada.com,gfong@calvada.com,rgonzalez@calvada.com";//<== update the email address
$to = "ogonzalez@calvada.com";
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $visitor_email \r\n";
//Send the email!
mail($to,$email_subject,$email_body,$headers);
//done. redirect to thank-you page.
header('Location: thank-you.html');


// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
   
?> 