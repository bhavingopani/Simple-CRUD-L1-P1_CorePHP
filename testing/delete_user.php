<?php

$servername = "localhost";
$username = "root";
$dbpassword = "1478";
$dbname = "crudapp1php";

$connection = new mysqli($servername, $username, $dbpassword, $dbname);


if ($connection->connect_error) {
    die("Connection failed: " .  $connection->connect_error); #will throgh an exception and print the same
}


#THE ABOVE ENTIRE DB CONNECTION CODE WE CAN CREATE A SEPARATE FILE .. AND STORE IT -- and INLCLUDE HERE WITH INCLUDE FUNTION

$current_delete_id = $_GET['id'];

$sql = "DELETE FROM create_user WHERE id= $current_delete_id";
$result = $connection->query($sql);

if($result) {
    echo "<font color='red'> Record deleted successfully";
}
echo "</br></br>";
echo "<font color='blue'> <a href='user_list.php'> Click here to go to  listing page </a> ";



?>

