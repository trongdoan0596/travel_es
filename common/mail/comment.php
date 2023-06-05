<?php
if($admin==1){
    echo Yii::t('app', 'Have a new comment').'<br />';
   // echo $model->title.'<br />';
    echo 'IP:'.$model->ip.'<br />';
    echo 'Create date:'.$model->create_date.'<br />';
}
?>