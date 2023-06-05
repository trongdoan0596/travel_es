<?php
namespace common\models;//app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
/**
 * This is the model class for table "au_images".
 * @property integer $id
 * @property string  $title
 * @property string  $img
 * @property integer $status
 * @property string  $metakey
 * @property string  $metadesc
 * @property integer $featured
 * @property integer $type
 * @property integer $ext_id
 * @property string  $last_update
 * @property string  $create_date
 */
class Itemimg extends ActiveRecord {     
   public static function tableName(){   
          return 'en_itemimg';     
    }    
  public function rules()	{		
         return array(
             array(
                  array('id','title','img','status','type','ext_id','metakey','metadesc','featured','last_update','create_date'
                       ),
                  'safe'
             ),
             array(array('id','title'),'safe', 'on' => 'search'),
        );     
	}    
    
    public function attributeLabels() {
       return array(
			'id' => 'ID',
			'title' => 'Title',
			'img' => 'Image (950 x 600)',
			'img_path' => 'Image Path',
			'status' => 'Status',
			'meta_key' => 'Meta Key',
			'meta_desc' => 'Meta Desc',
            'featured' => 'Featured',
            'type' => 'Type',//lib,review
            'ext_id' => 'Ext ID',
            'last_update'=>'Last update',
            'create_date'=>'Create date'
		);
    }
public function search($params) {       
        $query   = Itemimg::find()->where("type='lib'");
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
public function searchBackend($params) {       
        $query   = Itemimg::find();
        $dataProvider = new ActiveDataProvider(array(
            'query' => $query,
            'pagination'=>array(
                            'pageSize'=>20,
                        ),
                  
        ));
         $dataProvider->setSort(array(
                'defaultOrder' =>array('id'=>SORT_DESC),
                'attributes' => array('id','title','status','type')
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
        if($this->type !=''){
               $query->andWhere('type = "'.$this->type.'"');
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
public static function getAllType() {
        return array('lib' => 'Lib', 'reviewdefault' => 'Reviewd default','review' => 'Reviewd gallery');
    }
 public static function getType($type) {
        if ($type) {
            $arr = self::getAllType();
            return isset($arr[$type]) ? $arr[$type] : '--No--';
        } else {
            return '--No--';
        }
    }    
 //dung trong backend 
 public static function getImg($width = 0, $height = 0) {    
        $retUrl = '../../media/no_img.png';
        if($this->img){
          $retUrl = '../../media/itemimgs/'. $this->img;
        }
        return $retUrl;
    }
 //front end
    public static function getImageSales($row,$width = 0, $height = 0) {  
        $retUrl = '../../media/no_img.png';
        if($row->img){
              if($width>0 && $height>0){
                $retUrl = '../../media/itemimgs/'.$width.'_'.$height.'/'.$row->img;
              }else{
                $retUrl = '../../media/itemimgs/'.$row->img;
              }           
        }
        return $retUrl;
    }
    
    public static function getImage($row,$width = 0, $height = 0) {  
        $retUrl = Url::base().'/media/no_img.png';
        if($row->img){
              if($width>0 && $height>0){
                $retUrl = Url::base().'/media/itemimgs/'.$width.'_'.$height.'/'.$row->img;
              }else{
                $retUrl = Url::base().'/media/itemimgs/'.$row->img;
              }           
        }
        return $retUrl;
    }   
  public static function getImageTopdf($nameimg,$width = 0, $height = 0) {           
        $homeurl = 'https://authentiktravel.es/';// Yii::$app->homeUrl;
        $IP =  Yii::$app->getRequest()->getUserIP();
        if ($IP =='::1') {             
             $homeurl = 'http://localhost/authentiktravel.es/';
        }      
        $retUrl = $homeurl.'media/no_img.png';
        if($nameimg!=""){
          $retUrl = $homeurl.'media/itemimgs/'.$width.'_'.$height.'/'.$nameimg;
        }
        return $retUrl;
    } 
 //danh sach image
 public static function getAllImage(){        
        $result = Itemimg::find()
                ->select('title,img,id')
                ->where('status = 1')
                ->orderBy('title asc')
                ->all();
        return $result;
	} 
 //danh sach image theo type and ext_id     
  public static function getAllImagetypeExt($type,$ext_id){        
        $result = Itemimg::find()
                ->where('type=:type AND ext_id=:ext_id AND status = 1',array(':type'=>$type,':ext_id'=>$ext_id))
                ->orderBy('create_date asc')
                ->all();
        return $result;
	} 
   public static function getAllImageDefault($limit=0,$orderby='id desc',$fields=''){          
        $sql = Itemimg::find();
        if($fields!=''){$sql->select($fields);} 
        $sql->where('type=:type AND status =:status',array(':type'=>'reviewdefault',':status'=>1));       
        if($limit>0) $sql->limit($limit);
        $sql->orderBy($orderby);
        $result = $sql->all();  
        return $result;       
	}    
 public static function getDetailItemimg($type,$id){        
        $result = Itemimg::find()
                ->where('type=:type AND id=:id AND status = 1',array(':type'=>$type,':id'=>$id))
                ->one();
        return $result;
	} 
public static function getDetailInfo($id){ 
      $model = Itemimg::findOne($id);  
      return $model;     
   }      
}

?>