<?php
namespace common\models;//app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
/**
 * This is the model class for table "au_category".
 *
 * The followings are the available columns in table 'article_category':
 * @property string $id
 * @property string $title
 * @property string $alias
 * @property integer $parent_id
 * @property integer $level
 * @property string $fulltxt
 * @property string $path
 * @property integer $status
 * @property integer $ordering
 * @property string $create_date
 * @property string $last_update
 * @property integer $featured
 * @property integer $img
 * @property string $metakey
 * @property string $metadesc
 * @property string $metatitle 
 * @property string $user_id
 * @property string $user_modify
*/
 
class Category extends ActiveRecord {

    public static function tableName() { 
             return 'au_category';   
    }
  public function rules()	{		
         return array(
            // array('country_id,featured,status,ordering','integerOnly'=>true),
            // array('title', 'length', 'max'=>255),
            // array('img', 'file', 'extensions' =>array('png', 'jpg', 'gif'),'maxSize' =>2*1024),
            // array( array('title'), 'required'),
            // array( array('country_id'), 'required','message' => 'Please choose a Country name.'),
             array(
                  array('id','title','alias','parent_id','level','fulltxt','path','status',
                          'ordering','create_date','last_update','featured','img','metakey','metadesc','metatitle',
                          'user_id','user_modify'
                       ),
                  'safe'
             ),
             array(array('id','title','status'),'safe', 'on' => 'search'),
        );     
	}
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Title(Max:70 char)',
            'alias' => 'Alias(Max:70 char)',
            'parent_id' => 'Parent',
            'level' => 'Level',
            'fulltxt' => 'Mô tả',
            'path' => 'Path',
            'status' => 'Trạng thái',
            'ordering' => 'Sắp xếp',
            'create_date' => 'Ngày tạo',
            'last_update' => 'Ngày sửa',
            'featured'=>'Featured',//duoi center
            'img'=>'Image(750x450)',
            'metatitle'=>'Metatitle',
            'metadesc'=>'Meta Desc(max :160 char)'
            
        );
    }
  public function search($params) {           
         $sql =  self::find()->where('id>1');//loai truong hop root
         $dataProvider = new ActiveDataProvider(array(
                'query' => $sql,
                'pagination'=>array(
                   'pageSize'=>20,
                 ),
            ));
            if (!($this->load($params) && $this->validate())) {
                return $dataProvider;
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
          $retUrl = '../../media/cate/'.$row->img;
        }
        return $retUrl;
    }   
    //tra ve duong dan cua anh
  public static function getImage($row,$width = 0, $height = 0) {    
        $retUrl = Url::base().'/media/no_img.png';
        if($row->img){
          $retUrl = Url::base().'/media/cate/'.$row->img;
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
                Category::getAllParentsTree($arr,$item->id,$level);
            }
        }
        return $arr;
    }
    public static function getNameCate($id){
        $result="-No-";
        $model = self::findOne($id);
        if(!empty($model)){
            $result = $model->title;
        }
        return $result;
    }
    public static function getCateparent($parent_id=0,$orderby='title asc'){
        $sql = Category::find()->where('parent_id =:parent_id and status = 1',array(':parent_id' =>$parent_id));
        $sql->orderBy($orderby);
        $result= $sql->all();            
        return $result;
	}
   public static function getDetailCategory($id){	       
          $model = Category::findOne($id);     
          return $model;
   }       
}