<?php

#now get id from the link and use delete record query to delete the respective data.

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $servername = "localhost";
    $username = "root";
    $password = "1478";
    $dbname = "crudapp1php";

    $connection = new mysqli($servername, $username, $password, $dbname);

    $email_v_hash = $_GET['email_v_hash'];

    if ($connection->connect_error) {
        die("Connection failed: " .  $connection->connect_error); #will throgh an exception and print the same
    }



    $query = "SELECT * FROM create_user WHERE email_v_hash ='" . $email_v_hash . "'";

    $result = $connection->query($query);

    if (mysqli_num_rows($result)) {

        
        $update_query = "UPDATE create_user SET email_status= 'verified' WHERE email_v_hash ='" . $email_v_hash . "' ";
        
        $connection->query($update_query);

        echo "<font color='green'>Your email has been verified successfully.";

    } else { 

        echo "Sorry your email address could not be verified. Email id was not found in the system. KINDLY CREATE YOUR ACCOUNT HERE." . "<a href=user_list.php>" .  " Click here" . "</a>" ;
    }
    

    echo "<a href=user_list.php>" .  "Click here to back to home page" . "</a>";


} 





?>