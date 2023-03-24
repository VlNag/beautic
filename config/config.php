<?php

/**
 * файл настроек
 *
 */

//> константы для обращения к контроллеру
const PATH_PREFIX = '../controllers/';
const PATH_POSTFIX = 'Controller.php';

const QUANTITY_PER_PAGE = 10;
const QUANTITY_PAGINATOR = 5;
//<

const DEFOLT_STEP = 1000;
const REST_KEY = '12345';

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

$website = 'http://beauticOS.local';
$mailAdmin = 'bob_140@ngs.ru';

//> используемые шаблоны
$template = 'default';
//$template = 'texture';
$templateAdmin = 'admin';

// пути к файлам шаблонов (*.tpl)
define('TEMPLATE_PREFIX', "../views/$template/");
define('TEMPLATE_ADMIN_PREFIX', "../views/$templateAdmin/");

const TEMPLATE_POSTFIX = '.tpl';

// пути к файлам шаблонов в вебпространстве
define('TEMPLATE_WEB_PATH', "/templates/$template/");
define('TEMPLATE_ADMIN_WEB_PATH', "/templates/$templateAdmin/");
//<

//> инициализация шаблона смарти
// put full path to Smarty.class.php
require '../library/smarty/libs/Smarty.class.php';
$smarty = new Smarty();

$smarty->setTemplateDir(template_dir: TEMPLATE_PREFIX);
$smarty->setCompileDir(compile_dir: '../tmp/smarty/templates_c');
$smarty->setCacheDir(cache_dir: '../tmp/smarty/cashe');
$smarty->setConfigDir(config_dir: '../library/Smarty/config');

$smarty->assign(tpl_var: 'templateWebPath', value: TEMPLATE_WEB_PATH);
