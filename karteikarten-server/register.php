<?php
    include('dbConnection.php');

    $connection = connectToDatabase();

    if ($connection->connect_error)
    {
        die("Connection failed: " . $connection->connect_error);
    }

    $username = $_GET['username'];
    $password = $_GET['password'];

    echo $username . ' ' . $password;

    $sql = "Insert into users(id, username, password) Values(0, '" . $username . "','" . $password . "')";
    mysql_query($sql) or die("Anfrage Failed");

?>