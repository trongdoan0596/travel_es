<?php
namespace common\models;//thu muc hien tai cua app : app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
//use omgdef\multilingual\MultilingualBehavior;
//use omgdef\multilingual\MultilingualQuery;
use yii\helpers\Url;
use common\helper\StringHelper;
/**
 * This is the model class for table "au_tour".
 * @property integer $id 
 * @property integer $cat_id
 * @property integer $tour_id
 * @property integer $user_id
 * @property integer $manager_id
 * @property integer $sales_id
 * @property string  $title
 * @property string  $shorttxt
 * @property string  $introtxt
 * @property string  $fulltxt
 * @property string  $requesttxt
 * @property string  $code
 * @property string  $type
 * @property string  $num_day
 * @property string  $price_include
 * @property string  $price_not_include
 * @property string  $pdf 
 * @property integer $status
 * @property string  $featured 
 * @property integer $start
 * @property string  $img
 * @property string  $ip
 * @property string  $remoteip  //dia chi IP lay theo HTTP_X_FORWARDED_FOR
 * @property string  $source
 * @property integer $ordering
 * @property string  $start_date 
 * @property string  $txtstart_date
 * @property integer $adults
 * @property integer $children
 * @property integer $imgmap
 * @property string  $target
 * @property string  $hightlight
 * @property string  $imghl
 * @property string  $programme_export
 * @property string  $number_participants
 * @property string  $gifts_company
 * @property integer $price_estimated
 * @property integer $pricce_real
 * @property string  $group_title_price //dung trong export to pdf 
 * @property string  $content_group_price //dung trong export to pdf 
 * @property string  $templatepdf //noi dung export to pdf dc lay tu day
 * @property string  $last_update
 * @property string  $create_date
 * @property string  $templatepdf
 * @property string  $note
 * @property integer $is_mobile
 * @property string  $lang
 * @property string  $user_modify
 * @property string  $user_created
 */ 

class Booktour extends ActiveRecord { 
    //trang thai
    const BOOKTOUR_STATUS_DELETE     = -1;
    const BOOKTOUR_STATUS_PENDING    = 0;
    const BOOKTOUR_STATUS_REQUEST    = 1;
    const BOOKTOUR_STATUS_PROCESSING = 2;
    const BOOKTOUR_STATUS_COMPLETED  = 3;
    const BOOKTOUR_STATUS_CANCELED   = 4;  
    const BOOKTOUR_STATUS_DRAFT      = 5;//trang thai khi copy sang cai moi,cai cu chuyen ve Draft
   //kieu tour
    const BOOKTOUR_TYPE_TOUR      = 1;//tour
    const BOOKTOUR_TYPE_SERVICE   = 2;//Service
   //Source
     const BOOKTOUR_SOURCE          = 1;//Nhan vien tu tim
     const BOOKTOUR_SOURCE_ORDER    = 2;//Khach hang tu dat
     const BOOKTOUR_SOURCE_GOOGLE   = 3;//từ google
     const BOOKTOUR_SOURCE_SEARCH   = 4;//search engine
     const BOOKTOUR_SOURCE_WEBSITE  = 5;//website chinh
     const BOOKTOUR_SOURCE_SATELLITE= 6;//website ve tinh
   
     //su dung de search filter theo user_id
     public $fullname;
     public $first_name;
     public $last_name;
    
    public static function tableName(){   
          return 'au_booktour';   
    }
   
