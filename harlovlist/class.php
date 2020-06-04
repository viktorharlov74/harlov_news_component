<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Main\Loader,
	Bitrix\Iblock;

class NewListClass extends CBitrixComponent
{	
	//Получаем список новостей для страницы и добавляем в каждый параметр изображение, дату активности и идентификаторы для редактирования новостей в админ панели Битрикса.
    public function getNewsForPage($numberPage=1){
    	if(!Loader::includeModule("iblock"))
    	{
    		return array('eror' => "Не подключен модуль для работы с инфоблоками");
    	}


    	$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM");
    	$arrNews=[];
		$arFilter = Array("IBLOCK_ID"=>$this->arParams["ID_IBLOCK"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
		$res = CIBlockElement::GetList(Array("timestamp_x"=>"DESC"), $arFilter, false, Array("iNumPage"=>$numberPage,"nPageSize"=>$this->arParams["COUNTS_PAGE_ELEMENTS"]), Array());
		while($ob = $res->GetNextElement())
		{
		 $arFields = $ob->GetFields();
		 $arrNews[]=$arFields;
		}
		

		foreach ($arrNews as $key => $news) {

			$arrNews[$key]['SRC_PREVIEW_PICTURE']= CFile::GetPath(intval($arrNews[$key]['~PREVIEW_PICTURE']));
			if ($arrNews[$key]['SRC_PREVIEW_PICTURE']=="")
			{
				$arrNews[$key]['SRC_PREVIEW_PICTURE']= CFile::GetPath(intval($arrNews[$key]['~DETAIL_PICTURE']));
				
			}
			$arrNews[$key]['DATE_ACTIVE_SHOW']= (isset($arrNews[$key]['~DATE_ACTIVE_FROM']))? $arrNews[$key]['~DATE_ACTIVE_FROM'] :  date("d.m.Y",$arrNews[$key]['~DATE_CREATE_UNIX']);
				$arButtons = CIBlock::GetPanelButtons(
				  $this->arParams["ID_IBLOCK"],
				   $news["ID"],
				   0,
				   array("SECTION_BUTTONS"=>false, "SESSID"=>false)
				);
				$arrNews[$key]["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
				$arrNews[$key]["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];
		}
		$this->arrNews=$arrNews;
    	return 	$arrNews;
    }

    public function getCountNews()
    {
    	$arFilter = Array("IBLOCK_ID"=>$this->arParams["ID_IBLOCK"], "ACTIVE"=>"Y");
		$res_count = CIBlockElement::GetList(Array(), $arFilter, Array(), false, Array());
		return $res_count;

    }

}