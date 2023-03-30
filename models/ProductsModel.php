<?php

include_once '../models/UsersModel.php';

/**
 * create SQL request for update and add products
 *
 * @param string $fileName file for loading
 * @param integer $fileType type of file : 1 - new, 2 - current, 3 - old
 * @param integer $step quantity of requests
 * @param string $updateEverything Y - update everything, else update only modified
 *
 * @return array of sql request
 */
function createRequestForLoadProductsFromFile($fileName, $fileType,
                                              $step = DEFOLT_STEP, $updateEverything = 'N')
{
    $requestProduct = '';
    $requestProductDescription = '';
    $requestProductCategory = '';
    $requestProductQuantity = '';
    $requestProductPrice = '';
    $requestProductDate = '';
    $requestProductOrder = '';

    if ($updateEverything == 'Y') {
        $upd = true;
    } else {
        $upd = false;
    }
    $xmlProductsTmp = simplexml_load_file($fileName, 'SimpleXMLElement', LIBXML_NOENT);
    $countReq = 1;
    $requests = array();
    $i = 0;
    foreach ($xmlProductsTmp->Product as $product) {
        $productId = intval($product->product_id);
        if ($productId) {
            $name = transformStr($product->name, 1);
            if ($fileType == 1) {
                $countReq++;
                $dateAv = transformDate($product->date_available);
                $dateAvKz = transformDate($product->date_available_kz);
                $description = transformStr($product->description, 1);
                $descriptionKz = transformStr($product->description_kz, 1);
                $description = htmlentities(trim($description),
                    ENT_QUOTES | ENT_IGNORE, "UTF-8");
                $descriptionKz = htmlentities(trim($descriptionKz),
                    ENT_QUOTES | ENT_IGNORE, "UTF-8");
                $requestProduct .= "('$productId', '$product->article',
                                    '$product->image_name',NOW()),";
                $requestProductDescription .= "('$productId', '1', '$name',
                                    '$description'),";
                $requestProductDescription .= "('$productId', '4', '$name',
                                    '$descriptionKz'),";
                $requestProductCategory .= "('$productId', '$product->categories'),";
                $requestProductQuantity .= "('$productId', '1', '$product->quantity'),";
                $requestProductQuantity .= "('$productId', '2', '$product->quantity_sm'),";
                $requestProductQuantity .= "('$productId', '4', '$product->quantity_kz'),";
                $requestProductPrice .= "('$productId', '1', '$product->price'),";
                $requestProductPrice .= "('$productId', '2', '$product->price_sm'),";
                $requestProductPrice .= "('$productId', '3', '$product->price_inet'),";
                $requestProductPrice .= "('$productId', '4', '$product->price_kz'),";
                $requestProductDate .= "('$productId', '1', '$dateAv'),";
                $requestProductDate .= "('$productId', '4', '$dateAvKz'),";

                $requestProductOrder .= "('$productId', '1', '$product->sort_order'),";
                $requestProductOrder .= "('$productId', '2', '$product->sort_order_sm'),";
                $requestProductOrder .= "('$productId', '4', '$product->sort_order_kz'),";
                if ($countReq > $step) {
                    $requests[$i]['requestProduct'] = commaDel($requestProduct, ',');
                    $requests[$i]['requestProductDescription'] =
                        commaDel($requestProductDescription, ',');
                    $requests[$i]['requestProductCategory'] =
                        commaDel($requestProductCategory, ',');
                    $requests[$i]['requestProductQuantity'] =
                        commaDel($requestProductQuantity, ',');
                    $requests[$i]['requestProductPrice'] = commaDel($requestProductPrice, ',');
                    $requests[$i]['requestProductDate'] = commaDel($requestProductDate, ',');
                    $requests[$i]['requestProductOrder'] = commaDel($requestProductOrder, ',');
                    $i++;

                    $requestProduct = '';
                    $requestProductDescription = '';
                    $requestProductCategory = '';
                    $requestProductQuantity = '';
                    $requestProductPrice = '';
                    $requestProductDate = '';
                    $requestProductOrder = '';
                    $countReq = 1;
                }
            } elseif ($fileType == 2) {
                $countReq++;
                $dateAv = transformDate($product->date_available);
                $dateAvKz = transformDate($product->date_available_kz);
                $description = transformStr($product->description, 1);
                $descriptionKz = transformStr($product->description_kz, 1);
                $description = htmlentities(trim($description),
                    ENT_QUOTES | ENT_IGNORE, "UTF-8");
                $descriptionKz = htmlentities(trim($descriptionKz),
                    ENT_QUOTES | ENT_IGNORE, "UTF-8");
                if ((($product->article['Update']) == 'TRUE') ||
                    (($product->image_name['Update']) == 'TRUE') || $upd) {
                    $requestProduct .= "('$productId', '$product->article',
                                        '$product->image_name',NOW()),";
                }
                if ((($product->name['Update']) == 'TRUE') || $upd) {
                    $requestProductDescription .= "('$productId', '1', '$name',
                                                 '$description',NOW()),";
                    $requestProductDescription .= "('$productId', '4', '$name',
                                                 '$descriptionKz',NOW()),";
                } else {
                    if (($product->description['Update']) == 'TRUE') {
                        $requestProductDescription .= "('$productId', '1', '$name',
                                                     '$description',NOW()),";
                    }
                    if (($product->description_kz['Update']) == 'TRUE') {
                        $requestProductDescription .= "('$productId', '4', '$name',
                                                     '$descriptionKz',NOW()),";
                    }
                }
                if ((($product->categories['Update']) == 'TRUE') || $upd) {
                    $requestProductCategory .= "('$productId', '$product->categories',NOW()),";
                }
                if (
                    (($product->quantity['Update']) == 'TRUE') || $upd) {
                    $requestProductQuantity .= "('$productId', '1', '$product->quantity',NOW()),";
                }
                if ((($product->quantity_sm['Update']) == 'TRUE') || $upd) {
                    $requestProductQuantity .= "('$productId', '2', '$product->quantity_sm',NOW()),";
                }
                if ((($product->quantity_kz['Update']) == 'TRUE') || $upd) {
                    $requestProductQuantity .= "('$productId', '4', '$product->quantity_kz',NOW()),";
                }
                if ((($product->price['Update']) == 'TRUE') || $upd) {
                    $requestProductPrice .= "('$productId', '1', '$product->price',NOW()),";
                }
                if ((($product->price_sm['Update']) == 'TRUE') || $upd) {
                    $requestProductPrice .= "('$productId', '2', '$product->price_sm',NOW()),";
                }
                if ((($product->price_inet['Update']) == 'TRUE') || $upd) {
                    $requestProductPrice .= "('$productId', '3', '$product->price_inet',NOW()),";
                }
                if ((($product->price_kz['Update']) == 'TRUE') || $upd) {
                    $requestProductPrice .= "('$productId', '4', '$product->price_kz',NOW()),";
                }
                if ((($product->date_available['Update']) == 'TRUE') || $upd) {
                    $requestProductDate .= "('$productId', '1', '$dateAv',NOW()),";
                }
                if ((($product->date_available_kz['Update']) == 'TRUE') || $upd) {
                    $requestProductDate .= "('$productId', '4', '$dateAvKz',NOW()),";
                }
                if ((($product->sort_order['Update']) == 'TRUE') || $upd) {
                    $requestProductOrder .= "('$productId', '1', '$product->sort_order',NOW()),";
                }
                if ((($product->sort_order_sm['Update']) == 'TRUE') || $upd) {
                    $requestProductOrder .= "('$productId', '2', '$product->sort_order_sm',NOW()),";
                }
                if ((($product->sort_order_kz['Update']) == 'TRUE') || $upd) {
                    $requestProductOrder .= "('$productId', '4', '$product->sort_order_kz',NOW()),";
                }
                if ($countReq > $step) {

                    $requests[$i]['requestProduct'] = commaDel($requestProduct, ',');
                    $requests[$i]['requestProductDescription'] =
                        commaDel($requestProductDescription, ',');
                    $requests[$i]['requestProductCategory'] =
                        commaDel($requestProductCategory, ',');
                    $requests[$i]['requestProductQuantity'] =
                        commaDel($requestProductQuantity, ',');
                    $requests[$i]['requestProductPrice'] = commaDel($requestProductPrice, ',');
                    $requests[$i]['requestProductDate'] = commaDel($requestProductDate, ',');
                    $requests[$i]['requestProductOrder'] = commaDel($requestProductOrder, ',');
                    $i++;

                    $requestProduct = '';
                    $requestProductDescription = '';
                    $requestProductCategory = '';
                    $requestProductQuantity = '';
                    $requestProductPrice = '';
                    $requestProductDate = '';
                    $requestProductOrder = '';
                    $countReq = 1;
                }
            } elseif ($fileType == 3) {
                $countReq++;
                if ((($product->quantity['Update']) == 'TRUE') || $upd) {
                    $requestProductQuantity .= "('$productId', '1', '$product->quantity',NOW()),";
                }
                if ((($product->quantity_sm['Update']) == 'TRUE') || $upd) {
                    $requestProductQuantity .= "('$productId', '2', '$product->quantity_sm',NOW()),";
                }
                if ((($product->quantity_kz['Update']) == 'TRUE') || $upd) {
                    $requestProductQuantity .= "('$productId', '4', '$product->quantity_kz',NOW()),";
                }
                if ($countReq > $step) {

                    $requests[$i]['requestProduct'] = commaDel($requestProduct, ',');
                    $requests[$i]['requestProductDescription'] =
                        commaDel($requestProductDescription, ',');
                    $requests[$i]['requestProductCategory'] =
                        commaDel($requestProductCategory, ',');
                    $requests[$i]['requestProductQuantity'] =
                        commaDel($requestProductQuantity, ',');
                    $requests[$i]['requestProductPrice'] = commaDel($requestProductPrice, ',');
                    $requests[$i]['requestProductDate'] = commaDel($requestProductDate, ',');
                    $requests[$i]['requestProductOrder'] = commaDel($requestProductOrder, ',');
                    $i++;

                    $requestProduct = '';
                    $requestProductDescription = '';
                    $requestProductCategory = '';
                    $requestProductQuantity = '';
                    $requestProductPrice = '';
                    $requestProductDate = '';
                    $requestProductOrder = '';
                    $countReq = 1;
                }
            }
        }
    }
    $requests[$i]['requestProduct'] = commaDel($requestProduct, ',');
    $requests[$i]['requestProductDescription'] = commaDel($requestProductDescription, ',');
    $requests[$i]['requestProductCategory'] = commaDel($requestProductCategory, ',');
    $requests[$i]['requestProductQuantity'] = commaDel($requestProductQuantity, ',');
    $requests[$i]['requestProductPrice'] = commaDel($requestProductPrice, ',');
    $requests[$i]['requestProductDate'] = commaDel($requestProductDate, ',');
    $requests[$i]['requestProductOrder'] = commaDel($requestProductOrder, ',');
    return $requests;
}

