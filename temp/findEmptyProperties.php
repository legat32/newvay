<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?
CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");
CModule::IncludeModule("iblock");

/*
$arSelect = Array("ID", "NAME", "PROPERTY_COLOR", "PROPERTY_COLOR_TONE");
$arFilter = Array("IBLOCK_ID"=>7, "ACTIVE"=>"Y");
$dbRes = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($arRes = $dbRes->GetNext())
{
	if(!in_array($arRes["PROPERTY_COLOR_VALUE"], $arr1[$arRes["PROPERTY_COLOR_TONE_VALUE"]])) $arr1[$arRes["PROPERTY_COLOR_TONE_VALUE"]][] = $arRes["PROPERTY_COLOR_VALUE"];
}
prn($arr1);
*/


$arSelect = Array("ID", "NAME", "PROPERTY_SOSTAV", "PROPERTY_DLINA_RUKAVA_SM", "PROPERTY_DLINA_IZDELIYA_SM", "DETAIL_TEXT", "XML_ID", "DETAIL_PAGE_URL");

$arDlinaIzdeliya = Array();
$arDlinaRukava = Array();
$arDescription = Array();
$arSostav = Array();

$arFilter = Array("IBLOCK_ID"=>6, "ACTIVE"=>"Y");
$dbRes = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($arRes = $dbRes->GetNext())
{
	if(trim($arRes["PROPERTY_SOSTAV_VALUE"]) == "") $arSostav[] = "<a href='".$arRes["DETAIL_PAGE_URL"]."' target='_blank'>".$arRes["NAME"]."</a>";
	if(trim($arRes["PROPERTY_DLINA_RUKAVA_SM_VALUE"]) == "") $arDlinaRukava[] = "<a href='".$arRes["DETAIL_PAGE_URL"]."' target='_blank'>".$arRes["NAME"]."</a>";
	if(trim($arRes["PROPERTY_DLINA_IZDELIYA_SM_VALUE"]) == "") $arDlinaIzdeliya[] = "<a href='".$arRes["DETAIL_PAGE_URL"]."' target='_blank'>".$arRes["NAME"]."</a>";
	if(trim($arRes["DETAIL_TEXT"]) == "") $arDescription[] = "<a href='".$arRes["DETAIL_PAGE_URL"]."' target='_blank'>".$arRes["NAME"]."</a>";
	//if(trim($arRes["DETAIL_TEXT"]) == "") echo "NONE<br/>";
	//if(!in_array($arRes["PROPERTY_COLOR_VALUE"], $arr1[$arRes["PROPERTY_COLOR_TONE_VALUE"]])) $arr1[$arRes["PROPERTY_COLOR_TONE_VALUE"]][] = $arRes["PROPERTY_COLOR_VALUE"];
	//prn($arRes);
}

//prn($arDlinaRukava);
?>
<table width="100%" border="1">
<tr>
	<td valign="top">
		<h1>Нет описания</h1>
		<?foreach($arDescription as $i => $row):?>
			<?=$i+1?>) <?=$row?><br/>
		<?endforeach?>
	</td>
	<td valign="top">
		<h1>Нет состава</h1>
		<?foreach($arSostav as $i => $row):?>
			<?=$i+1?>) <?=$row?><br/>
		<?endforeach?>
	</td>
	<td valign="top">
		<h1>Нет длины рукава</h1>
		<?foreach($arDlinaRukava as $i => $row):?>
			<?=$i+1?>) <?=$row?><br/>
		<?endforeach?>
	</td>
	<td valign="top">
		<h1>Нет длины изделия</h1>
		<?foreach($arDlinaIzdeliya as $i => $row):?>
			<?=$i+1?>) <?=$row?><br/>
		<?endforeach?>
	</td>
</tr>
</table>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>