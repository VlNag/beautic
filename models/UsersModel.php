<?php

/**
 * проверка группы пользователей на валидность
 * 
 * @param integer $userGroup
 * @return integer если $userGroup не в таблице bt_user_group тогда 0 иначе $userGroup  
 */
function checkUserGroup($userGroup)
{
    global $db;
    $userGroup = intval($userGroup);
    $sql = "SELECT * ".
           "FROM `bt_user_group` WHERE `user_group_id` = $userGroup";
        try {
            $rs = mysqli_query($db, $sql);
        }
        catch (Exception $e) {
            $rs = false;
        }
        $rs = createSmartyRsArray($rs);
    if (! $rs) {
        $userGroup = 0;
    } 
    return $userGroup;
} 

function getCheckUserGroup($unity = 0, $userGroup = -1)
{
    if ($userGroup == -1) {
        $curUserGroup = getUserGroup($unity);
    } else {
        $curUserGroup = $userGroup;
    } 
        $curUserGroup = checkUserGroup($curUserGroup);
        $curUserGroup = getUserGroup($unity, $curUserGroup);

    return $curUserGroup;   
}

function requestUser($sql)
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

function checkParameterUser($fieldRequest, $parameter, $add = true)
{
    global $db; 
    $resData = array();
    if (is_array($fieldRequest)) {
        if ($parameter == 'login') {
            if (array_key_exists('login', $fieldRequest)) {
                $login = $fieldRequest['login'];
                
                if (isset($login) && $login != '') {
                    // PARAMETER 
                    //$res = requestUser("select * from `bt_user` where `login` = '$login' limit 1");
                    $sql = "select * from `bt_user` where `login` = ? limit 1";
                    $stmt = mysqli_prepare($db, $sql);
                    mysqli_stmt_bind_param($stmt, 's', $login);
                    $res = mysqli_stmt_execute($stmt);

                    if ($add) {
                        if ($res) {
                            $count = mysqli_num_rows($res);
                        } else {
                            $count = 1;
                        }
                        if ($count == 0) {
                            $resData['success'] = true;
                            $resData['parameter'] = $login;
                        } else {
                            $resData['error'] = 'login already exists';
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
                            $resData['parameter'] = $login;
                        } else {
                            $resData['error'] = 'login not exists';
                            $resData['success'] = false;
                        }
                    }
                } else {
                    $resData['error'] = 'login must be not empty';
                    $resData['success'] = false;
                }
            } else {
                $resData['error'] = 'login is necessary parametr';
                $resData['success'] = false;
            }
        } elseif ($parameter == 'user_group') {
            if (array_key_exists('user_group', $fieldRequest)) {
                $user_group = $fieldRequest['user_group'];
                $user_group = intval($user_group);
                if (checkUserGroup($user_group) == 0) {
                    $user_group = 1; 
                }
                    $resData['success'] = true;
                    $resData['parameter'] = $user_group;
            } else {
                $resData['error'] = 'user group is necessary parametr';
                $resData['success'] = false;
            }
        } elseif ($parameter == 'password') {
            if (array_key_exists('password', $fieldRequest)) {
            $password = $fieldRequest['password'];
            // добавить проверку условия смены пароля !!!!!!!!!!!!!!!!!!!!!!!
            if (isset($password) && $password != '') {
                $resData['success'] = true;
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $resData['parameter'] = $hash;
            } else {
                $resData['error'] = 'the password cannot be empty';
                $resData['success'] = false;
            }
            } else {
                $resData['error'] = 'password is necessary parametr';
                $resData['success'] = false; 
            }
        }
    } else {
        $resData['error'] = 'main parametr is not array';
        $resData['success'] = false;
    }
    return $resData;
}

function getIp() 
{
    $keys = [
      'HTTP_CLIENT_IP',
      'HTTP_X_FORWARDED_FOR',
      'REMOTE_ADDR'
    ];
    $ip = '0.0.0.0';
    foreach ($keys as $key) {
      if ((isset($_SERVER[$key]))&&(!empty($_SERVER[$key]))) {
        $serK = $_SERVER[$key];
        $serK = explode(',', $serK);
        $ipTmp = trim(end($serK));
        if (filter_var($ipTmp, FILTER_VALIDATE_IP)) {
           $ip = $ipTmp;
        }
      }
    }
    return $ip;
}

function addUser($fieldRequest)
{
    global $db; 
    $fieldInt = array('xml_id', 'mailing', 'role');
    $fieldContact = array('email', 'phone', 'address');    
    $fieldStr = array('user_name', 'source', 'conditions', 'settings');
    $resData = array();
    $checkParameter = checkParameterUser($fieldRequest, 'login');
    if ($checkParameter['success']) {
        $login = $checkParameter['parameter']; 
        $checkParameter = checkParameterUser($fieldRequest, 'user_group');
        $ip = getIp();
        if ($checkParameter['success']) {
            $user_group = $checkParameter['parameter']; 
        } else {
            // подключим файл SxGeo.php
            require_once '../library/SxGeo.php';
            // создадим объект SxGeo (1 аргумент – имя файла базы данных, 2 аргумент – режим работы: SXGEO_FILE (по умолчанию), SXGEO_BATCH  (пакетная обработка, увеличивает скорость при обработке множества IP за раз), SXGEO_MEMORY (кэширование БД в памяти, еще увеличивает скорость пакетной обработки, но требует больше памяти, для загрузки всей базы в память).
            $SxGeo = new SxGeo('../library/SxGeo.dat', SXGEO_BATCH | SXGEO_MEMORY);
            // получаем двухзначный ISO-код страны (RU, UA и др.)
            $country_code = $SxGeo->getCountry($ip);
            if ($country_code == 'KZ') {
                $user_group = 4; 
            } else {
                $user_group = 1; 
            }
        }  
        $checkParameter = checkParameterUser($fieldRequest, 'password');
        if ($checkParameter['success']) {
            $password = $checkParameter['parameter']; 
            $sqlStart =  'INSERT INTO `bt_user`(`login`, `user_group`, `password`,`ip`,';
            $sqlEnd =  ' VALUES (?,?,?,?,';
            $params = 'siss';   
            $param = array(&$params, &$login, &$user_group, &$password, &$ip);
            foreach ($fieldInt as $field) {
                if (array_key_exists($field, $fieldRequest)) {
                    //$fieldAdd = $fieldRequest[$field];
                    $sqlStart .= "`$field`,";
                    $sqlEnd .=  '?,';
                    $params .= 'i';   
                    $param[] = &$fieldRequest[$field]; 
                } 
            }
            foreach ($fieldContact as $field) {
                if (array_key_exists($field, $fieldRequest)) {
                    //$fieldAdd = $fieldRequest[$field];
                    $sqlStart .= "`has_$field`,";
                    $sqlEnd .=  "'1',";
                    //$params .= 'i';   
                    //$param[] = &$fieldAdd; 
                } 
            }           
            foreach ($fieldStr as $field) {
                if (array_key_exists($field, $fieldRequest)) {
                    //$fieldAdd = $fieldRequest[$field];
                    $sqlStart .= "`$field`,";
                    $sqlEnd .=  '?,';
                    $params .= 's';   
                    $param[] = &$fieldRequest[$field]; 
                } 
            }
            $sqlStart .= '`date_added`)';
            $sqlEnd .=  ' NOW())';
           
            $stmt = mysqli_prepare($db, $sqlStart . $sqlEnd);
            call_user_func_array(array($stmt, 'bind_param'), $param);
            //mysqli_stmt_bind_param($stmt, $param, $login, $user_group, $password, $ip);
            $rs = mysqli_stmt_execute($stmt);
            $resData['success'] = $rs; 
        } else {
            $resData['error'] = $checkParameter['error'];
            $resData['success'] = false;  
        } 
    } else {
        $resData['error'] = $checkParameter['error'];
        $resData['success'] = false;
    }
    if ($resData['success']) {
        $res = requestUser("select `user_id` from `bt_user` where `login` = '$login'");
        $rs = createSmartyRsArray($res);
        if ($rs) {
            $user_id = $rs[0]['user_id'];
            $sql = 'INSERT INTO `bt_user_activity`(`user_id`, `key`, `data`, `ip`, `date_added`)'.
                " VALUES ('$user_id','added','','$ip',NOW())";
            $res = requestUser($sql);
            $sql = 'INSERT INTO `bt_user_ip`(`user_id`, `ip`, `date_added`)'.
                " VALUES ('$user_id','$ip',NOW())";
            $res = requestUser($sql);
            $resData['user_id'] = $user_id;
            foreach ($fieldContact as $field) {
                if (array_key_exists($field, $fieldRequest)) {
                    $fieldAdd = $fieldRequest[$field]; 
                    if(is_array($fieldAdd)) {
                        $i = 0; 
                        $sql =  'INSERT INTO `bt_user_contact` (`user_id`, `type_contact`, ' .
                        '`view_contact`, `content`, `number_contact`, `comment`)';
                        $sql .=  " VALUES ($user_id,'$field',?,?,?,?)";
                        $stmt = mysqli_prepare($db, $sql);
                        foreach($fieldAdd as $fil) {
                            if (isset($fil['content'])) {
                                $content = $fil['content'];
                                if ($field == 'phone') {
                                    $content = mb_ereg_replace("[^0-9]",'',$content);
                                }
                                if ($field == 'email') {
                                    //$content = ereg_replace("[^0-9]",'',$content);
                                }
                                if (isset($fil['view_contact'])) {
                                    $view = $fil['view_contact'];
                                } else {
                                    //$view = 'home';
                                    $view = '';
                                }
                                if (isset($fil['comment'])) {
                                    $comment = $fil['comment'];
                                } else {
                                    $comment = '';
                                }
                            mysqli_stmt_bind_param($stmt, 'ssis', $view, $content, $i, $comment);
                            $rs = mysqli_stmt_execute($stmt);
                            $i++;
                            }
                            //$param = array(&$params, &$login, &$user_group, &$password, &$ip);
                        }
                    }
                } 
            }           
        }
        if (array_key_exists('register', $fieldRequest)) {
            $register = $fieldRequest['register'];
            if ($register == 'Y') {
                if (isset($_SESSION['user'] )) {
                    $user = $_SESSION['user'];
                    if (isset($user['login'])) {
                        $loginCur = $user['login'];
                        if (empty($loginCur)){
                            $sql = 'INSERT INTO `bt_user_update`(`user_id`, `date_added`)' .
                                " VALUES ('$user_id',NOW())" . 
                                ' ON DUPLICATE KEY UPDATE `date_added`=VALUES(`date_added`)';
                            $res = requestUser($sql);
                        } else {
                            $sql = 'INSERT INTO `bt_user_update`(`user_id`, `date_added`, `login`)' .
                            " VALUES ('$user_id',NOW(),?)" . 
                            ' ON DUPLICATE KEY UPDATE `date_added`=VALUES(`date_added`)';
                            $stmt = mysqli_prepare($db, $sql);
                            mysqli_stmt_bind_param($stmt, 's', $loginCur);
                            $rs = mysqli_stmt_execute($stmt);
                        }
                    }
                }
            }
        } 
    }
    return $resData;
}

