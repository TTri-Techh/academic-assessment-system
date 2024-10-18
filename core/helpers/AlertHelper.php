<?php

namespace core\helpers;

class AlertHelper
{
    public static function showAlert($title, $message, $icon = 'info')
    {
        echo "
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '$title',
                text: '$message',
                icon: '$icon'
                });
                });
                
                if (window.location.search) {
            const url = new URL(window.location);
            url.search = ''; // Clear query parameters
            window.history.replaceState({}, document.title, url);
            }
    </script>";
    }
}
