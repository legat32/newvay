<? include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php"); ?>
<?header('Access-Control-Allow-Origin: *');?>
<!--<link href="/bitrix/templates/femina_light/components/bitrix/catalog/template2/bitrix/catalog.element/.default/style.css" type="text/css"  rel="stylesheet" />-->


<?
$arParams["DISPLAY_MORE_PHOTO_WIDTH"] = 280;
$arParams["DISPLAY_MORE_PHOTO_HEIGHT"] = 280;
$arParams["SHARPEN"] = 30;
?>


            
<?
//pra($_REQUEST);
$ID = intVal($_REQUEST["ID"]);				// ID элемента инфоблока
$oldid = strVal($_REQUEST["oldid"]);   		// ID файла который отображается в данный момент в качестве главного фото
$newccode = strVal($_REQUEST["newccode"]);	// код нового цвета
//$oldccode = strVal($_REQUEST["oldccode"]);
if($ID < 1) die("no image");



unset($arResult);
$arMorePhoto = Array();
$dbRes = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 6, "ID" => $ID), false, false, Array("ID", "IBLOCK_ID", "DETAIL_PICTURE", "DETAIL_PAGE_URL", "PROPERTY_CML2_ARTICLE", "PROPERTY_RASPRODAZHA", "PROPERTY_UTSENKA", "PROPERTY_SEZONNOE_PREDLOZHENIE", "PROPERTY_NOVINKA", "PROPERTY_COLLECTION", "PROPERTY_MORE_PHOTO"));

while($arRes = $dbRes->GetNext())
{
	
	if(!isset($arResult)) $arResult = $arRes;
	//prn($arResult);
	//die("22");
	//$arResult["PROPERTY_MORE_PHOTO_VALUE"][] = $arRes["PROPERTY_MORE_PHOTO_VALUE"];
	$d = CFile::GetByID($arRes["PROPERTY_MORE_PHOTO_VALUE"]);
	$r = $d->GetNext();
	$arMorePhoto[$r["ID"]] = $r["DESCRIPTION"];
	
	//prn($r);
}
$arResult["PROPERTY_MORE_PHOTO_VALUE"] = $arMorePhoto;
//prn($arResult);
//prn($arMorePhoto);



// закинем все фото включая DETAIL_PICTURE в общий массив

$d = CFile::GetByID($arResult["DETAIL_PICTURE"]);
$r = $d->GetNext();
$arResult["IMAGES"][$r["ID"]] = $r["DESCRIPTION"];
foreach($arMorePhoto as $k => $f) $arResult["IMAGES"][$k] = $f;




//pra($newccode);

// найдем главное фото по принятому коду newccode
$find = false;
foreach($arResult["IMAGES"] as $kod => $desc)
{
	//pra($desc);
	
	if(stripos(" ".$desc, $newccode) > 0) 
	{
		//$arImage["DETAIL"] = "Y";
		$MAIN_ID = $kod;
		$find = true;
		break;
	}
}

// если не нашли новое, то найдем главное фото по коду oldccode
/*
if(!$find) 
{
	$findold = false;
	foreach($arResult["IMAGES"] as $kod => $desc)
	{
		if(strpos(" ".$desc, $oldccode) > 0) 
		{
			//$arImage["DETAIL"] = "Y";
			$MAIN_ID = $kod;
			$findold = true;
			break;
		}
	}
}
*/


// если не нашли новое, то найдем главное фото по oldid

if(!$find) 
{
	$MAIN_ID = htmlspecialcharsbx($oldid);
}

//prn($MAIN_ID);

//prn($arResult["IMAGES"]);














if($MAIN_ID > 0)
{


	$arResult["DETAIL_IMG"] = CFile::ResizeImageGet(
		$MAIN_ID,
		array("width" => 333, "height" => 500),
		BX_RESIZE_IMAGE_PROPORTIONAL, 
		true,
		$arFilters = Array(
				array(
					"name" => "watermark", 
					"position" => "bottom right", 
					"alpha_level" => "30", 
					"size"=>"real", 
					"file"=>$_SERVER['DOCUMENT_ROOT']."/upload/watermarks/logo_".$arResult["PROPERTY_COLLECTION_VALUE"].".png"
					)
				)
			);
				
	$arResult["ORIGINAL_IMG"] = CFile::ResizeImageGet(
		$MAIN_ID,
		array("width" => 550, "height" => 800),
		BX_RESIZE_IMAGE_PROPORTIONAL, 
		true,
		$arFilters = Array(
				array(
					"name" => "watermark", 
					"position" => "bottom right", 
					//"position" => "center", 
					"alpha_level" => "30", 
					"size"=>"big", 
					"file"=>$_SERVER['DOCUMENT_ROOT']."/upload/watermarks/logo_big_".$arResult["PROPERTY_COLLECTION_VALUE"].".png"
					)
				)
			);
			
	$arResult["DETAIL_IMG"]["DESCRIPTION"] = $arResult["IMAGES"][$MAIN_ID];
			
}





