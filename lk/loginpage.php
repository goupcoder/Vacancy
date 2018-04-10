<?php
session_start();

if (empty($_SESSION['id'])) {
echo '
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>СОФ НИУ БелГУ трудоустройство выпускников</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<table width="100%" cellpadding="5" cellspacing="4">
<tr><td colspan=3 class="td-banner" height="250">		
	<img src="../image/banner.png" width="100%" height="100%" alt="" id="banner">
<a href="http://www.sof.bsu.edu.ru/sof/"><img src="../image/11.png" alt="" id="emblema"></a>
<div id="titl">
<p align="center"><font size="5">Белгородский государственный национальный 
</font></p>
<p align="center"><font size="5">исследовательский университет
</font></p>
<p align="center"><font size="5">Старооскольский филиал</font>
</div>
';
echo'
</td>
</tr>
<tr>
<td width="200" rowspan=2 valign="top">';
include "lmenu.php"; 
echo '</td>
<td valign=top>
';

function echo_form($i,$path) 
{
switch($i) {
   case 0: 
	echo '
	<form style="border-radius:10px;border-style:outset; border-width:3px;" name=log action="?" method="POST">
	<p align="center">
	<font color="#000099" size="4"><b>Личный кабинет</b></font><br>
	</p>
	<p align=center><font color="#000099" size="3">Логин&nbsp;&nbsp;&nbsp;<input name="login" type="text" size="15">
	<p align=center>Пароль <input name="pass" type="password" size="15"><br><br></font>
	<input name="subm" type="submit" class="butn" value="Вход">
	<input type="button" class="butn" value="Регистрация" onClick="window.location.href =\''.$path.'registration.php\'"></p></form>
	';
   break;
   case 1: 
	echo '
	Здравствуйте, уважаемый(ая) <center><b>'.$_SESSION["fam"].' '.$_SESSION["imya"].'</b></center>';
   break;
}
}

$pos=strpos($_SERVER['SCRIPT_FILENAME'],'index.php');
if ($pos !== false)
	$path='lk/';
else 
	$path='../lk/';	

if (!$_POST&!$_SESSION|empty($_POST['login'])&empty($_POST['pass'])&empty($_SESSION['id'])) {
echo_form(0,$path);
}else 
{

	if (empty($_SESSION["id"]))  
	{
		include ($path."infc.php");
		$dbcnx = mysql_connect($dblocation, $dbuser, $dbpasswd);
		mysql_select_db($dbname) or die ('Не могу выбрать БД');
		$result=mysql_query ("SELECT * FROM accounts WHERE name='".$_POST['login']."'");
		$db=mysql_fetch_array($result);
		$pw=$db['pass'];
		$lvl=$db['lvl'];
		$id=$db['id'];
		if (($id > 0)&($_POST['pass']==$pw)) 
		{
			$result=mysql_query("SELECT * FROM inform_data WHERE id='".$id."'");
			$db=mysql_fetch_array($result);

			$_SESSION['id']=$id;
			$_SESSION['name']=$_POST['login'];
			$_SESSION['imya']=$db['nm'];
			$_SESSION['fam']=$db['fio'];
			$_SESSION['lvl']=$lvl;

			echo_form(1,$path);
			echo '<script type="text/javascript">window.location.href=\'../index.php\'</script>';

		} 
		else {
			echo_form(0,$path);
			echo "<script type='text/javascript'>window.onload=function(){alert('Вы обязаны ввести правильные login ID и пароль для доступа к этому ресурсу');}</script>";
			session_destroy();
		}
    } else 
		echo_form(1,$path);
}
echo '</td>
		</tr>
		</table>
		</body>
		</html>';
} else {header("Location: ../index.php");}
?>