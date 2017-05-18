<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?
CModule::IncludeModule("iblock"); 
$el = new CIBlockElement;
$res = $el->Update(1508990, Array("ACTIVE" => "Y")); 
if($res) echo "OK"; else echo "NO";
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>