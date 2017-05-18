<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Доставка | Фемина Трейд");
$APPLICATION->SetPageProperty("keywords", "Доставка");
$APPLICATION->SetPageProperty("description", "Доставка");
$APPLICATION->SetTitle("Доставка");
$APPLICATION->AddChainItem("Доставка");
?>
<h1>Доставка</h1>
<p>Доставку до транспортной компании по г. Москве мы осуществляем <strong>бесплатно</strong>. Мы работаем со всеми ведущими грузоперевозчиками:</p>

<table width="100%">
<tr>
<td width="25%" align="center"><img src="/upload/transport/logo_jde.png"/></td>
<td width="25%" align="center"><img src="/upload/transport/logo_baikal.png"/></td>
<td width="25%" align="center"><img src="/upload/transport/logo_dellin.png"/></td>
<td width="25%" align="center"><img src="/upload/transport/logo_pek.png"/></td>
</tr><tr>
<td width="25%" align="center"><img src="/upload/transport/logo_bait.png"/></td>
<td width="25%" align="center"><img src="/upload/transport/logo_dtk.png"/></td>
<td width="25%" align="center"><img src="/upload/transport/logo_tes.png"/></td>
<td width="25%" align="center"></td>
</tr>
</table>

<p>Для удобства работы с Вами - офис, демонстрационный зал, склад, автопарк - находятся по одному адресу:<br/><br/><span style="font-weight:bold;">г. Москва, ул. Уткина, д. 48/8</strong> (пересечение пр. Буденного и ш. Энтузиастов)</span></p>

<?$APPLICATION->IncludeComponent("bitrix:map.yandex.view", ".default", array(
	"INIT_MAP_TYPE" => "MAP",
	"MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:55.759064776361065;s:10:\"yandex_lon\";d:37.7373978775913;s:12:\"yandex_scale\";i:14;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:37.74451880937921;s:3:\"LAT\";d:55.75987923012062;s:4:\"TEXT\";s:32:\"ООО \"Фемина Трейд\"\";}}}",
	"MAP_WIDTH" => "500",
	"MAP_HEIGHT" => "330",
	"CONTROLS" => array(
		0 => "ZOOM",
		1 => "MINIMAP",
		2 => "TYPECONTROL",
		3 => "SCALELINE",
	),
	"OPTIONS" => array(
		0 => "ENABLE_DBLCLICK_ZOOM",
		1 => "ENABLE_DRAGGING",
	),
	"MAP_ID" => ""
	),
	false
);?>

<p>Здесь Вы также можете забрать товар самовывозом</p>

 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>