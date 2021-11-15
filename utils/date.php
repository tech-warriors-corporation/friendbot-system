<?php
    function getFormat($withHour = false){
        $format = 'm/d/Y';

        return $withHour ? "$format (h:i)" : $format;
    }

    function setTimeZoneBR(){
        setlocale(LC_ALL, 'pt_BR.utf8');
        date_default_timezone_set('America/Sao_Paulo');
    }

    function sayNow(){
        setTimeZoneBR();

        $format = getFormat(true);

        echo date($format);
    }

    function formatString($value){
        setTimeZoneBR();

        $format = getFormat();

        return date_format(date_create($value), $format);
    }
?>
