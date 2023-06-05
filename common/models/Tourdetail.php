<?php
namespace common\models;//thu muc hien tai cua app : app\models;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
use yii\helpers\Url;
//use omgdef\multilingual\MultilingualBehavior;
//use omgdef\multilingual\MultilingualQuery;
/**
 * This is the model class for table "au_tourdetail".
 * @property integer $id
 * @property integer $tour_id
 * @property integer $day_id
 * @property string  $title
 * @property string  $fulltxt
 * @property string  $status
 * @property string  $img
 * @property string  $last_update
 * @property string  $create_date
 * @property integer $user_id
 * @property integer $user_modify
*/
class Tourdetail extends \yii\db\ActiveRecord { 
	public static function tableName(){   
          return 'au_tourdetail';
    }
     public static function collectionName() {
        return 'days';
    }
    public function getDays(){
        // 1 - nhieu
        //$this->hasMany(Comment::className(), ['customer_id' => 'id']);
        //1 - 1
        return $this->hasOne(Days::className(),array('id' =>'day_id'));
    }
   public function rules()	{		
         return array(
            // array('country_id,featured,status,ordering','integerOnly'=>true),
            // array('title', 'length', 'max'=>255),
            // array('img', 'file', 'extensions' =>array('png', 'jpg', 'gif'),'maxSize' =>2*1024),
             array( array('title'), 'required'),
             array(
                  array('id','tour_id','day_id','title','fulltxt','status','img','last_update','create_date',
                        'user_id','user_modify'
                  ),
                  'safe'
             ),
             array('id,tour_id,day_id,title,','safe', 'on' => 'search'),
        );     
	}
    public static function search($params){
        	$query =  Tourdetail::find();
            $dataProvider = new ActiveDataProvider(array(
                'query' => $query,
                'pagination'=>array(
                   'pageSize'=>20,
                 ),
            ));
            if (!($this->load($params) && $this->validate())) {
                return $dataProvider;
            }

          return $dataProvider;
	}
    public static function getAllStatus() {
        return array(0 => 'Ẩn', 1 => 'Hiện');
    }
    public static function getStatus($status) {
        if ($status) {
            $arrStatus = self::getAllStatus();
            return isset($arrStatus[$status]) ? $arrStatus[$status] : ' ';
        } else {
            return 'Ẩn';
        }
    }
    public static function chkTourdetail($tour_id,$day_id){
        $result = Tourdetail::find()
                    ->where('tour_id =:tour_id AND day_id=:day_id',array(':tour_id' =>$tour_id,':day_id' =>$day_id))
                    ->orderBy('title asc')
                    ->one();                    
        return $result;
	}
    //get info day theo tour_id vaf day_id
  public static function GetInfoTourdetail($tour_id,$day_id){
        $result = Tourdetail::chkTourdetail($tour_id,$day_id);             
        if(!empty($result)){
            $tourdetail_id = $result->id;
            $result        = Tourdetail::findOne($tourdetail_id);
        }
        return $result;
	} 
    //get tourdetail theo tour_id
    public static function GetTourdetail($tour_id){
        $result = Tourdetail::find()
                    ->where('tour_id =:tour_id',array(':tour_id' =>$tour_id))
                    ->orderBy('day_id asc')
                    ->with('days')
                    ->all();   
        return $result;
	} 
    //Deleter tour detail
    public static function DelTourdetail($tour_id,$day_id){
        $result = Tourdetail::chkTourdetail($tour_id,$day_id); 
        if(!empty($result)){
            $tourdetail_id = $result->id;
            $model = Tourdetail::findOne($tourdetail_id);
            $model->delete();
            return 1;
        }else{
            return 0;
        }
        
	}
//tra ve duong dan cua anh
  public static function getImage($row,$width = 0,$height = 0) {    
        $retUrl = Url::base().'/media/no_img.png';
        if($row->img){          
              if($width>0 && $height>0){
                $retUrl = Url::base().'/media/itemimgs/'.$width.'_'.$height.'/'.$row->img;
              }else{
                $retUrl = Url::base().'/media/itemimgs/'.$row->img;
              }      
        }
        return $retUrl;
  } 

/*******End class******************/ 
}