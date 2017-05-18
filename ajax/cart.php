<?
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS",true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if(strVal(htmlspecialcharsbx($_GET["action"])) == "refresh") {
	echo "Обновили корзину";
	}

if(strVal(htmlspecialcharsbx($_GET["action"])) == "add") {
	?>
	Товар <?=htmlspecialcharsbx($_REQUEST["ID"])?> добавлен к корзину<br/>
	<?
	}
?>
