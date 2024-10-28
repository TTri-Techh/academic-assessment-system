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
}
