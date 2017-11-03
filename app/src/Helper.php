<?php
/**
 * Created by PhpStorm.
 * User: Sergey Pavlov
 * Date: 02.11.2017
 * Time: 20:36
 */

namespace crudExample;


class Helper
{
    public static function sliceDir ($dir, $level)
    {
        $pathArray = explode(DIRECTORY_SEPARATOR, $dir);
        $new = array_slice ( $pathArray, 0, -$level);
        return implode(DIRECTORY_SEPARATOR, $new);
    }

    static public function shortClassName ($obj){
        $longName = get_class ($obj);
        $ar = explode ( "\\", $longName);
        $last = count($ar)-1 ;
        return $ar[$last];
    }
}