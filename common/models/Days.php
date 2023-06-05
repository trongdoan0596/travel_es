<?php
namespace common\models;//thu muc hien tai cua app : app\models;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
use omgdef\multilingual\MultilingualBehavior;
use omgdef\multilingual\MultilingualQuery;
/**
 * This is the model class for table "au_days".
 * @property integer $id
 * @property string  $title
 * @property integer $status
 * @property integer $ordering
*/
class Days extends \yii\db\ActiveRecord {
	
	public static function tableName(){
		return 'en_days';
	}   
    public function rules()	{		
         return array(           
             array(
                  array('id','title','status','ordering'),
                  'safe'
             ),
             array('id,title,','safe', 'on' => 'search'),
        );     
	}
    public static function getDays(){
	    $result = Days::find()->orderBy('id asc')->all();
        return $result;
	}
    public static function getDetailDay($id){
       $model = Days::findOne($id);  
      return $model;     
   } 
   public static function getTitleDay($id){
       $model = Days::findOne($id); 
       $result ='--No--';
       if(!empty($model)){
          $result = $model->title;
       } 
      return $result;     
   } 
}