<?php
 include_once 'careers.html';
 require ('PHPMailer/class.phpmailer.php');
require('PHPMailer/class.smtp.php');
 define('GR_URL', 'https://www.google.com/recaptcha/api/siteverify');
 define('GR_SECRET', '6Lfp8aoUAAAAANQ8cl7TcDxPlMO3x4fNHkC79mIK');
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
$mail = new PHPMailer;
 



if (isset($_FILES['uploaded_file']) &&
    $_FILES['uploaded_file']['error'] == UPLOAD_ERR_OK) {
    	 
   



if (isset($_POST['submit1'])) {
$name = $_POST['name'];
$last_name = $_POST['lastname'];
$email = $_POST['email'];	
$number = $_POST['number'];
$posting = $_POST['post'];
$experience = $_POST['experience'];
$message = $_POST['message'];
//$upload = $_POST['uploaded_file']; 

if(isset($_POST['g-recaptcha-response']))
          $captcha=$_POST['g-recaptcha-response'];

        if(!$captcha){
          echo "<script>$('#thankyouModal').modal('show');</script>";
          exit;
        }
		  if(!validateRecaptcha(GR_SECRET, $captcha, GR_URL))
        {
           echo "<script>$('#thankyouModal1').modal('show');</script>";
        }
        else
        {
        
$subject = 'Job Application Enquiry - Winsols.com'; 
	
$email = 'vivekv2v@gmail.com';
$mail->setFrom($email , $name);
$mail->addAddress('preetha@raamiinfotech.com');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('hr@winsols.com', 'Information');
//$mail->addCC('hr@winsols.com');
//$mail->addBCC('chellappan.istrides@gmail.com');
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
 $mail->AddAttachment($_FILES['uploaded_file']['tmp_name'],
                         $_FILES['uploaded_file']['name']);
						 


$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = $subject;
$mail->Body    = '
				  
				  <h5> NAME: '.$name.' </h5> 
				  <h5> LAST NAME: '.$last_name.' </h5> 
                  <h5> EMAIL: '.$email.' </h5> 
                  <h5> CONTACT NUMBER: '.$number.' </h5> 
                  <h5> APPLYING FOR:  '.$posting.' </h5>
                  <h5> EXPERIENCE: '.$experience.' </h5> 
                  <p> MESSAGE:  '.$message.' </p> '  ;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
if(!$mail->send()) {
	//echo $mail->Body; die;
     echo "<script>$('#thankyouModal2').modal('show');</script>";
	//die;
	   
} else {
	//echo $mail->Body; die;
	echo "<script>$('#thankyouModal3').modal('show');</script>";

//header('Location:careers.html');
 
	// echo 'Mailer Error: ' . $mail->ErrorInfo;
}
		}





}
}

?>
 
			