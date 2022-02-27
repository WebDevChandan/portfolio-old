<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        # FIX: Replace this email with recipient email
        $mail_to = "shreeck1999@gmail.com, hirechandan@gmail.com";
        
        # Sender Data
        $subject = trim($_POST["subject"]);
        $name = str_replace(array("\r","\n"),array(" "," ") , strip_tags(trim($_POST["name"])));
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $message = trim($_POST["message"]);
        
        if ( empty($name) OR !filter_var($email, FILTER_VALIDATE_EMAIL) OR empty($subject) OR empty($message)) {
            # Set a 400 (bad request) response code and exit.
            http_response_code(400);
          echo "Please complete the form and Try Again.";
            exit;
        }
        
        # Mail Content
        $content = "Name: $name\n";
        $content .= "Email: $email\n\n";
        $content .= "Message: $message";

        # email headers.
        $headers = "From: $name <$email>";

        # Send the email.
        $success = mail($mail_to, $subject, $content, $headers)&preg_match("/^[a-zA-Z ]*$/",$name);
        if ($success) {
            // Set a 200 (okay) response code.
            // http_response_code(200);
            echo "Thank You! Your message has been sent successfully.";
              
        } else {
            # Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "There was a problem with your submission, Please Try Again.";
        }

    }

?>