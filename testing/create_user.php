

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

echo "Database Connected Successfully";  #if no errors then.... will show print this message.




//checking if its a POST request -- otherwise it will start creating empty records.
if($_SERVER['REQUEST_METHOD'] === 'POST'){

//saving all the data coming from the from to the respective variables.
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];



//Writing query and saving it to sql variable.
$sql = "INSERT INTO create_user (first_name, last_name, email, password)
            VALUES ('$first_name', '$last_name', '$email', '$password')";

//Executing the above query and it will create row in the table.
if($connection->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $connection->error;
}

//Closing the connection once we dont need it
$connection->close();


}


?>





<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Profile</title>
</head>

<body>
    <form  method="POST">
        <div>
            <label for="first_name"> First Name </label></br>
            <input type="text" name="first_name">
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
        </div>
        </br>



        <div>
            <label> Password </label></br>
            <input type="password" name="password">
        </div>
        </br>
        <div>
            <label> Confirm Password </label></br>
            <input type="password" name="confirm_password">
        </div>
        </br>
        <div>
            <input type="submit" >
        </div>
    </form>
</br>



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