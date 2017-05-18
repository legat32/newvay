<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>



<?
$arBasketItems = array();

$dbBasketItems = CSaleBasket::GetList(
	array(),
	array(
			"FUSER_ID" => CSaleBasket::GetBasketUserID(),
			"LID" => SITE_ID,
			"ORDER_ID" => "NULL"
		),
	false,
	false,
	array("ID", "QUANTITY")
    );
	
$totalCount = 0;
while ($arItems = $dbBasketItems->Fetch())
{
	$totalCount += $arItems["QUANTITY"];
}


?>

<?//prn($arResult)?>
<?if((defined("DEALER_USER"))&&($totalCount < 10)):?>
	<p class="note">Для оформления заказа необходимо, чтобы в корзине суммарно было не менее 10 единиц товара</p>
<?endif?>


<?
if (StrLen($arResult["ERROR_MESSAGE"])<=0)
{
	if(is_array($arResult["WARNING_MESSAGE"]) && !empty($arResult["WARNING_MESSAGE"]))
	{
		foreach($arResult["WARNING_MESSAGE"] as $v)
		{
			echo ShowError($v);
		}
	}
	?>
	<form method="post" action="<?=POST_FORM_ACTION_URI?>" name="basket_form">
		<?
		if ($arResult["ShowReady"]=="Y")
		{
			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/basket_items.php");
		}

		if ($arResult["ShowDelay"]=="Y")
		{
			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/basket_items_delay.php");
		}

		if ($arResult["ShowNotAvail"]=="Y")
		{
			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/basket_items_notavail.php");
		}

		if ($arResult["ShowSubscribe"] == "Y")
		{
			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/basket_items_subscribe.php");
		}

		?>
	</form>
	<?
}
else
	ShowError($arResult["ERROR_MESSAGE"]);
?>