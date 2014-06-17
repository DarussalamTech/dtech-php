<?php

class MyHelper {

    static public function encode_password($password = '', $salt = '') {
        if (strlen($password) == 0)
            throw new MyException('Vui lòng nhập mật khẩu');
        if ($salt) {
            $salt = md5($salt);
        }
        $password = sha1($password);
        return sha1($salt . $password);
    }

    // this class returen the css class of icon public, private, and friend
    public static function loadClassUserSettingIcon($reviewInformationID) {
        $returnvalue = "publicIcon";
        if ($reviewInformationID == 1) {
            $returnvalue = "friendIcon";
        } else if ($reviewInformationID == 2) {
            $returnvalue = "privateIcon";
        }
        return $returnvalue;
    }

    public static function checkUserSpam() {
        if (!isset(Yii::app()->session['phimsonicSS'])) {
            if (isset($_REQUEST['id'])) {
                if ((int) $_REQUEST['id'] != 0 && (int) $_REQUEST['id'] != Yii::app()->session['phimsonicSS']) {

                    echo "Your computer IP:192.168.0.120 does not have right to access this page,<br> please <a href='javascript:history.go(-1)'>click here</a> to come back!";
                    return 1;
                }
            }
        }
        return 0;
    }

    public static function get_year() {
        $datetime = getdate();
        return $datetime["year"];
    }

    public static function get_month() {
        $datetime = getdate();
        return $datetime["mon"];
    }

    public static function get_day() {
        $datetime = getdate();
        return $datetime["mday"];
    }

    public static function get_date_parse($datetime) {
        $dt = date_parse($datetime);
        $year = $dt['year'];
        $month = $dt['month'];
        $day = $dt['day'];
        return self::num2($year) . "-" . self::num2($month) . "-" . self::num2($day);
    }

    public static function get_date_parse_vn($datetime) {
        if ($datetime == '')
            return '';
        $dt = date_parse($datetime);
        $year = $dt['year'];
        $month = $dt['month'];
        $day = $dt['day'];
        return self::num2($day) . "-" . self::num2($month) . "-" . self::num2($year);
    }

    public static function get_date_parse_vn1($datetime) {
        if ($datetime == '')
            return '';
        $dt = date_parse($datetime);
        $year = $dt['year'];
        $month = $dt['month'];
        $day = $dt['day'];
        return self::num2($day) . " " . month . " " . self::num2($month) . " " . year . " " . self::num2($year);
    }

    public static function get_date_parse_comment($datetime) {
        if ($datetime == '')
            return '';
        $dt = date_parse($datetime);
        $year = $dt['year'];
        $month = $dt['month'];
        $day = $dt['day'];
        $hour = $dt['hour'];
        $minute = $dt['minute'];
        $second = $dt['second'];
        //set timezone default la VIETNAM
        $now = getdate();
        $d1 = mktime($hour, $minute, $second, $month, $day, $year);
        $d2 = mktime($now['hours'], $now['minutes'], $now['seconds'], $now['mon'], $now['mday'], $now['year']);
        $d = $d2 - $d1;
        switch (true) {
            case ($d >= (7 * 24 * 60 * 60)) ://neu so ngay lon hon hoac bang 7
                return self::num2($day) . " " . month . " " . self::num2($month) . " " . year . " " . self::num2($year);
                break;
            case ($d < (7 * 24 * 60 * 60) && $d >= (24 * 60 * 60))://neu so ngay nho hon 7 va lon 1
                return abs(floor($d / (24 * 60 * 60))) . " " . days_ago;
                break;
            case ($d < (24 * 60 * 60) && $d >= (60 * 60))://neu so gio it hon 24 va lon hon hoac bang 1
                return abs(floor($d / (60 * 60))) . " " . hours_ago;
                break;
            case ($d < (60 * 60) && $d >= 60)://so phut nho hon 1 gio
                return abs(floor($d / 60)) . " " . minutes_ago;
                break;
            case ($d < 60):
                return afew_seconds_ago;
                break;
        }
    }

