<?php

/**
 * контроллер страницы товара (/product/1_2_3/12345)
 * 
 */

// подключаем модели
include_once '../models/CategoriesModel.php';
include_once '../models/ProductsModel.php';
include_once '../models/InfoModel.php';
include_once '../models/UsersModel.php';
/**
 * формирование страницы категории
 * 
 * @param object $smarty шаблонизатор
 */
function indexAction($smarty)
{
  global $imageDefProd;
  $userGroup  = isset($_SESSION['userGroup'] ) ? $_SESSION['userGroup']  : null;
  if ($userGroup == null) header('Location: /');

   $catStr = isset($_GET['id']) ? $_GET['id'] : null;
   if ($catStr == null) header('Location: /');
   $arCatTmp = explode('_', $catStr);
   $cats = array();
   $i = 0;
   foreach ($arCatTmp as $cat) {
      $cats[$i]['id'] = $cat;
      try {
        $cats[$i]['name'] = getCatFromIdUserGroup($cat)['name'];
      } catch (\Throwable $th) {
        $cats[$i]['name'] = '';
      }
     $i++;
    }
   //$catId = end($arCatTmp);

   $productId = isset($_GET['product']) ? $_GET['product'] : null;
   
   $smarty->assign('arInfo', getInfoHeadByUserGroup());
   $smarty->assign('articleInfo', getInfoArticleByUserGroup()['article_main']);
   
   $rsCategories = getAllMainCatsWithChildrenUpd();
   $rsProduct = getProductFromIdUserGroup($productId);
   $rsProduct['productId'] = $productId;
   if (empty($rsProduct['image'])) {
    $rsProduct['image'] = $imageDefProd;
   }

   $user  = isset($_SESSION['user'] ) ? $_SESSION['user']  : null;
   //$userFields = getUser($user);
   if (isset($user['user_wishlist'])) {
     $bookmarks = $user['user_wishlist'];
   } else {
     $bookmarks = array();
   }
   $flMark = false;
   foreach ($bookmarks as $marks) {
    if (array_key_exists('product_id',$marks)) {
      if ($productId == $marks['product_id']) {
          $flMark = true;
      }
     }
   }
   $rsProduct['bookmarks']=$flMark;

   if (isset($user['user_cart'])) {
       $userCart = $user['user_cart'];
   } else {
       $userCart = array();
   }
   $flMark = false;
   foreach ($userCart as $marks) {
       if (array_key_exists('product_id', $marks)) {
           if ($productId == $marks['product_id']) {
               $flMark = true;
           }
       }
   }
   $rsProduct['inCart']=$flMark;
   
   $smarty->assign('pageTitle',$rsProduct['name']);
   $smarty->assign('rsCategories',$rsCategories);

   $smarty->assign('rsProduct',$rsProduct);
   $smarty->assign('cats',$cats);
   
   loadTemplate($smarty, 'header');
   loadTemplate($smarty, 'product');
   loadTemplate($smarty, 'footer');
}
