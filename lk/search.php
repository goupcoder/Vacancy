<?php
session_start();

echo '
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link rel="stylesheet" href="css/style.css">
<title>СОФ НИУ БелГУ трудоустройство выпускников</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/javascript" src="../css/jquery.js"></script>
<link rel="stylesheet" href="css/horizontal.css" tppabs="css/horizontal.css">
<script type="text/javascript">
function showcheck(){
var pr=document.vac;
if ( pr.profession.selectedIndex != -1)
if (pr.profession.selectedIndex==pr.profession.options.length-1)
{
	pr.prof.style.display=\'block\';
	pr.prof.focus();
}
else{
	pr.prof.style.display=\'none\';
	pr.prof.value="";
}

}
function rset(){
for (j=0;j<=document.forms.length-1;j++)
{
var inputs = document.forms[j].getElementsByTagName("INPUT");
for (i=0;i<=inputs.length-1;i++)
{
	if ((inputs[i].type != \'button\')&(inputs[i].type != \'submit\')) inputs[i].value="";
}
}
document.vac.prof.style.display=\'none\';
}
function rset_select(){
for (j=0;j<=document.forms.length-1;j++)
{
var inputs = document.forms[j].getElementsByTagName(\'SELECT\');
for (i=0;i<=inputs.length-1;i++)
	inputs[i].selectedIndex=0;
}
}
function SelRadio(radioName){
            var radios  = document.getElementsByName(radioName);
            for(var k = 0; k < radios.length; k++){
                if(radios[k].type == "radio"){
                    if(radios[k].checked)  
						return radios[k].value;		                  
                }
            }
            if (k==radios.length) k=-1;
            return k;
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
<p>
<form action="?" method="get" name="vac" '.((isset($_SESSION['id'])&$_SESSION['lvl'] == 1) ?'style="display:none;"':'').'>
<table><tr><td valign=top>
<p align=left>Должность</td><td><select name="profession" onchange="showcheck()" style="width:400px"><option value="" '.($_GET['profession']>0 ?'disabled':'').'>Выберите должность';
include ("infc.php");
$dbcnx = mysql_connect($dblocation, $dbuser, $dbpasswd);
mysql_select_db($dbname) or die ('Не могу выбрать БД');				
$res=mysql_query("SELECT * FROM dolgnosti",$dbcnx);
$i=1;
while ($db=mysql_fetch_row($res))
	echo '<option value="'.$db[0].'" '.($_GET['profession']==$i++?'selected':'').'>'.$db[1];				
echo '<option value="">Другая должность</option></select>
<p style="margin-top:10px;"><input name="prof" placeholder="Введите другую должность" size=63 '.(empty($_GET['prof'])?'style="display:none;"':'value='.$_GET['prof']).'>
</tr>
<tr><td><p align=left>Сфера деятельности</td><td>
<select name="sphera" style="width:400px"><option value="" '.($_GET['sphera']>0 ?'disabled':'').'>Выберите сферу деятельности';
$res=mysql_query("SELECT * FROM spheres");
$i=1;
while ($db1=mysql_fetch_row($res))
	echo '<option value="'.$db1[0].'" '.($_GET['sphera']==$i++?'selected':'').'>'.$db1[1];				
echo '</select>
</tr></table>
<p align=left><input type="submit" value="Поиск" id="form-search" class="butn">&nbsp;<input type="button" value="Очистить" onclick="rset_select();rset();" class="butn"><p><p>
</form>
<form action="?" method="get" id="stud" '.((!isset($_SESSION['id'])|$_SESSION['lvl'] == 0) ? 'style="display:none;"':'').'>
<table><tr><td>
<p align=left>Специальность</td><td><select name="specialnost" id="input-specialnost">
<option value="0">Выберите специальность...</option>';
include("infc.php"); 
$dbcnx = mysql_connect($dblocation, $dbuser, $dbpasswd);
mysql_select_db($dbname) or die ('Не могу выбрать БД');
$res=mysql_query("SELECT * FROM specialnosti");
$g=1;
if (!empty($_GET['specialnost']))  $specialnost=$_GET['specialnost'];
while($db=mysql_fetch_row($res))
{
	echo '<option value="'.$g.'"'.($db[0]==$specialnost?'selected':'').'>'.$db[1].'</option>';
	$g++;
}
echo '</select></tr>
<tr><td><p align=left><label for="input-inyaz">Знание иностранных языков</label></td><td><input type="checkbox" name="inyaz" id="input-inyaz" value="';
if (!empty($_GET['inyaz'])) echo $_GET['inyaz'];
echo '"></tr>
<tr><td><p align=left><label for="input-pk">Владение ПК</label></td><td><input type="checkbox" name="pk" id="input-pk" value="';
if (!empty($_GET['pk'])) echo $_GET['pk'];
echo '"></tr>
</table>
<p align=left><input type="submit" value="Поиск" id="form-search" class="butn" >&nbsp;<input type="button" class="butn" value="Очистить" onclick="rset_select();rset();"><p><p>
</form><hr>
<div id="block-search-result">
<ul id="list-search-result"  style="list-style:none;">
</ul>
</div>
<center>
<div class="clearfix">
<ul class="clearfix" style="list-style:none;">
';

include('infc.php');
$dbcnx = mysql_connect($dblocation, $dbuser, $dbpasswd);
mysql_select_db($dbname) or die ('Не могу выбрать БД');

include 'safemysql.class.php';
$db = new safeMysql();

$per_page = 10;

//получаем номер страницы и значение для лимита 
$cur_page = 1;
if (isset($_GET['page']) && $_GET['page'] > 0) 
{
    $cur_page = $_GET['page'];
}
$start = ($cur_page - 1) * $per_page;

//выполняем запрос и получаем данные для вывода
$sql= "SELECT SQL_CALC_FOUND_ROWS vacancies.*, workgiver_data.*,(SELECT spheres.nm FROM spheres WHERE spheres.id=workgiver_data.sphere),(SELECT dolgnosti.nm FROM dolgnosti WHERE dolgnosti.id=vacancies.dolgnost_id) FROM vacancies LEFT JOIN workgiver_data ON vacancies.workgiver_id = workgiver_data.id WHERE vacancies.active=1";
if (!empty($_GET['profession'])) 
{
	$sql .= " AND (vacancies.dolgnost_id='".$_GET['profession']."'";
	$fl=true;
}
if (!empty($_GET['prof'])) 
{
if ($fl)
	$sql .= " OR vacancies.txt LIKE '%".$_GET['prof']."%')";
else
	$sql .= " AND vacancies.txt LIKE '%".$_GET['prof']."%'";
}
else if (!empty($_GET['profession'])) 
	$sql .= ")";
if (!empty($_GET['sphera'])) 
{
	$sql .= " AND workgiver_data.sphere='".$_GET['sphera']."'"; 
}
$sql .= " ORDER BY vacancies.date DESC LIMIT ?i, ?i";
if ($_SESSION['lvl']==1) {
$sql= "SELECT SQL_CALC_FOUND_ROWS student_data.*, inform_data.* FROM student_data LEFT JOIN inform_data ON student_data.id = inform_data.id WHERE student_data.public=1";
if (!empty($_GET['inyaz'])) {
	$sql .= " AND student_data.inyaz LIKE '%'";	
}		
if (!empty($_GET['pk'])) {
	$sql .= " AND student_data.pk LIKE '%'";
}		
if (!empty($_GET['specialnost'])) {
	$sql .= " AND student_data.specialnost=".$_GET['specialnost'];	
}	
$sql .= " ORDER BY student_data.date_publ DESC LIMIT ?i, ?i";
}

$data = $db->getAll($sql, $start, $per_page);
$rows = $db->getOne("SELECT FOUND_ROWS()");

//узнаем общее количество страниц и заполняем массив со ссылками
$num_pages = ceil($rows / $per_page);

// зададим переменную, которую будем использовать для вывода номеров страниц
$page = 0;
if (!isset($_SESSION['id'])) {
	foreach ($data as $key=>$val) {
		$dy = substr($data[$key][3],0,4);
        $dm = substr($data[$key][3],5,2);
        $dd = substr($data[$key][3],8,2);
		echo "<a style=\"cursor:pointer;\" onclick=\"alert('Для подробного просмотра необходимо зарегистрироваться')\"><li> <div border=0 style=\"font-size:12pt;background:url('images/image.jpg')no-repeat scroll top center rgba(0, 0, 0, 0);height: 250px;width: 100%;\">
		<div class='slider-desc'>
		<span>Организации </span><small>".$data[$key][7]."</small><br>
		<span>Требуется: </span><small>".(!empty($data[$key][10])?$data[$key][10]:$data[$key][1])."</small><br>
		<span>Сфера деятельности: </span><small>".$data[$key][9]."</small><br>
		<p align=right style='margin:1px;'><span>Дата публикации: </span><small>".$dd.'.'.$dm.'.'.$dy."</small><br>
		</div></div></li></a>";
	}
}else if ($_SESSION['lvl']==0) {
	foreach ($data as $key=>$val) {
		$dy = substr($data[$key][3],0,4);
        $dm = substr($data[$key][3],5,2);
        $dd = substr($data[$key][3],8,2);
		echo "<a href=\"watch.php?id_vacancy=".$data[$key][0]."\"><li> <div border=0 style=\"font-size:12pt;background:url('images/image.jpg')no-repeat scroll top center rgba(0, 0, 0, 0);height: 250px;width: 100%;\">
		<div class='slider-desc'>
		<span>Организации </span><small>".$data[$key][7]."</small><br>
		<span>Требуется: </span><small>".(!empty($data[$key][10])?$data[$key][10]:$data[$key][1])."</small><br>
		<span>Сфера деятельности: </span><small>".$data[$key][9]."</small><br>
		<p align=right style='margin:1px;'><span>Дата публикации: </span><small>".$dd.'.'.$dm.'.'.$dy."</small><br>
		</div></div></li></a>";
	}
}else if ($_SESSION['lvl']==1) {	  
	foreach ($data as $key=>$val) {
		$dy = substr($data[$key][1],0,4);
        $dm = substr($data[$key][1],5,2);
        $dd = substr($data[$key][1],8,2);
		$dy1 = substr($data[$key][10],0,4);
        $dm1 = substr($data[$key][10],5,2);
        $dd1 = substr($data[$key][10],8,2);
		
		$sql= "SELECT name FROM specialnosti WHERE id=".$data[$key][2];
		$data1 = $db->getAll($sql);
		
		echo "<a href=\"watch.php?id_rezume=".$data[$key][0]."\"><li> <div border=0 style=\"font-size:12pt;background:url('images/image.jpg')no-repeat scroll top center rgba(0, 0, 0, 0);height: 250px;width: 100%;\">
		<div class='slider-desc'>
		<span>ФИО:</span><small>".$data[$key][12]." ".$data[$key][13]." ".$data[$key][14]."</small><br>
		<span>Дата рождения: </span><small>".$dd.'.'.$dm.'.'.$dy."</small><br>
		<span>Специальность: </span><small>".$data1[0][0]."</small><br>
		<span>Контактные данные: </span><br>
		<span>Адрес: </span><small>".$data[$key][17]."</small><br>
		<span>Телефон: </span><small>".$data[$key][16]."</small>&nbsp;&nbsp;&nbsp;
		<span>E-mail: </span><small>".$data[$key][15]."</small><br>
		<p align=right style='margin:1px;'><span>Дата публикации: </span><small>".$dd1.'.'.$dm1.'.'.$dy1."</small><br>
		</div></div></li></a>";
	}
}
if ($rows!=0)
{
echo '<li>Страницы: ';
while ($page++ < $num_pages)
 if ($page == $cur_page)
	echo '[<b>'.$page.'</b>]';
 else 
	echo '[<a href="?page='.$page.(!empty($_GET['profession'])?'&profession='.$_GET['profession']:'').(!empty($_GET['prof'])?'&prof='.$_GET['prof']:'').(!empty($_GET['sphera'])?'&sphera='.$_GET['sphera']:'').'">'.$page.'</a>]';
echo '</li>';
}

echo '</ul></center>
</div>
</td>
</tr>
</table>		
</body>
</html>';

?>