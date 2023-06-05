<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\City;
//use yii\base\InvalidParamException;
//use yii\web\BadRequestHttpException;
/**
 * City controller
 */
class CityController extends Controller {
    public $layout='main';
    public function Init() {
            $cookies = Yii::$app->response->cookies;
            $lang = Yii::$app->request->get('language',''); 
            if($lang){
                if(isset(Yii::$app->params['languages'][$lang])){
                    Yii::$app->language = $lang;
                    $cookies->add(new \yii\web\Cookie(array('name'  => 'language','value' => $lang)));
                }
            }elseif($cookies->has('language')){
                Yii::$app->language = $cookies->getValue('language');
            }
    }     
    public function actionIndex() {
        $catid  = Yii::$app->request->get('catid',0);
        $rows   = '';$tourcate='';
        if($catid>0){
           $rows = Tour::ListAllTour($catid,6);
           $tourcate = Tourcate::getDetailTourCate($catid);
        }
        return $this->render('index',array(
                'rows' =>$rows,
                'tourcate' =>$tourcate
               ));
    }
   public function actionView() { 
       $id    = Yii::$app->request->get('tid',0);
       $model = Tour::geDetailTour($id);  
       if(!empty($model)){
           $tour_id = $model->id;
           $details = Tourdetail::GetTourdetail($tour_id);
           $hotels  = Tourhotel::GetTourHoteldetail($tour_id);
           $seedos  = Toursee::GetTourSeedetail($tour_id);
           return $this->render('view',array(
                    'model' => $model,
                    'details' => $details,
                    'hotels' => $hotels,
                    'seedos' => $seedos
            ));
       }else{
        //sai chon ngon ngu or country
        //fix 
         /*$language = Yii::$app->request->cookies->getValue('language');
         if($language==''){
            Yii::$app->language='fr';
         }
         */       
         echo $language.'ID không phù hợp';
         die();
       }
	  
            
   }


}
