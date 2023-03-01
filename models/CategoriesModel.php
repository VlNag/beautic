<?php

include_once '../models/UsersModel.php';

/**
 * create SQL request for update and add categories
 *
 * @param string $fileName file for loading 
 * @param integer $fileType type of file : 1 - new, 2 - current, 3 - old 
 * @return array of sql request
 */
function createRequestForLoadCategoriesFromFile($xmlCategories, $fileType,
                                    $start, $step = DEFOLT_STEP, $updateEverything = 'N')
{
    $requestCategory = '';
    $requestCategoryDescription = '';
    $requestCategoryActive = '';
    $requestCategoryOrder = '';
    if ($updateEverything == 'Y') {
        $upd = true;
    } else {
        $upd = false;
    }
    for ($i = $start; $i < ($start + $step); $i++) {
        if ($i<count($xmlCategories)) {
        $category = $xmlCategories[$i];
        $categoryId = intval($category['category_id']['value']);
        if ($categoryId) {
        $name = transformStr($category['name']['value']);
            if ($fileType == 1) {
                $description = transformStr($category['description']['value']);
                $descriptionKz = transformStr($category['description_kz']['value']);
                $metaDescription = transformStr($category['meta_description']['value']);
                $metaDescriptionKz = transformStr($category['meta_description_kz']['value']);
                $metaKeywords = transformStr($category['meta_keywords']['value']);
                $metaKeywordsKz = transformStr($category['meta_keywords_kz']['value']);
                $description = htmlentities(trim($description), 
                                            ENT_QUOTES | ENT_IGNORE, "UTF-8");
                $descriptionKz = htmlentities(trim($descriptionKz), 
                                           ENT_QUOTES | ENT_IGNORE, "UTF-8");
                $metaDescription = htmlentities(trim($metaDescription), 
                                           ENT_QUOTES | ENT_IGNORE, "UTF-8");
                $metaDescriptionKz = htmlentities(trim($metaDescriptionKz), 
                                          ENT_QUOTES | ENT_IGNORE, "UTF-8");               
                $metaKeywords = htmlentities(trim($metaKeywords), 
                                          ENT_QUOTES | ENT_IGNORE, "UTF-8");
                $metaKeywordsKz = htmlentities(trim($metaKeywordsKz), 
                                         ENT_QUOTES | ENT_IGNORE, "UTF-8");

                $requestCategory .= "('$categoryId', '" . $category["parent_id"]["value"] . 
                                    "','" . $category["image_name"]["value"] . "', '" . 
                                    $category['sort_order']['value'] . "',NOW()),";
                $requestCategoryDescription .= "('$categoryId', '1', '$name', 
                                    '$description', '$metaDescription', '$metaKeywords'),";
                $requestCategoryDescription .= "('$categoryId', '4', '$name', 
                                    '$descriptionKz','$metaDescriptionKz', '$metaKeywordsKz'),";
                $requestCategoryActive .= "('$categoryId', '1', '" . 
                                             $category['quantity']['value']."'),";
                $requestCategoryActive .= "('$categoryId', '2', '" . 
                                             $category['quantity_sm']['value']."'),";
                $requestCategoryActive .= "('$categoryId', '4', '" . 
                                             $category['quantity_kz']['value']."'),";

                $requestCategoryOrder .= "('$categoryId', '1', '" . 
                                             $category['sort_order']['value']."'),";
                $requestCategoryOrder .= "('$categoryId', '2', '" . 
                                             $category['sort_order_sm']['value']."'),";
                $requestCategoryOrder .= "('$categoryId', '4', '" . 
                                             $category['sort_order_kz']['value']."'),";

            }
            elseif ($fileType == 2) {
                $description = transformStr($category['description']['value']);
                $descriptionKz = transformStr($category['description_kz']['value']);
                $metaDescription = transformStr($category['meta_description']['value']);
                $metaDescriptionKz = transformStr($category['meta_description_kz']['value']);
                $metaKeywords = transformStr($category['meta_keywords']['value']);
                $metaKeywordsKz = transformStr($category['meta_keywords_kz']['value']);
                $description = htmlentities(trim($description), 
                                            ENT_QUOTES | ENT_IGNORE, "UTF-8");
                $descriptionKz = htmlentities(trim($descriptionKz), 
                                           ENT_QUOTES | ENT_IGNORE, "UTF-8");
                $metaDescription = htmlentities(trim($metaDescription), 
                                           ENT_QUOTES | ENT_IGNORE, "UTF-8");
                $metaDescriptionKz = htmlentities(trim($metaDescriptionKz), 
                                          ENT_QUOTES | ENT_IGNORE, "UTF-8");               
                $metaKeywords = htmlentities(trim($metaKeywords), 
                                          ENT_QUOTES | ENT_IGNORE, "UTF-8");
                $metaKeywordsKz = htmlentities(trim($metaKeywordsKz), 
                                         ENT_QUOTES | ENT_IGNORE, "UTF-8");

                if ((checkAttribut($category, 'parent_id')) || 
                    (checkAttribut($category, 'image_name')) || $upd) {  
                            $requestCategory .= "('$categoryId', '" . $category["parent_id"]["value"] . 
                                "','" . $category["image_name"]["value"] . "', '" . 
                                $category['sort_order']['value'] . "',NOW()),";
                }
                if (checkAttribut($category, 'name') || $upd) {
                    $requestCategoryDescription .= "('$categoryId', '1', '$name', 
                            '$description', '$metaDescription', '$metaKeywords',NOW()),";
                    $requestCategoryDescription .= "('$categoryId', '4', '$name', 
                            '$descriptionKz','$metaDescriptionKz', '$metaKeywordsKz',NOW()),";
                } else {
                    if ((checkAttribut($category, 'description')) || 
                        (checkAttribut($category, 'meta_description')) ||
                        (checkAttribut($category, 'meta_keywords'))){
                            $requestCategoryDescription .= "('$categoryId', '1', '$name', 
                                  '$description', '$metaDescription', '$metaKeywords',NOW()),";
                    }
                    if ((checkAttribut($category, 'description_kz')) || 
                        (checkAttribut($category, 'meta_description_kz')) ||
                        (checkAttribut($category, 'meta_keywords_kz'))){
                        $requestCategoryDescription .= "('$categoryId', '4', '$name', 
                            '$descriptionKz','$metaDescriptionKz', '$metaKeywordsKz',NOW()),";
                    }
                }
                if (checkAttribut($category, 'quantity') || $upd) {
                    $requestCategoryActive .= "('$categoryId', '1', '" . 
                                                 $category["quantity"]["value"] . "',NOW()),";
                } 
                if (checkAttribut($category, 'quantity_sm') || $upd) {
                    $requestCategoryActive .= "('$categoryId', '2', '" . 
                                                 $category["quantity_sm"]["value"] . "',NOW()),";
                } 
                if (checkAttribut($category, 'quantity_kz') || $upd) {
                    $requestCategoryActive .= "('$categoryId', '4', '" . 
                                                 $category["quantity_kz"]["value"] . "',NOW()),";
                } 
                if (checkAttribut($category, 'sort_order') || $upd) {
                    $requestCategoryOrder .= "('$categoryId', '1', '" . 
                                                 $category["sort_order"]["value"] . "',NOW()),";
                } 
                if (checkAttribut($category, 'sort_order_sm') || $upd) {
                    $requestCategoryOrder .= "('$categoryId', '2', '" . 
                                                 $category["sort_order_sm"]["value"] . "',NOW()),";
                } 
                if (checkAttribut($category, 'sort_order_kz') || $upd) {
                    $requestCategoryOrder .= "('$categoryId', '4', '" . 
                                                 $category["sort_order_kz"]["value"] . "',NOW()),";
                } 
            } elseif ($fileType == 3) {
                if (checkAttribut($category, 'quantity') || $upd) {
                    $requestCategoryActive .= "('$categoryId', '1', '" . 
                                                 $category["quantity"]["value"] . "',NOW()),";
                } 
                if (checkAttribut($category, 'quantity_sm') || $upd) {
                    $requestCategoryActive .= "('$categoryId', '2', '" . 
                                                 $category["quantity_sm"]["value"] . "',NOW()),";
                } 
                if (checkAttribut($category, 'quantity_kz') || $upd) {
                    $requestCategoryActive .= "('$categoryId', '4', '" . 
                                                 $category["quantity_kz"]["value"] . "',NOW()),";
                } 
            } 
        }
    }
 }
    $requests = array();
    $requests['requestCategory'] = commaDel($requestCategory, ',');
    $requests['requestCategoryDescription'] = commaDel($requestCategoryDescription, ',');
    $requests['requestCategoryActive'] = commaDel($requestCategoryActive, ',');
    $requests['requestCategoryOrder'] = commaDel($requestCategoryOrder, ',');
   return $requests;
}

