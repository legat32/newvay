<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = array(
	"PARAMETERS" => array(
		"TMP_PATH" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("EEX_PATH"),
			"TYPE" => "STRING",
			"DEFAULT" => "/upload/exel_export/",
		),
		"ENCODING" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("EEX_ENCODING"),
			"TYPE" => "STRING",
			"DEFAULT" => "WINDOWS-1251",
		),
		"DATA" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("EEX_DATA"),
			"TYPE" => "STRING",
			"DEFAULT" => $_REQUEST["DATA"],
		),

	),
);