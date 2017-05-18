<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($USER->isAuthorized()):?>
	<?if(defined("DEALER_USER")):?><span class="dealer_status" title="Вы можете видеть и покупать товары по оптовым ценам<?=DEALER_USER>0 ? " ; скидка к корзине ".DEALER_USER."%" : ""?>">Оптовик<?=DEALER_USER>0 ? " (".DEALER_USER."%)" : ""?></span> <?endif?>
	<?if(defined("JOINT_USER")):?><span class="dealer_status" title="Вы можете видеть и покупать товары по ценам для совместных покупок">Оптовик (физ.лицо)</span> <?endif?>
	<a rel="nofollow" href="/personal/">Личный кабинет</a> / <a rel="nofollow" href="<?echo $APPLICATION->GetCurPageParam("logout=yes", array("login", "logout", "register", "forgot_password", "change_password"));?>">Выйти</a>
<?else:?>
<a rel="nofollow" href="/reg/ooo.html" class="fancybox-reg">Регистрация</a> / <a rel="nofollow" id="auth_popup" class="fancybox-auth" href="/auth/?blank=Y&amp;backurl=<?=$APPLICATION->GetCurPageParam("", array("login", "logout", "register", "forgot_password", "change_password"));?>">Войти на сайт</a>
<?endif?>