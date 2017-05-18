<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Контакты | Фемина Трейд");
$APPLICATION->SetPageProperty("keywords", "Контакты");
$APPLICATION->SetPageProperty("description", "Контакты");
$APPLICATION->SetTitle("Контакты");
$APPLICATION->AddChainItem("Контакты");
?>


<address class="contacts">

    <div class="city">
        <span class="mosсow">Москва</span>
        г. Москва, ул. Уткина, д. 48/8<br>(вход с ул. Гаражная,<br>
        проходная завода &quot;Электропривод&quot;)
    </div>
    <div class="assistant-manager">
        <span class="person">Смирнова Александра</span>
        Помощник руководителя компании<br>
        E-mail:
        <script type="text/javascript">eval(unescape('%64%6f%63%75%6d%65%6e%74%2e%77%72%69%74%65%28%27%3c%61%20%68%72%65%66%3d%22%6d%61%69%6c%74%6f%3a%69%6e%66%6f%40%6e%65%77%76%61%79%2e%72%75%22%3e%69%6e%66%6f%40%6e%65%77%76%61%79%2e%72%75%3c%2f%61%3e%27%29%3b'))</script>
    </div>
    <div class="tel">
        <span>Телефоны<br>(только оптовые продажи):</span>
        <a rel="nofollow" href="tel:+74959557888" >+7 (495) 955-78-88</a><br>
        <a rel="nofollow" href="tel:+74956737345" >+7 (495) 673-73-45</a><br>
    </div>
    <div class="fax">
        <span>Факс:</span>
        <a rel="nofollow" href="tel:+74956737345" >+7 (495) 673-73-45</a>
    </div>
</address>
<div id="map" class="map" style="height:400px;"></div>
<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript" defear></script>
<script>
    $( document ).ready(function() {
        ymaps.ready(function () {
            var myMap = new ymaps.Map('map', {
                        center: [55.759816,37.745007],
                        zoom: 14,
                        controls: ['zoomControl']
                    }, {
                        searchControlProvider: 'yandex#search'
                    }),
                    myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
                        hintContent: '',
                        balloonContent: 'г. Москва, ул. Уткина, д. 48/8 (вход с ул. Гаражная, проходная завода "Электропривод")'
                    }, {
                        // Опции.
                        // Необходимо указать данный тип макета.
                        iconLayout: 'default#image',
                        // Своё изображение иконки метки.
                        iconImageHref: '/bitrix/templates/new_femina/images/map_point.png',
                        // Размеры метки.
                        iconImageSize: [140, 60],
                        // Смещение левого верхнего угла иконки относительно
                        // её "ножки" (точки привязки).
                        iconImageOffset: [-29, -55]
                    });

            myMap.geoObjects.add(myPlacemark);
            myMap.behaviors.disable('scrollZoom');
        });
    });

</script>

<div class="mailback">Отзывы и предложения по работе компании и качеству продукции отправлять на e-mail – <script type="text/javascript">eval(unescape('%64%6f%63%75%6d%65%6e%74%2e%77%72%69%74%65%28%27%3c%61%20%68%72%65%66%3d%22%6d%61%69%6c%74%6f%3a%69%6e%66%6f%40%6e%65%77%76%61%79%2e%72%75%22%3e%69%6e%66%6f%40%6e%65%77%76%61%79%2e%72%75%3c%2f%61%3e%27%29%3b'))</script></div>

