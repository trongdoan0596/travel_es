<?php
namespace common\models;//app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use common\helper\StringHelper;
use yii\helpers\Url;
//use common\components\languageSwitcher;
/**
 * This is the model class for table "fr_video".
 * @property integer $id
 * @property string  $title
 * @property string  $alias
 * @property string  $url
 * @property string  $embedcode 
 * @property string  $introtxt
 * @property string  $fulltxt
 * @property string  $img
 * @property integer $status
 * @property integer $ordering
 * @property string  $metakey
 * @property string  $metadesc
 * @property integer $featured
 * @property string  $last_update
 * @property string  $create_date
 * @property integer $user_id
 * @property integer $user_modify 
 */
class Video extends ActiveRecord { 
    
   public static function tableName(){           
          return 'au_video';     
    }    
  public function rules()	{		
         return array(
            // array('country_id,featured,status,ordering','integerOnly'=>true),
            // array('title', 'length', 'max'=>255),
            // array('img', 'file', 'extensions' =>array('png', 'jpg', 'gif'),'maxSize' =>2*1024),
            //array( array('title'), 'required'),
            // array( array('country_id'), 'required','message' => 'Please choose a Country name.'),
             array(
                  array('id','title','alias','url','embedcode','introtxt','fulltxt','ordering',
                         'img','status','metakey','metadesc','featured','last_update','create_date',
                         'user_id','user_modify'
                       ),
                  'safe'
             ),
             array(array('id','featured','title'),'safe', 'on' => 'search'),
        );     
	}    
    public function attributeLabels() {
       return array(
			'id' => 'ID',		
			'title' => 'Title',
			'alias' => 'Alias',
            'url' => 'Url Video',
			'embedcode' => 'Embed code(w:350,h:230)',
			'introtxt' => 'Intro Text',
			'fulltxt' => 'Full Text( insert image 760x340, no set height and width)',
			'img' => 'Image(750x420)',
			'status' => 'Status',
			'metakey' => 'Meta Key',
			'metadesc' => 'Meta Desc(max :160 char)',		
            'ordering'=>'Ordering',
            'featured' => 'Featured',
            'last_update'=>'Last update',
            'create_date'=>'Create date'
		);
    }
public function search($params) {
        $query =  Video::find();
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
       if($this->title !=''){
               $query->andWhere('title LIKE "%'.$this->title.'%"');
         } 
        if($this->id>0){
               $query->andWhere('id = "'.$this->id.'"');
        }       
        if($this->status !=''){
               $query->andWhere('status = "'.$this->status.'"');
        }  
    return $dataProvider;
 }

  public static function getAllStatus() {
        return array(0 => 'Ẩn', 1 => 'Hiện');
    }
 public static function getStatus($status) {
        if ($status) {
            $arr = self::getAllStatus();
            return isset($arr[$status]) ? $arr[$status] : 'Ẩn';
        } else {
            return 'Ẩn';
        }
    }
 //dung trong backend
 public static function getImg($row,$width = 0, $height = 0) {  
        $retUrl = Url::base().'/media/no_img.png';
        //$retUrl = '../../media/no_img.png';
        if($row->img !=''){
          $retUrl = Url::base().'/media/video/'.$row->img;
        }
        return str_replace("backend/", "",$retUrl);
    }
 public static function getListVideo($limit=5,$orderby='title asc',$fields=''){	        
        $sql = Video::find();
        if($fields!=''){$sql->select($fields);}        
        $sql->where('status =:status',array(':status' => 1));        
        if($limit>0) $sql->limit($limit);
        $sql->orderBy($orderby);
        $result= $sql->all();
        return $result;
}  
  public static function getDetailVideo($id){
        $model = Video::findOne($id); 
        return $model;     
  }
  public static function createUrl($data=array(),$params = array()){
        if(is_array($data)){
           $params['id']    = $data['id']; 
           if(trim($data['alias'])!=''){
                $params['title']  = StringHelper::formatUrlKey($data['title']); 
           }else{
                $params['title'] = StringHelper::formatUrlKey($data['title']);
           }
        }else{
           $params['id']    = $data->id;
           if(trim($data->alias)!=''){
                $params['title']  = StringHelper::formatUrlKey($data->alias); 
           }else{
                $params['title']  = StringHelper::formatUrlKey($data->title);
           }                     
        }        
		return Url::toRoute(array('video/view','id'=>$params['id'],'title'=>$params['title']));       
	}
   //tra ve duong dan cua anh
  public static function getImage($row,$width = 0, $height = 0) {    
        $retUrl = Url::base().'/media/no_img.png';
        if($row->img){
              if($width>0 && $height>0){
                $retUrl = Url::base().'/media/video/'.$width.'_'.$height.'/'.$row->img;
              }else{
                $retUrl = Url::base().'/media/video/'.$row->img;
              } 
        }
        return $retUrl;
  }      
}
?>