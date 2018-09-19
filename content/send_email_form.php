<?php
    /*function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "robertodibi92@gmail.com";
    $email_subject = $_POST['subject'];

    // validation expected data exists
    if(!isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['message'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }

    $name = $_POST['name']; // required
    $email_from = $_POST['email']; // required
    $message = $_POST['message']; // required
 
    $error_message = "";
    $string_exp = "/^[A-Za-z .'-]+$/";
 
    if(!preg_match($string_exp,$name)) {
      $error_message .= 'The Name you entered does not appear to be valid.<br />';
    }

    if(strlen($message) < 2) {
      $error_message .= 'The Message you entered do not appear to be valid.<br />';
    }

    if(strlen($error_message) > 0) {
      died($error_message);
    }

    $email_message = "Form details below.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
    // create email headers
    $headers = 'From: '.$email_from;
    $success = mail($email_to, $email_subject, $message, $headers);  */
    $name = $_POST['name'];
    $visitor_email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    
    
    $email_from = 'robertodibi92@gmail.com';
    $email_subject = "New Form submission";
    $email_body = "You have received a new message from the user $name.\n"."\nSubject: $subject\n"."Here is the message:\n $message \n\n".

    $to = "robertodibi92@gmail.com";
    $headers = "From: $email_from \r\n";
    $headers .= "Reply-To: $visitor_email \r\n";
    $success = mail($to,$email_subject,$email_body,$headers);

?>
 
<!-- include your own success html here -->
<hr style=" border: 2px solid #990000" >
<div class=" row container justify-content-center" style="height: 500px;">
<div><?php if(isset($success)&&$success ){echo "<h2 class='header'>Thank you for contacting us. We will be in touch with you very soon.</h2><br/> <div class='container' style='text-align: center'> <img src='assets/img/mail.gif' alt='Email not sent gif' height='200'/></div>";}
else{echo "<h2 class='header'>Sorry! An error has occured. Please try again later.</h2> <br/> <div class='container'><img src='assets/img/Gmail.gif' class='img-fluid' alt='Email not sent gif' style='margin-left:30%;'/></div>";}?></div>


</div>
