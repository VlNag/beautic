<?php

/**
 * контроллер rest user (rest/user/action/parametrs)
 * 
 */

// подключаем модели
include_once '../models/UsersModel.php';
include_once '../models/CategoriesModel.php';
include_once '../models/ProductsModel.php';

/**
 *  Добавление клиента через внешний запрос
 * $_POST[$field]
 */
function addAction()   
{
    $fields = array('login', 'user_group', 'xml_id', 'user_name', 'register',
        'password', 'source', 'mailing', 'conditions', 'role', 'key', 'settings',
        'email', 'phone', 'address');
    $fieldsComplex = array('email', 'phone', 'address');
    //'{"userGroup1":{"key1":"value1","key2":"value2"}, "userGroup2":{"key1":"value1","key2":"value2"}}'

    $fieldRequest = array();
    foreach ($fields as $field) {
        $fieldValue = isset($_POST[$field]) ? $_POST[$field] : null;
        if (!is_null($fieldValue)) {
            if (in_array($field, $fieldsComplex)) {
                $fieldRequest[$field] = json_decode($fieldValue, true);
            } else {
                $fieldRequest[$field] = $fieldValue;
            }
        }
    }

    if ($fieldRequest['key'] == REST_KEY) {
        $resData = addUser($fieldRequest);
        //updateSession($resData['user_id'], 'external source', 'external source', time());
        $resData['pass'] = true;
    } else {
        $resData['pass'] = false;
    }
    echo json_encode($resData);
}

/**
 * Удаление пользователя через внешний запрос
 * $_POST['user_id']
 */
function deleteAction()
{
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : NULL;
    $key = isset($_POST['key']) ? $_POST['key'] : NULL;

    if ($key == REST_KEY) {
    $resData = deleteUser($user_id);
    if ($resData['success']) {
        destroySessions($user_id); // помечаем все сессии как не активные
        deleteSessionModification($user_id); // удаляем все активности
    }
    $resData['pass'] = true;
    } else {
      $resData['pass'] = false;
    }
    echo json_encode($resData); 
}

/**
 * Получить поля клиента через внешний запрос
 * $_POST['user_id'], $_POST['login'], $_POST['xml_id']
 */
function getAction()
{
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : NULL;
    $login = isset($_POST['login']) ? $_POST['login'] : NULL;
    $xml_id = isset($_POST['xml_id']) ? $_POST['xml_id'] : NULL;
    $key = isset($_POST['key']) ? $_POST['key'] : NULL;
    $fieldRequest = array();
    if (!is_null($user_id)) {
        $fieldRequest['user_id'] = $user_id;
    }
    if (!is_null($login)) {
        $fieldRequest['login'] = $login;
    }
    if (!is_null($xml_id)) {
        $fieldRequest['xml_id'] = $xml_id;
    }    
    if ($key == REST_KEY) {
    $resData = getUser($fieldRequest);
    $resData['pass'] = true;
    } else {
      $resData['pass'] = false;
    }
    echo json_encode($resData); 
}

/**
 * Обновить поля клиента через внешний запрос
 * $_POST['user_id'], $_POST['login'], $_POST['xml_id'] ...
 */
function updateAction()
{
    $fields = array('user_id', 'login', 'user_group', 'xml_id', 'user_name', 'register',
        'password', 'source', 'mailing', 'conditions', 'role', 'key', 'by_xml_id', 'settings',
        'email', 'phone', 'address', 'user_wishlist');
    $fieldsComplex = array('email', 'phone', 'address', 'user_wishlist');
    //'{"userGroup1":{"key1":"value1","key2":"value2"}, "userGroup2":{"key1":"value1","key2":"value2"}}'
    $source = 'user_id';
    $xml_id = isset($_POST['xml_id']) ? $_POST['xml_id'] : null;
    if (!is_null($xml_id)) {
        $by_xml_id = isset($_POST['by_xml_id']) ? $_POST['by_xml_id'] : null;
        if ($by_xml_id == 'Y') {
            $source = 'xml_id';
        }
    }

    $fieldRequest = array();
    foreach ($fields as $field) {
        $fieldValue = isset($_POST[$field]) ? $_POST[$field] : null;
        if (!is_null($fieldValue)) {
            if (in_array($field, $fieldsComplex)) {
                $fieldRequest[$field] = json_decode($fieldValue, true);
            } else {
                $fieldRequest[$field] = $fieldValue;
            }
        }
    }
    if ($fieldRequest['key'] == REST_KEY) {
        $resData = updateUser($fieldRequest, $source);
        $t = time();
        updateSessionModification($user_id, session_id(), $_SERVER["HTTP_USER_AGENT"], $t, getIp());
        //if ($resData['success']) {
        //    destroySessions($resData['user_id']);
        //}
        $resData['pass'] = true;
    } else {
        $resData['pass'] = false;
    }
    echo json_encode($resData);
}

