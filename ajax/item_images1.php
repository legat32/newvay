<? include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php"); ?>

<!--<link href="/bitrix/templates/femina_light/components/bitrix/catalog/template2/bitrix/catalog.element/.default/style.css" type="text/css"  rel="stylesheet" />-->


<?
$arParams["DISPLAY_MORE_PHOTO_WIDTH"] = 280;
$arParams["DISPLAY_MORE_PHOTO_HEIGHT"] = 280;
$arParams["SHARPEN"] = 30;
?>


            
<?
$ID = intVal($_REQUEST["ID"]);				// ID элемента инфоблока
$oldid = strVal($_REQUEST["oldid"]);   		// ID файла который отображается в данный момент в качестве главного фото
$newccode = trim(strtoupper(strVal($_REQUEST["newccode"])));	// код нового цвета
if($ID < 1) die("no image");






// соберем массив фото на этом сайте
$arPict = Array();
$dbRes = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 6, "ID" => $ID), false, false, Array("ID", "XML_ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PICTURE", "PROPERTY_MORE_PHOTO", "PROPERTY_NOVIZNA", "PROPERTY_COLLECTION"));
while($arRes = $dbRes->GetNext())
{
	//prn($arRes);
	$COLLECTION = $arRes["PROPERTY_COLLECTION_VALUE"];
	$NOVIZNA = $arRes["PROPERTY_NOVIZNA_VALUE"];
	if(!is_array($arPict["PREVIEW_PICTURE"])) 
		if($arRes["PREVIEW_PICTURE"]>0)
			$arPict["PREVIEW_PICTURE"] = CFile::GetFileArray($arRes["PREVIEW_PICTURE"]);
	if(!is_array($arPict["DETAIL_PICTURE"])) 
		if($arRes["DETAIL_PICTURE"]>0)
			$arPict["DETAIL_PICTURE"] = CFile::GetFileArray($arRes["DETAIL_PICTURE"]);
	if(is_array($arRes["PROPERTY_MORE_PHOTO_VALUE"]))
	{
		foreach($arRes["PROPERTY_MORE_PHOTO_VALUE"] as $imgID)
		{
			if($imgID>0) $arPict["MORE_PHOTO"][] = CFile::GetFileArray($imgID);
		}
	}
	else 
	{
		if($arRes["PROPERTY_MORE_PHOTO_VALUE"] > 0)
			$arPict["MORE_PHOTO"][] = CFile::GetFileArray($arRes["PROPERTY_MORE_PHOTO_VALUE"]);
	}
}

$arPicts = Array();
if(is_array($arPict["PREVIEW_PICTURE"])) 
{
	$t = explode("ЦВЕТ", strtoupper($arPict["PREVIEW_PICTURE"]["DESCRIPTION"]));
	if(count($t)>1) $kod = trim($t[1]); 
	else $kod = trim($t[0]); 
	if($kod == $newccode)
		$arPicts[$arPict["PREVIEW_PICTURE"]["EXTERNAL_ID"]] = $arPict["PREVIEW_PICTURE"];	
}
if(is_array($arPict["DETAIL_PICTURE"])) 
{
	$t = explode("ЦВЕТ", strtoupper($arPict["DETAIL_PICTURE"]["DESCRIPTION"]));
	if(count($t)>1) $kod = trim($t[1]); 
	else $kod = trim($t[0]); 
	if($kod == $newccode)
		$arPicts[$arPict["DETAIL_PICTURE"]["EXTERNAL_ID"]] = $arPict["DETAIL_PICTURE"];	
}
if(is_array($arPict["MORE_PHOTO"]))
{
	foreach($arPict["MORE_PHOTO"] as $arP)
	{
		$t = explode("ЦВЕТ", strtoupper($arP["DESCRIPTION"]));
		if(count($t)>1) $kod = trim($t[1]); 
		else $kod = trim($t[0]); 
		if($kod == $newccode)
			$arPicts[$arP["EXTERNAL_ID"]] = $arP;	
	}
}






if(count($arPicts)>0)
{
	unset($MAIN_ID);
	foreach($arPicts as $key => $arImg)
	{
		$arFilter = '';
		if($arParams["SHARPEN"] != 0)
		{
			$arFilter = array("name" => "sharpen", "precision" => $arParams["SHARPEN"]);
		}
		$arPicts[$key]["PREVIEW"] = CFile::ResizeImageGet(
			$arImg["ID"],
			array("width" => $arParams["DISPLAY_MORE_PHOTO_WIDTH"], "height" => $arParams["DISPLAY_MORE_PHOTO_HEIGHT"]),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true, $arFilter
			);
		$arPicts[$key]["DETAIL"] = CFile::ResizeImageGet(
			$arImg["ID"],
			array("width" => 550, "height" => 800),
			BX_RESIZE_IMAGE_PROPORTIONAL, 
			true,
			$arFilters = Array(
				array(
					"name" => "watermark", 
					"position" => "bottom right", 
					"alpha_level" => "30", 
					"size"=>"big", 
					"file"=>$_SERVER['DOCUMENT_ROOT']."/upload/watermarks/logo_big_".$COLLECTION.".png"
					)
				)
			);
		if(!isset($MAIN_ID)) $MAIN_ID = $key;
	}
}
else
{
	
}



