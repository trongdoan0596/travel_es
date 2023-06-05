<?php
namespace common\models;//thu muc hien tai cua app : app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
//use omgdef\multilingual\MultilingualBehavior;
//use omgdef\multilingual\MultilingualQuery;
use yii\helpers\Url;

/**
 * This is the model class for table "cb_country".
 * @property integer $id
 * @property integer $region_id
 * @property integer $country_id 
 * @property string  $title
 * @property string  $alias
 * @property string  $img
 * @property string  $introtxt
 * @property string  $to_do
 * @property string  $to_eat
 * @property string  $photo
 * @property string  $festivals
 * @property string  $map
 * @property string  $video 
 * @property string  $metakey
 * @property string  $metadesc
 * @property integer $featured
 * @property integer $status
 * @property integer $ordering
 * @property string  $last_update
 * @property string  $create_date
 * @property string  $possitionsname  //ten dia danh danh theo ten ko dau : dongvn,bacha,sapa
*/

class Destination extends ActiveRecord { 
    public static function tableName(){
        return 'en_destination';
    }   
	public function rules()	{		
         return array(
            // array('city_id,featured,status,ordering','integerOnly'=>true),
            // array('title', 'length', 'max'=>255),
             //array('img', 'file', 'extensions' =>array('png', 'jpg', 'gif'),'maxSize' =>2*1024*1024),
            // array( array('title'), 'required'),
             //array( array('country_id'), 'required','message' => 'Please choose a Country name.'),
            array('possitionsname', 'filter', 'filter' => 'trim'), 
            array('possitionsname', 'unique','targetClass' => '\common\models\Destination', 'message' => 'Possitions name already exists'),
           // array('phone', 'string', 'min' =>10, 'max' => 255),
           
             array(
                  array('id','country_id','region_id','title','alias','introtxt','to_do','to_eat',
                        'photo','festivals','map','video','metakey','metadesc','featured','status',
                        'ordering','last_update','create_date','img','possitionsname'
                       ),
                  'safe'
             ),
             array(array('id','title','status'),'safe', 'on' => 'search'),
        );     
	}
	public function attributeLabels(){
        $labels = array(
                    'id' => 'ID',
                    'region_id'=> 'Region name',
                    'country_id'=>'Country name',
        			'title' => 'Title',	
                    'alias'=>'Alias',
                    'img'=>'Image',            
                    'introtxt' => 'Intro text',
                    'todo'=> 'Quoi faire ?',
                    'to_eat'=> 'Où manger ?',
                    'photo'=> 'Photos',
                    'festivals'=> 'Festivals',
                    'map'=> 'Carte',
                    'video'=> 'Vidéo',
        			'metakey' => 'Metakey',	
                    'metadesc'=>'Metadesc'	,
                    'featured'=>'Featured',
                    'status'=>'Status',          
                    'ordering' => 'Ordering',
                    'last_update'=> 'Last update',
        			'create_date' => 'Create date',
                    'possitionsname '=>'Possitions name '            
        		);
		return $labels;
	}   
	public function search($params){
        	$query =  Destination::find();
            $dataProvider = new ActiveDataProvider(array(
                'query' => $query,
                'pagination'=>array(
                   'pageSize'=>30,
                 ),
            ));
            $dataProvider->setSort(array(
                'defaultOrder' =>array('id'=>SORT_DESC),
                'attributes' => array('id','title','status')
            ));
            if (!($this->load($params) && $this->validate())) {
                return $dataProvider;
            }
           if($this->id>0){
               $query->andWhere('id = "'.$this->id.'"');
           }   
           if($this->title!=''){
               $query->andWhere('title LIKE "%'.$this->title.'%"');
           }
           if($this->status!=''){
               $query->andWhere('status = "'.$this->status.'"');
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
  //dung trong backend
   public static function getImg($width = 0, $height = 0) {    
        $retUrl = '../../media/no_img.png';
        if($this->img){
          $retUrl = '../../media/seedo/'. $this->img;
        }
        return $retUrl;
    } 
    public static function getAllDestination(){
        $result = Destination::find()
                    ->where('status =:status',array(':status' =>1))
                    //->orderBy('country_id desc , title asc')
                    ->orderBy('ordering asc')               
                    ->all();  
        return $result;
	} 
    public static function GetInfoDestination($id){  
         $result = Destination::find()
                    ->where('id =:id',array(':id' =>$id))
                    ->with('city')
                    ->one();  
         return $result;
	}
/*************Front End**********************/
//tra ve duong dan cua anh
 public static function getImage($row,$width = 0, $height = 0) {    
        $retUrl = Url::base().'/media/no_img.png';
        if($row->img){
          $retUrl = Url::base().'/media/seedo/'.$row->img;
        }
        return $retUrl;
    } 
    
}