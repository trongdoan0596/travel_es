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
//use common\components\languageSwitcher;
use common\models\Tour;
use common\models\Tourcate;
/**
 * This is the model class for table "au_menu".
 * @property integer $id
 * @property integer $ext_id //ID mo rong cua menu ,id_article,id_category,id_tour,id ...
 * @property integer $parent_id
 * @property integer $cate_id
 * @property string  $title
 * @property string  $alias
 * @property string  $img
 * @property string  $introtxt
 * @property string  $metakey
 * @property string  $metadesc
 * @property integer $url
 * @property integer $status
 * @property integer $device
 * @property integer $type 
 * @property integer $ordering
 * @property integer $tmp
 * @property string  $last_update
 * @property string  $create_date
 * @property integer $user_id
 * @property integer $user_modify
*/
 
class Menu extends ActiveRecord { 
    const MENU_TYPE_ACTICLE      = 1;//Article
    const MENU_TYPE_ACTICLE_CATE = 2;//Article Category
    const MENU_TYPE_TOUR         = 3;//Tour  
    const MENU_TYPE_TOUR_CATE    = 4;//Tour Category
    const MENU_TYPE_BLOG_CATE    = 5;//Blog Category
    
    const MENU_TOP      = 1;//Menu top
    const MENU_LEFT     = 2;//Menu left
    const MENU_RIGHR    = 3;//Menu Right  
    const MENU_FOOTER   = 4;//Menu footer    
    const MENU_BLOG     = 5;//Menu blog 
	public static function tableName(){ 
         return 'au_menu';    
	} 
   public function rules()	{		
         return array(
             //array( array('title'), 'required'),
             array(
                  array('id','parent_id','ext_id','cate_id','title','alias','url','img',
                        'introtxt','metakey','metadesc','status','type',
                        'device','ordering','tmp','last_update','create_date',
                        'user_id','user_modify'
                       ),
                  'safe'
             ),
            array(array('id','title','parent_id','ext_id','cate_id','status'),'safe', 'on' => 'search'),
        );     
	}

