<?php
	session_start();
	include("bd.php");
	

	if(empty($_POST['login']) || empty($_POST['password'] || empty($_POST['password1'])))
	{
		exit("Please, fill all input fields <a href='reg.php'>Register</a>");
	}
	$login = $_POST['login'];
	$password = $_POST['password'];
	$password1 = $_POST['password1'];

	$result_login = mysql_query("SELECT login FROM user WHERE login='$login'", $db);
	$r_login = mysql_fetch_array($result_login);

	if($r_login['login'] != $login)
	{
		if ($password == $password1)
		{
			$result_insert = mysql_query("INSERT INTO user (login,password,identif) VALUES ('$login','$password','0')");
			$_SESSION['reg'] = "Вы успешно зарегистрировались, можете совершить вход";
			header("Location: /index.php");
			exit();
		}
		if ($password != $password1)
		{
			exit("Passwords don't match! <a href='reg.php'>Register</a>");
		}

	}
	else
	{
		exit(" Login is busy <a href='reg.php'>Register</a>");
	}
?>