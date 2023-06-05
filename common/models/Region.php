<?php
namespace common\models;//thu muc hien tai cua app : app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
use yii\helpers\Url;
/**
 * This is the model class for table "cb_city".
 * @property integer $id
 * @property integer $country_id
 * @property string  $title
 * @property string  $alias
 * @property integer $location
 * @property string  $img
 * @property string  $introtxt
 * @property string  $fulltxt
 * @property string  $metakey
 * @property string  $metadesc
 * @property integer $featured
 * @property integer $status
 * @property integer $is_tour
 * @property integer $is_filter
 * @property integer $ordering
 * @property string  $last_update
 * @property string  $create_date
*/
class Region extends ActiveRecord { 
    public static function tableName(){
        return 'en_region';
    }   
   public function getCountry(){
        return $this->hasOne(Country::className(),array('id' =>'country_id'));
    } 
	public function rules()	{		
         return array(
            // array('country_id,featured,status,ordering','integerOnly'=>true),
            // array('title', 'length', 'max'=>255),
            // array('img', 'file', 'extensions' =>array('png', 'jpg', 'gif'),'maxSize' =>2*1024),
            // array( array('title'), 'required'),
            // array( array('country_id'), 'required','message' => 'Please choose a Country name.'),
             array(
                  array('id','country_id','title','alias','location','introtxt','fulltxt','metakey',
                  'metadesc','featured','status','is_tour','is_filter','ordering','last_update','create_date'
                       ),
                  'safe'
             ),
            array(array('id','country_id','title','is_tour','status'),'safe', 'on' => 'search'),
           
        );     
	}
	public function attributeLabels(){
        	return array(
                    'id' => 'ID',
                    'country_id'=> 'Country name',
        			'title' => 'Title',	
                    'alias'=>'Alias'	,
                    'location'=>'location',
                    'img'=>'Image',            
                    'introtxt' =>'Intro text',
                    'fulltxt'=> 'Full text',
        			'metakey' => 'Metakey',	
                    'metadesc'=>'Metadesc'	,
                    'featured'=>'Featured',
                    'status'=>'Status',
                    'is_tour'=>'Is tour',
                    'is_filter'=>'Is filter',
                    'ordering' => 'Ordering',
                    'last_update'=> 'Last update',
        			'create_date' => 'Create date'            
        		);
	}
	public function search($params){
        	$query =  Region::find()->with('country');
            $dataProvider = new ActiveDataProvider(array(
                'query' => $query,
                'pagination'=>array(
                   'pageSize'=>20,
                 ),
            ));
            $dataProvider->setSort(array(
                    'attributes' => array('id','title','country_id','status','is_tour')
            ));
            if (!($this->load($params) && $this->validate())) {
                return $dataProvider;
            }
            if($this->title !=''){
               $query->andWhere('title LIKE "%'.$this->title.'%"');
            }     
            if($this->id>0){
               $query->andWhere('id = "'.$this->id.'"');
            }
            if($this->is_tour !=''){
               $query->andWhere('is_tour = "'.$this->is_tour.'"');
            }
            if($this->status !=''){
               $query->andWhere('status = "'.$this->status.'"');
            }    
            if($this->country_id !=''){
               $query->andWhere('country_id = "'.$this->country_id.'"');
            } 
            
          return $dataProvider;
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
     //Show tour
    public static function getAllShowtour() {
        return array(0 => 'No', 1 => 'Yes');
    }
    public static function getShowtour($is_tour) {
       if ($is_tour) {
            $arrIstour = self::getAllShowtour();
            return isset($arrIstour[$is_tour]) ? $arrIstour[$is_tour] : ' ';
        } else {
            return 'No';
        }       
    }  
    //tra ve danh sach city theo country_id
 public static function getRegion($country_id=0){
        if($country_id>0){
            $result = Region::find()
                    ->where('country_id =:country_id AND is_tour=1 AND status = 1',array(':country_id' =>$country_id))
                    ->orderBy('country_id desc,title asc')
                    ->all();
        }else{
            $result = Region::find()
                    ->where('is_tour=1 AND status = 1')
                    ->orderBy('country_id desc,title asc')
                    ->all();
        }
        
        return $result;
	} 
//tra ve danh sach city theo country_id , ko can is_tour=1
 public static function getAllRegion($country_id=0){
        if($country_id>0){
            $result = Region::find()
                    ->where('country_id =:country_id',array(':country_id' =>$country_id))
                    ->orderBy('country_id desc,title asc')
                    ->all();
        }else{
            $result = Region::find()
                    ->where('status = 1')
                    ->orderBy('country_id desc,title asc')
                    ->all();
        }
        
        return $result;
	} 
 public static function getAllFilter(){
         $result = Region::find()
                    ->where('status = 1 AND is_filter = 1')
                    ->orderBy('title asc')
                    ->all();        
        return $result;
 }     
  //dung trong backend
  public static function getImg($row,$width = 0, $height = 0) {    
         $retUrl = Url::base().'/media/no_img.png';
        if($row->img){
          $retUrl = Url::base().'/media/region/'. $row->img;
        }
        return $retUrl;
    }    
//Front End
 public static function getRegionName($id=0){
     //$result = Region::find()->where('id =:id',array(':id' =>$id))->multilingual()->one();
     $model = self::findOne($id);  
     if(!empty($model)){
        return $model->title;
     }else{
        return "No name";
     }
    
  }
}