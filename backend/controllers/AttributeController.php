<?php
namespace backend\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\Attribute;
use common\models\Attributegroup;
use common\models\AttributeRel;
use common\models\Attributeoption;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
class AttributeController extends Controller {
    public $layout='main';
    public function Init() {
           if(Yii::$app->user->getIsGuest()){
              return Yii::$app->response->redirect(array('site/login'));     
              die('Error!');
           }
     }
    public function behaviors() {
        return array(
            'access' =>  array(
                'class' => AccessControl::className(),
                'rules' => array(
                   array(
                        'actions' => array('error'),
                        'allow' => true,
                    ),
                    array(
                        'actions' =>array('index','create','update','delete'),
                        'allow' => true,
                        'roles' =>array('@'),
                    ),
                ),
            ),
            'verbs' => array(
                'class' => VerbFilter::className(),
                'actions' =>  array(
                    'logout' => array('post'),
                ),
            ),
        );
    }

    public function actions()  {
        return array(
            'error' => array(
                'class' => 'yii\web\ErrorAction',
            ),
        );
    }

 public function actionIndex() {      
         $model = new Attribute();   
         $dataProvider = $model->search(Yii::$app->request->get());         
        return $this->render('index',array('model' =>$model,'dataProvider' => $dataProvider));
    }
  //create
  public function actionCreate() {
        $model = new Attribute();
        $post  = Yii::$app->request->post();
	    if ($model->load($post)) {  
            $model->attributes  = $post['Attribute'];
            //kiem tra xem ma code da ton tai chua,neu co ko add vao nua
            $chk = Attribute::ChkAttCode($post['Attribute']['code']);
            if(!empty($chk)){
                echo "Ma Code da ton tai!";
                die();
             }
            if ($model->save()) {
                     $id = $model->id;
                     /******Tab Attribute group******/
                     if (array_key_exists("attgroup_ids",$post['Attribute'])) {
                           //co chon attgroup_ids
                            $attgroup_ids =$post['Attribute']['attgroup_ids'];                   
                            for ($i=0;$i<count($attgroup_ids);$i++){
                                 $group_id = $attgroup_ids[$i];
                                 AttributeRel::AddAttRel($group_id,$id);
                            }
                     }
                     /****End Tab Attribute group*****/
                     /******Tab Attribute option******/
                    //kiem tra gia tri cua attibute option
                     if (array_key_exists("value",$post['Attribute'])) {
                         $options = $post['Attribute']['value'];
                         $opt_new = array();
                         while (list($key, $value) = each ($options)) {
                                 $value_opt = $value;
                                 $order   = $post['Attribute']['order'][$key];
                                 $extend  = $post['Attribute']['extend'][$key];
                                 $id_opt  = Attributeoption::AddAttRel($id,$value_opt,$extend,$order);
                                 if (array_key_exists("default",$post['Attribute'])) {
                                    $default = $post['Attribute']['default'];
                                    if($default==$key){
                                        $model->default_value = $id_opt;
                                        $model->update();
                                    }
                                 }
                                
                             }
                     }
            /****End Tab Attribute option*****/
                     
                $this->redirect(array('update', 'id' => $model->id));
            }
        }
        $attgroup = Attributegroup::ListAttGroup();//tat ca ca thuoc tinh group
        $attgroup_ids  = array();
        $attoption_ids = array();
        return $this->render('create', array(
            'model' => $model,
            'attgroup' =>$attgroup ,
            'attgroup_ids' =>$attgroup_ids,
            'attoption_ids' =>$attoption_ids        
        ));
    }
 //update
  public function actionUpdate($id) {
       $model = $this->loadModel($id);
       $post  = Yii::$app->request->post();
       if(!empty($model)) $code_old =  $model->code;//code ko dc thay doi
	   if ($model->load($post)){  
             $model->attributes = $post['Attribute'];
             /******Tab Attribute group******/
             $rows = AttributeRel::ListAttRelID($id);
             $group_arr =array();
             if(!empty($rows)){
                  foreach($rows as $row){
                     $group_arr[$row->attribute_group_id] = $row->attribute_group_id;
                  } 
             } 
             if (array_key_exists("attgroup_ids",$post['Attribute'])) {
                   //co chon attgroup_ids
                    $attgroup_ids =$post['Attribute']['attgroup_ids'];                   
                    for ($i=0;$i<count($attgroup_ids);$i++){
                        $group_id = $attgroup_ids[$i];
                        if (!in_array ($group_id, $group_arr)) {                            
                            AttributeRel::AddAttRel($group_id,$id);
                        }
                    }
                   $arr_del = array_diff ($group_arr,$attgroup_ids);//tra ve neu co là các id can loai bo
                   if(count($arr_del)){
                     while (list($key, $value) = each ($arr_del)) {
                         AttributeRel::DelAttRelID($value,$id);
                     }
                  }
             }else{
               //delete cac lua chon old di
                if(count($group_arr)){
                     while (list($key, $value) = each ($group_arr)) {
                         AttributeRel::DelAttRelID($value,$id);
                     }
                  }     
             }
             /****End Tab Attribute group*****/
             /******Tab Attribute option******/
            //kiem tra gia tri cua attibute option
             $rs = Attributeoption::ListAttOptionID($id);
             $opt_arr =array();
             if(!empty($rs)){
                  foreach($rs as $row){
                     $opt_arr[$row->value] = $row->value;
                  } 
             } 
             if (array_key_exists("value",$post['Attribute'])) {
                 $options = $post['Attribute']['value'];
                 $opt_new = array();
                 while (list($key, $value) = each ($options)) {
                         $value_opt = $value;
                         $opt_new[$value] = $value;
                         if (!in_array ($value_opt, $opt_arr)) {                            
                             $order   = $post['Attribute']['order'][$key];
                             $extend  = $post['Attribute']['extend'][$key];
                             $id_opt  = Attributeoption::AddAttRel($id,$value_opt,$extend,$order);
                             if (array_key_exists("default",$post['Attribute'])) {
                                $default = $post['Attribute']['default'];
                                if($default==$key){
                                    $model->default_value = $id_opt;
                                }
                             }
                        }else{
                            //co trong db roi,xem co chon defaul value ko
                            if (array_key_exists("default",$post['Attribute'])) {
                                $default = $post['Attribute']['default'];//option_7
                                if($default !=""){
                                   $model->default_value = substr($default,7);
                                }
                             }
                        }
                     }
                   $arr_optdel = array_diff ($opt_arr,$opt_new);//tra ve neu co là các id can loai bo
                   if(count($arr_optdel)){
                     while (list($key, $value) = each ($arr_optdel)) {
                         $id_del = Attributeoption::DelAttOptID($id,$value);
                         if($id_del==$model->default_value) $model->default_value = 0;
                     }
                  }   
             }else{
                 if(count($opt_arr)){
                     while (list($key, $value) = each ($opt_arr)) {
                         Attributeoption::DelAttOptID($value,$id);
                     }
                     $model->default_value = 0;
                  }   
             } 
            /****End Tab Attribute option*****/
           $model->code = $code_old;
           $model->update();
       }else{
          
       }  
      $attgroup = Attributegroup::ListAttGroup();
      $attgroup_ids  = AttributeRel::ListAttRelID($id);
      $attoption_ids = Attributeoption::ListAttOptionID($id);
      return $this->render('update', array(
            'model' => $model,
            'attgroup' =>$attgroup,
            'attgroup_ids' =>$attgroup_ids,
            'attoption_ids' =>$attoption_ids     
        ));
    }
public function actionDelete($id) {
         $model = $this->loadModel($id);
         $model->delete();
        return $this->redirect(array('index'));
    }
public function loadModel($id) {
        $model = Attribute::findOne($id);       
        if ($model === null)
             throw new \yii\web\NotFoundHttpException;
        return $model;
    } 
}