</div>
</main>
<br><br>
<footer>
    <div class="footer-wrap">
        <div class="footer-menu">
            <?$APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        Array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => "/include/footer1.php",
            "EDIT_TEMPLATE" => ""
        ),
    false
    );?>
        </div>
        <div class="footer-logo">
            <div class="form-wrap">
               
                    <?$APPLICATION->IncludeComponent(
	"bitrix:search.title", 
	"template1", 
	array(
		"NUM_CATEGORIES" => "1",
		"TOP_COUNT" => "5",
		"ORDER" => "date",
		"USE_LANGUAGE_GUESS" => "Y",
		"CHECK_DATES" => "N",
		"SHOW_OTHERS" => "N",
		"PAGE" => "#SITE_DIR#search/",
		"CATEGORY_0_TITLE" => "",
		"CATEGORY_0" => array(
			0 => "iblock_1c_catalog",
		),
		"CATEGORY_0_iblock_1c_catalog" => array(
			0 => "6",
		),
		"SHOW_INPUT" => "Y",
		"INPUT_ID" => "title-search-input",
		"CONTAINER_ID" => "title-search",
		"COMPONENT_TEMPLATE" => "template1"
	),
	false
);?>
            </div>
            <div class="logo"><a href="/"><img src="<?=SITE_TEMPLATE_PATH?>/images/footer-logo.png"></a></div>
        </div>
        <div class="footer-contact">
           <?$APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        Array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => "/include/footer2.php",
            "EDIT_TEMPLATE" => ""
        ),
    false
    );?>
        </div>
    </div>
</footer>

<!-- Sliza.ru - Widget -->
<??><script type="text/javascript" src="https://sliza.ru/widget.php?id=1903&h=b1c928923d5e457fd109ba80efff868e&t=s" async defer></script> <??>
<!-- /// -->

</body>
</html>