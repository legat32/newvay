<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
if($arResult["SECTION"]["ID"] > 0)
{
	$arSects = Array();
	$dbRes = CIBlockSection::GetList(Array(), Array("ACTIVE" => "Y", "IBLOCK_ID" => 6, "SECTION_ID" => $arResult["SECTION"]["ID"], "CNT_ACTIVE" => "Y"), true);
	while($arRes = $dbRes->GetNext())
	{
		if($arRes["ELEMENT_CNT"]>0) $arSects[] = $arRes;
	}
}
?>
<?if(count($arSects) > 0):?>
	<div id="section-list-lev1">
		<ul>
		<?foreach($arSects as $arSect):?>
			<li><a href="<?=$arSect["SECTION_PAGE_URL"]?>"><?=$arSect["NAME"]?></a>&nbsp;(<?=$arSect["ELEMENT_CNT"]?>)</li>
		<?endforeach;?>
		</ul>
	</div>
<?endif?>