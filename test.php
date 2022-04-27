<!-- MODEL - talking to a database - and handling data - brain of the program  -->
<?php



?>

<!-- VIEW - Display all - output - taking all stuffs from the above - called - CONTEXT -->

<html>

<h1> Guessing game.. </h1>

<h3> Guess a number </h3>

<form method="POST">
    <label for="guess"> Input Guess </label>
    <input type="text" name="guess">
    <input type="submit">
</form>

</br>
<h2> Printing $_GET - coming from the form to url as name and printing here </h2>


<pre>
    <?php
    print_r($_GET);
    ?>
</pre>


<h2> Printing $_POST - coming from the form But you can not see that in the url  </h2>

<pre>
    <?php
    print_r($_POST);
    ?>
</pre>



</html>