function loginAction()
{
    $login = isset($_POST['login']) ? $_POST['login'] : null; 
    $pass = isset($_POST['pass']) ? $_POST['pass'] : null; 
    $res = checkUser($login, $pass);
    if ($res['success']) {
        $_SESSION['user'] = $res['data']; 
 
        //$_SESSION['cart'] = array();
        $_SESSION['userGroup'] = $res['data']['user_group'];

        $rsCategories = getAllMainCatsWithChildren();
        $_SESSION['allMainCatsWithChildren'] = $rsCategories;
        $_SESSION['timeUpdate'] = time();

        $settings = $res['data']['settings'];
        $settings = json_decode($settings, true);
        if (is_array($settings)) {
            $settingses = array('theme', 'layout', 'perpage');
            foreach ($settingses as $sett) {
                if (array_key_exists($sett, $settings)) {
                    $_SESSION[$sett] = $settings[$sett];
                }
            }
        }
        $t = time();
        updateSession($res['data']['user_id'], session_id(), $_SERVER["HTTP_USER_AGENT"], $t, 1, getIp());
        //getSession($res['data']['user_id'], session_id());
        //getSessionModification($res['data']['user_id']);
        header('Location: '.$_SERVER['HTTP_REFERER']);
     
        //header('Location: /');        
        die;
    } else {
        //alert($res['error']);
        if (isset($_SESSION['message'])) {
            $_SESSION['message'] = $_SESSION['message'].'</br>'.$res['error'];
        } else {
            $_SESSION['message'] = $res['error'];
        }
        header('Location: '.$_SERVER['HTTP_REFERER']);
        die;
    }
}

function logoutAction()
{
    //$fields = array('user', 'userGroup', 'theme', 'layout', 'perpage');
    //foreach ($fields as $field) {
    //    if (isset($_SESSION[$field])) {
    //        unset($_SESSION[$field]);
    //    }
    //}
    $t = time();
    updateSession($_SESSION['user']['user_id'], session_id(),  $_SERVER["HTTP_USER_AGENT"], $t, 0, getIp());
    //deleteSession($_SESSION['user']['user_id'], session_id());
    session_destroy();
    //d($_SESSION);
    header('Location: /');
    die;
}

function registerAction()
{
    $login = isset($_POST['login']) ? $_POST['login'] : null; 
    $pass = isset($_POST['pass']) ? $_POST['pass'] : null; 

    $email = isset($_POST['email']) ? $_POST['email'] : null; 
    $phone = isset($_POST['phone']) ? $_POST['phone'] : null; 
    if (!empty($login)) {
        $arLogin = array('login' => $login);
        $res = getUser($arLogin);
        $logined = isset($res['success']) ? $res['success'] : true; 
        if (!$logined) {
            if (!empty($pass)) {
                $fieldRequest = array('login' => $login, 'password' => $pass);
                if (!empty($email)) {
                    $fieldRequest['email'] = array(0 => array ('view_contact' => 'home',
                                                      'content' => $email));
                }
                if (!empty($phone)) {
                    $fieldRequest['phone'] = array(0 => array ('view_contact' => 'home',
                                                      'content' => $phone));
                } 
                $fieldRequest['register'] = 'Y';    
                $resData = addUser($fieldRequest);
                if ($resData['success']) {
                    $res = getUser($arLogin);
                    if (!empty($res)) {
                        $_SESSION['userGroup'] = $res['user_group'];
                        $arLogin['user_group'] = $res['user_group'];
                        $arLogin['user_id'] = $res['user_id'];
                    }
                    $fields = array('user_name', 'role', 'settings', 'conditions', 'mailing');
                    foreach ($fields as $field) {
                        $arLogin[$field] = '';
                    }
                    $_SESSION['user'] = $arLogin;

                    $rsCategories = getAllMainCatsWithChildren();
                    $_SESSION['allMainCatsWithChildren'] = $rsCategories;
                    $t = time();
                    $_SESSION['timeUpdate'] = $t;
                
                    updateSession($res['user_id'], session_id(), $_SERVER["HTTP_USER_AGENT"], $t, 1, getIp());
                }
            } else {
                $_SESSION['message'] = 'Введите пароль';   
            }
        } else {
            $_SESSION['message'] = 'Указанный логин существует';  
        }
    } else {
        $_SESSION['message'] = 'Введите логин'; 
    }
    header('Location: '.$_SERVER['HTTP_REFERER']);
    die;
}  

