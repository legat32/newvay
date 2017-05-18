<?include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?

$arArticuls = Array('ВК-19','ВК-20','ВК-21','3004','3027','3056','3058','3065','3076','3077','3081','3083','3090','3090-1','3092','3093','3094','3095','3096','3097','3098','3099','3100','3104','3106','3107','3109','3111','3112','3114','3115','3116','3117','3123','3124','3125','3125-1','3129','3130','3131','3132','3133','3136','3137','3139','3140','3141','3142','3143','3144','3145','3146','3147','3148','3149','3151','3152','3153','3154','3155','3157','3158','3159','3160','3162','3163','3165','3166','3168','3169','3170','3171','3172','3176','3181','3182','3182-1','3184','3186','3188','3189','3190','3192','3193','3194','3195','3197','3198','3199','3203','3204','3205','3206','3207','3208','3209','3210','3211','3213','3213\1','3215','3220','3221','3222','3223','3224','3225','3226','3227','3228','3229','3233','3234','3235','3236','3237','3238','3239','3240','3241','3242','3244','3245','3246','3247','3248','3249','3250','3255','3256','3257','3258','3259','3260','3261');
sort($arArticuls);




// Если надо удалим все акции (свойство Акция на сайте в пустое)

$dbRes = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 6, "PROPERTY_AKCIYA_ON_SITE" => "Y"), false, false, Array("ID", "NAME", "PROPERTY_CML2_ARTICLE", "PROPERTY_AKCIYA_ON_SITE"));
while($arRes = $dbRes->GetNext())
{
	CIBlockElement::SetPropertyValuesEx($arRes["ID"], false, array("AKCIYA_ON_SITE" => ""));
	\Bitrix\Iblock\PropertyIndex\Manager::updateElementIndex(6, $arRes["ID"]);
}



 


// set action
/*
$dbRes = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 6, "PROPERTY_CML2_ARTICLE" => $arArticuls), false, false, Array("ID", "NAME", "PROPERTY_CML2_ARTICLE", "PROPERTY_AKCIYA_ON_SITE"));
while($arRes = $dbRes->GetNext())
{
	CIBlockElement::SetPropertyValuesEx($arRes["ID"], false, array("AKCIYA_ON_SITE" => "Y"));
	\Bitrix\Iblock\PropertyIndex\Manager::updateElementIndex(6, $arRes["ID"]);
}
*/




//kick Action
/*
$dbRes = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 6, "PROPERTY_AKCIYA_ON_SITE" => "Y"), false, false, Array("ID", "NAME", "PROPERTY_CML2_ARTICLE", "PROPERTY_AKCIYA_ON_SITE"));
while($arRes = $dbRes->GetNext())
{
	prn($arRes["NAME"]." ".$arRes["PROPERTY_AKCIYA_ON_SITE_VALUE"]);
	CIBlockElement::SetPropertyValuesEx($arRes["ID"], false, array("AKCIYA_ON_SITE" => ""));
}
CIBlock::clearIblockTagCache(6);
CIBlock::clearIblockTagCache(7);
*/





// check action

$dbRes = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 6, "PROPERTY_AKCIYA_ON_SITE" => "Y"), false, false, Array("ID", "NAME", "PROPERTY_CML2_ARTICLE", "PROPERTY_AKCIYA_ON_SITE"));
while($arRes = $dbRes->GetNext())
{
	prn($arRes["NAME"]);
	//break;
}

?>
<hr>
fin
<hr>