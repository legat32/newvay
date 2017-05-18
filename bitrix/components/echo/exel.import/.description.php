<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("EEI_NAME"),
	"DESCRIPTION" => GetMessage("EEI_DESCRIPTION"),
	"ICON" => "/images/catalog.gif",
	"SORT" => 10,
	"PATH" => array(
		"ID" => "content",
		"CHILD" => array(
			"ID" => "echogroup.exelimport",
			"NAME" => GetMessage("EEI_PNAME"),
		),
	),
);

?>