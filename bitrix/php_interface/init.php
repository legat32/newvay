<?
//include $_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/agents.php";
//if(($_SERVER["REMOTE_ADDR"] != "91.203.208.225")&&($_SERVER["REMOTE_ADDR"] != "194.28.29.223")) 
if($_SERVER["REMOTE_ADDR"] == "95.37.103.213") die("Обратитесь к менеджеру...");
//die("newvay");





// Определение констант
define("RETAIL_PRICE", 5);			// розничная цена
define("DEALER_PRICE", 3);			// оптовая цена
define("JOINT_PRICE", 2);			// цена для совместных покупок
define("PRODUCTS_IBLOCK_ID", 6);
define("OFFERS_IBLOCK_ID", 7);
define("LINK_PROPERTY_ID", 87);
define("LINK_PROPERTY_CODE", "CML2_LINK");
define("BUY_LIMIT", 30);				// ограничение на кол-во товаров для покупки для пользователя

define("PROPERTY_FEATURES_ID", 52);		// ID свойства FEATURES (характеристики, пришедшие из 1с)
define("PROPERTY_COLOR_LIST_ID", 193);	// ID свойства COLOR_LIST
define("PROPERTY_SIZE_LIST_ID", 194);	// ID свойства SIZE_LIST

define("NOFOTO_FILE_ID", 191491);		// ID файла заглушки

define("VAY_SECTION_ID", 209);
define("VAY_NAME", "Женский трикотаж");
define("VAY_COLOR", "#7475AC");
define("DETSKIYTRIKOTAZH_SECTION_ID", 246);
define("DETSKIYTRIKOTAZH_NAME", "Детский трикотаж");
define("DETSKIYTRIKOTAZH_COLOR", "#dd3163");
define("VAYKIDS_SECTION_ID", 247);
define("VAYKIDS_NAME", "VAY KIDS");
define("VAYKIDS_COLOR", "#72CEF1");
define("VESNUSHKI_SECTION_ID", 256);
define("VESNUSHKI_NAME", "Веснушки");
define("VESNUSHKI_COLOR", "#F3B32C");
define("VAYMAN_SECTION_ID", 271);
define("VAYMAN_NAME", "Мужской каталог");
define("VAYMAN_COLOR", "#8E8E8E");
define("AKSESSUARY_SECTION_ID", 273);
define("AKSESSUARY_NAME", "Аксессуары");
define("AKSESSUARY_COLOR", "#8E8E8E");
define("PODARKI_SECTION_ID", 298);
define("PODARKI_NAME", "Подарки");
define("PODARKI_COLOR", "#8E8E8E");


define("WIDTH_ORIGINAL_PHOTO", 1100);
define("HEIGHT_ORIGINAL_PHOTO", 1600);
define("WIDTH_MAIN_PHOTO",  533);
define("HEIGHT_MAIN_PHOTO", 800);
define("WIDTH_PREVIEW_PHOTO",  280);
define("HEIGHT_PREVIEW_PHOTO", 420);



//if(file_exists(__DIR__."/include/functions.php"))
	//require_once(__DIR__."/include/functions.php");

 
// функции распечатки
 
function prn($str){
	echo '<pre style="border:1px solid black; background-color: #eee; color:black; z-index:10000000;">';
	print_r($str);
	echo '</pre>'; 
	}

function prd($str){
	echo '<pre style="border:1px solid black; background-color: #eee; color:black;">';  
	print_r($str);
	echo '</pre>';
	die();
	}
	
function pra($str) {
	global $USER;
	if($USER->isAdmin()) {
		prn($str); 
		}
	}
	
function prnip($str) {
	if($_SERVER["REMOTE_ADDR"] == "194.28.29.223") {
		prn($str); 
		}
	}
	
function prdip($str) {
	if($_SERVER["REMOTE_ADDR"] == "194.28.29.223") {
		prd($str); 
		}
	}
	

 

/*
if($_SERVER["REMOTE_ADDR"] == "194.28.29.223")
{
	$t = explode("?", $_SERVER["REQUEST_URI"]);
	$request_uri = $t[0];
	echo "<pre>";
	print_r($t);
	print_r($request_uri);
	
	if(strpos(" ".$_SERVER["REQUEST_URI"], "clear_cache=Y") > 0) $exists = true;
	
	echo $exists ? "<br/>EXISTS" : "<br/>NO";
	
	echo "</pre>";
	//echo "3";
	die();
	
}	
*/


// проверка нагрузки сервера
// (если нагрузка больше чем $limit то закрываем сайт на $pause секунд)


//if($_SERVER["REMOTE_ADDR"] == "5.9.102.136") die("call to system admin");
//if($_SERVER["REMOTE_ADDR"] == "62.76.102.225") die("call to system admin"); // sliza


if(($_SERVER["REMOTE_ADDR"] != "91.203.208.225")&&($_SERVER["REMOTE_ADDR"] != "89.20.42.90")/*&&($_SERVER["REMOTE_ADDR"] != "194.28.29.223")*/)
{
	//echo "<p>Слишком много подключений. Повторите попытку через несколько минут...";
	//die();

	
	$log = false;
	if($log)
	{
		$f = fopen($_SERVER["DOCUMENT_ROOT"]."/logs.txt", "a+");
		fwrite($f, date("d.m.Y H:i:s", time()).": ".$_SERVER["REMOTE_ADDR"]."; ".$_SERVER["REQUEST_URI"]."\n");
		fclose($f);
	}

	$b = Array();
	$a = exec("cat /proc/loadavg", $b);
	$cp = explode(" ", $b[0]);
	$f = fopen($_SERVER["DOCUMENT_ROOT"]."/load.txt", "a+");
	if((date("s") == "00")||(date("s") == "30")) fwrite($f, date("d.m.Y H:i:s")." - ".implode(" ", $cp)."\n");
	fclose($f);

	$limit = 12; 
	$pause = 10; // sec

	$kill = false;

	if(file_exists($_SERVER["DOCUMENT_ROOT"]."/blocktime.txt"))
	{
		$u = file($_SERVER["DOCUMENT_ROOT"]."/blocktime.txt");
		$t1 = $u[0];
		if( (time() - $t1) < $pause) $kill = true;
		else unlink($_SERVER["DOCUMENT_ROOT"]."/blocktime.txt");
	}
	else
	{
		// и исключим из проверки компьютер с которого идет выгрузка данных на сайт (91.203.208.225)
		if( ($cp[0] > $limit) || ($cp[1] > $limit) || ($cp[2] > $limit) ) 
		{
			$f = fopen($_SERVER["DOCUMENT_ROOT"]."/blocktime.txt", "w+");
			fwrite($f, time());
			fclose($f);
			$kill = true;
		}
	}
	
	if($kill) 
	{
		header("Content-Type: text/html; charset=utf-8");
		echo "<p>Производится обновление каталога. Зайдите через несколько минут...";
		//echo "<p>Слишком много подключений. Повторите попытку через несколько минут...";
		
		$f = fopen($_SERVER["DOCUMENT_ROOT"]."/blocked.txt", "a+");
		fwrite($f, date("d.m.Y H:i:s", time())."\n");
		fclose($f);
		
		die();
	}
	
}








	
//global $USER;
//if(!$USER->isAdmin()) die("Site under construction");

//prn($_SERVER["REQUEST_URI"]);
//if(strpos(" ", "/vay/", $_SERVER["REQUEST_URI"])>0) echo "Y";
//if(strpos(" ", "/vay/", $_SERVER["REQUEST_URI"])>0) LocalRedirect("/vay/", false, "301");
//if(strpos(" ", "/jw/", $_SERVER["REQUEST_URI"])>0) LocalRedirect("/jw/", false, "301");
//if(strpos(" ", "/vay-kids/", $_SERVER["REQUEST_URI"])>0) LocalRedirect("/vay-kids/", false, "301");
//if(strpos(" ", "/vesnushki/", $_SERVER["REQUEST_URI"])>0) LocalRedirect("/vesnushki/", false, "301");



function custom_mail($to,$subject,$body,$headers) {
	$f=fopen($_SERVER["DOCUMENT_ROOT"]."/maillog.txt", "a+");
	fwrite($f, print_r(array('TO' => $to, 'SUBJECT' => $subject, 'BODY' => $body, 'HEADERS' => $headers),1)."\n========\n");
	fclose($f);
	return mail($to,$subject,$body,$headers);
}




//echo $_SERVER["REQUEST_URI"];
//die();


//die("123");

// ==============================================
// ПЕРЕАДРЕСАЦИЯ СО СТАРЫХ АДРЕСОВ НА НОВЫЕ
// ==============================================
/*
$url = Array(
	"/vay.html" => "/vay/",
	"/vay/osnovnoie-katalog/jaketi.html" => "/vay/zhakety/", 
	"/vay/osnovnoie-katalog/djemperi.html" => "/vay/dzhempery/",
	"/vay/osnovnoie-katalog/platya.html" => "/vay/platya-kostyumy-yubki/",
	"/vay/osnovnoie-katalog/jileti.html" => "/vay/zhilety/",
	"/vay/osnovnoie-katalog/viskoza.html" => "/vay/viskoza/",
	"/jw.html" => "/jw/",
	"/jw/osnovnoie-katalog/jaketi.html" => "/jw/zhakety/",
	"/jw/osnovnoie-katalog/djemperi.html" => "/jw/dzhempery/",
	"/jw/osnovnoie-katalog/platya.html" => "/jw/platya/",
	"/jw/osnovnoie-katalog/jileti.html" => "/jw/",
	"/jw/osnovnoie-katalog/poncho.html" => "/jw/",
	"/jw/osnovnoie-katalog/novaya-kollekciya.html" => "/jw/novaya-kollektsiya/",
	"/vay-kids.html" => "/vay-kids/",
	"/vay-kids/ot-rojdeniya-do-15-let.html" => "/vay-kids/novorozhdennye/",
	"/vay-kids/delovaya-i-shkolnaya-odejda.html" => "/vay-kids/shkolnyy-trikotazh/",
	"/vay-kids/vesnushki.html" => "/vesnushki/",
	"/katalog.html" => "/catalog/"
	);
if(isset($url[$_SERVER["REQUEST_URI"]]))
{
	LocalRedirect($url[$_SERVER["REQUEST_URI"]], true, "301 Moved Permanently");
	die();
}
*/





/*
$f = fopen($_SERVER["DOCUMENT_ROOT"]."/log.csv", "a+");
fwrite($f, date("d.m.Y H:i:s").";".$_SERVER['REMOTE_ADDR'].";http://newvay.ru".$_SERVER["REQUEST_URI"].";".$_SERVER["HTTP_REFERER"]."\n");
fclose($f); 
*/



// подготовим массив arDetailPageURL и arSectionPageURL для корректировки адресов карточек товара 
// и исключения неправильных адресов из ЧПУ (косяк Битрикса) 
CModule::IncludeModule("iblock");
$arDetailPageURL = Array();
$arSectionPageURL = Array();

$obCache = new CPHPCache();
$cacheLifetime = 120;
//$cacheLifetime = 300; 
$cacheID = 'arDetailPageURL'; 
$cachePath = '/'.$cacheID;
//$cachePath = '/';
if( $obCache->InitCache($cacheLifetime, $cacheID, $cachePath) ) { 
	$arr = $obCache->GetVars();
	$arDetailPageURL = $arr["arDetailPageURL"];
	$arSectionPageURL = $arr["arSectionPageURL"];
	$arNewPathRedirect = $arr["arNewPathRedirect"];
	//echo "get from cache<hr/>"; 
	}
elseif( $obCache->StartDataCache()  ) {
	$arDetailPageURL = Array();
	$dbRes = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 6, "ACTIVE" =>"Y"), false, false, Array("ID", "CODE", "DETAIL_PAGE_URL"));
	while($arRes = $dbRes->GetNext()) {
		$arNewPathRedirect[$arRes["CODE"].".html"] = $arRes["DETAIL_PAGE_URL"];
		$sect = substr($arRes["DETAIL_PAGE_URL"], 0, strrpos($arRes["DETAIL_PAGE_URL"], "/")+1);
		$root_sect = substr($arRes["DETAIL_PAGE_URL"], 0, strpos($arRes["DETAIL_PAGE_URL"], "/", 2)+1);
		if(!in_array($sect, $arSectionPageURL)) $arSectionPageURL[] = $sect;
		if(!in_array($root_sect, $arSectionPageURL)) $arSectionPageURL[] = $root_sect;
		$arDetailPageURL[$arRes["ID"]] = $arRes["DETAIL_PAGE_URL"];
		}
	$arr = Array("arSectionPageURL" => $arSectionPageURL, "arDetailPageURL" => $arDetailPageURL, "arNewPathRedirect" => $arNewPathRedirect);
	$obCache->EndDataCache($arr);
	//echo "update cache<hr/>";
}
$GLOBALS["arDetailPageURL"] = $arDetailPageURL;






//prd($_SERVER["REQUEST_URI"]);
//prn($arNewPathRedirect);
//die();





if($_SERVER["REAL_FILE_PATH"] == "/shop/index.php")
{
	if(strpos($_SERVER["REQUEST_URI"], ".html") > 0)   // если карточка товара
	{
		$t = explode("?", $_SERVER["REQUEST_URI"]);
		$part1 = $t[0];
		if(isset($t[1])) $part2 = "?".$t[1];
		else $part2 = "";
		$code = substr($part1, strrpos($part1, "/")+1);
		//prd($code);
		if(isset($arNewPathRedirect[$code]))
		{
			$real_path = $arNewPathRedirect[$code];
			//prd($real_path);
			if(strpos(" ".$_SERVER["REQUEST_URI"], $real_path) > 0) $ok = true;
			else
			{
				//prd($real_path.$part2);
				LocalRedirect($real_path.$part2, true, "301 Moved permanently");
			}
		}
	}
	else     // раздел
	{
		$newURL = "";
		$t = explode("?", $_SERVER["REQUEST_URI"]);
		$part1 = $t[0];
		if(isset($t[1])) $part2 = "?".$t[1];
		else $part2 = "";
		$list = Array(
			"/detskiy-trikotazh/vay-kids/" => "/detskiy-trikotazh/vay-kids-povsednevnyy-trikotazh/",
			"/detskiy-trikotazh/vay-kids/dzhempery-detskie/" => "/detskiy-trikotazh/vay-kids-povsednevnyy-trikotazh/dzhempery-tuniki/",
			//"/detskiy-trikotazh/vay-kids/novorozhdennye/" => "",
			"/detskiy-trikotazh/vay-kids/platya/" => "/detskiy-trikotazh/vay-kids-povsednevnyy-trikotazh/platya-sarafany/",
			//"/detskiy-trikotazh/vay-kids/rasprodazha/" => "",
			"/detskiy-trikotazh/vay-kids/reytuzy-detskie/" => "/detskiy-trikotazh/vay-kids-povsednevnyy-trikotazh/reytuzy-detskie/",
			"/detskiy-trikotazh/vay-kids/shkolnyy-trikotazh/" => "/detskiy-trikotazh/vay-kids-shkola/",
			"/detskiy-trikotazh/vay-kids/viskoza-detskaya/" => "",
			"/detskiy-trikotazh/vay-kids/zhakety-detskie/" => "/detskiy-trikotazh/vay-kids-povsednevnyy-trikotazh/zhakety-detskie/",
			"/detskiy-trikotazh/vay-kids/zhilety-detskie/" => "/detskiy-trikotazh/vay-kids-povsednevnyy-trikotazh/zhilety-detskie/",
			"/detskiy-trikotazh/vay-kids/dzhempery-detskie/" => "/detskiy-trikotazh/vay-kids-povsednevnyy-trikotazh/dzhempery-tuniki/",
			"/detskiy-trikotazh/vesnushki/dzhempery-detskie/" => "/detskiy-trikotazh/vesnushki/dzhempery-tuniki/",
			"/detskiy-trikotazh/vesnushki/novorozhdennye/" => "",
			"/detskiy-trikotazh/vesnushki/platya-detskie/" => "/detskiy-trikotazh/vay-kids-povsednevnyy-trikotazh/platya-sarafany/",
			"/detskiy-trikotazh/vesnushki/rasprodazha/" => "",
			"/detskiy-trikotazh/vesnushki/reytuzy/" => "/detskiy-trikotazh/vay-kids-povsednevnyy-trikotazh/reytuzy-detskie/",
			"/detskiy-trikotazh/vesnushki/zhakety-detskie/" => "/detskiy-trikotazh/vay-kids-povsednevnyy-trikotazh/zhakety-detskie/"
			);
		if(isset($list[$part1])) $newURL = $list[$part1];
		///detskiy-trikotazh/vay-kids/platya
		//$code = substr($part1, strrpos($part1, "/")+1);
		//prd($newURL);
		//prd($part1);
		if(strLen($newURL)>0) LocalRedirect($newURL.$part2, true, "301 Moved permanently");
	}
}



// Жестко отсекаем неправильные URL по карточке и по разделу

if($_SERVER["REAL_FILE_PATH"] == "/shop/index.php")
{

	$exist = false;
	
	if(strpos($_SERVER["REQUEST_URI"], ".html") > 0)   // если карточка товара
	{
		
		//$t = explode("
		
		
		
		/*
		if(
			(strpos(" ".$_SERVER["REQUEST_URI"], "clear_cache") > 0) || 
			(strpos(" ".$_SERVER["REQUEST_URI"], "bitrix_include_areas") > 0)
			) 
			$exist = true;
		*/
		if((strpos(" ".$_SERVER["REQUEST_URI"], "clear_cache") > 0) || (strpos(" ".$_SERVER["REQUEST_URI"], "bitrix_include_areas") > 0) || (!empty($_GET["color"])) || (!empty($_GET["offer"])) || (strpos(" ".$_SERVER["REQUEST_URI"], "action=") > 0)) 
			$exist = true;
		else 
		{
			foreach($arDetailPageURL as $url) 
			{
				
				$request_url = $_SERVER["REQUEST_URI"];
				
				if($request_url == $url) 
				{
					$exist = true;
					break;
				}
			}
		}
	}
	else // если раздел
	{
		/*
		foreach($arSectionPageURL as $url) 
		{
			if(($_SERVER["REQUEST_URI"] == $url) || (strpos(" ".$_SERVER["REQUEST_URI"], $url."?") > 0) )
			{
				$exist = true;
				break;
			}
		}
		*/
		$exist = true;
	}
	
	if(isset($_GET["logout"])) $exist = true;
	
	if(!$exist) 
	{
		ob_clean();
		header("HTTP/1.0 404 Not Found");
		echo "<center>";
		echo "<br/><br/><br/><br/><br/><br/>";
		echo "<a href='http://www.newvay.ru/'><img src='/assets/logo8.png'/></a><br/>";
		echo "<br/><h1>404</h1><p>Страница не найдена</p>";
		echo "<p><a href='/'>Главная страница сайта</a></p><br/>";
		echo "<form action='/search/' method='get'>";
		echo "<input type='text' name='q' placeholder='Введите номер артикула'>&nbsp;&nbsp;";
		echo "<input type='submit' name='s' value='Найти товар'>";
		echo "</form>";
		echo "</center>";
		die();
	}
}






// Проверка корректности URL для некоторых разделов сайта
/*
if($_SERVER["REAL_FILE_PATH"] == "/sale/index.php") {
	$url = str_replace("/sale", "", $_SERVER["REQUEST_URI"]);
	if(strpos($url, "?") > 0) $url = substr($url, 0, strpos($url, "?"));
	if(!in_array($url, $arSectionPageURL)) define("ERROR_404", "Y");
	}
if($_SERVER["REAL_FILE_PATH"] == "/shop/index.php") {
	$url = $_SERVER["REQUEST_URI"];
	if(strpos($url, "?") > 0) $url = substr($url, 0, strpos($_SERVER["REQUEST_URI"], "?"));
	if(!in_array($url, $arDetailPageURL) && !in_array($url, $arSectionPageURL)) define("ERROR_404", "Y");
	}
*/




