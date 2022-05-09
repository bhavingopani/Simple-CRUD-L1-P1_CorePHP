<?php
#update all the data to database and edit and save


#first - make all the fields prefilled from the db

$servername = "localhost";
$username = "root";
$dbpassword = "1478";
$dbname = "crudapp1php";

$connection = new mysqli($servername, $username, $dbpassword, $dbname);


if ($connection->connect_error) {
    die("Connection failed: " .  $connection->connect_error); #will throgh an exception and print the same
}

$current_id = $_GET['id'];

$sql = "SELECT * FROM create_user WHERE id=$current_id";
$result = $connection->query($sql);



echo $current_id;
?>


<html>

<head>

<form method="POST" action=/update_user.php>
    <?php 

    // "<form"  . "method=" . "POST" . "action=/update_user.php?id=" .  $current_id . ">";
    // "<form"  . "method=" . "POST" . "action=/update_user.php>";


        while ($row = $result->fetch_assoc()) {
            $current_fname = $row['first_name'];
            $current_lname = $row['last_name'];
            $current_email = $row['email'];
            //  $current_password = $row['password'];
            // echo $current_fname;
            $current_id = $row['id']; #will be sent to the update_user.php form 

            echo "<input  type=hidden name=current_id value=" . $current_id . ">";  #passing the id from here so that we can fetch this on the update page.
            echo "<div>";
            echo     "<label for=" . "first_name" . ">" . "First Name </label></br>";
            echo     "<input type='text'" . "name='first_name'"  . "value=" . $current_fname . ">";
            echo "</div>";
            echo "</br>";
            echo "<div>";
            echo     "<label for=" . "last_name" . ">" . "Last Name </label></br>";
            echo     "<input type='text'" . "name='last_name'"  . "value=" . $current_lname . ">";
            echo "</div>";
            echo "</br>";

            echo "<div>";
            echo     "<label for=" . "email" . ">" . "Email </label></br>";
            echo     "<input type='text'" . "name='email'"  . "value=" . $current_email . ">";
            echo "</div>";

            echo "</br>";
            echo "<div>";
            echo    "<label> Password </label></br>";
            echo    "<input type=" . "password" . "name=" . "password" . ">";
            echo "</div>";

            echo "</br>";
            // <div>
            //     <label> Confirm Password </label></br>
            //     <input type="password" name="confirm_password">
            // </div>
            // </br>
            echo "<div>";
            echo     "<input type=" . "submit" . ">";
            echo "</div>";
        }

        ?>
    </form>

    </br></br></br></br>

    <?php

// 5151

    ?>




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