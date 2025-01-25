<?php

echo '<h1>ERROR PAGE</h1>';
if( isset($_GET['system_message']) ){
    $system_message = $_GET['system_message'];
}


if( isset($_GET['user_message']) ){
    $user_message = $_GET['user_message'];
}

echo 'ERROR: </br>system: '.$system_message.' </br>user: '.$user_message; exit;



?>