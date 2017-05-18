<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$bDemo = (CTicket::IsDemo()) ? "Y" : "N";
$bAdmin = (CTicket::IsAdmin()) ? "Y" : "N";
$bSupportTeam = (CTicket::IsSupportTeam()) ? "Y" : "N";
$bADS = $bDemo == 'Y' || $bAdmin == 'Y' || $bSupportTeam == 'Y';

?>

<form method="post" action="<?=$arResult["NEW_TICKET_PAGE"]?>">
	<input type="submit" name="add" value="<?=GetMessage("SUP_ASK")?>">
</form>

<br />

<?if (strlen($arResult["NAV_STRING"]) > 0):?>
	<?=$arResult["NAV_STRING"]?><br /><br />
<?endif?>

<table cellspacing="0" class="support-ticket-list data-table">
	
	<tr>
		<th>
			<?=GetMessage("SUP_ID")?><?=SortingEx("s_id")?><br />
			<?=GetMessage("SUP_LAMP")?><?=SortingEx("s_lamp")?><br />
		</th>
		<th>
			<?=GetMessage("SUP_TITLE")?>
		</th>
		<th>
			<?=GetMessage("SUP_TIMESTAMP")?><?=SortingEx("s_timestamp")?><br />
			<?=GetMessage("SUP_MODIFIED_BY")?><br />
		</th>
		<th>
			<?=GetMessage("SUP_MESSAGES")?>
		</th>
		<th>
			<?=GetMessage("SUP_STATUS")?><br />
		</th>
		
		<?
		$ColAdd = 0;
		if( isset( $arParams["SET_SHOW_USER_FIELD_T"] ) )
		{
			foreach( $arParams["SET_SHOW_USER_FIELD_T"] as $k => $v )
			{
				echo "<th>" . htmlspecialcharsbx( $v["NAME_C"] ) . "<br /></th>";
				$ColAdd++;
			}
		}
		?>
		
	</tr>

	<?foreach ($arResult["TICKETS"] as $arTicket):?>
	<tr>
		
		<td width="10%" align="center">
			<?=$arTicket["ID"]?><br />
			<div class="support-lamp-<?=str_replace("_","-",$arTicket["LAMP"])?>" title="<?=GetMessage("SUP_".strtoupper($arTicket["LAMP"]).($bADS ? "_ALT_SUP" : "_ALT"))?>"></div>
			[&nbsp;<a href="<?=$arTicket["TICKET_EDIT_URL"]?>" title="<?=GetMessage("SUP_EDIT_TICKET")?>"><?=GetMessage("SUP_EDIT")?></a>&nbsp;]
		</td>

		
		<td>
			<a href="<?=$arTicket["TICKET_EDIT_URL"]?>" title="<?=GetMessage("SUP_VIEW_TICKET")?>"><?=$arTicket["TITLE"]?></a>
		</td>

		<td>
			<?=FormatDate($DB->DateFormatToPHP(CSite::GetDateFormat('FULL')), MakeTimeStamp($arTicket["TIMESTAMP_X"]))?><br />

			<?if (strlen($arTicket["MODIFIED_MODULE_NAME"])<=0 || $arTicket["MODIFIED_MODULE_NAME"]=="support"):?>
				[<?=$arTicket["MODIFIED_USER_ID"]?>] (<?=$arTicket["MODIFIED_LOGIN"]?>) <?=$arTicket["MODIFIED_NAME"]?>
			<?else:?>
				<?=$arTicket["MODIFIED_MODULE_NAME"]?>
			<?endif?>

		</td>

		<td>
			<?=$arTicket["MESSAGES"]?>
		</td>

		
		<td>

		<?if (strlen($arTicket["STATUS_NAME"])>0):?>
			<?=$arTicket["STATUS_NAME"]?>
		<? endif; ?>
		
		</td>
		
		<?
		if( isset( $arParams["SET_SHOW_USER_FIELD_T"] ) )
		{
			foreach( $arParams["SET_SHOW_USER_FIELD_T"] as $k => $v )
			{
				echo "<td>" . htmlspecialcharsbx( $arTicket[$k] ) . "</td>";
			}
		}
		?>
		
	</tr>
	<?endforeach?>


	
	<tr>
		<th colspan="<? echo (5 + $ColAdd ) ; ?>"><?=GetMessage("SUP_TOTAL")?>: <?=$arResult["TICKETS_COUNT"]?></th>
	</tr>
</table>

<?if (strlen($arResult["NAV_STRING"]) > 0):?>
	<br /><?=$arResult["NAV_STRING"]?><br />
<?endif?>

<br />
<table class="support-ticket-hint">
	<tr>
		<td><div class="support-lamp-red"></div></td>
		<td> - <?=$bADS ? GetMessage("SUP_RED_ALT_SUP") : GetMessage("SUP_RED_ALT_2")?></td>
	</tr>
	<?if ($bADS):?>
	<tr>
		<td><div class="support-lamp-yellow"></div></td>
		<td> - <?=GetMessage("SUP_YELLOW_ALT_SUP")?></td>
	</tr>
	<?endif;?>
	<tr>
		<td><div class="support-lamp-green"></div></td>
		<td> - <?=GetMessage("SUP_GREEN_ALT")?></td>
	</tr>
	<?if ($bADS):?>
	<tr>
		<td><div class="support-lamp-green-s"></div></td>
		<td> - <?=GetMessage("SUP_GREEN_S_ALT_SUP")?></td>
	</tr>
	<?endif;?>
	<tr>
		<td><div class="support-lamp-grey"></div></td>
		<td> - <?=GetMessage("SUP_GREY_ALT")?></td>
	</tr>
</table>