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
        include_once 'passport.html';
         echo "<script>$('#thankyouModal1').modal('show');</script>";
        }
        else
        {
$mail = new PHPMailer;

if (isset($_POST['submit1'])) {
 // echo"<pre>"; print_r($_POST);die;
$passport_office = $_POST['passport_office'];
$district = $_POST['district'];
$service_desired = $_POST['service_desired'];	
$surname = $_POST['surname'];
$given_surname = $_POST['given_surname'];
$facilities="No";
if(isset($_POST['facilities'])){
  $facilities=$_POST['facilities'];
}

$previous_name = $_POST['previous_name'];
$dob = $_POST['dob'];
$new_date = date('d-m-Y', strtotime($dob));
$district1 = $_POST['district1'];
$country = $_POST['country'];
$profession = $_POST['profession'];
$permanent_address = $_POST['permanent_address'];
$gender = $_POST['gender'];
$place_dob = $_POST['place_dob'];
$state = $_POST['state'];
$qualification = $_POST['qualification'];
$visible_mark = $_POST['visible_mark'];
$present_address = $_POST['present_address'];
$address_date = $_POST['address_date'];
$new_date1 = date('d-m-Y', strtotime($address_date));
$email_id = $_POST['email_id'];
$phone_no = $_POST['phone_no'];
$mobile_no = $_POST['mobile_no'];
$height = $_POST['height'];
$marital_status = $_POST['marital_status'];
$father_name = $_POST['father_name'];
$spouse_name = $_POST['spouse_name'];
$mother_name = $_POST['mother_name'];
$from = $_POST['from'];
$to = $_POST['to'];
$address1 = $_POST['address1'];
$from1 = $_POST['from1'];
$to1 = $_POST['to1'];
$address = $_POST['address'];
$facilities1="No";
if(isset($_POST['facilities1'])){
  $facilities1=$_POST['facilities1'];
}
$facilities2="No";
if(isset($_POST['facilities2'])){
  $facilities2=$_POST['facilities2'];
}
$dd_no = $_POST['dd_no'];
$old_passport = $_POST['old_passport'];
$issue = $_POST['issue'];
$dd_date = $_POST['dd_date'];
$place_issue = $_POST['place_issue'];
$date_expiry = $_POST['date_expiry'];
$subject = 'Passport Form Enquiry -newtravelexperts.com'; 
$email = 'admin@newtravelexperts.com';
$mail->setFrom($email , $surname);
$mail->addAddress('r.venkatesh6@gmail.com');     // Add a recipient
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = $subject;
$mail->Body = "
        <html>
            <body>
                <table border='1' style='width:600px;'>
                    <tbody>
                        <tr>
                            <td style='width:150px'><strong>Passport Office: </strong></td>
                            <td style='width:400px'>$passport_office</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>District: </strong></td>
                            <td style='width:400px'>$district</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Service Desired: </strong></td>
                            <td style='width:400px'>$service_desired</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Surname: </strong></td>
                            <td style='width:400px'>$surname</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Given Surname: </strong></td>
                            <td style='width:400px'>$given_surname</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>change your name</strong></td>
                            <td style='width:400px'>$facilities</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Previous Name: </strong></td>
                            <td style='width:400px'>$previous_name</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Date of Birth:: </strong></td>
                            <td style='width:400px'>$new_date</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>District: </strong></td>
                            <td style='width:400px'>$district1</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Country: </strong></td>
                            <td style='width:400px'>$country</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Profession:</strong></td>
                            <td style='width:400px'>$profession</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Height(cms):</strong></td>
                            <td style='width:400px'>$height</td>
                        </tr>
                          <tr>
                            <td style='width:150px'><strong>Permanent address:</strong></td>
                            <td style='width:400px'>$permanent_address</td>
                        </tr>
                         <tr>
                            <td style='width:150px'><strong>Please give the Date since residing at the present address:</strong></td>
                            <td style='width:400px'>$new_date1</td>
                        </tr>
                         <tr>
                            <td style='width:150px'><strong>Sex: </strong></td>
                            <td style='width:400px'>$gender</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Place of Birth: </strong></td>
                            <td style='width:400px'>$place_dob</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>State: </strong></td>
                            <td style='width:400px'>$state</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Qualification: </strong></td>
                            <td style='width:400px'>$qualification</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Visible Mark: </strong></td>
                            <td style='width:400px'>$visible_mark</td>
                        </tr>
                         <tr>
                            <td style='width:150px'><strong>Present address: </strong></td>
                            <td style='width:400px'>$present_address</td>
                        </tr>
                         <tr>
                            <td style='width:150px'><strong>Email ID: </strong></td>
                            <td style='width:400px'>$email_id</td>
                        </tr>     
                        <tr>
                            <td style='width:150px'><strong>Phone No: </strong></td>
                            <td style='width:400px'>$phone_no</td>
                        </tr>
                             <tr>
                            <td style='width:150px'><strong>Mobile No: </strong></td>
                            <td style='width:400px'>$mobile_no</td>
                        </tr>
                             <tr>
                            <td style='width:150px'><strong>Marital Status: </strong></td>
                            <td style='width:400px'>$marital_status</td>
                        </tr>
                             <tr>
                            <td style='width:150px'><strong>Father Name: </strong></td>
                            <td style='width:400px'>$father_name</td>
                        </tr>
                             <tr>
                            <td style='width:150px'><strong>Spouse Name: </strong></td>
                            <td style='width:400px'>$spouse_name</td>
                        </tr>
                             <tr>
                            <td style='width:150px'><strong>Mother Name: </strong></td>
                            <td style='width:400px'>$mother_name</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>                        present address for the last one year:</strong></td>
                            <td style='width:400px'>$facilities1</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>From: </strong></td>
                            <td style='width:400px'>$from</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>To: </strong></td>
                            <td style='width:400px'>$to</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Address1: </strong></td>
                            <td style='width:400px'>$address1</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>From: </strong></td>
                            <td style='width:400px'>$from1</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>To: </strong></td>
                            <td style='width:400px'>$to1</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Address1: </strong></td>
                            <td style='width:400px'>$address</td>
                        </tr>
                         <tr>
                            <td style='width:150px'><strong>If you have a Demand Draft: </strong></td>
                            <td style='width:400px'>$facilities2</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>DD No.: </strong></td>
                            <td style='width:400px'>$dd_no</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Old / Existing Passport No.: </strong></td>
                            <td style='width:400px'>$old_passport</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Date of  Issue: </strong></td>
                            <td style='width:400px'>$issue</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>DD Date: </strong></td>
                            <td style='width:400px'>$dd_date</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Place of Issue: </strong></td>
                            <td style='width:400px'>$place_issue</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Date of Expiry: </strong></td>
                            <td style='width:400px'>$date_expiry</td>
                        </tr>
                    </tbody>
                </table>
            </body>
        </html>
        "; 
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
          if(!$mail->send()) {
           // echo"Mail not send";
            header("Location:passport.html");
          } else { 
            header("Location:thank-you.html");
          }
 }
}

?>
 
