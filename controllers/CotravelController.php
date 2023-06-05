<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Article;
//use yii\base\InvalidParamException;
//use yii\web\BadRequestHttpException;
/**
 * Article controller
 */
class ArticleController extends Controller {
    public $layout='main';
   public function actions()  {
        return array(
            'error' => array(
                'class' => 'yii\web\ErrorAction',
            ),
        );
    }
    public function actionIndex() {
        return $this->render('index');
        
    }
   public function actionView() {       
       $id    = Yii::$app->request->get('id',0);
       $model = Article::getDetailArticle($id);//Article::findOne($id);       
	   return $this->render('view',array(
            'model' => $model
            ));
   }
    public function actionError() {
        return $this->render('error');
    } 
    

}
