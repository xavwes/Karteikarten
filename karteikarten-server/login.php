<?php
/**
 * Created by PhpStorm.
 * User: Xaver
 * Date: 24.06.15
 * Time: 15:26
 */
    include('dbConnection.php');
    $connection = connectToDatabase();

    //Durch POST ersetzen, nur in der Entwicklung als GET Parameter
    $username = $_GET['username'];
    $password = $_GET['password'];

    $sql = "Select * from users where username='" . $username . "' and password = '" . $password . "'";
    $result = mysql_query($sql) or die("Anfrage failed");

     if(mysql_num_rows($result) == 1)
     {
         $json = array("Status" => "login");
     }
    else
    {
        $json = array("Status" => "login failed");
    }

    echo json_encode($json);

?>