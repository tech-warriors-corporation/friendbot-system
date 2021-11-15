<?php
    function redirect($path, $message){
        $alert = !!$message ? "alert('$message');" : "";

        echo "<script>$alert document.location = '$path';</script>";
    }
?>