// Справочно - цвета
// VAY			#7475ac
// JW			#dd3163
// VAYKIDS		#72cef1
// ВЕСНУШКИ		#F3B32C





//pra($arDetailPageURL);
//die();
	
/*	
AddEventHandler("catalog", "OnGetOptimalPrice", "OnGetOptimalPriceHandler");

function OnGetOptimalPriceHandler($productID, $quantity){

   //die('oops');
   
	//prn($quantity);
   //prd($productID);
   
   return array(
      'PRICE' => array(
         "ID" => $productID,
         'CATALOG_GROUP_ID' => 1,
         'PRICE' => 300,
         'CURRENCY' => "RUB",
         'ELEMENT_IBLOCK_ID' => $productID,
         'VAT_INCLUDED' => "Y",
      ),
      'DISCOUNT' => array(
         'VALUE' => 100,
         'CURRENCY' => "RUB")
   );
   
}
	*/
	

	
// Коды округов федеральных (http://newvay.ru/bitrix/admin/userfield_edit.php?ID=45&lang=ru)
$OKRUGS = Array(
	10 => "Центральный",
	11 => "Южный",
	12 => "Северо-Западный",
	13 => "Дальневосточный",
	14 => "Сибирский",
	15 => "Уральский",
	16 => "Приволжский",
	17 => "Северо-Кавказский",
	18 => "Крымский",
	22 => "Беларусь",
	23 => "Казахстан",
	24 => "Украина"
	);
// Типы партнерства (http://newvay.ru/bitrix/admin/userfield_edit.php?ID=46&lang=ru)
$PARTNER_TYPES = Array(
	19 => "ООО",
	20 => "ИП",
	21 => "Физлицо"
	);
	
	

	
// выяснение e-mail менеджера в зависимости от ассортимента и округа
// данные по ID окургов (вкладка список) - http://newvay.ru/bitrix/admin/userfield_edit.php?ID=45&lang=ru
// данные по ID ассортиментов (вкладка список) - http://newvay.ru/bitrix/admin/userfield_edit.php?ID=39&lang=ru
	
function get_manager_mail($UF_ASSORTIMENT, $UF_OKRUG)
{
	global $APPLICATION;
	$res = COption::GetOptionString("main", "email_from", "commander@mail.ru");
	
	$BYSTROVA = 	"be@newvay.ru,elenabonita@list.ru";
	$KORSHAK = 		"ok@newvay.ru";
	$SERBINA = 		"os@newvay.ru";
	$ZOLOTAREVA = 	"manager-kids@newvay.ru";
	$ANTIPOV = 		"misha@newvay.ru";
	$KRASAVINA = 	"tatyana@newvay.ru";
	//$ZENINA = 	"nz@newvay.ru";
	
	if($UF_ASSORTIMENT == 28) // женский
	{
		if($UF_OKRUG == 10) $res = implode(",", Array($KRASAVINA, $ZOLOTAREVA));
		if($UF_OKRUG == 11) $res = implode(",", Array($KRASAVINA, $ZOLOTAREVA));
		if($UF_OKRUG == 12) $res = $SERBINA;
		if($UF_OKRUG == 13) $res = $KORSHAK;
		if($UF_OKRUG == 14) $res = $KORSHAK;
		if($UF_OKRUG == 15) $res = $ZOLOTAREVA;
		if($UF_OKRUG == 16) $res = $ANTIPOV;
		if($UF_OKRUG == 17) $res = $KRASAVINA;
		if($UF_OKRUG == 18) $res = $KRASAVINA;
		if($UF_OKRUG == 22) $res = $KORSHAK;
		if($UF_OKRUG == 23) $res = $KORSHAK;
		if($UF_OKRUG == 24) $res = $KORSHAK;
	}
	
	if($UF_ASSORTIMENT == 27) // детский
	{
		if($UF_OKRUG == 10) $res = implode(",", Array($KRASAVINA, $ZOLOTAREVA));
		if($UF_OKRUG == 11) $res = implode(",", Array($KRASAVINA, $ZOLOTAREVA));
		if($UF_OKRUG == 12) $res = implode(",", Array($SERBINA, $ZOLOTAREVA));
		if($UF_OKRUG == 13) $res = implode(",", Array($KORSHAK, $ZOLOTAREVA));
		if($UF_OKRUG == 14) $res = implode(",", Array($KORSHAK, $ZOLOTAREVA));
		if($UF_OKRUG == 15) $res = $ZOLOTAREVA;
		if($UF_OKRUG == 16) $res = implode(",", Array($ANTIPOV, $ZOLOTAREVA));
		if($UF_OKRUG == 17) $res = implode(",", Array($KRASAVINA, $ZOLOTAREVA));
		if($UF_OKRUG == 18) $res = implode(",", Array($KRASAVINA, $ZOLOTAREVA));
		if($UF_OKRUG == 22) $res = implode(",", Array($KORSHAK, $ZOLOTAREVA));
		if($UF_OKRUG == 23) $res = implode(",", Array($KORSHAK, $ZOLOTAREVA));
		if($UF_OKRUG == 24) $res = implode(",", Array($KORSHAK, $ZOLOTAREVA));
		//$res = $ZOLOTAREVA;
	}
	
	return $res;
}

// предыдущая версия этой функции	
function get_manager_mail_($UF_ASSORTIMENT, $UF_OKRUG)
{
	global $APPLICATION;
	$res = COption::GetOptionString("main", "email_from", "commander@mail.ru");
	
	$MANAGER_DETSKIY = 			"manager-kids@newvay.ru,nz@newvay.ru";
	$MANAGER_CENTER = 			"tatyana@newvay.ru,be@newvay.ru,elenabonita@list.ru";
	$MANAGER_JUZHNIY = 			"tatyana@newvay.ru,be@newvay.ru,elenabonita@list.ru";
	$MANAGER_SEVERO_KAVKAZ = 	"tatyana@newvay.ru";
	$MANAGER_SEVERO_ZAPAD = 	"os@newvay.ru";
	$MANAGER_URAL = 			"be@newvay.ru,elenabonita@list.ru";
	$MANAGER_PRIVOLZHSKIY = 	"misha@newvay.ru";
	$MANAGER_CRIMEA = 			"tatyana@newvay.ru";
	$MANAGER_DALNIY_VOSTOK = 	"ok@newvay.ru";
	$MANAGER_SIBERIA = 			"ok@newvay.ru";
	//$MANAGER_SIBERIA = 		"regret@newvay.ru";	
	$MANAGER_BELARUS = 			"ok@newvay.ru";
	$MANAGER_KAZAKHSTAN = 		"ok@newvay.ru";
	$MANAGER_UKRAINE = 			"ok@newvay.ru";
	
	if($UF_ASSORTIMENT == 27)  											// если ассортимент детский
	{
		$res = $MANAGER_DETSKIY;										// mail детский
	}
	else
	{
		if($UF_OKRUG == 10) $res = $MANAGER_CENTER;
		if($UF_OKRUG == 11) $res = $MANAGER_JUZHNIY;
		if($UF_OKRUG == 12) $res = $MANAGER_SEVERO_ZAPAD;
		if($UF_OKRUG == 13) $res = $MANAGER_DALNIY_VOSTOK;
		if($UF_OKRUG == 14) $res = $MANAGER_SIBERIA;
		if($UF_OKRUG == 15) $res = $MANAGER_URAL;
		if($UF_OKRUG == 16) $res = $MANAGER_PRIVOLZHSKIY;
		if($UF_OKRUG == 17) $res = $MANAGER_SEVERO_KAVKAZ;
		if($UF_OKRUG == 18) $res = $MANAGER_CRIMEA;
		if($UF_OKRUG == 22) $res = $MANAGER_BELARUS;
		if($UF_OKRUG == 23) $res = $MANAGER_KAZAKHSTAN;
		if($UF_OKRUG == 24) $res = $MANAGER_UKRAINE;
	}
	
	if($UF_ASSORTIMENT < 1) $res = "";
		
	//$res = "turtell@yandex.ru";
	
	return $res;

}
	
	


	
function get_file_name($id) 
{	
	global $APPLICATION;
	$rsFile = CFile::GetByID($id);
	if($arFile = $rsFile->Fetch()) 
	{
		$url = 'http://'.$_SERVER["HTTP_HOST"].'/upload/'.$arFile["SUBDIR"].'/'.$arFile["FILE_NAME"];
		return '<a href="'.$url.'" target="_blank">'.$url.'</a>';
	}
	else 
		return '-';
}	




// после добавления заказа вносим ряд дополнительных свойств

AddEventHandler("sale", "OnOrderSave", "OnOrderSaveHandler");
function OnOrderSaveHandler($orderId, $arFields, $arOrder, $arNew)
{
	global $USER;
	
	
	// выборка разделов с указанием ассортимента
	$arFilter = array('IBLOCK_ID' => 6, 'ACTIVE' => 'Y'); 
	$arSelect = array("ID", "NAME", "DEPTH_LEVEL");
	$rsSection = CIBlockSection::GetTreeList($arFilter); 
	$RAZDEL = "";
	$arSections = Array();
	while($arSection = $rsSection->Fetch()) {
		if($arSection["DEPTH_LEVEL"] == 1) $RAZDEL = str_replace("трикотаж", "ассортимент", $arSection["NAME"]);
		else $arSections[$arSection["ID"]] = $RAZDEL;
		if(($arSection["RIGHT_MARGIN"]-$arSection["LEFT_MARGIN"]==1) && ($arSection["DEPTH_LEVEL"] == 1))
		$arSections[$arSection["ID"]] = $RAZDEL;
	} 
	
	//pra($arSections);
	// выясняем какие ассортименты есть в товарах
	/*
	$arGroups = Array();
	foreach($arOrder["BASKET_ITEMS"] as $arItem)
	{
		if(is_array($arItem["CATALOG"]["SECTION_ID"]))
		{
			foreach($arItem["CATALOG"]["SECTION_ID"] as $val)
				$arGroups[$arSections[$val]] = 1;
		}
		else
			$arGroups[$arSections[$arItem["CATALOG"]["SECTION_ID"]]] = 1;
	}
	unset($arGroups[""]);
	ksort($arGroups);
	$VAL_GRUPPA = implode(" / ", array_keys($arGroups));
	*/
	$arID = Array();
	foreach($arOrder["BASKET_ITEMS"] as $arItem)
	{
		$arID[] = $arItem["PRODUCT_ID"];
	}
	$dbRes = CIBlockElement::GetList(Array(), Array("ID" => $arID), false, false, Array("ID", "NAME", "PROPERTY_CML2_LINK.IBLOCK_SECTION_ID"));
	while($arRes = $dbRes->GetNext())
	{
		//if($USER->GetID() == 1) prn($arRes);
		$arGroups[$arSections[$arRes["PROPERTY_CML2_LINK_IBLOCK_SECTION_ID"]]] = 1;
	}
	unset($arGroups[""]);
	ksort($arGroups);
	$VAL_GRUPPA = implode(" / ", array_keys($arGroups));

	
	
	
	
	// вносим в свойство заказа ORDER_CATEGORY в зависимости от типа плательщика
	$arFields = array(
	   "ORDER_ID" => $orderId,
	   "ORDER_PROPS_ID" => $arOrder["PERSON_TYPE_ID"] == 1 ? 26 : 28,    // свойство заказа для юр/физ ORDER_CATEGORY
	   "NAME" => "Группа товаров в заказе",
	   "CODE" => "ORDER_CATEGORY",
	   "VALUE" => $VAL_GRUPPA
		);
	CSaleOrderPropsValue::Add($arFields);
	
	// вносим в свойство заказа PRICE_TYPE в зависимости от типа плательщика
	if(PRICE_TYPE == DEALER_PRICE) 	$VAL_PRICETYPE = "Оптовые";
	if(PRICE_TYPE == JOINT_PRICE) 	$VAL_PRICETYPE = "для Физ.лиц";
	if(PRICE_TYPE == RETAIL_PRICE) 	$VAL_PRICETYPE = "Розничные";
	$arFields = array(
	   "ORDER_ID" => $orderId,
	   "ORDER_PROPS_ID" => $arOrder["PERSON_TYPE_ID"] == 1 ? 27 : 29, 	// свойство заказа для юр/физ PRICE_TYPE
	   "NAME" => "Типы цен",
	   "CODE" => "PRICE_TYPE",
	   "VALUE" => $VAL_PRICETYPE
		);
	CSaleOrderPropsValue::Add($arFields);
	
	// вносим в свойство заказа BASKET_DISCOUNT в зависимости от типа плательщика BASKET_DISCOUNT
	if(defined("DEALER_USER"))
	{
		$arFields = array(
		   "ORDER_ID" => $orderId,
		   "ORDER_PROPS_ID" => $arOrder["PERSON_TYPE_ID"] == 1 ? 30 : 31, 	// свойство заказа для юр/физ BASKET_DISCOUNT
		   "NAME" => "Скидка к корзине",
		   "CODE" => "BASKET_DISCOUNT",
		   "VALUE" => DEALER_USER
			);
		CSaleOrderPropsValue::Add($arFields);
	}
		
	/*
	prn($arSections);
	prn($arGroups);
	prn($VAL_GRUPPA);
	prn($orderId);
	prn($arFields);
	prn($arOrder);
	prn($arNew);
	die();
	*/
	
}


	

// изменения в почтовых шаблонах

AddEventHandler("main", "OnBeforeEventSend", "BeforeNoticeSend");

