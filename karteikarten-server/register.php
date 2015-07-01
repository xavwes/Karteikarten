<?php

    header("Content-Type: application/json, charset=UTF-8");
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');


    include('dbConnection.php');

//Durch POST ersetzen, nur in der Entwicklung als GET Parameter
    $connection = connectToDatabase();
    $username = $_GET['registername'];
    $password = $_GET['registerpassword'];

    //Prüft, ob ein neuer User hinzugefügt wurde
    $sql = "Select * from users where username='" . $username . "'";
    $userExists = mysql_query($sql);

    if(mysql_num_rows($userExists) == 0)
    {
        $sql = "Insert into users(id, username, password)
        Values(0, '" . $username . "', '" . $password . "')";
        mysql_query($sql) or die('Anfrage failed');
        $returnJSON = array("user" => "added");
    }
    else
    {
        $returnJSON = array("user" => "exists");
    }

    echo json_encode($returnJSON);
?>