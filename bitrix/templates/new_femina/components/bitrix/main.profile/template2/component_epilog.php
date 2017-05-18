<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?//prn($arResult)?>

<?
// в зависимости от значения свойства UF_MAILING (5 или ничего) добавляем/удаляем пользователя из группы подписчиков (13)
global $USER;
$dbUser = CUser::GetList(($by="personal_country"), ($order="desc"), Array("ID" => 1), Array("SELECT" => Array("UF_MAILING")));
while($arUser = $dbUser->GetNext()) 
{
	//echo "<hr/>".$arResult["arUser"]["UF_MAILING"]."<hr/>";
	$arGroups = CUser::GetUserGroup($USER->GetID());
	if($arResult["arUser"]["UF_MAILING"] == 5) 
	{
		$arGroups[] = 13;
		//echo "добавлен в 13";	
	}
	else
	{
		$arNewGroups = Array();
		foreach($arGroups as $group) if($group != 13) $arNewGroups[] = $group;
		$arGroups = $arNewGroups;
		//echo "удален из 13";	
	}
	CUser::SetUserGroup($USER->GetID(), $arGroups);	
}
?>