function BeforeNoticeSend(&$arFields, $arTemplate) {
	
	global $OKRUGS, $PARTNER_TYPES, $APPLICATION, $USER;
	
	// ========= НОВЫЙ ЗАКАЗ (77) / ОТМЕНА ЗАКАЗА (34) ============
	
	if(($arTemplate["ID"] == 77)||($arTemplate["ID"] == 34)) {

		// найдем автора заказа и из его аккаунта возьмем ассортимент и округ 
		$arOrder = CSaleOrder::GetByID($arFields["ORDER_ID"]);
		$arFilter = Array( "ID" => $arOrder["USER_ID"]);
		//$arParam["SELECT"] = Array("UF_CITY", "UF_ASSORTIMENT", "UF_OKRUG");
		$arParam["SELECT"] = Array("UF_*");
		$rsUser = CUser::GetList(($by="personal_country"), ($order="desc"), $arFilter, $arParam); 
		if($arUser = $rsUser->GetNext()) {
			$UF_OKRUG = $arUser["UF_OKRUG"];
			$UF_ASSORTIMENT = $arUser["UF_ASSORTIMENT"];
			$arFields["ORDER_USER_ID"] = $arOrder["USER_ID"];
			}
			

		
			
		// обновим данные по ассортименту из заказа (на случай если пользователь сделал заказ другого ассортимента)
		// (по умолчанию берется из данных пользователя выше)
		$UF_ASSORTIMENT = 28;  // по умолчанию все обрабатывается как для женского
		$dbVals = CSaleOrderPropsValue::GetList( array("SORT" => "ASC"), array("ORDER_ID" => $arFields["ORDER_ID"]));
		$delivery_types = Array(
			"avia" => "Авиатранспорт",
			"train" => "Железнодорожный транспорт",
			"avto" => "Автомобильный транспорт"
			);
		$str = "";
		while($arVals = $dbVals->GetNext())
		{
			// смотреть тут http://newvay.ru/bitrix/admin/userfield_admin.php?lang=ru
			//if($arVals["VALUE"] == "Детский ассортимент / Женский ассортимент") $UF_ASSORTIMENT = 28;
			//if($arVals["VALUE"] == "Женский ассортимент") $UF_ASSORTIMENT = 28;
			if($arVals["VALUE"] == "Детский ассортимент") $UF_ASSORTIMENT = 27; // если только детский ассортимент то меняем на 27
			if($arVals["CODE"] == "COMPANY") $arFields["BUYER"] = htmlspecialcharsBack($arVals["VALUE"]);
			if($arVals["CODE"] == "FIO") $arFields["BUYER"] = htmlspecialcharsBack($arVals["VALUE"]);
			if($arVals["CODE"] == "DELIVERY_COMPANY") $arFields["DELIVERY_COMPANY"] = $arVals["VALUE"];
			if($arVals["CODE"] == "DELIVERY_CITY") $arFields["DELIVERY_CITY"] = $arVals["VALUE"];
			if($arVals["CODE"] == "DELIVERY_TYPE") $arFields["DELIVERY_TYPE"] = $delivery_types[$arVals["VALUE"]];
			if($arVals["CODE"] == "DELIVERY_FIO") $arFields["DELIVERY_FIO"] = $arVals["VALUE"];
			if($arVals["CODE"] == "JUR_DELIVERY_COMPANY") $arFields["DELIVERY_COMPANY"] = $arVals["VALUE"];
			if($arVals["CODE"] == "JUR_DELIVERY_CITY") $arFields["DELIVERY_CITY"] = $arVals["VALUE"];
			if($arVals["CODE"] == "JUR_DELIVERY_TYPE") $arFields["DELIVERY_TYPE"] = $delivery_types[$arVals["VALUE"]];
			if($arVals["CODE"] == "JUR_DELIVERY_FIO") $arFields["DELIVERY_FIO"] = $arVals["VALUE"];
			$str .= $arVals["NAME"]."=".htmlspecialcharsBack(strip_tags($arVals["VALUE"]))."<br/>";
		}
		if(trim($arFields["DELIVERY_COMPANY"]) == "") $arFields["DELIVERY_COMPANY"] = " ";
		if(trim($arFields["DELIVERY_CITY"]) == "") $arFields["DELIVERY_CITY"] = " ";
		if(trim($arFields["DELIVERY_TYPE"]) == "") $arFields["DELIVERY_TYPE"] = " ";
		if(trim($arFields["DELIVERY_FIO"]) == "") $arFields["DELIVERY_FIO"] = " ";
		$arFields["INFO_ORDER"] = $str;
		
		
		
		
		
		// Собираем информацию о контрагенте для письма
		$str = "<table border='1' cellpadding='4' style='border-collapse: collapse; background-color: #F6F6F6;'>";
		
		if($arUser["UF_PARTNER_TYPE"] == 21) // физлицо
		{
			$str .= "<tr><td>Ф.И.О.:</td><td>".$arUser["UF_FIO"]."</td></tr>";
			$str .= "<tr><td>Паспортные данные:</td><td>".$arUser["UF_PASSPORT"]."</td></tr>";
			$str .= "<tr><td>ИНН (физлицо):</td><td>".$arUser["UF_FIZ_INN"]."</td></tr>";
			$str .= "<tr><td>Город:</td><td>".$arUser["UF_CITY"]."</td></tr>";
			$str .= "<tr><td>Федеральный округ:</td><td>".$OKRUGS[$arUser["UF_OKRUG"]]."</td></tr>";
			$str .= "<tr><td>E-mail:</td><td>".$arUser["EMAIL"]."</td></tr>";
			$str .= "<tr><td>Контактное лицо:</td><td>".$arUser["LAST_NAME"]." ".$arUser["NAME"]." ".$arUser["SECOND_NAME"]."</td></tr>";
			$str .= "<tr><td>Телефон:</td><td>".$arUser["PERSONAL_PHONE"]."</td></tr>";
			$str .= "<tr><td>Тип партнерства:</td><td>".$PARTNER_TYPES[$arUser["UF_PARTNER_TYPE"]]."</td></tr>";
			$str .= "<tr><td>ИНН (копия):</td><td>".get_file_name($arUser["UF_DOC_INN"])."</td></tr>"; 
			$str .= "<tr><td>ОГРН (копия):</td><td>".get_file_name($arUser["UF_DOC_OGRN"])."</td></tr>";
			$str .= "<tr><td>Паспорт (копия):</td><td>".get_file_name($arUser["UF_DOC_PASSPORT"])."</td></tr>";
			$str .= "<tr><td>Комментарии:</td><td>".$arOrder["USER_DESCRIPTION"]."</td></tr>";
		}
		
		if(($arUser["UF_PARTNER_TYPE"] == 20)||(($arUser["UF_PARTNER_TYPE"] == 19))) // ИП/ООО
		{
			$str .= "<tr><td>Название компании:</td><td>".$arUser["UF_COMPANY_NAME"]."</td></tr>";
			$str .= "<tr><td>Юридический адрес:</td><td>".$arUser["UF_COMPANY_ADDRESS"]."</td></tr>";
			$str .= "<tr><td>ИНН:</td><td>".$arUser["UF_INN"]."</td></tr>";
			$str .= "<tr><td>КПП:</td><td>".$arUser["UF_KPP"]."</td></tr>";
			$str .= "<tr><td>ОГРН:</td><td>".$arUser["UF_OGRN"]."</td></tr>";
			$str .= "<tr><td>Город:</td><td>".$arUser["UF_CITY"]."</td></tr>";
			$str .= "<tr><td>Федеральный округ:</td><td>".$OKRUGS[$arUser["UF_OKRUG"]]."</td></tr>";
			$str .= "<tr><td>E-mail:</td><td>".$arUser["EMAIL"]."</td></tr>";
			$str .= "<tr><td>Контактное лицо:</td><td>".$arUser["LAST_NAME"]." ".$arUser["NAME"]." ".$arUser["SECOND_NAME"]."</td></tr>";
			$str .= "<tr><td>Телефон:</td><td>".$arUser["PERSONAL_PHONE"]."</td></tr>";
			$str .= "<tr><td>Тип партнерства:</td><td>".$PARTNER_TYPES[$arUser["UF_PARTNER_TYPE"]]."</td></tr>";
			$str .= "<tr><td>Устав (копия):</td><td>".get_file_name($arUser["UF_DOC_USTAV"])."</td></tr>"; 
			$str .= "<tr><td>Приказ о гендиректоре (копия):</td><td>".get_file_name($arUser["UF_DOC_GENDIR"])."</td></tr>"; 
			$str .= "<tr><td>ИНН (копия):</td><td>".get_file_name($arUser["UF_DOC_INN"])."</td></tr>";
			$str .= "<tr><td>ОГРН (копия):</td><td>".get_file_name($arUser["UF_DOC_OGRN"])."</td></tr>";			
			$str .= "<tr><td>Выписка из ЕГРН (копия):</td><td>".get_file_name($arUser["UF_DOC_EGRN"])."</td></tr>";
			$str .= "<tr><td>Карточка с реквизитами:</td><td>".get_file_name($arUser["UF_DOC_REKVIZITY"])."</td></tr>";
			$str .= "<tr><td>Комментарии:</td><td>".$arOrder["USER_DESCRIPTION"]."</td></tr>";
		}
		
		$str .= "</table>";
		
		
		/*
		foreach($arUser as $k => $v) {
			
			$str .= $k."=".htmlspecialcharsBack(strip_tags($v))."<br/>";
			}
		*/
		$arFields["INFO_USER"] = $str;
		
		/*if($USER->isAdmin()) {
			prn($arFields);
			die();
			}
		*/
		
		
		
		
		
		// выясним какому менеджеру на какой e-mail отсылать уведомление
		if($arTemplate["ID"] == 77) $arFields["EMAIL"] = get_manager_mail($UF_ASSORTIMENT, $UF_OKRUG);
		if($arTemplate["ID"] == 34) $arFields["BCC"] = get_manager_mail($UF_ASSORTIMENT, $UF_OKRUG);
		
		}
	
	// ========= НОВЫЙ ЗАКАЗ ПОКУПАТЕЛЮ (33) / ОПЛАТА ЗАКАЗА (36) ============
	if(($arTemplate["ID"] == 33)||($arTemplate["ID"] == 36))
	{
		$arInf = getOrderMail($arFields["ORDER_ID"]);
		$arFields["ORDER_LIST"] = $arInf["ORDER_LIST"];
		$arFields["ORDER_PROPS"] = $arInf["ORDER_PROPS"];
		$arFields["AGENT_PROPS"] = $arInf["AGENT_PROPS"];
		$arFields["USER_COMMENTS"] = $arInf["USER_COMMENTS"];
	}
	
	
	
	// ========= ЗАРЕГИСТРИРОВАЛСЯ НОВЫЙ ПОЛЬЗОВАТЕЛЬ ============
	
	if($arTemplate["ID"] == 1) 
	{
		// выясняем какому менеджеру отправлять email
		
		//prn($arFields);
		//die();
		
		$UF_ASSORTIMENT = $arFields["UF_ASSORTIMENT"];
		$UF_OKRUG = $arFields["UF_OKRUG"];
		
		$MANAGER_MAIL = Array();
		//$arAssortiment = explode(",", $UF_ASSORTIMENT);
		$arAssortiment = $UF_ASSORTIMENT;
		for($i=0; $i<count($arAssortiment); $i++) 
		{
			if(strLen(trim($arAssortiment[$i])) < 1) continue;
			$MANAGER_MAIL[$i] = get_manager_mail(trim($arAssortiment[$i]), $UF_OKRUG);
		}
		//die();
		$arFields["MANAGER_MAILS"] = implode(",", $MANAGER_MAIL);
		
		$arFields["EXT_DATA"] = "Ассортимент: ";
		$arFields["EXT_DATA"] .= str_replace("27", "детский", str_replace("28", "женский", implode(" ", $UF_ASSORTIMENT)));
		$arFields["EXT_DATA"] .= "\n";
		
		if($UF_OKRUG == 10) $arFields["EXT_DATA"] .= "Федеральный округ: Центральный\n";
		if($UF_OKRUG == 11) $arFields["EXT_DATA"] .= "Федеральный округ: Южный\n";
		if($UF_OKRUG == 12) $arFields["EXT_DATA"] .= "Федеральный округ: Северо-Западный\n";
		if($UF_OKRUG == 13) $arFields["EXT_DATA"] .= "Федеральный округ: Дальневосточный\n";
		if($UF_OKRUG == 14) $arFields["EXT_DATA"] .= "Федеральный округ: Сибирский\n";
		if($UF_OKRUG == 15) $arFields["EXT_DATA"] .= "Федеральный округ: Уральский\n";
		if($UF_OKRUG == 16) $arFields["EXT_DATA"] .= "Федеральный округ: Приволжский\n";
		if($UF_OKRUG == 17) $arFields["EXT_DATA"] .= "Федеральный округ: Северо-Кавказский\n";
		if($UF_OKRUG == 18) $arFields["EXT_DATA"] .= "Федеральный округ: Крымский\n";
		$arFields["EXT_DATA"] .= "Город: ".$arFields["UF_CITY"]."\n";
		$arFields["EXT_DATA"] .= "Тип сотрудничества: ".str_replace("19", "ООО", str_replace("20", "ИП", str_replace("21", "Физ.лицо", $arFields["UF_PARTNER_TYPE"])))."\n\n";
		$arFields["EXT_DATA"] .= "Телефон: ".$arFields["PERSONAL_PHONE"]."\n";
		
		//prd($arFields);
		
	}
	
	
	
	// =========  ============
	
	if($arTemplate["ID"] == 76) 
	{
		//$arFields["BCC"] = "turtell@yandex.ru";
		//$str = "";
		//foreach($arFields as $k => $v) $str.=$k."=".$v."<br/>";
		//$arFields["INFO"] = $str;
		
		if((!isset($arFields["MANAGER_MAILS"])) || (trim($arFields["MANAGER_MAILS"]) == "")) {
			$arFields["EMAIL"] = "";
			$arFields["MANAGER_MAILS"] = "";
			//$arFields = Array();
			//prn($arFields);
			//die();
			}
		/*
		if($USER->isAdmin()) {
			prn($arFields);
			die();
			}
		*/
	}
	
	
	// ========= ИНФОРМАЦИЯ О ПОЛЬЗОВАТЕЛЕ ============
	
	if($arTemplate["ID"] == 2) 
	{
		/*
		$arFields["EXT_DATA"] = "";
		$arFilter = Array( "ID" => $arFields["USER_ID"]);
		$arParam["SELECT"] = Array("UF_CITY", "UF_ASSORTIMENT", "UF_OKRUG");
		$rsUser = CUser::GetList(($by="personal_country"), ($order="desc"), $arFilter, $arParam); 
		while($arUser = $rsUser->GetNext()) 
		{
			$arFields["EXT_DATA"]  = "<li>Ассортимент: ".$arUser["UF_ASSORTIMENT"]."</li>";
			$arFields["EXT_DATA"] .= "<li>Округ: ".$arUser["UF_OKRUG"]."</li>";
			$arFields["EXT_DATA"] .= "<li>Город: ".$arUser["UF_CITY"]."</li>";
		}
		*/
		
		$arGroups = CUser::GetUserGroup($arFields["USER_ID"]);
		$arFields["PRICE_TYPE"] = "нет цен";
		if(in_array(8, $arGroups)) $arFields["PRICE_TYPE"] = "оптовые";
		if(in_array(9, $arGroups)) $arFields["PRICE_TYPE"] = "оптовые (скидка 3% к корзине)";
		if(in_array(10, $arGroups)) $arFields["PRICE_TYPE"] = "оптовые (скидка 5% к корзине)";
		if(in_array(11, $arGroups)) $arFields["PRICE_TYPE"] = "оптовые (скидка 7% к корзине)";
		//if(in_array(12, $arGroups)) $arFields["PRICE_TYPE"] = "оптовые + 8%";
		if(in_array(12, $arGroups)) $arFields["PRICE_TYPE"] = "оптовые для физ.лиц";
		if(in_array(14, $arGroups)) $arFields["PRICE_TYPE"] = "оптовые (скидка 10% к корзине)";
		if(in_array(15, $arGroups)) $arFields["PRICE_TYPE"] = "оптовые (скидка 14,5% к корзине)";
		
		$arFields["LETTER_NAME"] = "нет доступа к ценам";
		if(in_array(8, $arGroups) || in_array(9, $arGroups) || in_array(10, $arGroups) || in_array(11, $arGroups) || in_array(14, $arGroups) || in_array(15, $arGroups)) 
		{
			$arFields["LETTER_NAME"] = "доступ к оптовым ценам";
		}
		
		if(in_array(12, $arGroups))
		{
			$arFields["LETTER_NAME"] = "доступ к оптовым ценам для физлиц";
		}
		
		//prd($arFields);
	
	}
	
}









// Определение является ли пользователь дилером и типа цены для использования везде
// установка соответствующих констант DEALER_USER и PRICE_TYPE
// (проверить еще права на доступ к типам цен - /bitrix/admin/cat_group_admin.php?lang=ru)

AddEventHandler("main", "OnBeforeProlog", "MyOnBeforePrologHandler", 50);
function MyOnBeforePrologHandler() {
	global $USER;
	$arGroups = $USER->GetUserGroupArray();
	// правила определения дилера
	if(in_array(8, $arGroups) || in_array(9, $arGroups) || in_array(10, $arGroups) || in_array(11, $arGroups) || in_array(14, $arGroups) || in_array(15, $arGroups)) {			// если пользователь из группы DEALERS
		define("PRICE_TYPE", DEALER_PRICE); 			// Оптовые - уточнить в типах цен (создаются при импорте из 1с)
		if(in_array(9, $arGroups))		define("DEALER_USER", 3);		// Dealer 3%
		elseif(in_array(10, $arGroups))	define("DEALER_USER", 5);		// Dealer 5%
		elseif(in_array(11, $arGroups))	define("DEALER_USER", 7);		// Dealer 7%
		elseif(in_array(14, $arGroups))	define("DEALER_USER", 10);		// Dealer 10%
		elseif(in_array(15, $arGroups))	define("DEALER_USER", 14.5);	// Dealer 14,5%
		else 							define("DEALER_USER", 0);		// Просто Dealer 0%
		}
	elseif(in_array(12, $arGroups)) {
		define("JOINT_USER", 0);					// пользователь для совместных покупок
		define("PRICE_TYPE", JOINT_PRICE);			// тип цены для совместных покупок
		}
	/*else {												// для всех остальных
		define("PRICE_TYPE", RETAIL_PRICE);				// Розничная цена - уточнять в типах цен (устанавливаются при импорте из 1с)
		}
	*/
	
	//prnip(PRICE_TYPE);
	//prnip(DEALER_USER);
	//prdip($arGroups);
	
	//echo "DEALER_USER=".DEALER_USER."<br/>";
	//echo "JOINT_USER=".JOINT_USER."<br/>";
	//echo "PRICE_TYPE=".PRICE_TYPE."<br/>";
	
	}
	
//prd(PRICE_TYPE);	



// Определение констант для коллекций 
// (из пользовательских свойств первого уровня инфоблока товаров)
/*
if (CModule::IncludeModule("iblock")) {
	$ar_result=CIBlockSection::GetList(Array(), Array("IBLOCK_ID"=>PRODUCTS_IBLOCK_ID, "DEPTH_LEVEL"=>1),false, Array("UF_COLLECTION_COLOR"));
	$collections=Array();
	while($res=$ar_result->GetNext()) {
		//prn($res);
		$coll_code = str_replace("-", "", str_replace("_", "", $res["CODE"]));
		$collections[$res["ID"]]=$coll_code;
		define(strtoupper($coll_code)."_SECTION_ID", $res["ID"]);
		define(strtoupper($coll_code)."_NAME", $res["NAME"]);
		define(strtoupper($coll_code)."_COLOR", $res["UF_COLLECTION_COLOR"]);
		}
	}
*/



//prd(VAYKIDS_COLOR);
//prn(VAY_KIDS_1_SECTION_ID);
//prn($collections);
//die();
	
	
/*
AddEventHandler("sale", "OnBeforeBasketAdd", Array("MyClass", "OnBeforeBasketAddHandler"));

class MyClass
{
    // создаем обработчик события "OnBeforeUserLogin"
    function OnBeforeBasketAddHandler(&$arFields)
    {
        // здесь выполняем любые действия связанные 
        global $APPLICATION;
        $APPLICATION->throwException("Пользователь с именем входа Guest не может быть авторизован.");
        return false;
    }
}
*/



function getProductCounts($productID=false, $basketID=false) 
{

	//die(666);
	
	if(($productID == false)&&($basketID == false)) return false; 
	
	global $USER;
	CModule::IncludeModule("catalog");
	
	$arReturn = Array();
	
	if($basketID) 
	{
		$arItem = CSaleBasket::GetByID($basketID);
		$productID = $arItem["PRODUCT_ID"];
	}
	else 
	{
		$dbItem = CIBlockElement::GetByID($productID);
		$arItem = $dbItem->GetNext();
	}
	
	$arReturn["basketID"] = $basketID;
	$arReturn["productID"] = $productID;
	$arReturn["NAME"] = $arItem["NAME"];
	
	$arReturn["BASKET_COUNT"] = 0;
	if($basketID) 
	{
		$arReturn["BASKET_COUNT"] = round($arItem["QUANTITY"]);
	}
	
	$arRes = CCatalogProduct::GetByID($productID);
	$arReturn["STORE_COUNT"] = $arRes["QUANTITY"];
	
	
	// найдем сколько таких же товаров в неоплаченных заказах юзера
	//
	// 	ОТКЛЮЧЕНО ЭТО ОГРАНИЧЕНИЕ ПО УКАЗАНИЮ КОРШАК ОЛЬГИ
	//
	/*
	$arReturn["ORDERS_COUNT"] = 0;
	if($USER->isAuthorized()) 
	{
		$ordersNotPayed=Array();
		$db_sales = CSaleOrder::GetList(array(), Array( "USER_ID" => $USER->GetID(), "PAYED" => "N", "CANCELED" => "N" ));
		while ($ar_sales = $db_sales->Fetch())		
		{
			$ordersNotPayed[]=$ar_sales["ID"];
		}
		$dbBasketItems = CSaleBasket::GetList( 
			Array(), 
			Array("PRODUCT_ID" => $productID, "ORDER_ID" => $ordersNotPayed, "LID" => SITE_ID),
			false,
			false,
			array("QUANTITY")
			);
		$quantity_orders = 0;
		while($arBasketItems = $dbBasketItems->Fetch() ) 
			$quantity_orders = $quantity_orders + $arBasketItems["QUANTITY"]; 
		$arReturn["ORDERS_COUNT"] = $quantity_orders;
	}
	*/
	return $arReturn;
	
}




AddEventHandler( 'sale', 'OnBeforeBasketUpdate', 'OnBeforeBasketUpdateHandler' );
function OnBeforeBasketUpdateHandler( $iId, &$arFields ) {

	/*
	
	//
	// 	ОТКЛЮЧЕНО ЭТО ОГРАНИЧЕНИЕ ПО УКАЗАНИЮ КОРШАК ОЛЬГИ
	//
	
	global $USER;
	
	if(!in_array($USER->getID(), Array(1,2)))    // разрешаем проверки для всех кроме выгрузки из 1с (2 = ecommerce@ecommerce@mail.ua)
	{ 

		//prn("upd");
		//prd($USER->getID());
	
		if(strpos($_SERVER["HTTP_REFERER"], "/order/") < 1 )  // не применяем при оформлении заказа
		{
			$counts = getProductCounts(false, $iId);
			//prn($counts);

			$NEW_QUANTITY = $_SESSION["REQUEST_BASKET_RECALC"][0]["QUANTITY_".$iId];
			//echo $NEW_QUANTITY;
			
			//$BUY_LIMIT = 3;
			
			// отменим пересчет товара если недостаточно товара в наличии
			if($NEW_QUANTITY > $counts["STORE_COUNT"]) 
			{
				return false;
			}
			
			// отменим пересчет товара если превышает ограничение для покупки
			if(($NEW_QUANTITY + $counts["ORDERS_COUNT"]) > BUY_LIMIT)
			{
				$GLOBALS["ERROR_LIMIT"][] = $counts["NAME"].": количество для покупки (в корзине и неоплаченных заказах) ограничено ".BUY_LIMIT." шт. Количество не изменилось.";
				return false;
			}
			
		}
		
	} 
	*/
	
}


	
AddEventHandler("sale", "OnBeforeBasketAdd", "OnBeforeBasketAddHandler");
function OnBeforeBasketAddHandler(&$arFields) {

	global $USER;
	//prd($arFields);

	if(!in_array($USER->getID(), Array(1,2)))   // разрешаем проверки для всех кроме выгрузки из 1с (2 = ecommerce@ecommerce@mail.ua)
	{ 
	
		//prn("ADD");
		//prd($USER->getID());
		//die('11');
		
		// добавляемое количество товара
		//$quantity_add = $arFields["QUANTITY"];
		if(intVal($_REQUEST["quantity"])>0) $quantity_add = intVal($_REQUEST["quantity"]);
		elseif(intVal($arFields["QUANTITY"])>0) $quantity_add = intVal($arFields["QUANTITY"]);
		else $quantity_add = 0;
		
		// найдем количество такого товара в корзине
		$dbBasketItems = CSaleBasket::GetList(
			Array(),
			Array(
				"FUSER_ID" => CSaleBasket::GetBasketUserID(),
				"PRODUCT_ID" => $arFields["PRODUCT_ID"],
				"LID" => SITE_ID,
				"ORDER_ID" => "NULL"
				),
			false,
			false,
			Array("QUANTITY")
			);
		if($arItems = $dbBasketItems->Fetch() ) 
			$quantity_basket = $arItems["QUANTITY"];
		else
			$quantity_basket = 0;

		// суммарно (добавляемое и то что в корзине)
		$quantity_add_total = $quantity_add + $quantity_basket;
		//prd($quantity_add_total);
		
		// выясним количество такого товара на складе	
		$ar_res = CCatalogProduct::GetByID($arFields["PRODUCT_ID"]);
		$quantity_total = $ar_res["QUANTITY"];
		
		//die($quantity_add);
		
		// если товара на склдае не хватает для покупки, отмена добавления и возврат на страницу с кодом ошибки в URL
		if($quantity_add_total > $quantity_total) {
			global $APPLICATION;
			$APPLICATION->RestartBuffer();
			//include($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/header.php");
			include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
			echo "<style>.errortext {display:block; font: bold 20px/20px 'PT Sans', sans-serif; color:#7D7FB4; font-style: italic; margin-bottom:10px;}</style>";
			ShowError("Запрошенный товар отсутствует на складе в нужном количестве (".$quantity_add_total." шт.).");
			$t = explode("?", $_SERVER["REQUEST_URI"]);
			$back_url = $t[0];
			//echo "<a href='".$back_url."'>Вернуться</a>";
			//include($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/footer.php");
			die();
			}

		// если установлено ограничение на количество товра для покупки (BUY_LIMIT)
		/*
		if( defined("BUY_LIMIT")) {
		
			// найдем перечень неоплаченных заказов юзера
			$ordersNotPayed=Array();
			$db_sales = CSaleOrder::GetList(array(), Array(  "USER_ID" => $USER->GetID(), "PAYED" => "N", "CANCELED" => "N" ));
			while ($ar_sales = $db_sales->Fetch()) {
				$ordersNotPayed[]=$ar_sales["ID"];
				//prn($ar_sales);
				}
			//echo $USER->GetID();
			//die();
			
			// подсчитаем сколько в них товаров, таких же как и добавляемый сейчас в корзину
			$dbBasketItems = CSaleBasket::GetList( 
				Array(), 
				Array( "FUSER_ID" => CSaleBasket::GetBasketUserID(), "PRODUCT_ID" => $arFields["PRODUCT_ID"], "ORDER_ID" => $ordersNotPayed, "LID" => SITE_ID),
				false,
				false,
				array("QUANTITY")
				);
			$quantity_orders = 0;
			while($arItems = $dbBasketItems->Fetch() ) 
				$quantity_orders = $quantity_orders + $arItems["QUANTITY"];  
				
			// прибавим найденное количество товара из неоплаченных заказов к quantity_add_total и сравним с ограничением BUY_LIMIT
			$quantity_add_total = $quantity_add_total + $quantity_orders;
			
			// если превышает лимит, то отмена и возврат на страницу с кодом ошибки в URL
			if($quantity_add_total > BUY_LIMIT) {
				global $APPLICATION;
				$APPLICATION->RestartBuffer();
				include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
				echo "<style>.errortext {display:block; font: bold 20px/20px 'PT Sans', sans-serif; color:#7D7FB4; font-style: italic; margin-bottom:10px;}</style>";
				ShowError("Превышен лимит добавления товара в корзину. Необходимо уменьшить количество товара");
				$t = explode("?", $_SERVER["REQUEST_URI"]);
				$back_url = $t[0];
				//echo "<a onclick='$.fancybox.close(); return false;'>Продолжить покупки</a>";
				die();
				}
			}*/
		}
		
	}