function getSqlForDeleteUser($table, $userId)
{
    $sql = "DELETE FROM `$table` WHERE `user_id` = '$userId'";
    return $sql; 
}

function deleteUser($userId)
{
    $userId = intval($userId);
    if ($userId > 0) {
        $res = true;
        $sql = getSqlForDeleteUser('bt_user', $userId);
        $rs = requestUser($sql);
        $res = $res && $rs;
        $sql = getSqlForDeleteUser('bt_user_contact', $userId);
        $rs = requestUser($sql);
        $res = $res && $rs;
        $sql = getSqlForDeleteUser('bt_user_activity', $userId);
        $rs = requestUser($sql);
        $res = $res && $rs;
        $sql = getSqlForDeleteUser('bt_user_ip', $userId);
        $rs = requestUser($sql);
        $res = $res && $rs;
        $sql = getSqlForDeleteUser('bt_user_login', $userId);
        $rs = requestUser($sql);
        $res = $res && $rs;
        $sql = getSqlForDeleteUser('bt_user_wishlist', $userId);
        $rs = requestUser($sql);
        $res = $res && $rs;
        $sql = getSqlForDeleteUser('bt_user_update', $userId);
        $rs = requestUser($sql);
        $res = $res && $rs;       
        $sql = getSqlForDeleteUser('bt_user_updatepass', $userId);
        $rs = requestUser($sql);
        $res = $res && $rs;              
    } else {
        $res = false;
    }
    $resData['success'] = $res;
    return $resData;
}
 
function getUser($fieldRequest)
{
    global $lgLen, $mdLen, $smLen; 
    $user_id = 0;
    if (array_key_exists('user_id', $fieldRequest)) {
        $user_id = $fieldRequest['user_id'];
        $user_id = intval($user_id);
    }
    if ($user_id <= 0) {
        if (array_key_exists('login', $fieldRequest)) {
            $login = $fieldRequest['login'];
            $res = requestUser("select `user_id` from `bt_user` where `login` = '$login'");
            $rs = createSmartyRsArray($res);
            if ($rs) {
                $user_id = $rs[0]['user_id'];
                $user_id = intval($user_id);
            }
        }
    }  
    if ($user_id <= 0) {
        if (array_key_exists('xml_id', $fieldRequest)) {
            $xml_id = $fieldRequest['xml_id'];
            $res = requestUser("select `user_id` from `bt_user` where `xml_id` = '$xml_id'");
            $rs = createSmartyRsArray($res);
            if ($rs) {
                $user_id = $rs[0]['user_id'];
                $user_id = intval($user_id);
            }
        }
    }      
    if ($user_id > 0) {
        $resData = array();
        $resData['user_id'] = $user_id;
        $sql = 'SELECT `login`, `user_group`, `language_id`, `xml_id`, `user_name`, `ip`,' .
            ' `has_email`, `has_phone`, `has_address`, `source`, `mailing`, `conditions`,' .
            ' `role`, `date_added`, `date_modified`, `settings` FROM `bt_user`' .
            " WHERE `user_id` = $user_id";
        $rs = requestUser($sql);
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

        $name =  empty($resData['user_name']) ?  $resData['login'] : $resData['user_name']  ;
        $resData['name'] = $name;
        $lenName = mb_strlen($name);
        //$lgLen = 200;
        //$mdLen = 100;
        //$smLen = 50;  
        if ($lenName > $lgLen) {
            $resData['showName'] = 3;
        } elseif ($lenName > $mdLen ) {
            $resData['showName'] = 2;
        } elseif ($lenName > $smLen ) {
            $resData['showName'] = 1;
        } else {
            $resData['showName'] = 0;
        }

        $fieldContact = array('email', 'phone', 'address');    
        foreach ($fieldContact as $contact) {
            $sql = 'SELECT `view_contact`, `content`, `number_contact`, `comment`' .
                ' FROM `bt_user_contact` ' .
                "WHERE `user_id` = $user_id AND `type_contact` = '$contact'";
            $rs = requestUser($sql);
            $res = createSmartyRsArray($rs);
            $i = 0;
            if ($res) {
                foreach ($res as $value) {
                    foreach($value as $key => $val) {
                        $resData[$contact][$i][$key] = $val;
                    }
                    $i++; 
                }
            }        
        }
        $sql = 'SELECT `key`, `data`, `ip`, `date_added` FROM `bt_user_activity`' .
            " WHERE `user_id` = $user_id";
        $rs = requestUser($sql);
        $res = createSmartyRsArray($rs);
        $i = 0;
        if ($res) {
            foreach ($res as $value) {
                foreach($value as $key => $val) {
                    $resData['user_activity'][$i][$key] = $val;
                }
                $i++; 
            }
        }
        $sql = 'SELECT `ip`, `date_added` FROM `bt_user_ip`' .
            " WHERE `user_id` = $user_id";
        $rs = requestUser($sql);
        $res = createSmartyRsArray($rs);
        $i = 0;
        if ($res) {
            foreach ($res as $value) {
                foreach($value as $key => $val) {
                    $resData['user_ip'][$i][$key] = $val;
                }
                $i++; 
            }
        }
        $sql = 'SELECT `ip`, `date_added` FROM `bt_user_login`' .
            " WHERE `user_id` = $user_id";
        $rs = requestUser($sql);
        $res = createSmartyRsArray($rs);
        $i = 0;
        if ($res) {
            foreach ($res as $value) {
                foreach($value as $key => $val) {
                    $resData['user_login'][$i][$key] = $val;
                }
                $i++; 
            }
        }
        $sql = 'SELECT `product_id`,`link`, `date_added` FROM `bt_user_wishlist`' .
            " WHERE `user_id` = $user_id";
        $rs = requestUser($sql);
        $res = createSmartyRsArray($rs);
        $i = 0;
        if ($res) {
            foreach ($res as $value) {
                foreach($value as $key => $val) {
                    $resData['user_wishlist'][$i][$key] = $val;
                }
                $i++; 
            }
        }
        $sql = 'SELECT `product_id`,`quantity`, `date_added` FROM `bt_user_cart`' .
            " WHERE `user_id` = $user_id";
        $rs = requestUser($sql);
        $res = createSmartyRsArray($rs);
        $i = 0;
        if ($res) {
            foreach ($res as $value) {
                foreach($value as $key => $val) {
                    $resData['user_cart'][$i][$key] = $val;
                }
                $i++;
            }
        }

        $sql = 'SELECT `date_added`, `login` FROM `bt_user_update`' .
            " WHERE `user_id` = $user_id";
        $rs = requestUser($sql);
        $res = createSmartyRsArray($rs);
        $i = 0;
        if ($res) {
            foreach ($res as $value) {
                foreach($value as $key => $val) {
                    $resData['user_update'][$i][$key] = $val;
                }
                $i++; 
            }
        }
    }else {
        $resData['user_id'] = "$user_id not found";
        $resData['success'] = false;
    }
    return $resData;
}

function getUserGroupById($user_id) : int
{
    $user_group = 0;
    $sql = "SELECT `user_group` FROM `bt_user` WHERE `user_id` = $user_id";
    $res = requestUser($sql);
    if ($res) {
        $rs = createSmartyRsArray($res);
        if ($rs) {
            $user_group = $rs[0]['user_group'];
        }
    }
    return $user_group;
}

