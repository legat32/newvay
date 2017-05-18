<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?
if(isset($_GET["btnSubmit"]))
{
	
	$mail = strVal($_GET["mail"]);
	//prn($mail);
	$dbUser = CUser::GetByLogin($mail);
	if($arUser = $dbUser->Fetch())
	{
		echo "<p><b>Ваш e-mail отписан от рассылки.</b></p>";
		//prn("Ок");
		//prn($arUser);
		/*
		$USER_ID = $arUser["ID"];
		
		
		$user = new CUser;
		$fields = Array( 
		"UF_SHOP" => "", 
		); 
		$user->Update($ID, $fields);
		*/
	}
	//else 
	//{
	//	CHTTP::SetStatus("404 Not Found");
	//}
	
}
?>


<?if(!isset($_GET["btnSubmit"])):?>
<p>Для того, чтобы отписать e-mail [<?=strVal($_GET["mail"])?>] от рассылки писем от ООО "Фемина Трейд" нажмите кнопку "Отписаться".</p>
<form action="/unsubscribe.html" method="get">
	<input type="hidden" name="mail" value="<?=strVal($_GET["mail"])?>">
	<input type="submit" name="btnSubmit" value="Отписаться">
</form>
<?endif?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>