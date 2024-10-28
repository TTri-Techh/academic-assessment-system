<?php

namespace app\controllers;

use app\models\StudentModel;
use core\db\MySQL;
use core\helpers\Helper;

class StudentController
{
    private $studentModel;

    public function __construct()
    {
        $database = new MySQL();
        $db = $database->connect();
        $this->studentModel = new StudentModel($db);
        Helper::startSession();
    }

    public function isAuthenticated()
    {
        return isset($_SESSION['student_id']) && isset($_SESSION['student_password_status']) && $_SESSION['student_password_status'] == 1;
    }
    public function register($data)
    {
        $username = $this->generateUsername($data['name_en']) ?? '';
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
            'class_id' => $data['class_id'] ?? '',
            'name_en' => $data['name_en'] ?? '',
            'name_mm' => $data['name_mm'] ?? '',
            'username' => $username,
            'dob' => $data['dob'] ?? '',
            'father_name' => $data['father_name'] ?? '',
            'mother_name' => $data['mother_name'] ?? '',
            'guardian' => $data['guardian'] ?? '',
            'parent_job' => $data['parent_job'] ?? '',
            'address' => $data['address'] ?? '',
            'phone' => $data['phone'] ?? '',
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

    public function getAllStudents()
    {
        return $this->studentModel->getAllStudents();
    }
    public function getStudentById($id)
    {
        return $this->studentModel->getStudentById($id);
    }
    public function getStudentsByClassId($class_id)
    {
        return $this->studentModel->getStudentsByClassId($class_id);
    }
    public function getStudentClassNameById($id)
    {
        return $this->studentModel->getStudentClassNameById($id);
    }
    public function updateStudentById($data)
    {
        $result = $this->studentModel->updateStudentById($data);
        if ($result) {
            header("Location:view-students.php?update=success");
            exit();
        } else {
            header("Location:view-students.php?update=fail");
            exit();
        }
    }

    public function deleteStudentById($id)
    {
        return $this->studentModel->deleteStudentById($id);
        header("Location: view-students.php");
        exit();
    }

    public function login($username, $password)
    {
        $student = $this->studentModel->getStudentByUsername($username);

        if (!$student) {
            return false;
        }

        $passwordStatus = $student->password_status;
        // Session variables အားလုံးကို တစ်ခါတည်း set လုပ်ပါ
        $_SESSION['student_password_status'] = $passwordStatus;
        $_SESSION['student_username'] = $username;  // ဒီ line ကို အပေါ်မှာ ထည့်လိုက်ပါ
        $_SESSION['class_id'] = $student->class_id;
        $_SESSION['student_name'] = $this->getStudentClassNameById($student->id)->name_mm;
        $_SESSION['class_name'] = $this->getStudentClassNameById($student->id)->class_name;

        if ($passwordStatus === 1) {
            if (password_verify($password, $student->password)) {
                $_SESSION['student_id'] = $student->id;
                header("Location: /index.php?login=success");
                exit();
            } else {
                return false;
            }
        } elseif ($passwordStatus === 0) {
            if ($password === $student->password) {
                $_SESSION['student_id'] = $student->id;
                header("Location: /student/change-password.php?username=$username");
                exit();
            } else {
                return false;
            }
        }
        return false;
    }
    public function updatePassword($username, $newPassword)
    {
        $result = $this->studentModel->updatePassword($username, $newPassword);
        if ($result === true) {
            $_SESSION['student_password_status'] = 1;
            return true;
        } else {
            return false;
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: /index.php?logout=success");
        exit();
    }
}
