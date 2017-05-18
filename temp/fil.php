<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?
//CModule::IncludeModule("sale");
//CModule::IncludeModule("catalog");
//CModule::IncludeModule("iblock"); 
//$f=file("agents.csv");
//prn($f);

/*
function _getfilename($id) 
{
	global $APPLICATION;
	$rsFile = CFile::GetByID($id);
	if($arFile = $rsFile->Fetch()) 
	{
		$url = 'http://'.$_SERVER["HTTP_HOST"].'/upload/'.$arFile["SUBDIR"].'/'.$arFile["FILE_NAME"];
		return '<a href="'.$url.'" target="_blank">'.$url.'</a>';
	}
	else 
		return 'нет файла';
}	

echo _getfilename(42807); 
/*
$rsFile = CFile::GetByID(42807);
$arFile = $rsFile->Fetch();
echo '<a href="http://'.$_SERVER["HTTP_HOST"].'/upload/'.$arFile["SUBDIR"].'/'.$arFile["FILE_NAME"].'" target="_blank">ИНН (копия)</a>';
*/

?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>