<?php

session_start();
session_destroy();
echo "<script>
                alert('Logout successfully');
                window.location.href='login.php';
             </script>";
?>