<?php
/**
 * Created by PhpStorm.
 * User: Xaver
 * Date: 03.08.15
 * Time: 21:28
 */


?>

<html>
    <head>
        <meta charset="utf-8" />
        <meta name="format-detection" content="telephone=no" />
        <!-- WARNING: for iOS 7, remove the width=device-width and height=device-height attributes. See https://issues.apache.org/jira/browse/CB-4323 -->
        <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />
        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
        <script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/sha256.js"></script>
        <link rel="stylesheet" type="text/css" href="css/css.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
        <meta name="msapplication-tap-highlight" content="no" />
        <title>Karteikarten</title>
    </head>
    <body>
        <div class="app">

            <!-- Page one, Login und Registrieren Button, wenn schon LoginDaten gespeichert sind, automatisch einloggen -->
            <div data-role="page" id="loginpage">
                <h1>Karteikarten App</h1>
                <h2>Login</h2>
                <form id="login" data-ajax="false">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" placeholder="Username" value="">
                    <label for="password">Passwort:</label>
                    <input type="password" name="password" id="password" placeholder="Passwort" value="">
                    <button type="submit" id="login-btn" name="login-btn" class="ui-shadow ui-btn ui-corner-all ui-btn-inline">Login</button>
                </form>
            </div>

            <div data-role="page" id="mainpage">
                <h1>Karteikarte anlegen</h1>
                <form id="create-card" data-ajax="false">
                    <label>Fach:</label>
                    <select name="topic-select" id="topic-select">

                    </select>
                    <label>Frage:</label>
                    <textarea rows="5" cols="35" id="input-question" name="input-question" >Geben Sie hier ihre Frage ein
                    </textarea>

                    <label>Antwort:</label>
                    <textarea rows="5" cols="35" id="input-answer" name="input-question" >Geben Sie hier ihre Antwort ein
                    </textarea>

                </form>

                <br>
                <button type="submit" class="ui-shadow ui-btn ui-corner-all ui-btn-inline" onclick="createCard();">Karteikarte anlegen</button>
                <br>
                <button id="logout" class="ui-shadow ui-btn ui-corner-all ui-btn-inline">Logout</button>

            </div>
        </div>

        <!--<script type="text/javascript" src="cordova.js"></script>-->
        <script type="text/javascript" src="js/index.js"></script>
        <script type="text/javascript">

        	var user;

            $(document).on('pageinit', '#mainpage', function()
            {
                $.ajax({
                    url: 'http://h2467150.stratoserver.net/faecher_auslesen.php',
                    data: {"username" : "user1"},
                    type: 'GET',
                    dataType: 'json',

                    success: function (result)
                    {
                        $.each(result, function(index, element)
                        {
                            var topics = element;
                            var topics_string = String(topics);
                            var tops = topics_string.split(",");

                            for(var i = 0; i < tops.length; i++)
                            {
                                var text = String(tops[i]);
                                var node = document.createElement("option");
                                node.value = text;
                                var textnode = document.createTextNode(text);
                                node.appendChild(textnode);
                                document.getElementById("topic-select").appendChild(node);
                            }
                        });
                    },
                    error: function (request,error, result) {
                        // This callback function will trigger on unsuccessful action
                        alert('Network error has occurred please try again!');
                        console.log('Request', request);
                        console.log('Error', error);
                        console.log('Response', result);

                    }
                });
            });

            $("#logout").click(function(){

            	alert('Logout von Benutzer ' + user + ' erfolgreich');
                $.mobile.changePage("#");
            });

            function createCard(){

            	var formData = $('#create-card').serialize();
                var params = formData.split("&");
                var topic = params[0].split("=")[1];
                var question = document.getElementById("input-question").value;
                var answer = document.getElementById("input-answer").value;

                if(question.length == 0 || answer.length == 0 || topic.length == 0){
                	alert("Bitte füllen Sie die Felder Topic, Frage und Antwort korrekt aus");
                	return false;
                }
                
                $.ajax({
                    url: 'http://h2467150.stratoserver.net/karteikarte_erstellen.php',
                    data: {"topic-select": topic, "input-question": question, "input-answer": answer, "user": "user1"},
                    type: 'GET',
                    dataType: 'json',

                    success: function (result)
                    {
                    	alert("Karteikarte erfolgreich angelegt");
                        $.mobile.changePage("#mainpage");
                    },
                    error: function (request,error, result) {
                        // This callback function will trigger on unsuccessful action
                        alert('Network error has occurred please try again!');
                        console.log('Request', request);
                        console.log('Error', error);
                        console.log('Response', result);

                    }
                });
            };

            $('#login-btn').click(function()
            {
                var formData = $('#login').serialize();
                var params = formData.split("&");
                var username = params[0].split("=")[1];
                var password = params[1].split("=")[1];
                user = username;
                //Passwort hashen
                password = CryptoJS.SHA256(password).toString(CryptoJS.enc.Hex);

                $.ajax({
                    url: 'http://h2467150.stratoserver.net/login.php',
                    data: {"username" : username, "password" : password},
                    type: 'GET',
                    dataType: 'json',

                    success: function (result)
                    {

                        if(result['Status'] == 'login')
                        {
                            localStorage.username = username;
                            $.mobile.changePage('#mainpage');
                        }
                        else
                        {
                            alert('Login failed');
                        }
                    },
                    error: function (request,error, result) {
                        // This callback function will trigger on unsuccessful action
                        alert('Network error has occurred please try again!');
                        console.log('Request', request);
                        console.log('Error', error);
                        console.log('Response', result);

                    }
                });

                return false;
            });

		

        </script>
    </body>
</html>