    public static function checkonlinestatus($datetime) {
        if ($datetime == '')
            return '';
        $dt = date_parse($datetime);
        $year = $dt['year'];
        $month = $dt['month'];
        $day = $dt['day'];
        $hour = $dt['hour'];
        $minute = $dt['minute'];
        $second = $dt['second'];
        //set timezone default la VIETNAM
        $now = getdate();
        $d1 = mktime($hour, $minute, $second, $month, $day, $year);
        $d2 = mktime($now['hours'], $now['minutes'], $now['seconds'], $now['mon'], $now['mday'], $now['year']);
        $d = $d2 - $d1;

        if ($d < (10 * 60)) {//so phut nho hon 10 phut
            return 1; //online;   
        }
        else
            return 0; //offline;   
    }

    public static function get_datetime() {
        //return getdate()- 1*60*60;
    }

    public static function get_date() {
        $datetime = getdate(time());
        return self::num2($datetime["year"]) . "-" .
                self::num2($datetime["mon"]) . "-" .
                self::num2($datetime["mday"]);
    }

    public static function get_time() {
        $datetime = getdate(time());
        return $datetime["hours"] . ":" .
                self::num2($datetime["minutes"]) . ":" .
                self::num2($datetime["seconds"]);
    }

    public static function num2($num) {
        if ($num == 0)
            return "";
        if ($num > 0 && $num < 10)
            return "0" . $num;
        else
            return $num;
    }

    public static function rand_string($len = 32) {
        $length = $len;
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $string = "";
        for ($p = 0; $p < $length; $p++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }
        return $string;
    }

    public static function baseUrlAdmin($link) {
        return 'index.php?r=' . $link;
    }

    static public function check_extension($file, $extension = 'jpg|png|gif|bmp') {
        return preg_match("/\.($extension)$/i", $file);
    }

    static public function get_file_extension($path) {
        $parts = pathinfo($path);
        return $parts['extension'];
    }

    static public function get_file_name($path) {
        $parts = pathinfo($path);
        return $parts['filename'];
    }

    static public function slugify($text) {
        $text = preg_replace('/\W+/i', '-', $text);
        $text = strtolower(trim($text, '-'));
        $text = str_replace('---', '-', $text);
        $text = str_replace('--', '-', $text);
        return $text;
    }

