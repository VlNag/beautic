<?php

/**
 * контроллер страницы категории (/category/1_2_3)
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

  //< расшифровка родительских категорий
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
   $catId = end($arCatTmp);
  //>

  //< получение текущей страницы и расчёт пагинатора
   $page = isset($_GET['page']) ? $_GET['page'] : 1;
   $page = intval($page);
   $page = ($page > 0) ? $page : 1;  

   $quanProduct = getNumberProductsFromParentUserGroup($catId); 
   //if($rsProducts){
   //$quanProduct = count($rsProducts);
   //} else {
   // $quanProduct = 0; 
   //}

   $quantityPerPage = $_SESSION['perpage'];
   
   $optionPerPage = array();
   $j = 0;
   for($i = 10; $i < 400; $i = $i * 2){
    $optionPerPage[$j]['value'] = $i;
    if ($i == $quantityPerPage){
      $optionPerPage[$j]['select'] = true;
    } else {
      $optionPerPage[$j]['select'] = false;
    }
    $j++;
   }
   $smarty->assign('optionPerPage',$optionPerPage);
   $quanPage = intval($quanProduct/$quantityPerPage);
  if ($quanProduct%$quantityPerPage) {
      $quanPage++; 
  }
  if ($page > $quanPage) {
      $page = $quanPage;
  }
  if ($quanPage > QUANTITY_PAGINATOR) {
      $step = intval(QUANTITY_PAGINATOR/2);
      $startPage = (($page - $step) > 0 ? ($page - $step) : 1);
      if (($startPage + QUANTITY_PAGINATOR - 1) > $quanPage){
          $endPage = $quanPage;
          $startPage = $endPage - QUANTITY_PAGINATOR + 1;
      } else {
          $endPage = $startPage + QUANTITY_PAGINATOR - 1;
      }
   } else {
      $startPage = 1;
      $endPage = $quanPage;
   }

   $startPosition = ($page-1) * $quantityPerPage;
   $rsProductsPage = getProductsFromParentUserGroup($catId, -1, $startPosition, $quantityPerPage, $imageDefProd);

   $user  = isset($_SESSION['user'] ) ? $_SESSION['user']  : null;
   //$userFields = getUser($user);
   if (isset($user['user_wishlist'])) {
     $bookmarks = $user['user_wishlist'];
   } else {
     $bookmarks = array();
   }
    if (isset($user['user_cart'])) {
        $userCart = $user['user_cart'];
    } else {
        $userCart = array();
    }

    foreach ($rsProductsPage as &$rsPoduct) {
    //if (empty($rsPoduct['image'])) {
    //  $rsPoduct['image']=$imageDefProd;
    // }
     $key = array_search($rsPoduct['productId'], array_column($bookmarks, 'product_id'));
     if($key!==false) {
      $rsPoduct['bookmarks']=true;
     } else {
      $rsPoduct['bookmarks']=false;
     }
        $key = array_search($rsPoduct['productId'], array_column($userCart, 'product_id'));
        if($key!==false) {
            $rsPoduct['inCart']=true;
        } else {
            $rsPoduct['inCart']=false;
        }
   }
   unset($rsPoduct);

   $paginator = array();
   $paginator['page'] = $page;
   $paginator['startPage'] = $startPage;
   $paginator['endPage'] = $endPage;
   $paginator['quanPage'] = $quanPage;
   $paginator['quanProduct'] = $quanProduct;

   $paginator['startPosition'] = $startPosition + 1;
   $paginator['endPosition'] = (($startPosition + $quantityPerPage) > $quanProduct) ? $quanProduct : ($startPosition + $quantityPerPage);
   $paginator['quanPaginator'] = QUANTITY_PAGINATOR;
   $paginator['quanPaginatorHalf'] = QUANTITY_PAGINATOR/2+1;
   $paginator['quanPaginatorEnd'] = $quanPage-QUANTITY_PAGINATOR/2;
   $postfix = substr($quanPage, -1);
   if (($quanPage < 10) || ($quanPage > 20)) {
    if ($postfix == 1) {
      $paginator['pageStr'] = 'страница';
    } elseif (($postfix == 2) || ($postfix == 3) || ($postfix == 4)) {
      $paginator['pageStr'] = 'страницы';
    } else {
      $paginator['pageStr'] = 'страниц';
    }
   } else {
   $paginator['pageStr'] = 'страниц';
   }
   $smarty->assign('paginator', $paginator);
   //>
   $userGroupCur = getCheckUserGroup(0, -1);
   if ( $userGroupCur == 4) {
      $smarty->assign('currency','т');
   } else {
      $smarty->assign('currency','руб');
   }

   $smarty->assign('arInfo', getInfoHeadByUserGroup());
   $smarty->assign('articleInfo', getInfoArticleByUserGroup()['article_main']);
   
   $rsCategories = getAllMainCatsWithChildrenUpd();
   $rsCategory = getCatFromIdUserGroup($catId);

   $smarty->assign('pageTitle',$rsCategory['name']);
   $smarty->assign('rsCategories',$rsCategories);

   $smarty->assign('rsCategory',$rsCategory);
   $smarty->assign('rsProductsPage',$rsProductsPage);
   $smarty->assign('cats',$cats);
   
   loadTemplate($smarty, 'header');
   loadTemplate($smarty, 'products');
   loadTemplate($smarty, 'footer');
}

function updateperpageAction() 
{
  $perpage = isset($_GET['perpage']) ? $_GET['perpage'] : QUANTITY_PER_PAGE;
  if (! isset($_SESSION['perpage'])){
    $_SESSION['perpage'] = $perpage;
  } else {
    $_SESSION['perpage'] = $perpage;
  }
  // запись в настройки пользователя
  $user = isset($_SESSION['user']) ? $_SESSION['user'] : NULL;
  if ($user) {
    updateSettings($user, $perpage, 'perpage');
  }
  $resData['success'] = 1;
  //} else{
  //    $resData['success'] = 0;
  //}

  echo json_encode($resData); 
}

function searchAction($smarty){

    global $imageDefProd;
    $userGroup  = $_SESSION['userGroup'] ?? 0;

    if ($userGroup == 0)  header('Location: '.$_SERVER['HTTP_REFERER']);

    if (isset($_REQUEST['search0'])) {
        /*if (!empty($_POST['search0'])) {
            $words = array_filter(explode(" ", $_POST['search0']));
        } else {
            $words = null;
        }*/
        $words  = $_REQUEST['search0'] ?? NULL;
        $words  = htmlspecialchars($words);

        if ($words) {
            $rsProducts = getProductsSearch($words, $imageDefProd);
            $quanProduct = count($rsProducts);

            if ($quanProduct > 0) {
                $smarty->assign('words',$words);
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $page = intval($page);
                $page = ($page > 0) ? $page : 1;
                $quantityPerPage = $_SESSION['perpage'];

                $optionPerPage = array();
                $j = 0;
                for($i = 10; $i < 400; $i = $i * 2){
                    $optionPerPage[$j]['value'] = $i;
                    if ($i == $quantityPerPage){
                        $optionPerPage[$j]['select'] = true;
                    } else {
                        $optionPerPage[$j]['select'] = false;
                    }
                    $j++;
                }
                $smarty->assign('optionPerPage',$optionPerPage);
                $quanPage = intval($quanProduct/$quantityPerPage);
                if ($quanProduct%$quantityPerPage) {
                    $quanPage++;
                }
                if ($page > $quanPage) {
                    $page = $quanPage;
                }
                if ($quanPage > QUANTITY_PAGINATOR) {
                    $step = intval(QUANTITY_PAGINATOR/2);
                    $startPage = (($page - $step) > 0 ? ($page - $step) : 1);
                    if (($startPage + QUANTITY_PAGINATOR - 1) > $quanPage){
                        $endPage = $quanPage;
                        $startPage = $endPage - QUANTITY_PAGINATOR + 1;
                    } else {
                        $endPage = $startPage + QUANTITY_PAGINATOR - 1;
                    }
                } else {
                    $startPage = 1;
                    $endPage = $quanPage;
                }

                $startPosition = ($page-1) * $quantityPerPage;
                $rsProductsPage = getProductsSearch($words, $imageDefProd, -1, $startPosition,
                                                    $quantityPerPage);

                $user  = isset($_SESSION['user'] ) ? $_SESSION['user']  : null;
                //$userFields = getUser($user);
                if (isset($user['user_wishlist'])) {
                    $bookmarks = $user['user_wishlist'];
                } else {
                    $bookmarks = array();
                }
                if (isset($user['user_cart'])) {
                    $userCart = $user['user_cart'];
                } else {
                    $userCart = array();
                }

                foreach ($rsProductsPage as &$rsPoduct) {
                    $key = array_search($rsPoduct['product_id'], array_column($bookmarks, 'product_id'));
                    $rsPoduct['link']=getLinkProduct($rsPoduct['product_id'], $rsPoduct['category_id']);

                    if($key!==false) {
                        $rsPoduct['bookmarks']=true;
                    } else {
                        $rsPoduct['bookmarks']=false;
                    }
                    $key = array_search($rsPoduct['product_id'], array_column($userCart, 'product_id'));
                    if($key!==false) {
                        $rsPoduct['inCart']=true;
                    } else {
                        $rsPoduct['inCart']=false;
                    }
                }
                unset($rsPoduct);
                //d($rsProductsPage);
                $paginator = array();
                $paginator['page'] = $page;
                $paginator['startPage'] = $startPage;
                $paginator['endPage'] = $endPage;
                $paginator['quanPage'] = $quanPage;
                $paginator['quanProduct'] = $quanProduct;

                $paginator['startPosition'] = $startPosition + 1;
                $paginator['endPosition'] = (($startPosition + $quantityPerPage) > $quanProduct) ?
                                                 $quanProduct : ($startPosition + $quantityPerPage);
                $paginator['quanPaginator'] = QUANTITY_PAGINATOR;
                $paginator['quanPaginatorHalf'] = QUANTITY_PAGINATOR/2+1;
                $paginator['quanPaginatorEnd'] = $quanPage-QUANTITY_PAGINATOR/2;
                $postfix = substr($quanPage, -1);
                if (($quanPage < 10) || ($quanPage > 20)) {
                    if ($postfix == 1) {
                        $paginator['pageStr'] = 'страница';
                    } elseif (($postfix == 2) || ($postfix == 3) || ($postfix == 4)) {
                        $paginator['pageStr'] = 'страницы';
                    } else {
                        $paginator['pageStr'] = 'страниц';
                    }
                } else {
                    $paginator['pageStr'] = 'страниц';
                }
                $smarty->assign('paginator', $paginator);
                //>
                $userGroupCur = getCheckUserGroup(0, -1);
                if ( $userGroupCur == 4) {
                    $smarty->assign('currency','т');
                } else {
                    $smarty->assign('currency','руб');
                }


                $smarty->assign('arInfo', getInfoHeadByUserGroup());
                $smarty->assign('articleInfo', getInfoArticleByUserGroup()['article_main']);

                $rsCategories = getAllMainCatsWithChildrenUpd();
                //$rsCategory = getCatFromIdUserGroup($catId);

                $smarty->assign('pageTitle','Поиск');
                $smarty->assign('rsCategories',$rsCategories);

                //$smarty->assign('rsCategory',$rsCategory);
                $smarty->assign('rsProductsPage',$rsProductsPage);
                //$smarty->assign('cats',$cats);

                //$smarty->assign('rsProducts', $rsProducts);
                //$smarty->assign('currency', '');
                //d($rsProducts);
                loadTemplate($smarty, 'header');
                loadTemplate($smarty, 'productssearch');
                loadTemplate($smarty, 'footer');
            } else {
                //header('Location: '.$_SERVER['HTTP_REFERER']);
                header('Location: /');
            }
        } else {
            //header('Location: '.$_SERVER['HTTP_REFERER']);
            header('Location: /');
        }
    //} elseif (isset($_POST['search1'])) {
        //  ???
    } else {
        //header('Location: '.$_SERVER['HTTP_REFERER']);
        header('Location: /');
    }
}

