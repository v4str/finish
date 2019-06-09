<?php
include('bd.php'); //подключаюсь к базе данных


$comment = $_POST['addMessage'];

$result= mysql_query("INSERT INTO comments(comments) VALUES ('$comment')");



echo $comment;

?>
