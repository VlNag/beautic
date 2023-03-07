<?php

/**
 * файл настроек
 *
 */

//> константы для обращения к контроллеру
define('PATH_PREFIX', '../controllers/');
define('PATH_POSTFIX', 'Controller.php');

define('QUANTITY_PER_PAGE', 10);
define('QUANTITY_PAGINATOR', 5);
//<

define('DEFOLT_STEP', 1000);
define('REST_KEY', '12345');

$userGroupSt = array('1', '4');
$userGroupMd = array('1', '2', '4');
$userGroupLg = array('1', '2', '3', '4');

//> картинки по умолчанию
$imageDefCat = '0.jpg'; // 260 x 260
$imageDefProd = '0.jpg'; // 260 x 260, md -340 x 340, lg - 800 x 800
//<

$lgLen = 50;
$mdLen = 30;
$smLen = 20;

$website = 'http://beautic.local';
$mailAdmin = 'bob_140@ngs.ru';

//> используемые шаблоны
$template = 'default';
//$template = 'texturia';
$templateAdmin = 'admin';

// пути к файлам шаблонов (*.tpl)
define('TEMPLATE_PREFIX', "../views/{$template}/");
define('TEMPLATE_ADMIN_PREFIX', "../views/{$templateAdmin}/");

define('TEMPLATE_POSTFIX', '.tpl');

// пути к файлам шаблонов в вебпространстве
define('TEMPLATE_WEB_PATH', "/templates/{$template}/");
define('TEMPLATE_ADMIN_WEB_PATH', "/templates/{$templateAdmin}/");
//<

//> инициализация шаблона смарти
// put full path to Smarty.class.php
require '../library/smarty/libs/Smarty.class.php';
$smarty = new Smarty();

$smarty->setTemplateDir(TEMPLATE_PREFIX);
$smarty->setCompileDir('../tmp/smarty/templates_c');
$smarty->setCacheDir('../tmp/smarty/cashe');
$smarty->setConfigDir('../library/Smarty/config');

$smarty->assign('templateWebPath', TEMPLATE_WEB_PATH);