/*	
AddEventHandler("sale", "OnOrderNewSendEmail", "OnOrderNewSendEmailHandler");
function OnOrderNewSendEmailHandler($ID, $eventName, &$arFields) 
{
	$arOrderMail = getOrderMail($arFields["ORDER_ID"]);
	$arFields["ORDER_LIST"] = $arOrderMail["ORDER_LIST"];
	$arFields["ORDER_PROPS"] = $arOrderMail["ORDER_PROPS"];
	$arFields["USER_COMMENTS"] = $arOrderMail["USER_COMMENTS"];
	$arFields["PRICE_DELIVERY"] = $arOrderMail["PRICE_DELIVERY"];
	$arFields["DELIVERY_NAME"] = $arOrderMail["DELIVERY_NAME"];
	$arFields["PAYSYSTEM_NAME"] = $arOrderMail["PAYSYSTEM_NAME"];
}
*/
	
	
	

              
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", "onAfterElementSaveHandler");
AddEventHandler("iblock", "OnAfterIBlockElementAdd", "onAfterElementSaveHandler");
AddEventHandler("catalog", "OnPriceAdd", "onAfterElementSaveHandler");
AddEventHandler("catalog", "OnPriceUpdate", "onAfterElementSaveHandler");

function onAfterElementSaveHandler($arg1, $arg2=false) 
{
	global $USER;


	
	// если это торговое предложение
	if($arg1["IBLOCK_ID"] == OFFERS_IBLOCK_ID) 
	{
	
		//prn($arg1);
		//prn($arg2);	
		
		$arRes = CCatalogProduct::GetByID($arg1["ID"]);
		
		//if($arg1["NAME"]=="Жакет жен. 800 (03-31 светло серый, 46)") 
		//prd($arg1);
		
		if($_SERVER["REMOTE_ADDR"] == "93.171.209.131")
		{
			prn($arg1);
			prd($arRes);
		}
		
		// если наличие > 0 то корректируем некоторые свойства и сохраняем
		if(($arRes["QUANTITY"] > 0) || ($arg1["QUANTITY"] > 0) )
		{
			
			// сформируем размер и цвет в торговых предложениях
			$OFFER_ID = $arg1["ID"];
			// 49 - ID свойства привяprb к товару
			foreach($arg1["PROPERTY_VALUES"][49] as $value) 
				$PRODUCT_ID = $value["VALUE"];
			
			/*
			unset($size);
			unset($color);
			$db_props = CIBlockElement::GetProperty(OFFERS_IBLOCK_ID, $OFFER_ID, Array(), Array());
			while($ar_props = $db_props->Fetch()) 
			{
				if(strtoupper($ar_props["DESCRIPTION"])=="РАЗМЕР") 			$size=$ar_props["VALUE"];
				if(strtoupper($ar_props["DESCRIPTION"])=="КОДЦВЕТА") 		$color=$ar_props["VALUE"];
			}
			
			// выясним через кэш список оттенков цветов из инфоблока цветов
			$obCache = new CPHPCache();
			$cache_time = 3600;
			$cache_id = "arColorTones";
			$cache_path = "/arColorTones/";
			if( $obCache->InitCache($cache_time, $cache_id, $cache_path) ) 
			{   // кеш валиден
				//echo "БЕРЕМ ИЗ КЭША<hr/>";
				$arColorTones = $obCache->GetVars();
			}
			elseif( $obCache->StartDataCache()  ) 
			{								// кеш НЕвалиден
				//echo "ВЫЧИСЛЯЕМ И ЗАКИДЫВАЕМ В КЭШ<hr/>";
				$arColorTones = Array();
				$dbRes = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>8, "ACTIVE"=>"Y"), false, false, Array("ID", "XML_ID", "PROPERTY_COLOR_TONE"));
				while($arRes = $dbRes->GetNext()) {
					if(!in_array($arRes["PROPERTY_COLOR_TONE_VALUE"], $arColorTones[$arRes["XML_ID"]])) 
						$arColorTones[$arRes["XML_ID"]][] = $arRes["PROPERTY_COLOR_TONE_VALUE"];
					}
				$obCache->EndDataCache($arColorTones);							// сохраняем переменные в кэш
			}
			
			// выясним оттенок цвета
			if(isset($arColorTones[$color])) $tones = $arColorTones[$color];
			else $tones = "не указан";
			*/
			toList($OFFER_ID);
			
			
			// обновим свойства с мин и макс ценами в самом товаре 
			
			if(isset($arg1["PRICES"])) 
			{
				$arProductUpdate = Array();
				foreach($arg1["PRICES"] as $arPrice)
				{
					//echo $arPrice["PRICE"]["ID"];
					//echo "<br/>";
					//echo $arPrice["ЦенаЗаЕдиницу"];
					//echo "<hr/>";
					
					if($arPrice["PRICE"]["ID"] == DEALER_PRICE) 
					{	
						//$arProductUpdate["DEALER_PRICE_MIN"] = round($arPrice["ЦенаЗаЕдиницу"]);
						//$arProductUpdate["DEALER_PRICE_MAX"] = round($arPrice["ЦенаЗаЕдиницу"]);
						$arProductUpdate["DEALER_PRICE_MIN"] = $arPrice["ЦенаЗаЕдиницу"];
						$arProductUpdate["DEALER_PRICE_MAX"] = $arPrice["ЦенаЗаЕдиницу"];
					}
					if($arPrice["PRICE"]["ID"] == RETAIL_PRICE) 
					{	
						//$arProductUpdate["RETAIL_PRICE_MIN"] = round($arPrice["ЦенаЗаЕдиницу"]);
						//$arProductUpdate["RETAIL_PRICE_MAX"] = round($arPrice["ЦенаЗаЕдиницу"]);
						$arProductUpdate["RETAIL_PRICE_MIN"] = $arPrice["ЦенаЗаЕдиницу"];
						$arProductUpdate["RETAIL_PRICE_MAX"] = $arPrice["ЦенаЗаЕдиницу"];
					}
					if($arPrice["PRICE"]["ID"] == JOINT_PRICE) 
					{	
						//$arProductUpdate["JOINT_PRICE_MIN"] = round($arPrice["ЦенаЗаЕдиницу"]);
						//$arProductUpdate["JOINT_PRICE_MAX"] = round($arPrice["ЦенаЗаЕдиницу"]);
						$arProductUpdate["JOINT_PRICE_MIN"] = $arPrice["ЦенаЗаЕдиницу"];
						$arProductUpdate["JOINT_PRICE_MAX"] = $arPrice["ЦенаЗаЕдиницу"];
					}

					
				}
			
				//prd($arProductUpdate);
			
			}
			else
			{
			
				$rsPrices = CPrice::GetList(array(), array("PRODUCT_ID" => $arg1["ID"]));
				$arProductUpdate = Array();
				while($arPrice = $rsPrices->Fetch())
				{
					//prn($arPrice);
					if($arPrice["CATALOG_GROUP_ID"] == DEALER_PRICE) 
					{	
						$arProductUpdate["DEALER_PRICE_MIN"] = $arPrice["PRICE"];
						$arProductUpdate["DEALER_PRICE_MAX"] = $arPrice["PRICE"];
					}
					if($arPrice["CATALOG_GROUP_ID"] == RETAIL_PRICE) 
					{	
						$arProductUpdate["RETAIL_PRICE_MIN"] = $arPrice["PRICE"];
						$arProductUpdate["RETAIL_PRICE_MAX"] = $arPrice["PRICE"];
					}
					if($arPrice["CATALOG_GROUP_ID"] == JOINT_PRICE) 
					{	
						$arProductUpdate["JOINT_PRICE_MIN"] = $arPrice["PRICE"];
						$arProductUpdate["JOINT_PRICE_MAX"] = $arPrice["PRICE"];
					}
					
				}
				
			}
			
			if(count($arProductUpdate) > 0)
			{
				CIBlockElement::SetPropertyValuesEx($PRODUCT_ID, PRODUCTS_IBLOCK_ID, $arProductUpdate);
			}

			
			// вносим изменения в предложение после его сохранения
			//$arUpdate=Array();
			//if(isset($size)) 		$arUpdate["SIZE"]=$size;
			//if(isset($color)) 		$arUpdate["COLOR"]=$color;
			//if(isset($tones)) 		$arUpdate["COLOR_TONE"]=$tones;
			//CIBlockElement::SetPropertyValuesEx($OFFER_ID, OFFERS_IBLOCK_ID, $arUpdate);
			
		}
		// иначе если наличие равно нулю - удаляем торговое предложение
		else
		{
			/*
			global $DB;
			$DB->StartTransaction();
			if(!CIBlockElement::Delete($arg1["ID"]))
			{
				$strWarning .= 'Error!';
				$DB->Rollback();
			}
			else
				$DB->Commit();
			*/
		}
			
			
			
	}
	
	// если это товар
	if($arg1["IBLOCK_ID"] == PRODUCTS_IBLOCK_ID) 
	{
		
		//prd($arg1);
	
		global $collections;

		$arUpdate=Array();


		
		$PRODUCT_ID = $arg1["ID"];
		$SECTION_ID = $arg1["IBLOCK_SECTION"][0];
		
		$collection = "";
		$nav = CIBlockSection::GetNavChain(PRODUCTS_IBLOCK_ID, $SECTION_ID);
		while($arPath = $nav->GetNext() ) 
		{
			if(
				(strtoupper($arPath["CODE"]) == "VAY") || 
				(strtoupper($arPath["CODE"]) == "VESNUSHKI") ||
				(strtoupper($arPath["CODE"]) == "AKSESSUARY") ||
				(strtoupper($arPath["CODE"]) == "MUZHSKOY-TRIKOTAZH") ||
				(strtoupper($arPath["CODE"]) == "VAY-KIDS")
				)
			{
				$collection = strtoupper(str_replace("-", "", $arPath["CODE"]));
				if($collection == "MUZHSKOYTRIKOTAZH") $collection = "VAYMAN"; 
			}
		}
		
		

		if(strLen($collection) > 0) 		$arUpdate["COLLECTION"]=$collection;
		
		if(count($arg1["PROPERTY_VALUES"]) > 0) 
		{
		
			// если пустое свойство распродажа [120], то заменяем его на значение false
			foreach($arg1["PROPERTY_VALUES"][120] as $k => $v) {
				if(trim($v["VALUE"]) == "") $arUpdate["RASPRODAZHA"] = "false";
				}

			// если пустое свойство сезонное предложение [120], то заменяем его на значение false
			foreach($arg1["PROPERTY_VALUES"][124] as $k => $v) {
				if(trim($v["VALUE"]) == "") $arUpdate["SEZONNOE_PREDLOZHENIE"] = "false";
				}
				
			// выясним группу длины изделия 
			foreach($arg1["PROPERTY_VALUES"][119] as $k => $v) {
				$txtDlina = trim($v["VALUE"]);
				}
			$arDlina = explode(",", $txtDlina);
			$arGroups = Array();
			foreach($arDlina as $d) {
				$dl = intVal($d);
				if($dl<1) 						$gr="Не указано";
				if(($dl > 0)   && ($dl < 61)   ) $gr = "Короткое";
				if(($dl >= 61) && ($dl < 81)   ) $gr = "Среднее";
				if ($dl >= 81) 					$gr = "Длинное";
				if(!in_array($gr, $arGroups)) $arGroups[] = $gr;
				}
			$arUpdate["GRUPPA_DLINY"] = $arGroups;
		}

		//prd($arUpdate);
		// вносим изменения в свойства товара после его сохранения если массив arUdate непустой
		if(count($arUpdate)>0) 
			CIBlockElement::SetPropertyValuesEx($PRODUCT_ID, PRODUCTS_IBLOCK_ID, $arUpdate);

	}
	
}





// =======================================================================================================================
// Функция вставки размера и цвета в offer на основании свойства Характеристики (что приходит из 1с)
// используется в onAfterIBlockElementUpdate, но может использоваться и самостоятельно
// =======================================================================================================================

function toList($offer_id)
{
	//prd($offer_id);
	$db_props = CIBlockElement::GetProperty(OFFERS_IBLOCK_ID, $offer_id, Array(), Array("ID" => PROPERTY_FEATURES_ID));
	while($ar_props = $db_props->Fetch()) 
	{
		if(strtoupper($ar_props["DESCRIPTION"])=="РАЗМЕР") 			$size = $ar_props["VALUE"];
		if(strtoupper($ar_props["DESCRIPTION"])=="КОДЦВЕТА") 		$color = $ar_props["VALUE"];
	}
	
	$dbRes = CIBlockPropertyEnum::GetList(Array(), Array("CODE" => Array("SIZE_LIST", "COLOR_LIST"), "VALUE" => Array($size, $color)));
	while($arRes = $dbRes->GetNext())
	{
		if(($arRes["PROPERTY_CODE"] == "COLOR_LIST")&&($arRes["VALUE"] == $color)) 	$color_val_id = $arRes["ID"];
		if(($arRes["PROPERTY_CODE"] == "SIZE_LIST")&&($arRes["VALUE"] == $size)) 	$size_val_id = $arRes["ID"];
	}
	if(!isset($color_val_id))
	{
		$ibpenum = new CIBlockPropertyEnum;
		$color_val_id = $ibpenum->Add(Array("PROPERTY_ID" => PROPERTY_COLOR_LIST_ID, "VALUE" => $color));
	}
	if(!isset($size_val_id))
	{
		$ibpenum = new CIBlockPropertyEnum;
		$size_val_id = $ibpenum->Add(Array("PROPERTY_ID" => PROPERTY_SIZE_LIST_ID, "VALUE" => $size));
	}	
	
	$arUpdate=Array();
	if(isset($size)) 		$arUpdate["SIZE_LIST"] = $size_val_id;
	if(isset($color)) 		$arUpdate["COLOR_LIST"] = $color_val_id;
	if(isset($size)) 		$arUpdate["SIZE"] = $size;
	if(isset($color)) 		$arUpdate["COLOR"] = $color;
	CIBlockElement::SetPropertyValuesEx($offer_id, OFFERS_IBLOCK_ID, $arUpdate);
}






// =======================================================================================================================
// Если задано $ALLOW_SOGREVAY_FOTO_SYNC то дублируем фото с этого сайта на sogrevay.ru
// Задействуются файлы http://sogrevay.ru/tools/img_sync.php и http://sogrevay.ru/tools/get_photo.php
// =======================================================================================================================
AddEventHandler("iblock", "OnAfterIBlockElementAdd", "onAfterElementHandler");
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", "onAfterElementHandler");
function onAfterElementHandler($arFields)
{
	$ALLOW_SOGREVAY_FOTO_SYNC = true;	// РЕЗРЕШАТЬ ДУБЛИРОВАТЬ ФОТО НА SOGREVAY.RU? 
	if($arFields["RESULT"] == 1) // если успешно сохранилось
	{
		// исключим дублирование фото для выгрузки из 1с, только при ручном изменении из админки сайта!!!
		// и принудительно проверим что запрос из админки
		$update_foto = true;
		if($_REQUEST['filename'] == 'offers.xml') $update_foto = false;
		if($_REQUEST['filename'] == 'import.xml') $update_foto = false;
		if(strpos(" ".$_SERVER["REQUEST_URI"], "/bitrix/admin/")<1) $update_foto = false;
		
		if($update_foto && $ALLOW_SOGREVAY_FOTO_SYNC)
		{
			//$res = QueryGetData("www.sogrevay.ru", 80, "/tools/img_sync.php", "xml=".$arFields["XML_ID"], $errno, $errstr);
			
			// ВНИМАНИЕ!!!!! ВНИМАНИЕ!!!! ВНИМАНИЕ!!!!
			// Пришлось изменть алгоритм
			// Теперь при необходимости синхронизации фото, мы записываем XML_ID товара в файл /tools/img_sync_plan.txt
			// Он будет прочитан в событии onEpilog и вызвана функция QueryGetData (что закомментирована выше)
			// Связано с тем, что с первого раза не синхронизировались фото, почему то приходит пустой get_photo после первого вызова, потом нормальный
			
			$f = fopen($_SERVER["DOCUMENT_ROOT"]."/tools/img_sync_plan.txt", "a+");
			fwrite($f, $arFields["XML_ID"]."\n");
			fclose($f);
		}
	}
}






// Фикс для того чтобы обновлялось количество в ноль в предложении при импорте из 1с, если в нем не приходит <Количество>
/*
AddEventHandler("catalog", "OnBeforeProductUpdate", "unsetquantity");
function unsetquantity($ID,&$Fields)
{
    if (@$_REQUEST['mode']=='import')//импорт  из 1с? 
    {
        if(!$Fields['QUANTITY']) $Fields['QUANTITY'] = 0;
    }
}
*/


// Фикс для того чтобы обновлялось количество в ноль в предложении, если в нем не приходит <Количество> 
AddEventHandler("catalog", "OnBeforeProductUpdate", "unsetquantity");
AddEventHandler("catalog", "OnBeforeProductAdd", "unsetquantity");
function unsetquantity($ID,&$Fields)
{
    if(intVal($Fields['QUANTITY'])<1) 
	{
		$Fields['QUANTITY'] = 0;
	}
}



