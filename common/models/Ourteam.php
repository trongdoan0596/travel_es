<?php
namespace common\models;//app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use common\helper\StringHelper;
/**
 * This is the model class for table "au_ourteam".
 * @property integer $id
 * @property string  $title
 * @property string  $profession
 * @property string  $introtxt
 * @property string  $fulltxt
 * @property string  $img
 * @property string  $birtday
 * @property integer $status 
 * @property integer $ordering
 * @property integer $featured
 * @property integer $country_id
 * @property string  $last_update
 * @property string  $create_date
 */
class Ourteam extends ActiveRecord { 
    
   public static function tableName(){  
          return 'en_ourteam';     
    }    
  public function rules()	{		
         return array(           
            array( array('title'), 'required'),
             array(
                  array('id','title','profession','introtxt','fulltxt','img','birtday','status','featured','ordering','country_id','last_update','create_date'
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
			'introtxt' => 'Intro Text',
			'fulltxt' => 'Full Text',
			'img' => 'Image(270x270)',		
			'status' => 'Status',		
			'ordering' => 'Ordering',
            'featured' => 'Featured',
            'last_update'=>'Last update',
            'create_date'=>'Create date',
            'profession'=>'Profession',
            'birtday'=>'Birtday',
            'country_id'=>'Country ID'
		);
    }
public function search($params) {
        $query =  Ourteam::find();
        $dataProvider = new ActiveDataProvider(array(
            'query' => $query,
            'pagination'=>array(
                            'pageSize'=>30,
                        ),
                  
        ));
         $dataProvider->setSort(array(
                'defaultOrder' =>array('id'=>SORT_DESC),
                'attributes' => array('id','title','ordering','status')
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
          $retUrl = '../../media/ourteam/'.$row->img;
        }
        return $retUrl;
    } 
 /*****Frontend******/
public static function getListOurteam($country_id=232,$limit=0){ 
        $sql = Ourteam::find();
        if($country_id>0){  
            $sql->where('status =:status AND country_id =:country_id',array(':status' =>1,':country_id' =>$country_id));
        }else{        
            $sql->where('status =:status',array(':status' => 1));
        }      
        if($limit>0) $sql->limit($limit);
        $sql->orderBy('ordering asc');
        $rows = $sql->all();  
        return $rows;        
}
public static function getDetailOurteam($id){
        $model = Ourteam::findOne($id);  
      return $model;     
   }
public static function getByAlias($alias){
        return Ourteam::findOne(array('alias' =>$alias, 'status' =>1));
    }   
public static function createUrl($data=array(),$params = array()){		
        if(is_array($data)){
           $params['oid']    = $data['id'];
           $params['title']  = StringHelper::formatUrlKey($data['title']);
        }else{
           $params['oid']    = $data->id;
           $params['title']  = StringHelper::formatUrlKey($data->title);           
        }        
		return Url::toRoute(array('ourteam/view','id'=>$params['oid'],'title'=>$params['title']));       
	}
   //tra ve duong dan cua anh
   public static function getImage($row,$width = 0, $height = 0) {  
        $retUrl = Url::base().'/media/no_img.png';
        if($row->img){
              if($width>0 && $height>0){
                $retUrl = Url::base().'/media/ourteam/'.$width.'_'.$height.'/'.$row->img;
              }else{
                $retUrl = Url::base().'/media/ourteam/'.$row->img;
              }           
        }
        return $retUrl;
    }       
}
?>