function updateUser($fieldRequest, $source = 'user_id')
{
    global $db;
    $user_id = 0;
    if ($source == 'xml_id') {
        if (array_key_exists('xml_id', $fieldRequest)) {
            $xml_id = $fieldRequest['xml_id'];
            $xml_id = intval($xml_id);
            $res = requestUser("select `user_id` from `bt_user` where `xml_id` = '$xml_id'");
            $rs = createSmartyRsArray($res);
            if ($rs) {
                $user_id = $rs[0]['user_id'];
                $user_id = intval($user_id);
            }
        }
    } else {
        if (array_key_exists('user_id', $fieldRequest)) {
            $user_id = $fieldRequest['user_id'];
            $user_id = intval($user_id);
        }
    }
    $res = requestUser("select * from `bt_user` where `user_id` = '$user_id' limit 1");
    if ($res) {
        $count = mysqli_num_rows($res);
    } else {
        $count = 0;
    }
    if ($count > 0) {
        $ip = getIp();
        $fieldInt = array('xml_id', 'mailing', 'role');
        $fieldContact = array('email', 'phone', 'address');
        $fieldStr = array('login', 'user_name', 'source', 'conditions', 'settings');
        $sql = "UPDATE `bt_user` SET `ip`='$ip',";
        $params = '';
        $param = array(&$params);

        $checkParameter = checkParameterUser($fieldRequest, 'user_group');
        if ($checkParameter['success']) {
            $user_group = $checkParameter['parameter'];
            $sql .= "`user_group`='$user_group',";
        }
        foreach ($fieldInt as $field) {
            if (array_key_exists($field, $fieldRequest)) {
                $sql .= "`$field`=?,";
                $params .= 'i';
                $param[] = &$fieldRequest[$field];
            }
        }
        foreach ($fieldContact as $field) {
            if (array_key_exists($field, $fieldRequest)) {
                $sql .= "`has_$field`=1,";
            }
        }
        foreach ($fieldStr as $field) {
            if (array_key_exists($field, $fieldRequest)) {
                $sql .= "`$field`=?,";
                $params .= 's';
                $param[] = &$fieldRequest[$field];
            }
        }
        /*
        $checkParameter = checkParameterUser($fieldRequest, 'password');
        if ($checkParameter['success']) {
            $password = $checkParameter['parameter']; 
            $sql .= "`password`=?,";
            $params .= 's';
            $param[] = &$password;
        }
        */
        $sql .= "`date_modified`=NOW() WHERE `user_id` = '$user_id'";
        $stmt = mysqli_prepare($db, $sql);
        if ($params <> '') {
            call_user_func_array(array($stmt, 'bind_param'), $param);
        }
        $rs = mysqli_stmt_execute($stmt);
        $resData['success'] = $rs;
        $resData['user_id'] = $user_id;
        if ($rs) {
            //updateSessionModification($user_id, session_id(), $_SERVER["HTTP_USER_AGENT"], time(), $ip);
            $sql = 'INSERT INTO `bt_user_activity`(`user_id`, `key`, `data`, `ip`, `date_added`)' .
                " VALUES ('$user_id','update','','$ip',NOW())";
            $res = requestUser($sql);
            $sql = 'INSERT INTO `bt_user_ip`(`user_id`, `ip`, `date_added`)' .
                " VALUES ('$user_id','$ip',NOW())";
            $res = requestUser($sql);
            if (array_key_exists('register', $fieldRequest)) {
                $register = $fieldRequest['register'];
                if ($register == 'Y') {
                    if (isset($_SESSION['user'] )) {
                        $user = $_SESSION['user'];
                        if (isset($user['login'])) {
                            $loginCur = $user['login'];
                            if (empty($loginCur)){
                                $sql = 'INSERT INTO `bt_user_update`(`user_id`, `date_added`)' .
                                    " VALUES ('$user_id',NOW())" . 
                                    ' ON DUPLICATE KEY UPDATE `date_added`=VALUES(`date_added`)';
                                $res = requestUser($sql);
                            } else {
                                $sql = 'INSERT INTO `bt_user_update`(`user_id`, `date_added`, `login`)' .
                                " VALUES ('$user_id',NOW(),?)" . 
                                ' ON DUPLICATE KEY UPDATE `date_added`=VALUES(`date_added`)';
                                $stmt = mysqli_prepare($db, $sql);
                                mysqli_stmt_bind_param($stmt, 's', $loginCur);
                                $rs = mysqli_stmt_execute($stmt);
                            }
                        }
                    }
                }
            }
            if (array_key_exists('user_wishlist', $fieldRequest)) {
                $user_wishlist = $fieldRequest['user_wishlist'];
                if (is_array($user_wishlist)) {
                    foreach ($user_wishlist as $wishlist) {
                        if (is_array($wishlist)) {
                            foreach ($wishlist as $key => $wish) {
                                $sql = 'INSERT INTO `bt_user_wishlist`(`user_id`, `product_id`, `link`, `date_added`)' .
                                " VALUES ('$user_id','$key','$wish',NOW())" .
                                ' ON DUPLICATE KEY UPDATE `date_added`=VALUES(`date_added`)';
                                //writeInFile($sql .' :: '.print_r($wishlist, true));
                                $res = requestUser($sql);
                            }
                        }
                    }    
                }
            }
            $fieldContact1 = array('email', 'phone');
            $fieldInternalContact = array('view_contact', 'content', 'comment');
            foreach ($fieldContact1 as $contact) {
                if (array_key_exists($contact, $fieldRequest)) {
                    $userContacts = $fieldRequest[$contact];
                    if (is_array($userContacts)) {
                        foreach ($userContacts as $userContact) {
                            $flUpdate = false;
                            if (isset($userContact['number_contact'])) {
                                $number_contact = $userContact['number_contact'];
                                $number_contact = intval($number_contact);
                                $sql = 'SELECT `view_contact`, `content`, `comment`' .
                                    ' FROM `bt_user_contact` WHERE ' .
                                    "`user_id` = '$user_id' AND `type_contact` = '$contact'" .
                                    " AND `number_contact` = '$number_contact'";
                                $res = requestUser($sql);
                                if ($res) {
                                    $count = mysqli_num_rows($res);
                                    if ($count > 0) {
                                        $flUpdate = true;
                                        $sql = 'UPDATE `bt_user_contact` SET';
                                        $params = '';
                                        $param = array(&$params);
                                        foreach ($fieldInternalContact as $contactInternal) {
                                            if (array_key_exists($contactInternal, $userContact)) {
                                                if ($params == '') {
                                                    $sql .= "`$contactInternal`=?";
                                                } else {
                                                    $sql .= ",`$contactInternal`=?";
                                                }
                                                $params .= 's';
                                                $param[] = &$userContact[$contactInternal];
                                            }
                                        }
                                        if ($params != '') {
                                            $sql .= " WHERE `user_id` = '$user_id' AND" .
                                                " `type_contact` = '$contact' AND" .
                                                " `number_contact` = '$number_contact'";
                                            $stmt = mysqli_prepare($db, $sql);
                                            call_user_func_array(array($stmt, 'bind_param'), $param);
                                            $rs = mysqli_stmt_execute($stmt);
                                        }
                                    }
                                }
                            }
                            if (!$flUpdate) {
                                $sql = 'SELECT MAX(`number_contact`) as max FROM `bt_user_contact`' .
                                    " WHERE `user_id` = '$user_id' AND `type_contact` = '$contact'";
                                $res = requestUser($sql);
                                $rs = createSmartyRsArray($res);
                                if ($rs) {
                                    $number_contact = $rs[0]['max'];
                                    if (is_null($number_contact)) {
                                        $number_contact = 0;
                                    } else {
                                        $number_contact = intval($rs[0]['max']) + 1;
                                    }
                                } else {
                                    $number_contact = 0;
                                }
                                $sql = 'INSERT INTO `bt_user_contact`(`user_id`, `type_contact`, ' .
                                    '`view_contact`, `content`, `comment`, `number_contact`)' .
                                    "VALUES ('$user_id','$contact',?,?,?,'$number_contact')";
                                $stmt = mysqli_prepare($db, $sql);
                                $val = array();
                                foreach ($fieldInternalContact as $contactInternal) {
                                    if (array_key_exists($contactInternal, $userContact)) {
                                        $usrContact = $userContact[$contactInternal];
                                        if (($contact == 'phone') && ($contactInternal == 'content')) {
                                            $val[] = mb_ereg_replace("[^0-9]", '', $usrContact);
                                        } else {
                                            $val[] = $usrContact;
                                        }
                                    } else {
                                        $val[] = '';
                                    }
                                }
                                mysqli_stmt_bind_param($stmt, 'sss', $val[0], $val[1], $val[2]);
                                $rs = mysqli_stmt_execute($stmt);
                            }
                        }
                    }
                }
            }
            $fieldInternalContact1 = array('content', 'comment');
            $home = 'home';
            if (array_key_exists('address', $fieldRequest)) {
                $address = $fieldRequest['address'];
                if (is_array($address)) {
                    foreach ($address as $userContact) {
                        $flUpdate = false;
                        if (isset($userContact['view_contact'])) {
                            $view_contact = $userContact['view_contact'];
                        } else {
                            $view_contact = '';
                        }
                        if (isset($userContact['number_contact'])) {
                            $number_contact = $userContact['number_contact'];
                            $number_contact = intval($number_contact);
                            if ($view_contact == $home) {
                                $sql = 'SELECT `content`, `comment`' .
                                    ' FROM `bt_user_contact` WHERE ' .
                                    "`user_id` = '$user_id' AND `type_contact` = '$contact'" .
                                    " AND `number_contact` = '$number_contact'" .
                                    " AND `view_contact` = '$view_contact'";
                                $res = requestUser($sql);
                                if ($res) {
                                    $count = mysqli_num_rows($res);
                                    if ($count > 0) {
                                        $flUpdate = true;
                                        $sql = 'UPDATE `bt_user_contact` SET';
                                        $params = '';
                                        $param = array(&$params);
                                        foreach ($fieldInternalContact1 as $contactInternal) {
                                            if (array_key_exists($contactInternal, $userContact)) {
                                                if ($params == '') {
                                                    $sql .= "`$contactInternal`=?";
                                                } else {
                                                    $sql .= ",`$contactInternal`=?";
                                                }
                                                $params .= 's';
                                                $param[] = &$userContact[$contactInternal];
                                            }
                                        }
                                        if ($params != '') {
                                            $sql .= " WHERE `user_id` = '$user_id' AND " .
                                                "`type_contact` = '$contact' AND " .
                                                "`number_contact` = '$number_contact' AND " .
                                                "`view_contact` = '$view_contact'";
                                            $stmt = mysqli_prepare($db, $sql);
                                            call_user_func_array(array($stmt, 'bind_param'), $param);
                                            $rs = mysqli_stmt_execute($stmt);
                                        }
                                    }
                                }
                            } else {
                                $sql = 'SELECT `view_contact`, `content`, `comment`' .
                                    ' FROM `bt_user_contact` WHERE ' .
                                    "`user_id` = '$user_id' AND `type_contact` = '$contact'" .
                                    " AND `number_contact` = '$number_contact'" .
                                    " AND `view_contact` <> '$home'";
                                $res = requestUser($sql);
                                if ($res) {
                                    $count = mysqli_num_rows($res);
                                    if ($count > 0) {
                                        $flUpdate = true;
                                        $sql = 'UPDATE `bt_user_contact` SET';
                                        $params = '';
                                        $param = array(&$params);
                                        foreach ($fieldInternalContact as $contactInternal) {
                                            if (array_key_exists($contactInternal, $userContact)) {
                                                if ($params == '') {
                                                    $sql .= "`$contactInternal`=?";
                                                } else {
                                                    $sql .= ",`$contactInternal`=?";
                                                }
                                                $params .= 's';
                                                $param[] = &$userContact[$contactInternal];
                                            }
                                        }
                                        if ($params != '') {
                                            $sql .= " WHERE `user_id` = '$user_id' AND " .
                                                "`type_contact` = '$contact' AND " .
                                                "`number_contact` = '$number_contact' AND " .
                                                "`view_contact` <> '$home'";
                                            $stmt = mysqli_prepare($db, $sql);
                                            call_user_func_array(array($stmt, 'bind_param'), $param);
                                            $rs = mysqli_stmt_execute($stmt);
                                        }
                                    }
                                }
                            }
                        }
                        if (!$flUpdate) {
                            if ($view_contact == $home) {
                                $sql = 'SELECT MAX(`number_contact`) as max FROM `bt_user_contact`' .
                                    " WHERE `user_id` = '$user_id' AND `type_contact` = '$contact'" .
                                    " AND `view_contact` = '$view_contact'";
                            } else {
                                $sql = 'SELECT MAX(`number_contact`) as max FROM `bt_user_contact`' .
                                " WHERE `user_id` = '$user_id' AND `type_contact` = '$contact'" .
                                " AND `view_contact` <> '$home'";
                            }
                            $res = requestUser($sql);
                            $rs = createSmartyRsArray($res);
                            if ($rs) {
                                $number_contact = $rs[0]['max'];
                                if (is_null($number_contact)) {
                                    $number_contact = 0;
                                } else {
                                    $number_contact = intval($rs[0]['max']) + 1;
                                }
                            } else {
                                $number_contact = 0;
                            }
                            $sql = 'INSERT INTO `bt_user_contact`(`user_id`, `type_contact`, ' .
                                '`view_contact`, `content`, `comment`, `number_contact`)' .
                                "VALUES ('$user_id','$contact',?,?,?,'$number_contact')";
                            $stmt = mysqli_prepare($db, $sql);
                            $val = array();
                            foreach ($fieldInternalContact as $contactInternal) {
                                if (array_key_exists($contactInternal, $userContact)) {
                                    $usrContact = $userContact[$contactInternal];
                                    if (($contact == 'phone') && ($contactInternal == 'content')) {
                                        $val[] = mb_ereg_replace("[^0-9]", '', $usrContact);
                                    } else {
                                        $val[] = $usrContact;
                                    }
                                } else {
                                    $val[] = '';
                                }
                            }
                            mysqli_stmt_bind_param($stmt, 'sss', $val[0], $val[1], $val[2]);
                            $rs = mysqli_stmt_execute($stmt);
                        }

                    }
                }
            }
        }
    } else {
        $resData['error'] = 'user not found';
        $resData['success'] = false;
    }
    return $resData;
}

