<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\widgets\slidebg\slidesub\Slidesub;
use common\models\Article;
?>
<?php echo Slidesub::widget(array('view' =>'index','class_ex'=>'slidesubbg_aboutus'));?>
<div id="main" class="main-content"> 
      <div class="listourteam">     
          <div class="uk-container uk-container-center">   
          <?php             
            if(!empty($rows)){    
                   $info = Article::getDetailArticle(100);
                   $fulltxt= "";$title="";
                   if(!empty($info)){
                      $fulltxt = HtmlPurifier::process($info->fulltxt);
                      $title   = $info->title;//Html::encode($info->title);
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
                         <h1><?php echo $title;?></h1>
                         <div class="introtxt">
                             <div class="txt">
                               <?php echo $fulltxt;?>                              
                              </div>
                         </div>
                         <div class="listitem">
                            <div class="uk-grid">
                         <?php
                              foreach($rows as $row){                          
                                     $title = $row->title;
                                     $url   = $row->createUrl($row);
                                     $img   = $row->getImage($row);
                                     $profession = $row->profession;
                                     $introtxt = $row->introtxt;
                                     ?>
                                      <div class="uk-width-1-4">
                                         <div class="boxitemteam">
                                             <ul class="uk-list">
                                               <li>
                                                    <a class="hover-effect-circle boximg" href="<?php echo $url;?>">
                                                        <img class="uk-border-circle" src="<?php echo $img;?>" alt="<?php echo $title;?>" />
                                                     </a>
                                                        <dl>
                                                            <dt class="uk-text-center"><a href="<?php echo $url;?>"><?php echo $title;?></a></dt>
                                                            <dd class="uk-text-center titlejob"><?php echo $profession;?></dd>
                                                            <dd class="uk-text-center introtxt"><?php 
                                                            if($introtxt !=""){
                                                                 echo $introtxt;
                                                            }
                                                            
                                                           ?></dd>
                                                        </dl>                  
                                                 </li>
                                             </ul>
                                         </div>                
                                      </div>  
                                  <?php
                                }
                              ?>           
                             </div>
                         </div>
                </div>
           <?php
             }else{
                echo "Updating!";
             }
           ?>        
          </div>
     </div>
</div>       