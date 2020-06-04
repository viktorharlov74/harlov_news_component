<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
\Bitrix\Main\UI\Extension::load("ui.bootstrap4");
      ?>
		<div class="container">
			<div class="row">
				     <? foreach ($arResult['ARRNEWS'] as $key => $news) {
				      	?>
				      		<?
								$this->AddEditAction($news['ID'], $news['EDIT_LINK'], CIBlock::GetArrayByID($news["IBLOCK_ID"], "ELEMENT_EDIT"));
								$this->AddDeleteAction($news['ID'], $news['DELETE_LINK'], CIBlock::GetArrayByID($news["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CONFIRM_DELETE')));
								?>
									<div class="col-md-3 col-10 offset-md-0 offset-1 news-list-item" id="<?=$this->GetEditAreaId($news['ID']);?>">
				      		<div class="card shadow-sm mb-3">
				      			<?

									if (($arParams['SHOW_IMG_ANONS']=="Y")&($news['SRC_PREVIEW_PICTURE']!="")){?>
										
							      		<div class="img-news ">
											<img style="width: 100%;" src="<?=$news['SRC_PREVIEW_PICTURE'];?>" alt="1">
										</div>
									<?}?>

								<div class="head-news mt-3 mb-3">
									<?if ($arParams['SHOW_HREF_PAGE_DETAIL']=="Y"){?>
											
										<a href="<?=$news['~DETAIL_PAGE_URL']?>" class="headNews"><?=$news['~NAME']?></a>
										<?}
										else {
											?>
										<h3 class="headNews"><?=$news['~NAME']?></h3>
										<?}?>
								</div>
								<? if ($news['~PREVIEW_TEXT']!=""){?>
									<div class="prevue mb-3">
										<?
										 if ($arResult['PREVIEW_TEXT_TYPE']=="html")
										{?>
											<div class="prev-text">
												<?=$news['~PREVIEW_TEXT']?>
											</div>
										<?}
										else{?>
											<p class="prev-text"><?=$news['~PREVIEW_TEXT']?></p>
										<?}?>
									</div>
								<?}?>
								<div class="d-flex justify-content-between mb-3">

									<div class="date-start news-list-view news-list-post-params">
										
										<svg class="bi bi-calendar2-date-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
											  <path fill-rule="evenodd" d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zm-2 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-1zm7.336 9.04c-1.11 0-1.656-.767-1.703-1.407h.683c.043.37.387.82 1.051.82.844 0 1.301-.848 1.305-2.164h-.027c-.153.414-.637.79-1.383.79-.852 0-1.676-.61-1.676-1.77C7.586 7.672 8.457 7 9.383 7c1.172 0 1.953.734 1.953 2.668 0 1.805-.742 2.871-2 2.871zm.066-2.544c.625 0 1.184-.484 1.184-1.18 0-.832-.527-1.23-1.16-1.23-.586 0-1.168.387-1.168 1.21 0 .817.543 1.2 1.144 1.2zm-2.957-2.89v5.332H5.77v-4.61h-.012c-.29.156-.883.52-1.258.777V7.91a12.6 12.6 0 0 1 1.313-.805h.632z"/>
											</svg>
										<span class="date-news-list"><? echo ($news['DATE_ACTIVE_SHOW']);?></span>
									</div>
								
								</div>
								<?if ($arParams['SHOW_HREF_PAGE_DETAIL']=="Y"){?>
								<a href="<?=$news['~DETAIL_PAGE_URL']?>" class="btn button-color btn-sm mb-3">
									<?=GetMessage('NAME_BTN');?></a>
								<?}?>
				      		</div>

						</div>
				      	<?
				      }?>
			</div>

			<?

			//Тут формируется пагинация. Выбираются номера страниц которые надо показать.
			if ($arResult['COUNT_PAGE']>1){
				if (($arResult['CURRENT_PAGE_NUMBER']-5)>0){
					$start=$arResult['CURRENT_PAGE_NUMBER']-4;
					$finish=$arResult['CURRENT_PAGE_NUMBER']+1;
					if ($finish>$arResult['COUNT_PAGE']){
						$finish=$arResult['COUNT_PAGE'];
					}
				}
				else{
					$start=1;
					if ($arResult['COUNT_PAGE']>5)
					{

						$finish=5;
					}
					else $finish=$arResult['COUNT_PAGE'];

				}
				?>

				<div class="row">
	                <ul class="col-12 col-md-12 pagination pagination--2 justify-content-center mt-3">
					<? for ($i=$start; $i <=$finish ; $i++) { ?>
						<li number="<?=$i?>" class=" visible-paginathion <? if ($arResult['CURRENT_PAGE_NUMBER']==$i) echo ('active');?>"><a href="?pg_number=<?=$i?>"><?=$i?></a></li>
					<?}?>

					<? for ($i=$finish+1; $i <=$arResult['COUNT_PAGE'] ; $i++) { ?>
						<li number="<?=$i?>" class=" hide-paginathion  <? if ($arResult['CURRENT_PAGE_NUMBER']==$i) echo ('active');?>"><a href="?pg_number=<?=$i?>"><?=$i?></a></li>
					<?}?>



					<?if (($arResult['COUNT_PAGE']>5)&($finish!=$arResult['COUNT_PAGE'])){?>
	                    <li class="next_pagination" curentLast="<?=$finish?>" allPage=<?=$arResult['COUNT_PAGE'];?>><svg class="bi bi-caret-right-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							  <path d="M12.14 8.753l-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
							</svg></li>
					<?}?>
	                </ul>
				</div>


				<?}?>
			
		</div>
      <?


    
?>