/**
 * updating products
 *
 * @param array $requests
 * @param string $nameField name key of array with data for load
 * @param string $sqlStart first part of sql request
 * @param string $sqlEnd last part of sql request
 *
 * @return mysqli_result|bool result of request
 */
function updateProducts($requests, $nameField, $sqlStart, $sqlEnd = '')
{
    global $db;
    $rs = true;
    $sqlFields = $requests[$nameField];
    if ($sqlFields) {
        $sql = $sqlStart . $sqlFields . $sqlEnd;
        //d($sql);
        //echo $sql . '<br />';
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

/**
 * update products from xml file
 *
 * @param integer $fileNum type of file : 1 - new, 2 - current, 3 - old
 * @param integer $iterationNum number of current iteration
 * @param integer $step quantity of requests
 * @param boolean $successful result of previous iteration
 * @param string $updateEverything Y - update everything, else update only modified
 *
 * @return array of $result ['totalQuantity'] integer total quantity of step
 *                          ['success']       boolean - result current iteretion
 *                          ['close']         boolean - true if last step seccessful
 */
function updateProductsFromFilesByStep($fileNum, $iterationNum,
                                       $step = DEFOLT_STEP, $successful = 1, $updateEverything = 'N')
{
    $result = array();
    $totalQuantity = 0;
    $rs = true;
    $file = $_SERVER["DOCUMENT_ROOT"] . '/xml/import/product';
    if ($fileNum == 1) {
        $file .= '_new.xml';
    } elseif ($fileNum == 2) {
        $file .= '_cur.xml';
    } elseif ($fileNum == 3) {
        $file .= '_old.xml';
    }
    if (file_exists($file)) {
        $requests = createRequestForLoadProductsFromFile($file, $fileNum,
            $step, $updateEverything);
        $totalQuantity = count($requests);
        if ($iterationNum < $totalQuantity) {
            $request = $requests[$iterationNum];

            if ($fileNum == 1) {
                $dateM = 'added';
            } else {
                $dateM = 'modified';
            }
            $res = updateProducts($request, 'requestProduct',
                "INSERT INTO bt_product (`product_id`, `article`, " .
                "`image`, `date_$dateM`) VALUES ",
                " ON DUPLICATE KEY UPDATE `article`=VALUES(`article`), " .
                "`image`=VALUES(`image`), `date_$dateM`=VALUES(`date_$dateM`)");
            $rs = $rs && $res;
            if ($fileNum == 1) {
                $dateM1 = '';
                $dateM2 = '';
            } else {
                $dateM1 = ', `date_modified`';
                $dateM2 = ', `date_modified`=VALUES(`date_modified`)';
            }
            $res = updateProducts($request, 'requestProductDescription',
                "INSERT INTO bt_product_description (`product_id`, `user_group`, " .
                "`name`, `description`$dateM1) VALUES ",
                " ON DUPLICATE KEY UPDATE `name`=VALUES(`name`), " .
                "`description`=VALUES(`description`)$dateM2");
            $rs = $rs && $res;
            $res = updateProducts($request, 'requestProductCategory',
                "INSERT INTO bt_product_to_category " .
                "(`product_id`, `category_id`$dateM1) VALUES ",
                " ON DUPLICATE KEY UPDATE " .
                "`category_id`=VALUES(`category_id`)$dateM2");
            $rs = $rs && $res;
            $res = updateProducts($request, 'requestProductQuantity',
                "INSERT INTO bt_product_quantity " .
                "(`product_id`, `user_group`, `quantity`$dateM1) VALUES ",
                " ON DUPLICATE KEY UPDATE " .
                "`quantity`=VALUES(`quantity`)$dateM2");
            $rs = $rs && $res;
            $res = updateProducts($request, 'requestProductPrice',
                "INSERT INTO bt_product_price " .
                "(`product_id`, `user_group`, `price`$dateM1) VALUES ",
                " ON DUPLICATE KEY UPDATE `price`=VALUES(`price`)$dateM2");
            $rs = $rs && $res;
            $res = updateProducts($request, 'requestProductDate',
                "INSERT INTO bt_product_date_available " .
                "(`product_id`, `user_group`, `date_available`$dateM1) VALUES ",
                " ON DUPLICATE KEY UPDATE " .
                "`date_available`=VALUES(`date_available`)$dateM2");
            $rs = $rs && $res;

            $res = updateProducts($request, 'requestProductOrder',
                "INSERT INTO bt_product_order " .
                "(`product_id`, `user_group`, `sort_order`$dateM1) VALUES ",
                " ON DUPLICATE KEY UPDATE `sort_order`=VALUES(`sort_order`)$dateM2");
            $rs = $rs && $res;
        }
        if ($rs && $successful && (($iterationNum + 1) == $totalQuantity)) {
            unlink($file);
        }
    }
    $result['totalQuantity'] = $totalQuantity;
    $result['success'] = $rs;
    $result['close'] = (($iterationNum + 1) == $totalQuantity);

    return $result;
}

function updateProductsFromFilesOLD()
{
    echo 'start update Product ' . date("Y-m-d H:i:s") . '<br/>';
    $file = $_SERVER["DOCUMENT_ROOT"] . '/xml/import/product_new.xml';
    $nom = 0;
    if (file_exists($file)) {
        $requests = createRequestForLoadProductsFromFile($file, 1);
        echo 'start update Product new in total ' . count($requests) . ' :: ' . date("Y-m-d H:i:s") . '<br/>';
        //exit;
        $rs = true;
        foreach ($requests as $request) {
            $res = updateProducts($request, 'requestProduct',
                'INSERT INTO bt_product(`product_id`, `article`, `image`, `date_added`) VALUES ',
                ' ON DUPLICATE KEY UPDATE `article`=VALUES(`article`), `image`=VALUES(`image`),
                        `date_added`=VALUES(`date_added`)');
            $rs = $rs && $res;
            $res = updateProducts($request, 'requestProductDescription',
                'INSERT INTO bt_product_description
                               (`product_id`, `user_group`, `name`, `description`) VALUES ',
                ' ON DUPLICATE KEY UPDATE `name`=VALUES(`name`), `description`=VALUES(`description`)');
            $rs = $rs && $res;
            $res = updateProducts($request, 'requestProductCategory',
                'INSERT INTO bt_product_to_category
                               (`product_id`, `category_id`) VALUES ',
                ' ON DUPLICATE KEY UPDATE `category_id`=VALUES(`category_id`)');
            $rs = $rs && $res;
            $res = updateProducts($request, 'requestProductQuantity',
                'INSERT INTO bt_product_quantity
                               (`product_id`, `user_group`, `quantity`) VALUES ',
                ' ON DUPLICATE KEY UPDATE `quantity`=VALUES(`quantity`)');
            $rs = $rs && $res;
            $res = updateProducts($request, 'requestProductPrice',
                'INSERT INTO bt_product_price
                               (`product_id`, `user_group`, `price`) VALUES ',
                ' ON DUPLICATE KEY UPDATE `price`=VALUES(`price`)');
            $rs = $rs && $res;
            $res = updateProducts($request, 'requestProductDate',
                'INSERT INTO bt_product_date_available
                               (`product_id`, `user_group`, `date_available`) VALUES ',
                ' ON DUPLICATE KEY UPDATE `date_available`=VALUES(`date_available`)');
            $rs = $rs && $res;

            $res = updateProducts($request, 'requestProductOrder',
                'INSERT INTO bt_product_order
               (`product_id`, `user_group`, `sort_order`) VALUES ',
                ' ON DUPLICATE KEY UPDATE `sort_order`=VALUES(`sort_order`)');
            $rs = $rs && $res;

            $nom++;
            if ($rs) {
                echo 'update Product new part ' . $nom . ' :: ' . date("Y-m-d H:i:s") . '<br/>';
            } else {
                echo 'false update Product new part ' . $nom . ' :: ' . date("Y-m-d H:i:s") . '<br/>';
            }
        }
        if ($rs) {
            unlink($file);
        }
    }
    $rsIt = $rs;
    $file = $_SERVER["DOCUMENT_ROOT"] . '/xml/import/product_cur.xml';
    if (file_exists($file)) {
        $rs = true;
        $requests = createRequestForLoadProductsFromFile($file, 2);
        foreach ($requests as $request) {
            $res = updateProducts($request, 'requestProduct',
                'INSERT INTO bt_product(`product_id`, `article`, `image`, `date_modified`) VALUES ',
                ' ON DUPLICATE KEY UPDATE `article`=VALUES(`article`), `image`=VALUES(`image`),
                        `date_modified`=VALUES(`date_modified`)');
            $rs = $rs && $res;
            $res = updateProducts($request, 'requestProductDescription',
                'INSERT INTO bt_product_description
                        (`product_id`, `user_group`, `name`, `description`, `date_modified`) VALUES ',
                ' ON DUPLICATE KEY UPDATE `name`=VALUES(`name`), `description`=VALUES(`description`),
                        `date_modified`=VALUES(`date_modified`)');
            $rs = $rs && $res;
            $res = updateProducts($request, 'requestProductCategory',
                'INSERT INTO bt_product_to_category
                               (`product_id`, `category_id`, `date_modified`) VALUES ',
                ' ON DUPLICATE KEY UPDATE `category_id`=VALUES(`category_id`),
                               `date_modified`=VALUES(`date_modified`)');
            $rs = $rs && $res;
            $res = updateProducts($request, 'requestProductQuantity',
                'INSERT INTO bt_product_quantity
                               (`product_id`, `user_group`, `quantity`, `date_modified`) VALUES ',
                ' ON DUPLICATE KEY UPDATE `quantity`=VALUES(`quantity`),
                               `date_modified`=VALUES(`date_modified`)');
            $rs = $rs && $res;
            $res = updateProducts($request, 'requestProductPrice',
                'INSERT INTO bt_product_price
                               (`product_id`, `user_group`, `price`, `date_modified`) VALUES ',
                ' ON DUPLICATE KEY UPDATE `price`=VALUES(`price`),
                               `date_modified`=VALUES(`date_modified`)');
            $rs = $rs && $res;
            $res = updateProducts($request, 'requestProductDate',
                'INSERT INTO bt_product_date_available
                               (`product_id`, `user_group`, `date_available`, `date_modified`) VALUES ',
                ' ON DUPLICATE KEY UPDATE `date_available`=VALUES(`date_available`),
                               `date_modified`=VALUES(`date_modified`)');
            $rs = $rs && $res;

            $res = updateProducts($request, 'requestProductOrder',
                'INSERT INTO bt_product_order
               (`product_id`, `user_group`, `sort_order`, `date_modified`) VALUES ',
                ' ON DUPLICATE KEY UPDATE `sort_order`=VALUES(`sort_order`),
               `date_modified`=VALUES(`date_modified`)');
            $rs = $rs && $res;

        }
        if ($rs) {
            unlink($file);
        }
    }
    $rsIt = $rs && $rsIt;
    $file = $_SERVER["DOCUMENT_ROOT"] . '/xml/import/product_old.xml';
    if (file_exists($file)) {
        $rs = true;
        $requests = createRequestForLoadProductsFromFile($file, 3);
        foreach ($requests as $request) {
            $res = updateProducts($request, 'requestProductQuantity',
                'INSERT INTO bt_product_quantity
              (`product_id`, `user_group`, `quantity`, `date_modified`) VALUES ',
                ' ON DUPLICATE KEY UPDATE `quantity`=VALUES(`quantity`),
              `date_modified`=VALUES(`date_modified`)');
            $rs = $rs && $res;
        }
        if ($rs) {
            unlink($file);
        }
    }
    $rsIt = $rs && $rsIt;

    return $rsIt;
}

function getProductsFromParentUserGroup($parentId, $userGroup = -1, $startPosition = 0,
                                        $quantity = 0, $imageDefProd = '')
{
    global $db;

    $userGroup = getCheckUserGroup(0, $userGroup);
    $userGroupAction = getCheckUserGroup(2, $userGroup);
    $userGroupDescription = getCheckUserGroup(3, $userGroup);

    $sql = "SELECT productId, article, image, name, description, price, IFNULL(sort_order, 0) as ordr " .
        "FROM (SELECT * FROM" .
        "(SELECT pro.product_id as `productId`, pro.article, CASE WHEN pro.image='' THEN '$imageDefProd' ELSE pro.image END as `image`, " .  //pro.image
        "des.name, des.description, pri.price, ord.user_group, ord.sort_order " .
        "FROM `bt_product` AS pro " .
        "JOIN `bt_product_quantity` AS act ON pro.product_id = act.product_id " .
        "JOIN `bt_product_description` AS des ON pro.product_id = des.product_id " .
        "JOIN `bt_product_price` AS pri ON pro.product_id = pri.product_id " .
        "JOIN `bt_product_to_category` AS cat ON pro.product_id = cat.product_id " .
        "LEFT JOIN `bt_product_order` AS ord ON pro.product_id = ord.product_id " .
        "WHERE cat.category_id = $parentId AND act.user_group = $userGroupAction AND " .
        "act.quantity > 0 AND des.user_group = $userGroupDescription " .
        "AND pri.user_group = $userGroup ) AS pr " .
        "WHERE pr.user_group = $userGroupAction OR pr.sort_order IS NULL) as pr2 " .
        "ORDER BY  ordr , name";
    if ($quantity > 0) {
        $sql .= " LIMIT $startPosition, $quantity";
    }
    //d($sql);
    try {
        $rs = mysqli_query($db, $sql);
    } catch (Exception $e) {
        $rs = false;
        echo 'Выброшено исключение: ', $e->getMessage(), "\n";
        echo '</br>';
    }
    $rs = createSmartyRsArray($rs);
    //d($rs);
    return $rs;

}

function getNumberProductsFromParentUserGroup($parentId, $userGroup = -1)
{
    global $db;

    $userGroup = getCheckUserGroup(0, $userGroup);
    $userGroupAction = getCheckUserGroup(2, $userGroup);

    $sql = 'SELECT * FROM `bt_product_quantity` AS act JOIN `bt_product_to_category` AS pro' .
        '  ON pro.product_id = act.product_id WHERE' .
        " pro.category_id = $parentId AND act.user_group = $userGroupAction AND act.quantity > 0";

    try {
        $rs = mysqli_query($db, $sql);
    } catch (Exception $e) {
        $rs = false;
        echo 'Выброшено исключение: ', $e->getMessage(), "\n";
        echo '</br>';
    }
    $rs = createSmartyRsArray($rs);
    if ($rs) {
        $quanProduct = count($rs);
    } else {
        $quanProduct = 0;
    }
    //d($rs);
    return $quanProduct;
}

function checkLevelGroup($parentId)
{
    global $db;
    $sql = "SELECT * FROM `bt_product_to_category` WHERE `category_id` = $parentId";
    try {
        $rs = mysqli_query($db, $sql);
    } catch (Exception $e) {
        $rs = false;
        echo 'Выброшено исключение: ', $e->getMessage(), "\n";
        echo '</br>';
    }
    $rs = createSmartyRsArray($rs);
    //d($rs);
    return $rs;
}

function getProductFromIdUserGroup($productId, $userGroup = -1)
{
    global $db;

    $userGroup = getCheckUserGroup(0, $userGroup);
    $userGroupAction = getCheckUserGroup(2, $userGroup);
    $userGroupDescription = getCheckUserGroup(3, $userGroup);

    $sql = "SELECT pro.article, pro.image, dat.date_available, " .
        "des.name, des.description, pri.price, act.quantity " .
        "FROM `bt_product` AS pro " .
        "JOIN `bt_product_quantity` AS act ON pro.product_id = act.product_id " .
        "JOIN `bt_product_description` AS des ON pro.product_id = des.product_id " .
        "JOIN `bt_product_price` AS pri ON pro.product_id = pri.product_id " .
        "JOIN `bt_product_to_category` AS cat ON pro.product_id = cat.product_id " .
        "JOIN `bt_product_date_available` AS dat ON pro.product_id = dat.product_id " .
        "WHERE pro.product_id = $productId AND act.user_group = $userGroupAction AND " .
        " des.user_group = $userGroupDescription AND dat.user_group = $userGroupDescription " .
        "AND pri.user_group = $userGroup ";
    //d($sql);
    try {
        $rs = mysqli_query($db, $sql);
    } catch (Exception $e) {
        $rs = false;
        echo 'Выброшено исключение: ', $e->getMessage(), "\n";
        echo '</br>';
    }
    $rs = createSmartyRsArray($rs);
    if ($rs) {
        $rs = $rs[0];
        if ($userGroup == 4) {
            $rs['currency'] = 'т';
        } else {
            $rs['currency'] = 'руб';
        }
    }
    //d($rs);
    if (array_key_exists('description', $rs)) {
        $rs['description'] = htmlspecialchars_decode($rs['description']);
    }
    return $rs;

}

function request($sql)
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

function checkParameter($fieldRequest, $parameter, $userGroupCur = array(), $add = true)
{
    global $userGroupSt;
    $resData = array();
    if (is_array($fieldRequest)) {
        if ($parameter == 'productId') {
            if (array_key_exists('productId', $fieldRequest)) {
                $productId = $fieldRequest['productId'];
                $productId = intval($productId);
                if ($productId > 0) {
                    $res = request("select * from `bt_product` where `product_id` = '$productId' limit 1");
                    if ($add) {
                        if ($res) {
                            $count = mysqli_num_rows($res);
                        } else {
                            $count = 1;
                        }
                        if ($count == 0) {
                            $resData['success'] = true;
                            $resData['parameter'] = $productId;
                        } else {
                            $resData['error'] = 'id product already exists';
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
                            $resData['parameter'] = $productId;
                        } else {
                            $resData['error'] = 'id product not exists';
                            $resData['success'] = false;
                        }
                    }
                } else {
                    $resData['error'] = 'productId must be greater than zero';
                    $resData['success'] = false;
                }
            } else {
                $resData['error'] = 'productId is necessary parametr';
                $resData['success'] = false;
            }

        } elseif ($parameter == 'article') {
            if (array_key_exists('article', $fieldRequest)) {
                $article = $fieldRequest['article'];
                if (!empty($article)) {
                    $resData['success'] = true;
                    $resData['parameter'] = $article;
                } else {
                    $resData['error'] = 'article is empty';
                    $resData['success'] = false;
                }
            } else {
                $resData['error'] = 'article is necessary parametr';
                $resData['success'] = false;
            }
        } elseif ($parameter == 'categoryId') {
            if (array_key_exists('categoryId', $fieldRequest)) {
                $categoryId = $fieldRequest['categoryId'];
                $categoryId = intval($categoryId);
                if ($categoryId > 0) {
                    $res = request("select * from bt_category where category_id = '$categoryId' limit 1");
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
                } else {
                    $resData['error'] = 'categoryId must be greater than zero';
                    $resData['success'] = false;
                }
            } else {
                $resData['error'] = 'categoryId is necessary parametr';
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
                            if (is_array($des)) {
                                $descr[$key] = $des;
                                if (array_key_exists('name', $des) && !empty($des['name'])) {
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
        } elseif ($parameter == 'order' || $parameter == 'price' ||
            $parameter == 'quantity' || $parameter == 'date_available') {
            $param = array();
            if (array_key_exists($parameter, $fieldRequest)) {
                $fields = $fieldRequest[$parameter];
                if (is_array($fields)) {
                    foreach ($fields as $key => $fil) {
                        if (in_array($key, $userGroupCur)) {
                            if (array_key_exists($parameter, $fil)) { //&& !empty($fil[$parameter])
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

function getSqlForFields($fieldRequest, $field, $userGroupCur, $tabel, $fieldTabel, $productId)
{
    $checkParameter = checkParameter($fieldRequest, $field, $userGroupCur);
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
                    "(`product_id`, `user_group`, `name`";
                foreach ($btProductDescriptionInLoad as $btDes) {
                    $sql .= ", `$btDes`";
                }
                $sql .= ') VALUES';
                foreach ($order as $key => $des) {
                    if (is_array($des)) {
                        if (array_key_exists('name', $des) && !empty($des['name'])) {
                            $sql .= "('$productId', '$key', '{$des['name']}'";
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
                    "(`product_id`, `user_group`, `$fieldTabel`) VALUES";

                foreach ($order as $key => $ord) {
                    $fl = true;
                    $sql .= "('$productId', '$key', '$ord'),";
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

function addProduct($fieldRequest)
{
    global $userGroupSt;
    global $userGroupMd;
    global $userGroupLg;
    $btProduct = array('image', 'manufacturer_id', 'weight', 'lenght', 'widht', 'height');
    $resData = array();
    $checkParameter = checkParameter($fieldRequest, 'productId');
    if ($checkParameter['success']) {
        $productId = $checkParameter['parameter'];
        $checkParameter = checkParameter($fieldRequest, 'article');
        if ($checkParameter['success']) {
            $article = $checkParameter['parameter'];
            $checkParameter = checkParameter($fieldRequest, 'categoryId');
            if ($checkParameter['success']) {
                $categoryId = $checkParameter['parameter'];
                $checkParameter = checkParameter($fieldRequest, 'description', $userGroupSt);
                if ($checkParameter['success']) {
                    $sql = 'INSERT INTO `bt_product`(`product_id`, `article`';
                    $values = " VALUES ('$productId','$article'";
                    foreach ($btProduct as $field) {
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
                    $rs = request($sql . $values);
                    $rs = true;
                    if ($rs) {
                        $resData['success'] = true;
                        $sql = 'INSERT INTO `bt_product_to_category`(`product_id`, `category_id`)' .
                            " VALUES ('$productId','$categoryId')";
                        $rs = request($sql);
                        if (!$rs) {
                            $resData['error'] = 'failed to record category of product';
                        }
                        $sql = getSqlForFields($fieldRequest, 'order', $userGroupMd,
                            'bt_product_order', 'sort_order', $productId);
                        if ($sql) {
                            $rs = request($sql);
                        }
                        $sql = getSqlForFields($fieldRequest, 'price', $userGroupLg,
                            'bt_product_price', 'price', $productId);
                        if ($sql) {
                            $rs = request($sql);
                        }
                        $sql = getSqlForFields($fieldRequest, 'quantity', $userGroupMd,
                            'bt_product_quantity', 'quantity', $productId);
                        if ($sql) {
                            $rs = request($sql);
                        }
                        $sql = getSqlForFields($fieldRequest, 'date_available', $userGroupSt,
                            'bt_product_date_available', 'date_available', $productId);
                        if ($sql) {
                            $rs = request($sql);
                        }
                        $sql = getSqlForFields($fieldRequest, 'description', $userGroupSt,
                            'bt_product_description', '', $productId);
                        if ($sql) {
                            $rs = request($sql);
                            if (!$rs) {
                                if (empty($resData['error'])) {
                                    $resData['error'] = 'failed to write name';
                                } else {
                                    $resData['error'] = $resData['error'] . '; failed to write name';
                                }
                            }
                        }
                    } else {
                        $resData['error'] = 'failed to add a line';
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
    } else {
        $resData['error'] = $checkParameter['error'];
        $resData['success'] = false;
    }
    return $resData;
}

function getSqlForDelete($table, $productId)
{
    $sql = "DELETE FROM `$table` WHERE `product_id` = '$productId'";
    return $sql;
}

function deleteProduct($productId)
{
    $productId = intval($productId);
    if ($productId > 0) {
        $res = true;
        $sql = getSqlForDelete('bt_product', $productId);
        $rs = request($sql);
        $res = $res && $rs;
        $sql = getSqlForDelete('bt_product_to_category', $productId);
        $rs = request($sql);
        $res = $res && $rs;
        $sql = getSqlForDelete('bt_product_description', $productId);
        $rs = request($sql);
        $res = $res && $rs;
        $sql = getSqlForDelete('bt_product_date_available', $productId);
        $rs = request($sql);
        $res = $res && $rs;
        $sql = getSqlForDelete('bt_product_quantity', $productId);
        $rs = request($sql);
        $res = $res && $rs;
        $sql = getSqlForDelete('bt_product_price', $productId);
        $rs = request($sql);
        $res = $res && $rs;
        $sql = getSqlForDelete('bt_product_order', $productId);
        $rs = request($sql);
        $res = $res && $rs;
    } else {
        $res = false;
    }
    $resData['success'] = $res;
    return $resData;
}

function getDataFromLocalTable($tab, $productId)
{
    $sql = "SELECT * FROM `$tab` WHERE `product_id` = $productId";
    $resData = array();
    $rs = request($sql);
    $res = createSmartyRsArray($rs);
    if ($res) {
        foreach ($res as $values) {
            if (is_array($values)) {
                $userGroup = false;
                if (array_key_exists('user_group', $values) && (!empty($values['user_group']))) {
                    $userGroup = $values['user_group'];
                    $resData[$userGroup] = array();
                }
                if ($userGroup) {
                    foreach ($values as $key => $val) {
                        if (isset($val) && ($key != 'user_group') && ($key != 'product_id')) {
                            $resData[$userGroup][$key] = $val;
                        }
                    }
                }
            }
        }
    }
    return $resData;
}

function getProduct($productId)
{
    $resData = array();
    $fieldRequest['productId'] = $productId;
    $checkParameter = checkParameterCategory($fieldRequest, 'categoryId', $resData, false);
    if ($checkParameter['success']) {
        $resData['productId'] = $productId;
        $sql = 'SELECT `article`, `image`, `manufacturer_id`, `weight`, `lenght`, `widht`, `height`,' .
            " `date_added`, `date_modified` FROM `bt_product` WHERE `product_id` = $productId";
        $rs = request($sql);
        $res = createSmartyRsArray($rs);
        if ($res) {
            foreach ($res as $value) {
                if (is_array($value)) {
                    foreach ($value as $key => $val) {
                        if (!is_null($val)) {
                            $resData[$key] = $val;
                        }
                    }
                }
            }
        }
    } else {
        $resData['productId'] = "$productId not found";
    }
    $sql = 'SELECT `category_id`, `date_modified` FROM `bt_product_to_category`' .
        " WHERE `product_id` = $productId";
    $rs = request($sql);
    $res = createSmartyRsArray($rs);
    if ($res) {
        foreach ($res as $value) {
            if (is_array($value)) {
                if (array_key_exists('category_id', $value) && (!empty($value['category_id']))) {
                    $resData['categoryId'] = $value['category_id'];
                }
                if (array_key_exists('date_modified', $value) && (!empty($value['date_modified']))) {
                    $resData['date_modified_category'] = $value['date_modified'];
                }
            }
        }
    }

    $res = getDataFromLocalTable('bt_product_order', $productId);
    if (!empty($res)) {
        $resData['order'] = $res;
    }
    $res = getDataFromLocalTable('bt_product_price', $productId);
    if (!empty($res)) {
        $resData['price'] = $res;
    }
    $res = getDataFromLocalTable('bt_product_quantity', $productId);
    if (!empty($res)) {
        $resData['quantity'] = $res;
    }
    $res = getDataFromLocalTable('bt_product_date_available', $productId);
    if (!empty($res)) {
        $resData['date_available'] = $res;
    }
    $res = getDataFromLocalTable('bt_product_description', $productId);
    if (!empty($res)) {
        $resData['description'] = $res;
    }

    return $resData;
}

function getSqlForFieldsUpdate($fieldRequest, $field, $userGroupCur, $tabel, $fieldTabel, $productId)
{
    $checkParameter = checkParameter($fieldRequest, $field, $userGroupCur, false);
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
                        $sqlSt = "INSERT INTO `$tabel` (`product_id`, `user_group`";
                        $sqlVal = "('$productId', '$key'";
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
                    "(`product_id`, `user_group`, `$fieldTabel`, `date_modified`) VALUES";
                foreach ($order as $key => $ord) {
                    $fl = true;
                    $sql .= "('$productId', '$key', '$ord', NOW()),";
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

function updateProduct($fieldRequest)
{
    global $userGroupSt;
    global $userGroupMd;
    global $userGroupLg;
    $btProduct = array('article', 'image', 'manufacturer_id', 'weight',
        'lenght', 'widht', 'height');
    $resData = array();
    $checkParameter = checkParameter($fieldRequest, 'productId', $userGroupLg, false);
    if ($checkParameter['success']) {
        $productId = $checkParameter['parameter'];
        $sql = 'UPDATE `bt_product` SET';
        foreach ($btProduct as $field) {
            if (array_key_exists($field, $fieldRequest)) {
                $val = $fieldRequest[$field];
                if (isset($val)) {
                    $sql .= " `$field` = '$val',";
                }
            }
        }
        $sql .= " `date_modified` = NOW() WHERE `product_id`=$productId";
        $rs = request($sql);
        if ($rs) {
            $resData['success'] = true;
        }
        $checkParameter = checkParameter($fieldRequest, 'categoryId');
        if ($checkParameter['success']) {
            $categoryId = $checkParameter['parameter'];
            $sql = 'INSERT INTO `bt_product_to_category` ' .
                '(`product_id`, `category_id`, `date_modified`) VALUES ' .
                "('$productId', '$categoryId', NOW()) " .
                'ON DUPLICATE KEY UPDATE ' .
                "`category_id`=VALUES(`category_id`), `date_modified`=VALUES(`date_modified`)";
            $rs = request($sql);
            if ($rs) {
                $resData['success'] = true;
            }
        }
        $sql = getSqlForFieldsUpdate($fieldRequest, 'order', $userGroupMd,
            'bt_product_order', 'sort_order', $productId);
        if ($sql) {
            $rs = request($sql);
        }
        $sql = getSqlForFieldsUpdate($fieldRequest, 'price', $userGroupLg,
            'bt_product_price', 'price', $productId);
        if ($sql) {
            $rs = request($sql);
        }
        $sql = getSqlForFieldsUpdate($fieldRequest, 'quantity', $userGroupMd,
            'bt_product_quantity', 'quantity', $productId);
        if ($sql) {
            $rs = request($sql);
        }
        $sql = getSqlForFieldsUpdate($fieldRequest, 'date_available', $userGroupSt,
            'bt_product_date_available', 'date_available', $productId);
        if ($sql) {
            $rs = request($sql);
        }
        $sqlUpd = getSqlForFieldsUpdate($fieldRequest, 'description', $userGroupSt,
            'bt_product_description', '', $productId);
        foreach ($sqlUpd as $sql) {
            if ($sql) {
                $rs = request($sql);
            }
        }
        //} else {
        //    $resData['error'] = 'failed to add a line';
        //    $resData['success'] = false;
        //}

    } else {
        $resData['error'] = $checkParameter['error'];
        $resData['success'] = false;
    }
    return $resData;
}

function getProductsSearch($words, $imageDefProd = '', $userGroup = -1, $startPosition = 0, $quantity = 0)
{
    global $db;
    $userGroup = getCheckUserGroup(0, $userGroup);
    $userGroupAction = getCheckUserGroup(2, $userGroup);
    $userGroupDescription = getCheckUserGroup(3, $userGroup);
    $sql = 'SELECT des.product_id, des.name, des.description, pro.article, ' .
	        "CASE WHEN pro.image='' THEN '$imageDefProd' ELSE pro.image END as `image`, " .
			'pri.price, cat.category_id, act.quantity ' .
	  	    'FROM `bt_product_description` AS des ' .
	        'JOIN `bt_product` AS pro ON pro.product_id = des.product_id ' .
	        'JOIN `bt_product_price` AS pri ON des.product_id = pri.product_id '.
	        'JOIN `bt_product_to_category` AS cat ON des.product_id = cat.product_id '.
	        'JOIN `bt_product_quantity` AS act ON des.product_id = act.product_id '.
	    	"WHERE des.user_group = $userGroupDescription AND pri.user_group = $userGroup " .
            "AND act.user_group = $userGroupAction AND " .
            'act.quantity > 0 AND ' .
            "MATCH (des.name) AGAINST ('$words')";
    if ($quantity > 0) {
        $sql .= " LIMIT $startPosition, $quantity";
    }
    try {
        $rs = mysqli_query($db, $sql);
    } catch (Exception $e) {
        $rs = false;
        echo 'Выброшено исключение: ', $e->getMessage(), "\n";
        echo '</br>';
    }
    $rs = createSmartyRsArray($rs);
    //d($rs);
    return $rs;

}
