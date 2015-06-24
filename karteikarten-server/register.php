<?php
    include('dbConnection.php');

    $connection = connectToDatabase();
    $username = $_GET['username'];
    $password = $_GET['password'];


    //Prüft, ob ein neuer User hinzugefügt wurde
    $sql = "Select * from users where username='" . $username . "'";
    $userExists = mysql_query($sql);

    if(mysql_num_rows($userExists) == 0)
    {
        $sql = "Insert into users(id, username, password)
        Values(0, '" . $username . "', '" . $password . "')";
        mysql_query($sql) or die('Anfrage failed');
        $returnJSON = array('user' => 'added');
    }
    else
    {
        $returnJSON = array('user' => 'exists');
    }

    echo json_encode($returnJSON);
?>