// После сохранения товара если QUANTITY = 0 то деактивируем OFFER, или активируем если >0
AddEventHandler("catalog", "OnProductUpdate", "OnProductUpdateHandler");
AddEventHandler("catalog", "OnProductAdd", "OnProductUpdateHandler");
function OnProductUpdateHandler($ID,$arFields)
{
	// возьмем из кеша перечень ID товаров
	CModule::IncludeModule("iblock");
	$arProducts = Array();
	$obCache = new CPHPCache();
	$cacheLifetime = 3600;
	$cacheID = 'arProducts'; 
	$cachePath = '/'.$cacheID;
	//$obCache->cleanDir();
	if( $obCache->InitCache($cacheLifetime, $cacheID, $cachePath) ) 
	{ 
		$arProducts = $obCache->GetVars();
		//echo "get from cache<hr/>"; 
	}
	elseif( $obCache->StartDataCache()  ) 
	{
		$arProducts = Array();
		$dbRes = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 6), false, false, Array("ID"));
		while($arRes = $dbRes->GetNext()) {
			$arProducts[$arRes["ID"]] = 1;
			}
		$obCache->EndDataCache($arProducts);
		//echo "update cache<hr/>";
	}
	
	
	if(!isset($arProducts[$ID]))
	{
		//194.28.29.223
		//prd($arProducts);
		//if($_SERVER["REMOTE_ADDR"] == "194.28.29.223") 
		//{
			//$ID = 27963553;
			$price = 0;
			$dbProductPrice = CPrice::GetListEx(
				array(),
				array("PRODUCT_ID" => $ID, "CATALOG_GROUP_ID" => 3),   // 3 - оптовая
				false,
				false,
				array(/*"ID", "CATALOG_GROUP_ID", "PRICE"*/)
			);
			while($arProductPrice = $dbProductPrice->Fetch())
			{
				$price = intVal($arProductPrice["PRICE"]);
				//prn($arProductPrice);
				//break;
			}
			//prd($price);
		//}
		if((intVal($arFields['QUANTITY'])<1) || ($price < 1)) 
		{
			$el = new CIBlockElement;
			$res = $el->Update($ID, Array("ACTIVE" => "N")); 
		}
		/*
		elseif((intVal($arFields['QUANTITY'])>0) && ($price < 1)) 
		{
			$el = new CIBlockElement;
			$res = $el->Update($ID, Array("ACTIVE" => "N")); 
		}
		*/
		else
		{
			$el = new CIBlockElement;
			$res = $el->Update($ID, Array("ACTIVE" => "Y")); 
		}
	}
}



AddEventHandler("iblock", "OnBeforeIBlockSectionUpdate", "update_vay");
AddEventHandler("iblock", "OnBeforeIBlockSectionAdd", "update_vay");
function update_vay(&$arFields)
{
	if($arFields["CODE"] == "zhenskiy-trikotazh") $arFields["CODE"] = "vay";
	
	if(($arFields["CODE"][strLen($arFields["CODE"])-2] == "_") && ($arFields["CODE"][strLen($arFields["CODE"])-1] == "1") ) 
		$arFields["CODE"] = substr($arFields["CODE"], 0, strLen($arFields["CODE"])-2);
	
	if(($arFields["CODE"][strLen($arFields["CODE"])-2] == "_") && ($arFields["CODE"][strLen($arFields["CODE"])-1] == "2") ) 
		$arFields["CODE"] = substr($arFields["CODE"], 0, strLen($arFields["CODE"])-2);
}



	
// Принудительно втыкаем "-" вместо "_" в коды товаров и разделов, также убираем -1 если есть в конце кода раздела
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", "update_code");
AddEventHandler("iblock", "OnBeforeIBlockElementAdd", "update_code");
//AddEventHandler("iblock", "OnBeforeIBlockSectionUpdate", "update_code");
//AddEventHandler("iblock", "OnBeforeIBlockSectionAdd", "update_code");
function update_code(&$arFields)
{
	global $USER;
	
	// если изменяется раздел, то убираем цифры из названия
	if(isset($arFields[IBLOCK_SECTION]))
	{
		//echo "product";
	}
	else 
	{
		//echo "section";
		$digits = Array();
		for($i=1; $i<=10; $i++) 
		{
			$digits[] = $i.".";
			for($j=0; $j<=10; $j++) 
			{
				//echo $i.".".$j."<br/>";
				$digits[] = $i.".".$j.".";
			}
		}
		
		foreach($digits as $digit) 
		{
			if(strpos(" ".$arFields["NAME"], $digit)>0) $arFields["NAME"] = trim(str_replace($digit, "", $arFields["NAME"]));
		}
	
	}
	
	// задаем код, удаляя при этом концевые -1
	if($arFields["IBLOCK_ID"] == 6)
	{
		$params = array("replace_space" => "-", "replace_other" => "-", "change_case" => "L");
		$code = Cutil::translit($arFields["NAME"], "ru", $params);
		$txt = $code;
		//if( ($txt[strLen($txt)-2] == "-") && ($txt[strLen($txt)-1] == "1") ) $code = substr($txt, 0, strLen($txt)-2);
		if(strLen($code) > 0) $arFields["CODE"] = $code;
	}
	//prd($arFields["NAME"]);
	
	
	// принудительно изменяем название (два товара и два offers))
	/*
	if(in_array($arFields["ID"], Array(29035916,29035917,29035981,29035982))) 
	{
		$arFields["NAME"] = str_replace("Шарф (сувенирный)", "Календарь", $arFields["NAME"]);
		$params = array("replace_space" => "-", "replace_other" => "-", "change_case" => "L");
		$code = Cutil::translit($arFields["NAME"], "ru", $params);
		if(strLen($code) > 0) $arFields["CODE"] = $code;		
		//prd($arFields);
	}
	*/
	
}





AddEventHandler("iblock", "OnStartIBlockElementAdd", "OnBeforeIBlockElementAddHandler");
AddEventHandler("iblock", "OnStartIBlockElementUpdate", "OnBeforeIBlockElementAddHandler");
function OnBeforeIBlockElementAddHandler(&$arFields) 
{
	if(in_array($arFields["ID"], Array(29035916,29035917,29035981,29035982))) 
	{
		$arFields["NAME"] = str_replace("Шарф (сувенирный)", "Календарь", $arFields["NAME"]);
		$params = array("replace_space" => "-", "replace_other" => "-", "change_case" => "L");
		$code = Cutil::translit($arFields["NAME"], "ru", $params);
		if(strLen($code) > 0) $arFields["CODE"] = $code;
		//prd($arFields);
	}
}



	
	
/*	
 
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", "DoIBlockAfterSave");
AddEventHandler("iblock", "OnAfterIBlockElementAdd", "DoIBlockAfterSave");
AddEventHandler("catalog", "OnPriceAdd", "DoIBlockAfterSave");
AddEventHandler("catalog", "OnPriceUpdate", "DoIBlockAfterSave");

function DoIBlockAfterSave($arg1, $arg2 = false) 
{
	$ELEMENT_ID = false;
	$IBLOCK_ID = false;
	$OFFERS_IBLOCK_ID = false;
	$OFFERS_PROPERTY_ID = false;
	if (CModule::IncludeModule('currency'))
		$strDefaultCurrency = CCurrency::GetBaseCurrency();
	
	//Check for catalog event
	if(is_array($arg2) && $arg2["PRODUCT_ID"] > 0)
	{
		//Get iblock element
		$rsPriceElement = CIBlockElement::GetList(
			array(),
			array(
				"ID" => $arg2["PRODUCT_ID"],
			),
			false,
			false,
			array("ID", "IBLOCK_ID")
		);
		if($arPriceElement = $rsPriceElement->Fetch())
		{
			$arCatalog = CCatalog::GetByID($arPriceElement["IBLOCK_ID"]);
			if(is_array($arCatalog))
			{
				//Check if it is offers iblock
				if($arCatalog["OFFERS"] == "Y")
				{
					//Find product element
					$rsElement = CIBlockElement::GetProperty(
						$arPriceElement["IBLOCK_ID"],
						$arPriceElement["ID"],
						"sort",
						"asc",
						array("ID" => $arCatalog["SKU_PROPERTY_ID"])
					);
					$arElement = $rsElement->Fetch();
					if($arElement && $arElement["VALUE"] > 0)
					{
						$ELEMENT_ID = $arElement["VALUE"];
						$IBLOCK_ID = $arCatalog["PRODUCT_IBLOCK_ID"];
						$OFFERS_IBLOCK_ID = $arCatalog["IBLOCK_ID"];
						$OFFERS_PROPERTY_ID = $arCatalog["SKU_PROPERTY_ID"];
					}
				}
				//or iblock which has offers
				elseif($arCatalog["OFFERS_IBLOCK_ID"] > 0)
				{
					$ELEMENT_ID = $arPriceElement["ID"];
					$IBLOCK_ID = $arPriceElement["IBLOCK_ID"];
					$OFFERS_IBLOCK_ID = $arCatalog["OFFERS_IBLOCK_ID"];
					$OFFERS_PROPERTY_ID = $arCatalog["OFFERS_PROPERTY_ID"];
				}
				//or it's regular catalog
				else
				{
					$ELEMENT_ID = $arPriceElement["ID"];
					$IBLOCK_ID = $arPriceElement["IBLOCK_ID"];
					$OFFERS_IBLOCK_ID = false;
					$OFFERS_PROPERTY_ID = false;
				}
			}
		}
	}
	//Check for iblock event
	elseif(is_array($arg1) && $arg1["ID"] > 0 && $arg1["IBLOCK_ID"] > 0)
	{
		//Check if iblock has offers
		$arOffers = CIBlockPriceTools::GetOffersIBlock($arg1["IBLOCK_ID"]);
		if(is_array($arOffers))
		{
			$ELEMENT_ID = $arg1["ID"];
			$IBLOCK_ID = $arg1["IBLOCK_ID"];
			$OFFERS_IBLOCK_ID = $arOffers["OFFERS_IBLOCK_ID"];
			$OFFERS_PROPERTY_ID = $arOffers["OFFERS_PROPERTY_ID"];
		}
	}

	if($ELEMENT_ID)
	{

		//Compose elements filter
		if($OFFERS_IBLOCK_ID)
		{
			$rsOffers = CIBlockElement::GetList(
				array(),
				array(
					"IBLOCK_ID" => $OFFERS_IBLOCK_ID,
					"PROPERTY_".$OFFERS_PROPERTY_ID => $ELEMENT_ID,
				),
				false,
				false,
				array("ID")
			);
			while($arOffer = $rsOffers->Fetch())
				$arProductID[] = $arOffer["ID"];
				
			if (!is_array($arProductID))
				$arProductID = array($ELEMENT_ID);
		}
		else
			$arProductID = array($ELEMENT_ID);

		$minPriceJOINT = false;
		$maxPriceJOINT = false;
		$minPriceRETAIL = false;
		$maxPriceRETAIL = false;
		$minPriceDEALER = false;
		$maxPriceDEALER = false;
		
		//Get prices
		$rsPrices = CPrice::GetList(
			array(),
			array(
				"PRODUCT_ID" => $arProductID,
			)
		);
		
		//echo "start<br/>";
		while($arPrice = $rsPrices->Fetch())
		{
			if (CModule::IncludeModule('currency') && $strDefaultCurrency != $arPrice['CURRENCY'])
				$arPrice["PRICE"] = CCurrencyRates::ConvertCurrency($arPrice["PRICE"], $arPrice["CURRENCY"], $strDefaultCurrency);
			
			$PRICE = $arPrice["PRICE"];
			
			if(($arPrice["CATALOG_GROUP_ID"]==JOINT_PRICE)&&($minPriceJOINT === false || $minPriceJOINT > $PRICE)) $minPriceJOINT = $PRICE;
			if(($arPrice["CATALOG_GROUP_ID"]==JOINT_PRICE)&&($maxPriceJOINT === false || $maxPriceJOINT < $PRICE)) $maxPriceJOINT = $PRICE;
			if(($arPrice["CATALOG_GROUP_ID"]==RETAIL_PRICE)&&($minPriceRETAIL === false || $minPriceRETAIL > $PRICE)) $minPriceRETAIL = $PRICE;
			if(($arPrice["CATALOG_GROUP_ID"]==RETAIL_PRICE)&&($maxPriceRETAIL === false || $maxPriceRETAIL < $PRICE)) $maxPriceRETAIL = $PRICE;
			if(($arPrice["CATALOG_GROUP_ID"]==DEALER_PRICE)&&($minPriceDEALER === false || $minPriceDEALER > $PRICE)) $minPriceDEALER = $PRICE;
			if(($arPrice["CATALOG_GROUP_ID"]==DEALER_PRICE)&&($maxPriceDEALER === false || $maxPriceDEALER < $PRICE)) $maxPriceDEALER = $PRICE;
			

		}
			CIBlockElement::SetPropertyValuesEx(
				$ELEMENT_ID,
				$IBLOCK_ID,
				array(
					"MINIMUM_PRICE" => $minPrice,
					"MAXIMUM_PRICE" => $maxPrice,
					"JOINT_PRICE_MIN" => $minPriceJOINT,
					"JOINT_PRICE_MAX" => $maxPriceJOINT,
					"RETAIL_PRICE_MIN" => $minPriceRETAIL,
					"RETAIL_PRICE_MAX" => $maxPriceRETAIL,
					"DEALER_PRICE_MIN" => $minPriceDEALER,
					"DEALER_PRICE_MAX" => $maxPriceDEALER
				)
			);

	}
}

*/


	
	

AddEventHandler("main", "OnBeforeUserUpdate", "OnBeforeUserUpdateHandler");
AddEventHandler("main", "OnBeforeUserAdd", "OnBeforeUserUpdateHandler");
AddEventHandler("main", "OnBeforeUserRegister", "OnBeforeUserUpdateHandler");
function OnBeforeUserUpdateHandler(&$arFields)
{
	//prn($arFields);
	//die();
	
	global $USER;
	
	if((strpos(" ".$_SERVER["REQUEST_URI"], "/bitrix/admin/") <= 0) && ($_SERVER["SCRIPT_URL"] != "/unsubscribe/"))
	{
	
		$arFields["LOGIN"] = $arFields["EMAIL"];
		$arFields["PERSONAL_CITY"] = $arFields["UF_CITY"];

		if(isset($_REQUEST["confirm_code"])) $arFields["CONFIRM_CODE"] = $_REQUEST["confirm_code"];

		//prn($_REQUEST);
		//prn($arFields);
		//die();
		
		//if( ($_REQUEST["TYPE"] != "CHANGE_PWD") && (!isset[$arFields["CONFIRM_CODE"]]) ) 
		if( ($_REQUEST["TYPE"] == "CHANGE_PWD") || (strLen($arFields["CONFIRM_CODE"]) > 0) )
		{
			// так понятне условие
			//$a =1;
		}
		else
		{
			
			$err = "";
				
			$assort = false;
			foreach($arFields["UF_ASSORTIMENT"] as $val)
				if(strlen($val)>0) 
				{
					$assort = true;
					break;
				}
			if(!$assort) $err[] = "- Необходимо выбрать ассортимент";
			
			if((strlen($arFields["UF_INN"])<=5)&&(strlen($arFields["UF_FIZ_INN"])<=5)) $err[] = "- Необходимо корректно ввести ИНН";
			if(strlen($arFields["UF_CITY"])<=1) $err[] = "- Необходимо ввести город";
			if(strlen($arFields["UF_OKRUG"])<=1) $err[] = "- Необходимо ввести округ";
			if(strlen($arFields["PERSONAL_PHONE"])<=1) $err[] = "- Необходимо ввести телефон";
			
			if(is_array($err))
			{
				global $APPLICATION;
				$APPLICATION->throwException(implode("\n",$err));
				return false;
			}
		}
	}
}




// Функция ищет и выполняет корректировки активности товаров в зависимости от наличия активных ТП в них
// если товар активен, но в нем нет активных ТП =====> деактививруем товар
// если товар неактивен, но в нем есть активные ТП ==> актививруем товар

function сheckActiveProducts()
{
	$arGoods = Array();
	$dbRes = CIBlockElement::GetList(
		Array(),
		Array("IBLOCK_ID" => 7), // инфоблок товаров
		false,
		false,
		Array("ID", "NAME", "PROPERTY_CML2_LINK", "PROPERTY_CML2_LINK.ACTIVE", "ACTIVE")
		);
	while($arRes = $dbRes->GetNext()) 
	{
		$arGoods[$arRes["PROPERTY_CML2_LINK_VALUE"]]["CURRENT"] = $arRes["PROPERTY_CML2_LINK_ACTIVE"];
		if($arRes["ACTIVE"] == "Y") $arGoods[$arRes["PROPERTY_CML2_LINK_VALUE"]]["COUNT"]++;
		elseif(!isset($arGoods[$arRes["PROPERTY_CML2_LINK_VALUE"]]["COUNT"])) $arGoods[$arRes["PROPERTY_CML2_LINK_VALUE"]]["COUNT"] = 0;
	}		
	$arActions = Array();
	foreach($arGoods as $key => $arGood) 
	{
		if(($arGood["COUNT"] == 0)&&($arGood["CURRENT"] == "Y")) $arActions[$key] = "N";
		if(($arGood["COUNT"] > 0)&&($arGood["CURRENT"] == "N"))  $arActions[$key] = "Y";
	}
	
	$el = new CIBlockElement;
	$str = "";
	foreach($arActions as $id => $act)
	{
		$res = $el->Update($id, Array("ACTIVE" => $act));
		$str .= $id." - ".$act."\n";
	}
	mail("turtell@yandex.ru", "сheckActiveProducts at ".date("d.m.Y H:i"), $str); 
	//prn($arActions);
	
}




// Функция ищет и выполняет корректировки активности торговых предложений в зависимости от количества
// если количество <1, а товар активен =====> деактививруем offer
// если количество >0, а товар неактивен ===> актививруем offer

function checkActiveOffers() 
{
	CModule::IncludeModule("iblock");
	$arProducts = Array();
	$dbRes = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 7), false, false, Array("ID", "CATALOG_QUANTITY", "CATALOG_GROUP_3", "ACTIVE"));
	$arActions = Array();
	while($arRes = $dbRes->GetNext()) 
	{
		if((($arRes["CATALOG_QUANTITY"] < 1) || ($arRes["CATALOG_PRICE_3"] < 1)) && ($arRes["ACTIVE"] == "Y")) $arActions[$arRes["ID"]] = "N";
		if(($arRes["CATALOG_QUANTITY"] > 0) && ($arRes["CATALOG_PRICE_3"] > 0) && ($arRes["ACTIVE"] == "N")) $arActions[$arRes["ID"]] = "Y";
	}
	
	$el = new CIBlockElement;
	$str = "";
	foreach($arActions as $id => $act)
	{
		$res = $el->Update($id, Array("ACTIVE" => $act));
		$str .= $id." - ".$act."\n";
	}
	mail("turtell@yandex.ru", "сheckActiveOffers at ".date("d.m.Y H:i"), $str); 
}






// Функция для того, чтобы декативировать товары из заданного раздела
// нужно чтобы скрыть товары раздела Новые коллекции

function hide_new_coll() 
{
	CModule::IncludeModule("iblock");
	$SECTION_ID = 319; // ID раздела который прятать
	$arID = Array();
	$dbRes = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => PRODUCTS_IBLOCK_ID, "ACTIVE" => "Y", "SECTION_ID" => $SECTION_ID, "INCLUDE_SUBSECTIONS" => "Y"), false, false, Array("ID", "ACTIVE"));
	while($arRes = $dbRes->GetNext()) 
	{
		$arID[] = $arRes["ID"];
	}
	$el = new CIBlockElement;
	foreach($arID as $id)
	{
		$res = $el->Update($id, Array("ACTIVE" => "N"));
	}
	//mail("turtell@yandex.ru", "сheckActiveOffers at ".date("d.m.Y H:i"), $str); 
}




