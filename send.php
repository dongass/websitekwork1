<?php

/**
 * Send mail

 * @category File
 * @package  MyPackage
 * @author   NVK Other <username@example.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @version  GIT: $Id$ In development.
 * @link     http://www.hashbangcode.com/
 * @since    1.0.0
 */
function adopt($text) {
    return '=?UTF-8?B?'.base64_encode($text).'?=';
}
if (isset($_POST)) {
    $to = 'info@alexestetica.ru'; //здесь указать свою почту
    $site = $_SERVER['HTTP_HOST'];
    $dt = date("d F Y, H:i:s"); // дата и время
   
    $subject = "Заказ с сайта";

    $body = "<html><body style='font-family:Arial,sans-serif;'>";
    $body .= "<h2 style='font-weight:bold;border-bottom:1px dotted #ccc;'>
  Поздравляем, новый заказ с сайта :" . $site . "</h2>\n";
    $body .= " <p><strong> Дата и  Время заказа:</strong> " . $dt . "</p>\n ";
   
    foreach ($_POST as $key => $value) {
        if ($key != 'formservices' && substr($key, 0, 5) != 'tilda' && $key != 'site') {
        if ($value != '') {
            if ($value == 'on') {
                 $body .= "<b>" . $key . "</b><br>";
            } else {
                $body .= "<b>" . str_replace("_", " ", $key) . "</b> : " . trim(htmlspecialchars($value)) . "<br>";
            }
        }
        }
    }
    $body .= "</body></html>";
    

    $headers = "From :" . adopt("SiteRobot") . "<noreply@" . $_SERVER['HTTP_HOST'] . ">\n";
    $headers .= 'MIME-Version: 1.0' . "\n";
    $headers .= 'Content-Type: text/html;charset=utf-8' . "\n";

    // отправка сообщения
    $sendmail = mail($to, adopt($subject), $body, $headers);
    if ($sendmail) {
            echo ('{"message":"OK"}');
        return;
    } else {
		    echo "<script>alert(\"error.\");</script>";
            echo false;
        return;
    }
}
echo (" Поля не заполнены ");