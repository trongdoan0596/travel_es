<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\widgets\slidebg\slidesub\Slidesub;
use common\models\Article;
?>
<?php //echo Slidesub::widget(array('view' =>'index','class_ex'=>'slidesubbg_aboutus'));?>
<div id="main" class="main-content1"> 
      <div class="listourteam">   
          <?php             
            if(!empty($rows)){    
                   $info = Article::getDetailArticle(100);
                   $fulltxt= "";$title="";
                   if(!empty($info)){
                      $fulltxt = HtmlPurifier::process($info->fulltxt);
                      $title    = Html::encode($info->title);
                   }
                       
                 echo Breadcrumbs::widget(array(
                            'itemTemplate' => "<li>{link}</li>\n", // template for all links
                            'links' => array(
                                array(
                                    'label' => $title,
                                    'url' => array('ourteam/indexfr'),//, 'id' => 10
                                    'template' => "<li>{link}</li>\n", // template for this link only
                                ),
                               
                                
                            ),
                   ));                 
                ?>  
                  <div class="boxitem"> 
                         <h1 class="uk-text-center"><?php echo $title;?></h1>
                         <div class="introtxt">
                             <div class="txt">
                               <?php echo $fulltxt;?>                              
                              </div>
                         </div>
                          <div class="listitem"> 
                         <?php
                              foreach($rows as $row){                          
                                     $title = $row->title;
                                     $url   = $row->createUrl($row);
                                     $img   = $row->getImage($row);
                                     $profession = $row->profession;
                                     $introtxt = $row->introtxt;
                                     ?>
                                      <div class="boxitemteam">                                           
                                               <dl class="uk-text-center boximg">
                                                    <a class="hover-effect-circle" href="<?php echo $url;?>">
                                                        <img class="uk-border-circle" src="<?php echo $img;?>" alt="<?php echo $title;?>" />
                                                     </a>
                                                </dl>  
                                                <dl class="content">
                                                        <dt class="uk-text-center"><a href="<?php echo $url;?>"><?php echo $title;?></a></dt>
                                                        <dd class="uk-text-center titlejob"><?php echo $profession;?></dd>
                                                        <dd class="uk-text-center introtxt"><?php 
                                                        if($introtxt !=""){
                                                             echo $introtxt;
                                                        }                                                            
                                                       ?></dd>
                                                 </dl>
                                         </div> 
                                  <?php
                                }
                              ?> 
                         </div>
                </div>
           <?php
             }else{
                echo "Updating!";
             }
           ?> 
     </div>
</div>       