AddEventHandler("catalog", "OnSuccessCatalogImport1C", "OnSuccessCatalogImport1CHandler");
function OnSuccessCatalogImport1CHandler()
{
	
	if (@$_REQUEST['filename']=='offers.xml')
	{
		
		
		// Удаляем торговые предложения, в которых наличие равно нулю
		/*
		$dbRes = CIBlockElement::GetList(
			Array(),
			Array("IBLOCK_ID" => 7, "<CATALOG_QUANTITY" => 1), // инфоблок предложений
			false,
			false,
			Array("ID", "NAME", "CATALOG_GROUP_1")
			);
		$arDel = Array();
		while($arRes = $dbRes->GetNext()) 
		{	
			$arDel[$arRes["ID"]] = $arRes["NAME"];
		}
		$countEmptyOffers = count($arDel);
		
		$str = date("d.m.Y H:i:s")."\n";
		if(count($arDel) <1 ) $str.="Not exists empty offers";
		foreach($arDel as $k=>$v) 
		{
			$str .= $v." - ";
			if(CIBlockElement::Delete($k))
				$str .= "deleted";
			else 
				$str .= "DELETION ERROR!";	
			$str .= "\n";
		}
		
		
		
		// проходим по всем торговым предложениям каждого товара
		// если в рамках одного товара есть предложения, время обновления которых значительно 
		// отличается от времени обновления остальных предложений в этом товаре, то оно удаляется
		// (это означает что предложение пропало из выгрузки, что означает что нет свободного остатка)
		
		$razbros = 120; // интервал времени в сек. после которого предложение считается необновленным
		$razbros = 900; // интервал времени в сек. после которого предложение считается необновленным
	
		//CModule::IncludeModule("iblock");
		
		$dbRes = CIBlockElement::GetList(
			Array(),
			Array("IBLOCK_ID" => 7), // инфоблок предложений
			false,
			false,
			Array("ID", "NAME", "TIMESTAMP_X_UNIX", "PROPERTY_CML2_LINK")
			);
			
		$arr = Array();
		$arrForReport = Array();
		while($arRes = $dbRes->GetNext()) 
		{	
			$arr[$arRes["PROPERTY_CML2_LINK_VALUE"]][$arRes["ID"]] = $arRes["TIMESTAMP_X_UNIX"];
			$arrForReport[$arRes["ID"]] = $arRes["NAME"];
		}
		
		$del = Array();
		$delReport = Array();
		foreach($arr as $product_id => $times) 
		{
			$etalon = max($times);
			foreach($times as $k => $v) 
			{
				if(($etalon - $v) >= $razbros) 
				{
					$del[] = $k;
					$delReport[] = $arrForReport[$k];
				}
		
			}

		}

		$str .= "\n";
		if(count($del) <1 ) $str .= "Нет устаревших элементов";
		$countOldOffers = count($del);
		for($i=0; $i<count($del); $i++) {
			if(CIBlockElement::Delete($del[$i]))
				$str .= "Удалено: ".$arrForReport[$del[$i]]."\n";
			else 
				$str .= "ОШИБКА УДАЛЕНИЯ: ".$arrForReport[$del[$i]]."\n";
			}
		
		//$title =  date("d.m.Y H:i:s").((count($del) < 1) ? " Нет удалений предложений" : " Удалено ".count($del)." устаревших элементов");
		//mail("turtell@yandex.ru", $title, $str);
		
		
		
		
		
		// Удаляем товары, не содержащие торговых предложений
		
		$dbRes = CIBlockElement::GetList(
			Array(),
			Array("IBLOCK_ID" => 7), // инфоблок предложений
			false,
			false,
			Array("ID", "PROPERTY_CML2_LINK")
			);
		$arOffers = Array();
		while($arRes = $dbRes->GetNext()) 
		{	
			$arOffers[$arRes["PROPERTY_CML2_LINK_VALUE"]][] = $arRes["ID"];
		}

		$dbRes = CIBlockElement::GetList(
			Array(),
			Array("IBLOCK_ID" => 6, "ACTIVE" => "Y"), // инфоблок товаров
			false,
			false,
			Array("ID", "NAME")
			);
		$arDel = Array();	
		while($arRes = $dbRes->GetNext()) 
		{	
			if(!isset($arOffers[$arRes["ID"]])) $arDel[$arRes["ID"]] = $arRes["NAME"];
		}
		$countEmptyProducts = count($arDel);
		
		$str .= "\n";
		if(count($arDel) <1 ) $str.="Not exists goods without SKU";
		foreach($arDel as $k=>$v) 
		{
			$str .= $v." - ";
			//$str .= "\n";
			$el = new CIBlockElement;
			$res = $el->Update($k, Array("ACTIVE" => "N")); 
			if($res) $str .= "deactivated"; else $str .= "DEACTIVATION ERROR!";
			/*
			if(CIBlockElement::Delete($k))
				$str .= "deleted";
			else 
				$str .= "DELETION ERROR!";	
			
			$str .= "\n";
		}
		*/
		
		
		// Отсылаем результат
		checkActiveOffers();
		сheckActiveProducts();
		hide_new_coll();
		//$title =  date("d.m.Y H:i:s")." - ".$countEmptyProducts." products deactivated, ".$countEmptyOffers." offers deleted, ".$countOldOffers." old offers deleted";
		//mail("turtell@yandex.ru", $title, $str);
	}
	
}




AddEventHandler("main", "OnBeforeUserAdd", "OnBeforeUserAddHandler1");
AddEventHandler("main", "OnBeforeUserRegister", "OnBeforeUserAddHandler1");
function OnBeforeUserAddHandler1(&$arFields)
{
	$SUBSCRIBER_USER_GROUP_ID = 13; 		// ID группы подписчиков, смотреть /bitrix/admin/group_admin.php?lang=ru
	if($arFields["UF_MAILING"] > 0) $arFields["GROUP_ID"][] = $SUBSCRIBER_USER_GROUP_ID;	
	return $arFields;
}






AddEventHandler("main", "OnAfterUserUpdate", "OnAfterUserUpdateHandler");
function OnAfterUserUpdateHandler($arFields) 
{
	global $USER;
	global $OKRUGS;
	$SUBSCRIBER_USER_GROUP_ID = 13;		// ID группы подписчиков, смотреть /bitrix/admin/group_admin.php?lang=ru
	
	$arFields["LOGIN"] = $arFields["EMAIL"];
	$arGroups = CUser::GetUserGroup($USER->GetID());
	
	/*
	if($arFields["UF_MAILING"]>0) 
	{
		if(!in_array($SUBSCRIBER_USER_GROUP_ID, $arGroups))
		{
			$arGroups[] = $SUBSCRIBER_USER_GROUP_ID;
			CUser::SetUserGroup($USER->GetID(), $arGroups);
		}
	}
	else
	{
		if(in_array($SUBSCRIBER_USER_GROUP_ID, $arGroups))
		{
			unset($to_del);
			for($i=0; $i<count($arGroups); $i++) 
			{
				if($arGroups[$i] == $SUBSCRIBER_USER_GROUP_ID) $to_del = $i;
			}
			if(isset($to_del)) 
			{
				unset($arGroups[$to_del]);
				CUser::SetUserGroup($USER->GetID(), $arGroups);
			}
		}

	}
	*/
	
	
	
	
	
	// если пользователь из публички изменил данные то отправлем инфу об этом менеджеру
	
	if(defined("SITE_TEMPLATE_ID"))
	{

		// выясним расхождения (измененные данные)
		$changes = "";
		foreach($_REQUEST as $code => $arField) 
		{
			if(strpos(" ".$code, "OLD_") == 1) 
			{	
					
				if( ($_REQUEST[str_replace("OLD_", "", $code)] != $arField) && ($_REQUEST[str_replace("OLD_", "", $code)."_old_id"] != $arField) ) 
				{
					if($code == "OLD_UF_ASSORTIMENT") continue;
					
					if($code == "OLD_UF_OKRUG") 
					{
						$arField = $OKRUGS[$arField];
						$_REQUEST[str_replace("OLD_", "", $code)] = $OKRUGS[$_REQUEST[str_replace("OLD_", "", $code)]];
					}
					
					$changes .= 'Поле "'.$_REQUEST[str_replace("OLD_", "", $code)."_NAME"].'" изменено:<br/>';
					$changes .= '- старое значение: '.$arField.'<br/>';
					$changes .= '- новое значение: '.$_REQUEST[str_replace("OLD_", "", $code)].'<br/><br/>';
				}
			}	
		}
	
		for($i=0; $i<count($arFields["UF_ASSORTIMENT"]); $i++) 
		{
			if(trim($arFields["UF_ASSORTIMENT"][$i]) == "") continue;
			$MANAGER_MAIL[] = get_manager_mail($arFields["UF_ASSORTIMENT"][$i], $arFields["UF_OKRUG"]);
		}
		
		$MANAGER_MAILS = implode(",", $MANAGER_MAIL);
		
		//prn($MANAGER_MAILS);
		//die();
		
		$arEventFields = array(
			"LOGIN" => $arFields["LOGIN"],
			"USER_ID" => $arFields["ID"],
			"MANAGER_MAILS" => $MANAGER_MAILS,
			//"MANAGER_MAIL_1" => isset($MANAGER_MAIL[1]) ? $MANAGER_MAIL[1] : " ",
			"CHANGES" => $changes
			);
		
		if(strLen(trim($MANAGER_MAILS)) > 0)
			CEvent::Send("USER_INFO", "s1", $arEventFields, "N", 76);
	}	

	
	
}






AddEventHandler("main", "OnEpilog", "syncFotoFunc");
function syncFotoFunc()
{
	if(strpos(" ".$_SERVER["REQUEST_URI"], "/bitrix/admin/")>0)
	{
		if(file_exists($_SERVER["DOCUMENT_ROOT"]."/tools/img_sync_plan.txt"))
		{
			$t = file($_SERVER["DOCUMENT_ROOT"]."/tools/img_sync_plan.txt");
			$xml = trim($t[0]);
			
			$f = fopen($_SERVER["DOCUMENT_ROOT"]."/tools/tmp.txt", "a+");
			fwrite($f, $_SERVER["REQUEST_URI"]." - ".$xml."\n");
			fclose($f);
			
			$res = QueryGetData("www.sogrevay.ru", 80, "/tools/img_sync.php", "xml=".$xml, $errno, $errstr);
			
			unlink($_SERVER["DOCUMENT_ROOT"]."/tools/img_sync_plan.txt");
			
			mail("turtell@yandex.ru", "NEWVAY to SOGREVAY sync images for ".$xml, $xml);
		}
	}
}






// =======================================================================================================================
//   Функция подстановки картинок из свойства MORE_PHOTO и DETAIL_PICTURE товара в соответствующие его предложения
//   (сопоставление по подписям картинок и названиям торговых предложений)
//    принимает ArItem и отдаёт измененный его же
//    учитывает некоторые различия при вызове из раздела (section = true) и из карточки товара (secion = false)
// =======================================================================================================================

