<?
//die("newvay.ru");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Трикотаж оптом от производителя. Женский и детский трикотаж российского производства - Фемина-Трейд");
$APPLICATION->SetPageProperty("keywords", "Трикотаж российского производства оптом от Кимрской трикотажной фабрики. Детский и женский трикотаж оптом от производителя на заказ");
$APPLICATION->SetPageProperty("description", "Трикотаж российского производства оптом от Кимрской трикотажной фабрики. Детский и женский трикотаж оптом от производителя на заказ");
?> 

<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"front-slider", 
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
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "DETAIL_PICTURE",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "16",
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
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);
	?>
	
	
	
	<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "catalog-root-home", Array(
	"IBLOCK_TYPE" => "1c_catalog",	// Тип инфоблока
		"IBLOCK_ID" => "6",	// Инфоблок
		"SECTION_ID" => "",	// ID раздела
		"SECTION_CODE" => "",	// Код раздела
		"COUNT_ELEMENTS" => "Y",	// Показывать количество элементов в разделе
		"TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
		"SECTION_FIELDS" => array(	// Поля разделов
			0 => "",
			1 => "",
		),
		"SECTION_USER_FIELDS" => array(	// Свойства разделов
			0 => "UF_COLLECTION_COLOR",
			1 => "",
		),
		"SECTION_URL" => "/#SECTION_CODE_PATH#/",	// URL, ведущий на страницу с содержимым раздела
		"CACHE_TYPE" => "N",	// Тип кеширования
		"CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"CACHE_GROUPS" => "N",	// Учитывать права доступа
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"COMPONENT_TEMPLATE" => "catalog-root"
	),
	false
);?>




<h1>Трикотаж оптом от производителя в Москве</h1>
<p>Компания «Фемина Трейд» — российский производитель вязаных и швейных изделий для детей и взрослых.</p>
<p>Основа компании — фабрика «Меланж», созданная на базе одного из крупнейших советских предприятий легкой промышленности «Кимрский льнотрикотаж».</p>
<p>Мы сотрудничаем с юридическими (ООО, ИП) и физлицами:</p>
<ul>
<li>торговыми сетями;</li>
<li>владельцами магазинов и точек в ТЦ;</li>
<li>розничными интернет-магазинами;</li>
</ul>
<p>Приобретая российский трикотаж оптом от производителя напрямую, без посредников, вы:</p>
<ul>
<li>уменьшаете себестоимость товара и увеличиваете прибыль;</li>
<li>ускоряете формирование и пополнение ассортимента вашего магазина;</li>
<li>не зависите от курса валют, таможенных пошлин и санкций.</li>
</ul>
<p>Географических ограничений нет — заказать трикотаж оптом в Москве можно из любой точки РФ.</p>
<p>Минимальная сумма заказа — 15 000 рублей.</p>

<h2>Российский трикотаж оптом: наш ассортимент</h2>
<p>Предлагая российский трикотаж оптом, мы составляем каталог с учетом разноплановых интересов конечного потребителя. Каждый сезон выпускаем более 250 вязаных моделей, дополняем их швейными изделиями и аксессуарами. Вязаные шапки, шарфы, снуды, варежки, митенки, гетры — отличные дополнения к одежному ассортименту вашего магазина.</p>
<p>В продаже: летняя одежда (топы, сарафаны, футболки, шорты) и демисезонная (свитера, джемперы, блузы, пуловеры, платья, жилеты, брюки, болеро и пр.). Также можно приобрести верхний трикотаж оптом (вязаные пальто, кардиганы, теплые жакеты).</p>
<p>Для производства используется только высококаче­ственная пряжа и полотно с большим содержанием натуральных волокон (шерсть, хлопок, вискоза).</p>
<p>Наши торговые марки</p>
<p><strong>VAY</strong> — повседневные модели в стиле casual женские и мужские: вязаные жилеты, жакеты, кардиганы, джем­перы, платья, костюмы. А также швейные изделия из трикотажного полотна: топы, блузы, футболки, юбки, платья и сарафаны. Ряды размеров — 42–62.</p>
<p><strong>VAY-KIDS</strong> — вязаный трикотаж для детей 7–14 лет:</p>
<ul>
<li>школьная форма — платья, сарафаны, джемперы, жилеты, кардиганы, джемперы из хлопковой или полушерстяной пряжи (30–50 размеры);</li>
<li>повседневные модели 30–44 размеров.</li>
</ul>
<p><strong>«Веснушки»</strong> — вязаная одежда для девочек и мальчиков 2–7 лет (рост от 92 до 122 см).</p>
<p>Новинка среди предложений компании «Фемина Трейд» — линейка одежды для всей семьи <strong>FAMILY LOOK</strong>, модели одинакового дизайна.</p>

<a id="why-us"></a>
<h2>Почему стоит заказывать трикотаж именно у нас?</h2>


<table>
<tbody>
	<tr style="height: 140px;">

		<td style="width: 10%;"><img style="width: 100%;"  src="/upload/icon/icon_advantages_1.png"></td>
		<td style="padding: 5px; width: 26%;">Вы можете выбрать удобную форму заказа:со свободного склада, предзаказ или индивидуальный заказ</td>
		<td style="width: 10%;"><img style="width: 100%;" src="/upload/icon/icon_advantages_2.png"></td>
		<td style="padding: 5px; width: 22%;">Заказать трикотаж можно не размерными рядами, а выборочно.</td>
		<td style="width: 10%;"><img style="width: 100%;"  src="/upload/icon/icon_advantages_3.png"></td>
		<td style="padding: 5px; width: 22%;">Качество трикотажа соответствует строгим отечественным стандартам, что подтверждено сертификатами соответствия.</td>
	</tr>
	<tr style="height: 140px;">
		<td style="width: 10%;"><img style="width: 100%;"  src="/upload/icon/icon_advantages_4.png"></td>
		<td style="padding: 5px;">Интернет-магазин — собственный торговый дом фабрики, позваляет закупать дешевый трикотаж оптом, пользоваться скидками и оперативно оформлять заказы онлайн.</td>
		<td style="width: 10%;"><img style="width: 100%;" src="/upload/icon/icon_advantages_5.png"></td>
		<td style="padding: 5px;">Подразделения компании (демонстрационный зал, офис, склад, автопарк) расположены на общей территории.</td>
		<td style="width: 10%;"><img style="width: 100%;"  src="/upload/icon/icon_advantages_6.png"></td>
		<td style="padding: 5px;">Резервирование товара на 5 дней с момента выставления счета.</td>
	</tr>
	<tr style="height: 140px;">
		<td style="width: 10%;"><img style="width: 100%;"  src="/upload/icon/icon_advantages_7.png"></td>
		<td style="padding: 5px;">Отгрузка не позднее чем на третий рабочий день после оплаты на р/с либо в кассу.</td>
		<td style="width: 10%;"><img style="width: 100%;" src="/upload/icon/icon_advantages_8.png"></td>
		<td style="padding: 5px;">Доставка или самовывоз — на ваш выбор.</td>
		<td style="width: 10%;"><img style="width: 100%;"  src="/upload/icon/icon_advantages_9.png"></td>
		<td style="padding: 5px;">Пакет документов заказчика минимален.</td>
	</tr>
</tbody>
</table>


<h2>Хотите купить трикотаж оптом — действуйте!</h2>
<p>Купить трикотаж оптом в Москве в компании «Фемина Трейд» — значит поддержать отечественного производителя и обеспечить выгодное развитие собственному бизнесу.</p>
<br>	


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>