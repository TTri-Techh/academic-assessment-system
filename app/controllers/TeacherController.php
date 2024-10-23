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
        $username = $this->generateUsername($data['name_eng']) ?? '';
        // Ensure unique username by appending numbers if necessary
        $originalUsername = $username;
        $counter = 1;
        while ($this->teacherModel->checkUsernameExists($username)) {
            $username = $originalUsername . $counter;
            $counter++;
        }
        // 16 rows of data
        $data = [
            'name_eng' => $data['name_eng'] ?? '',
            'name_mm' => $data['name_mm'] ?? '',
            'username' => $username,
            'father_name' => $data['father_name'] ?? '',
            'mother_name' => $data['mother_name'] ?? '',
            'education' => $data['education'] ?? '',
            'rank' => $data['rank'] ?? '',
            'dob' => $data['dob'] ?? '',
            'start_edu_at' => $data['start_edu_at'] ?? '',
            'start_current_rank_at' => $data['start_current_rank_at'] ?? '',
            'start_current_school_at' => $data['start_current_school_at'] ?? '',
            'phone' => $data['phone'] ?? '',
            'address' => $data['address'] ?? '',
            'bed_status' => $data['bed_status'] ?? '',
            'phaung_gyi_status' => $data['phaung_gyi_status'] ?? '',
            'completed_course' => $data['completed_course'] ?? '',
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
     * Method getALlTeachersIDAndName
     *
     * @return object 
     */
    public function getAllTeachersClass()
    {
        return $this->teacherModel->getAllTeachersClass();
    }
    /**
     * Method get a teacher class name
     *
     * @return object 
     */
    public function getTeacherClassNameById($id)
    {
        return $this->teacherModel->getTeacherClassNameById($id);
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
    /**
     * Method update (assign) teacher class
     *
     * @param int $id [teacher id]
     * 
     * @param int $classId [teacher's class id]
     *
     * @return bool|string
     */
    public function updateTeacherClassById($id, $classId)
    {
        $result = $this->teacherModel->updateTeacherClassById($id, $classId);
        if ($result) {
            header("Location:assign-classes.php?update=success");
            exit();
        } else {
            header("Location:assign-classes.php?update=fail");
            exit();
        }
    }
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
