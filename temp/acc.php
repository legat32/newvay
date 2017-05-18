<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?
CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");
CModule::IncludeModule("sale");
?>

<?$APPLICATION->SetAdditionalCSS("/assets/accordion/dcaccordion.css");?>
<?$APPLICATION->SetAdditionalCSS("/assets/accordion/skins/grey.css");?>

<div class="grey" style="width:220px;">
<ul id="accordion" class="menu accordion">
    <li><a href="#">Home</a></li>
    <li><a href="#">Products</a>
        <ul>
            <li><a href="#">Mobile Phones &#038; Accessories</a>
                <ul>
                    <li><a href="#">Product 1</a></li>
                    <li><a href="#">Product 2</a></li>
                    <li><a href="#">Product 3</a></li>
                </ul>
            </li>
            <li><a href="#">Desktop</a>
                <ul>
                    <li><a href="#">Product 4</a></li>
                    <li><a href="#">Product 5</a></li>
                    <li><a href="#">Product 6</a></li>
                    <li><a href="#">Product 7</a></li>
                    <li><a href="#">Product 8</a></li>
                    <li><a href="#">Product 9</a></li>
                </ul>
            </li>
            <li><a href="#">Laptop</a>
                <ul>
                    <li><a href="#">Product 10</a></li>
                    <li><a href="#">Product 11</a></li>
                    <li><a href="#">Product 12</a></li>
                    <li><a href="#">Product 13</a></li>
                </ul>
            </li>
            <li><a href="#">Accessories</a>
                <ul>
                    <li><a href="#">Product 14</a></li>
                    <li><a href="#">Product 15</a></li>
                </ul>
            </li>
            <li><a href="#">Software</a>
              <ul>
                <li><a href="#">Product 16</a></li>
                    <li><a href="#">Product 17</a></li>
                    <li><a href="#">Product 18</a></li>
                    <li><a href="#">Product 19</a></li>
              </ul>
            </li>
        </ul>
    </li>
    <li><a href="#">Sale</a>
        <ul>
            <li><a href="#">Special Offers</a>
    <ul>
        <li><a href="#">Offer 1</a></li>
        <li><a href="#">Offer 2</a></li>
        <li><a href="#">Offer 3</a></li>
    </ul>
    </li>
    <li><a href="#">Reduced Price</a>
    <ul>
        <li><a href="#">Offer 4</a></li>
        <li><a href="#">Offer 5</a></li>
        <li><a href="#">Offer 6</a></li>
        <li><a href="#">Offer 7</a></li>
    </ul>
</li>
    <li><a href="#">Clearance Items</a>
    <ul>
        <li><a href="#">Offer 9</a></li>
 
    </ul>
</li>
    <li class="menu-item-129"><a href="#">Ex-Stock</a>
    <ul>
        <li><a href="#">Offer 10</a></li>
        <li><a href="#">Offer 11</a></li>
        <li><a href="#">Offer 12</a></li>
        <li><a href="#">Offer 13</a></li>
    </ul>
</li>
</ul>
</li>
<li><a href="#">About Us</a>
<ul>
    <li><a href="#">About Page 1</a></li>
    <li><a href="#">About Page 2</a></li>
 
</ul>
</li>
<li><a href="#">Services</a>
<ul>
    <li><a href="#">Service 1</a>
    <ul>
        <li><a href="#">Service Detail A</a></li>
        <li><a href="#">Service Detail B</a></li>
    </ul>
</li>
<li><a href="#">Service 2</a>
    <ul>
        <li><a href="#">Service Detail C</a></li>
    </ul>
</li>
    <li><a href="#">Service 3</a>
    <ul>
        <li><a href="#">Service Detail D</a></li>
        <li><a href="#">Service Detail E</a></li>
        <li><a href="#">Service Detail F</a></li>
    </ul>
</li>
    <li><a href="#">Service 4</a></li>
</ul>
</li>
<li><a href="#">Contact us</a></li>
</ul>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>