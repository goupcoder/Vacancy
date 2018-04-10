<?php
session_start();

if ($_SESSION['id']>0) {
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
<td valign="top"><span style="font-family: \'Times New Roman\',serif"><font size="4">
';
include ("infc.php");
$dbcnx = mysql_connect($dblocation, $dbuser, $dbpasswd);
mysql_select_db($dbname) or die ('Не могу выбрать БД');

if (isset($_POST['address'])&isset($_POST['phone']))
{
	if (mysql_query("UPDATE inform_data SET phone='".$_POST['phone']."', address='".$_POST['address']."' WHERE id=".$_SESSION['id'],$dbcnx))	
	{
		switch ($_SESSION['lvl']) 
		{
			case 0:mysql_query("UPDATE student_data SET public=1,date_publ='".date('Y-m-d')."', date_rozd='".$_POST['yyyy']."-".$_POST['mm']."-".$_POST['mm']."', specialnost=".$_POST['D1'].", god_okonch='".$_POST['D2']."', inyaz='".$_POST['yaz']."', navyki='".$_POST['text1']."', interesy='".$_POST['text2']."', pk='".$_POST['pk']."', sport='".$_POST['text']."' WHERE id=".$_SESSION['id'],$dbcnx);
			break;
			case 1:mysql_query("UPDATE workgiver_data SET nm_org='".$_POST['name_org']."', sphere='".$_POST['sphera']."' WHERE id=".$_SESSION['id'],$dbcnx);
			break;
		}	
	}
	if (!mysql_error($dbcnx)) 
		if ($_SESSION['lvl']==0) 
			echo '<p align=center>Ваша резюме успешно составлено. Перейти к поиску <a href="../search.php">вакансий</a>, или на <a href="index.php">главную</a>
			<script type="text/javascript">window.location.href=\'search.php\'</script>';
		else if ($_SESSION['lvl']==1)
			echo '<p align=center>Дополнительные данные успешно добавлены. Перейти к подбору <a href="../search.php">специалиста</a>, или на <a href="index.php">главную</a>
			<script type="text/javascript">window.location.href=\'search.php\'</script>';		
	else
		echo '<p align=center><font color="red">Ошибка сохранения. Повторите ввод.</font>
		<script type="text/javascript">window.location.href=\'dopreg.php\'</script>';

}
else
{
		$res=mysql_query("SELECT address,phone FROM inform_data WHERE id=".$_SESSION['id']);
		$ddbb=mysql_fetch_row($res);

		if ($_SESSION['lvl'] == 0)
		{
			$res=mysql_query("SELECT date_rozd,specialnost,god_okonch,inyaz,navyki,interesy,pk,sport FROM student_data WHERE id=".$_SESSION['id']);
			$ddb=mysql_fetch_row($res);
			$dy = substr($ddb[0],0,4);
            $dm = substr($ddb[0],5,2);
            $dd = substr($ddb[0],8,2);
			echo '<p align=center>Резюме</p><hr>
				<center><form name=dopreg action="#" method="POST">
				<table width="50%" cellpadding="5" border="1" cols="2"><tr>
				<TD>Дата рождения</TD><TD>
				<input type="text" name="dd" onkeypress="return check(event,this,\'31\')" size="2" value="'.($dd!=0?$dd:'').'">д.&nbsp;
				<input type="text" name="mm" size="2" onkeypress="return check(event,this,\'12\')" value="'.($dm!=0?$dm:'').'">м.&nbsp;
				<input type="text" name="yyyy" size="4" onkeypress="return check(event,this,\'2099\')" value="'.($dy!=0?$dy:'').'">г.</TD> 
				</tr>
				<tr>
				<TD>Адрес</TD> <TD><input type="text" name="address" size="58" value="'.$ddbb[0].'"></TD>
				</tr>
				<tr>
				<TD>Номер телефона</TD> <TD><input type="text" name="phone" size="58" value="'.$ddbb[1].'"></TD>
				</tr>
				<tr>
				<TD>Специальность</TD> <TD><select name="D1"><option disabled>Выберите специальность...</option>';
				$res=mysql_query("SELECT name FROM specialnosti");
				$g=1;
				while($db=mysql_fetch_row($res))
				{
					echo '<option value="'.$g.'"'.($g==$ddb[1] ? 'selected':'').'>'.$db[0].'</option>';
					$g++;
				}
			echo '</select></TD>
				</tr>
				<tr>
				<TD>Год окончания</TD> <TD><select name="D2">';
				for ($g=date('Y');$g>=2000;$g--) 				
				  echo '<option value="'.$g.'"'.($g==$ddb[2] ? 'selected':'').'>'.$g.'</option>';
			echo '</select></TD>
				</tr>
				<tr>
				<TD>Иностранные языки</TD> <TD><input type="text" name="yaz" size= "58" value="'.$ddb[3].'"></TD>
				</tr>
				<tr>
				<TD>Профессиональные навыки</TD> <TD><textarea rows="10" cols="45" name="text1">'.$ddb[4].'</textarea></TD>
				</tr>
				<tr>
				<TD>Интересы, увлечения</TD> <TD><textarea rows="10" cols="45" name="text2">'.$ddb[5].'</textarea></TD>
				</tr>
				<tr>
				<TD>Владение ПК</TD> <TD><input type="text" name="pk" size="58" value="'.$ddb[6].'"></TD>
				</tr>
				<tr>
				<TD>Спортивные достижения</TD> <TD><textarea rows="10" cols="45" name="text">'.$ddb[7].'</textarea></TD>
				</tr>				 
				</TABLE>
				<p align=center><input type="submit" value="Сохранить"  class="butn">&nbsp;&nbsp;&nbsp;
				<input type="button" onclick="rset(\'TEXTAREA\');rset(\'INPUT\');rset_select()" value="Очистить"  class="butn">&nbsp;&nbsp;&nbsp;
				<input type="button"  class="butn" value="Отмена" onclick="window.location.href=\'../index.php\'">
				</form></center>';
				}
		else if ($_SESSION['lvl'] == 1)
		{
			$res=mysql_query("SELECT nm_org,sphere FROM workgiver_data WHERE id=".$_SESSION['id']);
			$db=mysql_fetch_row($res);		
			echo '<p align=center>Дополнительные сведения о работодателе</p><hr>
				<center><form name=dopreg action="#" method="POST">
				<table width="50%" cellpadding="5" border="1" cols="2"><tr>
				<TD>Наименование организации</TD><TD><input type="text" name="name_org" size="58" value="'.$db[0].'"></TD> 
				</tr>
				<tr>
				<TD>Номер телефона</TD><TD><input type="text" name="phone" size="58" value="'.$ddbb[1].'"></TD>
				</tr>
				<tr>
				<TD>Адрес</TD><TD><input type="text" name="address" size="58" value="'.$ddbb[0].'"></TD>
				</tr>
				<tr>
				<TD>Сфера деятельности</TD><TD>
				<select name="sphera"><option '.($db[1]>0 ?'disabled':'').'>Выберите сферу деятельности';
				$res=mysql_query("SELECT * FROM spheres");
				$i=1;
				while ($db1=mysql_fetch_row($res))
					echo '<option value="'.$db1[0].'" '.($db[1]==$i++?'selected':'').'>'.$db1[1];				
				echo '</select>
				</TD>
				</tr>				 				
				</TABLE>
				<p align=center><input type="submit" value="Сохранить" class="butn">&nbsp;&nbsp;&nbsp;
				<input type="button" onclick="rset(\'TEXTAREA\');rset(\'INPUT\')" value="Очистить" class="butn">&nbsp;&nbsp;&nbsp;
				<input type="button" class="butn" value="Отмена" onclick="window.location.href=\'../index.php\'">
				</form></center>';
		}
}
		echo '</font></span></td>
		</tr>
		</table>
		</body>
		</html>';
} else {header("Location: loginpage.php");}
?>