<?php

include_once '../library/mainFunctions.php'; // основные функции
include_once '../config/config.php'; // инициализация настроек
include_once '../config/db.php'; // инициализация базы данных

include_once '../models/UsersModel.php';
include_once '../models/CategoriesModel.php';

if(session_status() === PHP_SESSION_NONE) session_start();// стартуем сессию
//если в сессии есть данные об авторизированном пользователе то проверяем сессию и передаём в шаблон
if (isset($_SESSION['user'])) {
    if (isset($_SESSION['user']['user_id'])) {
        $user_id = $_SESSION['user']['user_id'];
        $session = getSession($user_id, session_id());
        if ($session) {
            if ($session['active']){
                $sessionModTime =getTimeSessionModification($user_id, session_id());
                if ($session['date_update'] <= $sessionModTime) { // обновляем сессионные данные

                    $user = getUserForUpdateSession($user_id);
                    $_SESSION['discount'] = max(floatval($user['discount']) ?? 0,
                                              floatval($_SESSION['discount']) ?? 0);
                    $_SESSION['userGroup'] = $user['user_group'];
                    $_SESSION['user'] = $user;

                    $rsCategories = getAllMainCatsWithChildren();
                    $_SESSION['allMainCatsWithChildren'] = $rsCategories;
                    $_SESSION['timeUpdate'] = time();
            
                    $settings = $user['settings'];
                    $settings = json_decode($settings, true);
                    if (is_array($settings)) {
                        $settingses = array('theme', 'layout', 'perpage');
                        foreach ($settingses as $sett) {
                            if (array_key_exists($sett, $settings)) {
                                $_SESSION[$sett] = $settings[$sett];
                            }
                        }
                    }
                    updateSession($user_id, session_id(), $_SERVER["HTTP_USER_AGENT"], time(), 1, getIp());
                }
                /** @var object $smarty */
                $smarty->assign('arUser', $_SESSION['user']);
            } else {
                session_destroy();
                header('Location: /');
            }
        } else {
            session_destroy();
            header('Location: /');
        }
    }
}
$_SESSION['id'] = session_id();
//d($_SESSION['user']);
// если в сессии нет информации о группе пользователя то создаём её
if (!isset($_SESSION['userGroup'])) {
    $_SESSION['userGroup'] = 0;
}



// если в сессии не задана тема то light
if (!isset($_SESSION['theme'])) {
    $_SESSION['theme'] = 'light';
}
$smarty->assign('theme', $_SESSION['theme']);

// если в сессии не задана раскладка товаров то rows
if (!isset($_SESSION['layout'])) {
    $_SESSION['layout'] = 'rows';
}
$smarty->assign('layout', $_SESSION['layout']);

// если в сессии нет количества на странице то создаём её
if (!isset($_SESSION['perpage'])) {
    $_SESSION['perpage'] = QUANTITY_PER_PAGE;
}

// если в сессии есть сообщение, то передаём в шаблон 
if (isset($_SESSION['message'])) {
    $smarty->assign('message', $_SESSION['message']);
}

// если в сессии нет времени обновления то создаём её и пишем тек время
//if (!isset($_SESSION['timeUpdate'])) {
//    $_SESSION['timeUpdate'] = time();
//}

// если в сессии нет массива корзины то создаём её
//if (! isset($_SESSION['cart'])){
//    $_SESSION['cart'] = array();
//}
// инициализируем переменную шаблонизатора количества элементов в корзине
//$smarty->assign('cartCntItems',count($_SESSION['cart']));

// определяем контроллер
$controllerName = isset($_GET['controller']) ? ucfirst(strtolower($_GET['controller'])) : 'Index';

// определяем функцию
$actionName = isset($_GET['action']) ? ucfirst(strtolower($_GET['action'])) : 'Index';

loadPage($smarty, $controllerName, $actionName);
