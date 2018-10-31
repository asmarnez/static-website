<?php
/* Set e-mail recipient */
$myemail  = "andresmarnez@gmail.com";

/* Check all form inputs using check_input function */
$name = check_input($_POST['name'], "name");
$subject  = check_input($_POST['subject'], "subject");
$email    = check_input($_POST['email']);
$phone    = check_input($_POST['phone']);
$message = check_input($_POST['message'], "message");

/* If e-mail is not valid show error message */
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email))
{
    show_error("Email introducido no es válido");
}

/* If URL is not valid set $website to empty */
if (!preg_match("/^(https?:\/\/+[\w\-]+\.[\w\-]+)/i", $website))
{
    $website = '';
}
$headers = "From: $email";
/* Let's prepare the message for the e-mail */
$message = "Hello!

Your contact form has been submitted From FORMER wrap by:

Name: $name
\n
Subject: $subject
\n
Contact no: $phone
\n
E-mail: $email

Messages:
$message

End of message
";

/* Send the message using mail() function */
mail($myemail, $subject, $message);

/* Redirect visitor to the thank you page */
header('Location: index.html');
exit();

/* Functions we used */
function check_input($data, $problem='')
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if ($problem && strlen($data) == 0)
    {
        echo "<script>alert('Rellene los campos marcados como obligatorios.')</script>";
        include('contact.html');
        exit();
    }
    return $data;
}

function show_error($myError)
{
    include('contact.html');
?>

<?php
exit();
}
?>
