<?php
namespace common\models;//app\models;
use Yii;
use yii\db\ActiveRecord;
//use yii\data\ActiveDataProvider;
//use common\helper\StringHelper;
use yii\helpers\Url;
/**
 * This is the model class for table "au_article".
 * @property integer $id
 * @property integer $rating_value
 * @property string  $rating_count
 * @property string  $bestrating
 * @property string  $worst_rating
 * @property integer $status
 * @property string  $last_update
 */
class Settings extends ActiveRecord {
   public static function tableName(){           
          return 'au_settings';     
    }
    public function attributes(){
        return ['id','rating_value','rating_count','bestrating','worst_rating','status','last_update'];
    }
    public function rules()	{
         return [
            [['id','rating_value','rating_count','bestrating','worst_rating','status','last_update'],'safe'],
            [['id','rating_value','rating_count'],'safe', 'on' => 'search'],
        ];
	} 
  public static function getAllStatus() {
        return [0=>'Ẩn',1=>'Hiện'];
    }
 public static function getStatus($n) {
        if ($n) {
            $arr = self::getAllStatus();
            return isset($arr[$n]) ? $arr[$n] : '-No-';
        } else {
            return '-No-';
        }
    } 
  public static function getDetail($id){
        return self::findOne($id);
  } 
  public static function UpdateRating($arr){
        $mode = self::findOne(1);
        if(!empty($mode)){
            $mode->rating_value = $arr['rating_value'];
            $mode->rating_count = $arr['rating_count'];
            $mode->last_update = date("Y-m-d H:i:s");
            $mode->update();
        }
        return true;
  }       
}
?>