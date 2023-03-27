<?php
/**
 * основные функции
 * 
 */

/**
 *формирование запрашиваемой страницы
 *  
 * @param string $controllerName название контроллера
 * @param string $actionName функция контроллера
 */
function loadPage($smarty, $controllerName, $actionName = 'Index')
{
   include_once PATH_PREFIX . $controllerName . PATH_POSTFIX; 
   $function = $actionName . 'Action';
   $function($smarty);   
}

/**
 * Загрузка шаблона
 * 
 * @param object $smarty объект шаблонизатора
 * @param string $templateName название файла шаблона
 */
function loadTemplate($smarty, $templateName)
{
   $smarty->display($templateName . TEMPLATE_POSTFIX);  
}

/**
 * Функция отладки. Останавливает работу выводя значение 
 * $value
 * 
 * @param variant $value переменная для вывода её на страницу 
 * @param bool $die флаг прекращения работы
 */
function d($value = null, $die = 1)
{
    function debugOut($a)
    {
        echo '<br /><b>'.basename($a['file']).'</b>'
             ."&nbsp;<font color='red'>({$a['line']})</font>"   
             ."&nbsp;<font color='green'>{$a['function']}()</font>"   
             ."&nbsp; -- ".dirname($a['file']); 
    }
    
   echo '<pre>';
   $trace = debug_backtrace();
   array_walk($trace, 'debugOut');
   echo "\n\n";
   var_dump($value);
   echo '</pre>'; 
 
  //  echo 'Debug: <br /><pre>';
  //   print_r($value);
  //   echo '</pre>';
     
     if ($die) die;
}

/**
 * Перевод результата запроса sql в массив
 * 
 * @param object $rs результат запроса к БД
 * @return array массив данных
 */
function createSmartyRsArray($rs)
{
   if (! $rs) return false;
   
   $smartyRs = array();
   while ($row = mysqli_fetch_assoc($rs)) {
       $smartyRs[] = $row;
   }
    
   return $smartyRs;
}

/** 
 * запись отладочной информации в файл
 * 
 * @param string $str
 */
function writeInFile($str)
{
    $file = $_SERVER['DOCUMENT_ROOT']. '/test.txt';
    file_put_contents($file, PHP_EOL . $str, FILE_APPEND);
}

/**
 * чтение информации из файла
 *
 * @param string $str
 * @return bool|string
 */
function readFromFile(string $str): bool|string
{
    return file_get_contents(__DIR__.'\\'. $str);
}

/**
 * редирект
 * 
 * @param string $url адрес для перенаправления
 */
function redirect($url)
{
  if(! $url) $url = '/';
  header("Location: $url");
  exit();
} 

/**
 * Преобразование строки заменой одиночной ' на две 
 * для помещения в sql запрос
 * 
 * @param string $str
 * @return string преобразованная строка
 */
function transformStr($str, $fl=0)
{
    if ($str) {
        if ($fl==1) {
        $str2 = $str->__toString();
        } else {
            $str2 = $str;    
        }
        $str2 = str_replace("'","''",$str2);
        //d($str2);
        //if ($str) {
        //if ($str[strlen($str)-1] == "'") {
        //    $str = $str . "'";
        //    } 
        //}
    } else {
        $str2 = '';
    }
    return $str2;
}

/**
 * delete last symbol if it is $symbol
 * 
 * @param string $str 
 * @param string $symbol 
 * @return string updating string if last symbol is $symbol
 */
function commaDel($str, $symbol)
{
    if ($str) {
    if ($str[strlen($str)-1] == $symbol) {
        $str = substr($str,0,-1);
        }
    }
    return $str;
}

/**
 * преобразование даты для загрузки sql
 *  
 * @param string $dateStr строка даты Пустая = '12:00:00 AM' иначе mm/dd/yyyy 12/9/2022
 * @return date yyyy-mm-dd либо ''
 */
function transformDate($dateStr)
{
    if ($dateStr) {
        if (($dateStr == '12:00:00 AM')||($dateStr == '0:00:00')) {
            $dateStr = '';
        } else {
            try {
                if (strpos('p'.$dateStr, '/') > 0) {
                    $dateArr = explode('/', $dateStr);
                    if (checkdate($dateArr[0], $dateArr[1], $dateArr[2])) {
                        $dateStr = $dateArr[2] . '-' . $dateArr[0] . '-' . $dateArr[1];
                    } else {
                        $dateStr = '';  
                    } 
                } elseif  (strpos('p'.$dateStr, '.') > 0) {
                    $dateArr = explode('.', $dateStr);
                    if (checkdate($dateArr[1], $dateArr[0], $dateArr[2])) {
                        $dateStr = $dateArr[2] . '-' . $dateArr[1] . '-' . $dateArr[0];
                    } else {
                        $dateStr = '';  
                    } 
                } else {
                    $dateStr = '';  
                } 
            } catch (Exception $e) {
                $dateStr = '';
            }
        }
    }
    return $dateStr;
}

/**
 * получение и преобразование группы пользователя
 * @param integer $uniti тип объединения 
 *    (если 3 тогда см(2) и инет(3) переходят в бт(1)) 
 *     [category - name, description ...; product - name, description ..., date_available]
 *    (если 2 тогда инет(3) переходит в см(2)) 
 *     [category - active(quantity); product - quantity; info_head - all]
 *    иначе не меняется
 * @param integer $usGr группа пользователя если -1 тогда значение из сессии
 *     
 */
