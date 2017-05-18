<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
// кастомизирован компонент bitrix.basket.basket => inmark.basket.basket
// кастомизация заключается в добавлении передаваемых из корзины данных в запросе в сессию
// для возможности отследить новое количество каждого товара при пересчете корзины 
?>

<?
// здесь просто удаляем этот массив из сессии
unset($_SESSION["REQUEST_BASKET_RECALC"]);
//prn($arResult);
?>
