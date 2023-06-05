<?php
use yii\base\view;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
//$this->pageTitle = "Tạo mới Banner";
?>
<h1 class="title-page">Add new</h1>
<?php
echo $this->render('_form', array('model'=>$model));
?>