<?php
class commonFunctions
{

    /********************************************************************************
     * @param string $password Password to be encrypted or checked.
     * @param string $action Action to be performed (register/login)
     * @param hash $hash hashed password from DB, required if action is login
     ********************************************************************************/
    public static function passwordValidate($password, $action = "register", $hash = null){

        if ($action === 'register') {
            return password_hash($password, PASSWORD_DEFAULT);
        }
        else{
            return password_verify($password, $hash);
        }
    }

    public static function generate_token($length = 6){

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
