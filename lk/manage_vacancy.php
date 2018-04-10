<?php
session_start();

if (($_SESSION['id']>0)&($_SESSION['lvl']==1)) {
include ("infc.php");
$dbcnx = mysql_connect($dblocation, $dbuser, $dbpasswd);
mysql_select_db($dbname) or die ('Не могу выбрать БД');
if (isset($_GET['stop']))
{
	mysql_query("UPDATE vacancies SET active=0 WHERE id=".$_GET['stop'],$dbcnx);
	header("Location: vacancy.php");
}
else if (isset($_GET['accept']))
{
	mysql_query("UPDATE vacancies SET active=1 WHERE id=".$_GET['accept'],$dbcnx);
	header("Location: vacancy.php");
}
echo '
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>СОФ НИУ БелГУ трудоустройство выпускников</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/javascript">
function inviz() {
document.vacancy_add.vacancy_text.style.display =\'block\';
}
function disabl() {
document.vacancy_add.check.checked =false;
}
function rset(str){
var inputs = document.vacancy_add.getElementsByTagName(str);
for (i=0;i<=inputs.length-1;i++)
{
	if ((inputs[i].type != \'button\')&(inputs[i].type != \'submit\')) {
		 inputs[i].checked=false;
		 inputs[i].value="";
	}	
}
}
function rset_select(){
var inputs = document.vacancy_add.getElementsByTagName(\'SELECT\');
for (i=0;i<=inputs.length-1;i++)
	inputs[i].selectedIndex=0;
}
function check (e,obj,str){
 e = e || window.event; 
 var code = e.keyCode || e.which;
 if(code == 8 || code == 37 || code == 39 || code == 46)
 //бэкспейс, стрелки, делит. добавь, что еще нужно
   return true;
 var char = String.fromCharCode(code);
 var t = char.match(/[0-9]/);
 if ((parseInt(t)>=0)&(parseInt(t)<=9)) f=true;
 if (f&parseInt(obj.value+char)<=parseInt(str)) return true;	
 return false;

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
include('login.php');
echo'
</td>
</tr>
<tr height="69">
<td width="200" rowspan=2 valign="top">';
include "lmenu.php"; 
echo '</td>
<td valign="top"><div class="back">
<input type="button" class="butn" value="Назад" onClick="window.location.href=\'vacancy.php\'">
</div>
';
include ('lkm.php');
echo '</td>
</tr><tr>
<td valign="top">
<span style="font-family: \'Times New Roman\',serif"><font size="4">

';
if (!isset($_GET['edit'])&$_POST['vacancy']>0&!isset($_POST['check']))
{
	if (mysql_query("INSERT INTO vacancies (dolgnost_id,txt,active,date,workgiver_id) VALUES ('".$_POST['vacancy']."','', 1, '".date("Y-m-d")."', '".$_SESSION['id']."')",$dbcnx))	
	{
		echo '<p align=center>Ваша вакансия успешно добавлена. Вернуться к <a href="vacancy.php">списку вакансий</a>.
		<script type="text/javascript">window.location.href=\'vacancy.php\'</script>';
	}	
} 
else if (!isset($_GET['edit'])&isset($_POST['check'])&!empty($_POST['vacancy_text']))
{
	if (mysql_query("INSERT INTO vacancies (dolgnost_id,txt,active,date,workgiver_id) VALUES ('0','".$_POST['vacancy_text']."', 1, '".date("Y-m-d")."', '".$_SESSION['id']."')",$dbcnx))	
	{
		echo '<p align=center>Ваша вакансия успешно добавлена. Вернуться к <a href="vacancy.php">списку вакансий</a>.
		<script type="text/javascript">window.location.href=\'vacancy.php\'</script>';
	}	
}
else if ($_POST['vacancy']>0&!isset($_POST['check'])&isset($_GET['edit']))
{
	if (mysql_query("UPDATE vacancies SET dolgnost_id='".$_POST['vacancy']."',txt='' WHERE id=".$_GET['edit'],$dbcnx))	
	{
		echo '<p align=center>Обновление успешно завершено. Вернуться к <a href="vacancy.php">списку вакансий</a>.
		<script type="text/javascript">window.location.href=\'vacancy.php\'</script>';
	}	

}else if (isset($_POST['check'])&!empty($_POST['vacancy_text'])&isset($_GET['edit']))
{
	if (mysql_query("UPDATE vacancies SET txt='".$_POST['vacancy_text']."',dolgnost_id=0 WHERE id=".$_GET['edit'],$dbcnx))	
	{
		echo '<p align=center>Обновление успешно завершено. Вернуться к <a href="vacancy.php">списку вакансий</a>.
		<script type="text/javascript">window.location.href=\'vacancy.php\'</script>';
	}	

}
else
{
		if (isset($_GET['edit']))
		{
			$res=mysql_query("SELECT txt,dolgnost_id FROM vacancies WHERE workgiver_id=".$_SESSION['id']." AND id=".$_GET['edit']);
			$db1=mysql_fetch_row($res);
		}
			echo '<p align=center>Описание вакансии</p><hr><center><form name=vacancy_add action="#" method="POST">
				<table width="50%" cellpadding="5" border="1" cols="2">
				<tr><TD valign=top>Требуется:</TD><TD>
				<select name="vacancy" onchange="disabl()"><option '.($db1[1]>0 ?'disabled':'').'>Выберите должность';
				$res=mysql_query("SELECT * FROM dolgnosti");
				$i=1;
				while ($db=mysql_fetch_row($res))
					echo '<option value="'.$db[0].'" '.($db1[1]==$i++?'selected':'').'>'.$db[1];				
				echo '</select>';
						
			echo '<p><label><input type="checkbox" name="check" onclick="inviz()" '.(!isset($_GET['edit'])|($db1[1]>0) ? '' : 'checked').'>Другая должность</label>
			<textarea rows="10" cols="45" name="vacancy_text" '.(($db1[1]>0)|!isset($_GET['edit']) ? 'style="display:none;">' : '>'.$db1[0]).'</textarea>';
			echo '</TD>
				</tr>				 				
				</TABLE>
				<p align=center><input type="submit" value="Сохранить" class="butn">&nbsp;&nbsp;&nbsp;
				<input type="button" onclick="rset(\'TEXTAREA\');rset(\'INPUT\');rset_select()" value="Очистить" class="butn">
				</form></center>';
		
}
echo '</font></span></td>
</tr>
</table>
</body>
</html>';
}
else {header("Location: loginpage.php");}
?>