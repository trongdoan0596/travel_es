<?php
namespace common\models;//app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use common\helper\StringHelper;
use yii\helpers\Url;
//use common\components\languageSwitcher;
/**
 * This is the model class for table "au_article".
 * @property integer $id
 * @property integer $cat_id
 * @property string  $title
 * @property string  $alias
 * @property string  $introtxt
 * @property string  $fulltxt
 * @property string  $img
 * @property string  $img_path
 * @property integer $status
 * @property integer $ordering
 * @property string  $metatitle
 * @property string  $metakey
 * @property string  $metadesc
 * @property integer $user_id
 * @property integer $user_modify
 * @property integer $hit
 * @property integer $like_count
 * @property integer $comment_count
 * @property integer $featured
 * @property string  $last_update
 * @property string  $create_date
 */
class Article extends ActiveRecord { 
    
   public static function tableName(){  
          return 'au_article';     
    }    
  public function rules()	{		
         return array(
            // array('country_id,featured,status,ordering','integerOnly'=>true),
            // array('title', 'length', 'max'=>255),
            // array('img', 'file', 'extensions' =>array('png', 'jpg', 'gif'),'maxSize' =>2*1024),
            //array( array('title'), 'required'),
            // array( array('country_id'), 'required','message' => 'Please choose a Country name.'),
             array(
                  array('id','cat_id','title','alias','introtxt','fulltxt','ordering',
                         'img','img_path','status','metatitle','metakey','metadesc','user_id','user_modify',
                         'hit','like_count','comment_count','featured','last_update','create_date'
                       ),
                  'safe'
             ),
             array(array('id','cat_id','title'),'safe', 'on' => 'search'),
        );     
	}    
    public function getCategory(){
        return $this->hasOne(Category::className(),array('id' =>'cat_id'));
    }
    public function attributeLabels() {
       return array(
			'id' => 'ID',
			'cat_id' => 'Category',
			'title' => 'Title',
			'alias' => 'Alias',
			'introtxt' => 'Intro Text',
			'fulltxt' => 'Full Text( insert image 760x340, no set height and width)',
			'img' => 'Image(Blog:700x450)',
			'img_path' => 'Image Path',
			'status' => 'Status',
            'metatitle' => 'Meta Title',
			'metakey' => 'Meta Key',
			'metadesc' => 'Meta Desc(max :160 char)',
			'user_id' => 'User ID',
			'user_modify' => 'User modify',
			'hit' => 'Hit',
            'ordering'=>'Ordering',
			'like_count' => 'Like count',
			'comment_count' => 'Comment count',
            'featured' => 'Featured',
            'last_update'=>'Last update',
            'create_date'=>'Create date'
		);
    }
public function search($params) {
         $sql =  self::find();//loai truong hop root
         $dataProvider = new ActiveDataProvider(array('query' =>$sql,'pagination'=>array('pageSize'=>30)));
         $dataProvider->setSort(array(
                'defaultOrder' =>array('id'=>SORT_DESC),
                'attributes' => array('id','title','cat_id','status')
            ));
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        if($this->title !=''){
               $sql->andWhere('title LIKE "%'.$this->title.'%"');
         } 
        if($this->id>0){
               $sql->andWhere('id = "'.$this->id.'"');
          }
        if($this->cat_id !=''){
               $sql->andWhere('cat_id = "'.$this->cat_id.'"');
         }
        if($this->status !=''){
               $sql->andWhere('status = "'.$this->status.'"');
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
 public static function getImg($row,$width = 0, $height = 0) {    
        $retUrl = '../../media/no_img.png';
        if($row->img){
          $retUrl = '../../media/article/'. $row->img;
        }
        return $retUrl;
    }
public static function Gethome(){
         $rows = Article::find()
                            ->where('id<20')
                            ->orderBy('id')
                            ->all();
        return $rows;
    }
 public static function getListArticle($cat_id = 0,$orderby='title asc'){	
        $sql = Article::find();
        if($cat_id>0){            
             $sql->where('status =:status AND cat_id =:cat_id',array(':status' =>1,':cat_id' =>$cat_id));
        }else{        
             $sql->where('status =:status',array(':status' => 1));
        }
       $sql->orderBy($orderby);
       $result= $sql->all();
       return $result;
}  
 /*****Frontend******/
 //danh sach bai viet moi nhat
public static function getLastArticle($cat_id = 0,$limit=5,$orderby='id desc'){ 
        $sql = Article::find();
        if($cat_id>0){
             $sql->where('status =:status AND cat_id =:cat_id',array(':status' =>1,':cat_id' =>$cat_id));
        }else{
             $sql->where('status =:status',array(':status' => 1));           
        }
        if($limit>0) $sql->limit($limit);
        $sql->orderBy($orderby);
        $rows = $sql->all();  
        return $rows;        
   }
public static function getLastArticleBlog($cat_id = 0,$id = 0,$limit=5,$orderby='id desc'){ 
        $sql = Article::find();
        $sql->where('status =:status AND cat_id =:cat_id AND id !='.$id,array(':status' =>1,':cat_id' =>$cat_id));
        if($limit>0) $sql->limit($limit);
        $sql->orderBy($orderby);
        $rows = $sql->all();  
        return $rows;        
   }   
  public static function getDetailArticle($id){	 
      //Yii::$app->language = Yii::$app->request->cookies->getValue('language');
      $model = Article::findOne($id);  
      return $model;     
   }
  public static function createUrl($data=array(),$params = array()){		
        if(is_array($data)){
           $params['aid']    = $data['id'];
           $params['title'] = StringHelper::formatUrlKey($data['title']);
        }else{
           $params['aid']    = $data->id;
           $params['title']  = StringHelper::formatUrlKey($data->title);           
        }        
		return Url::toRoute(array('article/view','id'=>$params['aid'],'title'=>$params['title']));       
	}
   //tra ve duong dan cua anh
  public static function getImage($row,$width = 0, $height = 0) {    
        $retUrl = Url::base().'/media/no_img.png';
        if($row->img){
              if($width>0 && $height>0){
                $retUrl = Url::base().'/media/article/'.$width.'_'.$height.'/'.$row->img;
              }else{
                $retUrl = Url::base().'/media/article/'.$row->img;
              } 
        }
        return $retUrl;
  }      
}
?>