function updateUserPass($fieldRequest, $source = 'user_id')
{
    global $db;
    $user_id = 0;
    if ($source == 'xml_id') {
        if (array_key_exists('xml_id', $fieldRequest)) {
            $xml_id = $fieldRequest['xml_id'];
            $xml_id = intval($xml_id);
            $res = requestUser("select `user_id` from `bt_user` where `xml_id` = '$xml_id'");
            $rs = createSmartyRsArray($res);
            if ($rs) {
                $user_id = $rs[0]['user_id'];
                $user_id = intval($user_id);
            }
        }
    } else {
        if (array_key_exists('user_id', $fieldRequest)) {
            $user_id = $fieldRequest['user_id'];
            $user_id = intval($user_id);
        }
    }
    $res = requestUser("select * from `bt_user` where `user_id` = '$user_id' limit 1");
    if ($res) {
        $count = mysqli_num_rows($res);
    } else {
        $count = 0;
    }
    if ($count > 0) {
        $ip = getIp();
        $fieldInt = array('xml_id', 'mailing', 'role');
        $fieldContact = array('email', 'phone', 'address');
        $fieldStr = array('login', 'user_name', 'source', 'conditions', 'settings');
        $sql = "UPDATE `bt_user` SET `ip`='$ip',";
        $params = '';
        $param = array(&$params);
 
        $checkParameter = checkParameterUser($fieldRequest, 'password');
        if ($checkParameter['success']) {
            $password = $checkParameter['parameter']; 
            $sql .= "`password`=?,";
            $params .= 's';
            $param[] = &$password;
        }
 
        $sql .= "`date_modified`=NOW() WHERE `user_id` = '$user_id'";
        $stmt = mysqli_prepare($db, $sql);
        if ($params <> '') {
            call_user_func_array(array($stmt, 'bind_param'), $param);
        }
        $rs = mysqli_stmt_execute($stmt);
        $resData['success'] = $rs;
        if ($rs) {
            $sql = 'INSERT INTO `bt_user_activity`(`user_id`, `key`, `data`, `ip`, `date_added`)' .
                " VALUES ('$user_id','update','','$ip',NOW())";
            $res = requestUser($sql);
            $sql = 'INSERT INTO `bt_user_ip`(`user_id`, `ip`, `date_added`)' .
                " VALUES ('$user_id','$ip',NOW())";
            $res = requestUser($sql);
        }
    } else {
        $resData['error'] = 'user not found';
        $resData['success'] = false;
    }
    return $resData;
}

function checkUser($login, $pass) 
{
    global $db, $lgLen, $mdLen, $smLen; 
 
    $sql =  "SELECT * FROM `bt_user` WHERE `login` = ?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, 's', $login);
    $rs = mysqli_stmt_execute($stmt);
    if ($rs) {
       $res = mysqli_stmt_get_result($stmt);
       $res = createSmartyRsArray($res);
       if ($res) {
        $res = $res[0];
        if (password_verify($pass, $res['password'])) {
            $ip = getIp();
            // Проверяем, не нужно ли использовать более новый алгоритм
            // или другую алгоритмическую стоимость
            // Например, если вы поменяете опции хеширования
            if (password_needs_rehash($res['password'], PASSWORD_DEFAULT)) {
                $newHash = password_hash($pass, PASSWORD_DEFAULT);
                $sql =  'UPDATE `bt_user` SET `password` = ? WHERE `login` = ?';
                $stmt = mysqli_prepare($db, $sql);
                mysqli_stmt_bind_param($stmt, 'ss', $newHash, $login);
                $rs = mysqli_stmt_execute($stmt);
            }

            $user_id = $res['user_id'];
            $sql = 'INSERT INTO `bt_user_activity`(`user_id`, `key`, `data`, `ip`, `date_added`)'.
                " VALUES ('$user_id','login','','$ip',NOW())";
            $res1 = requestUser($sql);
            $sql = 'INSERT INTO `bt_user_ip`(`user_id`, `ip`, `date_added`)'.
                " VALUES ('$user_id','$ip',NOW())";
            $res1 = requestUser($sql);
            $sql = 'INSERT INTO `bt_user_login`(`user_id`, `ip`, `date_added`)'.
            " VALUES ('$user_id','$ip',NOW())";
            $res1 = requestUser($sql);

            $data = array();
            $fields = array('user_id', 'login', 'user_group', 'user_name', 'role', 'settings', 'conditions',
                            'discount', 'mailing');
            foreach ($fields as $field) {
                $data[$field] = ($res[$field]==NULL) ? '' : $res[$field];
            }

            $name = empty($data['user_name']) ?  $data['login'] : $data['user_name']  ;
            $data['name'] = $name;
            $lenName = mb_strlen($name);
            //d($GLOBALS['lgLen']);
            //$lgLen = 200;
            //$mdLen = 100;
            //$smLen = 50;  
            if ($lenName > $lgLen) {
                $data['showName'] = 3;
            } elseif ($lenName > $mdLen ) {
                $data['showName'] = 2;
            } elseif ($lenName > $smLen ) {
                $data['showName'] = 1;
            } else {
                $data['showName'] = 0;
            }

            //$wishlists = getUser(array('user_id' => $data['user_id']));
            /*if (!empty($wishlists['user_wishlist'])) {
                $data['user_wishlist'] = $wishlists['user_wishlist'];
            } else {
                $data['user_wishlist'] = array();   
            }*/
            $data['user_wishlist'] = getwishlistUser($data['user_id']);
            $data['user_cart'] = getCartUser($data['user_id'], $data['user_group']);
            /*if (!empty($wishlists['user_cart'])) {
                $data['user_cart'] = $wishlists['user_cart'];
            } else {
                $data['user_cart'] = array();
            }*/


            $resData['data'] = $data;
            $resData['success'] = true; 

        } else {
        $resData['error'] = 'Неправильное сочетание имени пользователя и пароля';
        $resData['success'] = false;   
        }   
       } else {
        $resData['error'] = 'Неправильное сочетание имени пользователя и пароля';
        $resData['success'] = false;        
       }
    } else {
        $resData['error'] = 'Неправильное сочетание имени пользователя и пароля';
        $resData['success'] = false;
    }
    return $resData;
}

