<?require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');?>
<?
/*
$arFilter = Array("UF_MAILING" => "5"); 
$arParams["SELECT"] = array("UF_MAILING");
$rsUsers = CUser::GetList(($by="LAST_NAME"), ($order="asc"), $arFilter, $arParams); // выбираем пользователей 
$num = 1;
while($arUser = $rsUsers->GetNext()) 
{
	echo $num.";".$arUser["ID"].";".$arUser["EMAIL"].";".$arUser["NAME"]."<br/>";
	$num++;
	if($num>100) break;
}
*/


header('Content-Type: application/csv; charset=Windows-1251');
header('Content-Disposition: attachment; filename=users.csv');
$output = fopen('php://output', 'w');
fwrite($output, 'NUM;ID;EMAIL;NAME');

$arFilter = Array("UF_MAILING" => "5"); 
$arParams["SELECT"] = array("UF_MAILING");
$rsUsers = CUser::GetList(($by="LAST_NAME"), ($order="asc"), $arFilter, $arParams); // выбираем пользователей 
$num = 1;
while($arUser = $rsUsers->GetNext()) 
{
	fwrite($output, $num.";".$arUser["ID"].";".$arUser["EMAIL"].";".$arUser["NAME"]."\n");
	$num++;
	//if($num>100) break;
}

?>