<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); 
$arComponentDescription = array(
	"NAME" => GetMessage("NAME"),
	"DESCRIPTION" => GetMessage("DESCRIPTION"),
	"PATH" => array(
		"ID" => "Новостной комонент Харлова Виктора",
		"CHILD" => array(
			"ID" => "my_news_component",
			"NAME" => "Новостной комонент (Харлова В.В.)"
			)
		),
	"ICON" => "/images/icon.gif",
);