function updateSettings($user, $value, $fieldVal)
{
    global $db;
    if (array_key_exists('user_id', $user)) {
        $userId = $user['user_id'];
        if ($userId > 0) {
            $sql = "SELECT * FROM `bt_user` WHERE `user_id` = ?";
            $stmt = mysqli_prepare($db, $sql);
            mysqli_stmt_bind_param($stmt, 'i', $userId);
            $rs = mysqli_stmt_execute($stmt);
            if ($rs) {
                $res = mysqli_stmt_get_result($stmt);
                $res = createSmartyRsArray($res);
                if ($res) {
                    $res = $res[0];
                    $settings = $res['settings'];
                    $settings = json_decode($settings, true);
                    if (is_array($settings)) {
                        $settings[$fieldVal] = $value;
                        $newSettings = json_encode($settings);
                    } else {
                        $sett = array($fieldVal => $value);
                        $newSettings = json_encode($sett);
                    }
                    $fieldRequest = array('user_id' => $userId, 'settings' => $newSettings);
                    updateUser($fieldRequest);
                }
            }
        }
    }
}

function getUserForUpdateSession($userId)
{
    global $db, $lgLen, $mdLen, $smLen; 
    $data = array(); 
    $userId = intval($userId);
    $sql =  "SELECT * FROM `bt_user` WHERE `user_id` = ?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $userId);
    $rs = mysqli_stmt_execute($stmt);
    if ($rs) {
       $res = mysqli_stmt_get_result($stmt);
       $res = createSmartyRsArray($res);
       if ($res) {
            $res = $res[0];
            $fields = array('user_id', 'login', 'user_group', 'user_name', 'role', 'settings', 'conditions',
                           'mailing', 'discount');
            foreach ($fields as $field) {
                $data[$field] = ($res[$field]==NULL) ? '' : $res[$field];
            }
            $name =  empty($data['user_name']) ?  $data['login'] : $data['user_name']  ;
            $data['name'] = $name;
            $lenName = mb_strlen($name);
            //$lgLen = 200;
            //$mdLen = 100;
            //$smLen = 50;  
            if ($lenName > $lgLen) {
                $data['showName'] = 3;
            } elseif ($lenName > $mdLen ) {
                $data['showName'] = 2;
            } elseif ($lenName > $smLen ) {
                $data['showName'] = 1;
            } else {
                $data['showName'] = 0;
            }

            //$wishlists = getUser(array('user_id' => $data['user_id']));
            /*if (!empty($wishlists['user_wishlist'])) {
                $data['user_wishlist'] = $wishlists['user_wishlist'];
            } else {
                $data['user_wishlist'] = array();
            }*/
           $data['user_wishlist'] = getwishlistUser($data['user_id']);
           $data['user_cart'] = getCartUser($data['user_id'], $data['user_group']);
           /*if (!empty($wishlists['user_cart'])) {
               $data['user_cart'] = $wishlists['user_cart'];
           } else {
               $data['user_cart'] = array();
           }*/
        }
    }
    return $data;
}

//< Wishlist

function delwishlistUser($userId,$productId)
{
    $sql = 'DELETE FROM `bt_user_wishlist` WHERE ' .
           " `user_id` = '$userId' AND `product_id` = '$productId'";
    $res = requestUser($sql);       
}

function addwishlistUser($user_id, $productId, $link)
{
    $sql = 'INSERT INTO `bt_user_wishlist`(`user_id`, `product_id`, `link`, `date_added`) VALUES' . 
    " ('$user_id','$productId','$link',NOW())";
    $res = requestUser($sql);   
}

function getwishlistUser($userId): array
{
    $sql = 'SELECT `product_id`, `link`, `date_added` FROM `bt_user_wishlist`' .
        " WHERE `user_id` = $userId";
    $rs = requestUser($sql);
    $res = createSmartyRsArray($rs);
    if (!$res) $res = array();
    return $res;
}

//> Wishlist

function getUsersByEmail($email)
{
    global $db; 
    $sql = "SELECT DISTINCT `user_id` FROM `bt_user_contact` WHERE `type_contact` = 'email' AND `content` = ?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, 's', $email);
    $rs = mysqli_stmt_execute($stmt);
    if ($rs) {
       $res = mysqli_stmt_get_result($stmt);
       $res = createSmartyRsArray($res);
    } else {
        $res = false; 
    }
    return $res;
}

function updateTokenUser($userId, $token)
{
    $sql = "INSERT INTO `bt_user_updatepass`(`user_id`, `token`, `date_added`) VALUES ('$userId','$token', NOW())".
           ' ON DUPLICATE KEY UPDATE `token`=VALUES(`token`), `date_added`=VALUES(`date_added`)';
    $res = requestUser($sql); 
}

function checkTokenUser($token)
{
    $sql = 'DELETE FROM `bt_user_updatepass` WHERE `date_added` < now() - interval 1 DAY'; 
    $rs = requestUser($sql);
    $sql = "SELECT `user_id` FROM `bt_user_updatepass` WHERE `token` = '$token'";
    $rs = requestUser($sql);
    $rs = createSmartyRsArray($rs);
    if ($rs) {

        $res['result'] = true;
        $user_id = $rs[0]['user_id'];
        $login = getUserForUpdateSession($user_id)['login'];
        $res['login'] = $login;
        $res['userId'] = $user_id;
    } else {
        $res['result'] = false;
        $res['userId'] = 0;  
    }
    return $res;
}

function deleteTokenUser($userId)
{
    $sql = 'DELETE FROM `bt_user_updatepass` WHERE ' .
    " `user_id` = '$userId'";
    $res = requestUser($sql);      
}

function updateContact($user_id, $valContact, $nameContact, $register = NULL)
{
    global $db; 
    $sql = 'DELETE FROM `bt_user_contact` WHERE'.
           " `user_id` = '$user_id' AND `type_contact` = '$nameContact'";
    $res = requestUser($sql);
    if (is_array($valContact)) {
        $i = 0;
        foreach ($valContact as $contact) {
            if (is_array($contact)) {
                $sql = 'INSERT INTO `bt_user_contact` (`user_id`, `type_contact`,' .
                    ' `view_contact`, `content`, `number_contact`, `comment`)' . 
                    " VALUES ('$user_id','$nameContact',?,?,'$i',?)";
                $i++;       
                $stmt = mysqli_prepare($db, $sql);
                $view_contact = array_key_exists('view_contact', $contact) ? $contact['view_contact'] : '';
                $content = array_key_exists('content', $contact) ? $contact['content'] : '';
                $comment = array_key_exists('comment', $contact) ? $contact['comment'] : '';
                mysqli_stmt_bind_param($stmt, 'sss', $view_contact, $content, $comment);
                $rs = mysqli_stmt_execute($stmt);
            }
        }
            if ($register == 'Y') {
                if (isset($_SESSION['user'] )) {
                    $user = $_SESSION['user'];
                    if (isset($user['login'])) {
                        $loginCur = $user['login'];
                        if (empty($loginCur)){
                            $sql = 'INSERT INTO `bt_user_update`(`user_id`, `date_added`)' .
                                " VALUES ('$user_id',NOW())" . 
                                ' ON DUPLICATE KEY UPDATE `date_added`=VALUES(`date_added`)';
                            $res = requestUser($sql);
                        } else {
                            $sql = 'INSERT INTO `bt_user_update`(`user_id`, `date_added`, `login`)' .
                            " VALUES ('$user_id',NOW(),?)" . 
                            ' ON DUPLICATE KEY UPDATE `date_added`=VALUES(`date_added`)';
                            $stmt = mysqli_prepare($db, $sql);
                            mysqli_stmt_bind_param($stmt, 's', $loginCur);
                            $rs = mysqli_stmt_execute($stmt);
                        }
                    }
                }
            }
    }   
}

function updateContactAll($user_id, $emails, $phones, $addreses, $register = NULL)
{
    global $db; 
    $sql = 'DELETE FROM `bt_user_contact` WHERE'.
           " `user_id` = '$user_id'";
    $res = requestUser($sql);

        $sql = 'INSERT INTO `bt_user_contact` (`user_id`, `type_contact`,' .
            ' `view_contact`, `content`, `number_contact`, `comment`) VALUES ';
        $params = '';
        $param = array(&$params);

        $i = 0;
        foreach ($emails as $contact) {
            if (is_array($contact)) {
                if ($i > 0) {
                    $sql .= ', ';
                }
                $sql .= "('$user_id','email',?,?,'$i',?)";
                $i++; 
                $view_contact = array_key_exists('view_contact', $contact) ? $contact['view_contact'] : '';
                $content = array_key_exists('content', $contact) ? $contact['content'] : '';
                $comment = array_key_exists('comment', $contact) ? $contact['comment'] : '';

                $params .= 'sss';
                $param[] = $view_contact;
                $param[] = $content;
                $param[] = $comment;
            }
        }
        $i = 0;
        foreach ($phones as $contact) {
            if (is_array($contact)) {
                if ($sql <> 'INSERT INTO `bt_user_contact` (`user_id`, `type_contact`,' .
                ' `view_contact`, `content`, `number_contact`, `comment`) VALUES ') {
                    $sql .= ', ';
                }
                $sql .= "('$user_id','phone',?,?,'$i',?)";
                $i++; 
                $view_contact = array_key_exists('view_contact', $contact) ? $contact['view_contact'] : '';
                $content = array_key_exists('content', $contact) ? $contact['content'] : '';
                $comment = array_key_exists('comment', $contact) ? $contact['comment'] : '';

                $params .= 'sss';
                $param[] = $view_contact;
                $param[] = $content;
                $param[] = $comment;
            }
        }
        $i = 0;
        foreach ($addreses as $contact) {
            if (is_array($contact)) {
                if ($sql <> 'INSERT INTO `bt_user_contact` (`user_id`, `type_contact`,' .
                ' `view_contact`, `content`, `number_contact`, `comment`) VALUES ') {
                    $sql .= ', ';
                }
                $sql .= "('$user_id','address',?,?,'$i',?)";
                $i++; 
                $view_contact = array_key_exists('view_contact', $contact) ? $contact['view_contact'] : '';
                $content = array_key_exists('content', $contact) ? $contact['content'] : '';
                $comment = array_key_exists('comment', $contact) ? $contact['comment'] : '';

                $params .= 'sss';
                $param[] = $view_contact;
                $param[] = $content;
                $param[] = $comment; 
            }
        }
        $stmt = mysqli_prepare($db, $sql);
        call_user_func_array(array($stmt, 'bind_param'), $param);
        $rs = mysqli_stmt_execute($stmt);

    if ($register == 'Y') {
        if (isset($_SESSION['user'] )) {
            $user = $_SESSION['user'];
            if (isset($user['login'])) {
                $loginCur = $user['login'];
                if (empty($loginCur)){
                    $sql = 'INSERT INTO `bt_user_update`(`user_id`, `date_added`)' .
                        " VALUES ('$user_id',NOW())" . 
                        ' ON DUPLICATE KEY UPDATE `date_added`=VALUES(`date_added`)';
                    $res = requestUser($sql);
                } else {
                    $sql = 'INSERT INTO `bt_user_update`(`user_id`, `date_added`, `login`)' .
                    " VALUES ('$user_id',NOW(),?)" . 
                    ' ON DUPLICATE KEY UPDATE `date_added`=VALUES(`date_added`)';
                    $stmt = mysqli_prepare($db, $sql);
                    mysqli_stmt_bind_param($stmt, 's', $loginCur);
                    $rs = mysqli_stmt_execute($stmt);
                }
            }
        }
    }

}

