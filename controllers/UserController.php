<?php

/**
 * Контроллер страницы информации о пользователе
 * 
 */

// подключаем модели
include_once '../models/UsersModel.php';
include_once '../models/InfoModel.php';
include_once '../models/ProductsModel.php';
include_once '../models/CategoriesModel.php';

/**
 * формирование страницы доставки
 * 
 * @param object $smarty шаблонизатор
 */
function indexAction($smarty){
    

    $smarty->assign('arInfo', getInfoHeadByUserGroup());
    //$smarty->assign('user', getUser($fieldRequest));
    $smarty->assign('pageTitle','Личный кабинет');
    
    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'user');
    loadTemplate($smarty, 'footer');
}

function accountAction($smarty){
  $user  = isset($_SESSION['user'] ) ? $_SESSION['user']  : null;
  if ($user == null) header('Location: /');

    $smarty->assign('arInfo', getInfoHeadByUserGroup());
    $smarty->assign('pageTitle','Учётная запись');
    
    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'account');
    loadTemplate($smarty, 'footer');
} 

function contactsAction($smarty){
  $user  = isset($_SESSION['user'] ) ? $_SESSION['user']  : null;
  if ($user == null) header('Location: /');

    $userField = getUser(array('user_id' => $user['user_id']));
    /* сортировка многомерного массива
    $em = $userField['email'];
    foreach ($em as $key => $row) {
      $number_contact[$key]  = $row['number_contact'];
   }
    //$number_contact  = array_column($em, 'number_contact');
    array_multisort($number_contact, SORT_DESC, $em);

    d($em);
    
   if (isset($userField['email'])) { 
   $email = $userField['email'];
   if (!$email) {
    $email[] = array('content' => '', 'comment' => '');
   }
  } else {
    $email[] = array('content' => '', 'comment' => '');
  }
  if (isset($userField['phone'])) { 
   $phone = $userField['phone'];
   if (!$phone) {
    $phone[] = array('content' => '', 'comment' => '', 'view_contact' => '');
   }
  } else {
    $phone[] = array('content' => '', 'comment' => '', 'view_contact' => '');
  }
  if (isset($userField['address'])) { 
   $address = $userField['address'];
   if (!$address) {
    $address[] = array('content' => '', 'comment' => '', 'view_contact' => '');
   }
  } else {
    $address[] = array('content' => '', 'comment' => '', 'view_contact' => '');
  }
  */
  $email = (isset($userField['email'])) ? $userField['email'] : NULL;
  $phone = (isset($userField['phone'])) ? $userField['phone'] : NULL;
  if ($phone) {
    foreach($phone as &$hone) {
      $hone['content'] = formatTel($hone['content']);
    }
    unset($hone);
  }
  $address = (isset($userField['address'])) ? $userField['address'] : NULL;
  
  $typeContacts = array(
                        array('name'   => 'Мобильный',
                              'value'  => 'mobil', 
                              'option' => '1'),
                        array('name'   => 'Домашний', 
                              'value'  => 'home', 
                              'option' => ''),
                        array('name'   => 'Рабочий', 
                              'value'  => 'work', 
                              'option' => ''),
                        array('name'   => 'Транспортная компания', 
                              'value'  => 'trcom', 
                              'option' => '2'));

    $smarty->assign('email', $email);
    $smarty->assign('phone', $phone);
    $smarty->assign('address', $address);

    $smarty->assign('typeContacts', $typeContacts);

    $smarty->assign('arInfo', getInfoHeadByUserGroup());
    $smarty->assign('pageTitle','Контакты');
      
    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'contacts');
    loadTemplate($smarty, 'footer');
} 

function changepassAction($smarty){
  $user  = isset($_SESSION['user'] ) ? $_SESSION['user']  : null;
  if ($user == null) header('Location: /');
  
    $smarty->assign('arInfo', getInfoHeadByUserGroup());
    $smarty->assign('pageTitle','Смена пароля');
    
    
    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'changepass');
    loadTemplate($smarty, 'footer');
} 

