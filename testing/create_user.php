<?php
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
    $first_name = $email = $password = $confirm_password = ""; #assuming empty so that we don't have warning of undefined variable. 

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
        $email = $_POST['email'];
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

    $confirm_password = $_POST['confirm_password'];

    // if (empty($anyErr)){
    //     echo "the value is there";
    // }
    // echo $firstnameErr;
    if ($firstNameErr == "" and $emailErr =="" and $passwordErr=="" and $confirmPasswordErr=="") {
        //Writing query and saving it to sql variable.
        // echo "What?";
        
        $sql = "INSERT INTO create_user (first_name, last_name, email, password)
        VALUES ('$first_name', '$last_name', '$email', '$password')";
        
        //Executing the above query and it will create row in the table.
        if ($connection->query($sql) === TRUE) {
            $success_message = "New record created successfully";
        } else {
            $db_error_message = "Error: " . $sql . "<br>" . $connection->error;
        }
        $connection->close();
        //Closing the connection once we dont need it
        // $connection->close();
    } else{
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
    <div class= "success">
        <?php 
        if (isset($success_message)){
            echo $success_message; 
        }
        ?>
    </div>
    <div class= "error">
        <?php 
        if (isset($db_error_message)){
            echo $db_error_message; 
        }
        ?>
    </div>


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