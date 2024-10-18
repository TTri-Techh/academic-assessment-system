<?php

namespace app\controllers;

use app\models\TeacherModel;
use core\db\MySQL;

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
     * @return string
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
            $_SESSION['response'] = "Teacher registered successfully as " . $username;
            header("Location: register-teachers.php?register=success");
        } else {
            $_SESSION['response'] = "Something went wrong.";
            header("Location: register-teachers.php?register=fail");
        }
        exit();
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

    /**
     * Method getAllTeachers
     *
     * @return object [Teacher object with allTeachers]
     */
    public function getAllTeachers()
    {
        return $this->teacherModel->getAllTeachers();
    }
    /**
     * Method getTeacherById
     *
     * @param int $id [ teacher's id ]
     *
     * @return object [ teacher data]
     */
    public function getTeacherById($id)
    {
        return $this->teacherModel->getTeacherById($id);
    }
    // public function getFilteredRecords($start, $length, $search)
    // {
    //     return $this->teacherModel->getFilteredRecords($start, $length, $search);
    // }    
    /**
     * Method updateTeacherById
     *
     * @param array $data [Teacher's data]
     *
     * @return void
     */
    public function updateTeacherById($data)
    {
        $result = $this->teacherModel->updateTeacherById($data);
        if ($result) {
            header("Location:view-teachers.php?update=success");
            exit();
        } else {
            header("Location:view-teachers.php?update=fail");
            exit();
        }
    }

    /**
     * Method deleteTeacherById
     *
     * @param $id $id [teacher's id to be deleted]
     *
     * @return void
     */
    public function deleteTeacherById($id)
    {
        $result = $this->teacherModel->deleteTeacherById($id);
        header("Location: view-teachers.php");
        exit();
    }
}
