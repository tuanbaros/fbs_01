<?php

namespace App\Helpers;

use Mail;

class MyFuncs
{
    public static function handleTitle($string, $num)
    {
        $arr = explode(' ', $string);
        $description = '';
        if (count($arr) > $num) {
            for ($i = 0; $i < $num; $i++) {
                $description .= $arr[$i] . ' ';
            }
        } else {
            $description = $string;
        }
        $description .= ' ...';
        return $description;
    }

    public static function sendEmail($content)
    {
        Mail::send($content['view'], $content['data'], function($message) use ($content) {
            $message->to($content['email']);
            $message->subject($content['subject']);
        });
    }
}
