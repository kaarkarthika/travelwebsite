<?php
include_once 'contact.html';
 require ('PHPMailer/class.phpmailer.php');
 require('PHPMailer/class.smtp.php');

 define('GR_URL', 'https://www.google.com/recaptcha/api/siteverify');
 define('GR_SECRET', '6LfPPqwUAAAAAK4dmCI3AjXCli7TXsrLEmjFUc-1');
function validateRecaptcha( $secret, $response, $url = GR_URL ){

  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, 1);
  $params = array(
    'secret' => urlencode($secret),
    'response' => urlencode($response),
  );
  curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $result = curl_exec($ch);
  $result = json_decode($result);
  return (isset($result->success) && $result->success);
}
        $captcha=$_POST['g-recaptcha-response'];
        if(!validateRecaptcha(GR_SECRET, $captcha, GR_URL))
        {
          echo "<script>$('#thankyouModal1').modal('show');</script>";
        }
        else
        {

            $mail = new PHPMailer;

            if (isset($_POST['submit1'])) {
            $name = $_POST['name'];
            $email1 = $_POST['email'];	
            $message = $_POST['message'];
            $subject = 'Contact Form Enquiry - newtravelexperts.com'; 
            $email = 'admin@newtravelexperts.com';
            $mail->setFrom($email , $name);
            $mail->addAddress('r.venkatesh6@gmail.com');     // Add a recipient
            //$mail->addAddress('chellappan.istrides@gmail.com','Information');               // Name is optional
            //$mail->addReplyTo('info@raamiinfotech.com', 'Information');
            //$mail->addCC('info@raamiinfotech.com');
            //$mail->addBCC('r.456@gmail.com');
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = '
            				   
            				  <h5> NAME: '.$name.' </h5> 
                              <h5> EMAIL: '.$email1.'  </h5> 
                               <p> MESSAGE: '.$message.' </p> '  ;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                      if(!$mail->send()) {
                          echo "<script type='text/javascript'>$('#thankyouModal2').modal('show');</script>";
                         
                      } else {
                      	
                      	echo "<script type='text/javascript'>$('#thankyouModal3').modal('show');</script>";

                      }
             
            }
}
?>
 
