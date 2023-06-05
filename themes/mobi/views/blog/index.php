<?php
use yii\helpers\Html;
//use yii\helpers\HtmlPurifier;
//use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\Breadcrumbs;
use app\widgets\slidebg\slidesub\Slidesub;
?>
<?php //echo Slidesub::widget(array('view' =>'index','class_ex'=>'slidesubbg_blog'));?>
<div id="main" class="main-content"> 
      <div class="boxblog">  
               <?php  
                if(!empty($rows)){    
                          $title = Yii::t('app','Blog de viajes Vietnam');
                          echo Breadcrumbs::widget(array(
                                    'itemTemplate' => "<li>{link}</li>\n", // template for all links
                                    'links' => array(
                                        array(
                                            'label' => $title,
                                            'url' => array('blog/index'),//, 'id' => 22
                                            'template' => "<li>{link}</li>\n", // template for this link only
                                        ),  
                                    ),
                           )); 
                           
                            ?>
                            <div class="listitem">
                            <?php
                            foreach($rows as $row){  
                                 echo $this->render('_item',array('row'=>$row));
                            } 
                            ?>
                            </div>                           
                            <?php
                             if(!empty($pages)){
                            ?>
                            <center>
                                <div class="uk-container uk-container-center listpages" align="center" style="display: inline-block;">
                                       <?php
                                           echo LinkPager::widget(array(
                                                    'pagination' =>$pages,
                                                    'firstPageLabel' => '<i class="uk-icon-angle-double-left"></i>',
                                                    'lastPageLabel' => '<i class="uk-icon-angle-double-right"></i>',
                                                    'prevPageLabel' => '<i class="uk-icon-angle-left"></i>',
                                                    'nextPageLabel' => '<i class="uk-icon-angle-right"></i>',
                                                    'maxButtonCount' => 5,
                                                    'options' =>array(
                                                                        'class' => 'pagination listpages',
                                                                        'id' => 'pager-container',
                                                                    ),
                                                     'linkOptions' =>array('class' => 'mylink'),
                                                    
                                                ));
                                         ?>
                                     </div>
                              </center>       
                              <br />
                            <?php
                               }
                            ?> 
                            <?php     
                }
                ?>
     </div>
</div>       