	public function rules()	{		
         return array(
             //array('title', 'filter', 'filter' => 'trim'),
             //array('title', 'required'),
             array(
                  array('id','cat_id','tour_id','user_id','manager_id','sales_id','title','shorttxt','introtxt','fulltxt','requesttxt','code',
                        'num_day','price_include','price_not_include','status','type','featured','region_id','source',
                        'img','ip','ordering','start_date','txtstart_date','adults','children','imgmap','target','hightlight','imghl','programme_export',
                        'number_participants','gifts_company','pricce_real','price_estimated','group_title_price','content_group_price','templatepdf',
                        'last_update','create_date','templatepdf','note','fullname','last_name','first_name','is_mobile',
                        'lang','user_modify','user_created','remoteip' 
                       ),
                  'safe'
             ),
             array(array('id','tour_id','manager_id','sales_id','title','status','fullname','last_name','first_name','remoteip'),'safe', 'on' => 'search'),
        );     
	} 
    public function getUser(){  
        return $this->hasOne(User::className(),array('id' =>'sales_id')); //1 - 1
    }
    public function getAccount(){
        return $this->hasOne(Account::className(),array('id' =>'user_id'));
    }
	public function attributeLabels(){
          /* $langbackend  = Yii::$app->request->cookies->getValue('langbackend');
           if($langbackend=='fr'){}else{} */
          $labels = array(
                        'id' => 'ID',          
                        'cat_id' => 'Category tour',        
                        'tour_id' => 'Tour ID',
                        'title' => 'Title',
                        'fulltxt'=>'Full text',//nội dung trao đổi khi có request
                        'requesttxt'=>'Request',//nọi dung yeu cau ban dau của khách
                        'img' => 'Image(740x442)',
                        'price_include' => 'Price include',
                        'price_not_include'=>'Price not include',
                        'introtxt'=>'Intro text',                        
                        'pdf'=>'PDF',
                        'imgmap'=>'Map image',
                        'num_day' => 'Number day',
                        'featured' => 'Featured',   
                        'code' => 'Code',      
                        'status' => 'Status',    
                        'type' => 'Type',    
                        'source'=>'Source',
                        'region_id'=>'Start point',
                        'ip'=>'IP',
                        'start_date'=>'Start date',
                        'txtstart_date'=>'Text start date',
                        'adults'=>'Number person',
                        'children'=>'Number children',                        
                        'ordering' => 'Ordering',  
                        'hightlight'=>'Hightlight Program',
                        'programme_export'=>'Programme définitif',
                        'number_participants'=>'Nombre de participants',
                        'gifts_company'=>'Cadeaux de notre agence',
                        'group_title_price'=>'Group title price',
                        'content_group_price'=>'Content group price',
                        'templatepdf'=>'Template',
                        'create_date' => 'Create date',      
                        'last_update' => 'Last update',
                        'templatepdf'=>'Template Pdf',
                        'note'=>'Ghi chú',
                        'is_mobile'=>'Is mobile'
            		);
		return $labels;
	}
	public function search($params){
        	$query =  Booktour::find();
            $dataProvider = new ActiveDataProvider(array(
                'query' => $query,
                'pagination'=>array(
                   'pageSize'=>30,
                 ),
            ));
             $dataProvider->setSort(array(
                'defaultOrder' =>array('id'=>SORT_DESC),
                'attributes' => array('id','title','cat_id','create_date','status','ip','remoteip')
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
            if($this->create_date !=''){
               $query->andWhere('create_date>="'.$this->create_date.'"');
            }
            if($this->cat_id !=''){
               $query->andWhere('cat_id = "'.$this->cat_id.'"');
            }
            if($this->ip !=''){
               $query->andWhere('ip = "'.$this->ip.'"');
            }
            if($this->status !=''){
               $query->andWhere('status = "'.$this->status.'"');
            }           
          return $dataProvider;
	}
    public static function getAllStatus() {
        return array(
                self::BOOKTOUR_STATUS_PENDING =>'Pending',//Chưa xử lý
                self::BOOKTOUR_STATUS_REQUEST =>'Request',//đang trao đổi với khác, sales dang xu ly
                self::BOOKTOUR_STATUS_PROCESSING =>'Processing',//điều hành đang xử lý
                self::BOOKTOUR_STATUS_COMPLETED =>'Completed',//request đã hoàn thành
                self::BOOKTOUR_STATUS_CANCELED =>'Canceled',//Khách Hủy
                self::BOOKTOUR_STATUS_DRAFT =>'Draft',//ban da gui cho khach,khi copy sang record khac thì cai record cu chuyen san draft
                self::BOOKTOUR_STATUS_DELETE =>'Delete',//da delete
        );       
    }
    public static function getStatus($status) {
        if ($status>=0) {
            $arrStatus = self::getAllStatus();
            return isset($arrStatus[$status]) ? $arrStatus[$status] : ' ';
        } else {
            return  'No';
        }
    }
    public static function getAllType() {
         return array(
              self::BOOKTOUR_TYPE_TOUR =>'Tour',//Request dạng tour
              self::BOOKTOUR_TYPE_SERVICE =>'Service'//Request dạng dịch vụ
        );    
    }
    public static function getType($type) {
        if ($type>=0) {
            $arr = self::getAllType();
            return isset($arr[$type]) ? $arr[$type] : 'No type';
        } else {
            return 'No type';
        }
    }
    public static function getAllSource() {
         return array(
              self::BOOKTOUR_SOURCE  =>'Sales Find',//Nhan vien tu tim
              self::BOOKTOUR_SOURCE_ORDER =>'Customer Order',//khach hang tu tim den
              self::BOOKTOUR_SOURCE_GOOGLE =>'Từ Google',//Google
              self::BOOKTOUR_SOURCE_SEARCH =>'Search Engine',//search engine
              self::BOOKTOUR_SOURCE_WEBSITE =>'Web chính',//website chinh
              self::BOOKTOUR_SOURCE_SATELLITE =>'Web vệ tinh'//website ve tinh
        );    
    }    
    public static function getSource($source) {
        if ($source>=0) {
            $arr = self::getAllSource();
            return isset($arr[$source]) ? $arr[$source] : 'No Source';
        } else {
            return 'No Source';
        }
    }  
    //gen code
   public static function Gencode($start_date,$user_id) {
        $result = "AT-";
        if($start_date!=""){
            $result .= date("dmy",strtotime($start_date));
        }
        if($user_id>0){
            $infouser = Account::getAccount($user_id);
            if(!empty($infouser)){
                $result .= str_replace(" ", "",$infouser->first_name.$infouser->last_name);
            }
        }
        return $result;
    }
  //cac phuong tin tham gia trong ngay
  public static function getAllTransport() {
        return array(
            "1" =>"Bơi",
            "2"=>"Đi bộ",
            "3"=>"Xe đạp",
            "4"=>"Xe máy",
            "5"=>"Oto",
            "6"=>"Tuk tuk",
            "7"=>"Xe bò",
            "8"=>"Cưỡi voi",
            "9"=>"Máy bay",
            "10"=>"Tàu hỏa",
            "11"=>"Tàu thủy",
            "12"=>"Kayak",
            "13"=>"Xích lô",
            "14"=>"Thuyền/Đò",
            "15"=>"Tầu cáo tốc"
        );
  }
          
/*************Sales*************/ 
//search va clone sang record new
public function searchClone($params){            
           //$query   = Booktour::find()->where('status>=0')->with('user');
            $query   = Booktour::find();
            $query->joinWith(array('user'));           
            $query->andWhere(Booktour::tableName().'.status>=0');     
            $dataProvider = new ActiveDataProvider(array(
                'query' => $query,
                'pagination'=>array(
                   'pageSize'=>30,
                 ),
            ));
            $dataProvider->setSort(array(
                'defaultOrder' =>array('id'=>SORT_DESC),
                'attributes' => array('id','title','target','create_date','num_day','status','fullname')
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
            if($this->target !=''){
               $query->andWhere('target LIKE "%'.$this->target.'%"');
            } 
            if($this->create_date !=''){
               $query->andWhere('create_date>="'.$this->create_date.'"');
            }
             if($this->num_day !=''){
               $query->andWhere('num_day = "'.$this->num_day.'"');
            }       
            if($this->fullname !=''){
              $query->andWhere('fullname LIKE "%'.$this->fullname.'%"');
            }
            
          return $dataProvider;
	}
public function searchSales($params){
            $sales_id= Yii::$app->user->identity->id;
           // $query   = Booktour::find()->where('sales_id =:sales_id and status>=0',array(':sales_id'=>$sales_id));
            $query   = Booktour::find();
            $query->joinWith(array('account'));
            $query->andWhere('sales_id = "'.$sales_id.'"');
            $query->andWhere(Booktour::tableName().'.status>=0');            
            $dataProvider = new ActiveDataProvider(array(
                'query' => $query,
                'pagination'=>array(
                   'pageSize'=>30,
                 ),
            ));
            $dataProvider->setSort(array(
                'defaultOrder' =>array('id'=>SORT_DESC),
                'attributes' => array('id','title','fullname','first_name','last_name','code','create_date','num_day','status')
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
            if($this->create_date !=''){
               $query->andWhere('create_date>="'.$this->create_date.'"');
            }
            if($this->code !=''){
               $query->andWhere('code = "'.$this->code.'"');
            } 
            if($this->num_day !=''){
               $query->andWhere('num_day = "'.$this->num_day.'"');
            }   
            if($this->fullname !=''){              
               $query->andWhere('first_name LIKE "%'.$this->fullname.'%" OR last_name LIKE "%'.$this->fullname.'%"');
            }       
            
          return $dataProvider;
	}
//search theo tung user
public function searchUser($str_id,$params){  
            $sales_id= Yii::$app->user->identity->id;
            $query   = Booktour::find()->where('sales_id =:sales_id AND id IN('.$str_id.') AND status>=0',array(':sales_id'=>$sales_id));
            $dataProvider = new ActiveDataProvider(array(
                'query' => $query,
                'pagination'=>array(
                   'pageSize'=>30,
                 ),
            ));
            $dataProvider->setSort(array(
                'defaultOrder' =>array('id'=>SORT_DESC),
                'attributes' => array('id','title','code','create_date','num_day','status')
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
            if($this->create_date !=''){
               $query->andWhere('create_date>="'.$this->create_date.'"');
            }
            if($this->code !=''){
               $query->andWhere('code = "'.$this->code.'"');
            } 
             if($this->num_day !=''){
               $query->andWhere('num_day = "'.$this->num_day.'"');
            }           
          return $dataProvider;
	}    
 //manager
 public function searchManager($params){
            $manager_id= Yii::$app->user->identity->id;               
            if($manager_id==User::ROOT_MANAGER_ID){
                $query   = Booktour::find()->where('status="'.self::BOOKTOUR_STATUS_PROCESSING.'" OR status="'.self::BOOKTOUR_STATUS_COMPLETED.'"');
            }else{
                $query   = Booktour::find()->where('manager_id =:manager_id AND ( status="'.self::BOOKTOUR_STATUS_PROCESSING.'" OR status="'.self::BOOKTOUR_STATUS_COMPLETED.'")',array(':manager_id'=>$manager_id));
            }            
            $dataProvider = new ActiveDataProvider(array(
                'query' => $query,
                'pagination'=>array(
                   'pageSize'=>30,
                 ),
            ));
            $dataProvider->setSort(array(
                'defaultOrder' =>array('id'=>SORT_DESC),
                'attributes' => array('id','title','code','create_date','num_day','status')
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
            if($this->create_date !=''){
               $query->andWhere('create_date>="'.$this->create_date.'"');
            }
            if($this->code !=''){
               $query->andWhere('code = "'.$this->code.'"');
            } 
             if($this->num_day !=''){
               $query->andWhere('num_day = "'.$this->num_day.'"');
            }           
          return $dataProvider;
	}   
  public static function getMapimg($width = 0, $height = 0) {    
        $retUrl = '../../media/no_img.png';
        if($this->imgmap){
          $retUrl = '../../media/tour/imgmap/'. $this->imgmap;
        }
        return $retUrl;
    }   
  //lay thong tin tour xem co phai la cua sales dang login hay ko
  public static function GetBooktourSales($id){
        $sales_id = Yii::$app->user->identity->id;
        $model    = Booktour::find()
                            ->where('id =:id AND sales_id =:sales_id AND status>=0',array(':id'=>$id,':sales_id'=>$sales_id))
                            ->one();
        return $model;
   }
   //dc phep edit
   public static function PermissionBooktour($model) {    
        $result = 1;
        $status = $model->status;
        if($status == self::BOOKTOUR_STATUS_PROCESSING || $status == self::BOOKTOUR_STATUS_COMPLETED || 
        $status == self::BOOKTOUR_STATUS_CANCELED ||  $status == self::BOOKTOUR_STATUS_DELETE  ){
            $result = 0;
        }        
        return $result;
    } 
     //dc phep delete
   public static function PermissionDelBooktour($model) {    
        $result = 0;
        $status = $model->status;
        if($status == self::BOOKTOUR_STATUS_PENDING || $status == self::BOOKTOUR_STATUS_REQUEST  ){
            $result = 1;
        }        
        return $result;
    } 
   //quyen dc export
    public static function PermissExportBooktour($model) {    
        $result = 1;
        $status = $model->status;
        if($status == self::BOOKTOUR_STATUS_CANCELED ||  $status == self::BOOKTOUR_STATUS_DELETE  ){
            $result = 0;//ko dc quyen export
        }        
        return $result;
    } 
      
     public static function getAllStatusSales() {
        return array(
                self::BOOKTOUR_STATUS_PENDING =>'Pending',//Chưa xử lý
                self::BOOKTOUR_STATUS_REQUEST =>'Request',//đang trao đổi với khác, sales dang xu ly
                self::BOOKTOUR_STATUS_PROCESSING =>'Processing',//điều hành đang xử lý    
                self::BOOKTOUR_STATUS_DRAFT =>'Draft',
                self::BOOKTOUR_STATUS_CANCELED =>'Canceled'
        );       
    }
    public static function getStatusSales($status) {
        if ($status>=0) {
            $arr = self::getAllStatusSales();
            return isset($arr[$status]) ? $arr[$status] : 'No';
        } else {
            return  'No';
        }
    }
    //filter for sales
    public static function getAllStatusFilterSales() {
        return array(
                self::BOOKTOUR_STATUS_PENDING =>'Pending',//Chưa xử lý
                self::BOOKTOUR_STATUS_REQUEST =>'Request',//đang trao đổi với khác, sales dang xu ly
                self::BOOKTOUR_STATUS_PROCESSING =>'Processing',//điều hành đang xử lý 
                self::BOOKTOUR_STATUS_COMPLETED =>'Completed',//hoàn thành
                self::BOOKTOUR_STATUS_DRAFT =>'Draft',
                self::BOOKTOUR_STATUS_CANCELED =>'Canceled'
        );       
    }
    //filter for manager
    public static function getAllStatusFilterManager() {
        return array(               
                self::BOOKTOUR_STATUS_PROCESSING =>'Processing',//điều hành đang xử lý 
                self::BOOKTOUR_STATUS_COMPLETED =>'Completed',//hoàn thành
                self::BOOKTOUR_STATUS_REQUEST =>'Request'//day lai cho sales xu ly
        );       
    }
    public static function getMappdf($row,$width = 0, $height = 0) {           
        $homeurl = 'https://authentiktravel.es/';// Yii::$app->homeUrl;
        $IP =  Yii::$app->getRequest()->getUserIP();
        if ($IP =='::1') {             
             $homeurl = 'http://localhost/authentiktravel.es/';
        }      
        $retUrl = $homeurl.'media/no_img.png';
        if($row->imgmap){
          $retUrl = $homeurl.'media/tour/imgmap/'.$row->imgmap;
        }
        return $retUrl;
    } 
    public static function getPathMapimg($row,$width = 0, $height = 0) {    
        $retUrl = '../../media/no_img.png';
        if($row->imgmap){
          $retUrl = '../../media/tour/imgmap/'.$row->imgmap;
        }
        return $retUrl;
    } 
  //get detail booktour for set manager 
    public static function GetBooktourSetManager($id){
        $model    = Booktour::find()
                            ->where('id =:id  AND status=:status',array(':id'=>$id,':status'=>self::BOOKTOUR_STATUS_PROCESSING))
                            ->one();
        return $model;
   } 
    public static function getDetailBooktour($id){ 
         $model = Booktour::findOne($id);  
      return $model;     
   }
/*****************/ 
/********End Class************/
}