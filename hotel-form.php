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
        include_once 'hotel-bokking.html';
         echo "<script>$('#thankyouModal1').modal('show');</script>";
        }
        else
        {
$mail = new PHPMailer;

if (isset($_POST['submit1'])) {
$company_name = $_POST['company_name'];
$phone_no = $_POST['phone_no'];
$fax = $_POST['fax'];	
$email_id = $_POST['email_id'];
$city = $_POST['city'];
$from_date = $_POST['from_date'];
$new_date = date('d-m-Y', strtotime($from_date));   
$to_date = $_POST['to_date'];
$new_date1 = date('d-m-Y', strtotime($from_date));   
$single_room = $_POST['single_room'];
$double_room = $_POST['double_room'];
$triple_room = $_POST['triple_room'];
$comments = $_POST['comments'];
$subject = 'Hotel Form Enquiry -newtravelexperts.com'; 
$email = 'admin@newtravelexperts.com';
$mail->setFrom($email , $company_name);
$mail->addAddress('r.venkatesh6@gmail.com');  // Add a recipient
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = $subject;
$mail->Body = "
        <html>
            <body>
                <table border='1' style='width:600px;'>
                    <tbody>
                        <tr>
                            <td style='width:150px'><strong>Company Name: </strong></td>
                            <td style='width:400px'>$company_name</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Phone: </strong></td>
                            <td style='width:400px'>$phone_no</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Fax: </strong></td>
                            <td style='width:400px'>$fax</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Email Id: </strong></td>
                            <td style='width:400px'>$email_id</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Name of the City:</strong></td>
                            <td style='width:400px'>$city</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Date: </strong></td>
                            <td style='width:400px'>$new_date</td>
                        </tr>
                          <tr>
                            <td style='width:150px'><strong>Date: </strong></td>
                            <td style='width:400px'>$new_date1</td>
                        </tr>
                         <tr>
                            <td style='width:150px'><strong>Single Room: </strong></td>
                            <td style='width:400px'>$single_room</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Double Room: </strong></td>
                            <td style='width:400px'>$double_room</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Triple Room: </strong></td>
                            <td style='width:400px'>$triple_room</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Comments: </strong></td>
                            <td style='width:400px'>$comments</td>
                        </tr>
                    </tbody>
                </table>
            </body>
        </html>
        ";
        // HTML Message Ends here
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
          if(!$mail->send()) {
            //  echo"Mail not send";
            header("Location:hotel-bokking.html");
          } else {  
            //echo"Mail send";
            header("Location:thank-you.html");
          }
}
}
?>
 
