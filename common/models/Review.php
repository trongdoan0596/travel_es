<?php
namespace common\models;//thu muc hien tai cua app : app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
use common\helper\StringHelper;
use yii\helpers\Url;
/**
 * This is the model class for table "fr_review".
 * @property integer $id
 * @property integer $user_id
 * @property string  $title
 * @property string  $alias
 * @property string  $img_default 
 * @property string  $introtxt
 * @property string  $fulltxt
 * @property string  $hit
 * @property string  $like_count
 * @property string  $comment_count
 * @property string  $vote
 * @property integer $featured
 * @property integer $status
 * @property integer $ordering
 * @property string  $metakey
 * @property string  $metadesc
 * @property string  $last_update
 * @property string  $create_date
 * @property integer $user_modify
 * @property integer $user_create
*/
class Review extends ActiveRecord { 
    public $img;
    public static function tableName(){
        return 'au_review';
    }   
	public function rules()	{		
         return array(
            // array('city_id,featured,status,ordering','integerOnly'=>true),
            // array('title', 'length', 'max'=>255),
            //array('img', 'file', 'extensions' =>array('png', 'jpg', 'gif'),'maxSize' =>2*1024*1024),
            //array( array('title'), 'required'),
             //array( array('country_id'), 'required','message' => 'Please choose a Country name.'),
             array(
                  array('id','user_id','title','alias','introtxt','fulltxt','img_default',
                        'hit','like_count','comment_count','vote','metakey','metadesc','featured','status',
                        'ordering','last_update','create_date','user_create','user_modify'
                       ),
                  'safe'
             ),
             array(array('id','title','status'),'safe', 'on' => 'search'),
        );     
	}
    public function getAccount(){
        return $this->hasOne(Account::className(),array('id' =>'user_id'));
    }
	public function attributeLabels(){
        $labels = array(
                    'id' => 'ID',  
                    'user_id' => 'User ID',	                
        			'title' => 'Title',	
                    'alias'=>'Alias',
                    'img_default'=>'Image default', 
                    'img'=>'Image ( max 5 , 850x650 )', 
                    'introtxt' => 'Intro text',
                    'fulltxt' => 'Fulltxt text',                    
                    'hit'=> 'Hit',
                    'like_count'=> 'Like count',
                    'comment_count'=> 'Comment count',  
                    'vote'=>'Vote',                  
        			'metakey' => 'Metakey',	
                    'metadesc' => 'Meta Desc(max :160 char)',
                    'featured'=>'Featured',
                    'status'=>'Status',       
                    'ordering' => 'Ordering',
                    'last_update'=> 'Last update',
        			'create_date' => 'Create date',
                    'lang'=>'Language',
                    'user_create' => 'User create',
                    'user_modify' => 'User modify'            
        		);
		return $labels;
	}   
	public function search($params){
    	     $sql =  self::find();
             $sql->joinWith(array('account'));
             $dataProvider = new ActiveDataProvider(array(
                'query' => $sql,
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
               $sql->andWhere($this->tableName().'.id = "'.$this->id.'"');
           }   
           if($this->title!=''){
               $sql->andWhere($this->tableName().'.title LIKE "%'.$this->title.'%"');
           }
           if($this->status!=''){
               $sql->andWhere($this->tableName().'.status = "'.$this->status.'"');
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
    public static function getAllVote() {
        return array('1'=>'1 Star','2'=>'2 Star','2.5'=>'2.5 Star','3'=>'3 Star','3.5'=>'3.5 Star','4'=>'4 Star','4.5'=>'4.5 Star','5' => '5 Star');
    }
    public static function getVote($n) {
        $arr = self::getAllRank();
        return isset($arr[$n]) ? $arr[$n] : '-No-';        
    }  
  //dung trong backend
   public static function getImg($row,$width = 0, $height = 0) {    
        $retUrl = '../../media/no_img.png';
        if($row->img){
          $retUrl = '../../media/review/'. $row->img;
        }
        return $retUrl;
    } 
 public static function createUrl($data=array(),$params = array()){		
        if(is_array($data)){
           $params['rid']    = $data['id'];                     
           if(trim($data['alias'])!=''){
                $params['title'] = StringHelper::formatUrlKey($data['alias']);
           }else{
               $params['title']  = StringHelper::formatUrlKey($data['title']);
           } 
        }else{
           $params['rid']    = $data->id;           
           if(trim($data->alias)!=''){
               $params['title']  = StringHelper::formatUrlKey($data->alias); 
           }else{
               $params['title']  = StringHelper::formatUrlKey($data->title);
           }                      
        }        
		return Url::toRoute(array('review/view','title'=>$params['title']));       
	}     
/*************Front End**********************/
//tra ve duong dan cua anh
 public static function getImageDefault($row,$width = 0, $height = 0) {    
        $retUrl = Url::base().'/media/no_img.png';
        if($row->img_default !=''){
          $retUrl = Url::base().'/media/itemimgs/'.$row->img_default;
        }
        return $retUrl;
    } 
public static function getDetailReview($id){
        $model = self::findOne($id);  
      return $model;     
   }   
public static function getDetailAlias($alias){
      $model = self::find()->where(['alias'=>$alias])->one();     
      return $model;     
   }    
public static function getLastReview($limit=5,$orderby='id desc',$fields=''){            
        $sql = Review::find();
        $sql->joinWith(array('account'));  
        if($fields!=''){$sql->select($fields);} 
        $sql->where(Review::tableName().'.status =:status',array(':status'=>1));       
        if($limit>0) $sql->limit($limit);
        $sql->orderBy($orderby);
        $rows = $sql->all();  
        return $rows;        
   }  
public static function RatingReview(){ 
        $rows = self::find()->where(['status'=>1])->all();        
        $data = array('rating_value'=>0,'rating_count'=>0);
        if(!empty($rows)){
               $i=0;$total=0;
               foreach($rows as $row){ 
                 $total = $total + $row->vote;
                 $i++;
               }
          $data['rating_value'] = round($total/$i,1);
          $data['rating_count'] = $i;        
        }
        return $data;        
   }     
 //return total record  
 public static function getTotalReview(){ 
        $query  = Review::find()->where("status =:status",array(":status" =>1));
        $count  = clone $query;
        $totalcount = $count->count();
        return $totalcount;        
   }
}