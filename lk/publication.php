<?php
session_start();

if ($_SESSION['id']>0) {
		include ("infc.php");
		$dbcnx = mysql_connect($dblocation, $dbuser, $dbpasswd);
		mysql_select_db($dbname) or die ('Не могу выбрать БД');
		if ($_GET['public'] == 1) 
			$i=1;
		else
			$i=0;
		if(mysql_query ("UPDATE student_data SET date_publ='".date('Y-m-d')."',public=".$i." WHERE id=".$_SESSION['id'],$dbcnx))
			header("Location: lk.php");
		else
			echo 'Ошибка. <input type="button" style="height:25px;color:#FFFFFF;background-color:#6D8FB3;text-align:center;border-color:#7E9CBC #5C82AB #5C82AB;border-right:1px solid #5C82AB;" value="Назад" onClick="history.back()">';
}  
else {header("Location: loginpage.php");}
?>