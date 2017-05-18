<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?
CModule::IncludeModule("iblock");

/*
$id = 117375;
$f = CFile::GetByID($id);
$r = $f->Fetch();
$desc = str_replace("/", "_", str_replace("(", "", str_replace(")", "", $r["DESCRIPTION"])))."-id".$r["ID"];

$src = $site."/upload/".$r["SUBDIR"]."/".$r["FILE_NAME"];

$f1 = CFile::ResizeImageGet(
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
			"file"=>$_SERVER['DOCUMENT_ROOT']."/upload/watermarks/logo_big_VAY.png"
			)
		)
	);
	
//prn($f1);
$src = $site.$f1["src"];
prn($src);
prn($desc);
die();
*/



/*
$arSelect = Array("ID", "NAME", "CODE", "PROPERTY_SOSTAV", "PROPERTY_CML2_ARTICLE");
$arFilter = Array("IBLOCK_ID" => 6, "ACTIVE" => "Y"); 
$dbRes = CIBlockElement::GetList(Array("PROPERTY_CML2_ARTICLE" => "asc"), $arFilter, false, false, $arSelect);
$ar = Array();
while($arRes = $dbRes->GetNext())
{
	//prn($arRes);
	echo $arRes["PROPERTY_CML2_ARTICLE_VALUE"].";".$arRes["NAME"].";".$arRes["PROPERTY_SOSTAV_VALUE"]."<br/>";
}
*/



//if(intVal($_GET["section_id"]) < 1) die("Укажите раздел в URL: http://newvay.ru/cat.php?section_id=000");
//else $section_id = intVal($_GET["section_id"]);
$artikuls = Array(6043,6045,6047,6048,6071,6073,6073,6074,6076,6077,6080,6092,6102,6101,6083,6081,6042,6075,6078,6093,6046,6044,6049,6026,6028,6029,6031,6032,6033,6034,6035,6036,6040,6050,6051,6052,6053,6054,6055,6056,"561д","557д","559д",583,"564д",580,"574д","576д","577д",581,"558д","562д","563д",570,"549д","552д","553д",554,555,"564д","565д",570,571,"724д",735);




$arSelect = Array("ID", "NAME", "CODE", "DETAIL_PICTURE", "PROPERTY_MORE_PHOTO", "PROPERTY_CML2_ARTICLE", "PROPERTY_COLLECTION");
$arFilter = Array("IBLOCK_ID" => 6, "PROPERTY_CML2_ARTICLE" => $artikuls);
$dbRes = CIBlockElement::GetList(Array("PROPERTY_CML2_ARTICLE" => "asc"), $arFilter, false, false, $arSelect);
$ar = Array();
$site = "http://newvay.ru";
while($arRes = $dbRes->GetNext())
{
	$ar[$arRes["PROPERTY_CML2_ARTICLE_VALUE"]]["NAME"] = $arRes["NAME"];
	$ar[$arRes["PROPERTY_CML2_ARTICLE_VALUE"]]["CODE"] = $arRes["CODE"];
	if(!is_array($ar[$arRes["PROPERTY_CML2_ARTICLE_VALUE"]]["DETAIL_PICTURE"]))
	{
		$f0 = CFile::GetByID($arRes["DETAIL_PICTURE"]);
		$r0 = $f0->Fetch();
		$desc0 = str_replace("/", "_", str_replace("(", "", str_replace(")", "", $r0["DESCRIPTION"])))."-id".$r0["ID"];
		
		$f3 = CFile::ResizeImageGet(
			$arRes["DETAIL_PICTURE"],
			array(),
			BX_RESIZE_IMAGE_PROPORTIONAL,  
			true, 
			$arFilters = Array(
				array(
					"name" => "watermark", 
					"position" => "bottom right", 
					"alpha_level" => "30", 
					"size"=>"real", 
					"file"=>$_SERVER['DOCUMENT_ROOT']."/upload/watermarks/logo_big_".$arRes["PROPERTY_COLLECTION_VALUE"].".png"
					)
				)
			);
		$src0 = $site.$f3["src"];
		
		//$ar[$arRes["PROPERTY_CML2_ARTICLE_VALUE"]]["DETAIL_PICTURE"] = $site.CFile::GetPath($arRes["DETAIL_PICTURE"]);
		
		$ar[$arRes["PROPERTY_CML2_ARTICLE_VALUE"]]["DETAIL_PICTURE"] = Array(
			"SRC" => $src0,
			"DESC" => $desc0
			);
		
		echo str_replace("http://newvay.ru", "", $_SERVER["DOCUMENT_ROOT"].$src0)." ==> ".$_SERVER["DOCUMENT_ROOT"]."/files/".$desc0.".jpg"."<br/>";
		$res0 = copy(str_replace("http://newvay.ru", "", $_SERVER["DOCUMENT_ROOT"].$src0), $_SERVER["DOCUMENT_ROOT"]."/files/".$desc0.".jpg");
		if(!$res0) echo("NOT COPIED - ");
		else echo "OK - ";
		echo $desc0."<br/>";
		
		
	}
	
	if($arRes["PROPERTY_MORE_PHOTO_VALUE"] > 0)
	{
		$f = CFile::GetByID($arRes["PROPERTY_MORE_PHOTO_VALUE"]);
		$r = $f->Fetch();
		$desc = str_replace("/", "_", str_replace("(", "", str_replace(")", "", $r["DESCRIPTION"])))."-id".$r["ID"];
		
		$src = $site."/upload/".$r["SUBDIR"]."/".$r["FILE_NAME"];
		
		$f1 = CFile::ResizeImageGet(
			$arRes["PROPERTY_MORE_PHOTO_VALUE"],
			array(),
			BX_RESIZE_IMAGE_PROPORTIONAL,  
			true, 
			$arFilters = Array(
				array(
					"name" => "watermark", 
					"position" => "bottom right", 
					"alpha_level" => "30", 
					"size"=>"real", 
					"file"=>$_SERVER['DOCUMENT_ROOT']."/upload/watermarks/logo_big_".$arRes["PROPERTY_COLLECTION_VALUE"].".png"
					)
				)
			);
			
		//prn($f1);
		$src = $site.$f1["src"];
		
		
		$ar[$arRes["PROPERTY_CML2_ARTICLE_VALUE"]]["MORE_PHOTO"][] = Array(
			"SRC" => $src,
			"DESC" => $desc
			);
		
		//prn(str_replace("http://newvay.ru", "", $_SERVER["DOCUMENT_ROOT"].$src));
		$res = copy(str_replace("http://newvay.ru", "", $_SERVER["DOCUMENT_ROOT"].$src), $_SERVER["DOCUMENT_ROOT"]."/files/".$desc.".jpg");
		if(!$res) echo("NOT COPIED - ");
		else echo "OK - ";
		echo $desc."<br/>";
		//$ar[$arRes["PROPERTY_CML2_ARTICLE_VALUE"]]["MORE_PHOTO"][] = $site.CFile::GetPath($arRes["PROPERTY_MORE_PHOTO_VALUE"]);
		//prn($arRes);
	}
}
//prn($ar);
//prn($_SERVER["DOCUMENT_ROOT"]);
//if(copy($_SERVER["DOCUMENT_ROOT"]."/upload/iblock/ae1/d95e87d5-9d08-11de-b592-002197d362b4_67b699b8-68bb-11e3-9b42-002618a8d26d.jpeg", $_SERVER["DOCUMENT_ROOT"]."/files/file.jpg")) prn("copied"); else prn("NOT");
                            
prn("yes");
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>