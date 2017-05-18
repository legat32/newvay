<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Розничный магазин Фемина Трейд");
$APPLICATION->SetPageProperty("description", "Розничный магазин Фемина Трейд, торговый комплекс AST, метро Партизанская");
$APPLICATION->SetTitle("Розничный магазин");
?> 
<h1>Розничный магазин NEWVAY</h1>
 
<table>
  <tbody>
    <tr><td width="60%" valign="top"> 
        <p> 	<b>Адрес фирменного магазина &laquo;NEWVAY&raquo; в Москве:</b>
          <br />
         	г. Москва, Измайловское шоссе, дом 71А, 
          <br />
        Торговый комплекс &quot;AST&quot;, 3-й этаж </p>
       </td><td width="40%" style="padding-left: 20px;" valign="top"> 	
        <p><b>Режим работы:</b>
          <br />
        Ежедневно с 10 до 22 часов
          <br />
        без перерывов на обед и без выходных</p>
       </td></tr>
		<tr>
			<td><b>Телефон:</b><br/>+7 (925) 069-39-52 (ТОЛЬКО РОЗНИЦА)</td>
			<td></td>
	  	</tr>
   </tbody>
</table>
 
<p><i>Любые вопросы по наличию товара вы можете задать продавцу-консультанту по e-mail - 
<script type="text/javascript">eval(unescape('%64%6f%63%75%6d%65%6e%74%2e%77%72%69%74%65%28%27%3c%61%20%68%72%65%66%3d%22%6d%61%69%6c%74%6f%3a%73%68%6f%70%40%6e%65%77%76%61%79%2e%72%75%22%3e%73%68%6f%70%40%6e%65%77%76%61%79%2e%72%75%3c%2f%61%3e%27%29%3b'))</script>
</i></p>
 
<div style="background-image: url(http://www.newvay.ru/upload/shop_rozn.jpg); width: 100%; height: 380px; background-position: 50% 50%; background-repeat: no-repeat no-repeat;"></div>
<p><b>Схема проезда:</b></p>
<div class="magazin_map">
 <?$APPLICATION->IncludeComponent("bitrix:map.yandex.view", ".default", array(
	"INIT_MAP_TYPE" => "MAP",
	"MAP_DATA" => "a:5:{s:10:\"yandex_lat\";d:55.78909252301509;s:10:\"yandex_lon\";d:37.74785400383794;s:12:\"yandex_scale\";i:15;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:37.7523171996387;s:3:\"LAT\";d:55.78946731373955;s:4:\"TEXT\";s:64:\"\"NEWVAY\", Торговый комплекс \"AST\", 3-й этаж\";}}s:9:\"POLYLINES\";a:0:{}}",
	"MAP_WIDTH" => "640",
	"MAP_HEIGHT" => "350",
	"CONTROLS" => array(
		0 => "ZOOM",
		1 => "SMALLZOOM",
		2 => "TYPECONTROL",
	),
	"OPTIONS" => array(
		0 => "ENABLE_DRAGGING",
	),
	"MAP_ID" => ""
	),
	false
);?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>