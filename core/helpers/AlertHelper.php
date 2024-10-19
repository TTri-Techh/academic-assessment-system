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
                }).then(() => {
                    // Clear the query parameters after showing the alert
                    const url = new URL(window.location.href);
                    url.search = ''; 
                    window.history.replaceState({}, document.title, url);
                });
            });
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
