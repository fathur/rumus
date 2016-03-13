<?php

namespace App\Repositories;


class Parse
{
    public static function render($content)
    {
        $parse = new \ParsedownExtra();

        $source = str_replace(
            array('&lt;', '&gt;', '&amp;'),
            array('<',    '>',    '&'),
            $parse->text($content)
        );

        $content = preg_replace("/[^\\\]\\\(?![a-zA-Z\\\])/", " \\\\\\", $source);

        return $content;
    }
}