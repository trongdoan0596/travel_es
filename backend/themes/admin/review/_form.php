<?php 
use yii\base\view;
use yii\widgets\ActiveForm; 
use yii\helpers\Html;
use yii\bootstrap\Tabs;
$form = ActiveForm::begin(array(
    'id' => 'review-form',
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
                'content' =>$this->render('tabs/_general', array('form'=>$form,'model'=>$model,'account'=>$account,'itemimg' =>$itemimg,'imgdefault' =>$imgdefault)),
                'active' => true
            ),
            /*array(
                'label' =>Yii::t('app','What to do ?'),
                'content' =>$this->render('tabs/_todo', array('form'=>$form,'model'=>$model)),
            ),
            array(
                'label' =>Yii::t('app','Where to eat ?'),
                'content' =>$this->render('tabs/_toeat', array('form'=>$form,'model'=>$model)),
            ),
           array(
                'label' =>Yii::t('app','Festivals'),
                'content' =>$this->render('tabs/_festivals', array('form'=>$form,'model'=>$model)),
            ),
            array(
                'label' =>Yii::t('app','Photos'),
                'content' =>$this->render('tabs/_photo', array('form'=>$form,'model'=>$model)),
            ),
            array(
                'label' =>Yii::t('app','Video'),
                'content' =>$this->render('tabs/_video', array('form'=>$form,'model'=>$model)),
            ),
            array(
                'label' =>Yii::t('app','Map'),
                'content' =>$this->render('tabs/_map', array('form'=>$form,'model'=>$model)),
            ),*/
             array(
                'label' =>Yii::t('app','Orther'),
                'content' =>$this->render('tabs/_orther', array('form'=>$form,'model'=>$model)),
            ),
       )
       )
       );
 ?>
 <hr />
<div class="control-group" style="text-align: center;">
    <div class="controls">
        <?php echo Html::submitButton('Save', array('class' => 'btn btn-primary')); ?>
        <?php echo Html::a('Cancel',array('/review/index'), array('class' => 'btn btn-warning')) ?>
    </div>
</div>
<?php
ActiveForm::end();
?>