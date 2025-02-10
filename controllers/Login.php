<?php

include_once('models/LoginModel.php');

class LoginController
{
    private $model;

    public function __construct()
    {
        $this->model = new LoginModel();
    }

    public function login_validation($username, $password)
    {
        return $this->model->login_validation($username, $password);
    }

    public function addUsers($username,$nama,$password)
    {
        return $this->model->addUsers($username,$nama,$password);
    }

}