    static public function convert_no_sign($str) {
        $str = str_replace('<i>', '-', $str);
        $str = str_replace('</i>', '', $str);
        $str = str_replace('<b>', '-', $str);
        $str = str_replace('</b>', '', $str);
        $str = str_replace('<u>', '-', $str);
        $str = str_replace('</u>', '', $str);
        $str = str_replace('<em>', '-', $str);
        $str = str_replace('</em>', '', $str);

        $str = preg_replace("/(à|á|ạ|ả|ã|â|ẩ|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(A|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'a', $str);
        $str = preg_replace("/(B)/", 'b', $str);
        $str = preg_replace("/(C)/", 'c', $str);
        $str = preg_replace("/(D)/", 'd', $str);
        $str = preg_replace("/(E|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'e', $str);
        $str = preg_replace("/(F)/", 'f', $str);
        $str = preg_replace("/(G)/", 'g', $str);
        $str = preg_replace("/(H)/", 'h', $str);
        $str = preg_replace("/(I|Ì|Í|Ị|Ỉ|Ĩ)/", 'i', $str);
        $str = preg_replace("/(J)/", 'j', $str);
        $str = preg_replace("/(K)/", 'k', $str);
        $str = preg_replace("/(L)/", 'l', $str);
        $str = preg_replace("/(M)/", 'm', $str);
        $str = preg_replace("/(N)/", 'n', $str);
        $str = preg_replace("/(O|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'o', $str);
        $str = preg_replace("/(P)/", 'p', $str);
        $str = preg_replace("/(Q)/", 'q', $str);
        $str = preg_replace("/(R)/", 'r', $str);
        $str = preg_replace("/(S)/", 's', $str);
        $str = preg_replace("/(T)/", 't', $str);
        $str = preg_replace("/(U|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'u', $str);
        $str = preg_replace("/(V)/", 'v', $str);
        $str = preg_replace("/(W)/", 'w', $str);
        $str = preg_replace("/(X)/", 'x', $str);
        $str = preg_replace("/(Y|Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'y', $str);
        $str = preg_replace("/(Z)/", 'z', $str);
        $str = preg_replace("/(Đ)/", 'd', $str);
        $str = str_replace(' ', '-', $str);
        $str = self::slugify($str);
        $str = str_replace('---', '-', $str);
        $str = str_replace('--', '-', $str);
        return $str;
    }

    static public function rename_file_upload($file) {
        $name = md5($file . mt_rand(1, 1000000) . date('YmdHisu'));
        $ext = strtolower(self::get_file_extension($file));
        return $name . '.' . $ext;
    }

    static public function rename_file_upload2($file) {
        $name = self::get_file_name($file);
        $name2 = self::slugify($name);
        $ext = strtolower(self::get_file_extension($file));
        return $name2 . '.' . $ext;
    }

    static public function rename_file_exists($filename, $path) {
        if (file_exists($path . $filename)) {
            $name = self::get_file_name($filename) . '_' . date('YmdHisu');
            $ext = strtolower(self::get_file_extension($filename));
            $filename = $name . '.' . $ext;
        }
        return $filename;
    }

    static public function number_format($number) {
        return number_format($number, 0, '', ', ');
    }

    static public function show_currency($number) {
        if ($number)
            return number_format($number, 0, '', ', ') . ' VNĐ';
        return 'Liên hệ';
    }

    public static function get_datetime_parse_vn($datetime) {
        $dt = date_parse($datetime);
        $year = $dt['year'];
        $month = $dt['month'];
        $day = $dt['day'];
        $hour = $dt['hour'];
        $minute = $dt['minute'];
        return self::num2($day) . "-" . self::num2($month) . "-" . self::num2($year) . " $hour:$minute ";
    }

    public static function get_datetime_parse($datetime) {
        $dt = date_parse($datetime);
        $year = $dt['year'];
        $month = $dt['month'];
        $day = $dt['day'];
        $hour = $dt['hour'];
        $minute = $dt['minute'];
        return self::num2($year) . "-" . self::num2($month) . "-" . self::num2($day) . " $hour:$minute ";
    }

    public static function cut_string($str, $len, $more) {
        if (!is_string($str))
            return $str;
        if ($str == "" || $str == NULL)
            return $str;
        if (mb_strlen($str, 'utf-8') <= $len)
            return $str;
        $str = mb_substr($str, 0, $len - 1, 'utf-8');
        if ($more)
            $str .= "...";
        return $str;
    }

    static public function show_description($str, $len, $more) {
        $str = strip_tags($str);
        $str = mb_strtolower($str, 'UTF-8');
        $str[0] = mb_strtoupper($str[0], 'UTF-8');
        return self::cut_string($str, $len, $more);
    }

    public static function isView($title) {
        //$view = true;
        /* switch($title){
          case 'Account':
          if(Yii::app()->user->id != '')
          $view = true;
          break;
          case 'Social Account':
          if(count(UserModule::getModuleAuth()->getHybridAuth()->getConnectedProviders()) > 0)
          $view = true;

          break;

          }
         */
        return true;
    }

    public static function word_limiter($str, $limit = 100, $end_char = '&#8230;') {
        if (trim($str) == '') {
            return $str;
        }
        preg_match('/^\s*+(?:\S++\s*+){1,' . (int) $limit . '}/', $str, $matches);
        $limit = rtrim($matches[0]);
        if (strlen($str) == strlen($matches[0])) {
            $end_char = '';
        } else {
            $limit = $limit . "<a class='show' href='javascript:#' style='color:#123efd;text-decoration:none;'>&nbsp;&nbsp;more" . $end_char . "</a><span  style='display:none;'>" . substr($str, strlen($limit)) . "</span><a class= 'less' href='javascript:#' style='color:#123efd;display:none;text-decoration:none;'>&nbsp;&nbsp;less</a>";
        }

        return $limit;
    }

}

