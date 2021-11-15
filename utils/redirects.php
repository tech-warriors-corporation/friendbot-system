<?php
    function redirect($path, $message){
        echo "<script>alert('$message'); document.location = '$path';</script>";
    }
?>
