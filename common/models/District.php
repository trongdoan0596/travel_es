<?php
namespace common\models;//thu muc hien tai cua app : app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use common\helper\StringHelper;
use yii\helpers\Url;
/**
 * This is the model class for table "tbl_district".
 * @property integer $id
 * @property integer $region_id
 * @property string  $code
 * @property string  $title
 * @property integer $internal
 * @property string  $country_id
 * @property integer $ordering
 * @property integer $status
*/

class District extends ActiveRecord { 
    public static function tableName(){
        return 'en_district';
    }    
   public function getRegion(){
        return $this->hasOne(Region::className(),array('id' =>'region_id'));
    } 
	public function rules()	{		
         return array(
            // array('country_id,featured,status,ordering','integerOnly'=>true),
            // array('title', 'length', 'max'=>255),
            // array('img', 'file', 'extensions' =>array('png', 'jpg', 'gif'),'maxSize' =>2*1024),
            // array( array('title'), 'required'),
            // array( array('country_id'), 'required','message' => 'Please choose a Country name.'),
             array(
                  array('id','region_id','code','title','internal','country_id','ordering','status'),
                  'safe'
             ),
            array(array('id','region_id','title','status'),'safe', 'on' => 'search'),
           
        );     
	}
	public function attributeLabels(){
        	return array(
                    'id' => 'ID',
                    'region_id'=> 'Region name',
        			'title' => 'Title',	
                    'code'=>'Code'	,
                    'internal'=>'Internal',
                    'country_id'=>'Country_id',  
                    'ordering' => 'Ordering',  
                    'status'=>'Status'      
        		);
	}
	public function search($params){
        	$query =  District::find()->with('region');
            $dataProvider = new ActiveDataProvider(array(
                'query' => $query,
                'pagination'=>array(
                   'pageSize'=>30,
                 ),
            ));
            $dataProvider->setSort(array(
                    'defaultOrder' =>array('id'=>SORT_DESC),
                    'attributes' => array('id','title','region_id')
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
            if($this->region_id >0){
               $query->andWhere('region_id = "'.$this->region_id.'"');
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
  
//tra ve danh sach city theo country_id
 public static function getDistrict($region_id=0){
        if($region_id>0){
            $result = District::find()
                    ->where('region_id =:region_id ',array(':region_id' =>$region_id))
                    ->orderBy('title asc')
                    ->all();
        }else{
            $result = District::find()                   
                    ->orderBy('title asc')
                    ->all();
        }
        
        return $result;
	} 

  //dung trong backend
  public static function getImg($width = 0, $height = 0) {    
        $retUrl = '../../media/no_img.png';
        if($this->img){
          $retUrl = '../../media/sistrict/'. $this->img;
        }
        return $retUrl;
    } 
//Front End
  public static function getDistrictName($id=0){
     $result = District::find()->where('id =:id',array(':id' =>$id))->multilingual()->one();
    return $result;
  }
   public static function getDetailDistrict($id){
           $model = District::findOne($id);  
      return $model;     
   } 
  public static function createUrl($data=array(),$params = array()){		
        if(is_array($data)){
           $params['id']    = $data['id'];
           $params['title'] = StringHelper::formatUrlKey($data['title']);
        }else{
           $params['id']    = $data->id;
           $params['title']  = StringHelper::formatUrlKey($data->title);           
        }
		return Url::toRoute(array('hotel/indexdk','id'=>$params['id'],'title'=>'khach-san-tai-'.$params['title']));       
	}
  //nha nghi
    public static function createUrlDHostel($data=array(),$params = array()){		
        if(is_array($data)){
           $params['id']    = $data['id'];
           $params['title'] = StringHelper::formatUrlKey($data['title']);
        }else{
           $params['id']    = $data->id;
           $params['title']  = StringHelper::formatUrlKey($data->title);           
        }
		return Url::toRoute(array('hotel/indexdn','id'=>$params['id'],'title'=>'nha-nghi-tai-'.$params['title']));       
	} 
      //homstay
    public function createUrlDHomstay($data=array(),$params = array()){		
        if(is_array($data)){
           $params['id']    = $data['id'];
           $params['title'] = StringHelper::formatUrlKey($data['title']);
        }else{
           $params['id']    = $data->id;
           $params['title']  = StringHelper::formatUrlKey($data->title);           
        }
		return Url::toRoute(array('hotel/indexdh','id'=>$params['id'],'title'=>'homestay-tai-'.$params['title']));       
	} 
    //Resort
    public function createUrlDResort($data=array(),$params = array()){		
        if(is_array($data)){
           $params['id']    = $data['id'];
           $params['title'] = StringHelper::formatUrlKey($data['title']);
        }else{
           $params['id']    = $data->id;
           $params['title']  = StringHelper::formatUrlKey($data->title);           
        }
		return Url::toRoute(array('hotel/indexdr','id'=>$params['id'],'title'=>'resort-tai-'.$params['title']));       
	} 
    //nha hang
     public function createUrlRes($data=array(),$params = array()){		
        if(is_array($data)){
           $params['id']    = $data['id'];
           $params['title'] = StringHelper::formatUrlKey($data['title']);
        }else{
           $params['id']    = $data->id;
           $params['title']  = StringHelper::formatUrlKey($data->title);           
        }
		return Url::toRoute(array('restaurant/indexrd','id'=>$params['id'],'title'=>'nha-hang-tai-'.$params['title']));       
	}    
     //quan nhau
     public function createUrlResp($data=array(),$params = array()){		
        if(is_array($data)){
           $params['id']    = $data['id'];
           $params['title'] = StringHelper::formatUrlKey($data['title']);
        }else{
           $params['id']    = $data->id;
           $params['title']  = StringHelper::formatUrlKey($data->title);           
        }
		return Url::toRoute(array('restaurant/indexpd','id'=>$params['id'],'title'=>'quan-nhau-tai-'.$params['title']));       
	}      
     //quan an nhanh
     public function createUrlRess($data=array(),$params = array()){		
        if(is_array($data)){
           $params['id']    = $data['id'];
           $params['title'] = StringHelper::formatUrlKey($data['title']);
        }else{
           $params['id']    = $data->id;
           $params['title']  = StringHelper::formatUrlKey($data->title);           
        }
		return Url::toRoute(array('restaurant/indexsd','id'=>$params['id'],'title'=>'quan-an-nhanh-tai-'.$params['title']));       
	}    
     //quan via he  
     public function createUrlResw($data=array(),$params = array()){		
        if(is_array($data)){
           $params['id']    = $data['id'];
           $params['title'] = StringHelper::formatUrlKey($data['title']);
        }else{
           $params['id']    = $data->id;
           $params['title']  = StringHelper::formatUrlKey($data->title);           
        }
		return Url::toRoute(array('restaurant/indexwd','id'=>$params['id'],'title'=>'quan-via-he-tai-'.$params['title']));       
	}  
    //quan an khuya
    public function createUrlResl($data=array(),$params = array()){		
        if(is_array($data)){
           $params['id']    = $data['id'];
           $params['title'] = StringHelper::formatUrlKey($data['title']);
        }else{
           $params['id']    = $data->id;
           $params['title']  = StringHelper::formatUrlKey($data->title);           
        }
		return Url::toRoute(array('restaurant/indexld','id'=>$params['id'],'title'=>'quan-an-khuya-tai-'.$params['title']));       
	} 
    //karaoke
     public function createUrlKara($data=array(),$params = array()){		
        if(is_array($data)){
           $params['id']    = $data['id'];
           $params['title'] = StringHelper::formatUrlKey($data['title']);
        }else{
           $params['id']    = $data->id;
           $params['title']  = StringHelper::formatUrlKey($data->title);           
        }
		return Url::toRoute(array('karaoke/indexkad','id'=>$params['id'],'title'=>'karaoke-tai-'.$params['title']));       
	}  
    //bar-club
    public function createUrlBarClub($data=array(),$params = array()){		
        if(is_array($data)){
           $params['id']    = $data['id'];
           $params['title'] = StringHelper::formatUrlKey($data['title']);
        }else{
           $params['id']    = $data->id;
           $params['title']  = StringHelper::formatUrlKey($data->title);           
        }
		return Url::toRoute(array('karaoke/indexkbd','id'=>$params['id'],'title'=>'bar-club-tai-'.$params['title']));       
	}  
}