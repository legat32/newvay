<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?
CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");
CModule::IncludeModule("iblock");




$ORDER_ID = intVal($_REQUEST["ORDER_ID"]);


if(intVal($_REQUEST["ORDER_ID"]) > 0 )
{

	// подготовим массив данных существующего заказа для создания нового
	$arFilter = Array(
	   "ORDER_ID" => $ORDER_ID
	   );
	$arSales = CSaleOrder::GetByID($ORDER_ID);
	unset($arSales["ID"]);
	$arSales["ACCOUNT_NUMBER"] = "";
	
	


	// Добавляем новый заказ
	$NEW_ORDER_ID = CSaleOrder::Add($arSales);
	echo "NEW_ORDER_ID = ".$NEW_ORDER_ID;
	
	
	
	
	
	// Обновим дату создания
	$d = $arSales["DATE_INSERT"];
	$t1 = explode(" ", $d);
	$t2 = explode("-", $t1[0]);
	$year = $t2[0];
	$month = $t2[1];
	$day = $t2[2];
	$DATE_INSERT = $day.".".$month.".".$year." ".trim($t1[1]);
	CSaleOrder::Update($NEW_ORDER_ID, Array("DATE_INSERT" => $DATE_INSERT));
	




	// Переносим совйства заказа
	$arProps = Array();
	$db_vals = CSaleOrderPropsValue::GetList(
		array("SORT" => "ASC"),
		array("ORDER_ID" => $ORDER_ID)
		);
	while($arVals = $db_vals->Fetch()) 
	{
		prn($arVals);
		$arProps[] = $arVals["ID"];
	}	
	prn($arProps);

	foreach($arProps as $id)
	{
		CSaleOrderPropsValue::Update($id, array("ORDER_ID" => $NEW_ORDER_ID));
	}






	// Переносим товары корзины

	$arItems = Array();
	$dbBasket = CSaleBasket::GetList(
		array("NAME" => "ASC"),
		array("ORDER_ID" => $ORDER_ID)
		);
	//$basketSum = 0;
	while ($arBasket = $dbBasket->Fetch())
	{
		//$arFields = Array();	
		$arItems[] = $arBasket["ID"];
		prn($arBasket);
	}
	foreach($arItems as $id)
	{
		CSaleBasket::Update($id, array("ORDER_ID" => $NEW_ORDER_ID));
	}
	
	
	
}

else 
{
	echo "Не указан номер заказа ?ORDER_ID=2000";
}


?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>