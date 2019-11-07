<?php

namespace arifinm\telegram\components;

class TelegramNotification
{
    /* Send message without photo */
    public static function sendMessage($botToken, $chatID, $message, $mode='markdown') 
    {
        $bot_url = "https://api.telegram.org/bot$botToken/";
        $url = $bot_url."sendMessage?chat_id=".$chatID."&parse_mode=".$mode."&text=".urlencode($message);
        $response = file_get_contents($url);

        return $response;
    }

    /* Send single photo */
    public static function sendPhoto($botToken, $chatID, $img)
    {
        $ch = curl_init("https://api.telegram.org/bot$botToken/sendPhoto?chat_id=$chatID&photo=$img");
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
        curl_exec($ch);
    }

    /* Send multiple photo */
    public static function sendPhotoGroup($botToken, $chatID, $img)
    {
        $ch = curl_init("https://api.telegram.org/bot".$botToken."/sendMediaGroup?chat_id=".$chatID."&media=".json_encode($img));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
        curl_exec($ch);
    }
}
