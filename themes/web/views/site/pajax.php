<?php
use yii\widgets\Pjax;
?>
Test Pjax : <?php
Pjax::begin(['id' => 'boxPajax']);
    <a>some html<a>
Pjax::end();
?>