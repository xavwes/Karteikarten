<?php
/**
 * Created by PhpStorm.
 * User: Xaver
 * Date: 07.08.15
 * Time: 17:08
 */

    header("Content-Type: application/json, charset=UTF-8");
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');

    include('dbConnection.php');
    $connection = connectToDatabase();

    $topic = $_GET['fach'];
    $question = $_GET['frage'];
    $answer = $_GET['antwort'];
    $user = $_GET['user'];

    //Create Answer
    $sql = "Insert into answers (id, answer) Values(null, '". $answer . "')";
    $result = mysql_query($sql) or die("Answer-Insert failed");
    $answerID = mysql_insert_id();

    //Insert into karteikarten
    //Select Username from user table
    $userID = "-1";
    $sql = "Select * from users where username='" . $user . "'";
    $res = mysql_query($sql) or die("User Select failed");

    while($row = mysql_fetch_array($res))
    {
        $userID = $row['id'];
    }

    //TopicID Select
    $topicID = "-1";
    $sql = "Select * from topics where topic='" . $topic . "'";
    echo $sql;
    $res = mysql_query($sql) or die("Topic Select failed");

    while($row = mysql_fetch_array($res))
    {
        $topicID = $row['id'];
}
    //Insert into Karteikarten
    $sql = "Insert into karteikarten (id, question, answer, user, topic) Values(null, '" . $question . "','" . $answerID . "','" . $userID . "','" .  $topicID ." ')";
    mysql_query($sql) or die("Karteikarten insert failed");

?>