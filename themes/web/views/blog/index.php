<?php
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
//use yii\helpers\Url;
use common\models\Blogcate;
use yii\widgets\LinkPager;
use yii\widgets\Breadcrumbs;
//use app\widgets\slidebg\slidesub\Slidesub;
use app\widgets\blog\catblog\Catblog;
use app\widgets\blog\lastblog\Lastblog;
use app\widgets\comment\lastcomment\Lastcomment;
?>
<?php //echo Slidesub::widget(array('view' =>'index','class_ex'=>'slidesubbg_blog'));?>
<div id="main" class="main-content"> 
      <div class="boxblog">     
            <div class="uk-container uk-container-center">  
              <?php  
                if(!empty($rows)){    
                       $title = Yii::t('app','Blog de viajes Vietnam');
                       $listpath[] = array(
                                            'label' => $title,
                                            'url' => array('blog/index'),//, 'id' => 22
                                            'template' => "<li>{link}</li>\n", // template for this link only
                                        );
                       if(!empty($infocate)){
                           $path = $infocate->path;                          
                           $arr = explode("/",$infocate->path);
                           if(count($arr)){
                               for($i=1;$i<count($arr);$i++){
                                      $infopath= Blogcate::getDetailBlogcate($arr[$i]);
                                      if(!empty($infopath)){
                                               $url_ = Blogcate::createUrl($infopath);
                                               $listpath[] = array(
                                                    'label' =>$infopath->title,
                                                    'url' =>$url_,//, 'id' => 22
                                                    'template' => "<li>{link}</li>\n", // template for this link only
                                              );
                                      }
                                      
                                
                               }
                           }

                           
                       }
                         
                          echo Breadcrumbs::widget(array(
                                    'itemTemplate' => "<li>{link}</li>\n", // template for all links
                                    'links' => $listpath
                           ));                           
              ?>
              <div class="uk-grid">
                       <div class="uk-width-2-3">  
                               <div class="listitemblog">
                                   <?php
                                      // Pjax::begin();
                                       if(!empty($info) && $cid==0){
                                          $fulltxt  = $info->fulltxt;//HtmlPurifier::process($info->fulltxt);
                                          $title    = Html::encode($info->title);
                                          //$img_head = $info->getImage($info);
                                         
                                          ?>
                                          <div class="boxinfo" style="margin-top: -8px !important;">
                                             <h1 class="title" style="background: none !important;"><?php echo $title;?></h1>
                                             <div class="introtxt" style="background: none !important;padding-right:24px;padding-top: 0px; padding-left: 0px !important;"><?php echo $fulltxt;?></div>                                          
                                          </div>
                                          <?php
                                             
                                       }                    
                                        $i=0;
                                        foreach($rows as $row){  
                                             echo $this->render('_item',array('row'=>$row));  
                                             $i++;                
                                        } 
                                    ?>
                                     <?php
                                         if(!empty($pages)){
                                         ?>
                                            <div class="uk-clearfix uk-container-center listpages" align="center">
                                                   <?php
                                                       echo LinkPager::widget(array(
                                                                'pagination' =>$pages,                                                   
                                                                'options' =>array(                                                                      
                                                                                    'class' => 'pagination listpages',
                                                                                    'id' => 'pager-container',
                                                                                )
                                                                
                                                            ));
                                                     ?>
                                             </div>
                                           <?php
                                              }
                                 // Pjax::end();            
                                           ?> 
                               </div>
                        </div>
                        <div class="uk-width-1-3 boxright" style="margin-top: 6px !important;">   
                          <form action="<?php echo Url::toRoute(array('blog/index'));?>"  method="post">
                              <div class="boxsearch">
                                <?php
                                  $txtseach = Yii::$app->request->post('txtseach','');
                                ?>
                                <i class="uk-icon-search"></i><input type="text" name="txtseach" id="txtseach" value="<?php echo $txtseach;?>" placeholder="Buscar" />  
                              </div>      
                          </form>                         
                          <?php echo Catblog::widget(array('cat_id'=>$cid,'view' =>'index'));?>   
                          <?php echo Lastblog::widget(array('view' =>'indexcate'));?>      
                          <?php echo Lastcomment::widget(array('view' =>'index'));?> 
                        </div>
              </div>              
              <?php }else{
                echo '<br />Updating';
              } ?>
            
            </div>
       </div>
</div>       