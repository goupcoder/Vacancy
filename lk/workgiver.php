<?php
session_start();

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
include('login.php');
echo'
</td>
</tr>
<tr height='.($_SESSION['id']>0?'"69"':'height="0"').'>
<td width="200" rowspan=2 valign="top">';
include "lmenu.php"; 
echo '</td>
<td>
';
include ('lkm.php');
echo '</td>
</tr><tr>
<td valign="top">
<font size="4">
<span style="font-family: \'Times New Roman\',serif">
<p style="text-align: left"> 	Уважаемые работодатели! Старооскольский филиал 
Белгородского Национального Исследовательского университета приглашает Вас к 
сотрудничеству в вопросах подготовки квалифицированных кадров, содействия 
занятости и трудоустройству наших выпускников.</p>
<p style="text-align: left"> 	&nbsp;</p>
<p style="text-align: left"> 	В этом разделе Вы сможете получить информацию:</p>
<ul>
	<li>
	<p style="text-align: left">о возможных формах сотрудничества с 
	университетом&nbsp;</p></li>
	<li>
	<p style="text-align: left">событиях и мероприятиях, которые организует вуз 
	в целях содействия трудоустройству своих выпускников</p></li>
	<li>
	<p style="text-align: left">осуществить поиск необходимых вам молодых специалистов через банк резюме студентов и 
	выпускников</p></li>
</ul>
<p style="text-align: left">Студенческий отдел кадров
готов оказать Вам необходимую помощь и поддержку в вопросах подбора кадров по 
Вашей заявке, организации встреч и презентаций со студентами и выпускниками, 
взаимодействия с выпускающими кафедр по интересующим Вас специальностям.</p>
</span></font>

</td>
</tr>
</table>
</body>
</html>';
?>