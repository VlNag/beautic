<?php

/**
 * Контроллер главной страницы
 *
 */

// подключаем модели
include_once '../models/CategoriesModel.php';
include_once '../models/ProductsModel.php';
include_once '../models/InfoModel.php';
include_once '../models/UsersModel.php';
/**
 * формирование главной страницы сайта
 *
 * @param object $smarty шаблонизатор
 */
function indexAction($smarty)
{

    $smarty->assign('arInfo', getInfoHeadByUserGroup());
    $smarty->assign('articleInfo', getInfoArticleByUserGroup()['article_main']);
    //writeInFile('getAllMainCatsWithChildren start ' . date("Y-m-d H:i:s")); //****************** */
    $rsCategories = getAllMainCatsWithChildrenUpd();
    /*if (!isset($_SESSION['allMainCatsWithChildren'])) {
        $rsCategories = getAllMainCatsWithChildren();
        $_SESSION['allMainCatsWithChildren'] = $rsCategories;
        $_SESSION['timeUpdate'] = time();
    } else {
        $timeUpdate = isset($_SESSION['timeUpdate']) ? $_SESSION['timeUpdate'] : 0;
        $timeCategoryUpdate = getCategoryUpdate();
        if ($timeUpdate <= $timeCategoryUpdate) {
            $rsCategories = getAllMainCatsWithChildren();
            $_SESSION['allMainCatsWithChildren'] = $rsCategories;
            $_SESSION['timeUpdate'] = time();
        } else {
            $rsCategories = $_SESSION['allMainCatsWithChildren'];
        }
    }*/

    //$rsCategories = getAllMainCatsWithChildren();
    //writeInFile('getAllMainCatsWithChildren finish ' . date("Y-m-d H:i:s")); //****************** */
    $smarty->assign('pageTitle', 'Beautic');
    $smarty->assign('rsCategories', $rsCategories);

    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'main');
    loadTemplate($smarty, 'footer');
}

function updatethemeAction()
{
    $theme = isset($_GET['theme']) ? $_GET['theme'] : 'light';
    $_SESSION['theme'] = $theme;

    // запись в настройки пользователя
    $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
    if ($user) {
        updateSettings($user, $theme, 'theme');
    }
    //echo $_SESSION['theme'];
    $resData['success'] = 1;
    //} else{
    //    $resData['success'] = 0;
    //}

    echo json_encode($resData);
}

function updatelayoutAction()
{
    $theme = isset($_GET['layout']) ? $_GET['layout'] : 'rows';
    $_SESSION['layout'] = $theme;

    // запись в настройки пользователя
    $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
    if ($user) {
        updateSettings($user, $theme, 'layout');
    }

    //echo $_SESSION['layout'];
    $resData['success'] = 1;
    //} else{
    //    $resData['success'] = 0;
    //}

    echo json_encode($resData);
}

function updatecategoryAction()
{
    $fileNum = isset($_POST['fileNum']) ? $_POST['fileNum'] : 1;
    $iterationNum = isset($_POST['iterationNum']) ? $_POST['iterationNum'] : 0;
    $step = isset($_POST['step']) ? $_POST['step'] : 400;
    $successful = isset($_POST['successful']) ? $_POST['successful'] : 1;
    $key = isset($_POST['key']) ? $_POST['key'] : null;
    $updateEverything = isset($_POST['updateEverything']) ? $_POST['updateEverything'] : 'NO';
    //error_reporting(0); //отключение ошибок
    if ($key == REST_KEY) {
        $resData = updateCategoriesFromFilesByStep($fileNum, $iterationNum, $step,
            $successful, $updateEverything);
        $resData['pass'] = true;
    } else {
        $resData['pass'] = false;
    }
    echo json_encode($resData);
}

function updateproductsAction()
{
    $fileNum = isset($_POST['fileNum']) ? $_POST['fileNum'] : 1;
    $iterationNum = isset($_POST['iterationNum']) ? $_POST['iterationNum'] : 0;
    $step = isset($_POST['step']) ? $_POST['step'] : 400;
    $successful = isset($_POST['successful']) ? $_POST['successful'] : 1;
    $key = isset($_POST['key']) ? $_POST['key'] : null;
    $updateEverything = isset($_POST['updateEverything']) ? $_POST['updateEverything'] : 'NO';
    //error_reporting(0); //отключение ошибок
    if ($key == REST_KEY) {
        $resData = updateProductsFromFilesByStep($fileNum, $iterationNum, $step,
            $successful, $updateEverything);
        $resData['pass'] = true;
    } else {
        $resData['pass'] = false;
    }
    echo json_encode($resData);
}

function updAction()
{
    if (isset($_SESSION['message'])) {
        unset($_SESSION['message']);
    }

    $resData['success'] = 1;
    //} else{
    //    $resData['success'] = 0;
    //}

    //header('Location: /');
    //echo json_encode($resData);
}
