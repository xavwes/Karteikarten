<?php
    header("Content-Type: application/json, charset=UTF-8");
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');

    include('dbConnection.php');
    $connection = connectToDatabase();

    $username = $_GET['username'];

    //get 'user id' from 'username'
    $userIdQuery = "Select id from users where username='" . $username . "'";
    $userId = mysql_query($userIdQuery) or die("UserId-Anfrage failed");
    $row = mysql_fetch_row($userId);
    $id = $row[0];

    //get 'karteikarten' created from user with $id 
    $sql = "Select * from karteikarten where user='" . $id . "'";
    $result = mysql_query($sql) or die("Karteikarten-Anfrage failed");

    $karteikarten_array = array();
    
    if(mysql_num_rows($result) == 0){
        $karteikarten_array = array("Karteikarten" => "keine gefunden");

        echo json_encode($karteikarten_array);
    }
    else{
        $karteikarten_array['Karteikarten'] = array();
        while($row = mysql_fetch_array($result)){
            $row_array['frage'] = $row['question'];
            $row_array['antwort'] = $row['answer'];

            array_push($karteikarten_array['Karteikarten'], $row_array); 
        }
        echo json_encode($karteikarten_array);
    }
?>