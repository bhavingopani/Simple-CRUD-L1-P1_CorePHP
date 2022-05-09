<?php




use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// require  '/usr/share/php/Composer/autoload.php';
require 'vendor/autoload.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $servername = "localhost";
    $username = "root";
    $dbpassword = "1478";
    $dbname = "crudapp1php";
    
    $connection = new mysqli($servername, $username, $dbpassword, $dbname);
    


    $current_id = $_POST['current_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $new_email = $_POST['email'];


    $anyErr = $firstNameErr = $emailErr = "";
    $first_name = $new_email= "";


    if (empty($_POST['first_name'])) {
        $firstNameErr = "First name is required";
        // echo "First name needed";
    } else {
        $first_name = $_POST['first_name'];
        // echo "First name needed";
    }

    $last_name = $_POST['last_name'];

    if (empty($_POST['email'])) {
        $emailErr = "Email is required";
    } else {
        $new_email = $_POST['email'];
    }    

 #CHECK LOGIC FROM HERE>
    if ($firstNameErr == "" and $emailErr == "") {


        $validation_query = "SELECT * FROM create_user WHERE email ='" . $new_email . "'";
        // echo $validation_query;
        $result_now = $connection->query($validation_query);

        if (mysqli_num_rows($result_now) > 0) {
        $email_already_err = "<font color='blue'>$new_email </font>" . " " . "This email address is already in use!";
        echo "<font color='red'> $email_already_err </font>" ;
        #working fine till here.
        } else { 

            $random_string = rand();
            $email_v_hash = md5($random_string);

        
            $query = "UPDATE create_user SET first_name = '$first_name' ,  last_name = '$last_name' , email = '$new_email', email_status = 'not_verified', email_v_hash = '$email_v_hash'  WHERE id ='" . $current_id . "'";
            // echo $query; 
               
            if ($connection->query($query) === TRUE) {
            
                echo "<font color='green'> Record updated successfully</font>";

                $mail = new PHPMailer(true);
                // $mail = new PHPMailer\PHPMailer\PHPMailer();
                try {
                        $mail->SMTPDebug = false;                  //Enable SMTP debugging. #should keep it false otherwise you will have all the details on the screen .. Keep it true only if you want to debug or sometimes you have to debug to resolve error.
                        $mail->isSMTP();                        // Set mailer to use SMTP
                        $mail->Host       = 'smtp.gmail.com;';    // Specify main SMTP server
                        $mail->SMTPAuth   = true;               // Enable SMTP authentication
                        $mail->Username   = 'testpatel456@gmail.com';     // SMTP username
                        $mail->Password   = 'Test@123';         // SMTP password
                        $mail->SMTPSecure = 'tls';              // Enable TLS encryption, 'ssl' also accepted
                        $mail->Port       = 587;                // TCP port to connect to


                        #Add the recipients of the mail.
                        $mail->setFrom('testpatel456@gmail.com', 'TestName');           // Set sender of the mail
                        $mail->addAddress("{$new_email}");           // Add a recipient
                        // $mail->addAddress('receiver2@gfg.com', 'Name');   // Name is optional



                        $mail->isHTML(true); #making it true as we want to send some html for the verification .. once clicked on that link user will be redirected to verification page.                                 
                        $mail->Subject = 'Email Verification';
                        $mail->Body    = "Please verify the email and click below link to verify  <a href= http://freecodepractice.com/email_verification.php?email_v_hash=" . $email_v_hash . "> Click here to verify </a>";
                        // $mail->AltBody = 'Body in plain text for non-HTML mail clients';
                        // /home/g21/Projects/simple_crud-level1-project1_CorePHP/testing/email_v_file.php
                        $mail->send();
                        echo "</br> </br>";
                        echo "<font color='blue'> Your emailid has been changed. We have sent you a verification email. Please check your mailbox for the same. </font>";

                    } catch (Exception $e) { 
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                


            } else {
            
                echo "Error updating record: " . $query . $connection->error;
            }

        }

    }


}

?>





<pre>
DATA from GET request
<?php
print_r($_GET);
?>
</pre>
<pre>
DATA from POST request
<?php
print_r($_POST);
?>