	public function attributeLabels(){
		return array(
            'id' => 'ID',
            'ext_id'=> 'Extend ID',
            'parent_id'=>'Parent ID',
            'cate_id'=>'Danh Mục Menu',
			'title' => 'Title',	
            'alias'=>'Alias',
            'img'=>'Image(250x250)',            
            'introtxt' => 'Intro text',
			'metakey' => 'Metakey',	
            'metadesc'=>'Metadesc'	,
            'featured'=>'Featured',
            'status'=>'Status',
            'type'=>'Type',
            'url'=>'Url',
            'ordering' => 'Ordering',
            'last_update'=> 'Last update',
			'create_date' => 'Create date',
            'device'=>'Trên Thiết bị',
            'tmp'=>'Mẫu dropdown'          
		);
	}
	public function search($params){
		$sql =  self::find()->where('id>1');//loai truong hop root
        $dataProvider = new ActiveDataProvider(array(
                'query' => $sql,
                'pagination'=>array(
                   'pageSize'=>30,
                 ),
            ));
         $dataProvider->setSort(array(
            'defaultOrder' =>array('parent_id'=>SORT_ASC),
            'attributes' => array('id','title','parent_id','ext_id','cate_id','type','status')
        ));
       if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        if($this->title!=''){
             $sql->andWhere('title LIKE "%'.$this->title.'%"');
        }
        if($this->id>0){
             $sql->andWhere('id = "'.$this->id.'"');
         }
        if($this->type>0){
             $sql->andWhere('type = "'.$this->type.'"');
         }
        if($this->cate_id>0){
             $sql->andWhere('cate_id = "'.$this->cate_id.'"');
        } 
        if($this->parent_id>0){
             $sql->andWhere('parent_id = "'.$this->parent_id.'"');
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
   public static function getAllType() {
        return array( 
                self::MENU_TYPE_ACTICLE => 'Article',
                self::MENU_TYPE_ACTICLE_CATE => 'Article Category',
                self::MENU_TYPE_TOUR => 'Tour',
                self::MENU_TYPE_TOUR_CATE => 'Tour Category',
                self::MENU_TYPE_BLOG_CATE => 'Blog Category'         
            );
    }
    public static function getType($type) {
        if ($type) {
            $arrStatus = self::getAllType();
            return isset($arrStatus[$type]) ? $arrStatus[$type] : ' ';
        } else {
            return 'No type';
        }
    }
 //dung trong backend
 public static function getImg($row,$width = 0, $height = 0) {    
        $retUrl = '../../media/no_img.png';
        if($row->img){
          $retUrl = '../../media/menu/'. $row->img;
        }
        return $retUrl;
    }   
  public static function getAllParentsTree(&$arr=array(),$parent_id=0,$level=0){
        $sql =  Menu::find()->where('status =:status and parent_id =:parent_id',array(':status' =>1,':parent_id' =>$parent_id));
        $sql->orderBy('title asc');   
        $model  = $sql->all();
        $prefix = ($parent_id==0)? '':'--';
        $prefix = str_repeat($prefix,$level);
        if(!empty($model)){
            $level++;
            foreach($model as $item){
                if($item->parent_id==1){
                    $a_tmp = array(1=>'Menu Top',2=>'Menu Left',3=>'Menu Right',4=>'Menu Footer',5 => 'Blog Category');
                    if($item->cate_id>0){
                        $arr[$item->id] = $prefix . ' ' . $item->title.'( '.$a_tmp[$item->cate_id].')';
                    }                    
                }else{
                    $arr[$item->id] = $prefix . ' ' . $item->title;
                }                
                Menu::getAllParentsTree($arr,$item->id,$level);
            }
        }
        return $arr;
    }
   public static function getAllParentsTreeFilter(&$arr=array(),$parent_id=1,$level=0){
        $sql =  Menu::find()->where('status =:status and parent_id =:parent_id',array(':status' =>1,':parent_id' =>$parent_id));      
        $sql->orderBy('title asc');   
        $model  = $sql->all();         
        $prefix = ($parent_id==0)? '':'--';
        $prefix = str_repeat($prefix,$level);
        if(!empty($model)){
            $level++;
            foreach($model as $item){               
                $arr[$item->id] = $prefix . ' ' . $item->title;               
                Menu::getAllParentsTreeFilter($arr,$item->id,$level);
            }
        }
        return $arr;
    }
  public static function getNameMenu($id){	       
      $model = Menu::findOne($id); 
      if(!empty($model)){
        return $model->title;
      }else{
        return 'No title';
      }
   }          
/*******frontend***************/
   public static function getMenu($cate_id=0,$lang='en'){       
        $result = Menu::find()
                    ->where('parent_id >0 and status =:status and cate_id =:cate_id',
                            array(':status' =>1,':cate_id' =>$cate_id)
                        )
                    ->orderBy('ordering asc')
                    ->all();
        return $result;
	}
   public static function createUrl($data=array(),$params = array()){	
        $result='#';       
        switch ($data->type) {
                case 1://Article
                    $result= Url::toRoute(array('article/view','id'=>$data->ext_id,'title'=>StringHelper::formatUrlKey($data->alias)));
                    break;
                case 2://Article Category
                    $result= Url::toRoute(array('article/index','cid'=>$data->ext_id,'title'=>StringHelper::formatUrlKey($data->alias)));
                    break;
                case 3://Tour
                    $result= Url::toRoute(array('tour/view','title'=>StringHelper::formatUrlKey($data->alias)));
                    break;
                 case 4://Tour Category                   
                    $result= Url::toRoute(array('tour/index','language'=>$data->lang,'title'=>StringHelper::formatUrlKey($data->alias)));
                    break; 
                 case 5://Blog Category   
                     if($data->alias!=''){
                        $result= Url::toRoute(array('blog/index','title'=>StringHelper::formatUrlKey($data->alias))); 
                     }else{
                        $result= Url::toRoute(array('blog/index','bcid'=>$data->ext_id,'title'=>StringHelper::formatUrlKey($data->alias))); 
                     }                                      
                    break;      
                default:                   
                    $result   = Url::base().'/'.$data->alias;                                     
                 break;        
            }

		return $result;       
	}
     //tra ve duong dan cua anh
   public static function getImage($row,$width = 0, $height = 0) {  
        $retUrl = Url::base().'/media/no_img.png';
        if($row->img){
              if($width>0 && $height>0){
                $retUrl = Url::base().'/media/menu/'.$width.'_'.$height.'/'.$row->img;
              }else{
                $retUrl = Url::base().'/media/menu/'.$row->img;
              }           
        }
        return $retUrl;
    }    
}