<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($USER->isAuthorized()):?>
    <div class="user">
        <?if(defined("DEALER_USER")):?>
            <div class="user-status">
                <span class="dealer_status" title="Вы можете видеть и покупать товары по оптовым ценам<?=DEALER_USER>0 ? " ; скидка к корзине ".DEALER_USER."%" : ""?>">Оптовик<?=DEALER_USER>0 ? " (".DEALER_USER."%)" : ""?></span>
            </div>
        <?endif?>
        <?if(defined("JOINT_USER")):?>
            <div class="user-status">
                <span class="dealer_status" title="Вы можете видеть и покупать товары по ценам для физ.лиц">Оптовик (ф/л)</span>
            </div>
        <?endif?>

        <div class="user-name"><a rel="nofollow" href="/personal/">Личный кабинет</a></div>

        <div class="log-out"><a rel="nofollow" href="<?echo $APPLICATION->GetCurPageParam("logout=yes", array("login", "logout", "register", "forgot_password", "change_password"));?>">ВЫХОД</a></div>
    </div>
<?else:?>
    <div class="log-in"><span><a rel="nofollow" id="auth_popup" class="fancybox-auth" href="/auth/?blank=Y&amp;backurl=<?=$APPLICATION->GetCurPageParam("", array("login", "logout", "register", "forgot_password", "change_password"));?>">ВХОД</a><span> | </span><a rel="nofollow" href="/reg/ooo.html" class="fancybox-reg">РЕГИСТРАЦИЯ</a></span></div>
<?endif?>