function getUserGroup($unity = 0, $usGr = -1)
{
    if ($usGr == -1) {
        $userGroup = 0;
        if(isset($_SESSION['userGroup'])){
            $userGroup = $_SESSION['userGroup'];
        }
    } else {
        $userGroup = $usGr; 
    } 
    $userGroup = intval($userGroup);    
    if ($unity == 3) {
        if (($userGroup == 2) || ($userGroup == 3))  {
            $userGroup = 1; 
        }
    } elseif ($unity == 2) {
        if ($userGroup == 3) {
            $userGroup = 2; 
        }
    }
    return $userGroup;
}

function checkAttribut($checkedArray, $attributName)
{
    try {
        $res = $checkedArray[$attributName]["attributes"]['Update'] == 'TRUE';
    } catch (\Throwable $th) {
        $res = false;
    } 
   return $res;   
}

function xmlToArray(SimpleXMLElement $xml): array
{
    $parser = function (SimpleXMLElement $xml, array $collection = []) use (&$parser) {
        $nodes = $xml->children();
        $attributes = $xml->attributes();

        if (0 !== count($attributes)) {
            foreach ($attributes as $attrName => $attrValue) {
                $collection['attributes'][$attrName] = strval($attrValue);
            }
        }

        if (0 === $nodes->count()) {
            $collection['value'] = strval($xml);
            return $collection;
        }

        foreach ($nodes as $nodeName => $nodeValue) {
            if (count($nodeValue->xpath('../' . $nodeName)) < 2) {
                $collection[$nodeName] = $parser($nodeValue);
                continue;
            }

            $collection[$nodeName][] = $parser($nodeValue);
        }

        return $collection;
    };

    return [
        $xml->getName() => $parser($xml)
    ];
}

/**
 *  send e-mail
 * 
 * @param string $email address of recipient
 * @param string $title subject of the letter
 * @param string $message body of letter
 * @param array $images array of images in body mail (\www\images\mail\) 
 * @param array $files array of files attached mail (\www\attached\)
 * @param array $copyMail array of additional addresses
 * 
 * @return array result
 */
function sendMail($email, $title, $message, $images = NULL, $files = NULL, $copyMail = NULL)
{
    // Файлы phpmailer
    include_once '../library/phpmailer/PHPMailer.php';
    include_once '../library/phpmailer/SMTP.php';
    include_once '../library/phpmailer/Exception.php';
    
    $rfile = NULL;
    $status = NULL;
   
    // Настройки PHPMailer
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    try {
        $mail->isSMTP();   
        $mail->CharSet = "UTF-8";
        $mail->SMTPAuth   = true;
        //$mail->SMTPDebug = 2;
        $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};
    
        // Настройки вашей почты
        $mail->Host       = 'smtp.beget.com'; // SMTP сервера вашей почты
        $mail->Username   = 'test2@beauty-ornament.ru'; // Логин на почте
        $mail->Password   = readFromFile('inf.txt'); // Пароль на почте
        //$mail->SMTPSecure = 'ssl';
        $mail->Port       = 25;
        $mail->setFrom('test2@beauty-ornament.ru', 'Beautic'); // Адрес самой почты и имя отправителя
    
        // Получатель письма
        $mail->addAddress($email);  
        if (isset($copyMail)) {
            if (is_array($copyMail)) {
                 foreach($copyMail as $emailAdd) {
                    $mail->addAddress($emailAdd); // Дополнительные адреса получателей
                 }
            }
        }
   /*
    // Прикрипление файлов к письму
    if (!empty($file['name'][0])) {
        for ($ct = 0; $ct < count($file['tmp_name']); $ct++) {
            $uploadfile = tempnam(sys_get_temp_dir(), sha1($file['name'][$ct]));
            $filename = $file['name'][$ct];
            if (move_uploaded_file($file['tmp_name'][$ct], $uploadfile)) {
                $mail->addAttachment($uploadfile, $filename);
                $rfile[] = "Файл $filename прикреплён";
            } else {
                $rfile[] = "Не удалось прикрепить файл $filename";
            }
        }   
    }
    */
    
    if ($files) {
        if (is_array($files)){
            foreach($files as $file) {
                $mail->addAttachment(realpath('../www/attached/'.$file), $file);
            }
        }
    }

    // Отправка сообщения
    $mail->isHTML(true);
    $mail->Subject = $title;
    if ($images) {
        if (is_array($images)){
            $i = 0;
            foreach($images as $image) {
                $i++;
                $mail->AddEmbeddedImage(realpath('../www/images/mail/'.$image),"image$i");
            }
        }
    }
    $mail->Body = $message;    
 
    // Проверяем отравленность сообщения
    if ($mail->send()) {$result = "success";} 
    else {$result = "error";}
    
    } catch (Exception $e) {
        $result = "error";
        $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
    }
    $res = array("result" => $result, "resultfile" => $rfile, "status" => $status);
    // Отображение результата
    //echo json_encode($res);
    return $res;
}

function formatTel($tel)
{
    $tel = intval($tel);
    $strlen = mb_strlen($tel);
    if ($strlen >= 11) {
        $telFormat = sprintf("%s-%s-%s-%s-%s",
            substr($tel, 0, 1),
            substr($tel, 1, 3),
            substr($tel, 4, 3),
            substr($tel, 7, 2),
            substr($tel, 9));
    } elseif ($strlen == 10) {
        $telFormat = sprintf("%s-%s-%s-%s",
            substr($tel, 0, 3),
            substr($tel, 3, 3),
            substr($tel, 6, 2),
            substr($tel, 8, 2));
    } elseif ($strlen > 5) {
        $telFormat = sprintf("%s-%s-%s",
            substr($tel, 0, 3),
            substr($tel, 3, 2),
            substr($tel, 5));
    } elseif (($strlen > 3)) {
        $telFormat = sprintf("%s-%s",
            substr($tel, 0, 2),
            substr($tel, 2));
    } else {
        $telFormat = $tel;
    }
    return $telFormat;
}