function getUsersForExternalUpdate()
{
    $sql = 'SELECT * FROM `bt_user_update` WHERE 1';
    $rs = requestUser($sql);
    $res = createSmartyRsArray($rs);

    if ($res) {
        $sqlContact = 'SELECT * FROM `bt_user_contact` WHERE `user_id` IN (';
        $sql = 'SELECT `user_id`, `login`, `user_group`, `xml_id`, `user_name`,' .
            ' `source`, `mailing`, `conditions` FROM `bt_user`' .
            ' WHERE `user_id` IN (';
        foreach ($res as $rs) {
            $sql .= "{$rs['user_id']},";
            $sqlContact .= "{$rs['user_id']},";
        }
        $sql = commaDel($sql, ',');
        $sql .= ')';
        $sqlContact = commaDel($sqlContact, ',');
        $sqlContact .= ')';
        $rs1 = requestUser($sql);
        $res1 = createSmartyRsArray($rs1);

        foreach ($res1 as &$res2) {
            foreach ($res as $res3) {
                if ($res3['user_id'] == $res2['user_id']) {
                    $res2['loginChange'] = $res3['login'];
                }
            }
        }
        unset($res2);

        $rs4 = requestUser($sqlContact);
        $res4 = createSmartyRsArray($rs4);

        $result['main'] = $res1;
        $result['contact'] = $res4;
    } else {
        $result['main'] = array();
        $result['contact'] = array();
    }
    return $result;
}

function clearUsersForExternalUpdate($ids)
{
    $sql = "DELETE FROM `bt_user_update` WHERE `user_id` IN $ids";
    $rs = requestUser($sql);
    return $rs;
}

//< Session

/**
 * 
 * @param integer $user_id
 * @param string  $session_id
 * @param string  $user_agent - $_SERVER["HTTP_USER_AGENT"]
 * @param string  $date_update - result of time()
 * @return boolean if seccess then true, else false  
 */
function updateSession($user_id, $session_id, $user_agent, $date_update, $active = 1, $ip = '0.0.0.0')
{
    //d($date_update);
 
    $sql = 'INSERT INTO `bt_user_session_update`(`user_id`, `session_id`, `date_update`, `user_agent`, `active`, `ip`) VALUES ' .
           "('$user_id','$session_id','$date_update','$user_agent','$active','$ip')" . 
           ' ON DUPLICATE KEY UPDATE `date_update`=VALUES(`date_update`), ' .
           '`user_agent`=VALUES(`user_agent`), `active`=VALUES(`active`), `ip`=VALUES(`ip`)';
           
    $rs = requestUser($sql);
    return $rs;
}

function deleteSession($user_id, $session_id)
{
    $sql = 'DELETE FROM `bt_user_session_update` WHERE ' .
           "`user_id` = '$user_id' AND `session_id` = '$session_id'";  
           $rs = requestUser($sql);
           return $rs;
}

function destroySessions($user_id, $session_id = '') // deactive session exectly $session_id
{
    $sql = 'UPDATE `bt_user_session_update` SET `active`= 0 WHERE ' .
        "`user_id`='$user_id' AND `session_id` <> '$session_id'";
    $rs = requestUser($sql);
    return $rs;
}

function getSession($user_id, $session_id)
{
    $sql = 'SELECT `date_update`, `active`, `ip` FROM `bt_user_session_update` WHERE ' .
           "`user_id` = '$user_id' AND `session_id` = '$session_id'";  
           $rs = requestUser($sql);
           $res = createSmartyRsArray($rs);
           if ($res) {
             $date_update = $res['0'];//['date_update'];
           } else {
             $date_update = NULL;
           }
           //d($date_update);
           return $date_update;
}

/**
 * 
 * @param integer $user_id
 * @param string  $session_id
 * @param string  $user_agent - $_SERVER["HTTP_USER_AGENT"]
 * @param string  $date_update - result of time()
 * @return boolean if seccess then true, else false  
 */
function updateSessionModification($user_id, $session_id, $user_agent, $date_modification, $ip = '0.0.0.0')
{
    $sql = 'INSERT INTO `bt_user_session_modification`(`user_id`, `session_id`, `date_modification`, `user_agent`, `ip`) VALUES ' .
           "('$user_id','$session_id','$date_modification','$user_agent','$ip')" . 
           ' ON DUPLICATE KEY UPDATE `date_modification`=VALUES(`date_modification`), `user_agent`=VALUES(`user_agent`), `ip`=VALUES(`ip`)';
    $rs = requestUser($sql);
    return $rs;
}

function deleteSessionModification($user_id, $session_id = NULL)
{
    $sql = 'DELETE FROM `bt_user_session_modification` WHERE ' .
           "`user_id` = '$user_id'";
    if ($session_id) {
        $sql.=" AND `session_id` = '$session_id'";  
    }       
    $rs = requestUser($sql);
    return $rs;
}

function getTimeSessionModification($user_id, $session_id = NULL)
{
    $sql = 'SELECT MAX(`date_modification`) as date_mod FROM `bt_user_session_modification` WHERE ' .
           "`user_id` = '$user_id'";  
           if ($session_id) {
            $sql.=" AND `session_id` <> '$session_id'";  
        }    

           $rs = requestUser($sql);
           $res = createSmartyRsArray($rs);
           if ($res) {
             $date_update = $res['0']['date_mod'];
           } else {
             $date_update = 0;
           }
           //d($date_update);
           return $date_update;
}

//> Session

//< Support

function getDialog($token){
    global $db;
    $result['user_id'] = 0;
    if ($token) {
        $result['token'] = $token;
        $sql = "SELECT * FROM `bt_support` WHERE `token` = ?";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, 's', $token);
        $rs = mysqli_stmt_execute($stmt);
        if ($rs) {
            $res = mysqli_stmt_get_result($stmt);
            $res = createSmartyRsArray($res);
            if ($res) {
                $result['success'] = true;
                $res = $res[0];
                $result['name'] = $res['name'];
                $result['email'] = $res['email'];
                $result['status'] = $res['status'];
                $support_id = $res['support_id'];
                $result['support_id'] = $support_id;
                $result['user_id'] = $res['user_id'];
                $sqlC = "SELECT * FROM `bt_support_content` WHERE `support_id` = ? ORDER BY `date_added` DESC";
                $stmtC = mysqli_prepare($db, $sqlC);
                mysqli_stmt_bind_param($stmtC, 's', $support_id);
                $rsC = mysqli_stmt_execute($stmtC);
                if ($rsC) {
                    $resC = mysqli_stmt_get_result($stmtC);
                    $result['content'] = createSmartyRsArray($resC);
                } else {
                    $result['success'] = false;
                }
            } else {
                $result['success'] = false;
            }
        }
    } else {
        $result['success'] = false;
    }
    return $result;
}

function getContact($user_id, $type = null) {
    //global $db;
    $sql = "SELECT * FROM `bt_user_contact` WHERE `user_id` = '$user_id'"; //`content`
    if ($type) $sql .= " AND `type_contact` = '$type'";
    $rs = requestUser($sql);
    if ($rs) {
        $res = createSmartyRsArray($rs);
    } else {
        $res = null;
    }
    return $res;
}

/**
 * @param $user_id integer
 * @return array $res
 */
function getAllDialog(int $user_id): array
{
    global $db;
    $allDialog = array();
    if ($user_id) {
        $sql = "SELECT `token` FROM `bt_support` WHERE `user_id` = ?";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $user_id);
        $rs = mysqli_stmt_execute($stmt);
        if ($rs) {
            $res = mysqli_stmt_get_result($stmt);
            $res = createSmartyRsArray($res);
            if ($res) {
                foreach($res as $re) {
                    $token = $re['token'];
                    $allDialog[] = getDialog($token);
                }
            }
        }
    }
    return $allDialog;
}

function checkExist($table, $condition): int|string
{
    $sql = "select 1 from $table where $condition limit 1";
    $rs = requestUser($sql);
    if ($rs) {
        $res = mysqli_num_rows($rs);
    } else {
        $res = 0;
    }
  return $res;
}