function updateCategories($requests, $nameField, $sqlStart, $sqlEnd = '')
{
    global $db;
    $rs = true;
    $sqlFilds = $requests[$nameField];
    if ($sqlFilds) {
        $sql = $sqlStart . $sqlFilds . $sqlEnd;
        //echo $sql . '<br />';
        try {
            $rs = mysqli_query($db, $sql);
        }
        catch (Exception $e) {
            $rs = false;
            //echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
            //echo '</br>';
        }
    }
    return $rs;
}

function updateCategoriesFromFilesByStep($fileNum, $iterationNum, 
                                $step, $successful, $updateEverything = 'N')
{
    $result = array(); 
    $totalQuantity = 0;
    $rs = true;
    $file = $_SERVER["DOCUMENT_ROOT"] . '/xml/import/category';
    if ($fileNum == 1) {
        $file .= '_new.xml';
    } elseif ($fileNum == 2) {
        $file .= '_cur.xml';
    } elseif ($fileNum == 3) {
        $file .= '_old.xml';
    }
    if (file_exists($file)) {
        $xmlCategoriesTmp = simplexml_load_file($file);
        $xmlCategories = xmlToArray($xmlCategoriesTmp);
        if (array_key_exists("Category", $xmlCategories["Categories"])) {
            $xmlCategories = $xmlCategories["Categories"]["Category"];
         } else {
             $xmlCategories = array();  
         }
         $totalQuantity = count($xmlCategories); 
        if ($step*$iterationNum < $totalQuantity) {
        $requests = createRequestForLoadCategoriesFromFile($xmlCategories, $fileNum,
                                          $iterationNum * $step, $step, $updateEverything);
        if ($fileNum == 1) {
            $dateM = 'added';
        } else {
            $dateM = 'modified';
        }  
        $res = updateCategories($requests, 'requestCategory', 
                        "INSERT INTO bt_category(`category_id`, `parent_id`, `image`, `sort_order`, `date_$dateM`) VALUES ",
                        " ON DUPLICATE KEY UPDATE `parent_id`=VALUES(`parent_id`), 
                        `image`=VALUES(`image`), `sort_order`=VALUES(`sort_order`), 
                        `date_$dateM`=VALUES(`date_$dateM`)");  
        $rs = $rs && $res;
        if ($fileNum == 1) {
            $dateM1 = '';
            $dateM2 = '';
        } else {
            $dateM1 = ', `date_modified`';
            $dateM2 = ', `date_modified`=VALUES(`date_modified`)';
        }  
        $res = updateCategories($requests, 'requestCategoryDescription', 
                        "INSERT INTO bt_category_description
                               (`category_id`, `user_group`, `name`, `description`,
                                `meta_description`, `meta_keyword`$dateM1) VALUES ",
                        " ON DUPLICATE KEY UPDATE `name`=VALUES(`name`), 
                            `description`=VALUES(`description`), 
                            `meta_description`=VALUES(`meta_description`), 
                            `meta_keyword`=VALUES(`meta_keyword`)$dateM2");  
        $rs = $rs && $res; 
        $res = updateCategories($requests, 'requestCategoryActive', 
                               "INSERT INTO bt_category_is_active
                               (`category_id`, `user_group`, `active`$dateM1) VALUES ",
                        " ON DUPLICATE KEY UPDATE `active`=VALUES(`active`)$dateM2");  
        $rs = $rs && $res;
        $res = updateCategories($requests, 'requestCategoryOrder', 
                               "INSERT INTO bt_category_order
                               (`category_id`, `user_group`, `sort_order`$dateM1) VALUES ",
                        " ON DUPLICATE KEY UPDATE `sort_order`=VALUES(`sort_order`)$dateM2");   
        $rs = $rs && $res;        
        
        } 
        if ($rs&&$successful&&($step*($iterationNum+1) >= $totalQuantity)&&($step*$iterationNum < $totalQuantity)) {
            unlink($file);
        }
    }
    $result['totalQuantity'] = $totalQuantity;
    $result['success'] = $rs; 
    $result['close'] = ($step*($iterationNum+1) >= $totalQuantity)&&($step*$iterationNum < $totalQuantity); 
  
    return $result;
}

function updateCategoriesFromFiles()
{
    echo 'start update Category ' . date("Y-m-d H:i:s") . '<br/>';
    $file = $_SERVER["DOCUMENT_ROOT"] . '/xml/import/category_new.xml';

    if (file_exists($file)) {
        $xmlCategoriesTmp = simplexml_load_file($file);
        $xmlCategories = xmlToArray($xmlCategoriesTmp);
        if (array_key_exists("Category", $xmlCategories["Categories"])) {
            $xmlCategories = $xmlCategories["Categories"]["Category"];
         } else {
             $xmlCategories = array();  
         }
         echo 'start update Category new in total '. count($xmlCategories) . ' :: ' . date("Y-m-d H:i:s") . '<br/>';
        //d($xmlCategories);
        //$xmlCategories = $xmlCategories[0];
        //d($xmlCategories);
        $j = 0;
        $rs = true; 
        while (($j * DEFOLT_STEP) < count($xmlCategories)) {
        $requests = createRequestForLoadCategoriesFromFile($xmlCategories, 1, $j * DEFOLT_STEP, DEFOLT_STEP);
        //d($requests);
         
        $res = updateCategories($requests, 'requestCategory', 
                        'INSERT INTO bt_category(`category_id`, `parent_id`, `image`, `sort_order`, `date_added`) VALUES ',
                        ' ON DUPLICATE KEY UPDATE `parent_id`=VALUES(`parent_id`), 
                        `image`=VALUES(`image`), `sort_order`=VALUES(`sort_order`), 
                        `date_added`=VALUES(`date_added`)');  
        $rs = $rs && $res;                 
        $res = updateCategories($requests, 'requestCategoryDescription', 
                        'INSERT INTO bt_category_description
                               (`category_id`, `user_group`, `name`, `description`,
                                `meta_description`, `meta_keyword`) VALUES ',
                        ' ON DUPLICATE KEY UPDATE `name`=VALUES(`name`), 
                            `description`=VALUES(`description`), 
                            `meta_description`=VALUES(`meta_description`), 
                            `meta_keyword`=VALUES(`meta_keyword`)');  
        $rs = $rs && $res;  
        $res = updateCategories($requests, 'requestCategoryActive', 
                               'INSERT INTO bt_category_is_active
                               (`category_id`, `user_group`, `active`) VALUES ',
                        ' ON DUPLICATE KEY UPDATE `active`=VALUES(`active`)');  
        $rs = $rs && $res;
        $res = updateCategories($requests, 'requestCategoryOrder', 
                               'INSERT INTO bt_category_order
                               (`category_id`, `user_group`, `sort_order`) VALUES ',
                        ' ON DUPLICATE KEY UPDATE `sort_order`=VALUES(`sort_order`)');   
        $rs = $rs && $res;        
        $j++;
        } 
        if ($rs) {
            unlink($file);
        }
    }
    $file = $_SERVER["DOCUMENT_ROOT"] . '/xml/import/category_cur.xml';
    if (file_exists($file)) {
        $xmlCategoriesTmp = simplexml_load_file($file);
        $xmlCategories = xmlToArray($xmlCategoriesTmp);
        if (array_key_exists("Category", $xmlCategories["Categories"])) {
            $xmlCategories = $xmlCategories["Categories"]["Category"];
         } else {
             $xmlCategories = array();  
         }
         echo 'start update Category cur in total '. count($xmlCategories) . ' :: ' . date("Y-m-d H:i:s") . '<br/>';
        $j = 0;
        $rs = true; 
        while (($j * DEFOLT_STEP) < count($xmlCategories)) {

        $requests = createRequestForLoadCategoriesFromFile($xmlCategories, 2, $j * DEFOLT_STEP, DEFOLT_STEP);
        
        $res = updateCategories($requests, 'requestCategory', 
                        'INSERT INTO bt_category(`category_id`, `parent_id`, `image`, 
                                     `sort_order`, `date_modified`) VALUES ',
                        ' ON DUPLICATE KEY UPDATE `parent_id`=VALUES(`parent_id`), 
                        `image`=VALUES(`image`), `sort_order`=VALUES(`sort_order`), 
                        `date_modified`=VALUES(`date_modified`)'); 
        $rs = $rs && $res;  
                     
        $res = updateCategories($requests, 'requestCategoryDescription', 
                        'INSERT INTO bt_category_description
                               (`category_id`, `user_group`, `name`, `description`,
                               `meta_description`, `meta_keyword`, `date_modified`) VALUES ',
                        ' ON DUPLICATE KEY UPDATE `name`=VALUES(`name`), 
                            `description`=VALUES(`description`), 
                            `meta_description`=VALUES(`meta_description`), 
                            `meta_keyword`=VALUES(`meta_keyword`), 
                            `date_modified`=VALUES(`date_modified`)'); 
        $rs = $rs && $res; 
        //d($rs);   
        $res = updateCategories($requests, 'requestCategoryActive', 
                        'INSERT INTO bt_category_is_active
                            (`category_id`, `user_group`, `active`, `date_modified`) VALUES ',
                        ' ON DUPLICATE KEY UPDATE `active`=VALUES(`active`), 
                            `date_modified`=VALUES(`date_modified`)'); 
        $rs = $rs && $res; 
        $res = updateCategories($requests, 'requestCategoryOrder', 
                        'INSERT INTO bt_category_order
                            (`category_id`, `user_group`, `sort_order`, `date_modified`) VALUES ',
                        ' ON DUPLICATE KEY UPDATE `sort_order`=VALUES(`sort_order`), 
                            `date_modified`=VALUES(`date_modified`)'); 
        $rs = $rs && $res;        


        $j++;
        }
        if ($rs) {
            unlink($file);
        }
    }
    $file = $_SERVER["DOCUMENT_ROOT"] . '/xml/import/category_old.xml';
    if (file_exists($file)) {
        $xmlCategoriesTmp = simplexml_load_file($file);
        $xmlCategories = xmlToArray($xmlCategoriesTmp);
        if (array_key_exists("Category", $xmlCategories["Categories"])) {
           $xmlCategories = $xmlCategories["Categories"]["Category"];
        } else {
            $xmlCategories = array();  
        }
        echo 'start update Category old in total '. count($xmlCategories) . ' :: ' . date("Y-m-d H:i:s") . '<br/>';
        $j = 0;
        $rs = true; 
        while (($j * DEFOLT_STEP) < count($xmlCategories)) {

        $requests = createRequestForLoadCategoriesFromFile($xmlCategories, 3, $j * DEFOLT_STEP, DEFOLT_STEP);
        $rs = updateCategories($requests, 'requestCategoryActive', 
                        'INSERT INTO bt_category_is_active
                            (`category_id`, `user_group`, `active`, `date_modified`) VALUES ',
                        ' ON DUPLICATE KEY UPDATE `active`=VALUES(`active`), 
                            `date_modified`=VALUES(`date_modified`)'); 
        $j++;                      
        }
        if ($rs) {
            unlink($file);
        }
    }
}

/**
 * получить массив категорий по родителю и группе пользователя(по умолчанию берётся из сессии)
 * 
 * @param integer $parentId
 * @param integer $userGroup
 * 
 * @return array массив данных дочерних категорий
 */
function getCatsFromParentUserGroup($parentId, $userGroup = -1, $userGroupAction =-1, $userGroupDescription = -1)
{
    global $db;
 
    $userGroupAction = ($userGroupAction ==-1) ? getCheckUserGroup(2, $userGroup) : $userGroupAction;
    $userGroupDescription = ($userGroupDescription ==-1) ? getCheckUserGroup(3, $userGroup) : $userGroupDescription;   
   
    $sql = "SELECT cat.category_id as `categoryId`, cat.image, cat.last, des.name, des.description " . 
           "FROM `bt_category` AS cat " . 
           "JOIN `bt_category_is_active` AS act ON cat.category_id = act.category_id " . 
           "JOIN `bt_category_description` AS des ON cat.category_id = des.category_id " .
           "LEFT JOIN (SELECT * FROM `bt_category_order` as ord1 WHERE ord1.user_group = $userGroupAction ) AS ord ON cat.category_id = ord.category_id " .
           "WHERE cat.parent_id = $parentId AND act.user_group = $userGroupAction AND " . 
           //"ord.user_group = $userGroupAction AND ". 
           "act.active = 1 AND des.user_group = $userGroupDescription ORDER BY ord.sort_order"; // 
           //d($sql); 
        try {
            $rs = mysqli_query($db, $sql);
        }
        catch (Exception $e) {
            $rs = false;
            //echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
            //echo '</br>';
        }

        $rs = createSmartyRsArray($rs);
    return $rs;
}

/**
 * получить массив головных и их дочерних категорий по группе пользователя(по умолчанию берётся из сессии)
 * 
 * 
 * @return array массив данных категорий
 */
function getAllMainCatsWithChildren() 
{
    $userGroupAction = getCheckUserGroup(2, -1);
    $userGroupDescription = getCheckUserGroup(3, -1);

    $arCategories = getCatsFromParentUserGroup(0, -1, $userGroupAction, $userGroupDescription);
     
    foreach ($arCategories as &$category) {
        $children = getCatsFromParentUserGroup($category['categoryId'], -1, $userGroupAction, $userGroupDescription);
    //    foreach ($children as &$child) {
    //        //if (getProductsFromParentUserGroup($child['categoryId'])) {
    //        if (checkLevelGroup($child['categoryId'])) {
    //            $child['flagProduct']=true;
    //          } else {
    //            $child['flagProduct']=false; 
    //          }
    //    }
    //    unset($child);
        $category['children'] = $children;
    } 
    unset($category);
    return $arCategories;
}

/**
 * получить массив данных категории по id и группе пользователя(по умолчанию берётся из сессии)
 * 
 * @param integer $id
 * @param integer $userGroup
 * 
 * @return array массив данных категории
 */
function getCatFromIdUserGroup($id, $userGroup = -1)
{
    global $db;
 
    $userGroupDescription = getCheckUserGroup(3, $userGroup);
   
    $sql = "SELECT cat.image, des.name, des.description " . 
           "FROM `bt_category` AS cat " . 
           "JOIN `bt_category_description` AS des ON cat.category_id = des.category_id " .
           "WHERE cat.category_id = $id AND " . 
           "des.user_group = $userGroupDescription ORDER BY cat.sort_order";
           //d($sql);
        try {
            $rs = mysqli_query($db, $sql);
        }
        catch (Exception $e) {
            $rs = false;
            //echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
            //echo '</br>';
        }
        $rs = createSmartyRsArray($rs);
        if ($rs) {
            $rs = $rs[0];
        } else {
            $rs = false; 
        }
        $rs['description'] = htmlspecialchars_decode($rs['description']);
    return $rs;
}

function checkParameterCategory($fieldRequest, $parameter, 
                                             $userGroupCur = array(), $add = true)
{
    $resData = array();
    if (is_array($fieldRequest)) {
        if ($parameter == 'categoryId') {
            if (array_key_exists('categoryId', $fieldRequest)) {
                $categoryId = $fieldRequest['categoryId'];
                $categoryId = intval($categoryId);
                if ($categoryId > 0) {
                    $sql = 'select * from `bt_category` where ' .
                                     "`category_id` = '$categoryId' limit 1";
                    $res = requestCat($sql);
                    if ($add) {
                        if ($res) {
                            $count = mysqli_num_rows($res);
                        } else {
                            $count = 1; 
                        }
                        if ($count == 0) {
                            $resData['success'] = true;
                            $resData['parameter'] = $categoryId;
                        } else {
                            $resData['error'] = 'id category already exists';
                            $resData['success'] = false;
                        }
                    } else {
                    if ($res) {
                            $count = mysqli_num_rows($res);
                        } else {
                            $count = 0; 
                        }
                        if ($count > 0) {
                            $resData['success'] = true;
                            $resData['parameter'] = $categoryId;
                        } else {
                            $resData['error'] = 'id category not exists';
                            $resData['success'] = false;
                        }
                }
                } else {
                    $resData['error'] = 'categoryId must be greater than zero';
                    $resData['success'] = false;
                }
            } else {
                $resData['error'] = 'categoryId is necessary parametr';
                $resData['success'] = false;
            }

        } elseif ($parameter == 'parentId') {
            if (array_key_exists('parentId', $fieldRequest)) {
                $parentId = $fieldRequest['parentId'];
                $parentId = intval($parentId);
                if ($parentId > 0) {
                    $res = requestCat("select * from bt_category where category_id = '$parentId' limit 1");
                    if ($res) {
                        $count = mysqli_num_rows($res);
                    } else {
                        $count = 0; 
                    }
                    if ($count > 0) {
                        $resData['success'] = true;
                        $resData['parameter'] = $parentId;
                    } else {
                        $resData['error'] = 'id parent not exists';
                        $resData['success'] = false;
                    }
                } else {
                    if ($parentId == 0) {
                        $resData['success'] = true;
                        $resData['parameter'] = $parentId;
                        $resData['error'] = 'id parent is zero';
                    } else {
                    $resData['error'] = 'categoryId must be greater or equal zero';
                    $resData['success'] = false;
                    }
                }
            } else {
                $resData['error'] = 'parentId is necessary parametr';
                $resData['success'] = false;
            }
        } elseif ($parameter == 'description') {
            if (array_key_exists('description', $fieldRequest)) {
                $description = $fieldRequest['description'];
                $resDes = false;
                $descr = array();
                if (!empty($description) && is_array($description)) {
                    foreach ($description as $key => $des) {
                        if (in_array($key, $userGroupCur)) {
                            if (is_array($des)){
                                $descr[$key] = $des;
                                if (array_key_exists('name', $des) && !empty($des['name']) ) {
                                    $resDes = true; 
                                }
                            }
                        }
                    }
                    if ($add) {
                        $resData['success'] = $resDes;
                    } else {
                        $resData['success'] = true;  
                    }
                    $resData['parameter'] = $descr;
                    if (!$resDes && $add) {
                        $resData['error'] = 'name is empty'; 
                    }
                } else {
                    $resData['error'] = 'description is empty';
                    $resData['success'] = false;
                }
            } else {
                $resData['error'] = 'description is necessary parametr';
                $resData['success'] = false;
            }
        } elseif ($parameter == 'order' || $parameter == 'active') { 
            $param = array();
            if (array_key_exists($parameter, $fieldRequest)) {
                $fields = $fieldRequest[$parameter];
                 if (is_array($fields)) {
                    foreach ($fields as $key => $fil) {
                        if (in_array($key, $userGroupCur)) {
                            if (array_key_exists($parameter, $fil) ) {  //&& !empty($fil[$parameter])
                                $param[$key] = $fil[$parameter];
                            }
                        }
                    }
                }
            } 
            $resData['parameter'] = $param;  
            $resData['success'] = true;                  
        }
    } else {
        $resData['error'] = 'main parametr is not array';
        $resData['success'] = false;
    }
    return $resData;
}

function getSqlForFieldsCategory($fieldRequest, $field, $userGroupCur, $tabel, 
                            $fieldTabel, $categoryId)
{
    $checkParameter = checkParameterCategory($fieldRequest, $field, $userGroupCur);
    if ($checkParameter['success']) {
        $order = $checkParameter['parameter'];
        if (is_array($order)) {
            if ($field == 'description') {
                $fl = false;
                $btProductDescription = array('description', 'description_mini', 'tag',
                    'meta_title', 'meta_description', 'meta_keyword',
                    'meta_h1', 'language_id');
                $btProductDescriptionInLoad = array();
                foreach ($order as $des) {
                    if (is_array($des)) {
                        if (array_key_exists('name', $des) && !empty($des['name'])) {
                            $fl = true;
                            foreach ($des as $ke => $de) {
                                if (in_array($ke, $btProductDescription)) {
                                    $btProductDescriptionInLoad[] = $ke;
                                }
                            }
                        }
                    }
                }
                $btProductDescriptionInLoad = array_unique($btProductDescriptionInLoad);
                $sql = "INSERT INTO `$tabel`" .
                    "(`category_id`, `user_group`, `name`";
                foreach ($btProductDescriptionInLoad as $btDes) {
                    $sql .= ", `$btDes`";
                }
                $sql .= ') VALUES';
                foreach ($order as $key => $des) {
                    if (is_array($des)) {
                        if (array_key_exists('name', $des) && !empty($des['name'])) {
                            $sql .= "('$categoryId', '$key', '{$des['name']}'";
                            foreach ($btProductDescriptionInLoad as $btDes) {
                               if (!empty($des[$btDes])) {
                                $sql .= ",'{$des[$btDes]}'";
                               } else {
                                $sql .= ",''";
                               }
                            }
                            $sql .= "),";
                        }
                    }
                }
                if ($fl) {
                    $sql = commaDel($sql, ',');
                } else {
                    $sql = '';
                }
            } else {
                $fl = false;
                $sql = "INSERT INTO `$tabel`" .
                    "(`category_id`, `user_group`, `$fieldTabel`) VALUES";
                foreach ($order as $key => $ord) {
                    $fl = true;
                    $sql .= "('$categoryId', '$key', '$ord'),";
                }
                if ($fl) {
                    $sql = commaDel($sql, ',');
                } else {
                    $sql = '';
                }
            }
        } else {
            $sql = '';
        }
    } else {
        $sql = '';
    }
    return $sql;
}

function addCategory($fieldRequest)
{
    global $userGroupSt;
    global $userGroupMd;  
    $btCategory = array('image', 'top', 'column');
    $resData = array();
    $checkParameter = checkParameterCategory($fieldRequest, 'categoryId');
    if ($checkParameter['success']) {
        $categoryId = $checkParameter['parameter']; 
        $checkParameter = checkParameterCategory($fieldRequest, 'parentId');
            if ($checkParameter['success']) {
                $parentId = $checkParameter['parameter'];
                $checkParameter = checkParameterCategory($fieldRequest, 'description', 
                                                    $userGroupSt);
                if ($checkParameter['success']) {
                    $sql = 'INSERT INTO `bt_category`(`category_id`, `parent_id`';
                    $values = " VALUES ('$categoryId','$parentId'";
                    foreach ($btCategory as $field) {
                        if (array_key_exists($field, $fieldRequest)) { 
                            $val = $fieldRequest[$field];
                            //if (!empty($val)) {
                                $sql .= ", `$field`";
                                $values .= ", '$val'";
                            //}
                        }
                    }
                    $sql .= ', `date_added`)';
                    $values .= ', NOW())';
                    $rs = requestCat($sql . $values); 
                    $rs = true;
                    if ($rs) {
                        $resData['success'] = true;
                        $sql = getSqlForFieldsCategory($fieldRequest, 'order', $userGroupMd,
                            'bt_category_order', 'sort_order', $categoryId);
                        if ($sql) {
                            $rs = requestCat($sql);
                        }
                        $sql = getSqlForFieldsCategory($fieldRequest, 'active', $userGroupMd,
                            'bt_category_is_active', 'active', $categoryId);
                        if ($sql) {
                            $rs = requestCat($sql);
                        }
                        $sql = getSqlForFieldsCategory($fieldRequest, 'description', $userGroupSt,
                            'bt_category_description', '', $categoryId);
                        if ($sql) {
                            $rs = requestCat($sql);
                            if (!$rs) {
                                if (empty($resData['error'])) {
                                $resData['error'] = 'failed to write name of category';
                                } else {
                                    $resData['error'] = $resData['error'] . 
                                                    '; failed to write name of category';  
                                }
                            }
                        }
                    } else {
                        $resData['error'] = 'failed to add a category';
                        $resData['success'] = false;
                    }
                } else {
                    $resData['error'] = $checkParameter['error'];
                    $resData['success'] = false;
                }
            } else {
                $resData['error'] = $checkParameter['error'];
                $resData['success'] = false;
            }
    } else {
        $resData['error'] = $checkParameter['error'];
        $resData['success'] = false;
    }
    return $resData;
}

function getSqlForDeleteCategory($table, $categoryId)
{
    $sql = "DELETE FROM `$table` WHERE `category_id` = '$categoryId'";
    return $sql; 
}

function deleteCategory($categoryId)
{
    $categoryId = intval($categoryId);
    if ($categoryId > 0) {
        $res = true;
        $sql = getSqlForDeleteCategory('bt_category', $categoryId);
        $rs = requestCat($sql);
        $res = $res && $rs;
        $sql = getSqlForDeleteCategory('bt_category_description', $categoryId);
        $rs = requestCat($sql);
        $res = $res && $rs;
        $sql = getSqlForDeleteCategory('bt_category_is_active', $categoryId);
        $rs = requestCat($sql);
        $res = $res && $rs;
        $sql = getSqlForDeleteCategory('bt_category_order', $categoryId);
        $rs = requestCat($sql);
        $res = $res && $rs;
    } else {
        $res = false;
    }
    $resData['success'] = $res;
    return $resData;
}

function getDataFromLocalTableCategory($tab, $categoryId)
{
    $sql = "SELECT * FROM `$tab` WHERE `category_id` = $categoryId";
    $resData = array();
    $rs = requestCat($sql);
    $res = createSmartyRsArray($rs);
    if ($res) {
        foreach ($res as $values) {
            if (is_array($values)) {
                $userGroup = false;
                if (array_key_exists('user_group', $values) &&
                                      (!empty($values['user_group']))) {
                    $userGroup = $values['user_group'];
                    $resData[$userGroup] = array();
                }
                if ($userGroup) {
                    foreach ($values as $key => $val) {
                        if (isset($val) && ($key != 'user_group') && ($key != 'category_id')) {
                            $resData[$userGroup][$key] = $val;
                        }
                    }
                }
            }
        }
    }
    return $resData;
}

function getCategory($categoryId)
{
    $resData = array();
    $fieldRequest['categoryId'] = $categoryId;
    $checkParameter = checkParameterCategory($fieldRequest, 'categoryId', $resData, false);
    if ($checkParameter['success']) {
        $resData['categoryId'] = $categoryId;
        $sql = 'SELECT `parent_id`, `image`, `top`, `column`,' .
            " `date_added`, `date_modified` FROM `bt_category` WHERE `category_id` = $categoryId";
        $rs = requestCat($sql);
        $res = createSmartyRsArray($rs);
        if ($res) {
            foreach ($res as $value) {
                if (is_array($value)) {
                    foreach ($value as $key => $val) {
                        if (!is_null ($val)) {
                            $resData[$key] = $val;
                        }
                    }
                }
            }
        }
    } else {
        $resData['category'] = "$categoryId not found";
    }
    $res = getDataFromLocalTableCategory('bt_category_order', $categoryId);
    if (!empty($res)) {
        $resData['order'] = $res;
    }
    $res = getDataFromLocalTableCategory('bt_category_is_active', $categoryId);
    if (!empty($res)) {
        $resData['active'] = $res;
    }
    $res = getDataFromLocalTableCategory('bt_category_description', $categoryId);
    if (!empty($res)) {
        $resData['description'] = $res;
    }
    return $resData;
}

function getSqlForFieldsUpdateCategory($fieldRequest, $field, $userGroupCur, $tabel, $fieldTabel, $categoryId)
{
    $checkParameter = checkParameterCategory($fieldRequest, $field, $userGroupCur, false);
    if ($checkParameter['success']) {
        $order = $checkParameter['parameter'];
        if (is_array($order)) {
            if ($field == 'description') {
                $sql = array();
                $btProductDescription = array('name', 'description', 'description_mini',
                    'tag', 'meta_title', 'meta_description',
                    'meta_keyword', 'meta_h1', 'language_id');
                foreach ($order as $key => $des) {
                    if (is_array($des)) {
                        $fl = false;
                        $sqlSt = "INSERT INTO `$tabel` (`category_id`, `user_group`";
                        $sqlVal = "('$categoryId', '$key'";
                        $sqlEnd = ' ON DUPLICATE KEY UPDATE ';
                        foreach ($des as $ke => $de) {
                            if (in_array($ke, $btProductDescription)) {
                                $sqlSt .= ", `$ke`";
                                $sqlVal .= ", '$de'";
                                if ($fl) {
                                    $sqlEnd .= ", `$ke`=VALUES(`$ke`)";
                                } else {
                                    $fl = true;
                                    $sqlEnd .= "`$ke`=VALUES(`$ke`)";
                                }
                            }
                        }
                        $sqlSt .= ", `date_modified`) VALUES ";
                        $sqlVal .= ", NOW())";
                        $sqlEnd .= ", `date_modified`=VALUES(`date_modified`)";
                        if ($fl) {
                            $sql[] = $sqlSt . $sqlVal . $sqlEnd;
                        }
                    }
                }
            } else {
                $fl = false;
                $sql = "INSERT INTO `$tabel`" .
                    "(`category_id`, `user_group`, `$fieldTabel`, `date_modified`) VALUES";
                foreach ($order as $key => $ord) {
                    $fl = true;
                    $sql .= "('$categoryId', '$key', '$ord', NOW()),";
                }
                if ($fl) {
                    $sql = commaDel($sql, ',');
                    $sql .= " ON DUPLICATE KEY UPDATE " .
                        "`$fieldTabel`=VALUES(`$fieldTabel`), `date_modified`=VALUES(`date_modified`)";
                } else {
                    $sql = '';
                }
            }
        } else {
            $sql = '';
        }
    } else {
        $sql = '';
    }
    return $sql;
}

function updateCategory($fieldRequest)
{
    global $userGroupSt;
    global $userGroupMd;
    $btProduct = array('image', 'top', 'column');
    $resData = array();
    $checkParameter = checkParameterCategory($fieldRequest, 'categoryId', $userGroupSt, false);
    if ($checkParameter['success']) {
        $categoryId = $checkParameter['parameter'];
        $sql = 'UPDATE `bt_category` SET';
        $checkParameter = checkParameterCategory($fieldRequest, 'parentId');
        if ($checkParameter['success']) {
            $parentId = $checkParameter['parameter'];
            $sql .= " `parent_id` = '$parentId',";
        }
        foreach ($btProduct as $field) {
            if (array_key_exists($field, $fieldRequest)) {
                $val = $fieldRequest[$field];
                if (isset($val)) {
                    $sql .= " `$field` = '$val',";
                }
            }
        }
        $sql .= " `date_modified` = NOW() WHERE `category_id`=$categoryId";
        $rs = requestCat($sql);
        if ($rs) {
            $resData['success'] = true;
        }
             $sql = getSqlForFieldsUpdateCategory($fieldRequest, 'order', $userGroupMd,
                'bt_category_order', 'sort_order', $categoryId);
            if ($sql) {
                $rs = requestCat($sql);
            }
            $sql = getSqlForFieldsUpdateCategory($fieldRequest, 'active', $userGroupMd,
                'bt_category_is_active', 'active', $categoryId);
            if ($sql) {
                $rs = requestCat($sql);
            }
            $sqlUpd = getSqlForFieldsUpdateCategory($fieldRequest, 'description', $userGroupSt,
                'bt_category_description', '', $categoryId);
            foreach ($sqlUpd as $sql) {
            if ($sql) {
                $rs = requestCat($sql);
            }
            } 
     } else {
        $resData['error'] = $checkParameter['error'];
        $resData['success'] = false;
    }
    return $resData;
}

function requestCat($sql)
{
    global $db;
    $rs = true;
    if ($sql) {
        try {
            $rs = mysqli_query($db, $sql);
        } catch (Exception $e) {
            $rs = false;
            //echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
            //echo '</br>';
        }
    }
    return $rs;
}

function setCategoryUpdate()
{
    $sql = 'UPDATE `bt_category_update` SET `date_modified`=NOW() WHERE 1';
    requestCat($sql);
}

function getCategoryUpdate()
{
    $sql = 'SELECT `date_modified` FROM `bt_category_update` WHERE 1';
    $rs = requestCat($sql);
    if ($rs) {
        $res = createSmartyRsArray($rs);
        $dateUpd = $res[0]["date_modified"];
        $dateUpdNumber = strtotime($dateUpd);
    } else {
        $dateUpdNumber = 2000000000;
    }
    return  $dateUpdNumber;   
}

function getAllMainCatsWithChildrenUpd()
{
  if (!isset($_SESSION['allMainCatsWithChildren'])) {
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
  }
  return $rsCategories;
}

function updateLastCategories()
{
    $sql = 'UPDATE `bt_category` SET `last`=0 WHERE 1';
    $rs = requestCat($sql);
    if ($rs) {
        $sql = 'UPDATE `bt_category` SET `last`=1 WHERE `category_id`' .
            ' IN (SELECT DISTINCT `category_id` FROM bt_product_to_category)';
        $rs = requestCat($sql);
    }
    if ($rs) {
        return true;
    } else {
        return false; 
        }
}
