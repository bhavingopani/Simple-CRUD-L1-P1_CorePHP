<?php
#install composer first then do the below import - Composer is a tool for dependency management in PHP. It allows you to declare the libraries your project depends on and it will manage (install/update) them for you.


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

#save all the things and save data in the database


//have to user variable assign all database details
$servername = "localhost";
$username = "root";
$password = "1478";
$dbname = "crudapp1php";

//Creating/Making Connection by creating instance of mysqli class -
$connection = new mysqli($servername, $username, $password, $dbname);

//Check if the connection was successfull or not otherwise it will throgh an error
if ($connection->connect_error) {
    die("Connection failed: " .  $connection->connect_error); #will throgh an exception and print the same
}

// echo "Database Connected Successfully";  #if no errors then.... will show print this message.




//checking if its a POST request -- otherwise it will start creating empty records.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //for validation err.. added this after writing logic as we will have to need this.. later
    $anyErr = $firstNameErr = $emailErr = $passwordErr = $confirmPasswordErr = "";
    $first_name = $email_new = $password = $confirm_password = ""; #assuming empty so that we don't have warning of undefined variable. 

    //saving all the data coming from the from to the respective variables.
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
        $email_new = $_POST['email'];
    }

    if (empty($_POST['password'])) {
        $passwordErr = "Password is required";
    } else {
        $password = $_POST['password'];
    }

    if (empty($_POST['confirm_password'])) {
        $confirmPasswordErr = "Confirm Password is required";
    } else {
        $confirm_password = $_POST['confirm_password'];
    }

    // $confirm_password = $_POST['confirm_password'];

    // if (empty($anyErr)){
    //     echo "the value is there";
    // }
    // echo $firstnameErr;
    if ($firstNameErr == "" and $emailErr == "" and $passwordErr == "" and $confirmPasswordErr == "") {
        //Writing query and saving it to sql variable.
        // echo "What?";
        $validation_query = "SELECT * FROM create_user WHERE email ='" . $email_new . "'";
        // if ($connection->query($validation_query) === TRUE) {
        //     $success_message = "New record created successfully";
        // } else {
        //     $db_error_message = "Error: " . $validation_query . "<br>" . $connection->error;
        // }
        #we can avoid writing the bb error thing every time if you are confident

        $result_now = $connection->query($validation_query);

        if (mysqli_num_rows($result_now)) {
            $email_already_err = "This email address is already in use!";
        } else { 
            
            if ($password === $confirm_password) {

                $hash = password_hash($password, PASSWORD_DEFAULT);

                // echo "Generated has: " . $hash;
                $password = $hash;
                $email_status = "Not Verified"; #default value not_varified
                #cleaning the data -- otherwise witll throgh en Eroor. Sanitize the data
                #it should be in plain text
                // $mysqli->real_escape_String($email_status);
                // $email_status=htmlspecialchars($email_status);

                $sql = "INSERT INTO create_user (first_name, last_name, email,email_status, password)
                    VALUES ('$first_name', '$last_name', '$email_new','$email_status', '$password')";
                //Executing the above query and it will create row in the table.
                if ($connection->query($sql) === TRUE) {
                    $success_message = "New record created successfully";
                } else {
                    $db_error_message = "Error: " . $sql . "<br>" . $connection->error;
                }




                require '/usr/share/php/Composer/autoload.php';


                $mail = new PHPMailer(true);
                // $mail = new PHPMailer\PHPMailer\PHPMailer();



                try {

                    $mail->SMTPDebug = 2;                  //Enable SMTP debugging.
                    $mail->isSMTP();                        // Set mailer to use SMTP
                    $mail->Host       = 'smtp.gmail.com;';    // Specify main SMTP server
                    $mail->SMTPAuth   = true;               // Enable SMTP authentication
                    $mail->Username   = 'testpatel456@gmail.com';     // SMTP username
                    $mail->Password   = 'Test@123';         // SMTP password
                    $mail->SMTPSecure = 'tls';              // Enable TLS encryption, 'ssl' also accepted
                    $mail->Port       = 587;                // TCP port to connect to


                    #Add the recipients of the mail.
                    $mail->setFrom('testpatel456@gmail.com', 'TestName');           // Set sender of the mail
                    $mail->addAddress('gopani7874@gmail.com');           // Add a recipient
                    // $mail->addAddress('receiver2@gfg.com', 'Name');   // Name is optional



                    // $mail->isHTML(true);                                  
                    $mail->Subject = 'Email Verification';
                    $mail->Body    = 'Please verify the email and click below link to verify';
                    // $mail->AltBody = 'Body in plain text for non-HTML mail clients';

                    $mail->send();

                    echo "Mail has been sent successfully!";
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }






                // } catch (Exception $e) {
                //         echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                //     } 

                #The "catch" block retrieves the exception and creates an object ($e) containing the exception information
                #The error message from the exception is echoed by calling $e->getMessage() from the exception object



                // $to  = $email;
                // $subject = "Email Verification";
                // $message = "Click on the below link to virify your account";
                // $from = "testpatel456@gmail.com";
                // $headers = "From: $from";
                // $headers = [   //can also pass MIME-version:1.0",
                //      "Content-type: text/plain; charset=utf-8",    
                //     "From: testpatel456@gmail.com"
                //      "Cc: gopani7874@gmail.com"
                // ];


                #this we can use for live server easily.. but sending from localhost needs a lot of configuration.
                // mail($to, $subject, $message, $headers); #if you want to send cc then you can pass it as headers parameter in the last after the message and .. the same for bcc too.

                // echo "email sent successfully";



            } else {
                $password_mismatch_Err = "Password and confirm password do not match!";
            }
        }

        
    } else {
        $connection->close();
        // echo "connection closed";
    }
}





