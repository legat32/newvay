<?include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?
CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");


function getPreview__($offerID, $width=false, $height=false)
{
	$productID = CCatalogSku::GetProductInfo($offerID);
	//pra($productID);
		
	// если offer неактивный, то у него пропадает привязка к товару(!), на этот случай ищем товар по части XML_ID
	if(!is_array($productID))
	{
		$dbOffer = CIBlockElement::GetByID($offerID);
		if($arOffer = $dbOffer->Fetch())
		{
			$product_xml_id = $arOffer["XML_ID"];
		}
		if(strLen(trim($product_xml_id))>0)
		{
			$t = explode("#", $product_xml_id);
			$dbPr = CIBlockElement::GetList(Array(), Array("XML_ID" => $t[0]), false, false, Array("ID", "IBLOCK_ID"));
			if($arPr = $dbPr->Fetch()) $productID = Array("ID" => $arPr["ID"], "IBLOCK_ID" => $arPr["IBLOCK_ID"]);
		}
	}
		
	if(is_array($productID))
	{
		$dbRes = CIBlockElement::getList(
			Array(),
			Array(
				"IBLOCK_ID" => $productID["IBLOCK_ID"],
				"ID" => $productID["ID"]
				),
			false,
			false,
			Array("ID", "IBLOCK_ID", "NAME", "IBLOCK_ID", "DETAIL_PICTURE", "PROPERTY_MORE_PHOTO")
			);
		$arPictures = Array();
		
		unset($detail_picture);
		while($arRes = $dbRes->GetNext())
		{
			if(($arRes["DETAIL_PICTURE"] > 0)&&(!isset($detail_picture)))
			{
				$detail_picture = $arRes["DETAIL_PICTURE"];	
				$t1 = CFile::GetFileArray($detail_picture);
				$e1 = explode("ЦВЕТ", strtoupper($t1["DESCRIPTION"]));
				if(count($e1)>1) $arPictures[trim($e1[1])][] = $t1;
				else $arPictures[trim($e1[0])][] = $t1;
			}
	
			if(is_array($arRes["PROPERTY_MORE_PHOTO_VALUE"]))
			{
				foreach($arRes["PROPERTY_MORE_PHOTO_VALUE"] as $arP)
				{
					$t = CFile::GetFileArray($arP);
					$e = explode("ЦВЕТ", strtoupper($t["DESCRIPTION"]));
					//$arPictures[trim($e[1])][] = $t;
					if(count($e)>1) $arPictures[trim($e[1])][] = $t;
					else $arPictures[trim($e[0])][] = $t;
				}
			}
			else
			{
				$t = CFile::GetFileArray($arRes["PROPERTY_MORE_PHOTO_VALUE"]);
				$e = explode("ЦВЕТ", strtoupper($t["DESCRIPTION"]));
				//$arPictures[trim($e[1])][] = $t;
				prn($e);
				if(count($e)>1) $arPictures[trim($e[1])][] = $t;
				else $arPictures[trim($e[0])][] = $t;
			}
			
		}
		
		foreach($arPictures as $kColor => $arColor)
		{
			prn($kColor);
			foreach($arColor as $arPict)
			{
				echo '<img width="150" src="'.$arPict["SRC"].'">';
			}
		}
		
		$dbRes = CIBlockElement::GetByID($offerID);
		if($arElement = $dbRes->Fetch())
		{
			foreach($arPictures as $color => $arPicture)
			{
				if(strpos(" ".strtoupper($arElement["NAME"]), $color) > 0)
				{
					$res = $arPicture[0];
					break;
				}
			}
		}
	}
	
	if(is_array($res))
	{
		if($width && $height)
		{
			$f = CFile::ResizeImageGet($res["ID"], array('width'=>$width, 'height'=>$height), BX_RESIZE_IMAGE_PROPORTIONAL, true);
			$res["WIDTH"] = $f["width"];
			$res["HEIGHT"] = $f["height"];
			$res["SRC"] = $f["src"];
		}
		return $res;
	}
	else
	{
		$nofoto = CFile::GetFileArray(NOFOTO_FILE_ID);
		if($width && $height)
		{
			$f = CFile::ResizeImageGet(NOFOTO_FILE_ID, array('width'=>$width, 'height'=>$height), BX_RESIZE_IMAGE_PROPORTIONAL, true);
			$nofoto["WIDTH"] = $f["width"];
			$nofoto["HEIGHT"] = $f["height"];
			$nofoto["SRC"] = $f["src"];
		}
		return $nofoto;
	}

}





