<?php
session_start();

if (($_SESSION['id']>0)&!empty($_GET['id_rezume'])|!empty($_GET['id_vacancy'])) {
echo '
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link rel="stylesheet" href="css/style.css">
<title>СОФ НИУ БелГУ трудоустройство выпускников</title>
<script type="text/javascript" src="../css/jquery.js"></script>
<link rel="stylesheet" href="css/horizontal.css" tppabs="css/horizontal.css">
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
include('login.php');
echo'
</td>
</tr>
<tr height="69">
<td width="200" rowspan=2 valign="top">';
include "lmenu.php"; 
echo '</td>
<td><div class="back">
<input type="button" class="butn" value="Назад" onclick="history.back()">
</div>
';
include ('lkm.php');
echo '</td>
</tr><tr>
<td valign="top">
<center>
<ul class="clearfix" style="list-style:none;">
';

include('infc.php');
$dbcnx = mysql_connect($dblocation, $dbuser, $dbpasswd);
mysql_select_db($dbname) or die ('Не могу выбрать БД');

include 'safemysql.class.php';
$db = new safeMysql();

if (!empty($_GET['id_vacancy'])&$_GET['id_vacancy']>0) 
{
	$sql= "SELECT SQL_CALC_FOUND_ROWS vacancies.*, inform_data.*, workgiver_data.*,(SELECT spheres.nm FROM spheres WHERE spheres.id=workgiver_data.sphere),(SELECT dolgnosti.nm FROM dolgnosti WHERE dolgnosti.id=vacancies.dolgnost_id) FROM vacancies LEFT JOIN inform_data ON vacancies.workgiver_id = inform_data.id LEFT JOIN workgiver_data ON vacancies.workgiver_id = workgiver_data.id WHERE vacancies.id=".$_GET['id_vacancy'];
	$data = $db->getAll($sql);
	foreach ($data as $key=>$val) {
		$dy = substr($data[$key][3],0,4);
        $dm = substr($data[$key][3],5,2);
        $dd = substr($data[$key][3],8,2);
		echo "<table class='watch_php' border=0 style=\"font-size:12pt;color:white;\">
		<tr><td width=\"200\"><span>Организация: </span><td><small>".$data[$key][14]."</small><br>
		<tr><td width=\"200\"><span>Требуется: </span><td><small>".(!empty($data[$key][17])?$data[$key][17]:$data[$key][1])."</small><br>		
		<tr><td><span>Сфера деятельности: </span><td><small>".$data[$key][16]."</small><br>
		<tr><td colspan=2><span>Контактные данные: </span><br>
		<tr><td><span>Фамилия: </span><td><small>".$data[$key][7]."</small><br>
		<tr><td><span>Имя: </span><td><small>".$data[$key][8]."</small><br>
		<tr><td><span>Адрес: </span><td><small>".$data[$key][12]."</small><br>
		<tr><td><span>Телефон: </span><td><small>".$data[$key][11]."</small>&nbsp;&nbsp;&nbsp;
		<tr><td><span>E-mail: </span><td><small>".$data[$key][10]."</small><br>
		<tr><td colspan=2><p align=right style='margin:1px;'><span>Дата публикации: </span><small>".$dd.'.'.$dm.'.'.$dy."</small><br>
		</table>";
	}
}else if (!empty($_GET['id_rezume'])&$_GET['id_rezume']>0) 
{
	$sql= "SELECT SQL_CALC_FOUND_ROWS student_data.*, inform_data.* FROM student_data LEFT JOIN inform_data ON student_data.id = inform_data.id WHERE student_data.id=".$_GET['id_rezume'];
	$data = $db->getAll($sql);
	foreach ($data as $key=>$val) {
		$dy = substr($data[$key][1],0,4);
        $dm = substr($data[$key][1],5,2);
        $dd = substr($data[$key][1],8,2);
		$dy1 = substr($data[$key][10],0,4);
        $dm1 = substr($data[$key][10],5,2);
        $dd1 = substr($data[$key][10],8,2);
		
		$sql= "SELECT name FROM specialnosti WHERE id=".$data[$key][2];
		$data1 = $db->getAll($sql);

		echo "<table class='watch_php' border=0 style=\"font-size:12pt;color:white;\">
		<tr><td width=\"200\"><span>ФИО:</span><td><small>".$data[$key][12]." ".$data[$key][13]." ".$data[$key][14]."</small><br>
		<tr><td><span>Дата рождения: </span><td><small>".$dd.'.'.$dm.'.'.$dy."</small><br>
		<tr><td><span>Специальность: </span><td><small>".$data1[0][0]."</small><br>
		<tr><td><span>Год окончания: </span><td><small>".$data[$key][3]."</small><br>		
		<tr><td><span>Знание иностранных языков: </span><td><small>".$data[$key][4]."</small><br>
		<tr><td><span>Профессиональные навыки: </span><td><small>".$data[$key][5]."</small><br>
		<tr><td><span>Интересы, увлечения: </span><td><small>".$data[$key][6]."</small><br>
		<tr><td><span>Владение ПК: </span><td><small>".$data[$key][7]."</small><br>
		<tr><td><span>Спортивные достижения: </span><td><small>".$data[$key][8]."</small><br>		
		<tr><td colspan=2><span>Контактные данные: </span><br>
		<tr><td><span>Адрес: </span><td><small>".$data[$key][17]."</small><br>
		<tr><td><span>Телефон: </span><td><small>".$data[$key][16]."</small>&nbsp;&nbsp;&nbsp;
		<tr><td><span>E-mail: </span><td><small>".$data[$key][15]."</small><br>
		<tr><td colspan=2><p align=right style='margin:1px;'><span>Дата публикации: </span><small>".$dd1.'.'.$dm1.'.'.$dy1."</small><br>
		</table>";
	}	
}

echo '</ul></center>
</td>
</tr>
</table>		
</body>
</html>';
} else {header("Location: search.php");}
?>