function updateinAction()
{
  //$startTime=hrtime(true);
  //writeInFile('update start ' . date("Y-m-d H:i:s") . ' :: ' . (hrtime(true)-$startTime)); //****************** */

    $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
    $fieldRequest = array();
    if ($user) {
        $user_id = $user['user_id'];
        $user_id = intval($user_id);
        $user_group = $user['user_group'];
        //$user_group = intval($user_group);
        if ($user_id > 0) {
            $fieldRequest['user_id'] = $user_id;
            $login = isset($_POST['login']) ? $_POST['login'] : null;
            if (!empty($login)) {
                $fieldRequest['login'] = $login;
            }
            if (isset($_POST['name'])) {
                $fieldRequest['user_name'] = $_POST['name'];
            }
            if (isset($_POST['condition'])) {
                $fieldRequest['conditions'] = $_POST['condition'];
            }
            if (!isset($_POST['nomailing'])) {
            if (isset($_POST['mailing'])) {
                $fieldRequest['mailing'] = 1;
            } else {
                $fieldRequest['mailing'] = 0; 
            } 
            }
            //$user_group_in = isset($_POST['currency']) ? $_POST['currency'] : null;
            if (isset($_POST['currency'])) {
                $user_group_in = $_POST['currency'];
                if ($user_group_in == 4) {
                    if ($user_group <> 4) {
                        $fieldRequest['user_group'] = 4;
                    }
                } else {
                    if ($user_group == 4) {
                        $fieldRequest['user_group'] = 1;
                    }
                } 
            }
            if (count($fieldRequest) > 1) {
                $fieldRequest['register'] = 'Y';
            }
            if (isset($_POST['user_wishlist'])) {
                $user_wishlist = json_decode($_POST['user_wishlist'], true);
                $fieldRequest['user_wishlist'] =  $user_wishlist;
            } else {
                $user_wishlist = array();
            }

            //writeInFile('get parameters ' . date("Y-m-d H:i:s") . ' :: ' . (hrtime(true)-$startTime)); //****************** */

            updateUser($fieldRequest);
            $t = time();
            updateSessionModification($user_id, session_id(), $_SERVER["HTTP_USER_AGENT"], $t, getIp());
            //writeInFile('update user ' . date("Y-m-d H:i:s") . ' :: ' . (hrtime(true)-$startTime)); //****************** */

            if (!isset($_POST['nomailing'])) {
                $user = getUserForUpdateSession($user_id);
                $_SESSION['userGroup'] = $user['user_group'];
                $_SESSION['user'] = $user;

                $rsCategories = getAllMainCatsWithChildren();
                $_SESSION['allMainCatsWithChildren'] = $rsCategories;
                $_SESSION['timeUpdate'] = $t;
        
                $settings = $user['settings'];
                $settings = json_decode($settings, true);
                if (is_array($settings)) {
                    $settingses = array('theme', 'layout', 'perpage');
                    foreach ($settingses as $sett) {
                        if (array_key_exists($sett, $settings)) {
                            $_SESSION[$sett] = $settings[$sett];
                        }
                    }
                }
                //d(time());
                //$t = time();
                updateSession($user_id, session_id(), $_SERVER["HTTP_USER_AGENT"], $t, 1, getIp());

            } else {
                foreach ($user_wishlist as $wishlist) {
                    if (is_array($wishlist)) {
                        foreach ($wishlist as $key => $wish) {
                           $newWish['product_id'] = $key;
                           $newWish['link'] = $wish;
                          $_SESSION['user']['user_wishlist'][] = $newWish;
                         }
                    }
                }

            }
            //writeInFile('get session user ' . date("Y-m-d H:i:s") . ' :: ' . (hrtime(true)-$startTime)); //****************** */
        }
    } 
    header('Location: '.$_SERVER['HTTP_REFERER']);
    die;
    //$resData['success'] = true;
    //echo json_encode($resData);
}