foreach($arPicts as $arP)
{
	//echo "<img src='".$arP["PREVIEW"]["src"]."'><br>";
	//echo "<img src='".$arP["DETAIL"]["src"]."'><br>";
}




//prn($arPicts);
?>

<script type="text/javascript">
//	var picts = <?echo CUtil::PhpToJSObject($arPicts, false, true);?>;
//	alert(picts.eaf542ecc1b5111311ceb536f703709c.ID);
</script>





<!--<div class="item_images">-->

		<div class="full-image">
			<div class="action-label">
				<?if($NOVIZNA == "Новинка"):?><a class="item_novinka" title="Новинка">Новинка!</a><?endif?>
				<?if($NOVIZNA == "Распродажа"):?><span class="item_sale">Распродажа!</span><?endif?>
				<?if($NOVIZNA == "Товары со скидкой"):?><a class="item_utsenka" title="Товар со скидкой">%</a><?endif?>
				<?if($arResult["PROPERTIES"]["BAMBOO"]["VALUE"]=="true"):?><a title="Узнать про уникальные свойства трикотажа из бамбукового полотна" class="item_bamboo" href="/stati/unikalnye-svoystva-trikotazha-iz-bambukovogo-volokna.html?back=<?=urlencode($arResult["DETAIL_PAGE_URL"])?>">Бамбук</a><?endif?>
				<?if($arResult["PROPERTIES"]["AKCIYA_ON_SITE"]["VALUE"]=="Y"):?><a class="item_akciya_on_site" title="Акция Выгодная покупка!">Акция</a><?endif?>
				<?if($arResult["PROPERTIES"]["SEZONNOE_PREDLOZHENIE"]["VALUE"]=="true"):?><a class="item_zimniy_tsenopad" title="Акция Зимний Ценопад!">Зима</a><?endif?>
				<?if($arResult["PROPERTIES"]["AKTSIYA"]["VALUE"]=="true"):?><a class="item_aktsiya" title="Акция!">Акция</a><?endif?>
			</div>

			<?if(is_array($arPicts[$MAIN_ID])):?>
				<div class="item_img" id="<?=$arPicts[$MAIN_ID]["ID"]?>">
					<a title="<?=$arPicts[$MAIN_ID]["DESCRIPTION"]?>" href="<?=$arPicts[$MAIN_ID]["DETAIL"]["src"]?>"><img alt="<?=$arPicts[$MAIN_ID]["DESCRIPTION"]?>" class="item_detail_img" src="<?=$arPicts[$MAIN_ID]["DETAIL"]["src"]?>"></a>
				</div>
			<?else:?>
				<div class="item_img_blank">
					<img alt="<?=$arPicts[0]["DESCRIPTION"]?>" class="item_detail_img" src="/bitrix/templates/new_femina/images/img_element_blank.png">
				</div>
			<?endif;?>
		</div>
		<div class="more-photo">
			<?if(count($arPicts)>0):?>
				<?foreach($arPicts as $photo):?>
					<div class="photo-slide">
						<a title="<?=$photo["DESCRIPTION"]?>" class="fancybox" data-fancybox-group="group" href="<?=$photo["DETAIL"]["src"]?>">
							<img alt="<?=$photo["DESCRIPTION"]?>" src="<?=$photo["PREVIEW"]["src"]?>"/>
						</a>
					</div>
				<?endforeach?>
			<?endif?>
		</div>

<!--</div>--><!--item_images-->


<?//pra($arResult["MORE_PHOTO"])?>


<script>
setTimeout(function(){
			/*прокрутка картинок изделия*/
	$('.more-photo').slick({
		vertical:true,
		verticalSwiping:true,
		draggable:true,
		swipeToSlide:true,
		dots: true,
        arrows: false,
        speed: 300,
        infinite: false,
        //centerMode:true,
        focusOnSelect: true,
       	autoplay:true,
        autoplaySpeed:5000,
        pauseOnHover:true,
        slidesToShow: 3,
  		slidesToScroll: 1,
  		responsive: [
    {
      breakpoint: 992,
      settings: {
        vertical:false,
		verticalSwiping:false,
		draggable:true,
		swipeToSlide:true,
		dots: true,
        arrows: false,
        speed: 300,
        //centerMode:false,
        focusOnSelect: true,
       	autoplay:true,
        autoplaySpeed:5000,
        pauseOnHover:true,
      }
    }]
	}).on("mousewheel", function (event) {
        event.preventDefault();
    if ((event.deltaX > 0 || event.deltaY < 0)&&($('.slick-dots .slick-active').index()<$('.slick-dots li').length)) {
        $(this).stop(true,true).slick('slickNext');
    } else if ((event.deltaX < 0 || event.deltaY > 0)&&($('.slick-dots .slick-active').index()!=0)) {
        $(this).stop(true,true).slick('slickPrev');
    }
});
	$('.more-photo').css({'opacity':'1'});
},50);

	//$('.more-photo').slick('slickRemove');

</script>