function bookmarksAction($smarty){
  global $imageDefProd;
    $user  = isset($_SESSION['user'] ) ? $_SESSION['user']  : null;
    if ($user == null) header('Location: /');

    $userGroupCur = getCheckUserGroup(0, -1);
    if ( $userGroupCur == 4) {
       $smarty->assign('currency','т');
    } else {
       $smarty->assign('currency','руб');
    }

    //$userFields = getUser($user);
    if (isset($user['user_wishlist'])) {
      $bookmarks = $user['user_wishlist'];
    } else {
      $bookmarks = array();
    }
    foreach ($bookmarks as &$mark) {
        $productId = $mark['product_id']; 
        $product = getProductFromIdUserGroup($productId);
        $mark['name'] = isset($product['name']) ? $product['name'] : '';
        $mark['price'] = isset($product['price']) ? $product['price'] : '';
        $mark['image'] = empty($product['image']) ? ($imageDefProd) : $product['image'];
        $mark['bookmarks'] = true;
        $mark['inCart'] = true;
    }
    $rsCategories = getAllMainCatsWithChildrenUpd(); 
    $smarty->assign('rsCategories',$rsCategories);

    $smarty->assign('bookmarks',$bookmarks);
    $smarty->assign('arInfo', getInfoHeadByUserGroup());
    $smarty->assign('pageTitle','Закладки');
    
    
    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'bookmarks');
    loadTemplate($smarty, 'footer');
} 

function ordersAction($smarty){
  $user  = isset($_SESSION['user'] ) ? $_SESSION['user']  : null;
  if ($user == null) header('Location: /');
  
    $smarty->assign('arInfo', getInfoHeadByUserGroup());
    $smarty->assign('pageTitle','Заказы');
    
    
    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'orders');
    loadTemplate($smarty, 'footer');
} 

function forgotpassAction($smarty){
  //$user  = isset($_SESSION['user'] ) ? $_SESSION['user']  : null;
  //if ($user == null) header('Location: /');
  
    $smarty->assign('arInfo', getInfoHeadByUserGroup());
    $smarty->assign('pageTitle','Забыли пароль?');
    
    
    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'forgotpass');
    loadTemplate($smarty, 'footer');
} 

function updatepassAction($smarty){
    $token  = isset($_GET['token'] ) ? $_GET['token']  : null;
    $res = checkTokenUser($token);
    if ($res['result']) {
      $smarty->assign('userId',$res['userId']);
      $smarty->assign('login',$res['login']);
    } else {
      $smarty->assign('userId',0);
    }

    $smarty->assign('arInfo', getInfoHeadByUserGroup());
    $smarty->assign('pageTitle','Обновить пароль');
        
    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'updatepass');
    loadTemplate($smarty, 'footer');
}

function supportAction($smarty): void
{
    $user = $_SESSION['user'] ?? null;
    $user_id = $user['user_id'] ?? 0;

    $token  = $_GET['token'] ?? null;
    $allDialog = getAllDialog($user_id);
    $dialog = getDialog($token);

    if ((!$dialog['success'])||($dialog['user_id'] != $user_id)) {
        if ($allDialog) {
            foreach($allDialog as $dialogCur) {
               if ($dialogCur['status'] == 1) {
                   $dialog = getDialog($dialogCur['token']);
                   if ($dialog['success']) {
                       break;
                   }
                }
            }
        }
        if (!$dialog['success']) {
            $dialog['status'] = 1;
            $dialog['token'] = null;
            $dialog['content'] = null;
            $dialog['support_id'] = 0;
            $dialog['name'] = '';
            $dialog['email'] = '';
            $dialog['user_id'] = 0;

            if ($user) {
                $dialog['user_id'] = $user_id;
                $dialog['name'] = $user['user_name'] ?? $user['login'];
                $emails = getContact($dialog['user_id'], 'email');
                $dialog['email'] = $emails[0]['content'] ?? '';
            }
        }
    }
    $smarty->assign('dialog',$dialog);
    $smarty->assign('allDialog',$allDialog);

    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'support');
    loadTemplate($smarty, 'footer');
}