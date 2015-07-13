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

    //get disinct topics for one user
    $sql = "Select distinct topic from karteikarten where user='" . $id . "'";
    $result = mysql_query($sql) or die("Topic-Anfrage failed");

    if(mysql_num_rows($result) == 0){
        $topic_array = array("Topics" => "keine gefunden");

        echo json_encode($topic_array);
    }
    else{
        $topic_array = array();
        while($row = mysql_fetch_array($result)){
            $topic_array['Topics'][] = $row['topic'];
        }
        echo json_encode($topic_array);
    }
?>