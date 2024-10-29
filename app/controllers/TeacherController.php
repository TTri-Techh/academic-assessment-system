<?php

namespace app\controllers;

use app\models\QcprModel;
use app\models\TeacherModel;
use core\db\MySQL;
use core\helpers\Helper;

class TeacherController
{
    private $teacherModel;

    public function __construct()
    {
        $database = new MySQL();
        $db = $database->connect();
        $this->teacherModel = new TeacherModel($db);
        Helper::startSession();
    }

    public function login($username, $password)
    {
        $teacher = $this->teacherModel->getTeacherByUsername($username);

        if (!$teacher) {
            return false; // သို့မဟုတ် error message တစ်ခုခု return လုပ်နိုင်ပါတယ်
        }

        $passwordStatus = $teacher->password_status;
        $_SESSION['teacher_password_status'] = $passwordStatus;
        $_SESSION['class_id'] = $teacher->class_id;
        $_SESSION['teacher_name'] = $this->getTeacherClassNameById($teacher->id)->name_mm;
        $_SESSION['class_name'] = $this->getTeacherClassNameById($teacher->id)->class_name;


        if ($passwordStatus === 1) {
            if (password_verify($password, $teacher->password)) {
                $_SESSION['teacher_id'] = $teacher->id;
                $_SESSION['teacher_username'] = $teacher->username;
                header("Location: register-students.php?login=success");
                exit();
            } else {
                return false; // Password မှားနေတယ်
            }
        } elseif ($passwordStatus === 0) {
            if ($password === $teacher->password) { // အရင် password ကို plain text အနေနဲ့ သိမ်းထားတယ်ဆိုရင်
                $_SESSION['teacher_id'] = $teacher->id;
                $_SESSION['teacher_username'] = $teacher->username;
                header("Location: /teacher/change-password.php?username=$username");
                exit();
            } else {
                return false; // Password မှားနေတယ်
            }
        } else {
            return false; // မမှန်တဲ့ password status
        }
    }
    public function updatePassword($username, $password)
    {
        $db = new MySQL();
        $announcementModel = new QcprModel($db->connect());
        $result = $this->teacherModel->updatePassword($username, $password);
        if ($result) {
            $_SESSION['teacher_password_status'] = 1;
            $announcementModel->createAnnouncement($_SESSION['class_id'], $_SESSION['teacher_id']);
            return true;
        } else {
            return false;
        }
    }

    public function isAuthenticated()
    {
        return isset($_SESSION['teacher_id']) && isset($_SESSION['teacher_password_status']) && $_SESSION['teacher_password_status'] == 1;
    }


    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: /teacher/login.php?logout=success");
        exit();
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
