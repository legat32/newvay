<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$oldini=ini_get('mbstring.func_overload');
if($oldini>0) ini_set('mbstring.func_overload',0);

$arParams["IBLOCK_TYPE"] = trim($arParams["IBLOCK_TYPE"]);
$arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);
$arParams["TMP_PATH"]=($arParams["TMP_PATH"]=="" ? "/upload/" : $arParams["TMP_PATH"] ); 
$arParams["PROP_TAXONOMY"]=$_REQUEST["PROP"];
$dir=$_SERVER["DOCUMENT_ROOT"].$arParams["TMP_PATH"];
if(!is_dir($dir)) mkdir($dir, 0777, true);
$arResult=array();
$arResult["FILE_ID"]=$_REQUEST["FILE_ID"];
if(CModule::IncludeModule("echogroup.exelimport")&&CModule::IncludeModule("iblock")){
	$arIMAGE = $_FILES["IMAGE_ID"];
	$arIMAGE["MODULE_ID"] = "echogroup.exelimport";
	if (strlen($arIMAGE["name"])>0) 
	{
		$fid = CFile::SaveFile($arIMAGE, "echogroup.exelimport");
		$arResult["FILE_ID"]=$fid;
	}
	if($arResult["FILE_ID"]>0) 
		$arResult["FILE_PATH"]=CFile::GetPath($arResult["FILE_ID"]);
	else { $arResult["ERRORS"][]="Не выбран файл"; unset($_REQUEST['start_import']);unset($_REQUEST['config_import']);}
	if (isset($_REQUEST['start_import'])||isset($_REQUEST['config_import'])){
		$objPHPExcel = PHPExcel_IOFactory::load($_SERVER["DOCUMENT_ROOT"].$arResult["FILE_PATH"]);
		$cell_list=$objPHPExcel->getActiveSheet()->getCellCollection();
		foreach($cell_list as $cell){
			$letter=preg_replace("!([0-9])!","",$cell);
			$num=preg_replace("!([A-Z])!","",$cell);
			$cell_data[$num][$letter]=iconv(mb_detect_encoding($objPHPExcel->getActiveSheet()->getCell($cell)->getValue()),"WINDOWS-1251",$objPHPExcel->getActiveSheet()->getCell($cell)->getValue());
		}
		$arResult["DATA"]=$cell_data;

		$arProp=CIBlockProperty::GetList(array("sort"=>"desc"),array("IBLOCK_ID"=>$arParams["IBLOCK_ID"],"CHECK_PERMISSIONS"=>"N"));
		$arResult["SELECT"]["ID"]=GetMessage("EEI_SID");
		$arResult["SELECT"]["NAME"]=GetMessage("EEI_SNAME");
		while($arProperty=$arProp->Fetch()){
			$arResult["PROP_LIST"][$arProperty["CODE"]]=$arProperty;
			$arResult["SELECT"][$arProperty["CODE"]]=$arProperty["NAME"];
		}
	}
	if (isset($_REQUEST['start_import'])){
	// старт импорта 
		if (!empty($arResult["DATA"])){
			unset($arResult["DATA"][0]);
			foreach($arResult["DATA"] as $k=>$v)
				foreach($v as $key=>$val)
					if(in_array($arResult["PROP_LIST"][$arParams["PROP_TAXONOMY"][$key]]["PROPERTY_TYPE"],array("L","E","G","U")))
						$arPropValueFlt[$arResult["PROP_LIST"][$arParams["PROP_TAXONOMY"][$key]]["PROPERTY_TYPE"]][$key][]=$val;

			// настройка свойств, добавление новых значений и поиск старых идшников
			if(!empty($arPropValueFlt))foreach($arPropValueFlt as $k=>$pValFlt){
				foreach($pValFlt as $key=>$flt){
					$arResult["PROP_LIST_FLT"][$arResult["PROP_LIST"][$arParams["PROP_TAXONOMY"][$key]]["CODE"]]=array_unique($flt);

					if($k=="L"&&$arParams["CREATE_L_PROP"]=="Y"){
						$property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "CODE"=>$arResult["PROP_LIST"][$arParams["PROP_TAXONOMY"][$key]]["CODE"]));
						while($enum_fields = $property_enums->GetNext())
							$arResult["PROP_LIST"][$arParams["PROP_TAXONOMY"][$key]]["ENUM_VALUE"][$enum_fields["ID"]]=$enum_fields["VALUE"];
						
						$f=$arResult["PROP_LIST"][$arParams["PROP_TAXONOMY"][$key]]["ENUM_VALUE"];
						foreach($arResult["PROP_LIST_FLT"][$arResult["PROP_LIST"][$arParams["PROP_TAXONOMY"][$key]]["CODE"]] as $value){
							$value_tmp=str_replace(" ","",$value);
							if(
								$value_tmp!=" "
								&& !in_array($value,$f)
								&& !in_array($value." ",$f)
								&& (substr($value,strlen($value)-1,strlen($value))==" "&&!in_array(substr($value,0,strlen($value)-1),$f))
							){	

								$rsProp = new CIBlockPropertyEnum;
								if($PropID = $rsProp->Add(Array('PROPERTY_ID'=>$arResult["PROP_LIST"][$arParams["PROP_TAXONOMY"][$key]]["ID"], 'VALUE'=>$value)))
									$arResult["PROP_LIST"][$arParams["PROP_TAXONOMY"][$key]]["ENUM_VALUE"][$PropID]=$value;	
							}
						}
					}
					if($k=="E"&&$arParams["CREATE_E_PROP"]=="Y"){
						$property_enums = CIblockElement::GetList(Array(), Array("IBLOCK_ID"=>$arResult["PROP_LIST"][$arParams["PROP_TAXONOMY"][$key]]["LINK_IBLOCK_ID"] /*, "NAME"=>array_unique($flt)*/));
						while($enum_fields = $property_enums->GetNext())
							$arResult["PROP_LIST"][$arParams["PROP_TAXONOMY"][$key]]["ENUM_VALUE"][$enum_fields["ID"]]=$enum_fields["NAME"];
							
						$f=$arResult["PROP_LIST"][$arParams["PROP_TAXONOMY"][$key]]["ENUM_VALUE"];
						foreach($arResult["PROP_LIST_FLT"][$arResult["PROP_LIST"][$arParams["PROP_TAXONOMY"][$key]]["CODE"]] as $value){
							$value_tmp=str_replace(" ","",$value);
							if(
								$value_tmp!=" "
								&& !in_array($value,$f)
								&& !in_array($value." ",$f)
								&& (substr($value,strlen($value)-1,strlen($value))==" "&&!in_array(substr($value,0,strlen($value)-1),$f))
							){	

								$rsElement = new CIblockElement;
								if($ElemID = $rsElement->Add(Array('IBLOCK_ID'=>$arResult["PROP_LIST"][$arParams["PROP_TAXONOMY"][$key]]["LINK_IBLOCK_ID"], 'NAME'=>$value)))
									$arResult["PROP_LIST"][$arParams["PROP_TAXONOMY"][$key]]["ENUM_VALUE"][$ElemID]=$value;	
							}
						}
					}
					if($k=="G"&&$arParams["CREATE_G_PROP"]=="Y"){
						$property_enums = CIblockSection::GetList(Array(), Array("IBLOCK_ID"=>$arResult["PROP_LIST"][$arParams["PROP_TAXONOMY"][$key]]["LINK_IBLOCK_ID"]/*, "NAME"=>array_unique($flt)*/));
						while($enum_fields = $property_enums->GetNext())
							$arResult["PROP_LIST"][$arParams["PROP_TAXONOMY"][$key]]["ENUM_VALUE"][$enum_fields["ID"]]=$enum_fields["NAME"];
							
						$f=$arResult["PROP_LIST"][$arParams["PROP_TAXONOMY"][$key]]["ENUM_VALUE"];
						foreach($arResult["PROP_LIST_FLT"][$arResult["PROP_LIST"][$arParams["PROP_TAXONOMY"][$key]]["CODE"]] as $value){
							$value_tmp=str_replace(" ","",$value);
							if(
								$value_tmp!=" "
								&& !in_array($value,$f)
								&& !in_array($value." ",$f)
								&& (substr($value,strlen($value)-1,strlen($value))==" "&&!in_array(substr($value,0,strlen($value)-1),$f))
							){	

								$rsSection = new CIblockSection;
								if($SectID = $rsSection->Add(Array('IBLOCK_ID'=>$arResult["PROP_LIST"][$arParams["PROP_TAXONOMY"][$key]]["LINK_IBLOCK_ID"], 'NAME'=>$value)))
									$arResult["PROP_LIST"][$arParams["PROP_TAXONOMY"][$key]]["ENUM_VALUE"][$SectID]=$value;	
							}
						}
					}
					if($k=="U"&&$arParams["CREATE_U_PROP"]=="Y"){
						$property_enums = CUser::GetList();
						while($enum_fields = $property_enums->GetNext())
							$arResult["PROP_LIST"][$arParams["PROP_TAXONOMY"][$key]]["ENUM_VALUE"][$enum_fields["ID"]]=$enum_fields["NAME"];

						$f=$arResult["PROP_LIST"][$arParams["PROP_TAXONOMY"][$key]]["ENUM_VALUE"];
						foreach($arResult["PROP_LIST_FLT"][$arResult["PROP_LIST"][$arParams["PROP_TAXONOMY"][$key]]["CODE"]] as $value){
							$value_tmp=str_replace(" ","",$value);
							if(
								$value_tmp!=" "
								&& !in_array($value,$f)
								&& !in_array($value." ",$f)
								&& (substr($value,strlen($value)-1,strlen($value))==" "&&!in_array(substr($value,0,strlen($value)-1),$f))
							){	

								$rsUser = new CUser;
								if($UserID = $rsUser->Add(Array('IBLOCK_ID'=>$arResult["PROP_LIST"][$arParams["PROP_TAXONOMY"][$key]]["LINK_IBLOCK_ID"], 'NAME'=>$value)))
									$arResult["PROP_LIST"][$arParams["PROP_TAXONOMY"][$key]]["ENUM_VALUE"][$UserID]=$value;	
							}
						}
					}
				}
			}
			//старт импорта

			unset($arResult["DATA"][1]);
			$el=new CIBlockElement;
			foreach($arResult["DATA"] as $k=>$arEl){
				$arUpdElement=array();
				foreach($arParams["PROP_TAXONOMY"] as $let=>$prop)
					if(in_array($prop,array("ID","NAME","ACTIVE","IBLOCK_SECTION","PREVIEW_TEXT","DETAIL_TEXT","CODE")))
						$arUpdElement[$prop]=$arEl[$let];
					else
						$arUpdElementPval[$prop]=$arEl[$let];
						
				if(intval($arUpdElement["ID"])>0){
					if($el->Update($arUpdElement["ID"],$arUpdElement))
						$arResult["UPDATED"][]=$arUpdElement["ID"];
					CIBlockElement::SetPropertyValuesEx($arUpdElement["ID"], $arParams["IBLOCK_ID"], $arUpdElementPval);
				}else{
					$arUpdElement["IBLOCK_ID"]=$arParams["IBLOCK_ID"];
					$arUpdElement["PROPERTY_VALUES"]=$arUpdElementPval;
					if($id=$el->Add($arUpdElement))
						$arResult["ADDED"][]=$id;
				}
			}
		}
	}
}
if($oldini>0) ini_set('mbstring.func_overload',$oldini);
$this->IncludeComponentTemplate();
?>