function addQuestion($support_id, $user_id, $question, $name, $email, $token): bool
{
    global $db, $website;
    $support_id = intval($support_id);
    $user_id = intval($user_id);
    if (checkExist('`bt_support`', "`support_id` = '$support_id'")) {
        $sql = "UPDATE `bt_support` SET `name`= ?,`email`= ?,`user_id`='$user_id'" .
               " WHERE `support_id`='$support_id'";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $name, $email);
        $rs = mysqli_stmt_execute($stmt);
        if ($rs) {
            $sql = 'INSERT INTO `bt_support_content`(`support_id`, `question`, `date_added`)' .
                "VALUES('$support_id', ?, NOW())";
            $stmt = mysqli_prepare($db, $sql);
            mysqli_stmt_bind_param($stmt, 's', $question);
            $rs = mysqli_stmt_execute($stmt);
        }
        // send letter
        $dialog = getDialog($token);
        $messages = $dialog['content'] ?? array();
        $dialogs = '<p> -----------------------------------------</br></p>';
        foreach ($messages as $message) {
             if($message['question']) {
                 $dialogs .= htmlspecialchars($message['question']);
                 $dialogs .= '<p> -----------------------------------------</br></p>';
             } elseif($message['answer']) {
                 $dialogs .= 'Ответ: ' . htmlspecialchars($message['answer']);
                 $dialogs .= '<p> -----------------------------------------</br></p>';
             }
        }

        //$dialogs = htmlspecialchars($dialogs);
        $message = <<<END
        <!doctype html>
        <html lang="en">
            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
            </head>
            <body>
                <p>
                       Вопрос $support_id получен.</br></p>
                   $dialogs
                   <p> В ближайшее время наши менеджеры вам ответят.</br></p>
                   <p> Историю запроса можно посмотреть по <a href="$website/user/support/?token=$token">ссылке</a></br>
                </p>
                <p>  
                   <b>С уважением, <a href="$website">Beautic</a></b> 
                </p>
                <img src="cid:image1" alt="Beautic">
            </body>
        </html>
        END;
        //writeInFile($message);
        $res = sendMail($email, "Вопрос $support_id на сайте Beautic", $message, ['logo.png']);

    } else {
       $sql = 'INSERT INTO `bt_support`(`token`, `status`, `name`, `email`, `user_id`)' .
               "VALUES ('$token','1',?,?,'$user_id')";
        //writeInFile($sql);
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $name, $email);
        $rs = mysqli_stmt_execute($stmt);
        if($rs) {
            $support_id = mysqli_insert_id($db);
            //writeInFile(print_r($res, true));
            $sql = 'INSERT INTO `bt_support_content`(`support_id`, `question`, `date_added`)' .
                "VALUES('$support_id', ?, NOW())";
            //writeInFile($sql);
            $stmt = mysqli_prepare($db, $sql);
            mysqli_stmt_bind_param($stmt, 's', $question);
            $rs = mysqli_stmt_execute($stmt);
        }
        // send letter
        $question = htmlspecialchars($question);
        $message = <<<END
        <!doctype html>
        <html lang="en">
            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
            </head>
            <body>
                <p>
                       Запрос $support_id сформирован.</br></p>
                   <p> -----------------------------------------</br></p>
                   <p> $question</br></p>
                   <p> -----------------------------------------</br> </p>
                   <p> В ближайшее время наши менеджеры вам ответят.</br></p>
                   <p> Историю запроса можно посмотреть по <a href="$website/user/support/?token=$token">ссылке</a></br>
                </p>
                <p>  
                   <b>С уважением, <a href="$website">Beautic</a></b> 
                </p>
                <img src="cid:image1" alt="Beautic">
            </body>
        </html>
        END;
        //writeInFile($message);
        $res = sendMail($email, "Запрос $support_id на сайте Beautic", $message, ['logo.png']);
        
        
   }
   return $rs;
}

function deactiveQuestion(int $support_id): void
{
     $sql = "UPDATE `bt_support` SET `status`='2' WHERE `support_id`='$support_id'";
    requestUser($sql);
}

function getActiveDialog(): bool|array
{
    //$sql = 'select * from
    //        (SELECT sup.*, con.answer, con.date_added
    //        FROM `bt_support` AS sup INNER JOIN `bt_support_content` AS con ON sup.support_id = con.support_id
    //         WHERE sup.status=1
    //         ORDER BY sup.support_id, con.date_added DESC) AS res
    //        group by res.support_id';
    $sql = 'SELECT * FROM
            (SELECT sup.*, con.answer, con.date_added
             FROM `bt_support` AS sup INNER JOIN `bt_support_content` AS con ON sup.support_id = con.support_id
             WHERE sup.status=1 AND
                  con.date_added=
                  (SELECT MAX(con2.date_added)
		           FROM `bt_support_content` AS con2
		           WHERE con.support_id = con2.support_id)
             ) AS res
            ORDER BY res.user_id, res.date_added';
    $rs = requestUser($sql);
    if ($rs) {
        $res = createSmartyRsArray($rs);
    } else {
        $res = array();
    }
    return $res;
}

function addQuestionAdm($support_id, $user_id, $question, $token, $email, $answering_id): bool
{
    global $db, $website;
    $support_id = intval($support_id);
    $answering_id = intval($answering_id);
    if (checkExist('`bt_support`', "`support_id` = '$support_id'")) {
           $sql = 'INSERT INTO `bt_support_content`(`support_id`, `answer`, `date_added`, `answering_id`)' .
                "VALUES('$support_id', ?, NOW(), $answering_id)";
            $stmt = mysqli_prepare($db, $sql);
            mysqli_stmt_bind_param($stmt, 's', $question);
            $rs = mysqli_stmt_execute($stmt);

        // send letter
        $dialog = getDialog($token);
        $messages = $dialog['content'] ?? array();
        $dialogs = '<p> -----------------------------------------</br></p>';
        foreach ($messages as $message) {
            if($message['question']) {
                $dialogs .= htmlspecialchars($message['question']);
                $dialogs .= '<p> -----------------------------------------</br></p>';
            } elseif($message['answer']) {
                $dialogs .= 'Ответ: ' . htmlspecialchars($message['answer']);
                $dialogs .= '<p> -----------------------------------------</br></p>';
            }
        }

        //$dialogs = htmlspecialchars($dialogs);
        $message = <<<END
        <!doctype html>
        <html lang="en">
            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
            </head>
            <body>
                <p>
                   Получен ответ на ваш запрос $support_id.</br></p>
                   $dialogs
                   <p> Историю запроса можно посмотреть по <a href="$website/user/support/?token=$token">ссылке</a></br>
                </p>
                <p>  
                   <b>С уважением, <a href="$website">Beautic</a></b> 
                </p>
                <img src="cid:image1" alt="Beautic">
            </body>
        </html>
        END;
        //writeInFile($message);
        $res = sendMail($email, "Вопрос $support_id на сайте Beautic", $message, ['logo.png']);

    } else {
        $_SESSION['message'] = "Диалог $support_id не найден";
    }
    return $rs;
}

//> Support

//< Cart

function getCartUser($userId, $userGroup): array
{
    global $imageDefProd;
    $userGroupDescription = getCheckUserGroup(3, $userGroup);
    $sql = 'SELECT cart.product_id, cart.quantity, cart.date_added, cart.date_modified, ' .
        "CASE WHEN pro.image='' THEN '$imageDefProd' ELSE pro.image END as `image`, " .
        'des.name, pri.price, cat.category_id, dat.date_available ' .
        'FROM `bt_user_cart` AS cart ' .
        'JOIN `bt_product` AS pro ON pro.product_id = cart.product_id ' .
        'JOIN `bt_product_description` AS des ON des.product_id = cart.product_id '.
        'JOIN `bt_product_price` AS pri ON cart.product_id = pri.product_id ' .
        'JOIN `bt_product_to_category` AS cat ON cart.product_id = cat.product_id '.
        'JOIN `bt_product_date_available` AS dat ON cart.product_id = dat.product_id ' .
        "WHERE cart.user_id = $userId AND des.user_group = $userGroupDescription " .
        "AND pri.user_group = $userGroup  AND dat.user_group = $userGroupDescription ";
    $rs = requestUser($sql);
    $res = createSmartyRsArray($rs);
    if ($res) {
        foreach ($res as &$productCart) {
            $productCart['link'] = getLinkProduct($productCart['product_id'], $productCart['category_id']);
        }
        unset($productCart);
    } else {
        $res = array();
    }
    return $res;
}

function delCartUser($userId,$productId): void
{
    $sql = 'DELETE FROM `bt_user_cart` WHERE ' .
        " `user_id` = '$userId' AND `product_id` = '$productId'";
    $res = requestUser($sql);
}

function addCartUser($user_id, $productId, $quantity = 1): void
{
    $sql = 'INSERT INTO `bt_user_cart`(`user_id`, `product_id`, `quantity`, `date_added`) VALUES' .
        " ('$user_id','$productId','$quantity',NOW()) ".
        ' ON DUPLICATE KEY UPDATE `quantity`=VALUES(`quantity`), `date_added`=VALUES(`date_added`)';
    $res = requestUser($sql);
}

function updCartUser($user_id, $productId, $quantity = 1): void
{
    $sql = "UPDATE `bt_user_cart` SET `quantity`='$quantity',`date_modified`=NOW()" .
          " WHERE `user_id`='$user_id' AND `product_id`='$productId'";
    $res = requestUser($sql);
}

function getLinkProduct($product_id, $category_id = 0): string
{
    $link = '';
    $product_id = intval($product_id);
    $category_id = intval($category_id);

    if ($category_id == 0) {
        $sql = "SELECT `category_id` FROM `bt_product_to_category` WHERE `product_id` = '$product_id'";
        $rs = request($sql . ')');
        if ($rs) {
            $res = createSmartyRsArray($rs);
            $category_id = $res[0]['category_id'] ?? 0;
        }
    }
    if ($category_id > 0) {

        $sql = "WITH RECURSIVE lv_recursive (parent_id, category_id) AS
               (SELECT parent_id, category_id
                FROM bt_category dep
                WHERE dep.category_id = $category_id 
                UNION ALL
                SELECT dep.parent_id, dep.category_id
                FROM bt_category dep
                JOIN lv_recursive rec ON dep.category_id = rec.parent_id)
                SELECT * FROM lv_recursive";

        $rsCat = requestUser($sql);

        if ($rsCat) {
            $resCat = createSmartyRsArray($rsCat);

            $link = '/product/';
            $resCat = array_reverse($resCat);
            foreach ($resCat as $cat) {
                if ($link != '/product/') $link .= '_';
                $link .= $cat['category_id'];
            }
            $link .= '/'.$product_id.'/';
        }
    }
    return $link;
}

