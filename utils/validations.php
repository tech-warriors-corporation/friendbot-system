<?php
    function has_id($value){
        return $value !== 0;
    }

    function show_error($error){
        $message = $error -> getMessage();

        echo "<script>alert(\"" . $message . "\");</script>";
    }
?>