function setOfferPictures_($arItem, $section = true) 
{
	/*
	if($section) 
	{
		$WIDTH = 200;  	// ????????????????? УТОЧНИТЬ
		$HEIGHT = 300;	// ????????????????? УТОЧНИТЬ
	}
	else
	{
		$WIDTH = 1000;	// ????????????????? УТОЧНИТЬ
		$HEIGHT = 1500;	// ????????????????? УТОЧНИТЬ
	}
	*/
	
	$arPictures = Array();
	// Добавим в массив фото детальное фото товара, ибо оно не попадает в свойство MORE_PHOTO
	if($arItem["DETAIL_PICTURE"])
	{
		//pra(" ".strtoupper($arItem["DETAIL_PICTURE"]["DESCRIPTION"]));
		//pra(strpos(" ".strtoupper($arItem["DETAIL_PICTURE"]["DESCRIPTION"]), "ЦВЕТ"));
		if(strpos(" ".strtoupper($arItem["DETAIL_PICTURE"]["DESCRIPTION"]), "ЦВЕТ") > 0)
			$t = explode("ЦВЕТ ", strtoupper($arItem["DETAIL_PICTURE"]["DESCRIPTION"]));
		else
			$t[1] = strtoupper($arItem["DETAIL_PICTURE"]["DESCRIPTION"]);
		if(strpos(" ".$t[1], "(") > 0) $t[1] = trim(substr($t[1], 0, strpos($t[1], "(")));		// берем часть строки до скобки (чтобы не брать (1)(2) и т.д.)
		/*
		$file = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array('width' => $WIDTH, 'height' => $HEIGHT), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		$f = Array(
				"ID" => $arItem["DETAIL_PICTURE"]["ID"],
				"SRC" => $file["src"],
				"WIDTH" => $file["width"],
				"HEIGHT" => $file["height"],
				"DESCRIPTION" => $arItem["DETAIL_PICTURE"]["DESCRIPTION"]
				);
		$arPictures[trim($t[1])][] = $f;
		*/
		$arPictures[trim($t[1])][] = CFile::GetFileArray($arItem["DETAIL_PICTURE"]["ID"]);
	}
	
	// Добавим все картинки из свойства MORE_PHOTO (если там одна картинка, чуть-чуть обработка отличается)
	if(count($arItem["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["VALUE"]) == 1)
	{
		if(strpos(" ".strtoupper($arItem["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"]["DESCRIPTION"]), "ЦВЕТ") > 0)
			$t = explode("ЦВЕТ ", strtoupper($arItem["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"]["DESCRIPTION"]));
		else 
			$t[1] = strtoupper($arItem["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"]["DESCRIPTION"]);
		if(strpos(" ".$t[1], "(") > 0) $t[1] = trim(substr($t[1], 0, strpos($t[1], "(")));		// берем часть строки до скобки (чтобы не брать (1)(2) и т.д.)
		/*
		$file = CFile::ResizeImageGet($arItem["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"]["ID"], array('width' => $WIDTH, 'height' => $HEIGHT), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		$f = Array(
				"ID" => $arItem["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"]["ID"],
				"SRC" => $file["src"],
				"WIDTH" => $file["width"],
				"HEIGHT" => $file["height"],
				"DESCRIPTION" => $arItem["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"]["DESCRIPTION"]
				);
		$arPictures[trim($t[1])][] = $f;
		*/
		$arPictures[trim($t[1])][] = CFile::GetFileArray($arItem["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"]["ID"]);
	}
	else foreach($arItem["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"] as $arPicture)
	{
		if(strpos(" ".strtoupper($arPicture["DESCRIPTION"]), "ЦВЕТ") > 0)
			$t = explode("ЦВЕТ ", strtoupper($arPicture["DESCRIPTION"]));
		else
			$t[1] = strtoupper($arPicture["DESCRIPTION"]);
		if(strpos(" ".$t[1], "(") > 0) $t[1] = trim(substr($t[1], 0, strpos($t[1], "(")));		// берем часть строки до скобки (чтобы не брать (1)(2) и т.д.)
		/*
		$file = CFile::ResizeImageGet($arPicture["ID"], array('width' => $WIDTH, 'height' => $HEIGHT), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		$f = Array(
				"ID" => $arPicture["ID"],
				"SRC" => $file["src"],
				"WIDTH" => $file["width"],
				"HEIGHT" => $file["height"],
				"DESCRIPTION" => $arPicture["DESCRIPTION"]
				);
		$arPictures[trim($t[1])][] = $f;
		*/
		$arPictures[trim($t[1])][] = CFile::GetFileArray($arPicture["ID"]);
	}
	//prn($arPictures);
	
	
	
	// если запуск из раздела
	if($section)
	{
		// Сравниваем по свойству цвет торгового предложения (раньше было по названию!)
		foreach($arItem["OFFERS"] as $keyOffer => $arOffer)
		{
			
			// находим совпадения
			foreach($arPictures as $color => $arP)
			{
				if(trim($color) == trim(strtoupper($arOffer["PROPERTIES"]["COLOR"]["VALUE"])))
				//if(strpos(" ".strtoupper($arOffer["NAME"]), $color) > 0) 
				{
					$arItem["OFFERS"][$keyOffer]["DETAIL_PICTURE"] = $arP[0];
					$arItem["OFFERS"][$keyOffer]["PREVIEW_PICTURE"] = Array(
						"ID" => $arP[0]["ID"],
						"SRC" => $arP[0]["SRC"],
						"WIDTH" => $arP[0]["WIDTH"],
						"HEIGHT" => $arP[0]["HEIGHT"]
						);
					break;
				}
			}
			
			// если нет совпадения, ставим заглушку
			if(!is_array($arItem["OFFERS"][$keyOffer]["DETAIL_PICTURE"]))
			{
				$arItem["OFFERS"][$keyOffer]["PREVIEW_PICTURE"] = Array(
					"ID" => "",
					"SRC" => "/upload/no_female_big.gif",
					"WIDTH" => WIDTH_MAIN_PHOTO,
					"HEIGHT" => HEIGHT_MAIN_PHOTO
					);
				$arItem["OFFERS"][$keyOffer]["DETAIL_PICTURE"] = $arItem["OFFERS"][$keyOffer]["PREVIEW_PICTURE"];
			}
		}
	}
	// иначе из карточки товара
	else
	{
		$arEmptyMorePhoto = Array(CFile::GetFileArray(NOFOTO_FILE_ID));
		//prn($arEmptyMorePhoto);
		
		// Сравниваем по свойству цвет торгового предложения (раньше было по названию!)
		foreach($arItem["OFFERS"] as $keyOffer => $arOffer)
		{
			//prn($arOffer);
			// находим совпадения
			foreach($arPictures as $color => $arP)
			{
				//prn(trim($color)." = ".trim(strtoupper($arOffer["PROPERTIES"]["COLOR_LIST"]["VALUE"])));
				if(trim($color) == trim(strtoupper($arOffer["PROPERTIES"]["COLOR_LIST"]["VALUE"])))
				//if(strpos(" ".strtoupper($arOffer["NAME"]), $color) > 0) 
				{
					$arItem["OFFERS"][$keyOffer]["MORE_PHOTO"] = $arP;
					$arItem["OFFERS"][$keyOffer]["MORE_PHOTO_COUNT"] = count($arP);
					break;
				}
			}
			
			if($arItem["OFFERS"][$keyOffer]["MORE_PHOTO_COUNT"]<1)
			{
				$arItem["OFFERS"][$keyOffer]["MORE_PHOTO"] = $arEmptyMorePhoto;
				$arItem["OFFERS"][$keyOffer]["MORE_PHOTO"][0]["DESCRIPTION"] = $arOffer["PROPERTIES"]["COLOR_LIST"]["VALUE"];
				$arItem["OFFERS"][$keyOffer]["MORE_PHOTO_COUNT"] = 1;
				//prn($arOffer["ID"]." = ".$arOffer["PROPERTIES"]["COLOR_LIST"]["VALUE"]);
				//prn($arItem["OFFERS"][$keyOffer]["MORE_PHOTO"]);
			}
			
		}
	}
	return $arItem;
}





// =======================================================================================================================
//   Функция сортировки торговых предложений чтобы сначала шли те, картинка которых задана как основная картинка товара
//    учитываем возможный фильтр по цвету или оттенку цвета
// =======================================================================================================================

function sortOffersInItem_($arItem)
{
	global $USER;
	
	$PROPERTY_COLOR_CODE = "=PROPERTY_193";  // код свойства цвет торговых предлжожений 
	$PROPERTY_TONE_CODE = "=PROPERTY_127";   // код свойства оттенок торговых предложений
	
	//prn($GLOBALS["arrFilter"]);
	
	if(isset($GLOBALS["arrFilter"]["OFFERS"][$PROPERTY_COLOR_CODE]))
	{
		$arColors = $GLOBALS["arrFilter"]["OFFERS"][$PROPERTY_COLOR_CODE];
		$arRes = CIBlockPropertyEnum::GetByID($arColors[0]);
		$FIRST_COLOR = strtoupper($arRes["VALUE"]);
		
		$arFirstOffers = Array();
		$arLastOffers = Array();
		$arNewOffers = Array();
		foreach($arItem["OFFERS"] as $arOffer)
		{
			if(stripos(" ".$arOffer["NAME"], $FIRST_COLOR) > 0) $arFirstOffers[] = $arOffer;
			else $arLastOffers[] = $arOffer;			
		}
		$arNewOffers = array_merge($arFirstOffers, $arLastOffers);
		$arItem["OFFERS"] = $arNewOffers;
	}
	elseif(isset($GLOBALS["arrFilter"]["OFFERS"][$PROPERTY_TONE_CODE]))
	{
		$arFirstOffers = Array();
		$arLastOffers = Array();
		$arNewOffers = Array();
		
		foreach($arItem["OFFERS"] as $arOffer)
		{
			foreach($GLOBALS["arrFilter"]["OFFERS"][$PROPERTY_TONE_CODE] as $color)
			{
				if(in_array($color, $arOffer["DISPLAY_PROPERTIES"]["TONE"]["VALUE"])) $arFirstOffers[] = $arOffer;
				else $arLastOffers[] = $arOffer;
			}
		}
		$arNewOffers = array_merge($arFirstOffers, $arLastOffers);
		$arItem["OFFERS"] = $arNewOffers;
		//foreach($arItem["OFFERS"] as $arOffer) prn($arOffer["NAME"]);
	}
	else
	{
		// 1) сначала в качестве главного offer выберем offer с фото
		foreach($arItem["OFFERS"] as $arOffer)
		{
			if(is_array($arOffer["MORE_PHOTO"]) || ( is_array($arOffer["DETAIL_PICTURE"]) && ($arOffer["DETAIL_PICTURE"]["SRC"] != "/upload/no_female_big.gif"))) 
			{
				$FIRST_COLOR = strtoupper(trim($arOffer["PROPERTIES"]["COLOR_LIST"]["VALUE"]));
				break;
			};
		};
		//pra($FIRST_COLOR);
		
		
		// 2) далее, если в главном фото товара указан offer с фото, то назначим главным тогда его, иначе оставляем выбранный на первом этапе
		$t = explode("ЦВЕТ", strtoupper($arItem["DETAIL_PICTURE"]["DESCRIPTION"]));
		$var = "";   // возможный вариант цвета
		if(isset($t[1]))
			$var = strtoupper(trim($t[1]));
		else 
			$var = strtoupper(trim($t[0]));
		foreach($arItem["OFFERS"] as $arOffer)
		{
			if( (stripos(" ".$arOffer["NAME"], $var) > 0)/*  && is_array($arOffer["MORE_PHOTO"])*/) 
			{
				$FIRST_COLOR = strtoupper(trim($arOffer["PROPERTIES"]["COLOR_LIST"]["VALUE"]));
				break;
			};
		};
		//pra($FIRST_COLOR);
	
		
		
		$arFirstOffers = Array();
		$arLastOffers = Array();
		$arNewOffers = Array();
		
		foreach($arItem["OFFERS"] as $arOffer)
		{
			if(stripos(" ".$arOffer["NAME"], $FIRST_COLOR) > 0) $arFirstOffers[] = $arOffer;
			else $arLastOffers[] = $arOffer;			
		}
		$arNewOffers = array_merge($arFirstOffers, $arLastOffers);
		$arItem["OFFERS"] = $arNewOffers;
	}
	return $arItem;
}




// =======================================================================================================================
//   Функция подстановки нужной превью картинки по коду торгового предложения
//    возвращает массив картинки
//    если заданы width и height, то преобразует к заданному размеру
// =======================================================================================================================

function getPreview_($offerID, $width=false, $height=false)
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
		while($arRes = $dbRes->GetNext())
		{
			/*
			$t = CFile::GetFileArray($arRes["PROPERTY_MORE_PHOTO_VALUE"]);
			$e = explode("ЦВЕТ", strtoupper($t["DESCRIPTION"]));
			$arPictures[trim($e[1])][] = $t;
			$detail_picture = $arRes["DETAIL_PICTURE"]; 
			*/
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
				if(count($e)>1) $arPictures[trim($e[1])][] = $t;
				else $arPictures[trim($e[0])][] = $t;
			}
			$detail_picture = $arRes["DETAIL_PICTURE"];
		}
		$t1 = CFile::GetFileArray($detail_picture);
		$e1 = explode("ЦВЕТ", strtoupper($t1["DESCRIPTION"]));
		$arPictures[trim($e1[1])][] = $t1;
		
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







// =======================================================================================================================
//   Функция подстановки картинок из свойства MORE_PHOTO и DETAIL_PICTURE товара в соответствующие его предложения
//   (сопоставление по подписям картинок и названиям торговых предложений)
//    принимает ArItem и отдаёт измененный его же
//    учитывает некоторые различия при вызове из раздела (section = true) и из карточки товара (section = false)
// =======================================================================================================================

function setOfferPictures($arItem, $section = true) 
{
	if($section) 
	{
		$WIDTH = 300;
		$HEIGHT = 400;
	}
	else
	{
		$WIDTH = 1000;
		$HEIGHT = 1500;
	}
	
	$arPictures = Array();
		
	// подготовим ватермарки
	$arWaterMark = Array();
	$arWaterMarkBig = Array();
	if(!$section)
	{
		if($arItem["PROPERTIES"]["COLLECTION"]["VALUE"] == "VAYMAN") 
		{
			$wsrc 		= $_SERVER["DOCUMENT_ROOT"]."/upload/watermarks/water_male.png";
			$wsrcbig	= $_SERVER["DOCUMENT_ROOT"]."/upload/watermarks/water_male_big3.png";
		}
		else 
		{
			$wsrc 		= $_SERVER["DOCUMENT_ROOT"]."/upload/watermarks/water_female.png";
			$wsrcbig 	= $_SERVER["DOCUMENT_ROOT"]."/upload/watermarks/water_female_big3.png";
		}
		
		$arWaterMark = Array(
			Array(
				"name" => "watermark",
				"position" => "bottomleft", // Положение
				"type" => "image",
				"size" => "real",
				"file" => $wsrc, // Путь к картинке
				"fill" => "exact",
			)
		);
		$arWaterMarkBig = Array(
			Array(
				"name" => "watermark",
				"position" => "bottomleft", // Положение
				"type" => "image",
				"size" => "real",
				"file" => $wsrcbig, // Путь к картинке
				"fill" => "exact",
			)
		);
	}
	
	// Добавим в массив фото детальное фото товара, ибо оно не попадает в свойство MORE_PHOTO
	if($arItem["DETAIL_PICTURE"])
	{
		//pra(" ".strtoupper($arItem["DETAIL_PICTURE"]["DESCRIPTION"]));
		//pra(strpos(" ".strtoupper($arItem["DETAIL_PICTURE"]["DESCRIPTION"]), "ЦВЕТ"));
		if(strpos("  ".strtoupper($arItem["DETAIL_PICTURE"]["DESCRIPTION"]), " ЦВЕТ ") > 0)
			$t = explode(" ЦВЕТ ", strtoupper($arItem["DETAIL_PICTURE"]["DESCRIPTION"]));
		else
			$t[1] = strtoupper($arItem["DETAIL_PICTURE"]["DESCRIPTION"]);
		//if(strpos(" ".$t[1], "(") > 0) $t[1] = trim(substr($t[1], 0, strpos($t[1], "(")));		// берем часть строки до скобки (чтобы не брать (1)(2) и т.д.)
		
		// накладываем нужный ватермарк
		$arF = CFile::GetFileArray($arItem["DETAIL_PICTURE"]["ID"]);
		if($arF["WIDTH"] > 800)
			$file = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array('width' => $WIDTH, 'height' => $HEIGHT), BX_RESIZE_IMAGE_PROPORTIONAL, true, $arWaterMarkBig);
		else
			$file = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array('width' => $WIDTH, 'height' => $HEIGHT), BX_RESIZE_IMAGE_PROPORTIONAL, true, $arWaterMark);
		
		$f = Array(
				"ID" => $arItem["DETAIL_PICTURE"]["ID"],
				//"SRC" => $file["src"],
				"SRC" => str_replace(" ", "%20", $file["src"]),
				"WIDTH" => $file["width"],
				"HEIGHT" => $file["height"],
				"DESCRIPTION" => $arItem["DETAIL_PICTURE"]["DESCRIPTION"]
				);
		$arPictures[trim($t[1])][] = $f;
	}
	
	
	// Добавим все картинки из свойства MORE_PHOTO (если там одна картинка, чуть-чуть обработка отличается)
	if(count($arItem["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["VALUE"]) == 1)
	{
		if(strpos("  ".strtoupper($arItem["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"]["DESCRIPTION"]), " ЦВЕТ ") > 0)
			$t = explode(" ЦВЕТ ", strtoupper($arItem["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"]["DESCRIPTION"]));
		else 
			$t[1] = strtoupper($arItem["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"]["DESCRIPTION"]);
		//if(strpos(" ".$t[1], "(") > 0) $t[1] = trim(substr($t[1], 0, strpos($t[1], "(")));		// берем часть строки до скобки (чтобы не брать (1)(2) и т.д.)
		
		// накладываем нужный ватермарк	
		$arF = CFile::GetFileArray($arItem["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"]["ID"]);
		if($arF["WIDTH"] > 800)
			$file = CFile::ResizeImageGet($arItem["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"]["ID"], array('width' => $WIDTH, 'height' => $HEIGHT), BX_RESIZE_IMAGE_PROPORTIONAL, true, $arWaterMarkBig);
		else
			$file = CFile::ResizeImageGet($arItem["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"]["ID"], array('width' => $WIDTH, 'height' => $HEIGHT), BX_RESIZE_IMAGE_PROPORTIONAL, true, $arWaterMark);

		$f = Array(
			"ID" => $arItem["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"]["ID"],
			//"SRC" => $file["src"],
			"SRC" => str_replace(" ", "%20", $file["src"]),
			"WIDTH" => $file["width"],
			"HEIGHT" => $file["height"],
			"DESCRIPTION" => $arItem["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"]["DESCRIPTION"]
			);
		$arPictures[trim($t[1])][] = $f;
	}
	else foreach($arItem["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"] as $arPicture)
	{
		if(strpos("  ".strtoupper($arPicture["DESCRIPTION"]), " ЦВЕТ ") > 0)
			$t = explode(" ЦВЕТ ", strtoupper($arPicture["DESCRIPTION"]));
		else
			$t[1] = strtoupper($arPicture["DESCRIPTION"]);
		//if(strpos(" ".$t[1], "(") > 0) $t[1] = trim(substr($t[1], 0, strpos($t[1], "(")));		// берем часть строки до скобки (чтобы не брать (1)(2) и т.д.)
		
		// накладываем нужный ватермарк	
		$arF = CFile::GetFileArray($arPicture["ID"]);
		if($arF["WIDTH"] > 800)
			$file = CFile::ResizeImageGet($arPicture["ID"], array('width' => $WIDTH, 'height' => $HEIGHT), BX_RESIZE_IMAGE_PROPORTIONAL, true, $arWaterMarkBig);
		else
			$file = CFile::ResizeImageGet($arPicture["ID"], array('width' => $WIDTH, 'height' => $HEIGHT), BX_RESIZE_IMAGE_PROPORTIONAL, true, $arWaterMark);
		
		$f = Array(
				"ID" => $arPicture["ID"],
				//"SRC" => $file["src"],
				"SRC" => str_replace(" ", "%20", $file["src"]),
				"WIDTH" => $file["width"],
				"HEIGHT" => $file["height"],
				"DESCRIPTION" => $arPicture["DESCRIPTION"]
				);
		$arPictures[trim($t[1])][] = $f;
	}
	//pra($arItem);
	//pra($arPictures); 
	
	
	
	
	// подготовим заглушку
	$nofoto = Array();
	$f = CFile::ResizeImageGet(NOFOTO_FILE_ID, array('width'=>$WIDTH, 'height'=>$HEIGHT), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	$nofoto["ID"] = NOFOTO_FILE_ID;
	$nofoto["WIDTH"] = $f["width"];
	$nofoto["HEIGHT"] = $f["height"];
	$nofoto["SRC"] = $f["src"];
	
	
	
	
	// если запуск из раздела
	if($section)
	{
		// Сравниваем по свойству цвет торгового предложения (раньше было по названию!)
		foreach($arItem["OFFERS"] as $keyOffer => $arOffer)
		{
			
			// находим совпадения
			foreach($arPictures as $color => $arP)
			{
				//pra(trim($color)." = ".trim(strtoupper($arOffer["PROPERTIES"]["COLOR_LIST"]["VALUE"])));
				if(trim($color) == trim(strtoupper($arOffer["PROPERTIES"]["COLOR_LIST"]["VALUE"])))
				//if(strpos(" ".strtoupper($arOffer["NAME"]), $color) > 0) 
				{
					//pra("YES");
					$arItem["OFFERS"][$keyOffer]["DETAIL_PICTURE"] = $arP[0];
					$arItem["OFFERS"][$keyOffer]["PREVIEW_PICTURE"] = Array(
						"ID" => $arP[0]["ID"],
						"SRC" => $arP[0]["SRC"],
						"WIDTH" => $arP[0]["WIDTH"],
						"HEIGHT" => $arP[0]["HEIGHT"]
						);
					break;
				}
			}
			
			// если нет совпадения, ставим заглушку
			if(!is_array($arItem["OFFERS"][$keyOffer]["DETAIL_PICTURE"]))
			{
				/*
				$arItem["OFFERS"][$keyOffer]["PREVIEW_PICTURE"] = Array(
					"ID" => "",
					//"SRC" => "/upload/no_female_big.gif",
					"SRC" => "/upload/no_photo_sm.jpg",
					"WIDTH" => $WIDTH,
					"HEIGHT" => $HEIGHT
					);
				*/
				$arItem["OFFERS"][$keyOffer]["PREVIEW_PICTURE"] = $nofoto;
				$arItem["OFFERS"][$keyOffer]["DETAIL_PICTURE"] = $nofoto;//$arItem["OFFERS"][$keyOffer]["PREVIEW_PICTURE"];
			}
		}
	}
	// иначе из карточки товара
	else
	{
		// Сравниваем по свойству цвет торгового предложения (раньше было по названию!)
		foreach($arItem["OFFERS"] as $keyOffer => $arOffer)
		{
			// находим совпадения
			$find = false;
			foreach($arPictures as $color => $arP)
			{
				//pra(trim($color)." = ".trim(strtoupper($arOffer["PROPERTIES"]["COLOR"]["VALUE"])));
				if(trim($color) == trim(strtoupper($arOffer["PROPERTIES"]["COLOR_LIST"]["VALUE"])))
				//if(strpos(" ".strtoupper($arOffer["NAME"]), $color) > 0) 
				{
					$arItem["OFFERS"][$keyOffer]["MORE_PHOTO"] = $arP;
					$arItem["OFFERS"][$keyOffer]["MORE_PHOTO_COUNT"] = count($arP);
					$find = true;
					break;
				}
			}
			if(!$find) 
			{
				$arItem["OFFERS"][$keyOffer]["MORE_PHOTO"][] = $nofoto;
				$arItem["OFFERS"][$keyOffer]["MORE_PHOTO_COUNT"] = 1;
				/*
				$arItem["OFFERS"][$keyOffer]["MORE_PHOTO"][] = Array(
					"ID" => "",
					"SRC" => "/upload/no_photo.jpg",
					"WIDTH" => 533,//$WIDTH,
					"HEIGHT" => 800//$HEIGHT
					);
				*/
				//pra($arOffer["NAME"]." needed");
			}
		}
	}
	
	return $arItem;
	
}




// =======================================================================================================================
//   Функция сортировки торговых предложений чтобы сначала шли те, картинка которых задана как основная картинка товара
//    учитываем возможный фильтр по цвету или оттенку цвета
// =======================================================================================================================

function sortOffersInItem($arItem)
{
	global $USER;
	
	$PROPERTY_COLOR_CODE = "=PROPERTY_193";  // код свойства цвет торговых предлжожений 
	$PROPERTY_TONE_CODE = "=PROPERTY_127";   // код свойства оттенок торговых предложений
	
	//prn($GLOBALS["arrFilter"]);
	
	if(isset($GLOBALS["arrFilter"]["OFFERS"][$PROPERTY_COLOR_CODE]))
	{
		$arColors = $GLOBALS["arrFilter"]["OFFERS"][$PROPERTY_COLOR_CODE];
		$arRes = CIBlockPropertyEnum::GetByID($arColors[0]);
		$FIRST_COLOR = strtoupper($arRes["VALUE"]);
		
		$arFirstOffers = Array();
		$arLastOffers = Array();
		$arNewOffers = Array();
		foreach($arItem["OFFERS"] as $arOffer)
		{
			if(stripos(" ".$arOffer["NAME"], $FIRST_COLOR) > 0) $arFirstOffers[] = $arOffer;
			else $arLastOffers[] = $arOffer;			
		}
		$arNewOffers = array_merge($arFirstOffers, $arLastOffers);
		$arItem["OFFERS"] = $arNewOffers;
	}
	elseif(isset($GLOBALS["arrFilter"]["OFFERS"][$PROPERTY_TONE_CODE]))
	{
		$arFirstOffers = Array();
		$arLastOffers = Array();
		$arNewOffers = Array();
		
		foreach($arItem["OFFERS"] as $arOffer)
		{
			foreach($GLOBALS["arrFilter"]["OFFERS"][$PROPERTY_TONE_CODE] as $color)
			{
				if(in_array($color, $arOffer["DISPLAY_PROPERTIES"]["TONE"]["VALUE"])) $arFirstOffers[] = $arOffer;
				else $arLastOffers[] = $arOffer;
			}
		}
		$arNewOffers = array_merge($arFirstOffers, $arLastOffers);
		$arItem["OFFERS"] = $arNewOffers;
		//foreach($arItem["OFFERS"] as $arOffer) prn($arOffer["NAME"]);
	}
	else
	{
		// 1) сначала в качестве главного offer выберем offer с фото
		foreach($arItem["OFFERS"] as $arOffer)
		{
			if((is_array($arOffer["MORE_PHOTO"]) && ($arOffer["MORE_PHOTO"][0]["ID"] != NOFOTO_FILE_ID)) || ( is_array($arOffer["DETAIL_PICTURE"]) && ($arOffer["DETAIL_PICTURE"]["ID"] != NOFOTO_FILE_ID))) 
			{
				$FIRST_COLOR = strtoupper(trim($arOffer["PROPERTIES"]["COLOR_LIST"]["VALUE"]));
				//pra($arOffer);
				break;
			};
		};
		//pra($arOffer["NAME"]);
		//pra($FIRST_COLOR);
		
		
		// 2) далее, если в главном фото товара указан offer с фото, то назначим главным тогда его, иначе оставляем выбранный на первом этапе
		$t = explode(" ЦВЕТ ", strtoupper(" ".$arItem["DETAIL_PICTURE"]["DESCRIPTION"]));
		$var = "";   // возможный вариант цвета
		if(isset($t[1]))
			$var = strtoupper(trim($t[1]));
		else 
			$var = strtoupper(trim($t[0]));
		//pra($var);
		//pra("===");
		foreach($arItem["OFFERS"] as $arOffer)
		{
			//pra($arOffer["CATALOG_QUANTITY"]);
			//break;
			//pra($arOffer["PROPERTIES"]["COLOR_LIST"]);
			/*
			if( (stripos(" ".$arOffer["NAME"], $var) > 0)) 
			{
				$FIRST_COLOR = strtoupper(trim($arOffer["PROPERTIES"]["COLOR_LIST"]["VALUE"]));
				break;
			};
			*/
			//pra(trim(strtoupper($arOffer["PROPERTIES"]["COLOR_LIST"]["VALUE"])));
			if($var == trim(strtoupper($arOffer["PROPERTIES"]["COLOR_LIST"]["VALUE"])))
			{
				//pra($arOffer["NAME"]);
				$FIRST_COLOR = strtoupper(trim($arOffer["PROPERTIES"]["COLOR_LIST"]["VALUE"]));
				break;
			}
			
		};
		//pra($FIRST_COLOR);
	
		
		
		$arFirstOffers = Array();
		$arLastOffers = Array();
		$arNewOffers = Array();
		
		foreach($arItem["OFFERS"] as $arOffer)
		{
			//if(stripos(" ".$arOffer["NAME"], $FIRST_COLOR) > 0) $arFirstOffers[] = $arOffer;
			//else $arLastOffers[] = $arOffer;			
			if($FIRST_COLOR == trim(strtoupper($arOffer["PROPERTIES"]["COLOR_LIST"]["VALUE"])))  $arFirstOffers[] = $arOffer;
			else $arLastOffers[] = $arOffer;			
		}
		$arNewOffers = array_merge($arFirstOffers, $arLastOffers);
		$arItem["OFFERS"] = $arNewOffers;
	}
	return $arItem;
}




// =======================================================================================================================
//   Функция подстановки нужной превью картинки по коду торгового предложения
//    возвращает массив картинки
//    если заданы width и height, то преобразует к заданному размеру
// =======================================================================================================================

function getPreview($offerID, $width=false, $height=false)
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
				if(count($e)>1) $arPictures[trim($e[1])][] = $t;
				else $arPictures[trim($e[0])][] = $t;
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




// ================================================================================================================================
// Функция формирования данных arFields для шаблонов письма о новом заказе только по номеру заказа
// ================================================================================================================================

function getOrderMail($ORDER_ID) 
{
	global $OKRUGS, $PARTNER_TYPES, $APPLICATION, $USER;
	
	if(intVal($ORDER_ID) > 0)
	{
	
		$arFields = Array();
		$arFields["ORDER_LIST"] = "";
		$arFields["ORDER_PROPS"] = "";
		$arFields["AGENT_PROPS"] = "";
		$arFields["USER_COMMENTS"] = "";
		
	
		CModule::IncludeModule("iblock");
		CModule::IncludeModule("catalog");
		CModule::IncludeModule("sale");
		
		$arOrder = CSaleOrder::GetByID($ORDER_ID);
		
		
		
		// ===================== 1. ВЫБЕРЕМ ДАННЫЕ ПО КОНТРАГЕНТУ
		
		$arFilter = Array( "ID" => $arOrder["USER_ID"]);
		$arParam["SELECT"] = Array("UF_*");
		$rsUser = CUser::GetList(($by="personal_country"), ($order="desc"), $arFilter, $arParam); 
		if($arUser = $rsUser->GetNext()) 
		{
			$UF_OKRUG = $arUser["UF_OKRUG"];
			$UF_ASSORTIMENT = $arUser["UF_ASSORTIMENT"];
			$arFields["ORDER_USER_ID"] = $arOrder["USER_ID"];
		}

		
		
		
		
		
		
		
				
		// ===================== 2. ВЫБЕРЕМ ДАННЫЕ ПО ЗАКАЗУ
		
		$arPaySys = CSalePaySystem::GetByID($arOrder["PAY_SYSTEM_ID"], $arOrder["PERSON_TYPE_ID"]);
		
		if(strpos($arOrder["DELIVERY_ID"], ":")>0)
		{
			$t = explode(":", $arOrder["DELIVERY_ID"]);
			$delivery_id = $t[0];
			$profile_id = $t[1];
			$dbResult = CSaleDeliveryHandler::GetBySID($delivery_id);
			if($arResult = $dbResult->Fetch())
			{
				foreach($arResult["PROFILES"] as $p_code => $profile)
				{
					if($p_code == $profile_id)
					{
						$arDelivery["NAME"] = $profile["TITLE"];
					}
				}
			}
			
		}
		else
		{
			$arDelivery = CSaleDelivery::GetByID($arOrder["DELIVERY_ID"]);	
			if(!is_array($arDelivery)) $arDelivery["NAME"] = $arOrder["DELIVERY_ID"];	
		}

		$arPersonType = CSalePersonType::GetByID($arOrder["PERSON_TYPE_ID"]);
		$arOrderProps = Array();
		$dbRes = CSaleOrderPropsValue::GetList(
			array("SORT" => "ASC"),
			array("ORDER_ID" => $ORDER_ID)
			);
		while($arRes = $dbRes->Fetch())
		{
			$arOrderProps[$arRes["CODE"]] = Array(
				"NAME" => $arRes["NAME"],
				"VALUE" => $arRes["VALUE"]
				);
		}


		
		
		
		

		// =============== 3. ВЫБЕРЕМ ДАННЫЕ ПО КОРЗИНЕ

		$arBasketList = array();
		$dbBasketItems = CSaleBasket::GetList(
			array("ID" => "ASC"),
			array("ORDER_ID" => $ORDER_ID),
			false,
			false,
			Array()
			);
		$arOfferID = Array();
		while ($arItem = $dbBasketItems->Fetch())
		{
			$arOfferID[] = $arItem["PRODUCT_ID"];
			if (CSaleBasketHelper::isSetItem($arItem))
				continue;
			$arBasketList[] = $arItem;
		}
		$arBasketList = getMeasures($arBasketList);
		
		
	
		$arExtData = Array();
		$arProductID = Array();
		$dbRes = CIBlockElement::GetList(
			Array(),
			Array("IBLOCK_ID" => OFFERS_IBLOCK_ID, "ID" => $arOfferID),
			false,
			false,
			Array("ID", "IBLOCK_ID", "PROPERTY_CML2_LINK", "PROPERTY_CML2_LINK.DETAIL_PAGE_URL", "PROPERTY_COLOR", "PROPERTY_SIZE")
			);
		while($arRes = $dbRes->GetNext())
		{
			$db = CIBlockElement::GetByID($arRes["PROPERTY_CML2_LINK_VALUE"]);
			$ar = $db->GetNext();
			$arExtData[$arRes["ID"]]["LINK"] = "http://www.newvay.ru".$ar["DETAIL_PAGE_URL"];
			//$arExtData[$arRes["ID"]]["COLOR"] = $arRes["PROPERTY_COLOR_VALUE"];
			//$arExtData[$arRes["ID"]]["SIZE"] = $arRes["PROPERTY_SIZE_VALUE"];
		}
		
		// Сортируем в порядке возрастания Артикула (надо выбрать артикул ибо его нет в исходных данных корзины)

		$arOffersID = Array();
		foreach($arBasketList as $itemID => $arItem)
			$arOffersID[] = $arItem["PRODUCT_ID"];
		
		$arArticles = Array();
		$dbRes = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 7, "ID" => $arOffersID), false, false, Array("ID", "NAME", "PROPERTY_CML2_LINK", "PROPERTY_CML2_LINK.PROPERTY_CML2_ARTICLE"));
		while($arRes = $dbRes->GetNext())
		{
			$arArticles[$arRes["ID"]] = $arRes["PROPERTY_CML2_LINK_PROPERTY_CML2_ARTICLE_VALUE"];
		}
		asort($arArticles, SORT_NUMERIC);
		
		$arIndexes = Array(); 
		$ind = 0;
		foreach($arArticles as $k => $v) $arIndexes[$k] = $ind++;

		$newArr = Array();
		foreach($arBasketList as $arItem)
		{
			$newArr[$arIndexes[$arItem["PRODUCT_ID"]]] = $arItem;
		}
		ksort($newArr);
		$arBasketList = array_values($newArr);


		
		
		
		// ================== 4. Комментарий пользователя
		$arFields["USER_COMMENTS"] = "";
		if(strLen($arOrder["USER_DESCRIPTION"])>0)
		{
			$arFields["USER_COMMENTS"] = "<p style='font-size:14px;'><b>Комментарий пользователя:</b></p><p style='margin-left:20px;'>".$arOrder["USER_DESCRIPTION"]."</p>";
		}
		
		
		
		
		
		
		// ===================== 5. ФОРМИРУЕМ ВЫХОДНЫЕ ДАННЫЕ strAgentProps - вывод данных контрагента
		$strAgentProps = "<p style='font-size:14px;'><b>Данные контрагента:</b></p>";
		$strAgentProps .= "<table style='border-top:1px solid #CCC; font-size:14px;'>";
		if($arUser["UF_PARTNER_TYPE"] == 21) // физлицо
		{
			$strAgentProps .= "<tr><td style='width:200px; padding:10px 20px 2px 20px;'>Ф.И.О.:</td><td style='padding:10px 20px 2px 20px;'>".$arUser["UF_FIO"]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Паспортные данные:</td><td style='padding:2px 20px;'>".$arUser["UF_PASSPORT"]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>ИНН (физлицо):</td><td style='padding:2px 20px;'>".$arUser["UF_FIZ_INN"]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Город:</td><td style='padding:2px 20px;'>".$arUser["UF_CITY"]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Федеральный округ:</td><td style='padding:2px 20px;'>".$OKRUGS[$arUser["UF_OKRUG"]]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>E-mail:</td><td style='padding:2px 20px;'>".$arUser["EMAIL"]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Контактное лицо:</td><td style='padding:2px 20px;'>".$arUser["LAST_NAME"]." ".$arUser["NAME"]." ".$arUser["SECOND_NAME"]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Телефон:</td><td style='padding:2px 20px;'>".$arUser["PERSONAL_PHONE"]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Тип партнерства:</td><td style='padding:2px 20px;'>".$PARTNER_TYPES[$arUser["UF_PARTNER_TYPE"]]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>ИНН (копия):</td><td style='padding:2px 20px;'>".get_file_name($arUser["UF_DOC_INN"])."</td></tr>"; 
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>ОГРН (копия):</td><td style='padding:2px 20px;'>".get_file_name($arUser["UF_DOC_OGRN"])."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Паспорт (копия):</td><td style='padding:2px 20px;'>".get_file_name($arUser["UF_DOC_PASSPORT"])."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Комментарии:</td><td style='padding:2px 20px;'>".$arOrder["USER_DESCRIPTION"]."</td></tr>";
		}
		if(($arUser["UF_PARTNER_TYPE"] == 20)||(($arUser["UF_PARTNER_TYPE"] == 19))) // ИП/ООО
		{
			$strAgentProps .= "<tr><td style='width:200px; padding:10px 20px 2px 20px;'>Название компании:</td><td style='padding:10px 20px 2px 20px;'>".$arUser["UF_COMPANY_NAME"]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Юридический адрес:</td><td style='padding:2px 20px;'>".$arUser["UF_COMPANY_ADDRESS"]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>ИНН:</td><td style='padding:2px 20px;'>".$arUser["UF_INN"]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>КПП:</td><td style='padding:2px 20px;'>".$arUser["UF_KPP"]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>ОГРН:</td><td style='padding:2px 20px;'>".$arUser["UF_OGRN"]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Город:</td><td style='padding:2px 20px;'>".$arUser["UF_CITY"]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Федеральный округ:</td><td style='padding:2px 20px;'>".$OKRUGS[$arUser["UF_OKRUG"]]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>E-mail:</td><td style='padding:2px 20px;'>".$arUser["EMAIL"]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Контактное лицо:</td><td style='padding:2px 20px;'>".$arUser["LAST_NAME"]." ".$arUser["NAME"]." ".$arUser["SECOND_NAME"]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Телефон:</td><td style='padding:2px 20px;'>".$arUser["PERSONAL_PHONE"]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Тип партнерства:</td><td style='padding:2px 20px;'>".$PARTNER_TYPES[$arUser["UF_PARTNER_TYPE"]]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Устав (копия):</td><td style='padding:2px 20px;'>".get_file_name($arUser["UF_DOC_USTAV"])."</td></tr>"; 
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Приказ о гендиректоре (копия):</td><td style='padding:2px 20px;'>".get_file_name($arUser["UF_DOC_GENDIR"])."</td></tr>"; 
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>ИНН (копия):</td><td style='padding:2px 20px;'>".get_file_name($arUser["UF_DOC_INN"])."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>ОГРН (копия):</td><td style='padding:2px 20px;'>".get_file_name($arUser["UF_DOC_OGRN"])."</td></tr>";			
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Выписка из ЕГРН (копия):</td><td style='padding:2px 20px;'>".get_file_name($arUser["UF_DOC_EGRN"])."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Карточка с реквизитами:</td><td style='padding:2px 20px;'>".get_file_name($arUser["UF_DOC_REKVIZITY"])."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Комментарии:</td><td style='padding:2px 20px;'>".$arOrder["USER_DESCRIPTION"]."</td></tr>";
		}
		$strAgentProps .= "</table>";
		$strAgentProps .= "<p style='font-size:14px; font-style:italic; margin-left: 20px;'>Профиль на сайте - <a target='_blank' href='http://www.newvay.ru/bitrix/admin/user_edit.php?ID=".$arUser["ID"]."'>http://www.newvay.ru/bitrix/admin/user_edit.php?ID=".$arUser["ID"]."</a></p>";
		
		$arFields["AGENT_PROPS"] = $strAgentProps;
		
		
		
		
		
		// ===================== 6. ФОРМИРУЕМ ВЫХОДНЫЕ ДАННЫЕ strOrderProps - вывод свойств заказа
		
		$strOrderProps = "<p style='font-size:14px;'><b>Информация о доставке:</b></p>";
		$strOrderProps .= "<table style='border-top:1px solid #CCC; font-size:14px;'>";
		foreach($arOrderProps as $code => $arProp)
		{
			$val = $arProp["VALUE"];
			//if($code == "DELIVERY_PARAM") continue;
			//if($code == "LOCATION") continue;
			//if($code == "BASKET_DISCOUNT") $val = $val."%";
			if(!in_array($code, Array("DELIVERY_COMPANY", "DELIVERY_CITY", "DELIVERY_TYPE", "DELIVERY_FIO", "JUR_DELIVERY_COMPANY", "JUR_DELIVERY_CITY", "JUR_DELIVERY_TYPE", "JUR_DELIVERY_FIO"))) continue;
			
			if(($code == "DELIVERY_TYPE")||($code == "JUR_DELIVERY_TYPE"))
			{
				switch ($val)
				{
					case "empty": $val = "Не заполнено"; break;
					case "avto": $val = "Автомобильный транспорт"; break;
					case "train": $val = "Железнодорожный транспорт"; break;
					case "avia": $val = "Авиатранспорт"; break;
				}
			}
			
			$strOrderProps .= "<tr><td style='width:200px; padding:2px 20px; vertical-align: top;'>".$arProp["NAME"]."</td><td style='padding:2px 20px; vertical-align: top;'>".$val."</td></tr>";
		}
		$strOrderProps .= "</table>";
		$arFields["ORDER_PROPS"] = $strOrderProps;
		
		
		
		
		
		
		// ====================== 7. ФОРМИРУЕМ ВЫХОДНЫЕ ДАННЫЕ strOrderList - вывод корзины товаров
		
		$strOrderList = "<p style='font-size:14px;'><b>Состав заказа:</b></p>";
		$strOrderList .= "<table border='0' style='width:760px; border-collapse:collapse;' cellpadding='5'>";
		$strOrderList .= "<thead>\n<tr style='border-bottom:1px solid #CCCCCC;'>";
		$strOrderList .= "<td style='padding:10px; background-color: #b42e31; color: #FFFFFF; font-size:14px;'><b>№</b></td>";
		$strOrderList .= "<td style='padding:10px; background-color: #b42e31; color: #FFFFFF; font-size:14px;'><b>Фото</b></td>";
		$strOrderList .= "<td style='padding:10px; text-align:left; background-color: #b42e31; color: #FFFFFF; font-size:14px;'><b>Наименование</b></td>";
		$strOrderList .= "<td style='padding:10px; width:100px; background-color: #b42e31; color: #FFFFFF; font-size:14px;'><b>Цена</b></td>";
		$strOrderList .= "<td style='padding:10px; width:80px; background-color: #b42e31; color: #FFFFFF; white-space: nowrap; font-size:14px;'><b>Кол-во, шт.</b></td>";
		$strOrderList .= "<td style='padding:10px; width:100px; background-color: #b42e31; color: #FFFFFF; font-size:14px;'><b>Сумма</b></td>";
		$strOrderList .= "</tr>\n</thead><tbody>\n"; 
		
		$num = 0;
		foreach ($arBasketList as $arItem)
		{
			$price = $arItem["PRICE"];
			$oldprice = 0;
			$discount = 0;
			if($arItem["DISCOUNT_PRICE"] > 0)
			{
				$oldprice = $arItem["PRICE"] + $arItem["DISCOUNT_PRICE"];
				$discount = round($arItem["DISCOUNT_PRICE"]*100/($arItem["DISCOUNT_PRICE"] + $arItem["PRICE"]));
			}
			$arImg = getPreview($arItem["PRODUCT_ID"],110,110);
			$num++;
			$measureText = (isset($arItem["MEASURE_TEXT"]) && strlen($arItem["MEASURE_TEXT"])) ? $arItem["MEASURE_TEXT"] : GetMessage("SOA_SHT");
			$strOrderList .= "<tr style='border-bottom:1px solid #CCCCCC;'>";
			$strOrderList .= "<td style='padding:10px; font-size:14px;'>".$num."</td>\n";
			$strOrderList .= "<td style='padding:10px; font-size:14px;'><img height='80' src='".$arImg["SRC"]."'></td>\n";
			$strOrderList .= "<td style='padding:10px; padding-right:30px; font-size:14px;' class='prod-name'>";
			$strOrderList .= "<a href='".$arExtData[$arItem["PRODUCT_ID"]]["LINK"]."' style='color:#b42e31;'>".$arItem["NAME"]."</a>";
			$strOrderList .= "</td>\n";
			$strOrderList .= "<td style='padding:10px; white-space: nowrap; font-size:14px;'><b>".$price." руб.</b>";
			if($arItem["DISCOUNT_PRICE"] > 0) 
			{
				$strOrderList .= "<br><s style='color:#999; font-size:90%;'>".$oldprice." руб.</s>";
				$strOrderList .= "<br><span style='color:#b42e31;'>(-".$discount."%)</span><br>";
			};
			$strOrderList .= "</td>\n";
			$strOrderList .= "<td style='padding:10px; text-align:center; font-size:14px;'>".round($arItem["QUANTITY"])."</td>\n";
			$strOrderList .= "<td style='padding:10px; white-space: nowrap; font-size:14px;'><b>".$price*$arItem["QUANTITY"]." руб.</b></td>\n";
			$strOrderList .= "</tr>\n";
		}
		$strOrderList .= "</tbody></table>\n";

		$arFields["ORDER_LIST"] = $strOrderList;
		$arFields["PAYSYSTEM_NAME"] = $arPaySys["NAME"];
		$arFields["DELIVERY_NAME"] = $arDelivery["NAME"];

		return $arFields;

	}
	else
		return "Неверный номер заказа";
	
}






// 404

AddEventHandler("main", "OnEpilog", "Redirect404");
function Redirect404() {
    global $USER;
	if( 
     !defined('ADMIN_SECTION') &&  
     defined("ERROR_404") &&  
     defined("PATH_TO_404") &&  
     file_exists($_SERVER["DOCUMENT_ROOT"].PATH_TO_404) 
   ) {
        //LocalRedirect("/404.php", "404 Not Found");
        global $APPLICATION;
        $APPLICATION->RestartBuffer();
        CHTTP::SetStatus("404 Not Found");
		//$f = fopen($_SERVER["DOCUMENT_ROOT"]."/404.csv", "a+");
		//fwrite($f, date("d.m.Y H:i:s").";".$_SERVER['REMOTE_ADDR'].";http://newvay.ru".$_SERVER["REQUEST_URI"].";".$_SERVER["HTTP_REFERER"]."\n");
		//fclose($f);
        //include($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/header.php");
        include($_SERVER["DOCUMENT_ROOT"].PATH_TO_404);
        //include($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/footer.php");
    }
	
	//$arGroups = $USER->GetUserGroupArray();
	//if($USER->getID() == 7990) 
	//if(in_array(20, $USER->GetUserGroupArray()))
	//{
		//if($_SERVER["SCRIPT_NAME"] == "/index.php") LocalRedirect("http://www.newvay.ru/home.html", 301);
		//prd($_SERVER);
		//LocalRedirect("http://butsa.ru", 301);	
	//}
	
}

?><? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/zyter.smtp/classes/general/cmodulezytersmtp.php");?>