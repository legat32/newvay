<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if (!empty($arResult["ORDER"]))
{
	?>
	<?if (isset($arResult["ORDER_2"])):?>
	<p><i>ВНИМАНИЕ! Для ускорения обработки Вашего заказа он был разделен на два - по женскому и детскому ассортименту отдельно.</i></p> 
	<?endif?>
	<h3><?=isset($arResult["ORDER_2"]) ? "ЖЕНСКИЙ АССОРТИМЕНТ" : GetMessage("SOA_TEMPL_ORDER_COMPLETE")?></h3>
	<table class="sale_order_full_table">
		<tr>
			<td>
				<?= GetMessage("SOA_TEMPL_ORDER_SUC", Array("#ORDER_DATE#" => $arResult["ORDER"]["DATE_INSERT"], "#ORDER_ID#" => $arResult["ORDER"]["ACCOUNT_NUMBER"]))?>
			</td>
		</tr>
	</table>
	
	
	<?
	if (!empty($arResult["PAY_SYSTEM"]))
	{
		?>
		<!--
		<br />

		<table class="sale_order_full_table">
			<tr>
				<td class="ps_logo">
					<div class="pay_name"><?=GetMessage("SOA_TEMPL_PAY")?></div>
					<?=CFile::ShowImage($arResult["PAY_SYSTEM"]["LOGOTIP"], 100, 100, "border=0", "", false);?>
					<div class="paysystem_name"><i><?= $arResult["PAY_SYSTEM"]["NAME"] ?></i></div><br>
				</td>
			</tr>
			<?
			/*
			if (strlen($arResult["PAY_SYSTEM"]["ACTION_FILE"]) > 0)
			{
				?>
				<tr>
					<td>
					
					<? if($arResult["ORDER"]["STATUS_ID"] == "N" ): ?>
						<span><b>Оплата возможна только после подтверждения заказа менеджером</b></span>
					<? else:?>
						<?= GetMessage("SOA_TEMPL_PAY_LINK", Array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".$arResult["ORDER_BUSKET"]["ORDER_ID"])) ?>
					<?endif?>
					
					</td>
				</tr>
				<?
			}
			*/
			?>
		</table>
		-->
		<?
	}
}
else
{
	?>
	<b><?=GetMessage("SOA_TEMPL_ERROR_ORDER")?></b><br /><br />

	<table class="sale_order_full_table">
		<tr>
			<td>
				<?=GetMessage("SOA_TEMPL_ERROR_ORDER_LOST", Array("#ORDER_ID#" => $arResult["ORDER_ID"]))?>
				<?=GetMessage("SOA_TEMPL_ERROR_ORDER_LOST1")?>
			</td>
		</tr>
	</table>
	<?
}





?>




<?

if (isset($arResult["ORDER_2"]))
{
	?>
	<h3>ДЕТСКИЙ АССОРТИМЕНТ</h3>
	<table class="sale_order_full_table">
		<tr>
			<td>
				<?= GetMessage("SOA_TEMPL_ORDER_SUC", Array("#ORDER_DATE#" => $arResult["ORDER_2"]["DATE_INSERT"], "#ORDER_ID#" => $arResult["ORDER_2"]["ID"]))?>
			</td>
		</tr>
	</table>
	
	
	<?
	if (!empty($arResult["PAY_SYSTEM_2"]))
	{
		?>
		<!--<br />

		<table class="sale_order_full_table">
			<tr>
				<td class="ps_logo">
					<div class="pay_name"><?=GetMessage("SOA_TEMPL_PAY")?></div>
					<?=CFile::ShowImage($arResult["PAY_SYSTEM_2"]["LOGOTIP"], 100, 100, "border=0", "", false);?>
					<div class="paysystem_name"><i><?= $arResult["PAY_SYSTEM_2"]["NAME"] ?></i></div><br>
				</td>
			</tr>
			<?
			/*
			if (strlen($arResult["PAY_SYSTEM_2"]["ACTION_FILE"]) > 0)
			{
				?>
				<tr>
					<td>
					
					<? if($arResult["ORDER_2"]["STATUS_ID"] == "N" ): ?>
						<span><b>Оплата возможна только после подтверждения заказа менеджером</b></span>
					<? else:?>
						<?= GetMessage("SOA_TEMPL_PAY_LINK", Array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".$arResult["ORDER_BUSKET"]["ORDER_ID"])) ?>
					<?endif?>
					
					</td>
				</tr>
				<?
			}
			*/
			?>
		</table>
		-->
		<?
	}
}


?>
<h4><?=GetMessage("SOA_TEMPL_PAY")?></h4>
<p><STRONG>ВНИМАНИЕ!</STRONG></p>
<p><?=GetMessage("SOA_TEMPL_ORDER_SUC2")?></p>

<p><?= GetMessage("SOA_TEMPL_ORDER_SUC1", Array("#LINK#" => "/personal/orders.html?filter_history=Y")) ?></p>

<?
//prn($arResult);

?>