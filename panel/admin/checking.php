<?php
error_reporting(0);
session_start();
include "../../libraries/geoplugin.class.php";
include "../../libraries/UserInfo.php";
include "../../setting/config.php";
include "../../setting/alert-admin.php";
include "../../setting/functions.php";

$geoplugin = new geoPlugin();
$geoplugin->locate();
$ip = get_client_ip();
$present_time = date("H:i:s"."-"."m/d/y");

$jsonFilePath = "./admin.json";
$json_data = file_get_contents($jsonFilePath);
$user_data = json_decode($json_data, true);
$user_name = $user_data['user_name'];
$password = $user_data['password'];
$token_admin = TOKEN;
$chat_id_admin = CHATID;

if (isset($_POST['button_login'])) {
    $user_name_login = $_POST['username'];
    $password_login = $_POST['password'];

    if ($user_name_login === $user_name && $password_login === $password) {
        $ip_found = false;
        foreach ($user_data['login_status'] ?? [] as $login) {
            if ($login['ip'] === $ip) {
                $ip_found = true;
                break;
            }
        }
        
        if (!$ip_found) {
            $user_data['login_status'][] = [
                'ip' => $ip,
            ];

            $updated_json_data = json_encode($user_data, JSON_PRETTY_PRINT);
            file_put_contents($jsonFilePath, $updated_json_data);
        }

        $_SESSION["message_panel"] = "Your login is successful - " . $ip;

        $log = "Your login is successful";

        // Send Data To Telegram :
        $message = urlencode(
        "🔐========= Login Status =========🔐\r\n". 
        "📍IP - ".get_client_ip()."\t\t | \t\t". 
        $geoplugin->countryCode ."\r\n".
        "📊 Login Status = " .$log."\r\n".
        "💻 DEVICE = " .UserInfo::get_device()."\r\n".
        "♻️ SYSTEM TYPE = ". UserInfo::get_os()."\r\n". 
        "🌐 BROWSER VISIT = ". UserInfo::get_browser()."\r\n".
        "DATE AND TIME = ". $present_time ."\r\n".
        "🔐========= Login Status =========🔐\r\n");
        telegram($token_admin, $message, $chat_id_admin);

        echo 
        "<script>
            window.location.replace('../pages/main_panel.php');
        </script>";
    } else {

        $_SESSION["message_login"] = "Your login is Invalid - " . $ip;

        $log = "Your login is Invalid";

        // Send Data To Telegram :
        $message= urlencode("🔐========= Login Status =========🔐\r\n" . 
        "📍IP - ".get_client_ip()."\t\t | \t\t". 
        $geoplugin->countryCode ."\r\n".
        "📊 Login Status = " .$log."\r\n".
        "💻 DEVICE = " .UserInfo::get_device()."\r\n".
        "♻️ SYSTEM TYPE = ". UserInfo::get_os()."\r\n". 
        "🌐 BROWSER VISIT = ". UserInfo::get_browser()."\r\n".
        "DATE AND TIME = ". $present_time ."\r\n".
        "🔐========= Login Status =========🔐\r\n");
        telegram($token_admin, $message, $chat_id_admin);

        echo 
        "<script>
            window.location.replace('../pages/login.php');
        </script>";
    }
}




?>