function changepassAction()
{
    $newpass = isset($_POST['newpass']) ? $_POST['newpass'] : null; 
    if (!empty($newpass)) {
        $newpass2 = isset($_POST['newpass2']) ? $_POST['newpass2'] : null; 
        if (!empty($newpass2)) {
            if ($newpass == $newpass2) {
                $pass = isset($_POST['pass']) ? $_POST['pass'] : null; 
                if (!empty($pass)) {
                    $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
                    if ($user) {
                        if ((isset($user['user_id']))&&(isset($user['login']))) {
                            $user_id = $user['user_id'];
                            $user_id = intval($user_id);
                            $login = $user['login'];
                            $res = checkUser($login, $pass);
                            if ($res['success']) {
                                $fieldRequest = array();
                                $fieldRequest['user_id'] = $user_id;
                                $fieldRequest['password'] = $newpass;
                                $rsData = updateUserPass($fieldRequest);
                                if ($rsData['success']) {
                                    destroySessions($user_id, session_id()); 
                                    $_SESSION['message'] = 'Пароль обновлён';  
                                } else {
                                    $_SESSION['message'] = 'Обновить пароль не удалось';   
                                }
                            } else {
                                if (isset($_SESSION['message'])) {
                                    $_SESSION['message'] = $_SESSION['message'].'</br>'.$res['error'];
                                } else {
                                    $_SESSION['message'] = $res['error'];
                                } 
                            }
                        } else {
                            $_SESSION['message'] = 'Авторизируйтесь для смены пароля';   
                        }
                    } else {
                        $_SESSION['message'] = 'Авторизируйтесь для смены пароля'; 
                    }
                } else {
                    $_SESSION['message'] = 'Введите пароль'; 
                }
            } else {
                $_SESSION['message'] = 'Пароли не совпадают'; 
            }
        } else {
            $_SESSION['message'] = 'Введите подтверждение нового пароля'; 
        }
    } else {
        $_SESSION['message'] = 'Введите новый пароль'; 
    }
    header('Location: '.$_SERVER['HTTP_REFERER']);
    die;
}

function changepassupAction()
{
    $userId = isset($_POST['userId']) ? $_POST['userId'] : null;   
    $newpass = isset($_POST['newpass']) ? $_POST['newpass'] : null; 
    if (!empty($newpass)) {
        $newpass2 = isset($_POST['newpass2']) ? $_POST['newpass2'] : null; 
        if (!empty($newpass2)) {
            if ($newpass == $newpass2) {
                                $fieldRequest = array();
                                $fieldRequest['user_id'] = $userId;
                                $fieldRequest['password'] = $newpass;
                                $rsData = updateUserPass($fieldRequest);
                                if ($rsData['success']) {
                                    destroySessions($user_id, session_id()); 
                                    $_SESSION['message'] = 'Пароль обновлён';  
                                    deleteTokenUser($userId);
                                } else {
                                    $_SESSION['message'] = 'Обновить пароль не удалось';   
                                }
            } else {
                $_SESSION['message'] = 'Пароли не совпадают'; 
            }
        } else {
            $_SESSION['message'] = 'Введите подтверждение нового пароля'; 
        }
    } else {
        $_SESSION['message'] = 'Введите новый пароль'; 
    }
    //header('Location: '.$_SERVER['HTTP_REFERER']);
    header('Location: /');
    die;
}

