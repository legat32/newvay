<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<br/>
<form method="GET" action="<?= $arResult["CURRENT_PAGE"] ?>" name="bfilter">
<?if(strlen($arResult["NAV_STRING"]) > 0):?>
	<p><?=$arResult["NAV_STRING"]?></p>
<?endif?>
<table class="sale-personal-order-list data-table">
	<tr>
		<th><?=GetMessage("SPOL_T_ID")?><br /><?=SortingEx("ID")?></th>
		<th><?=GetMessage("SPOL_T_PRICE")?><br /><?=SortingEx("PRICE")?></th>
		<?/*?><th><?=GetMessage("SPOL_T_STATUS")?><br /><?=SortingEx("STATUS_ID")?></th><?*/?>
		<th><?=GetMessage("SPOL_T_BASKET")?><br /></th>
		<?/*?>
		<th><?=GetMessage("SPOL_T_PAYED")?><br /><?=SortingEx("PAYED")?></th>
		<th><?=GetMessage("SPOL_T_CANCELED")?><br /><?=SortingEx("CANCELED")?></th>
		<?*/?>
	</tr>
	<?foreach($arResult["ORDERS"] as $val):?>
		<tr>
			<td><b><?=$val["ORDER"]["ACCOUNT_NUMBER"]?></b><br /><?=GetMessage("SPOL_T_FROM")?> <?=$val["ORDER"]["DATE_INSERT_FORMAT"]?></td>
			<td><?=$val["ORDER"]["FORMATED_PRICE"]?></td>
			<?/*?><td><?=$arResult["INFO"]["STATUS"][$val["ORDER"]["STATUS_ID"]]["NAME"]?><br /><?=$val["ORDER"]["DATE_STATUS"]?></td><?*/?>
			<td><?
				foreach($val["BASKET_ITEMS"] as $vval)
				{
					?><li><?
					if (strlen($vval["DETAIL_PAGE_URL"])>0)
						echo '<a href="'.$vval["DETAIL_PAGE_URL"].'">';
					echo $vval["NAME"];
					if (strlen($vval["DETAIL_PAGE_URL"])>0)
						echo '</a>';
						echo ' - '.$vval["QUANTITY"].' '.GetMessage("STPOL_SHT");
					?></li><?
				}
			?></td>
			<?/*?>
			<td><?=(($val["ORDER"]["PAYED"]=="Y") ? GetMessage("SPOL_T_YES") : GetMessage("SPOL_T_NO"))?></td>
			<td><?=(($val["ORDER"]["CANCELED"]=="Y") ? GetMessage("SPOL_T_YES") : GetMessage("SPOL_T_NO"))?></td>
			<?*/?>
		</tr>
	<?endforeach;?>
</table>
<?if(strlen($arResult["NAV_STRING"]) > 0):?>
	<p><?=$arResult["NAV_STRING"]?></p>
<?endif?>