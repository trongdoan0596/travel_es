<?php
namespace common\models;//thu muc hien tai cua app : app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use omgdef\multilingual\MultilingualBehavior;
use omgdef\multilingual\MultilingualQuery;
/**
 * This is the model class for table "au_tourhotel".
 * @property integer $id
 * @property integer $tour_id
 * @property integer $ext_id
 * @property integer $status
 * @property string  $featured
 * @property string  $ordering
 * @property string  $last_update
 * @property string  $create_date
 * @property integer $user_id
 * @property integer $user_modify
*/
class Tourextentions extends ActiveRecord {
    public static function tableName(){ 
         return 'au_tourextentions';  
    }
  public function rules()	{		
         return array(
             array(
                  array('id','tour_id','ext_id','status','featured','ordering','last_update','create_date',
                        'user_id','user_modify'
                       ),
                  'safe'
             ),
             array('id,tour_id,status','safe', 'on' => 'search'),
        );     
	}
   public function getTour(){
        return $this->hasOne(Tour::className(),array('id' =>'ext_id'));
    }  
  public static function getAllStatus() {
        return array(0 => 'Hide', 1 => 'Show');
    }
    public static function getStatus($status) {
        if ($status) {
            $arrStatus = self::getAllStatus();
            return isset($arrStatus[$status]) ? $arrStatus[$status] : ' ';
        } else {
            return 'Hide';
        }
    }

 //get tour extentions theo tour_id 
  public static function GetTourExt($tour_id){
        $result = Tourextentions::find()
                    ->where('tour_id =:tour_id ',array(':tour_id' =>$tour_id)) 
                    ->all(); 
        return $result;
	} 
   public static function chkTourextdetail($tour_id,$ext_id){
        $result = Tourextentions::find()
                    ->where('tour_id =:tour_id AND ext_id =:ext_id ',array(':tour_id' =>$tour_id,':ext_id' =>$ext_id))
                   // ->orderBy('title asc')
                    ->one();                    
        return $result;
	} 
    //get info day theo tour_id vaf day_id
   public static function GetInfoTourExt($ext_id){
        $result = Tourextentions::findOne($ext_id);            
        return $result;
	}     
/************Front End****************/
       
}