function addwishlistAction()
{
    $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
    if ($user) {
        $user_id = $user['user_id'];
        $user_id = intval($user_id);
        if ($user_id > 0) {
            if (isset($_POST['productId'])) {
                $productId = $_POST['productId'];
                $productId = intval($productId);
                $link = (isset($_POST['link'])) ? $_POST['link'] : ''; 
                addwishlistUser($user_id, $productId, $link);
                $newWish['product_id'] = $productId;
                $newWish['link'] = $link;

                $_SESSION['user']['user_wishlist'][] = $newWish;
                $t = time();
                updateSessionModification($user_id, session_id(), $_SERVER["HTTP_USER_AGENT"], $t, getIp());
                //$startTime=hrtime(true);
                //writeInFile('del start ' . date("Y-m-d H:i:s") . ' :: ' . (hrtime(true)-$startTime)); //****************** */               
                //$user = getUserForUpdateSession($user_id);
                //$_SESSION['user'] = $user;


                //if (isset($_SESSION['user']['user_wishlist'])) {
                //    foreach($_SESSION['user']['user_wishlist'] as $subKey => $subArray){
                //        if($subArray['product_id'] == $productId){
                //             unset($_SESSION['user']['user_wishlist'][$subKey]);
                //        }
                //   }
                //}
                //writeInFile('del end ' . date("Y-m-d H:i:s") . ' :: ' . (hrtime(true)-$startTime)); //****************** */

            }
        }
    } 
    //header('Location: '.$_SERVER['HTTP_REFERER']);
    die;
    //$resData['success'] = true;
    //echo json_encode($resData);
}

function delwishlistAction()
{
    $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
    if ($user) {
        $user_id = $user['user_id'];
        $user_id = intval($user_id);
        if ($user_id > 0) {
            if (isset($_POST['productId'])) {
                $productId = $_POST['productId'];
                $productId = intval($productId);
                delwishlistUser($user_id, $productId);

                //$startTime=hrtime(true);
                //writeInFile('del start ' . date("Y-m-d H:i:s") . ' :: ' . (hrtime(true)-$startTime)); //****************** */               
                //$user = getUserForUpdateSession($user_id);
                //$_SESSION['user'] = $user;


                if (isset($_SESSION['user']['user_wishlist'])) {
                    foreach($_SESSION['user']['user_wishlist'] as $subKey => $subArray){
                        if($subArray['product_id'] == $productId){
                             unset($_SESSION['user']['user_wishlist'][$subKey]);
                        }
                   }
                }
                $t = time();
                updateSessionModification($user_id, session_id(), $_SERVER["HTTP_USER_AGENT"], $t, getIp());
                //writeInFile('del end ' . date("Y-m-d H:i:s") . ' :: ' . (hrtime(true)-$startTime)); //****************** */

            }
        }
    } 
    //header('Location: '.$_SERVER['HTTP_REFERER']);
    die;
    //$resData['success'] = true;
    //echo json_encode($resData);
}

function forgotpassAction()
{
    global $website, $mailAdmin;

    if (isset($_POST['message'])) {
      $message = $_POST['message'];
      sendMail($mailAdmin, 'Запрос на восстановление пароля', $message);
    } 

    if (isset($_POST['email'])) {
      $email = $_POST['email'];
      $res = getUsersByEmail($email);
      if ($res) {
         foreach($res as $userIds) {
            $userId = $userIds['user_id'];
            $token = uniqid('', true);
            updateTokenUser($userId, $token);
            $login = getUserForUpdateSession($userId)['login'];
             
            $message = <<<END
            <!doctype html>
            <html lang="en">
                <head>
                    <meta charset="utf-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                </head>
                <body>
                    
                    <p>Ваш адрес был указан в запросе на восстановление пароля </br></p>
                    <p>    Если это не Вы проигнорируйте это сообщение </br></p>
                    <p>    Ваш логин <b>$login</b> </br></p>
                    <p>    Для обновления пароля пройдите по ссылке </br></p>
                    <p>    <a href="$website/user/updatepass/?token=$token"><b>Восстановление пароля</b></a>
                    </p>
                    <p>    Ссылка будет активна в течение суток </br></p>
                    <p>  
                    <b>С уважением, <a href="$website">Beautic</a></b> 
                    </b>
                    <img src="cid:image1" alt="Beautic">
                </body>
            </html>
            END;
    
            $res = sendMail($email, 'Восстановление пароля на сайте Beautic', $message, ['logo.png']);
 
         } 
      } else {
    
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
                    Ваш адрес был указан в запросе на восстановление пароля, но пользователь с таким адресом электронной почты не найден.
                    Введите верный адрес либо зарегистрируйтесь заново.</br>
                </p>
                <p>  
                <b>С уважением, <a href="$website">Beautic</a></b> 
                </b>
                <img src="cid:image1" alt="Beautic">
            </body>
        </html>
        END;

        $res = sendMail($email, 'Восстановление пароля на сайте Beautic', $message, ['logo.png']);
      }
    }    

    header('Location: '.$_SERVER['HTTP_REFERER']);
    die;   
}

