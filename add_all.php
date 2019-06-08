<?php

    include("bd.php");
     $result = mysql_query("SELECT * FROM comments", $db);
     $r = array();
     while($res = mysql_fetch_array($result)){
         array_push($r, $res['id'], $res['comments']);
     }
      echo json_encode($r);

?>