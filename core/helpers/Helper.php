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
}
