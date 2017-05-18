<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("EEX_NAME"),
	"DESCRIPTION" => GetMessage("EEX_DESCRIPTION"),
	"ICON" => "/images/catalog.gif",
	"COMPLEX" => "N",
	"SORT" => 10,
	"PATH" => array(
		"ID" => "content",
		"CHILD" => array(
			"ID" => "echogroup.exelimport",
			"NAME" => GetMessage("EEX_PNAME"),
			"SORT" => 30,
		),
	),
);