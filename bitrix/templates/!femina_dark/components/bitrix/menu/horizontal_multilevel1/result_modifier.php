<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// удалим все уровни выше второго

foreach($arResult as $k => $v) {
	if($v["DEPTH_LEVEL"]>2) unset($arResult[$k]);
	if($v["DEPTH_LEVEL"]==2) $arResult[$k]["IS_PARENT"]="";
	
	// установим ссылку на партнерство в личном кабинете если пользователь авторизован
	if($v["TEXT"]=="Сотрудничество") {
		if($USER->isAuthorized()) $arResult[$k]["LINK"] = "/personal/partner.html";
		}
	}
unset($arResult[1]);
unset($arResult[8]);
unset($arResult[15]);
unset($arResult[24]);
$arResult[0]["IS_PARENT"] = "";
	
//pra($arResult);
?>
