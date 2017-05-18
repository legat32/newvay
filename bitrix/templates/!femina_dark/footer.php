						<br/><br/>
					</div><!-- #content_wrapper-->
                </div><!-- #content-->
		 </div><!-- #container-->
	</div><!-- #middle-->
<!-- #wrapper -->

<div id="footer1">
	<div id="footer2">
	
	<?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		Array(
			"AREA_FILE_SHOW" => "file",
			"PATH" => "/include/old_footer1.php",
			"EDIT_TEMPLATE" => ""
		),
	false
	);?>
	
	<?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		Array(
			"AREA_FILE_SHOW" => "file",
			"PATH" => "/include/old_footer2.php",
			"EDIT_TEMPLATE" => ""
		),
	false
	);?>
	
	</div>
</div>
<!-- #footer -->

<div id="fpanel">
    <table style="margin-top:5px;">
    <tbody><tr><td><a href="https://www.facebook.com/sogrevay.ru/" target="_blank" title="Facebook" rel="nofollow"><img width="32" height="32" src="/assets/images/social/facebook.png" alt="Facebook" /></a></td></tr>
    <tr><td><a href="http://vk.com/feminatrade" rel="nofollow" target="_blank" title="ВКонтакте"><img width="32" height="32" src="/assets/images/social/vkontakte.png" alt="Вконтакте" /></a></td></tr>
    <tr><td><a href="https://twitter.com/sogrevay_ru" rel="nofollow" target="_blank" title="Twitter"><img width="32" height="32" alt="Твиттер" src="/assets/images/social/twitter.png" /></a></td></tr>
    <tr><td><a href="http://www.odnoklassniki.ru/group/50991050588342" rel="nofollow" target="_blank" title="Одноклассники"><img width="32" height="32" alt="Одноклассники" src="/assets/images/social/odnoklassniki.png" /></a></td></tr>
    </tbody></table>
</div>

<?
/*
if(!$USER->isAdmin())
{
	$APPLICATION->ShowHeadStrings();
	$APPLICATION->ShowHeadScripts();
}
*/
?>	


<?if(!$USER->isAuthorized()):?>
<script type="text/javascript">
	$(".head_ask").on("click", function() {
		$.fancybox.open([
			{
				href : '/forms/ask.php?blank=Y&amp;model=Общий вопрос',
				type : 'iframe',
				autoSize: true,
				maxWidth: '500px'
			}
		]);
		return false;
		});
</script>
<?endif?>

<!-- Sliza.ru - Widget -->
<script type="text/javascript" src="https://sliza.ru/widget.php?id=1903&h=b1c928923d5e457fd109ba80efff868e&t=s" async defer></script>
<!-- /// -->

</body>
</html>