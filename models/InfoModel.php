<?php

include_once '../models/UsersModel.php';

/**
 * получить массив phone, email в зависимости от группы пользователя
 * @param integer $userGroup группа пользователя по умолчанию из сессии
 * @return array массив данных
 */
function getInfoHeadByUserGroup($userGroup = -1)
{
    global $db; 

    $userGroup = getCheckUserGroup(2, $userGroup); 
 
    $sql = "SELECT `phone`, `email` " .
           "FROM `bt_info_head` WHERE `user_group` = $userGroup";
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
        getInfoHeadByUserGroup(0);
    }
    return $rs;
}

/**
 * получить массив информационных статей в зависимости от группы пользователя
 * @param integer $userGroup группа пользователя по умолчанию из сессии
 * @return array массив статей
 */
function getInfoArticleByUserGroup($userGroup = -1)
{
    global $db;

    $userGroup = getCheckUserGroup(2, $userGroup);

    $sql = "SELECT `article_question`, `article_deliver`, `article_main` " .
           "FROM `bt_info_head` WHERE `user_group` = $userGroup";
           
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
        getInfoArticleByUserGroup(0);
    }
    return $rs;
}

