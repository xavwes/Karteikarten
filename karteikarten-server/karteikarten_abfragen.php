<?php
    header("Content-Type: application/json, charset=UTF-8");
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');

    include('dbConnection.php');
    $connection = connectToDatabase();

    $username = $_GET['username'];
    $topic = $_GET['topic'];

    //get 'user id' from 'username'
    $userIdQuery = "Select id from users where username='" . $username . "'";
    $userId = mysql_query($userIdQuery) or die("UserId-Anfrage failed");
    $row = mysql_fetch_row($userId);
    $id = $row[0];

    //Get "topic id" from topics
    $topicIdQuery = "Select id from topics where topic='" . $topic . "'";
    $topicId = mysql_query($topicIdQuery) or die("TopicID Anfrage failed");
    $rowtopic = mysql_fetch_row($topicId);
    $topID = $rowtopic[0];

    //get 'karteikarten' created from user with $id 
    $sql = "Select * from karteikarten where user='" . $id . "' and topic='" . $topID . "'";
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

            // get the answer from answer id
            $answerSql = "Select * from answers where id=" . $row['answer'];
            $res = mysql_query($answerSql) or die("Anfrage auf Answer-Table failed");
            
            while($return = mysql_fetch_array($res)){
                $row_array['antwort'] = $return['answer'];
            }

            array_push($karteikarten_array['Karteikarten'], $row_array); 
        }
        echo json_encode($karteikarten_array);
    }
?>