<?php

namespace app\controllers;

use app\models\AdminModel;
use core\db\MySQL;

class AdminAuthController
{
    private $admin;

    public function __construct()
    {
        $database = new MySQL();
        $db = $database->connect();
        $this->admin = new AdminModel($db);
    }


    /**
     * Method login
     *
     * @param string $email [Admin's email address]
     * @param string $password [Admin's password]
     *
     * @return void
     */
    public function login($email, $password)
    {
        $admin = $this->admin->findByEmail($email, $password);
        if ($admin && password_verify($password, hash: $admin->password)) {
            $_SESSION['admin_id'] = $admin->id;
            $_SESSION['admin_email'] = $admin->email;
            return true;
        }
        return false;
    }


    /**
     * Method isAuthenticated
     *
     * @return bool
     */
    public function isAuthenticated()
    {
        return isset($_SESSION['admin_id']);
    }

    /**
     * Method logout
     *
     * @return void
     */
    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: /Resource-hub-for-primary-teacher/public/admin/login.php?logout=success");
        exit();
    }
}