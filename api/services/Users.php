<?php

/**
 * 
 */
class Users extends Service implements Rest
{

    public function get()
    {
        // login
        Parameters::required(['email', 'password']);

        // variables
        $email = Service::getVars()['email'];
        $password = Service::getVars()['password'];

        if (!(filter_var($email, FILTER_VALIDATE_EMAIL)))
            Response::error('Please enter a valid email');

        Db::query('SELECT * FROM roto_users WHERE email = :email');
        Db::executeOne([
            ':email' => $email
        ]);

        $result = Db::result();
        if (empty($result))
            Response::error('User Not found');
        if (CommonFunctions::passwordValidate($password, 'login', $result['user_password'])) {
            unset($result['user_password']);
            Response::success('Login Successful', $result);
        } else {
            Response::error('Incorrect password');
        }
    }

    public function post()
    {
        // Add user

        Parameters::required(['fullname', 'email', 'password', 'phone']);
        // variables
        $email      = Service::getVars()['email'];
        $phone      = Service::getVars()['phone'];
        $password   = Service::getVars()['password'];
        $fullname   = Service::getVars()['fullname'];

        if (!(filter_var($email, FILTER_VALIDATE_EMAIL)))
            Response::error("Invalid email ID");

        if (!(is_numeric($phone)))
            Response::error("Invalid phone number");

        if (!(strlen($password) > 8))
            Response::error("Password should be more than 8 characters");

        $userToken = CommonFunctions::generate_token(32);

        // check mail already exists
        Db::query('SELECT * FROM roto_users WHERE email = :email');
        Db::execute([
            ':email' => $email
        ]);

        if (!(empty(Db::result())))
            Response::error('Email ID already exist');

        // Insert array
        $insertInfo = [
            'token'         => $userToken,
            'user_password' => CommonFunctions::passwordValidate($password),
            'email'         => $email,
            'phone'         => $phone,
            'fullname'      => $fullname,
            'created_date'  => Date('Y-m-d'),
            'status'        => 2
        ];

        Db::insertQuery('roto_users', $insertInfo);

        Db::query('SELECT * FROM roto_users WHERE email = :email');
        Db::execute([
            ':email' => $email
        ]);
        $result = Db::result();
        unset($result['user_password']);
        Response::success('User created successfully', $result);
    }

    public function put()
    {
    }

    public function delete()
    {
    }
}
