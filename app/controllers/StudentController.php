<?php

namespace app\controllers;

use app\models\StudentModel;
use core\db\MySQL;


class StudentController
{
    private $studentModel;

    public function __construct()
    {
        $database = new MySQL();
        $db = $database->connect();
        $this->studentModel = new StudentModel($db);

    }

    public function register($data)
    {
        $username = $this->generateUsername($data['name_eng']) ?? '';
        // Ensure unique username by appending numbers if necessary
        $originalUsername = $username;
        $counter = 1;
        while ($this->studentModel->checkUsernameExists($username)) {
            $username = $originalUsername . $counter;
            $counter++;
        }
        // 16 rows of data
        $data = [
            'enrollment_no' => $data['enrollment_no'] ?? '',
            'name_en' => $data['name_en'] ?? '',
            'name_my' => $data['name_my'] ?? '',
            'username' => $username,
            'dob' => $data['dob'] ?? '',
            'father_name' => $data['father_name'] ?? '',
            'mother_name' => $data['mother_name'] ?? '',
            'guardian' => $data['guardian'] ?? '',
            'parent_job' => $data['parent_job'] ?? '',
            'address' => $data['address'] ?? '',
            'phone_number' => $data['phone_number'] ?? '',
        ];
        $result = $this->studentModel->register($data);

        if ($result) {
            $_SESSION['response'] = "Students registered successfully as " . $username;
            header("Location: register-students.php?register=success");
        } else {
            $_SESSION['response'] = "Something went wrong.";
            header("Location: register-students.php?register=fail");
        }
        exit();
    }

    public function generateUsername($name)
    {
        return strtolower(str_replace(' ', '', $name));
    }

    public function getAllTeachers()
    {
        return $this->studentModel->getAllStudents();
    }
}