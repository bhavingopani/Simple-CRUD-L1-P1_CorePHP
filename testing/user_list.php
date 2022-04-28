<?php 

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


$sql ="SELECT * FROM create_user";

$result = mysqli_query($connection, $sql);

$row = mysqli_fetch_assoc($result);


?>








<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <style type="text/css"> 
        table, th, td,tr {
        border: 1px solid black;
        border-collapse: collapse;
        margin: auto;
        padding:20px;
        /* padding-left: 10px;
        padding-right: 10px;
        padding-top: 10px;
        padding-bottom: 10px;         */
        }
    </style>

</head>
<body>
    
<div >
<table>
    <tr>
    <th> First Name </th>
    <th> Last Name </th>
    <th> Email </th>
    <th>Edit</th>
    <th>Delete</th>
    </tr>
    <?php
    echo "<tr>";
        
    echo "<td>". $row['first_name'] . "</td>";
    echo "<td>" . $row['last_name'] . "</td>";
    echo "<td>". $row['email'] . "</td>";
    echo "<td><a href=$row['id']>" . "Edit" . "</a>" . "</td>";
    echo "<td><a href=$row['id']>" . "Delete" . "</a></td>";
    echo "</tr>";
    ?>
</table>
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