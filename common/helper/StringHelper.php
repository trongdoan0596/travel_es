<?php
namespace common\helper; 
use Yii;
use yii\base\Component;
class StringHelper {
    public static $_helper;
    public static function helper($isNew = false) {
        if (!is_null(self::$_helper) && !$isNew)
            return self::$_helper;
        else {
            $className = __CLASS__;
            $helper = self::$_helper = new $className();
            return $helper;
        }
    }
 public static function FormatDate($date) {  
         $result = Yii::$app->formatter->asDate($date,Yii::$app->formatter->dateFormat);//date("d/m/Y",strtotime($date));
         return $result;
    }
 public static function ShowDateInputMN($date) {  
         $result = date("d/m/Y",strtotime($date));
         return $result;
    } 
 //convert date YYYY-mm-dd sang dd/mm/YYYY  
 public static function ShowDateDMY($date,$dh=0) {  
         $result = '';
         if($dh==1){
            $result = date("d/m/Y H:i:s",strtotime($date));
         }else{
            $result = date("d/m/Y",strtotime($date));
         }
         return $result;
 }       
 //convert date dd/mm/YYYY sang YYYY-mm-dd   
public static function ConvertDate($date) { 
     $arr = explode("/",$date);
     $result = $arr[2].'-'.$arr[1].'-'.$arr[0];
     return $result;
} 
//formart price  
 public static function FormatPrice($price,$unit=0,$decimals=0){	 		
       if($unit==1){
           $result = Yii::$app->formatter->asDecimal($price,$decimals).' '.Yii::$app->formatter->currencyCode;
       }else{
           $result = Yii::$app->formatter->asDecimal($price,$decimals);
       }
		
        return $result;
  }    
 public static function formatUrlKey($str) {
        $str = self::stripUnicode($str);
        $urlKey = preg_replace('#[^0-9a-z]+#i', '-', $str);
        $urlKey = strtolower($urlKey);
        $urlKey = trim($urlKey, '-');

        return $urlKey;
    }

