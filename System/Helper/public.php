<?php
function clean($data) {
    return trim(htmlspecialchars($data, ENT_COMPAT, 'UTF-8'));
}

function cleanUrl($url) {
    return str_replace(['%20', ' '], '-', $url);
}


function sendMail($to, $subject, $template, $form, $replyTo = '') {

    // Load email content from a template file
    $message = file_get_contents("path/to/email_template.html");

    // Additional headers
    $headers = "From: your_email@example.com\r\n";
    $headers .= "Reply-To: your_email@example.com\r\n";
    $headers .= "CC: cc@example.com\r\n";
    $headers .= "BCC: bcc@example.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Mail function
    $mailSent = mail($to, $subject, $message, $headers);

    if ($mailSent) {
        echo "Email sent successfully.";
    } else {
        echo "Error sending email.";
    }
}