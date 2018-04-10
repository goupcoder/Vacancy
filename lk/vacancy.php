<?php
session_start();

if (($_SESSION['id']>0)&($_SESSION['lvl']==1)) {
echo '
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>СОФ НИУ БелГУ трудоустройство выпускников</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/javascript">
function rset(str){
var inputs = document.dopreg.getElementsByTagName(str);
for (i=0;i<=inputs.length-1;i++)
{
	if ((inputs[i].type != \'button\')&(inputs[i].type != \'submit\')) inputs[i].value="";
}
}
function rset_select(){
var inputs = document.dopreg.getElementsByTagName(\'SELECT\');
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
  <style>
   a img {
    border: none; 
   }
   td.list{
   border-bottom:1px solid black;
   padding-top:5px;
   }
  </style>
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
<td>
';
include ('lkm.php');
echo '</td>
</tr><tr>
<td valign="top">
<span style="font-family: \'Times New Roman\',serif"><font size="4">
<p align=center>Список вакансий</p><hr>
<p align=center><input type="button" onclick="window.location.href=\'manage_vacancy.php\'" value="Добавить"  class="butn">
<br><br><table border="0" width="100%" cellspacing="0">';
include ("infc.php");
$dbcnx = mysql_connect($dblocation, $dbuser, $dbpasswd);
mysql_select_db($dbname) or die ('Не могу выбрать БД');
$res=mysql_query("SELECT txt,active,date,id,dolgnost_id,(SELECT dolgnosti.nm FROM dolgnosti WHERE dolgnosti.id=vacancies.dolgnost_id) as nm FROM vacancies WHERE workgiver_id=".$_SESSION['id']." ORDER BY date DESC");
$i=1;
while ($db=mysql_fetch_row($res)) {
	$dy = substr($db[2],0,4);
	$dm = substr($db[2],5,2);
	$dd = substr($db[2],8,2);
	echo '<tr><td rowspan="2" width="20" class="list">'.($db[1]==1 ? '<a href="manage_vacancy.php?stop='.$db[3].'"><img alt="Закрыть вакансию" src="../image/stop':'<a href="manage_vacancy.php?accept='.$db[3].'"><img alt="Открыть вакансию" src="../image/accept').'.jpg" width="20" height="20"></a></td>
	<td rowspan="2" width="20" class="list"><a href="manage_vacancy.php?edit='.$db[3].'"><img alt="Редактировать вакансию" src="../image/edit.gif" width="20" height="20"></a></td><td width="20">'.$i.'.</td><td>'.($db[4]>0?$db[5]:$db[0]).'</td></tr>
	<tr><td class="list">&nbsp;</td><td class="list"><font size="2" color="gray">'.$dd.'.'.$dm.'.'.$dy.'</font></td></tr>';
	$i++;
}
echo '</table></font></span></td>
		</tr>
		</table>
		</body>
		</html>';
} else {header("Location: loginpage.php");}
?>