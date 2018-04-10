<?php
session_start();

if (($_SESSION['id']>0)&($_SESSION['lvl']==0)) {
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
<p align=center>Список работодателей</p><hr>
<table border="0" width="100%" cellspacing="0">';
include ("infc.php");
$dbcnx = mysql_connect($dblocation, $dbuser, $dbpasswd);
mysql_select_db($dbname) or die ('Не могу выбрать БД');
$res=mysql_query("SELECT inform_data.*,workgiver_data.*,(SELECT spheres.nm FROM spheres WHERE spheres.id=workgiver_data.sphere) FROM inform_data LEFT JOIN workgiver_data ON inform_data.id=workgiver_data.id LEFT JOIN accounts ON accounts.id=inform_data.id WHERE accounts.lvl=1");
$i=1;
while ($db=mysql_fetch_row($res)) {
	echo '<tr><td rowspan=2 width="20" valign=top>'.$i.'.</td><td colspan=2>Организация: <i>'.$db[8].'</i></td><td>Сфера деятельности: <i>'.$db[10].'</i></td></tr>
	<tr><td class="list"><font size="2" color="gray">Адрес: '.$db[6].'</font></td><td class="list"><font size="2" color="gray">Телефон: '.$db[5].'</font></td><td class="list"><font size="2" color="gray">E-mail: '.$db[4].'</font></td></tr>';
	$i++;
}
echo '</table></font></span></td>
		</tr>
		</table>
		</body>
		</html>';
} else {header("Location: loginpage.php");}
?>