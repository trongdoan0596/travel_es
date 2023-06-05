<?php
namespace common\models;//thu muc hien tai cua app : app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
use omgdef\multilingual\MultilingualBehavior;
use omgdef\multilingual\MultilingualQuery;
use yii\helpers\Url;
use common\helper\StringHelper;
/**
 * This is the model class for table "fr_cotravel".
 * @property integer $id
 * @property string  $title
 * @property string  $alias
 * @property string  $introtxt
 * @property string  $fulltxt
 * @property string  $img
 * @property string  $start_date
 * @property string  $numday_min
 * @property string  $numday_max
 * @property integer $user_id
 * @property integer $user_modify
 * @property integer $hit  
 * @property integer $status
 * @property string  $featured 
 * @property string  $metakey
 * @property string  $metadesc
 * @property integer $ordering
 * @property string  $last_update
 * @property string  $create_date
 */ 
class Cotravel extends ActiveRecord { 
    public static function tableName(){
        /*$language = Yii::$app->request->get('language','');
         if(empty($language)){
             $language = Yii::$app->request->cookies->getValue('language');
         }
         if($language=='en'){
              return 'au_cotravel';
           }else{
             return 'fr_cotravel';            
         } */   
          return 'en_cotravel';   
    }
	public function rules()	{		
         return array(
             array(
                  array('id','title','alias','introtxt','fulltxt','img','start_date','numday_min',
                          'numday_max','user_id','user_modify','hit','status','featured',
                          'metakey','metadesc','ordering','last_update','create_date'                         
                       ),
                  'safe'
             ),
             array(array('id','title','status'),'safe', 'on' => 'search'),
        );     
	}
	public function attributeLabels(){
          /* $langbackend  = Yii::$app->request->cookies->getValue('langbackend');
           if($langbackend=='fr'){}else{} */
          $labels = array(
                        'id' => 'ID', 
                        'title' => 'Title',
                        'alias' => 'Alias',  
                        'img' => 'Image',
                        'introtxt' => 'Intro text',
                        'fulltxt'=>'Full text',
                        'start_date'=>'Start date',
                        'numday_min'=>'Number day from',                        
                        'numday_max'=>'Number day to',
                        'user_id' => 'User ID',
                        'metakey' => 'Metakey',
                        'metadesc' => 'Metadesc',
                        'featured' => 'Featured',  
                        'status' => 'Status',    
                        'start'=>'Start',
                        'ordering' => 'Ordering',  
                        'create_date' => 'Create date',      
                        'last_update' => 'Last update' 
            		);
		return $labels;
	}
	public function search($params){
        	$query =  Cotravel::find();
            $dataProvider = new ActiveDataProvider(array(
                'query' => $query,
                'pagination'=>array(
                   'pageSize'=>20,
                 ),
            ));
            $dataProvider->setSort(array(
                'defaultOrder' =>array('id'=>SORT_DESC),
                'attributes' => array('id','title','status')
            ));
            if(!($this->load($params) && $this->validate())) {
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
            $arrStatus = self::getAllStatus();
            return isset($arrStatus[$status]) ? $arrStatus[$status] : ' ';
        } else {
            return 'Ẩn';
        }
    }
 //dung trong backend
 public function getImg($width = 0, $height = 0) {    
        $retUrl = '../../media/no_img.png';
        if($this->img){
          $retUrl = '../../media/tour/'. $this->img;
        }
        return $retUrl;
    }  
//Front End      
  public function createUrl($data=array(),$params = array()){		
        if(is_array($data)){
           $params['tid']    = $data['id'];
           $params['title'] = StringHelper::formatUrlKey($data['title']);
        }else{
           $params['tid']    = $data->id;
           $params['title']  = StringHelper::formatUrlKey($data->title);           
        } 
        $language = Yii::$app->request->get('language','');
        if(empty($language)){
           $language = Yii::$app->request->cookies->getValue('language');
        }
        $params['language'] = $language;
		return Url::toRoute(array('tour/view','tid'=>$params['tid'],'title'=>$params['title'],'language'=>$params['language']));       
	} 
   public static function getDetailCotravel($id){
      $model = Cotravel::findOne($id);  
      return $model;     
   }   
   //tra ve duong dan cua anh
   public function getImage($row,$width = 0, $height = 0) {    
        $retUrl = Url::base().'/media/no_img.png';
        if($row->img){
          $retUrl = Url::base().'/media/cotravel/'.$row->img;
        }
        return $retUrl;
    }
/********End Class************/
}