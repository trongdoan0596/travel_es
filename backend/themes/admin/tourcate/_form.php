<?php 
use yii\base\view;
use yii\widgets\ActiveForm; 
use yii\helpers\Html;
use yii\bootstrap\Tabs;
$form = ActiveForm::begin(array(
    'id' => 'tourcate-form',
    'enableClientValidation'=>false,
    'validateOnSubmit' => true, // this is redundant because it's true by default
    'options' =>array(
                    //'class' => 'form-horizontal',
                    'enctype' => 'multipart/form-data'
                 )
));
?>
<?php echo Tabs::widget(array(
        'items' =>array(
                    array(
                        'label' => 'General',
                        'content' =>$this->render('tabs/_general', array('form'=>$form,'model'=>$model,'country'=>$country,'allcate' =>$allcate)),
                        'active' => true
                    ),
                    array(
                        'label' =>Yii::t('app','Orther'),
                        'content' =>$this->render('tabs/_orther', array('form'=>$form,'model'=>$model)),
                    ),
               )
       ));
 ?>
 <hr />
<div class="control-group" style="text-align: center;">
    <div class="controls">
        <?php echo Html::submitButton('Save', array('class' => 'btn btn-primary')); ?>
        <?php echo Html::a('Cancel',array('/seedo/index'), array('class' => 'btn btn-warning')) ?>
    </div>
</div>
<?php
ActiveForm::end();
?>