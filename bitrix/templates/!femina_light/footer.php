<br/><br/>
</div><!-- #content-->
		</div><!-- #container-->

		
			
		
                <div class="sidebar" id="sideLeft">
				
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => "/include/akciya.php",
						"EDIT_TEMPLATE" => ""
					),
				false
				);?>
				
				<?//if($USER->isAdmin()):?>
					 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"aside", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "18",
		"IBLOCK_TYPE" => "news",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "LINK",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"COMPONENT_TEMPLATE" => "aside"
	),
	false
);?>
				<?//endif?>				
				
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => "/include/leftside.php",
						"EDIT_TEMPLATE" => ""
					),
				false
				);?>
				</div><!-- .sidebar#sideLeft -->

	</div><!-- #middle-->
</div><!-- #wrapper -->

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
<div class="to-top">
	<span>Вверх</span>
</div>
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



<!-- Sliza.ru - Widget -->
<??><script type="text/javascript" src="https://sliza.ru/widget.php?id=1903&h=b1c928923d5e457fd109ba80efff868e&t=s" async defer></script> <??>
<!-- /// -->


<?/*?>
	<script src="//bestsp.ru/embed/widget.js" data-bestsp-widget></script>
	<script>
	BestSpWidget.params = {
		position: "right",
		color: "#d12529",
		autoExpand: "on",
		expandDelay: "60"
	}
	</script>
<?*/?>




</body>
</html>