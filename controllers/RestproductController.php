<?php

/**
 * контроллер rest products (rest/product/action/parametrs)
 * 
 */

// подключаем модели
include_once '../models/ProductsModel.php';

function addAction()
{
    $fields = array('productId', 'article', 'image', 'manufacturer_id', 
                    'weight', 'lenght','widht','height','categoryId','key',
                    'description','date_available','quantity','price','order'); 
    $fieldsComplex = array('description','date_available','quantity','price','order');                 
        //'{"userGroup1":{"key1":"value1","key2":"value2"}, "userGroup2":{"key1":"value1","key2":"value2"}}'

    $fieldRequest = array();  
    foreach ($fields as $field) {
        $fieldValue = isset($_POST[$field]) ? $_POST[$field] : NULL;
        if (in_array($field, $fieldsComplex)) {
            $fieldRequest[$field] = json_decode($fieldValue, true);
        } else {
            $fieldRequest[$field] = $fieldValue;
        }
    }

    if ($fieldRequest['key'] == REST_KEY) {
    $resData = addProduct($fieldRequest);
    $resData['pass'] = true;
    } else {
      $resData['pass'] = false;
    }
    echo json_encode($resData); 
}

function deleteAction()
{
    $productId = isset($_POST['productId']) ? $_POST['productId'] : NULL;
    $key = isset($_POST['key']) ? $_POST['key'] : NULL;

    if ($key == REST_KEY) {
    $resData = deleteProduct($productId);
    $resData['pass'] = true;
    } else {
      $resData['pass'] = false;
    }
    echo json_encode($resData); 
}

function getAction()
{
    $productId = isset($_POST['productId']) ? $_POST['productId'] : NULL;
    $key = isset($_POST['key']) ? $_POST['key'] : NULL;

    if ($key == REST_KEY) {
    $resData = getProduct($productId);
    $resData['pass'] = true;
    } else {
      $resData['pass'] = false;
    }
    echo json_encode($resData); 
}

function updateAction()
{
    $fields = array('productId', 'article', 'image', 'manufacturer_id', 
                    'weight', 'lenght','widht','height','categoryId','key',
                    'description','date_available','quantity','price','order'); 
    $fieldsComplex = array('description','date_available','quantity','price','order');                 
        //'{"userGroup1":{"key1":"value1","key2":"value2"}, "userGroup2":{"key1":"value1","key2":"value2"}}'

    $fieldRequest = array();  
    foreach ($fields as $field) {
        $fieldValue = isset($_POST[$field]) ? $_POST[$field] : NULL;
        if (in_array($field, $fieldsComplex)) {
            $fieldRequest[$field] = json_decode($fieldValue, true);
        } else {
            $fieldRequest[$field] = $fieldValue;
        }
    }

    if ($fieldRequest['key'] == REST_KEY) {
    $resData = updateProduct($fieldRequest);
    $resData['pass'] = true;
    } else {
      $resData['pass'] = false;
    }
    echo json_encode($resData); 
}