<?php


class View{
    static function render($templatePath, $array){
        echo self::getTemplate($templatePath, $array);
    }

    static function getTemplate($templatePath, $array){
        $template = file_get_contents($_SERVER['DOCUMENT_ROOT']."/Bristol_WebDev/templates/$templatePath");
        foreach($array as $key=>$value){
            $template = str_replace("{{{$key}}}", $value, $template);
        }
        $template = preg_replace("/{{(.*?)}}/","",$template); // get rid of ignored keywords
        return $template;
    }
}