<?php
    function get_format($with_hour = false){
        $format = 'd/m/Y';

        return $with_hour ? "$format (h:i)" : $format;
    }

    function set_time_zone_br(){
        setlocale(LC_ALL, 'pt_BR.utf8');
        date_default_timezone_set('America/Sao_Paulo');
    }

    function say_now(){
        set_time_zone_br();

        $format = get_format(true);

        echo date($format);
    }

    function format_string($value){
        set_time_zone_br();

        $format = get_format();

        return date_format(date_create($value), $format);
    }
?>
