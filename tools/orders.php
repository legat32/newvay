<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
// все заказы
CModule::IncludeModule("sale");
$dbOrder = CSaleOrder::GetList(Array("ID" => "ASC"), Array(), false, false, Array("ID", "DATE_INSERT", "PRICE", "DELIVERY_ID", "PRICE_DELIVERY", "PAY_SYSTEM_ID", "USER_ID"));
$arOrders = Array();
$arDelUsers = Array(1,68);
while ($arOrder = $dbOrder->Fetch())
{
	if(in_array($arOrder["USER_ID"], $arDelUsers)) continue;  // уберем Admin и еще других ненужныйх юзеров
	$t = explode(" ", $arOrder["DATE_INSERT"]);
	$arOrders[$t[0]][] = $arOrder;
	$arOrders[$t[0]]["daySumm"] += $arOrder["PRICE"]; 
}
//prn($arOrders);


// Сформируем строку для выдачи за месяц
$month = strVal($_GET["month"]); // формат требуемый 06.2016
$ar = "";
$str = "";
foreach($arOrders as $date => $arDayOrders)
{
	$t = substr($date, 3);
	if($t == $month) 
		$ar[] = '{"label": "'.$date.'", "value": "'.count($arOrders[$date]).'", "title":"111111"}';
}
$str = implode(",", $ar);
?>


<script type="text/javascript" src="fusioncharts.js"></script>
<script type="text/javascript" src="fusioncharts.theme.fint.js"></script>
<script type="text/javascript">
  FusionCharts.ready(function(){
    var revenueChart = new FusionCharts({
        "type": "column2d",
        "renderAt": "chartContainer",
        "width": "92%",
        "height": "90%",
        "dataFormat": "json",
        "dataSource":  {
          "chart": {
            "caption": "Отчет по количеству заказов <?=$_SERVER["HTTP_HOST"]?>",
            "subCaption": "Месяц - <?=$month?>",
            "xAxisName": "Дата",
            "yAxisName": "Количество заказов",
            "theme": "fint"
         },
         "data": [
            <?=$str?>
          ]
      }

  });
revenueChart.render();
})
</script>
<div id="chartContainer">FusionCharts XT will load here!</div>
