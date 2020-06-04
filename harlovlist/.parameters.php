<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();


if(!CModule::IncludeModule("iblock"))
	return;

$DBTypeInfoblock =  CIBlockType::GetList(array("sort" => "asc"), array("ACTIVE" => "Y"));

$arrTypeInfoblock=[];

while ($infoType=$DBTypeInfoblock->fetch()) {
		$nameIblockType=CIBlockType::GetByIDLang($infoType["ID"], LANG);
		$arrTypeInfoblock[$infoType['ID']]='['.$infoType['ID'].'] '.$nameIblockType['NAME'];
		
}
$arrIdInfoblock=[];
$typeCurent="";
if (count($arCurrentValues["TYPE_IBLOCK"])!=0)
{
	$typeCurent=$arCurrentValues["TYPE_IBLOCK"];
}
$dbIblockID = CIBlock::GetList(Array(), 
    Array(
        'TYPE'=>$typeCurent, 
        'ACTIVE'=>'Y', 
        "CNT_ACTIVE"=>"Y", 
    ),
    false
);

while ($infoId=$dbIblockID->fetch()) {
	$arrIdInfoblock[$infoId['ID']]='['.$infoId['ID'].'] '.$infoId['NAME'];
	
}

// AddMessage2Log($arrIdInfoblock, "dbIblockID_ID_IBLOCK");
$arIBlocks=array();

 $arComponentParameters = array(
	"GROUPS" => array(),
		"PARAMETERS" => array(
				"TYPE_IBLOCK" => array(
					"PARENT" => "BASE",
					"NAME" => GetMessage('TYPE_IBLOCK'),
					"TYPE" => "LIST",
					"VALUES" => $arrTypeInfoblock,
					"DEFAULT" => "news",
					"REFRESH" => "Y",
				),
				"ID_IBLOCK" => array(
					"PARENT" => "BASE",
					"NAME" => GetMessage('ID_IBLOCK'),
					"TYPE" => "LIST",
					"VALUES" => $arrIdInfoblock,
					"REFRESH" => "Y",
					"ADDITIONAL_VALUES" => "Y",
				),
				"COUNTS_PAGE_ELEMENTS" => array(
					"PARENT" => "BASE",
					"NAME" => GetMessage('COUNTS_PAGE_ELEMENTS'),
					"TYPE" => "STRING",
					"DEFAULT" => "4",
					"ADDITIONAL_VALUES" => "Y",
				),
				"SHOW_IMG_ANONS" => array(
					"PARENT" => "BASE",
					"NAME" => GetMessage('SHOW_IMG_ANONS'),
					"TYPE" => "CHECKBOX",
					"DEFAULT" => "Y",
				),
				"SHOW_HREF_PAGE_DETAIL" => array(
					"PARENT" => "BASE",
					"NAME" => GetMessage('SHOW_HREF_PAGE_DETAIL'),
					"TYPE" => "CHECKBOX",
					"DEFAULT" => "Y",

				),
				
				
			),
		);
?>