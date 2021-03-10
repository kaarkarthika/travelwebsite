<?php
//include_once 'contact-us.html';
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
        include_once 'insurance.html';
         echo "<script>$('#thankyouModal1').modal('show');</script>";
        }
        else
        {
$mail = new PHPMailer;

if (isset($_POST['submit1'])) { 
$application_name = $_POST['application_name'];
$passport_no = $_POST['passport_no'];
$travelled_to = $_POST['travelled_to'];
$from_date = $_POST['from_date'];
$new_date = date('d-m-Y', strtotime($from_date));	
$to_date = $_POST['to_date'];
$new_date1 = date('d-m-Y', strtotime($to_date)); 
$subject = 'Insurance Form Enquiry -newtravelexperts.com'; 
$email = 'admin@newtravelexperts.com';
$mail->setFrom($email , $application_name);
$mail->addAddress('r.venkatesh6@gmail.com');     // Add a recipient
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = $subject;
$mail->Body    = "
          <html>
            <body>
                <table border='1' style='width:600px;'>
                    <tbody>
                        <tr>
                            <td style='width:150px'><strong>Application Name: </strong></td>
                            <td style='width:400px'>$application_name</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Passport No: </strong></td>
                            <td style='width:400px'>$passport_no</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Travelled To: </strong></td>
                            <td style='width:400px'>$travelled_to</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Onward: </strong></td>
                            <td style='width:400px'>$new_date</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>To Date:</strong></td>
                            <td style='width:400px'>$new_date1</td>
                        </tr>
                    </tbody>
                </table>
            </body>
        </html>
        "; 
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
          if(!$mail->send()) {
            //echo"Mail not send";
            header("Location:insurance.html");
          } else { 	
            //echo"Mail send";
            header("Location:thank-you.html");
          }
}
}
?>
 
