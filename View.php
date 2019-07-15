<?php
class View{
    static function render($templateName, $array){
        $template = file_get_contents("templates/$templateName");
        foreach($array as $key=>$value){
            $template = str_replace("{{{$key}}}", $value, $template);
        }
        $template = preg_replace("/{{(.*?)}}/","",$template); // get rid of ignored keywords
        echo $template;
    }
}