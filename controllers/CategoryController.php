<?php

/**
 * контроллер страницы категории (/category/1_2_3)
 * 
 */

// подключаем модели
include_once '../models/CategoriesModel.php';
include_once '../models/ProductsModel.php';
include_once '../models/InfoModel.php';

/**
 * формирование страницы категории
 * 
 * @param object $smarty шаблонизатор
 */
function indexAction($smarty)
{
  global $imageDefCat;

  $userGroup  = isset($_SESSION['userGroup'] ) ? $_SESSION['userGroup']  : null;
  if ($userGroup == null) header('Location: /');

   $catStr = isset($_GET['id']) ? $_GET['id'] : null;
   if ($catStr == null) header('Location: /');
   $catsTmp = explode('_', $catStr);
   $cats = array();
   $i = 0;
   foreach ($catsTmp as $cat) {
      $cats[$i]['id'] = $cat;
      try {

        $cats[$i]['name'] = getCatFromIdUserGroup($cat)['name'];
      } catch (\Throwable $th) {
        $cats[$i]['name'] = '';
      }
     $i++;
    }
   $catId = end($catsTmp);
  
   $smarty->assign('arInfo', getInfoHeadByUserGroup());
   $smarty->assign('articleInfo', getInfoArticleByUserGroup()['article_main']);

   $rsCategories = getAllMainCatsWithChildrenUpd();

   $rsCategory = getCatFromIdUserGroup($catId);
   if (empty($rsCategory['image'])) {
    $rsCategory['image']='$imageDefCat';
   }

   $rsCategoriesChildren = getCatsFromParentUserGroup($catId);
 
   //$flagProduct = false;
   //if ($rsCategoriesChildren) {
   //   foreach ($rsCategoriesChildren as &$itemCategoriesChild) {
       // if (empty($itemCategoriesChild['image'])) {
       //   $itemCategoriesChild['image']=$rsCategory['image'];
        // }
         //if (getProductsFromParentUserGroup($itemCategoriesChild['categoryId'])) {
  //        if (checkLevelGroup($itemCategoriesChild['categoryId'])) {          
  //        $flagProduct = true;
  //        $itemCategoriesChild['flagProduct']=true;
  //      } else {
  //        $itemCategoriesChild['flagProduct']=false;
  //      }
  //    }
  //    unset($itemCategoriesChild);
  //  }

   $smarty->assign('pageTitle',$rsCategory['name']); 
   $smarty->assign('rsCategories',$rsCategories);

   $smarty->assign('rsCategory',$rsCategory);
   $smarty->assign('rsCategoriesChildren',$rsCategoriesChildren);
   $smarty->assign('cats',$cats);
   
   //$smarty->assign('flagProduct',$flagProduct);  
   
   loadTemplate($smarty, 'header');
   loadTemplate($smarty, 'category');
   loadTemplate($smarty, 'footer');
}
