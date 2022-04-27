<?php
#update all the data to database and edit and save




?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>

<body>
    <form>
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
            <input type="text" name="Email">
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




