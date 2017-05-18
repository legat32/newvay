$(document).ready( function() {
	
        var token = '51dfe5d42fb2b43e3300006e';
        var key = '86a2c2a06f1b2451a87d05512cc2c3edfdf41969';        
        var city = $( '[name=city]' );	
		
		function get_okrug(a) {
			var b = 'city';
			var okruga = ['Центральный', 'Южный', 'Северо-Западный', 'Дальневосточный', 'Сибирский', 'Уральский', 'Приволжский', 'Северо-Кавказский', 'Крымский'];
			var regions = [
				['Белгородский', 'Брянская', 'Владимирская', 'Воронежская', 'Ивановская', 'Калужская', 'Костромская', 'Курская', 'Липецкая', 'Москва', 'Московская', 'Орловская', 'Рязанская', 'Смоленская', 'Тамбовская', 'Тверская', 'Тульская', 'Ярославская'],
				['Адыгея', 'Астраханская', 'Волгоградская', 'Калмыкия', 'Краснодарский', 'Ростовская'],
				['Архангельская', 'Вологодская', 'Калининградская', 'Карелия', 'Коми', 'Ленинградская', 'Мурманская', 'Ненецкий', 'Новгородская', 'Псковская', 'Санкт-Петербург'],
				['Амурская', 'Еврейская', 'Камчатский', 'Магаданская', 'Приморский', 'Саха /Якутия/', 'Сахалинская', 'Хабаровский', 'Чукотский'],
				['Алтай', 'Алтайский', 'Бурятия', 'Забайкальский', 'Иркутская', 'Кемеровская', 'Красноярский', 'Новосибирская', 'Омская', 'Томская', 'Тыва', 'Хакасия'],
				['Курганская', 'Свердловская', 'Тюменская', 'Ханты-Мансийский Автономный округ - Югра', 'Челябинская', 'Ямало-Ненецкий'],
				['Башкортостан', 'Кировская', 'Марий Эл', 'Мордовия', 'Нижегородская', 'Оренбургская', 'Пензенская', 'Пермский', 'Самарская', 'Саратовская', 'Татарстан', 'Удмуртская', 'Ульяновская', 'Чувашская - Чувашия'],
				['Дагестан', 'Ингушетия', 'Кабардино-Балкарская', 'Карачаево-Черкесская', 'Северная Осетия - Алания', 'Чеченская', 'Ставропольский'],
				['Севастополь', 'Крым']
				];
			for (var i=0; i<regions.length; i++) {
				for (var j=0; j<regions[i].length; j++) {
					if(regions[i][j] == a) {
						b = okruga[i];
						break;
						}
					}
				}; 
			return b;
			}
		

        // Формирует подписи в autocomplete
        var LabelFormat = function( obj, query ){
            var label = '';
            var name = obj.name.toLowerCase();
            query = query.toLowerCase();
            var start = name.indexOf(query);
            start = start > 0 ? start : 0;
			if(obj.typeShort){
                label += '<span class="ac-s2">' + obj.typeShort + '. ' + '</span>';
            }

            if(query.length < obj.name.length){
                label += '<span class="ac-s2">' + obj.name.substr(0, start) + '</span>';
                label += '<span class="ac-s">' + obj.name.substr(start, query.length) + '</span>';
                label += '<span class="ac-s2">' + obj.name.substr(start+query.length, obj.name.length-query.length-start) + '</span>';
            } else {
                label += '<span class="ac-s">' + obj.name + '</span>';
            }

            if(obj.parents){
                for(var k = obj.parents.length-1; k>-1; k--){
                    var parent = obj.parents[k];
                    if(parent.name){
                        if(label) label += '<span class="ac-st">, </span>';
                        label += '<span class="ac-st">' + parent.name + ' ' + parent.typeShort + '.</span>';
                    }
                }
            }

            return label;
        };
        
        // Подключение плагина для поля ввода города
        city.kladr({
            token: token,
            key: key,
            type: $.kladr.type.city,
            withParents: 2,
            labelFormat: LabelFormat,
			verify: false,
            select: function( obj ) {
				if(obj.parents.length>0) {
					var okr = get_okrug(obj.parents[0].name);
					$('input[name=city]').val(obj.typeShort + '. ' + obj.name + ', ' + obj.parents[0].name + ' ' + obj.parents[0].typeShort + '.');
					$('input[name=okrug]').val(get_okrug(obj.parents[0].name));
					$('input[name=oblast]').val(obj.parents[0].name);
					}
				else {
					var okr = get_okrug(obj.name);
					$('input[name=okrug]').val(get_okrug(obj.name));
					$('input[name=oblast]').val(obj.name);
					}

				$("select[name=UF_OKRUG] option").each( function(index) {
					if($(this).html() == okr) {
						$(this).attr("selected", "selected");
						}
					});
					
					
            }
        });
	});