$prev = getPreview(29036306, 200, 200);
echo '<hr>RESULT<br><img src="'.$prev["SRC"].'">';
prn($prev);










die();


$arWaterMark = Array(
	Array(
		"name" => "watermark",
		"position" => "bottomleft", // Положение
		"type" => "image",
		"size" => "real",
		"file" => $_SERVER["DOCUMENT_ROOT"].'/upload/watermarks/water_female.png', // Путь к картинке
		"fill" => "exact",
	)
);

$arWaterMarkBig = Array(
	Array(
		"name" => "watermark",
		"position" => "bottomleft", // Положение
		"type" => "image",
		"size" => "real",
		"file" => $_SERVER["DOCUMENT_ROOT"].'/upload/watermarks/water_female_big3.png', // Путь к картинке
		"fill" => "exact",
	)
);


$ID = 189648;
$file = CFile::ResizeImageGet($ID, array('width' => 1000, 'height' => 1500), BX_RESIZE_IMAGE_PROPORTIONAL, true, $arWaterMark);
echo "<img height='600' src='".$file["src"]."'>";

$ID = 190703;
$file = CFile::ResizeImageGet($ID, array('width' => 1000, 'height' => 1500), BX_RESIZE_IMAGE_PROPORTIONAL, true, $arWaterMarkBig);
echo "<img height='600' src='".$file["src"]."'>";

















die();

function getFileArray($id)
{
	$img = CFile::GetFileArray($id);
	$res = Array(
		"ID" => $id,
		"SRC" => $_SERVER["DOCUMENT_ROOT"].$img["SRC"],
		"URL" => "http://".$_SERVER["SERVER_NAME"].$img["SRC"],
		"SIZE" => $img["FILE_SIZE"],
		"TIME" => filemtime($_SERVER["DOCUMENT_ROOT"].$img["SRC"]),
		"DESCRIPTION" => $img["DESCRIPTION"],
		"MD5" => md5_file($_SERVER["DOCUMENT_ROOT"].$img["SRC"])
		);
	return $res;
}

 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
die();
 
if(!file_exists($_SERVER["DOCUMENT_ROOT"]."/temp/data.txt"))
{
	$num = 0;
	$arPict = Array();
	$dbRes = CIBlockElement::GetList(Array("CML2_ARTICLE" => "asc"), Array("IBLOCK_ID" => 6), false, false, Array("ID", "XML_ID", "ACTIVE","NAME", "PREVIEW_PICTURE", "DETAIL_PICTURE", "PROPERTY_MORE_PHOTO"));
	while($arRes = $dbRes->GetNext())
	{
		$id = $arRes["ID"];
		if($arRes["PREVIEW_PICTURE"])
		{
			if(!is_array($arPict[$id]["PREVIEW_PICTURE"]))
			{
				$arPict[$arRes["XML_ID"]]["PREVIEW_PICTURE"] = getFileArray($arRes["PREVIEW_PICTURE"]);
			}
		}
		if($arRes["DETAIL_PICTURE"])
		{
			if(!is_array($arPict[$id]["DETAIL_PICTURE"]))
			{
				$arPict[$arRes["XML_ID"]]["DETAIL_PICTURE"] = getFileArray($arRes["DETAIL_PICTURE"]);
			}
		}
		$arPict[$arRes["XML_ID"]]["MORE_PHOTO"][] = getFileArray($arRes["PROPERTY_MORE_PHOTO_VALUE"]);
		$num++;
		if($num>10000) break;
	}
	
	ksort($arPict);
	
	$str = serialize($arPict);
	$f = fopen($_SERVER["DOCUMENT_ROOT"]."/temp/data.txt", "w+");
	fwrite($f, $str);
	fclose($f);
	prn("write ok");
}



$f = file($_SERVER["DOCUMENT_ROOT"]."/temp/data.txt");
$arPict = Array();
$arPict = unserialize($f[0]);
prn("read ok - ".count($arPict)." elements");


/*
$num = 0;
foreach($arPict as $k => $v)
{
	prn($v);
	$num++;
	if($num > 10) break;
}
*/
?>
