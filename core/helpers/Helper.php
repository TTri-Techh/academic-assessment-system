<?php

namespace core\helpers;

class Helper
{
    public static function startSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            return session_start(); // Returns true on success, false on failure
        }
        return true; // If session is already active, return true
    }
    public static function redirect($url)
    {
        header("Location:$url");
        exit();
    }
    public static function calculateGrade($mark)
    {
        if ($mark >= 80) {
            return 'A';
        } else if ($mark < 80 && $mark >= 60) {
            return 'B';
        } else if ($mark < 60 && $mark >= 40) {
            return 'C';
        } else if ($mark < 40 && $mark >= 0) {
            return 'D';
        } else {
            return 'Invalid mark';
        }
    }
    public static function calculateTotalGrade($totalMark)
    {
        $result = $totalMark / 5;
        Helper::calculateGrade($result);
    }
    public static function getLowerGradeBySubjectId($assessments, $subjectId, $monthNo)
    {
        foreach ($assessments as $assessment) {
            if ($assessment['subject_id'] == $subjectId && $assessment['month_no'] == $monthNo) {
                return $assessment['mark'];
            }
        }
        return '';
    }
    public static function getUpperGradeBySubject($assessments, $subject, $monthNo)
    {
        foreach ($assessments as $assessment) {
            $gradeColumn = $subject . '_grade';  // ဥပမာ - myanmar_grade, english_grade
            if (isset($assessment[$gradeColumn]) && $assessment['month_no'] == $monthNo) {
                return $assessment[$gradeColumn];
            }
        }
        return '';
    }
    public static function calculateAverageGrade($assessments, $subject)
    {
        $gradeColumn = $subject . '_grade';
        $grades = [];

        // ရမှတ်များကို array ထဲသိမ်းထားမယ်
        for ($monthNo = 1; $monthNo <= 4; $monthNo++) {
            foreach ($assessments as $assessment) {
                if (
                    isset($assessment[$gradeColumn]) &&
                    $assessment['month_no'] == $monthNo &&
                    !empty($assessment[$gradeColumn])
                ) {
                    $grades[] = $assessment[$gradeColumn];
                }
            }
        }

        // ရမှတ်အားလုံးပြည့်စုံမှသာ ပျမ်းမျှတွက်မယ်
        if (count($grades) == 4) {
            // Grade တွေကို number value အဖြစ်ပြောင်း
            $gradeValues = array_map(function ($grade) {
                switch ($grade) {
                    case 'A':
                        return 5;
                    case 'B':
                        return 4;
                    case 'C':
                        return 3;
                    case 'D':
                        return 2;
                    default:
                        return 1;
                }
            }, $grades);

            // ပျမ်းမျှတန်ဖိုးတွက်ပြီး grade ပြန်ပြောင်း
            $average = array_sum($gradeValues) / count($gradeValues);

            if ($average >= 4.5) return 'A';
            if ($average >= 3.5) return 'B';
            if ($average >= 2.5) return 'C';
            if ($average >= 1.5) return 'D';
            return 'E';
        }

        return ''; // ရမှတ်မပြည့်စုံသေးရင် empty string ပြန်ပေး
    }
    public static function calculateLowerAverageGrade($assessments, $subjectId)
    {
        $grades = [];

        // ရမှတ်များကို array ထဲသိမ်းထားမယ်
        for ($monthNo = 1; $monthNo <= 4; $monthNo++) {
            foreach ($assessments as $assessment) {
                if (
                    $assessment['subject_id'] == $subjectId &&
                    $assessment['month_no'] == $monthNo &&
                    !empty($assessment['mark'])
                ) {
                    $grades[] = $assessment['mark'];
                }
            }
        }

        // ရမှတ်အားလုံးပြည့်စုံမှသာ ပျမ်းမျှတွက်မယ်
        if (count($grades) == 4) {
            // Grade တွေကို number value အဖြစ်ပြောင်း
            $gradeValues = array_map(function ($grade) {
                switch ($grade) {
                    case 'A':
                        return 3;
                    case 'S':
                        return 2;
                    case 'E':
                        return 1;
                }
            }, $grades);

            // ပျမ်းမျှတန်ဖိုးတွက်ပြီး grade ပြန်ပြောင်း
            $average = array_sum($gradeValues) / count($gradeValues);

            if ($average >= 2.5) return 'A';
            if ($average >= 1.5) return 'S';
            return 'E';
        }

        return ''; // ရမှတ်မပြည့်စုံသေးရင် empty string ပြန်ပေး
    }
}
