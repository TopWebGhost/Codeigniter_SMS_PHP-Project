<?php
class is_valid {
    private static function between($value, $max=null, $min=0){
        if(is_numeric($min) && $value <= $min) return false;
        if(is_numeric($max) && $value >= $max) return false;
        return true;
    }


    public static function Number($value, $max=null, $min=0){
        if(preg_match("/^\-?\+?[0-9e1-9]+$/",$value)){
            if(!self::between($value, $max, $min)) return false;
            return true;
        }
        else {
        return false;
        }
    }

    public static function Email($email){
        return (bool)preg_match("/^([a-z0-9])(([-a-z0-9._])*([a-z0-9]))*\@([a-z0-9])(([a-z0-9-])*([a-z0-9]))+(\.([a-z0-9])([-a-z0-9_-])?([a-z0-9])+)+$/i", $email);
    }
	public static function Date($date){
		$date_format = 'Y-m-d';
		$time = strtotime($date);
       
		if (date($date_format, $time) == $date) {
    return true;
}
return false;
    }

}

?>