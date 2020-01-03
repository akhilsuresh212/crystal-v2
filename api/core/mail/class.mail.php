<?php

/*************************************************************
 * 
 *************************************************************/
require_once ABSPATH . 'adminpanel/library/phpmailer/ses.php';

class Mail
{

    private static $msg;

    /**************************************************************
     * @param String $file name of the template file
     * @param Array Array of key to be replaced.(As in template)
     * @param Array Array of words to be replaced (as in find)
     * @return null if has error
     ***************************************************************/
    public static function renderMail($file, $find, $replace)
    {
        try {
            $file = API_ABSPATH . 'core/mail/templates/' . $file . ".html";
            $file = file_get_contents($file);
        } catch (Exception $e) {
            return null;
        }
        Mail::$msg = str_replace($find, $replace, $file);
    }

    /******************************************************************
     * @param string $to recipients mail address
     * @param String $subject subject of mail
     * @oaram any $headers headers of the mail
     ******************************************************************/
    public static function sendmail($to, $subject, $headers = "")
    {
        return Mail($to, $subject, Mail::$msg, $headers);
    }
}