//if (is_array($arResult['PROPERTY_MORE_PHOTO_VALUE']) && count($arResult['PROPERTY_MORE_PHOTO_VALUE']) > 0)
//{
	//unset($arResult['DISPLAY_PROPERTIES']['MORE_PHOTO']);

	foreach ($arResult['IMAGES'] as $id => $desc)
	{
	
		if($id == $MAIN_ID) continue;
		
		//prn($id);
		
		$arFilter = '';
		if($arParams["SHARPEN"] != 0)
		{
			$arFilter = array("name" => "sharpen", "precision" => $arParams["SHARPEN"]);
		}
		
		
		$arFileTmp = CFile::ResizeImageGet(
			$id,
			array("width" => $arParams["DISPLAY_MORE_PHOTO_WIDTH"], "height" => $arParams["DISPLAY_MORE_PHOTO_HEIGHT"]),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true, $arFilter
		);
		
		//prn($arFileTmp);
		

		$arFileOriginal = CFile::ResizeImageGet(
			$id,
			array(),
			BX_RESIZE_IMAGE_PROPORTIONAL,  
			true, 
			$arFilters = Array(
				array(
					"name" => "watermark", 
					"position" => "bottom right", 
					"alpha_level" => "30", 
					"size"=>"real", 
					"file"=>$_SERVER['DOCUMENT_ROOT']."/upload/watermarks/logo_big_".$arResult["PROPERTY_COLLECTION_VALUE"].".png"
					)
				)
			);
			
		//prn($arFileOriginal);
		
		$arF['SRC'] = $arFileTmp['src'];
		$arF['DESCRIPTION'] = $desc;
		$arResult['MORE_PHOTO'][$id] = $arF;
		$arResult['MORE_PHOTO'][$id]["ORIGINAL"] = $arFileOriginal;

	}
	
unset($arResult["MORE_PHOTO"][""]);
	
//}


//prn($arResult);










?>




<!--<div class="item_images">-->
	<div class="item_artikul" id="<?=$arResult["ID"]?>">Арт. <?=$arResult["PROPERTY_CML2_ARTICLE_VALUE"]?></div>
	<?if($arResult["PROPERTY_RASPRODAZHA_VALUE"]=="true"):?><span class="item_sale">Распродажа!</span><?endif?>
	<?if($arResult["PROPERTY_UTSENKA_VALUE"]=="true"):?><a class="item_utsenka" title="Уцененный товар">%</a><?endif?>
	<?if($arResult["PROPERTY_SEZONNOE_PREDLOZHENIE_VALUE"]=="true"):?>
		<span class="item_season"<?if($arResult["PROPERTY_RASPRODAZHA_VALUE"]=="true"):?> style="top:85px"<?endif?>>Сезонное предложение</span>
	<?endif?>
	<?if(is_array($arResult["DETAIL_IMG"])):?>
		<div class="item_img" id="<?=htmlspecialchars($MAIN_ID)?>">
			<a title="<?=$arResult["DETAIL_IMG"]["DESCRIPTION"]?>" class="fancybox" rel="group1" href="<?=$arResult["ORIGINAL_IMG"]["src"]?>"><img alt="<?=$arResult["DETAIL_IMG"]["DESCRIPTION"]?>" class="item_detail_img" width="<?=$arResult["DETAIL_IMG"]["width"]?>" height="<?=$arResult["DETAIL_IMG"]["height"]?>" src="<?=$arResult["DETAIL_IMG"]["src"]?>"></a>
		</div>
	<?else:?>
		<div class="item_img_blank">
		</div>
	<?endif;?>
	
	<?if(count($arResult["MORE_PHOTO"])>0):?>
	<div class="item_more_files">
		<div class="wrap_more">
			<div class="wrap">
				<div class="frame" id="centered" style="overflow: hidden;">
					<ul class="clearfix" style="-webkit-transform: translateZ(0px) translateX(-2964px); width: 6840px;">
						<?foreach($arResult["MORE_PHOTO"] as $photo):?>
						<li class="">
							
							<a title="<?=$photo["DESCRIPTION"]?>" class="fancybox" rel="group1" href="<?=$photo["ORIGINAL"]["src"]?>">
								<img alt="<?=$photo["DESCRIPTION"]?>" src="<?=$photo["SRC"]?>"/>
							</a>
							<!--<span style="display: none;"><?=$photo["FOR_MAIN_PICTURE"]["src"]?></span>-->
						</li>
						<?endforeach?>
					</ul>
				</div>
			</div>
			<div class="scrollbar">
					<div class="handle" style="-webkit-transform: translateZ(0px) translateX(503px); width: 168px;">
					<div class="mousearea"></div>
				</div>
			</div>
		</div>
	</div><!--item_more_files-->
	<?endif?>
<!--</div>--><!--item_images-->


<?//pra($arResult["MORE_PHOTO"])?>


<script>
// Sly-галерея для MORE_PHOTO
	var $frame = $('#centered');
	var $wrap  = $frame.parent();
	$frame.sly({
		horizontal: 1,
		itemNav: 'centered',
		smart: 1,
		activateOn: 'click',
		mouseDragging: 1,
		touchDragging: 1,
		releaseSwing: 1,
		startAt: 1,
		scrollBar: $wrap.parent().find('.scrollbar'),
		scrollBy: 1,
		speed: 300,
		elasticBounds: 1,
		easing: 'easeOutExpo',
		dragHandle: 1,
		dynamicHandle: 1,
		clickBar: 1
		});
</script>