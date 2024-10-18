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

    public static function confirmDelete($id, $text, $urlToRedirect)
    {
        return "
            Swal.fire({
                title: 'Are you sure?',
                text: '$text',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '$urlToRedirect$id';
                }
            });
        ";
    }
}