//> Cart

//< Order

function checkFieldOrder($fieldsData, $fieldName, $table, $columnNane): int
{
    $res = 0;
    $field = $fieldsData[$fieldName] ?? 0;
    $field = intval($field);
    if (checkExist($table, "$columnNane = $field")) $res = $field;
    return $res;
}

function addOrder($fieldsData): array
{
    global $db;
    //$fieldsOrder = array('user_id', 'user_group', 'invoice_id', 'xml_id', 'name', 'email', 'phone', 'address',
    //             'comment', 'discount', 'status', 'shipping_method', 'payment_method');

    //INSERT INTO `bt_order`(`user_id`, `user_group`, `invoice_id`, `xml_id`, `name`, `email`, `phone`,
    // `address`, `comment`, `date_added`, `date_modified`, `discount`, `status`, `shipping_method`, `payment_method`)
    // VALUES ('[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]','[value-9]',
    //[value-10]','[value-11]','[value-12]','[value-13]','[value-14]','[value-15]','[value-16]')

    $result['success'] = false;
    $user_id = checkFieldOrder($fieldsData, 'user_id', 'bt_user', '`user_id`');
    if ($user_id > 0) {
        $user_group = checkFieldOrder($fieldsData, 'user_group', 'bt_user_group',
            '`user_group_id`');
        if ($user_group > 0) {
            $name = $fieldsData['name'] ?? null;
            if ($name) {
                $phone = $fieldsData['phone'] ?? null;
                if ($phone) {
                    $address = $fieldsData['address'] ?? null;
                    if ($address) {
                        $status = checkFieldOrder($fieldsData, 'status', 'bt_order_status',
                            '`order_status_id`');
                        if ($status > 0) {
                            $shipping_method = checkFieldOrder($fieldsData, 'shipping_method',
                                'bt_order_shipping_method', '`shipping_method_id`');
                            if ($shipping_method > 0) {
                                $payment_method = checkFieldOrder($fieldsData, 'payment_method',
                                    'bt_order_payment_method', '`payment_method_id`');
                                if ($payment_method > 0) {
                                    $invoice_id = $fieldsData['invoice_id'] ?? null;
                                    $invoice_id = intval($invoice_id);
                                    $xml_id = $fieldsData['xml_id'] ?? null;
                                    $xml_id = intval($xml_id);
                                    $email = $fieldsData['email'] ?? null;
                                    $comment = $fieldsData['comment'] ?? null;
                                    $discount = $fieldsData['discount'] ?? 0;
                                    $discount = floatval($discount);

                                    $sql = 'INSERT INTO `bt_order`(`user_id`, `user_group`, `invoice_id`, `xml_id`, ' .
                                        '`name`, `email`, `phone`, `address`, `comment`, `date_added`, ' .
                                        '`discount`, `status`, `shipping_method`, `payment_method`)' .
                                        "VALUES ('$user_id','$user_group','$invoice_id','$xml_id',?,?,?,?,?," .
                                        "NOW(),'$discount','$status','$shipping_method','$payment_method')";

                                    $stmt = mysqli_prepare($db, $sql);
                                    mysqli_stmt_bind_param($stmt, 'sssss', $name, $email, $phone,
                                        $address, $comment);
                                    $rs = mysqli_stmt_execute($stmt);
                                    if ($rs) {
                                        $order_id = mysqli_insert_id($db);
                                        $result['success'] = true;
                                        $result['order_id'] = $order_id;
                                    }
                                } $result['error'] = 'payment_method not exist';
                            } $result['error'] = 'shipping_method not exist';
                        } $result['error'] = 'status not exist';
                    } $result['error'] = 'address not exist';
                } $result['error'] = 'phone not exist';
            } $result['error'] = 'name not exist';
        } $result['error'] = 'user_group not exist';
    } $result['error'] = 'user_id not exist';

    return $result;
}

function delOrder($order_id): bool
{
    $order_id = intval($order_id);
    $sql = "UPDATE `bt_order` SET `status`='" . (ORDER_CANCELLED) . "'," .
        "`date_modified`=NOW() WHERE `order_id`='$order_id'";
    return requestUser($sql);
}

function getOrder($order_id): array|bool
{
    $order_id = intval($order_id);
    $sql = "SELECT * FROM `bt_order` WHERE `order_id`='$order_id'";
    $res = requestUser($sql);
    if ($res) {
        $rs = createSmartyRsArray($res);
        $rs = $rs['0'];
    } else {
        $rs = false;
    }
    return $rs;
}

function updOrder($fieldsData): bool
{
    global $db;
    $result = false;
    $order_id = checkFieldOrder($fieldsData, 'order_id', 'bt_order', '`order_id`');
    if ($order_id > 0) {
        $sql = 'UPDATE `bt_order` SET';
        $params = '';
        $param = array(&$params);
        $user_id = checkFieldOrder($fieldsData, 'user_id', 'bt_user', '`user_id`');
        if ($user_id > 0) {
            $sql .= " `user_id`='$user_id',";
        }
        $user_group = checkFieldOrder($fieldsData, 'user_group','bt_user_group',
               '`user_group_id`');
        if ($user_group > 0) {
            $sql .= "`user_group`='$user_group',";
        }
        $name = $fieldsData['name'] ?? null;
        if ($name) {
            $sql .= "`name`=?,";
            $params .= 's';
            $param[] = &$name;
        }
        $phone = $fieldsData['phone'] ?? null;
        if ($phone) {
            $sql .= "`phone`=?,";
            $params .= 's';
            $param[] = &$phone;
        }
        $address = $fieldsData['address'] ?? null;
        if ($address) {
            $sql .= "`address`=?,";
            $params .= 's';
            $param[] = &$address;
        }
        $status = checkFieldOrder($fieldsData, 'status', 'bt_order_status',
                                '`order_status_id`');
        if ($status > 0) {
            $sql .= "`status`='$status',";
        }
        $shipping_method = checkFieldOrder($fieldsData, 'shipping_method',
                            'bt_order_shipping_method', '`shipping_method_id`');
        if ($shipping_method > 0) {
            $sql .= "`shipping_method`='$shipping_method',";
        }
        $payment_method = checkFieldOrder($fieldsData, 'payment_method',
                           'bt_order_payment_method', '`payment_method_id`');
        if ($payment_method > 0) {
            $sql .= "`payment_method`='$payment_method',";
        }
        $invoice_id = $fieldsData['invoice_id'] ?? null;
        $invoice_id = intval($invoice_id);
        if ($invoice_id > 0) {
            $sql .= "`invoice_id`='$invoice_id',";
        }
        $xml_id = $fieldsData['xml_id'] ?? null;
        $xml_id = intval($xml_id);
        if ($xml_id > 0) {
            $sql .= "`xml_id`='$xml_id',";
        }
        $email = $fieldsData['email'] ?? null;
        if (!is_null($email)) {
            $sql .= "`email`=?,";
            $params .= 's';
            $param[] = &$email;
        }
        $comment = $fieldsData['comment'] ?? null;
        if (!is_null($comment)) {
            $sql .= "`comment`=?,";
            $params .= 's';
            $param[] = &$comment;
        }
        $discount = $fieldsData['discount'] ?? null;
        if (!is_null($discount)) {
            $discount = floatval($discount);
            if (($discount >= 0) && ($discount <= 100)) {
                $sql .= "`discount`='$discount',";
            }
        }
        if ($sql <> 'UPDATE `bt_order` SET') {
            $sql .= "`date_modified`= NOW() WHERE `order_id`='$order_id'";
            $stmt = mysqli_prepare($db, $sql);
            if ($params <> '') {
                call_user_func_array(array($stmt, 'bind_param'), $param);
            }
            $result = mysqli_stmt_execute($stmt);

        }
    } // order_id not exist
    return $result;
}

function addOrderProducts($order_id, $products, $add): bool
{
    $sql = '';
    $res = false;
    if (checkExist('bt_order', "`order_id` = $order_id")) {
        $mode = $add ? '`date_added`' : '`date_modified`';
        $sql = "INSERT INTO `bt_order_product`(`order_id`, `product_id`, `quantity`, `price`, 
                               `date_available`, $mode) VALUES ";
        foreach ($products as $product) {
            $sql .= "('$order_id','{$product['product_id']}','{$product['quantity']}','{$product['price']}',
                         '{$product['date_available']}',NOW()),";
        }
    }
    if ($sql) $res = requestUser($sql);
    return $res;
}

function delOrderProducts($order_id): bool
{
    $sql = "DELETE FROM `bt_order_product` WHERE `order_id` = $order_id";
    return requestUser($sql);
}

function getOrderProducts($order_id): bool|array
{
    $sql = "SELECT * FROM `bt_order_product` WHERE `order_id` = $order_id";
    $res = requestUser($sql);
    if ($res) {
        $rs = createSmartyRsArray($res);
    } else {
        $rs = false;
    }
    return $rs;
}

function updOrderProducts($order_id, $products): bool
{
    delOrderProducts($order_id);
    return addOrderProducts($order_id, $products, false);
}

function getOrderPaymentMethod(): array
{
    $res = array();
    $sql = 'SELECT `payment_method_id` AS id, `payment_method_name` AS name FROM `bt_order_payment_method` WHERE 1';
    $rs = requestUser($sql);
    if ($rs) $res = createSmartyRsArray($rs);
    return $res;
}

function getOrderShippingMethod(): array
{
    $res = array();
    $sql = 'SELECT `shipping_method_id` AS id, `shipping_method_name` AS name FROM `bt_order_shipping_method` ' .
           'WHERE 1';
    $rs = requestUser($sql);
    if ($rs) $res = createSmartyRsArray($rs);
    return $res;
}

//> Order