    public static function stripUnicode($str) {
        if (!$str)
            return false;
        $marTViet = array("à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă",
            "ằ", "ắ", "ặ", "ẳ", "ẵ", "è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề"
            , "ế", "ệ", "ể", "ễ",
            "ì", "í", "ị", "ỉ", "ĩ",
            "ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ"
            , "ờ", "ớ", "ợ", "ở", "ỡ",
            "ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ",
            "ỳ", "ý", "ỵ", "ỷ", "ỹ",
            "đ","î" ,"ü","û","ë","ï",
            "À", "Á", "Ạ", "Ả", "Ã", "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ", "Ă"
            , "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ",
            "È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ",
            "Ì", "Í", "Ị", "Ỉ", "Ĩ",
            "Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ", "Ổ", "Ỗ", "Ơ"
            , "Ờ", "Ớ", "Ợ", "Ở", "Ỡ",
            "Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ", "Ự", "Ử", "Ữ",
            "Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ",
            "Đ","Î" ,"Ü","Û","Ë","Ï");

        $marKoDau = array("a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a"
            , "a", "a", "a", "a", "a", "a",
            "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e",
            "i", "i", "i", "i", "i",
            "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o"
            , "o", "o", "o", "o", "o",
            "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u",
            "y", "y", "y", "y", "y",
            "d","i" ,"u","u","e","i",
            "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A"
            , "A", "A", "A", "A", "A",
            "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E",
            "I", "I", "I", "I", "I",
            "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O"
            , "O", "O", "O", "O", "O",
            "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U",
            "Y", "Y", "Y", "Y", "Y",
            "D","I" ,"U","U","E","I");

        $str = str_replace($marTViet, $marKoDau, $str);
        return $str;
    }
  public static function Subwords($str, $word_number, $strAppend = '...') {
        $c = str_word_count($str);
        $array1 = array($c);
        $new_str = '';
        if ($c >= $word_number) {
            $array1 = explode(" ", $str);
            $i = 0;
            while ($i < sizeof($array1)) {
                if ($i < $word_number) {
                    $new_str.=$array1[$i] . ' ';
                }
                $i++;
            }
            return trim($new_str) . $strAppend;
        } else {
            return $str;
        }
    }
    public static function ConvertMonth( $str ) {
            $men = array("January","February","March","April","May","June","July","August","September","October","November","December");
            $mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            $result = str_replace($men, $mes,$str);
            return $result;
     }
     public static function showDateMEs($date) {
        //2016-08-09 14:00:00 , chuyen doi sang tieng es theo thang        
        $m = date("M",strtotime($date));
        $result = date("M j, Y",strtotime($date));  
        switch ($m) {
                case "Jan":                  
                   $result = str_replace($m,'Ene',$result);
                    break;
                case "Feb":
                  // $result = str_replace($m,'Feb',$result);
                    break;
               case "Mar":
                   // $result = str_replace($m,'Mar',$result);
                    break;
               case "Apr":
                    $result = str_replace($m,'Abr',$result);
                    break;
               case "May":
                  // $result = str_replace($m,'May',$result);
                    break;
               case "Jun":
                  // $result = str_replace($m,'Jun',$result);
                    break;
               case "Jul":
                    //$result = str_replace($m,'Jul',$result);
                    break;
               case "Aug":
                    $result = str_replace($m,'Ago',$result);
                    break;
               case "Sep":
                    //$result = str_replace($m,'Sep',$result);
                    break;
               case "Oct":
                    //$result = str_replace($m,'Oct',$result);
                    break;
               case "Nov":
                    //$result = str_replace($m,'Nov',$result);
                    break;
               case "Dec":
                    $result = str_replace($m,'Dic',$result);
                    break;                                              
            }
            return $result;
        }    
    //chuyen doi thang tieng anh sang tieng phap
     public static function showMonthfr( $str ) {
          //  $en = array("January","February","March","April","May","June","July","August","September","October","November","December");                                     
          //  $fr = array("Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
            $result = $str;//str_replace($en, $fr, $str);
            return $result;
        }
     public static function showDateMfr( $date ) {
        //2016-08-09 14:00:00 , chuyen doi sang tieng phap theo thang        
        $m = date("M",strtotime($date));
        $result = date("M j, Y",strtotime($date));  
       /* switch ($m) {
                case "Jan":                  
                   $result = str_replace($m,'Jan',$result);
                    break;
                case "Feb":
                   $result = str_replace($m,'Feb',$result);
                    break;
               case "Mar":
                    $result = str_replace($m,'Mars',$result);
                    break;
               case "Apr":
                    $result = str_replace($m,'Avril',$result);
                    break;
               case "May":
                   $result = str_replace($m,'Mai',$result);
                    break;
               case "Jun":
                   $result = str_replace($m,'Juin',$result);
                    break;
               case "Jul":
                    $result = str_replace($m,'Jul',$result);
                    break;
               case "Aug":
                    $result = str_replace($m,'Août',$result);
                    break;
               case "Sep":
                    $result = str_replace($m,'Sept',$result);
                    break;
               case "Oct":
                    $result = str_replace($m,'Oct',$result);
                    break;
               case "Nov":
                    $result = str_replace($m,'Nov',$result);
                    break;
               case "Dec":
                    $result = str_replace($m,'Dec',$result);
                    break;                                              
            }*/
            return $result;
        }
     public static function showDateDfr( $date,$type=0 ) {
        //2016-08-09 14:00:00 , chuyen doi sang tieng phap theo thang
        $d   = date("D",strtotime($date));  
        $result = date("d/m D",strtotime($date));
        if($type==1){
            $result = date("D",strtotime($date));
        }
       /* switch ($d) {
                case "Mon":                   
                    $result = str_replace($d,'Mon',$result);
                    break;
                case "Tue":                     
                    $result = str_replace($d,'Tue',$result);
                    break;
               case "Wed":
                   $result = str_replace($d,'Wed',$result);
                    break;
               case "Thu":
                   $result = str_replace($d,'Thu',$result);
                    break;
               case "Fri":
                    $result = str_replace($d,'Fri',$result);
                    break;
               case "Sat":
                    $result = str_replace($d,'Sat',$result);
                    break;
               case "Sun":
                    $result = str_replace($d,'Sun',$result);
                    break;                                                         
            }*/
            return $result;
        } 
    public static function showDateDfrfix( $date,$type=0 ) {
        //2016-08-09 14:00:00 , chuyen doi sang tieng phap theo thang
        $d   = date("D",strtotime($date));  
        $result[0] = $dm = date("d/m",strtotime($date));  
        $result[1] = $d;
       /* switch ($d) {
                case "Mon":                   
                    $result[1] = 'Mon';
                    break;
                case "Tue":                     
                    $result[1] = 'Tue';
                    break;
               case "Wed":
                   $result[1] = 'Wed';
                    break;
               case "Thu":
                   $result[1] = 'Thu';
                    break;
               case "Fri":
                    $result[1] = 'Fri';
                    break;
               case "Sat":
                    $result[1] = 'Sat';
                    break;
               case "Sun":
                    $result[1] = 'Sun';
                    break;                                                        
            }    */        
            return $result;
        }           
   /*ham tao 1 chuoi ngau nhien */	
    public static function Rand_string( $length ) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$size = strlen( $chars );
		$str ='';
		for( $i = 0; $i < $length; $i++ ) {
			 $str .= $chars[ rand( 0, $size - 1 ) ];
		}
		return $str;
   }  
