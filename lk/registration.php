<?php
session_start();

if (empty($_SESSION['id'])) {
echo '
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>СОФ НИУ БелГУ трудоустройство выпускников</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/javascript">
function submitform()
{
  if ((document.reg.passwrd.value.length >=4)&(document.reg.passwrd.value==document.reg.passwrd1.value)&(document.reg.login_name.value.length >=4)&(document.reg.surnam.value !="")&(document.reg.nam.value !="")) 
  { 
     document.reg.submit();
   } else {
     alert("Ошибка регистрации. Проверьте правильность ввода.");
   }
}
</script>
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
if (!empty($_POST['login_name'])&($_POST['passwrd']==$_POST['passwrd1'])&!empty($_POST['surnam'])&!empty($_POST['nam']))
{
	$flag=true;
	include ("infc.php");
	$dbcnx = mysql_connect($dblocation, $dbuser, $dbpasswd);
	mysql_select_db('information_schema') or die ('Не могу выбрать БД');
	$res=mysql_query("SELECT AUTO_INCREMENT FROM TABLES WHERE TABLE_SCHEMA='work' AND TABLE_NAME='accounts'");
	$db=mysql_fetch_row($res);
	$id=$db[0];
	mysql_select_db($dbname) or die ('Не могу выбрать БД');
	if (mysql_query("INSERT INTO accounts (name, pass,lvl) VALUES ('".$_POST['login_name']."', '".$_POST['passwrd']."', '".$_POST['r']."')",$dbcnx)&
	mysql_query("INSERT INTO inform_data (id, fio,nm,otch,email) VALUES (".$id.", '".$_POST['surnam']."','".$_POST['nam']."', '".$_POST['otch']."', '".$_POST['pochta']."')",$dbcnx)&
	mysql_query("INSERT INTO ".($_POST['lvl']==0 ? "student":"workgiver")."_data (id) VALUES (".$id.")"))	
	{
		$_SESSION['id']=$id;
		$_SESSION['name']=$_POST['login_name'];
		$_SESSION['imya']=$_POST['nam'];
		$_SESSION['fam']=$_POST['surnam'];
		$_SESSION['lvl']=$_POST['r'];
	}	
	else if (mysql_error($dbcnx))
		$err=true;
}
include('login.php');
echo'
</td>
</tr>
<tr>
<td width="200" rowspan=2 valign="top">';
include "lmenu.php"; 
echo '</td>
<td>
';
include ('lkm.php');
echo '</td>
</tr><tr>
<td valign="top">
<span style="font-family: \'Times New Roman\',serif"><font size="4">';
if ($err) echo '<p align=center><font color="red">Ошибка. Учетная запись с таким именем уже существует.</font>';
if (($_SESSION['id']>0)&$flag)
	echo '<p align=center>Ваша учетная запись успешно зарегистрирована. Перейти на <a href="../index.php">главную</a> страницу.
	<script type="text/javascript">window.location.href=\'../index.php\'</script>';

if (empty($_POST['login_name'])|($_POST['passwrd']!=$_POST['passwrd1'])|empty($_POST['surnam'])|empty($_POST['nam'])|$err){
echo '
<p align=center>Регистрация</p>
<center>
<form name=reg action="#" method="POST">
<table width="50%" cellpadding="5" border="1" cols="2">
<tr> 
<TD>Логин (*/**)</TD> <TD><input type="text" name ="login_name" size = "58"></TD>
</tr> 
<tr> 
<TD>Пароль (*/**)</TD> <TD><input type="password" name="passwrd" size = "58"></TD>
</tr> 
<tr> 
<TD>Подтвердите пароль (*/**)</TD> <TD><input type="password" name="passwrd1" size = "58"></TD>
</tr> 
<tr> 
<TD>Фамилия *</TD> <TD><input type ="text" name ="surnam" size = "58"></TD>
</tr> 
<tr> 
<TD>Имя *</TD> <TD><input type ="text" name ="nam" size = "58"></TD>
</tr> 
<tr>
<TD>Отчество</TD> <TD><input type ="text" name ="otch" size = "58"></TD> 
</tr>
<tr>
<TD>В качестве кого вы регистрируетесь ?</TD> <TD><label><input type ="radio" name ="r" size = "58" value="0" checked>Выпускник</label><br><br><label><input type ="radio" name ="r" size = "58" value="1">Работодатель</label></TD> 
</tr>
<tr>
<TD>e-mail</TD> <TD><input type="text" name="pochta" size = "58"></TD>
</tr>
</TABLE>
<p align=center>*-поля, обязательные для заполнения
<p align=center>**-длина поля не должна быть короче 4 символов
<p><input type="button" name=subm value="Зарегистрироваться" onClick="submitform()" class="butn"> 
<input type="reset" value ="Очистить" class="butn"> 
</form>
</center>';
}

echo '</font></span>
</td>
</tr>
</table>
</body>
</html>';
} else {header("Location: ../index.php");}
?>