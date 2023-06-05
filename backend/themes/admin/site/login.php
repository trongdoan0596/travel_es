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
    <div class="uk-container uk-container-center">
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
                        <h2 class="uk-text-bold" >Administration </h2>
                    </div>
                    <div class="uk-form-row">
                    	<?= $form->field($model,'username')->textInput(array('class' => 'form-control','placeholder'=>'Username'))->label(false) ?>
                   </div>
                   <div class="uk-form-row">
                      <?= $form->field($model, 'password')->passwordInput(array('class' =>'form-control','placeholder'=>'Password'))->label(false) ?>
                   </div>                             
                   <div class="uk-form-row uk-grid">
                        <div class="uk-width-1-2">
                          <?= $form->field($model, 'rememberMe')->checkbox() ?>
                        </div>
                        <div class="uk-form-row uk-width-1-2" style="padding-left:40px;">
                          <?php echo Html::submitButton('Login',array('class' =>'btn uk-button-primary', 'name' => 'login-button','style'=>'height: 30px;')) ?>
                       </div>
                   </div>
                  
            </div>
             <?php ActiveForm::end(); ?>
        </div>
    </div>

</main>