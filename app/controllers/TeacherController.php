<?php

namespace app\controllers;

use app\models\TeacherModel;
use core\db\MySQL;
use core\helpers\AlertHelper;

class TeacherController
{
    private $teacherModel;

    public function __construct()
    {
        $database = new MySQL();
        $db = $database->connect();
        $this->teacherModel = new TeacherModel($db);
    }


    /**
     * Register a teacher
     *
     * @param array $data [a teacher's data]
     *
     * @return void
     */
    public function register($data)
    {
        $username = $this->generateUsername($data['name']) ?? '';
        // Ensure unique username by appending numbers if necessary
        $originalUsername = $username;
        $counter = 1;
        while ($this->teacherModel->checkUsernameExists($username)) {
            $username = $originalUsername . $counter;
            $counter++;
        }

        $data = [
            'name' => $data['name'] ?? '',
            'username' => $username,
            'phone' => $data['phone'] ?? '',
        ];
        $result = $this->teacherModel->register($data);

        if ($result) {
            $response = "Teacher registered successfully as " . $username;
            AlertHelper::showAlert('Registration Succeed', $response, 'success');
        } else {
            AlertHelper::showAlert('Registration Failed.', 'Something went wrong.', 'error');
        }
    }
    /**
     * Generate a username for teacher
     *
     * @param string $name [teacher's name]
     *
     * @return array|string [Returns U Nyi Nyi as unyinyi] 
     */
    public function generateUsername($name)
    {
        return strtolower(str_replace(' ', '', $name));
    }
}
