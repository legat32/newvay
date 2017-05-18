<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
$arMenuItems = Array(
	
	Array(
		"TEXT" => "Главная",
        "LINK" => "/",
		"SELECTED" => "",
		"DEPTH_LEVEL" => 1,
		"IS_PARENT" => ""
	),

	Array(
		"TEXT" => "О компании",
        "LINK" => "/o-kompanii/",
		"SELECTED" => "",
		"DEPTH_LEVEL" => 1,
		"IS_PARENT" => 1
	),

			Array(
				"TEXT" => "О производстве",
				"LINK" => "/o-kompanii/o-proizvodstve.html",
				"SELECTED" => "",
				"DEPTH_LEVEL" => 2,
				"IS_PARENT" => ""
			),
				
			Array(
				"TEXT" => "Новости",
				"LINK" => "/o-kompanii/novosti/",
				"SELECTED" => "",
				"DEPTH_LEVEL" => 2,
				"IS_PARENT" => ""
			),

			Array(
				"TEXT" => "Вакансии",
				"LINK" => "/o-kompanii/vakansii.html",
				"SELECTED" => "",
				"DEPTH_LEVEL" => 2,
				"IS_PARENT" => ""
			),				
				
	Array(
		"TEXT" => "Каталог",
        "LINK" => "/catalog/",
		"SELECTED" => "",
		"DEPTH_LEVEL" => 1,
		"IS_PARENT" => 1
	),
		
			Array(
				"ID" => 209,
				"TEXT" => "Женский",
				"LINK" => "/vay/",
				"SELECTED" => "",
				"DEPTH_LEVEL" => 2,
				"IS_PARENT" => 1
			),
					Array(
						"ID" => 301,
						"TEXT" => "Вязаный трикотаж",
						"LINK" => "/vay/vyazanyy-trikotazh/",
						"SELECTED" => "",
						"DEPTH_LEVEL" => 3,
						"IS_PARENT" => 1
					),
						Array(
							"ID" => 302,
							"TEXT" => "Джемперы, свитера, туники",
							"LINK" => "/vay/vyazanyy-trikotazh/dzhempery-svitera-tuniki/",
							"SELECTED" => "",
							"DEPTH_LEVEL" => 4,
							"IS_PARENT" => ""
						),
						Array(
							"ID" => 303,
							"TEXT" => "Жакеты, кардиганы",
							"LINK" => "/vay/vyazanyy-trikotazh/zhakety-kardigany/",
							"SELECTED" => "",
							"DEPTH_LEVEL" => 4,
							"IS_PARENT" => ""
						),
						Array(
							"ID" => 304,
							"TEXT" => "Жилеты",
							"LINK" => "/vay/vyazanyy-trikotazh/zhilety/",
							"SELECTED" => "",
							"DEPTH_LEVEL" => 4,
							"IS_PARENT" => ""
						),
						Array(
							"ID" => 305,
							"TEXT" => "Платья",
							"LINK" => "/vay/vyazanyy-trikotazh/platya/",
							"SELECTED" => "",
							"DEPTH_LEVEL" => 4,
							"IS_PARENT" => ""
						),
						Array(
							"ID" => 306,
							"TEXT" => "Юбки, костюмы",
							"LINK" => "/vay/vyazanyy-trikotazh/yubki-kostyumy/",
							"SELECTED" => "",
							"DEPTH_LEVEL" => 4,
							"IS_PARENT" => ""
						),
						Array(
							"ID" => 307,
							"TEXT" => "Лосины, рейтузы",
							"LINK" => "/vay/vyazanyy-trikotazh/losiny-reytuzy/",
							"SELECTED" => "",
							"DEPTH_LEVEL" => 4,
							"IS_PARENT" => ""
						),
						Array(
							"TEXT" => "Аксессуары",
							"LINK" => "/aksessuary/aksessuary-zhenskie/",
							"SELECTED" => "",
							"DEPTH_LEVEL" => 4,
							"IS_PARENT" => ""
						),
						Array(
							"TEXT" => "Товары по акции",
							"LINK" => "/vay/vyazanyy-trikotazh/filter/akciya_on_site-is-y/apply/",
							"SELECTED" => "",
							"DEPTH_LEVEL" => 4,
							"IS_PARENT" => ""
						),
					Array(
						"ID" => 308,
						"TEXT" => "Швейные изделия",
						"LINK" => "/vay/shveynye-izdeliya/",
						"SELECTED" => "",
						"DEPTH_LEVEL" => 3,
						"IS_PARENT" => 1
					),
						Array(
							"ID" => 309,
							"TEXT" => "Блузы, джемперы, свитера",
							"LINK" => "/vay/shveynye-izdeliya/bluzy-dzhempery-svitera/",
							"SELECTED" => "",
							"DEPTH_LEVEL" => 4,
							"IS_PARENT" => ""
						),
						Array(
							"ID" => 310,
							"TEXT" => "Водолазки",
							"LINK" => "/vay/shveynye-izdeliya/vodolazki/",
							"SELECTED" => "",
							"DEPTH_LEVEL" => 4,
							"IS_PARENT" => ""
						),
						Array(
							"ID" => 311,
							"TEXT" => "Жакеты, болеро",
							"LINK" => "/vay/shveynye-izdeliya/zhakety-bolero/",
							"SELECTED" => "",
							"DEPTH_LEVEL" => 4,
							"IS_PARENT" => ""
						),
						Array(
							"ID" => 312,
							"TEXT" => "Топы, футболки",
							"LINK" => "/vay/shveynye-izdeliya/topy-futbolki/",
							"SELECTED" => "",
							"DEPTH_LEVEL" => 4,
							"IS_PARENT" => ""
						),
						Array(
							"ID" => 313,
							"TEXT" => "Платья, сарафаны, туники",
							"LINK" => "/vay/shveynye-izdeliya/platya-sarafany-tuniki/",
							"SELECTED" => "",
							"DEPTH_LEVEL" => 4,
							"IS_PARENT" => ""
						),
						Array(
							"ID" => 314,
							"TEXT" => "Юбки",
							"LINK" => "/vay/shveynye-izdeliya/yubki/",
							"SELECTED" => "",
							"DEPTH_LEVEL" => 4,
							"IS_PARENT" => ""
						),
						Array(
							"ID" => 315,
							"TEXT" => "Брюки, бриджи, капри",
							"LINK" => "/vay/shveynye-izdeliya/bryuki-bridzhi-kapri/",
							"SELECTED" => "",
							"DEPTH_LEVEL" => 4,
							"IS_PARENT" => ""
						),
						Array(
							"TEXT" => "Товары по акции",
							"LINK" => "/vay/shveynye-izdeliya/filter/akciya_on_site-is-y/apply/",
							"SELECTED" => "",
							"DEPTH_LEVEL" => 4,
							"IS_PARENT" => ""
						),
						
			Array(
				"ID" => 271,
				"TEXT" => "Мужской",
				"LINK" => "/muzhskoy-trikotazh/",
				"SELECTED" => "",
				"DEPTH_LEVEL" => 2,
				"IS_PARENT" => 1
			),
				Array(
					"ID" => 272,
					"TEXT" => "Джемперы, свитера",
					"LINK" => "/muzhskoy-trikotazh/dzhempery-svitera/",
					"SELECTED" => "",
					"DEPTH_LEVEL" => 3,
					"IS_PARENT" => ""
				),
				Array(
					"ID" => 273,
					"TEXT" => "Жакеты, кардиганы",
					"LINK" => "/muzhskoy-trikotazh/zhakety-kardigany/",
					"SELECTED" => "",
					"DEPTH_LEVEL" => 3,
					"IS_PARENT" => ""
				),
				Array(
					"ID" => 316,
					"TEXT" => "Жилеты",
					"LINK" => "/muzhskoy-trikotazh/zhilety/",
					"SELECTED" => "",
					"DEPTH_LEVEL" => 3,
					"IS_PARENT" => ""
				),
				Array(
					"TEXT" => "Аксессуары",
					"LINK" => "/aksessuary/aksessuary-muzhskie/",
					"SELECTED" => "",
					"DEPTH_LEVEL" => 3,
					"IS_PARENT" => ""
				),
				Array(
					"TEXT" => "Товары по акции",
					"LINK" => "/muzhskoy-trikotazh/filter/akciya_on_site-is-y/apply/",
					"SELECTED" => "",
					"DEPTH_LEVEL" => 3,
					"IS_PARENT" => ""
				),
			Array(
				"ID" => 246,
				"TEXT" => "Детский",
				"LINK" => "/detskiy-trikotazh/",
				"SELECTED" => "",
				"DEPTH_LEVEL" => 2,
				"IS_PARENT" => 1
			),
				Array(
					"ID" => 247,
					"TEXT" => "VAY KIDS Школа",
					"LINK" => "/detskiy-trikotazh/vay-kids-shkola/",
					"SELECTED" => "",
					"DEPTH_LEVEL" => 3,
					"IS_PARENT" => 1
				),
					Array(
						"ID" => 249,
						"TEXT" => "Жакеты детские",
						"LINK" => "/detskiy-trikotazh/vay-kids-shkola/zhakety-detskie/",
						"SELECTED" => "",
						"DEPTH_LEVEL" => 4,
						"IS_PARENT" => ""
					),
					Array(
						"ID" => 250,
						"TEXT" => "Жилеты детские",
						"LINK" => "/detskiy-trikotazh/vay-kids-shkola/zhilety-detskie/",
						"SELECTED" => "",
						"DEPTH_LEVEL" => 4,
						"IS_PARENT" => ""
					),
					Array(
						"ID" => 251,
						"TEXT" => "Джемперы детские",
						"LINK" => "/detskiy-trikotazh/vay-kids-shkola/dzhempery-detskie/",
						"SELECTED" => "",
						"DEPTH_LEVEL" => 4,
						"IS_PARENT" => ""
					),
					Array(
						"ID" => 253,
						"TEXT" => "Блузы, водолазки",
						"LINK" => "/detskiy-trikotazh/vay-kids-shkola/bluzy-vodolazki/",
						"SELECTED" => "",
						"DEPTH_LEVEL" => 4,
						"IS_PARENT" => ""
					),
					Array(
						"ID" => 254,
						"TEXT" => "Платья, сарафаны",
						"LINK" => "/detskiy-trikotazh/vay-kids-shkola/platya-sarafany/",
						"SELECTED" => "",
						"DEPTH_LEVEL" => 4,
						"IS_PARENT" => ""
					),
					Array(
						"ID" => 275,
						"TEXT" => "Юбки",
						"LINK" => "/detskiy-trikotazh/vay-kids-shkola/yubki/",
						"SELECTED" => "",
						"DEPTH_LEVEL" => 4,
						"IS_PARENT" => ""
					),
					Array(
							"TEXT" => "Товары по акции",
							"LINK" => "/detskiy-trikotazh/vay-kids-shkola/filter/akciya_on_site-is-y/apply/",
							"SELECTED" => "",
							"DEPTH_LEVEL" => 4,
							"IS_PARENT" => ""
						),
				Array(
					"ID" => 277,
					"TEXT" => "VAY KIDS Повседневный",
					"LINK" => "/detskiy-trikotazh/vay-kids-povsednevnyy-trikotazh/",
					"SELECTED" => "",
					"DEPTH_LEVEL" => 3,
					"IS_PARENT" => "1"
				),
					Array(
						"ID" => 278,
						"TEXT" => "Жакеты детские",
						"LINK" => "/detskiy-trikotazh/vay-kids-povsednevnyy-trikotazh/zhakety-detskie/",
						"SELECTED" => "",
						"DEPTH_LEVEL" => 4,
						"IS_PARENT" => ""
					),
					Array(
						"ID" => 279,
						"TEXT" => "Жилеты детские",
						"LINK" => "/detskiy-trikotazh/vay-kids-povsednevnyy-trikotazh/zhilety-detskie/",
						"SELECTED" => "",
						"DEPTH_LEVEL" => 4,
						"IS_PARENT" => ""
					),
					Array(
						"ID" => 280,
						"TEXT" => "Джемперы, туники",
						"LINK" => "/detskiy-trikotazh/vay-kids-povsednevnyy-trikotazh/dzhempery-tuniki/",
						"SELECTED" => "",
						"DEPTH_LEVEL" => 4,
						"IS_PARENT" => ""
					),
					Array(
						"ID" => 281,
						"TEXT" => "Платья, сарафаны",
						"LINK" => "/detskiy-trikotazh/vay-kids-povsednevnyy-trikotazh/platya-sarafany/",
						"SELECTED" => "",
						"DEPTH_LEVEL" => 4,
						"IS_PARENT" => ""
					),
					Array(
						"ID" => 282,
						"TEXT" => "Рейтузы детские",
						"LINK" => "/detskiy-trikotazh/vay-kids-povsednevnyy-trikotazh/reytuzy-detskie/",
						"SELECTED" => "",
						"DEPTH_LEVEL" => 4,
						"IS_PARENT" => ""
					),
					Array(
						"ID" => 283,
						"TEXT" => "Швейные изделия",
						"LINK" => "/detskiy-trikotazh/vay-kids-povsednevnyy-trikotazh/shveynye-izdeliya/",
						"SELECTED" => "",
						"DEPTH_LEVEL" => 4,
						"IS_PARENT" => ""
					),
					Array(
						"TEXT" => "Аксессуары",
						"LINK" => "/aksessuary/aksessuary-detskie/",
						"SELECTED" => "",
						"DEPTH_LEVEL" => 4,
						"IS_PARENT" => ""
					),
					Array(
						"TEXT" => "Товары по акции",
						"LINK" => "/detskiy-trikotazh/vay-kids-povsednevnyy-trikotazh/filter/akciya_on_site-is-y/apply/",
						"SELECTED" => "",
						"DEPTH_LEVEL" => 4,
						"IS_PARENT" => ""
					),
				Array(
					"ID" => 256,
					"TEXT" => "Веснушки",
					"LINK" => "/detskiy-trikotazh/vesnushki/",
					"SELECTED" => "",
					"DEPTH_LEVEL" => 3,
					"IS_PARENT" => "1"
				),
					Array(
						"ID" => 257,
						"TEXT" => "Джемперы, туники",
						"LINK" => "/detskiy-trikotazh/vesnushki/dzhempery-tuniki/",
						"SELECTED" => "",
						"DEPTH_LEVEL" => 4,
						"IS_PARENT" => ""
					),
					Array(
						"ID" => 258,
						"TEXT" => "Жилеты детские",
						"LINK" => "/detskiy-trikotazh/vesnushki/zhilety-detskie/",
						"SELECTED" => "",
						"DEPTH_LEVEL" => 4,
						"IS_PARENT" => ""
					),
					Array(
						"ID" => 261,
						"TEXT" => "Платья, сарафаны детские",
						"LINK" => "/detskiy-trikotazh/vesnushki/platya-sarafany-detskie/",
						"SELECTED" => "",
						"DEPTH_LEVEL" => 4,
						"IS_PARENT" => ""
					),
					Array(
						"ID" => 262,
						"TEXT" => "Рейтузы детские",
						"LINK" => "/detskiy-trikotazh/vay-kids-povsednevnyy-trikotazh/reytuzy-detskie/",
						"SELECTED" => "",
						"DEPTH_LEVEL" => 4,
						"IS_PARENT" => ""
					),
					Array(
						"ID" => 284,
						"TEXT" => "Швейные изделия",
						"LINK" => "/detskiy-trikotazh/vesnushki/shveynye-izdeliya/",
						"SELECTED" => "",
						"DEPTH_LEVEL" => 4,
						"IS_PARENT" => ""
					),
					Array(
						"TEXT" => "Аксессуары",
						"LINK" => "/aksessuary/aksessuary-detskie/",
						"SELECTED" => "",
						"DEPTH_LEVEL" => 4,
						"IS_PARENT" => ""
					),
					Array(
						"TEXT" => "Товары по акции",
						"LINK" => "/detskiy-trikotazh/vesnushki/filter/akciya_on_site-is-y/apply/",
						"SELECTED" => "",
						"DEPTH_LEVEL" => 4,
						"IS_PARENT" => ""
					),

		Array(
			"ID" => 273,
			"TEXT" => "Аксессуары",
			"LINK" => "/aksessuary/",
			"SELECTED" => "",
			"DEPTH_LEVEL" => 2,
			"IS_PARENT" => 1
		),
			Array(
				"ID" => 285,
				"TEXT" => "Аксессуары женские",
				"LINK" => "/aksessuary/aksessuary-zhenskie/",
				"SELECTED" => "",
				"DEPTH_LEVEL" => 3,
				"IS_PARENT" => 1
			),
				Array(
					"ID" => 286,
					"TEXT" => "Шапки",
					"LINK" => "/aksessuary/aksessuary-zhenskie/shapki-zhenskie/",
					"SELECTED" => "",
					"DEPTH_LEVEL" => 4,
					"IS_PARENT" => ""
				),
				Array(
					"ID" => 287,
					"TEXT" => "Шарфы, снуды",
					"LINK" => "/aksessuary/aksessuary-zhenskie/sharfy-snudy-zhenskie/",
					"SELECTED" => "",
					"DEPTH_LEVEL" => 4,
					"IS_PARENT" => ""
				),
				Array(
					"ID" => 288,
					"TEXT" => "Варежки, митенки",
					"LINK" => "/aksessuary/aksessuary-zhenskie/varezhki-mitenki-zhenskie/",
					"SELECTED" => "",
					"DEPTH_LEVEL" => 4,
					"IS_PARENT" => ""
				),
				Array(
					"ID" => 289,
					"TEXT" => "Гетры",
					"LINK" => "/aksessuary/aksessuary-zhenskie/getry-zhenskie/",
					"SELECTED" => "",
					"DEPTH_LEVEL" => 4,
					"IS_PARENT" => ""
				),
				Array(
					"TEXT" => "Товары по акции",
					"LINK" => "/aksessuary/aksessuary-zhenskie/filter/akciya_on_site-is-y/apply/",
					"SELECTED" => "",
					"DEPTH_LEVEL" => 4,
					"IS_PARENT" => ""
				),
			Array(
				"ID" => 290,
				"TEXT" => "Аксессуары мужские",
				"LINK" => "/aksessuary/aksessuary-muzhskie/",
				"SELECTED" => "",
				"DEPTH_LEVEL" => 3,
				"IS_PARENT" => 1
			),
				Array(
					"ID" => 291,
					"TEXT" => "Шапки",
					"LINK" => "/aksessuary/aksessuary-muzhskie/shapki-muzhskie/",
					"SELECTED" => "",
					"DEPTH_LEVEL" => 4,
					"IS_PARENT" => ""
				),
				Array(
					"ID" => 292,
					"TEXT" => "Шарфы, снуды",
					"LINK" => "/aksessuary/aksessuary-muzhskie/sharfy-snudy/",
					"SELECTED" => "",
					"DEPTH_LEVEL" => 4,
					"IS_PARENT" => ""
				),
				Array(
					"ID" => 317,
					"TEXT" => "Варежки, митенки",
					"LINK" => "/aksessuary/aksessuary-muzhskie/varezhki-mitenki/",
					"SELECTED" => "",
					"DEPTH_LEVEL" => 4,
					"IS_PARENT" => ""
				),
				Array(
					"TEXT" => "Товары по акции",
					"LINK" => "/aksessuary/aksessuary-muzhskie/filter/akciya_on_site-is-y/apply/",
					"SELECTED" => "",
					"DEPTH_LEVEL" => 4,
					"IS_PARENT" => ""
				),
			Array(
				"ID" => 273,
				"TEXT" => "Аксессуары детские",
				"LINK" => "/aksessuary/aksessuary-detskie/",
				"SELECTED" => "",
				"DEPTH_LEVEL" => 3,
				"IS_PARENT" => 1
			),
				Array(
					"ID" => 294,
					"TEXT" => "Шапки",
					"LINK" => "/aksessuary/aksessuary-detskie/shapki-detskie/",
					"SELECTED" => "",
					"DEPTH_LEVEL" => 4,
					"IS_PARENT" => ""
				),
				Array(
					"ID" => 295,
					"TEXT" => "Шарфы, снуды",
					"LINK" => "/aksessuary/aksessuary-detskie/sharfy-snudy-detskie/",
					"SELECTED" => "",
					"DEPTH_LEVEL" => 4,
					"IS_PARENT" => ""
				),
				Array(
					"ID" => 296,
					"TEXT" => "Варежки, митенки",
					"LINK" => "/aksessuary/aksessuary-detskie/varezhki-mitenki/",
					"SELECTED" => "",
					"DEPTH_LEVEL" => 4,
					"IS_PARENT" => ""
				),
				Array(
					"ID" => 297,
					"TEXT" => "Гетры",
					"LINK" => "/aksessuary/aksessuary-detskie/getry-detskie/",
					"SELECTED" => "",
					"DEPTH_LEVEL" => 4,
					"IS_PARENT" => ""
				),
				Array(
					"TEXT" => "Товары по акции",
					"LINK" => "/aksessuary/aksessuary-detskie/filter/akciya_on_site-is-y/apply/",
					"SELECTED" => "",
					"DEPTH_LEVEL" => 4,
					"IS_PARENT" => ""
				),
		Array(
			"ID" => 298,
			"TEXT" => "Подарки",
			"LINK" => "/podarki/",
			"SELECTED" => "",
			"DEPTH_LEVEL" => 2,
			"IS_PARENT" => 1
			),
			Array(
				"ID" => 299,
				"TEXT" => "Календари",
				"LINK" => "/podarki/kalendari/",
				"SELECTED" => "",
				"DEPTH_LEVEL" => 3,
				"IS_PARENT" => ''
			),
			Array(
				"ID" => 300,
				"TEXT" => "Пледы",
				"LINK" => "/podarki/pledy/",
				"SELECTED" => "",
				"DEPTH_LEVEL" => 3,
				"IS_PARENT" => ''
			),
		Array(
			"TEXT" => "Товары по акции",
			"LINK" => "/sale/",
			"SELECTED" => "",
			"DEPTH_LEVEL" => 3,
			"IS_PARENT" => ""
			),

	Array(
		"TEXT" => "Сотрудничество",
        //"LINK" => $USER->isAuthorized() ? "/personal/partner.html" : "/sotrudnichestvo.html",
		"LINK" => "/partneram/",
		"SELECTED" => "",
		"DEPTH_LEVEL" => 1,
		"IS_PARENT" => 0
		),
	Array(
		"TEXT" => "Контакты",
        "LINK" => "/kontakty/",
		"SELECTED" => "",
		"DEPTH_LEVEL" => 1,
		"IS_PARENT" => 0
		),
		
	Array(
		"TEXT" => "Купить в розницу!",
        "LINK" => "/",
		"SELECTED" => "",
		"DEPTH_LEVEL" => 1,
		"IS_PARENT" => 0
		)
		
	);
	?>