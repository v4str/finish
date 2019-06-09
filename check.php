<?php
	session_start();
	include("bd.php");

	if(empty($_POST['login']) || empty($_POST['password']))
	{
		exit("Please, fill all input fields");
	}
	$login = $_POST['login'];
	$password = $_POST['password'];

	$result_login = mysql_query("SELECT login FROM user WHERE login='$login'", $db);
	$r_login = mysql_fetch_array($result_login);

	if($r_login['login'] == $login)
	{
		$result_password = mysql_query("SELECT password FROM user WHERE login='$login'", $db);
		$r_password = mysql_fetch_array($result_password);
		if($r_password['password'] == $password)
		{
			$result_id = mysql_query("SELECT id FROM user WHERE login='$login'", $db);
			$r_id = mysql_fetch_array($result_id);
			$_SESSION['id'] = $r_id['id'];
			$_SESSION['login'] = $login;
			$identif = mysql_query("SELECT identif FROM user WHERE login='$login'" ,$db);
			$r_identif = mysql_fetch_array($identif);

			if ($r_identif['identif']=='1'){
				header("Location: main.php");
			}
			if ($r_identif['identif'] == '2'){
				header("Location: main.php");
			}
			if ($r_identif['identif'] == '0'){
				header("Location: main.php");
			}
			exit;
		}
		else
		{
			exit("error");
		}
	}
	else
	{
		exit("error");
	}

?>