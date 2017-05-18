<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Отписаться от подписки");
?>


<?

	if(isset($_REQUEST["btnSubmit"]))
	{
		$email = strVal($_REQUEST["valu"]);
		if((strLen($email) > 0) && (strpos($email, "@") > 0) )
		{
			$filter = Array("LOGIN_EQUAL" => $email); 
			$ID = 0;
			$MAILING = "";
			$GROUPS = Array();
			$dbUsers = CUser::GetList(($by="LOGIN"), ($order="asc"), $filter, Array("SELECT" => Array("UF_MAILING"))); 
			while($arUser = $dbUsers->Fetch())
			{
				$ID = $arUser["ID"];
				$MAILING = $arUser["UF_MAILING"];
			}
			if($ID>0)
			{
				$GROUPS = CUser::GetUserGroup($ID);
			}
			if(($ID > 0)&&($MAILING > 0))
			{
				$oUser = new CUser;
				$arFields = array('UF_MAILING' => '');
				$oUser->Update($ID, $arFields);
				
				$gr = array_flip($GROUPS);
				unset($gr[13]);  // убираем из группы подписчиков
				$GROUPS = array_keys($gr);
				CUser::SetUserGroup($ID, $GROUPS);
				
				//prn($oUser->LAST_ERROR);
				echo "<br><b>Указанный e-mail отписан от рассылки.</b>";
			}
			else 
				echo "<br><b>Указанный e-mail не состоит в группе рассылки.</b>";
		}
		else
			echo "<br><b>Неверное указан e-mail</b>";
	}
?>



<?if(!isset($_REQUEST["btnSubmit"])):?>
	<p>Введите свой e-mail для того, чтобы быстро отписаться от рассылки</p>
	<form>
		<input type="text" name="valu" value="">
		<br>
		<input type="submit" name="btnSubmit">
	</form>
<?endif?>
<p><i>* Подписаться на рассылку новостей об акциях Вы можете в <a href='/personal/'>личном кабинете</a> сайта</i></p>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>