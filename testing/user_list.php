<?php

//have to user variable assign all database details
$servername = "localhost";
$username = "root";
$dbpassword = "1478";
$dbname = "crudapp1php";

//Creating/Making Connection by creating instance of mysqli class -
$connection = new mysqli($servername, $username, $dbpassword, $dbname);

//Check if the connection was successfull or not otherwise it will throgh an error
if ($connection->connect_error) {
    die("Connection failed: " .  $connection->connect_error); #will throgh an exception and print the same
}

// echo "Database Connected Successfully";  #if no errors then.... will show print this message.


$sql = "SELECT * FROM create_user";

// $result = mysqli_query($connection, $sql);
$result = $connection->query($sql);

#PAGINATION


$results_per_page = 10;


#Get total number of pages

$number_of_results = mysqli_num_rows($result); #this will give number of rows 

$number_of_page = ceil($number_of_results / $results_per_page); #number of page #ceil gives rounds the number to the nearest integer

#get the current page user is on -- if no records then by default its 1

if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

#Set limit for 1 page.. here its 10

$page_first_result = ($page - 1) * $results_per_page;


$sql_new = "SELECT * FROM create_user LIMIT $page_first_result , $results_per_page";



// $result = mysqli_query($connection, $sql);
$result_new = $connection->query($sql_new);

#PAGINATION


// $row = mysqli_fetch_assoc($result);

// $result ->fetch_all(MYSQLI_ASSOC);

// var_dump($result);
// print_r($result);



// $first_name = $row['first_name'];
// $last_name = $row['last_name'];
// $email = $row['email'];
// $password = $row['password'];

?>

<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <style type="text/css">
        table,
        th,
        td,
        tr {
            border: 1px solid black;
            border-collapse: collapse;
            margin: auto;
            padding: 20px;
            /* padding-left: 10px;
        padding-right: 10px;
        padding-top: 10px;
        padding-bottom: 10px;         */
        }

        div {
            text-align: center;
        }

        /* .new {
            text-align: left;
            margin: auto;
        } */
    </style>

</head>

<body>

    <div>
        <table>
            <tr>
                <th> id </th>
                <!-- Add Full Name instead of first and last later on -->
                <th> Full Name </th>
                
                <th> Email </th>
                <th> Account Status </th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>

            <?php
            while ($row_new = mysqli_fetch_array($result_new)) {

                echo "<tr>";
                echo "<td>" . $row_new['id'] . "</td>";
                echo "<td>" . $row_new['first_name'] . " " . $row_new['last_name'] . "</td>";
   
                echo "<td>" . $row_new['email'] . "</td>";
                echo "<td>" . $row_new['email_status'] . "</td>";
                echo "<td><a href=" . "edit_user.php?id=" . $row_new['id'] . ">" .  "Edit </a></td>";
                // echo "<td><button type=submit name=delete><a href=user_list.php?id=" . $row_new['id']  .">". "Delete" . "</button></td>";
                echo "<td><a href=" . "delete_user.php?id=" . $row_new['id'] . ">" .  "Delete </a></td>";
                
                echo "</tr>";
            }


            // $current_delete_id = $_GET['id'];
            // echo $current_delete_id;
// CHECK FROM HERE-- Not able to delete the same.
            // #deleting the user - 
            // if (isset($_GET["delete1"])) {
           
            //     $delete_sql = "DELETE FROM create_user WHERE id= $current_delete_id";

            //     // $last_result = $connection->query($delete_sql);
            //     if ($connection->query($delete_sql) === TRUE) {
            //         $success_message = "The record has been deleted successfully";
            //     } else {
            //         $db_error_message = "Error: " . $sql . "<br>" . $connection->error;
            //     }
            // }




            ?>
            <!-- <a href="google.com" name="delete"> </a> -->
        </table>
    </div>




    <div>


        <!-- #Display link of the urls of the pages. -->

        <?php
        // echo $page;
        if ($page <= 1) {
            echo "<a style='visibility:hidden;'>" . "Previous" . " </a>";
        } else {
            // echo $page;
            $previous_page = $page - 1;
            echo "<a href='?page=$previous_page'>" . "Previous" . "</a>";
        }

        ?>

        <?php
        // echo $page;
        // echo $number_of_page;
        if ($page >= $number_of_page) {
            echo "<a style='visibility:hidden;'>" . "Next" . " </a>";
        } else {
            // echo $page;
            $next_page = $page + 1;
            echo "<a href='?page=$next_page'>" . "Next" . " </a>";
        }
        ?>
    </div>
    <div>
        <?php
        for ($page = 1; $page <= $number_of_page; $page++) {
            echo "<a href=?page=$page>" . $page . "</a>" . "&nbsp";
            // return 1;

        }
        // echo $page;  #WHY IT STILL KEEPS THE VALUE OUTSIDE OF THE LOOP - CHECK AND ASK LATER. #hence cannot use the logic of next button after this as this has wrong value.
        ?>
    </div>
    </br>
    <div class='new'>
        <a href="/create_user.php"> Creat User </a>
    </div>

    <div>
        <?php
        if (isset($success_message)){
            echo $success_message;
        }
        if (isset($db_error_message)){
            echo $db_error_message;
        }
        
        ?>
    </div>



    <!-- <ul>
        <a href="?page= "
        </ul> -->

</body>

</html>