<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<main class="main-content">
    <div class="page-wrapper">
      <div class="page-inner bg-brand-gradient">
        <div class="page-content-wrapper bg-transparent m-0">
          <div class="box-login uk-container-center" style="margin-top: 100px;">
             <?php $form = ActiveForm::begin(
                    array('id' => 'login-form1',
                          'enableClientValidation'=>false,
                          'validateOnSubmit' => true,
                          'options' =>array(
                              'class' => 'uk-form'
                           )
                         )
                   ); 
             ?>
              <div class="row-fluid">
                      <div class="head">
                          <h2 class="uk-text-bold" >Administration Login</h2>
                      </div>
                      <div class="uk-form-row">
                        <?= $form->field($model,'username')->textInput(array('class' => 'form-control','placeholder'=>'Username'))->label(false) ?>
                     </div>
                     <div class="uk-form-row">
                        <?= $form->field($model, 'password')->passwordInput(array('class' =>'form-control','placeholder'=>'Password'))->label(false) ?>
                     </div>
                     <div class="uk-form-row uk-grid" style="margin-left:unset">
                          <div class="uk-width-1-2 d-none">
                            <?= $form->field($model, 'rememberMe')->checkbox() ?>
                          </div>
                          <div class="uk-form-row uk-width-1-2" style="margin:0 auto;padding:0">
                            <?php echo Html::submitButton('Login',array('class' =>'btn uk-button-primary btn_login', 'name' => 'login-button','style'=>'height: 30px;width: 100%;height: 50px;color: #fff;')) ?>
                         </div>
                     </div>
                    
              </div>
               <?php ActiveForm::end(); ?>
          </div>
        </div>
      </div>
    </div>

</main>