?>





<html>

<style>
    .error {
        color: red;
    }

    .pass_mismatch_err {
        color: red;
    }

    .success {
        color: green;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Profile</title>
</head>

<body>
    <form method="POST">

        <div>
            <label for="first_name"> First Name </label></br>
            <input type="text" name="first_name">
            <span class="error">
                <?php
                if (isset($firstNameErr)) {
                    echo $firstNameErr;
                }
                ?>

            </span>
        </div>

        </br>

        <div>
            <label> Last Name </label></br>
            <input type="text" name="last_name">
        </div>
        </br>


        <div>
            <label> Email </label></br>
            <input type="text" name="email">
            <span class="error">
                <?php
                if (isset($emailErr)) {
                    echo $emailErr;
                }
                if (isset($email_already_err)) {
                    echo $email_already_err;
                }
                ?>
            </span>
        </div>
        </br>



        <div>
            <label> Password </label></br>
            <input type="password" name="password">
            <span class="error">
                <?php
                if (isset($passwordErr)) {
                    echo $passwordErr;
                }
                ?>
            </span>
        </div>
        </br>
        <div>
            <label> Confirm Password </label></br>
            <input type="password" name="confirm_password">
            <span class="error">
                <?php
                if (isset($confirmPasswordErr)) {
                    echo $confirmPasswordErr;
                }
                ?>
            </span>
        </div>
        </br>
        <div>
            <input type="submit">
        </div>
    </form>
    </br>
    <div class="success">
        <?php
        if (isset($success_message)) {
            echo $success_message;
        }
        ?>
    </div>
    <div class="pass_mismatch_err">
        <?php
        if (isset($password_mismatch_Err)) {
            echo $password_mismatch_Err;
        }
        ?>
    </div>

    <div class="error">
        <?php
        if (isset($db_error_message)) {
            echo $db_error_message;
        }
        ?>
    </div>

    </br></br>
    <div>

    </div>


    </br> </br></br>
    <pre>
    DATA from GET request
<?php
print_r($_GET)
?>
</pre>

    <pre>
    DATA from POST request
<?php
print_r($_POST)
?>
</pre>


</body>

</html>