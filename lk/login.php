<?php
function echo_form($i,$path) 
{
switch($i) {
   case 0: 
	echo '
	<div style="color:#000099;position:absolute;display:inline-block;top:42px;right:15px;background-color:rgba(240,240,240,.7);padding:5px 25px;border-radius: 10px;"> 
	<form name=log action="?" method="POST">
	<p align="center">
	<font color="#000099" size="4"><b>Личный кабинет</b></font><br>
	</p>
	<p align=center><font color="#000099" size="3">Логин&nbsp;&nbsp;&nbsp;<input name="login" type="text" size="15">
	<p align=center>Пароль <input name="pass" type="password" size="15"><br><br></font>
	<input name="subm" type="submit" class="butn" value="Вход">
	<input type="button" class="butn" value="Регистрация" onClick="window.location.href =\''.$path.'registration.php\'"></p></form>
	</div>';
   break;
   case 1: 
	echo '
	<div style="color:#000099;position:absolute;display:inline-block;top:45px;right:15px;background-color:rgba(240,240,240,.7);padding:62px 10px;border-radius: 10px;"> 
	Здравствуйте, уважаемый(ая) <center><b>'.$_SESSION["fam"].' '.$_SESSION["imya"].'</b></center>
	</div>';
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
		} 
		else {
			echo_form(0,$path);
			echo "<script type='text/javascript'>window.onload=function(){alert('Вы обязаны ввести правильные login ID и пароль для доступа к этому ресурсу');}</script>";
			session_destroy();
		}
    } else 
		echo_form(1,$path);
}
?>