/*
//22 years ago 
  public static function ShowTime($date){	 		
		$ts   = time() - $date;//strtotime($date);       
        if($ts>31536000)     $val = round($ts/31536000,0).' năm';
        else if($ts>2419200) $val = round($ts/2419200,0).' tháng';
        else if($ts>604800)  $val = round($ts/604800,0).' tuần';
        else if($ts>86400)   $val = round($ts/86400,0).' ngày';
        else if($ts>3600)    $val = round($ts/3600,0).' giờ';
        else if($ts>60)      $val = round($ts/60,0).' phút';
        else $val = $ts.' giây';  
        //echo time().'---'.$date.'<br />';
        //echo $ts;die();    
        //if($val>1) $val .= 's';		
        return $val; 		
		
	}  
   public static function FormatDate($date) {  
            $date   = strtotime($date);
            $result = date("d",$date).' tháng '.date("m",$date).' năm '.date("Y",$date);
         return $result;
    }
   

  

    function catchu($value, $length) {
        if ($value != '') {
            if (is_array($value))
                list($string, $match_to) = $value;
            else {
                $string = $value;
                $match_to = $value{0};
            }

            $match_start = stristr($string, $match_to);
            $match_compute = strlen($string) - strlen($match_start);

            if (strlen($string) > $length) {
                if ($match_compute < ($length - strlen($match_to))) {
                    $pre_string = substr($string, 0, $length);
                    $pos_end = strrpos($pre_string, " ");
                    if ($pos_end === false)
                        $string = $pre_string . "...";
                    else
                        $string = substr($pre_string, 0, $pos_end) . "...";
                }
                else if ($match_compute > (strlen($string) - ($length - strlen($match_to)))) {
                    $pre_string = substr($string, (strlen($string) - ($length - strlen($match_to))));
                    $pos_start = strpos($pre_string, " ");
                    $string = "..." . substr($pre_string, $pos_start);
                    if ($pos_start === false)
                        $string = "..." . $pre_string;
                    else
                        $string = "..." . substr($pre_string, $pos_start);
                }
                else {
                    $pre_string = substr($string, ($match_compute - round(($length / 3))), $length);
                    $pos_start = strpos($pre_string, " ");
                    $pos_end = strrpos($pre_string, " ");
                    $string = "..." . substr($pre_string, $pos_start, $pos_end) . "...";
                    if ($pos_start === false && $pos_end === false)
                        $string = "..." . $pre_string . "...";
                    else
                        $string = "..." . substr($pre_string, $pos_start, $pos_end) . "...";
                }

                $match_start = stristr($string, $match_to);
                $match_compute = strlen($string) - strlen($match_start);
            }

            return $string;
        }else {
            return $string = '';
        }
    }
*/
}

?>