<div class="employee">
    <div class="managers">
        <div class="manager">
            <h2>КОНТАКТЫ ОПТОВОГО ОТДЕЛА ПРОДАЖ</h2>
            <div class="deck"></div>
            <span class="person">Красавина Татьяна</span>
            Ответственный менеджер по Москве, Московской области, Центральному, Южному и Северо-Кавказскому ФО<br>
            E-mail:
            <script type="text/javascript">eval(unescape('%64%6f%63%75%6d%65%6e%74%2e%77%72%69%74%65%28%27%3c%61%20%68%72%65%66%3d%22%6d%61%69%6c%74%6f%3a%74%61%74%79%61%6e%61%40%6e%65%77%76%61%79%2e%72%75%22%3e%74%61%74%79%61%6e%61%40%6e%65%77%76%61%79%2e%72%75%3c%2f%61%3e%27%29%3b'))</script><br>
            (доб.108)
        </div>
        <div class="manager">
            <span class="person">Сербина Ольга</span>
            Ответственный менеджер по Северо-Западному ФО<br>
            E-mail:
            <script type="text/javascript">eval(unescape('%64%6f%63%75%6d%65%6e%74%2e%77%72%69%74%65%28%27%3c%61%20%68%72%65%66%3d%22%6d%61%69%6c%74%6f%3a%6f%73%40%6e%65%77%76%61%79%2e%72%75%22%3e%6f%73%40%6e%65%77%76%61%79%2e%72%75%3c%2f%61%3e%27%29%3b'))</script><br>
            (доб.111)
        </div>
        <div class="manager">
            <span class="person">Косарева Ольга</span>
            Ответственный менеджер по Сибирскому, Дальневосточному ФО и СНГ<br>
            E-mail:
            <script type="text/javascript">eval(unescape('%64%6f%63%75%6d%65%6e%74%2e%77%72%69%74%65%28%27%3c%61%20%68%72%65%66%3d%22%6d%61%69%6c%74%6f%3a%6f%6b%40%6e%65%77%76%61%79%2e%72%75%22%3e%6f%6b%40%6e%65%77%76%61%79%2e%72%75%3c%2f%61%3e%27%29%3b'))</script><br>
            (доб.103)
        </div>
        <div class="manager">
            <span class="person">Антипов Михаил</span>
            Ответственный менеджер по Приволжскому ФО<br>
            E-mail:
            <script type="text/javascript">eval(unescape('%64%6f%63%75%6d%65%6e%74%2e%77%72%69%74%65%28%27%3c%61%20%68%72%65%66%3d%22%6d%61%69%6c%74%6f%3a%6d%69%73%68%61%40%6e%65%77%76%61%79%2e%72%75%22%3e%6d%69%73%68%61%40%6e%65%77%76%61%79%2e%72%75%3c%2f%61%3e%27%29%3b'))</script><br>
            (доб.102)
        </div>
        <div class="manager">
            <span class="person">Золотарева Наталья</span>
            Ответственный менеджер по Уральскому ФО<br>
            E-mail:
            <script type="text/javascript">eval(unescape('%64%6f%63%75%6d%65%6e%74%2e%77%72%69%74%65%28%27%3c%61%20%68%72%65%66%3d%22%6d%61%69%6c%74%6f%3a%6d%61%6e%61%67%65%72%2d%6b%69%64%73%40%6e%65%77%76%61%79%2e%72%75%22%3e%6d%61%6e%61%67%65%72%2d%6b%69%64%73%40%6e%65%77%76%61%79%2e%72%75%3c%2f%61%3e%27%29%3b'))</script><br>
            (доб.113)
        </div>
    </div>
    <div class="managers">
        <div class="manager">
            <h2>КОНТАКТЫ ОТДЕЛА ПРОИЗВОДСТВА И ЗАКУПОК</h2>
            <div class="deck"></div>
            <span class="person">Елена Быстрова</span>
            Ведущий менеджер отдела производства и закупок<br>
            E-mail:
            <script type="text/javascript">eval(unescape('%64%6f%63%75%6d%65%6e%74%2e%77%72%69%74%65%28%27%3c%61%20%68%72%65%66%3d%22%6d%61%69%6c%74%6f%3a%62%65%40%6e%65%77%76%61%79%2e%72%75%22%3e%62%65%40%6e%65%77%76%61%79%2e%72%75%3c%2f%61%3e%27%29%3b'))</script><br>
            (доб.115)
        </div>
    </div>
</div>




<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>