<?php

/**
 * Контроллер страницы информации о доставке и оплате
 * 
 */

// подключаем модели
include_once '../models/InfoModel.php';

/**
 * формирование страницы доставки
 * 
 * @param object $smarty шаблонизатор
 */
function indexAction($smarty){

    $smarty->assign('arInfo', getInfoHeadByUserGroup());
    $smarty->assign('articleInfo', getInfoArticleByUserGroup()['article_deliver']);
    $smarty->assign('pageTitle','Доставка и оплата');
    
    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'info');
    loadTemplate($smarty, 'footer');
} 
