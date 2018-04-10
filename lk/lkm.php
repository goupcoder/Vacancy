<?php
if ($_SESSION['id'] > 0){
echo '<div style="padding:10px;border-radius: 20px;background-color:#DDDDEE;">
	   <table width="50%" cellpadding="5" border="0" align=center>';
if ($_SESSION['lvl'] == 0){
	echo '<tr> 
	<TD><input type="button" class="butn" value="Составить/редактировать резюме" onClick="window.location.href =\''.$path.'dopreg.php\'"></TD>
	<TD><input type="button" class="butn" value="Список работодателей" onClick="window.location.href =\''.$path.'workgivers_list.php\'"></TD>
	<TD><input type="button" class="butn" value="Найти работу" onClick="window.location.href =\''.$path.'search.php\'"></TD>
	<TD><input type="button" class="butn" value="Выход" onClick="window.location.href =\''.$path.'destroy.php\'"></TD>
	</tr>';
}else if ($_SESSION['lvl'] == 1)
	echo '<tr>
	<TD><input type="button" class="butn" value="Дополнительные сведения" onClick="window.location.href =\''.$path.'dopreg.php\'"></TD>
	<TD><input type="button" class="butn" value="Разместить/редактировать вакансии" onClick="window.location.href =\''.$path.'vacancy.php\'"></TD>
	<TD><input type="button" class="butn" value="Поиск резюме" onClick="window.location.href =\''.$path.'search.php\'"></TD>
	<TD><input type="button" class="butn" value="Выход" onClick="window.location.href =\''.$path.'destroy.php\'"></TD>
	';
echo '</TABLE></div>';
}
?>