function updatecontactAction()  
{
    $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
    if ($user) {
        $user_id = $user['user_id'];
        $user_id = intval($user_id);
        $email = isset($_POST['email']) ? $_POST['email'] : null; 
        $register = isset($_POST['register']) ? $_POST['register'] : null; 
        //writeInFile($email);    
        if ($email) {
            $emails = json_decode($email, true);
            //writeInFile(print_r($emails, true));    
            //updateContact($user_id,$emails,'email', $register);
         } else {
            $emails = array();
         }
         $phone = isset($_POST['phone']) ? $_POST['phone'] : null; 
         if ($phone) {
             $phones = json_decode($phone, true);
             //updateContact($user_id,$phones,'phone', $register);
          } else {
            $phones = array();
          }
          $address = isset($_POST['address']) ? $_POST['address'] : null; 
          if ($address) {
              $addreses = json_decode($address, true);
              //updateContact($user_id,$addreses,'address', $register);
           } else {
              $addreses = array();
           }
           updateContactAll($user_id, $emails, $phones, $addreses, $register);
           $t = time();
           updateSessionModification($user_id, session_id(), $_SERVER["HTTP_USER_AGENT"], $t, getIp());
    }
    //header('Location: '.$_SERVER['HTTP_REFERER']);
    die;
}

function getusersforexternalupdateAction()
{
    $resData = getUsersForExternalUpdate();
    //writeInFile(print_r($resData, true));
    //writeInFile(json_encode($resData));
    echo json_encode($resData);    
}

function clearusersforexternalupdateAction()
{
    $resData = array();
    $ids = isset($_POST['ids']) ? $_POST['ids'] : null;
    $key = isset($_POST['key']) ? $_POST['key'] : null;
    if ($key == REST_KEY) {
        $resData['pass'] = true;
        if ($ids) {
            $res = clearUsersForExternalUpdate($ids); 
            if ($res) {
                $resData['success'] = 'true';
            } else {
                $resData['success'] = 'false';
            }
        }
    } else {
        $resData['pass'] = false;
    }

    echo json_encode($resData);
}

function updatefromcAction()
{
    $resData = array();
    $fields = array('user_id', 'login', 'user_group', 'xml_id', 'user_name', 'register',
        'password', 'source', 'mailing', 'conditions', 'role', 'key', 'by_xml_id', 'settings');
    $source = 'user_id';

    $fieldRequest = array();
    foreach ($fields as $field) {
        $fieldValue = isset($_POST[$field]) ? $_POST[$field] : null;
        if (!is_null($fieldValue)) {
            $fieldRequest[$field] = $fieldValue;
        }
    }
    $user_id = isset($fieldRequest['user_id']) ? $fieldRequest['user_id'] : null;
    $key = isset($fieldRequest['key']) ? $fieldRequest['key'] : null;
    if ($user_id) {
        if ($key == REST_KEY) {
            $resData['pass'] = true;
            $resData = updateUser($fieldRequest, $source);
            $t = time();
            updateSessionModification($user_id, session_id(), $_SERVER["HTTP_USER_AGENT"], $t, getIp());
            $email = isset($_POST['email']) ? $_POST['email'] : null;
            $register = isset($_POST['register']) ? $_POST['register'] : null;
            
            if ($email) {
                $emails = json_decode($email, true);
                updateContact($user_id, $emails, 'email', $register);
            }

            $phone = isset($_POST['phone']) ? $_POST['phone'] : null;
            if ($phone) {
                $phones = json_decode($phone, true);
                updateContact($user_id, $phones, 'phone', $register);
            }
            $address = isset($_POST['address']) ? $_POST['address'] : null;
            if ($address) {
                $addreses = json_decode($address, true);
                updateContact($user_id, $addreses, 'address', $register);
            }
        } else {
            $resData['pass'] = false;
        }
    }
    echo json_encode($resData);
}

