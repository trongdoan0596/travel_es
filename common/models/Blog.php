<?php
namespace common\models;//app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use common\helper\StringHelper;
use yii\helpers\Url;
//use common\components\languageSwitcher;
/**
 * This is the model class for table "au_blog".
 * @property integer $id
 * @property integer $catblog_id
 * @property string  $title
 * @property string  $alias
 * @property string  $introtxt
 * @property string  $fulltxt
 * @property string  $img
 * @property integer $status
 * @property integer $ordering
 * @property string  $metakey
 * @property string  $metadesc
 * @property integer $user_id
 * @property integer $user_modify
 * @property integer $hit
 * @property integer $destination_ids
 * @property integer $list_tag
 * @property integer $like_count
 * @property integer $comment_count
 * @property integer $featured
 * @property string  $last_update
 * @property string  $create_date
 */
class Blog extends ActiveRecord {     
   public static function tableName(){           
          return 'au_blog';     
  }    
  public function attributes(){
        return ['id','catblog_id','title','alias','introtxt','fulltxt','ordering','img','status','metakey','metadesc','user_id','user_modify','list_tag',
            'hit','destination_ids','like_count','comment_count','featured','last_update','create_date'];
    }
    public function rules()	{
         return [
            [['id','catblog_id','title','alias','introtxt','fulltxt','ordering','img','status','metakey','metadesc','user_id','user_modify','list_tag',
              'hit','destination_ids','like_count','comment_count','featured','last_update','create_date'],'safe'],
            [['id','catblog_id','title'],'safe', 'on' => 'search'],
        ];
	}    
    public function getBlogcate(){
        return $this->hasOne(Blogcate::className(),['id'=>'catblog_id']);
    }
    public function attributeLabels() {
       return ['id' =>'ID','catblog_id'=>'Category','title'=>'Title','alias'=>'Alias','introtxt'=>'Intro Text','fulltxt'=>'Full Text( insert image 760x340, no set height and width)',
			'img'=>'Image(760x388)','status'=>'Status','metakey'=>'Meta Key: Key1,Key2','metadesc'=>'Meta Desc(max :160 char)',
			'user_id'=>'User ID','user_modify'=>'User modify','hit'=>'Hit','destination_ids'=>'Destination IDs','ordering'=>'Ordering','like_count'=>'Like count',
			'comment_count'=>'Comment count','featured'=>'Featured','last_update'=>'Last update','create_date'=>'Create date'];
    }
public function search($params) {      
       $sql =  self::find();                 
       $data = new ActiveDataProvider(['query'=>$sql,'pagination'=>['pageSize'=>30]]);
       $data->setSort(['defaultOrder'=>['id'=>SORT_DESC],'attributes'=>['id','title','catblog_id','status']]);
       if (!($this->load($params) && $this->validate())){
            return $data;
        }
       if($this->title !=''){$sql->andWhere(['like','title',$this->title]);}
       if($this->id>0){$sql->andWhere(['id'=>$this->id]);}
       if($this->catblog_id !=''){$sql->andWhere(['catblog_id' =>$this->catblog_id]);}
       if($this->status !=''){$sql->andWhere(['status' =>$this->status]);}
    return $data;
 }
  public static function getAllStatus() {
        return [0=>'Ẩn',1=>'Hiện'];
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
        if($row->img !=''){
          $retUrl = '../../media/blog/'.$row->img;
        }
        return $retUrl;
    }
public static function Gethome(){
         $rows = self::find()->where('id<20')->orderBy('id')->all();
        return $rows;
 }
 public static function getListBlog($catblog_id = 0,$limit=5,$orderby='title asc',$fields=''){	
        $sql = self::find();
        if($fields!=''){$sql->select($fields);}
        if($catblog_id>0){
             $sql->where(['status'=>1,'catblog_id'=>$catblog_id]);
        }else{
             $sql->where(['status'=>1]);
        }
       if($limit>0) $sql->limit($limit);
       $result= $sql->orderBy($orderby)->all();
       return $result;
}
public static function getListBlogDes($des_ids='',$limit=5,$orderby='title asc',$fields=''){
        $result = array();
        if($des_ids!=''){
            $sql = self::find();
            if($fields!=''){$sql->select($fields);}
            $sql->where(['status'=>'1']);
            $arr = explode(",",$des_ids);
            $tmp = '';
            if(count($arr)){
               for($i=0;$i<count($arr);$i++){
                   $id_ = $arr[$i];
                   if($tmp=='') $tmp = "find_in_set(".$arr[$i].",destination_ids)";
                    else $tmp = $tmp." OR find_in_set(".$arr[$i].",destination_ids)";
               }
            }
            if($tmp!='') $sql->andWhere($tmp);
            if($limit>0) $sql->limit($limit);
            $result= $sql->orderBy($orderby)->all();
        }
        return $result;
    }
    /*****Frontend******/
 //danh sach bai viet moi nhat
public static function getLastBlog($catblog_id = 0,$id = 0,$limit=5,$orderby='id desc'){ 
        $sql = self::find();
        $sql->where(['status'=>1]);
        if($catblog_id>0){$sql->andWhere(['catblog_id'=>$catblog_id]);}
        $sql->andWhere(['not in','id',[$id]]);
        if($limit>0) $sql->limit($limit);
        $rows = $sql->orderBy($orderby)->all();
        return $rows;        
   }   
  public static function getDetailBlog($id){
        return self::findOne($id);
  }
   public static function getDetailAlias($alias){
      return self::find()->where(['alias'=>$alias])->one();
   } 
  public static function createUrl($data=array(),$params = array()){
        if(is_array($data)){
           $params['id'] = $data['id'];
           if(trim($data['alias'])!=''){
                $params['title'] = StringHelper::formatUrlKey($data['alias']);
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
		return Url::toRoute(['blog/view','title'=>$params['title']]);
	}
   //tra ve duong dan cua anh
  public static function getImage($row,$width = 0, $height = 0) {    
        $retUrl = Url::base().'/media/no_img.png';
        if($row->img){
              if($width>0 && $height>0){
                $retUrl = Url::base().'/media/blog/'.$width.'_'.$height.'/'.$row->img;
              }else{
                $retUrl = Url::base().'/media/blog/'.$row->img;
              } 
        }
        return $retUrl;
  }       
}
?>