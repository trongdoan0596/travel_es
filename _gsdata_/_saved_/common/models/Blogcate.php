<?php
namespace common\models;//app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use common\helper\StringHelper;
/**
 * This is the model class for table "au_category".
 *
 * The followings are the available columns in table 'article_category':
 * @property string  $id
 * @property string  $title
 * @property string  $alias
 * @property integer $parent_id
 * @property integer $level
 * @property string  $fulltxt
 * @property string  $path
 * @property integer $status
 * @property integer $ordering
 * @property string  $create_date
 * @property string  $last_update
 * @property integer $featured
 * @property integer $img
 * @property string  $icon
 * @property string  $metakey
 * @property string  $metadesc
 * @property string  $user_id
 * @property string  $user_modify
 */
class Blogcate extends ActiveRecord {
    public static function tableName() { 
         return 'au_blogcate';
    }
  public function attributes(){
        return ['id','title','alias','parent_id','level','fulltxt','path','status','ordering','create_date','last_update','featured','img','icon','metakey','metadesc','user_id','user_modify'];
    }
  public function rules()	{		
         return [
             [['id','title','alias','parent_id','level','fulltxt','path','status','ordering','create_date','last_update','featured','img','icon','metakey','metadesc','user_id','user_modify'],'safe'],
             [['id','title','status'],'safe','on'=>'search'],
        ];
	}
    public function attributeLabels() {
        return ['id'=>'ID','title'=>'Title','alias'=>'Alias','parent_id'=>'Parent','level'=>'Level','fulltxt'=>'Full text',
            'status'=>'Status','ordering'=>'Ordering','create_date'=>'Created',
            'last_update'=>'Updated','metakey'=>'Meta Key','metadesc'=>'Meta Desc(max :160 char)','featured'=>'Featured','img'=>'Image','icon'=>'Icon'];
    }
  public function search($params) {
      	$sql =  self::find()->where('id>1');//loai truong hop root
        $data= new ActiveDataProvider(['query'=>$sql,'pagination'=>['pageSize'=>30]]);
        $data->setSort(['defaultOrder'=>['parent_id'=>SORT_ASC],'attributes'=>['id','title','parent_id','ext_id','status']]);
        if (!($this->load($params) && $this->validate())) {
            return $data;
        }
        if($this->title !=''){$sql->andWhere(['like','title',$this->title]);}
        if($this->id>0){$sql->andWhere(['id'=>$this->id]);}
        if($this->parent_id>0){$sql->andWhere(['parent_id' =>$this->parent_id]);}
        if($this->status !=''){$sql->andWhere(['status' =>$this->status]);}
        return $data;
    }
    public static function getAllStatus() {
        return[0=>'Ẩn',1=>'Hiện'];
    }
    public static function getStatus($n) {
        if ($n) {
            $arr = self::getAllStatus();
            return isset($arr[$n]) ? $arr[$n] : '-No-';
        } else {
            return '-No-';
        }
    }
 //dung trong backend
 public static function getImg($row,$width = 0, $height = 0) {    
        $retUrl = '../../media/no_img.png';
        if($row->img){
          $retUrl = '../../media/blogcate/'. $row->img;
        }
        return $retUrl;
    }  
  public static function getIcon($row,$width = 0, $height = 0) {    
        $retUrl = '../../media/no_img.png';
        if($row->icon){
          $retUrl = '../../media/blogcate/icon/'. $row->icon;
        }
        return $retUrl;
    }     
    //tra ve duong dan cua anh
  public static function getImage($row,$width = 0, $height = 0) {    
        $retUrl = Url::base().'/media/no_img.png';
        if($row->img){
          $retUrl = Url::base().'/media/blogcate/'.$row->img;
        }
        return $retUrl;
  } 
  public static function getIconFrontend($row,$width = 0, $height = 0) {    
        $retUrl = Url::base().'/media/no_img.png';
        if($row->icon){
          $retUrl = Url::base().'/media/blogcate/icon/'.$row->icon;
        }
        return $retUrl;
  }       
  public static function getAllParentsTree(&$arr=array(),$parent_id=0,$level=0){
        $model  = self::find()->where(['status'=>1,'parent_id'=>$parent_id])->orderBy('title asc')->all();
        $prefix = ($parent_id==0)? '':'--';
        $prefix = str_repeat($prefix,$level);
        if($model){
            $level++;
            foreach($model as $item){
                $arr[$item->id] = $prefix . ' ' . $item->title;
                Blogcate::getAllParentsTree($arr,$item->id,$level);
            }
        }
        return $arr;
    } 
     public static function getAllParentsTreeFilter(&$arr=array(),$parent_id=1,$level=0){
        $model  = self::find()->where(['status'=>1,'parent_id'=>$parent_id])->orderBy('title asc')->all();
        $prefix = ($parent_id==0)? '':'--';
        $prefix = str_repeat($prefix,$level);
        if($model){
            $level++;
            foreach($model as $item){               
                $arr[$item->id] = $prefix . ' ' . $item->title;               
                Blogcate::getAllParentsTreeFilter($arr,$item->id,$level);
            }
        }
        return $arr;
    }
  public static function getPath(&$arr=array(),$parent_id=1){
        $model = self::findOne($parent_id);
        if(!empty($model)){
            $id = $model->id;
            $parent_id = $model->parent_id;
            $arr[] = $id;  
            if($parent_id>=0){
                self::getPath($arr,$parent_id);
            }            
        }
        return $arr;
    }
   //goi de quy tra ve tat ca sub id con trong parent_id 
   public static function getAllIds(&$arr=array(),$parent_id=1){          
        $sql = self::find()->where(['status'=>1,'parent_id'=>$parent_id]);
        $rows = $sql->all();  
        if(!empty($rows)){
             foreach($rows as $row){         
                 $id = $row->id;                
                 $arr[] = $id;
                 self::getAllIds($arr,$id);
            }                  
        }
        return $arr;
    }
    //tra ve tat ca id theo parent_id
    public static function getBlogcateParent($parent_id=0,$orderby='title asc'){
        $sql = self::find()->where(['status'=>1,'parent_id'=>$parent_id]);
        $result= $sql->orderBy($orderby)->all();
        return $result;
	}
   public static function getDetailBlogcate($id){	       
        $model = self::findOne($id);     
        return $model;
   }
   public static function getDetailAlias($alias){
      $model = self::find()->where(['alias'=>$alias])->one();     
      return $model;     
   } 
    public static function getAllBlogcate($cat_id=1,$orderby='title asc'){
        $sql = self::find();
        $sql->where(['status'=>1,'parent_id'=>$cat_id]);
        $sql->andWhere(['>','id',1]);
        $result= $sql->orderBy($orderby)->all();
        if(empty($result)){
            $model = self::findOne($cat_id);
            if(!empty($model)){
                $parent_id= $model->parent_id;
            }else{
                $parent_id= 1;
            }
            $sql = self::find();
            $sql->where(['status'=>1,'parent_id'=>$parent_id]);
            $sql->andWhere(['>','id',1]);
            $result= $sql->orderBy($orderby)->all();
        }         
        return $result;
	}  
    public static function getCatBlog($id){	       
        $model = self::findOne($id);
        $result ='-No-';
        if(!empty($model)){$result= $model->title;}
        return $result;
   }
     public static function createUrl($data=array(),$params = array()){
        $alias = 0;
        if(is_array($data)){
           $params['id']    = $data['id'];           
           if(trim($data['alias'])!=''){
                $params['title']  = StringHelper::formatUrlKey($data['alias']); 
                $alias = 1;
           }else{
                $params['title'] = StringHelper::formatUrlKey($data['title']);
           }
        }else{
           $params['id']    = $data->id;
           if(trim($data->alias)!=''){
                $params['title']  = StringHelper::formatUrlKey($data->alias); 
                $alias = 1;
           }else{
                $params['title']  = StringHelper::formatUrlKey($data->title);
           }                     
        }      
        if($alias==1){
            return Url::toRoute(['blog/index','title'=>$params['title']]);
        }else{
            return Url::toRoute(['blog/index','bcid'=>$params['id'],'title'=>$params['title']]);
        }
	}      
}