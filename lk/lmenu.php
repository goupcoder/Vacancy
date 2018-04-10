<?php
$pos=strpos($_SERVER['SCRIPT_FILENAME'],'index.php');
if ($pos !== false)
{
	$path_index='';
	$path_no_index='lk/';
}
else 
{
	$path_index='../';
	$path_no_index='';
}
echo '<div style="padding:10px;border-radius: 20px;background-color:#DDDDEE;margin-bottom:10px;">
<table border="0" class="lmenu">
<tr>
<td><a href="'.$path_index.'index.php">Главная страница</a></td>
</tr>
<tr>
<td><a href="'.$path_no_index.'student.php">Выпускникам и студентам</a></td>
</tr>
<tr>
<td><a href="'.$path_no_index.'workgiver.php">Работодателю</a></td>
</tr>
<tr>
<td><a href="'.$path_no_index.'search.php">Поиск '.($_SESSION['lvl'] == 1 ?'резюме':'вакансии').'</a></td>
</tr>
<tr>
<td><a href="'.$path_no_index.'useful_links.php">Полезные ссылки</a></td>
</tr>
</table>
</div>
<div>
<a target="_blank" href="http://niu.bsu.edu.ru"><img width="188" height="75" border="0" src="'.$path_index.'image/ssylki/p_niu.jpg" alt="НИУ" title="БелГУ - Национальный исследовательский университет" style="margin:3px"></a><br>
<a target="_blank" rel="nofollow" href="http://pegas.bsu.edu.ru/"><img width="188" height="75" border="0" src="'.$path_index.'image/ssylki/p_pegas.jpg" alt="Система дистанционного обучения «Пегас»" title="Система дистанционного обучения «Пегас»" style="margin:3px"></a><br>
<a target="_blank" href="http://www.bsu.edu.ru/bsu/resource/officialdocs/sections.php?ID=592"><img width="188" height="75" border="0" src="'.$path_index.'image/ssylki/p_kvalif.jpg" alt="Повышение квалификации в НИУ «БелГУ»" title="Повышение квалификации в НИУ «БелГУ». Дополнительные профессии"></a><br>
<a target="_blank" href="http://www.bsu.edu.ru/bsu/gazeta/"><img width="188" height="75" border="0" src="'.$path_index.'image/ssylki/p_budni.jpg" alt="Информационно-образовательное издание НИУ «БелГУ»" title="Информационно-образовательное издание НИУ «БелГУ»"></a><br>
<a target="_blank" href="http://library.bsu.edu.ru"><img border="0" src="'.$path_index.'image/ssylki/p_nb.jpg" alt="Научная библиотека БелГУ" title="Научная библиотека БелГУ" style="margin:3px"></a>
</div>
';

?>