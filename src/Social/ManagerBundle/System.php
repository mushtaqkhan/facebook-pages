<?php

namespace Social\ManagerBundle;

class System {

    public static function _reString($str) {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(\/)/", '-', $str);
        $str = preg_replace("/(\.)/", '-', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ|A)/", 'a', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ|E)/", 'e', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ|I)/", 'i', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ|O)/", 'o', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ|U)/", 'u', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ|Y)/", 'y', $str);
        $str = preg_replace("/(Đ|D)/", 'd', $str);
        $str = preg_replace("/ /", "-", $str);
        $str = str_replace("?", "", $str);
        $str = str_replace("&", "", $str);
        $str = str_replace(" ", "-", str_replace("&*#39;", "", $str));
        $str = stripslashes($str);
        $str = str_replace(array("(", ")", "{", "}", "[", "]", "\"", ":", ".", "'", "\'", ","), "", str_replace("&*#39;", "", $str));
        $str = strtolower($str);
        $tmp = explode('-', $str);
        $tmp2 = "";
        foreach ($tmp as $value) {
            if ($value != '-' && strlen($value) > 0) {
                if ($tmp2 != "") {
                    $tmp2 = $tmp2 . '-' . $value;
                } else {
                    $tmp2 = $value;
                }
            }
        }
        $tmp2 = str_replace(array("'", "\'", '\''), "", $tmp2);
        return $tmp2;
    }

    public static function getIcon($title) {
        $icon = "code";
        switch ($title) {
            case (preg_match("/Mobile/i", $title) == true):
                $icon = "mobile";
                break;
            case (preg_match("/Scripts/i", $title) == true):
                $icon = "code";
                break;
            case (preg_match("/Plugins/i", $title) == true):
                $icon = "plug";
                break;
            case (preg_match("/Themes/i", $title) == true):
                $icon = "paint-brush";
                break;
            case (preg_match("/iOS/i", $title) == true):
                $icon = "apple";
                break;
            case (preg_match("/Android/i", $title) == true):
                $icon = "android";
                break;
            case (preg_match("/Wordpress/i", $title) == true):
                $icon = "wordpress";
                break;
            case (preg_match("/HTML/i", $title) == true):
                $icon = "html5";
                break;
            case (preg_match("/Graphic|Abode|Other Templates/i", $title) == true):
                $icon = "image";
                break;
        }
        return $icon;
    }

    public static function getSomeString($string, $length = 110) {
        $businessDesc = strip_tags($string);
        return mb_substr($businessDesc, 0, $length);
    }

    public static function getSomeWords($string, $length = 10) {
        $businessDesc = explode(" ", self::strip_tags_content($string));
        $tmp = implode(" ", array_slice($businessDesc, 0, $length));

        if (count($businessDesc) > $length) {
            $tmp .= " ...";
        }
        return $tmp;
    }

    static function strip_tags_content($text, $tags = '', $invert = FALSE) {

        $text = strip_tags($text);
        
        preg_match_all('/<(.+?)[\s]*\/?[\s]*>/si', trim($tags), $tags);
        $tags = array_unique($tags[1]);

        if (is_array($tags) AND count($tags) > 0) {
            if ($invert == FALSE) {
                return preg_replace('@<(?!(?:' . implode('|', $tags) . ')\b)(\w+)\b.*?>.*?</\1>@si', '', $text);
            } else {
                return preg_replace('@<(' . implode('|', $tags) . ')\b.*?>.*?</\1>@si', '', $text);
            }
        } elseif ($invert == FALSE) {
            return preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', $text);
        }
        return $text;
    }

    public static function getTitle($string, $length = 30) {

        $tmp = mb_substr($string, 0, $length, "UTF-8");


        if (mb_strlen($string, 'UTF-8') > mb_strlen($tmp, 'UTF-8')) {
            $tmp .= "...";
        }
        return $tmp;
    }

}