function addquestionAction(): void
{
    $support_id = $_GET['support_id'] ?? 0;
    $question = $_GET['question'] ?? '';
    $name = $_GET['name'] ?? '';
    $email = $_GET['email'] ?? '';
    $user_id = $_GET['user_id'] ?? 0;
    $token = $_GET['token'] ?? '';
    $fl = true;
    if ($user_id == 0) {
        if (empty($email)) {
            $_SESSION['message'] = 'Нужно заполнить E-Mail адрес';
            //header('Location: '.$_SERVER['HTTP_REFERER']);
            $fl = false;
          }
    }
    if ($fl) {
        $res = addQuestion($support_id, $user_id, $question, $name, $email, $token);
        if (!$res) $_SESSION['message'] = 'Не удалось сформировать запрос';
        //header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    die;
}

function deactivequestionAction(): void
{
    $support_id = $_GET['support_id'] ?? 0;
    $support_id = intval($support_id);

    if ($support_id > 0) {
        deactiveQuestion($support_id);
    }
    die;
}

function addquestionadmAction(): void
{
    $user = $_SESSION['user'] ?? null;
    $answering_id = $user['user_id'] ?? 0;

    $support_id = $_GET['support_id'] ?? 0;
    $question = $_GET['question'] ?? '';
    $user_id = $_GET['user_id'] ?? 0;
    $token = $_GET['token'] ?? '';
    $email = $_GET['email'] ?? '';
    $res = addQuestionAdm($support_id, $user_id, $question, $token, $email, $answering_id);
    if (!$res) $_SESSION['message'] = 'Не удалось отправить ответ';
    //header('Location: ' . $_SERVER['HTTP_REFERER']);
    die;
}

function addcartAction(): void
{
    $user = $_SESSION['user'] ?? null;
    if ($user) {
        $user_id = $user['user_id'];

        $user_id = intval($user_id);
        if ($user_id > 0) {
            if (isset($_POST['product_id'])) {
                $product_id = $_POST['product_id'];
                $product_id = intval($product_id);
                $image = $_POST['image'] ?? '';
                addCartUser($user_id, $product_id);
                $newCart['product_id'] = $product_id;
                $newCart['quantity'] = 1;

                $newCart['image'] = $_POST['image'] ?? '';
                $newCart['name'] = $_POST['name'] ?? '';
                $newCart['price'] =  $_POST['price'] ?? 0;
                $newCart['link'] = $_POST['link'] ?? '';

                $_SESSION['user']['user_cart'][] = $newCart;
                $t = time();
                updateSessionModification($user_id, session_id(), $_SERVER["HTTP_USER_AGENT"], $t, getIp());
                }
           }
        }
    die;
}

function delcartAction(): void
{
    $user = $_SESSION['user'] ?? null;
    if ($user) {
        $user_id = $user['user_id'];
        $user_id = intval($user_id);
        if ($user_id > 0) {
            if (isset($_POST['product_id'])) {
                $product_id = $_POST['product_id'];
                $product_id = intval($product_id);
                delCartUser($user_id, $product_id);
                if (isset($_SESSION['user']['user_cart'])) {
                    foreach($_SESSION['user']['user_cart'] as $subKey => $subArray){
                        if($subArray['product_id'] == $product_id){
                            unset($_SESSION['user']['user_cart'][$subKey]);
                        }
                    }
                }
                $t = time();
                updateSessionModification($user_id, session_id(), $_SERVER["HTTP_USER_AGENT"], $t, getIp());
            }
        }
    }
    die;
}

function updcartAction(): void
{
    $user = $_SESSION['user'] ?? null;
    if ($user) {
        $user_id = $user['user_id'];
        $user_id = intval($user_id);
        if ($user_id > 0) {
            if (isset($_POST['product_id'])) {
                $product_id = $_POST['product_id'];
                $product_id = intval($product_id);
                $quantity = $_POST['quantity'];
                $quantity = intval($quantity);
                updCartUser($user_id, $product_id, $quantity);
                if (isset($_SESSION['user']['user_cart'])) {
                    foreach($_SESSION['user']['user_cart'] as &$subArray){
                        if($subArray['product_id'] == $product_id){
                            $subArray['quantity'] = $quantity;
                        }
                    }
                    unset($subArray);
                }
                $t = time();
                updateSessionModification($user_id, session_id(), $_SERVER["HTTP_USER_AGENT"], $t, getIp());
            }
        }
    }
    die;
}
