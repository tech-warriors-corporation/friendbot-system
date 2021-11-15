<?php
    function hasId($value){
        return $value !== 0;
    }

    function showError($error){
        $message = $error -> getMessage();

        echo "<script>alert(\"" . $message . "\");</script>";
    }
?>
