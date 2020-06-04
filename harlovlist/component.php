<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Context;

if($this->startResultCache())
{
	$request = Context::getCurrent()->getRequest();
	$pagenumber = intval($request->get("pg_number"));
	if ($pagenumber==0){
		$pagenumber=1;
	}
	$arResult['ARRNEWS']=$this->getNewsForPage($pagenumber);
	$arResult['CURRENT_PAGE_NUMBER']=$pagenumber;
	$arResult['COUNT_NEWS']=$this->getCountNews();
	$arResult['COUNT_PAGE']=ceil(intval($arResult['COUNT_NEWS']) / intval($arParams['COUNTS_PAGE_ELEMENTS']));

}
$this->IncludeComponentTemplate();
?>