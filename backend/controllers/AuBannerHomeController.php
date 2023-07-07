<?php

namespace backend\controllers;

use Yii;
use common\models\BannerHome;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AuBannerHomeController implements the CRUD actions for AuBannerHome model.
 */
class AuBannerHomeController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AuBannerHome models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => BannerHome::find(),
        ]);
        
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BannerHome model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BannerHome model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BannerHome();
        if ($model->load(Yii::$app->request->post())) {
            $model->path = UploadedFile::getInstance($model,'path');

            if(!empty($model->path)){      
                if($model->path->type == 'video/mp4')
                    $model->type = 2;
                else
                    $model->type = 1;
                    
                $path         = substr(Yii::$app->basePath,0,-7).'/media/banner/'; 
                $file_name = "file_".rand();
                $model->path->saveAs($path.$file_name.'.'.$model->path->extension);
                $model->path = 'media/banner/'.$file_name.'.'.$model->path->extension;
                $model->create = date('y-m-d H:i:s');
            }
            $model->save(false);
            Yii::$app->session->setFlash('success', "Tạo banner thành công.");
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing BannerHome model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            // $model->path = UploadedFile::getInstance($model,'path');
            $model->status = Yii::$app->request->post()['BannerHome']['status'];
            $model->position = Yii::$app->request->post()['BannerHome']['position'];
            // if(!empty($model->path)){      
            //     if($model->path->type == 'video/mp4')
            //         $model->type = 2;
            //     else
            //         $model->type = 1;
                    
            //     $path         = substr(Yii::$app->basePath,0,-7).'/media/banner/'; 
            //     $file_name = "file_".rand();
            //     $model->path->saveAs($path.$file_name.'.'.$model->path->extension);
            //     $model->path = '/media/banner/'.$file_name.'.'.$model->path->extension;
            //     $model->create = date('y-m-d H:i:s');
            // }
            $model->save(false);
            Yii::$app->session->setFlash('success', "Cập nhật thành công.");
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing BannerHome model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BannerHome model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BannerHome the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BannerHome::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
