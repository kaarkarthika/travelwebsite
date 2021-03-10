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
        include_once 'flight-ticket.html';
         echo "<script>$('#thankyouModal1').modal('show');</script>";
        }
        else
        {
$mail = new PHPMailer;

if (isset($_POST['submit1'])) {
  //print_r($_POST);die;
$first_name = $_POST['first_name'];
$email_id = $_POST['email_id'];  
$orgin_city = $_POST['orgin_city'];
$facilities="No";
$facilities=$_POST['facilities'];
$return_date = $_POST['return_date'];
$new_date = date('d-m-Y', strtotime($return_date));
$no_child = $_POST['no_child'];
$last_name = $_POST['last_name'];
$contact_no = $_POST['contact_no'];
$des_city = $_POST['des_city'];
$departure_date = $_POST['departure_date'];
$new_date1 = date('d-m-Y', strtotime($departure_date));
$no_adults = $_POST['no_adults'];
$no_infant = $_POST['no_infant'];
$subject = 'Flight Form Enquiry -newtravelexperts.com'; 
//$email = 'r.venkatesh6@gmail.com';
$email = 'admin@newtravelexperts.com';
$mail->setFrom($email , $name);
$mail->addAddress('r.venkatesh6@gmail.com');     // Add a recipient
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = $subject;
$mail->Body = "
        <html>
            <body>
                <table border='1' style='width:600px;'>
                    <tbody>
                        <tr>
                            <td style='width:150px'><strong>First Name: </strong></td>
                            <td style='width:400px'>$first_name</td>
                        </tr>
                         <tr>
                            <td style='width:150px'><strong>Last Name: </strong></td>
                            <td style='width:400px'>$last_name</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Email Id: </strong></td>
                            <td style='width:400px'>$email_id</td>
                        </tr>
                         <tr>
                            <td style='width:150px'><strong>Contact No.: </strong></td>
                            <td style='width:400px'>$contact_no</td>
                        </tr>                        
                          <tr>
                            <td style='width:150px'><strong>Origin City: </strong></td>
                            <td style='width:400px'>$orgin_city</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Destination City:</strong></td>
                            <td style='width:400px'>$des_city</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Departure Date: </strong></td>
                            <td style='width:400px'>$new_date1</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Return Date:</strong></td>
                            <td style='width:400px'>$new_date</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Trip: </strong></td>
                            <td style='width:400px'>$facilities</td>
                        </tr>
                          <tr>
                            <td style='width:150px'><strong>No. of Adults:</strong></td>
                            <td style='width:400px'>$no_adults</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>No. of Children:</strong></td>
                            <td style='width:400px'>$no_child</td>
                        </tr> 
                        <tr>
                            <td style='width:150px'><strong>No. of Infant: </strong></td>
                            <td style='width:400px'>$no_infant</td>
                        </tr>
                    </tbody>
                </table>
            </body>
        </html>
        ";
        // HTML Message Ends here
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
          if(!$mail->send()) {
             // echo"Mail not send";
            header("Location:flight-ticket.html");
          } else {  
            //echo"Mail send";
            header("Location:thank-you.html");
          }
}
}
?>