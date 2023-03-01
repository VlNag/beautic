<?php

/**
 * контроллер rest category (rest/category/action/parametrs)
 * 
 */

// подключаем модели
include_once '../models/CategoriesModel.php';

function addAction() {
    $fields = array('categoryId', 'parentId', 'image', 'top', 'column', 'key',
                    'description','active','order'); 
    $fieldsComplex = array('description','active','order');                 
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
    $resData = addCategory($fieldRequest);
    $resData['pass'] = true;
    } else {
      $resData['pass'] = false;
    }
    echo json_encode($resData); 
}

function deleteAction()
{
    $categoryId = isset($_POST['categoryId']) ? $_POST['categoryId'] : NULL;
    $key = isset($_POST['key']) ? $_POST['key'] : NULL;

    if ($key == REST_KEY) {
    $resData = deleteCategory($categoryId);
    $resData['pass'] = true;
    } else {
      $resData['pass'] = false;
    }
    echo json_encode($resData); 
}

function getAction()
{
    $categoryId = isset($_POST['categoryId']) ? $_POST['categoryId'] : NULL;
    $key = isset($_POST['key']) ? $_POST['key'] : NULL;

    if ($key == REST_KEY) {
    $resData = getCategory($categoryId);
    $resData['pass'] = true;
    } else {
      $resData['pass'] = false;
    }
    echo json_encode($resData); 
}

function updateAction() {
    $fields = array('categoryId', 'parentId', 'image', 'top', 'column', 'key',
                    'description','active','order'); 
    $fieldsComplex = array('description','active','order');                 
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
    $resData = updateCategory($fieldRequest);
    $resData['pass'] = true;
    } else {
      $resData['pass'] = false;
    }
    echo json_encode($resData); 
}

function setupdateAction() {
    $key = isset($_POST['key']) ? $_POST['key'] : NULL;

    if ($key == REST_KEY) {
        setCategoryUpdate();
        $resData['pass'] = true;
    } else {
      $resData['pass'] = false;
    }
    echo json_encode($resData); 
}

function updatelastcategoriesAction() {
    $key = isset($_POST['key']) ? $_POST['key'] : NULL;

    if ($key == REST_KEY) {
        $resData['success'] = updateLastCategories();
        $resData['pass'] = true;
    } else {
      $resData['pass'] = false;
    }
    echo json_encode($resData); 
}    