<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
// удаляем отображаемый в данный момент товар из списка других товаров по коллекции
// сделано в javascript чтобы выводить перечень элементов кэшированный и удалять из него один элемент
// иначе выборка других моделей каждый раз подгрузит страницу
?>

<?unset($_SESSION["REQUEST_BASKET_RECALC"]);?>
<h1>EPILOG</h1>