<?php
namespace common\models;//thu muc hien tai cua app : app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
use yii\helpers\Url;
use common\helper\StringHelper;
//use omgdef\multilingual\MultilingualBehavior;
//use omgdef\multilingual\MultilingualQuery;
/**
 * This is the model class for table "cb_country".
 * @property integer $id
 * @property integer $parent_id
 * @property integer $country_id
 * @property string  $title
 * @property string  $alias
 * @property string  $path 
 * @property string  $img
 * @property string  $introtxt
 * @property string  $fulltxt 
 * @property string  $metakey
 * @property string  $metadesc
 * @property string  $metatitle 
 * @property string  $featured
 * @property integer $status
 * @property integer $ordering
 * @property string  $create_date
 * @property string  $last_update
 * @property integer $user_id
 * @property integer $user_modify
*/
class Tourcate extends ActiveRecord { 
    public static function tableName(){
             return 'au_tourcate';  
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
                  array('id','parent_id','country_id','title','alias','path','introtxt','fulltxt','metakey','metadesc',
                        'featured','status','ordering','create_date','last_update','metatitle','user_id'
                        ,'user_modify'
                       ),
                  'safe'
             ),
             array(array('id','country_id','title','status'),'safe', 'on' => 'search'),
        );     
	}
	public function attributeLabels(){           
            return array(
                            'id' => 'ID',
                            'parent_id' => 'Parent ID',
                            'country_id'=> 'Country',
                            'title'     => 'Title',
                            'alias'     => 'Alias',
                            'img'       => 'Image',
                            'introtxt'  => 'Intro text',
                            'fulltxt'   => 'Full text',
                            'metakey'   => 'Metakey',
                            'metadesc'  => 'Metadesc',
                            'featured'  => 'Featured', 
                            'status'    => 'Status',      
                            'ordering'  => 'Ordering',      
                            'create_date' => 'Create date',      
                            'last_update' => 'Last update' 
                		);
        
	}
	public function search($params){	       
        	$query =  Tourcate::find()->where('id>1')->with('country');         
            $dataProvider = new ActiveDataProvider(array(
                'query' => $query,
                'pagination'=>array(
                   'pageSize'=>20,
                 ),
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
            if($this->parent_id !=''){
               $query->andWhere('parent_id = "'.$this->parent_id.'"');
            }
            if($this->status !=''){
               $query->andWhere('status = "'.$this->status.'"');
            }    
           // if($this->country_id !=''){
            //   $query->andWhere('country_id = "'.$this->country_id.'"');
          //  } 
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
 public static function getImg($row,$width = 0, $height = 0) {    
        $retUrl = '../../media/no_img.png';
        if($row->img){
          $retUrl = '../../media/tourcate/'. $row->img;
        }
        return $retUrl;
    }    
   public static function getAllParentsTree(&$arr=array(),$parent_id=0,$level=0){
        $sql =  self::find()->where(['status'=>1,'parent_id'=>$parent_id]); 
        $sql->orderBy('title asc');
        $model  = $sql->all();                  
        $prefix = ($parent_id==0)? '':'--';
        $prefix = str_repeat($prefix,$level);
        if($model){
            $level++;
            foreach($model as $item){
                $arr[$item->id] = $prefix . ' ' . $item->title;
                Tourcate::getAllParentsTree($arr,$item->id,$level);
            }
        }
        return $arr;
    }
    public static function getCateTourparent($parent_id=0){
          
        $result = Tourcate::find()
                    ->where('parent_id =:parent_id AND status = 1',array(':parent_id' =>$parent_id))
                    ->orderBy('title asc')
                    ->all();
        return $result;
	}
   public static function getPath(&$arr=array(),$parent_id=1){
        $model = self::findOne($parent_id);      
        if(!empty($model)){
            $id = $model->id;
            $parent_id = $model->parent_id;
            $arr[] = $id;  
            if($parent_id>=0){           
                 Tourcate::getPath($arr,$parent_id);
            }            
        }
        return $arr;
    } 
       //goi de quy tra ve tat ca sub id con trong parent_id 
   public static function getAllIds(&$arr=array(),$parent_id=1){          
        $sql = self::find()->where('parent_id =:parent_id and status = 1',array(':parent_id' =>$parent_id));
        $rows = $sql->all();  
        if(!empty($rows)){
             foreach($rows as $row){         
                 $id = $row->id;                
                 $arr[] = $id; 
                 Tourcate::getAllIds($arr,$id);                                  
            }                  
        }
        return $arr;
    }
    public static function getNameTourCate($id){
        $result="-No-";
        $model = self::findOne($id);
        if(!empty($model)){
            $result = $model->title;
        }
      return $result;   
  }
//Front End
   public static function getImage($row,$width = 0, $height = 0,$imgfield='img') {  
        $retUrl = '';
        $img    = $row->img;
        if($img){
              if($width>0 && $height>0){
                $retUrl = Url::base().'/media/tour/'.$width.'_'.$height.'/'.$img;
              }else{
                $retUrl = Url::base().'/media/tour/'.$img;
              }           
        }
        return $retUrl;
    }
   public static function getDetailTourCate($id){      
      $model = self::findOne($id); 
      return $model;   
  }
  public static function getDetailAlias($alias){
      $model = self::find()->where(['alias'=>$alias])->one();     
      return $model;     
   }
  public static function createUrl($data=array(),$params = array()){		
        if(is_array($data)){
           //$params['catid']    = $data['id'];           
           $params['title']    = StringHelper::formatUrlKey($data['alias']);          
        }else{
           //$params['catid']    = $data->id;         
           $params['title']  = StringHelper::formatUrlKey($data->alias);     
        } 
        return Url::toRoute(array('tour/index','title'=>$params['title']));
       	
	}   
}