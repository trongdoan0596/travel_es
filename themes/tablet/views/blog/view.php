<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
//use app\widgets\slidebg\slidesub\Slidesub;
use common\models\User;
use common\helper\StringHelper;
use app\widgets\blog\lastblog\Lastblog;
use app\widgets\blog\catblog\Catblog;
use app\widgets\blog\ortherblog\Ortherblog;
use app\widgets\comment\postcomment\Postcomment;
use app\widgets\comment\listcomment\Listcomment;
use app\widgets\socialshare\Socialshare;
use app\widgets\comment\lastcomment\Lastcomment;
use app\widgets\tour\buttontour\Buttontour;
?>
<?php //echo Slidesub::widget(array('view' =>'index','class_ex'=>'slidesubbg_blog'));?>
<div id="main" class="main-content"> 
      <div class="viewboxblog">     
          <div class="uk-container uk-container-center">   
          <?php             
            if(!empty($model)){      
                $title   = Html::encode($model->title);
                $fulltxt = $model->fulltxt;//str_replace("http://authentikvietnam.com", "https://authentikvietnam.com",$model->fulltxt);//HtmlPurifier::process($model->fulltxt);
                $img     = $model->getImage($model);                
                $date_fr = StringHelper::showDateMfr($model->create_date,1);
                echo Breadcrumbs::widget(array(
                                    'itemTemplate' => "<li>{link}</li>\n", // template for all links
                                    'links' => array(
                                        array(
                                            'label' =>Yii::t('app','Blog'),
                                            'url' => array('blog/index'),//, 'id' => 22
                                            'template' => "<li>{link}</li>\n", // template for this link only
                                        ),  
                                         array(
                                            'label' =>$model->title,
                                            'template' => "<li>{link}</li>\n", 
                                        ),  
                                    ),
                  )); 
                ?>
                <div class="uk-grid">
                    <div class="uk-width-2-3">    
                        <div class="blogcontent">
                            <ul class="uk-list">
                                <li><img class="blogimg" src="<?php echo $img;?>" alt="<?php echo $title;?>" title="<?php echo $title;?>" /></li>
                                <li><h1 class="titleblog"><strong><?php echo $title;?></strong></h1></li>
                                <li class="bypost"><?php echo Yii::t('app','on');?> <?php echo $date_fr;?>   &nbsp&nbsp &nbsp&nbsp   <?php echo Yii::t('app','By');?>: <a href="#"><?php echo User::Getname($model->user_id);?></a></li>
                                <li class="content"><?php echo $fulltxt;?></li>
                            </ul> 
                             <?php echo Buttontour::widget(array('view'=>'index'));?> 
                        </div> 
                        <br />
                        <div class="uk-width-1-1 boxtag">
                            <?php echo Yii::t('app','Tag');?>: 
                            <?php
                              $tags = explode(",",$model->list_tag);                             
                              if(!empty($tags)){
                                    foreach ($tags as $key => $value) {
                                     // $url_ = Url::toRoute(array('blog/index','txttag'=>trim($value)));
                                      $url_=   Url::toRoute(array('blog/index','txttag'=>StringHelper::formatUrlKey(trim($value))));     
                                      echo '<a href="'.$url_.'">'.$value.'</a>';
                                    }                                                          
                              }
                            ?>
                           
                         </div>                         
                        <?php echo Socialshare::widget(array('view'=>'index','url'=>$urlshare));?>  
                        <?php echo Listcomment::widget(array('view'=>'index','ext_id'=>$model->id,'ext_id'=>$model->id,'type'=>'blog'));?>   
                        <?php echo Postcomment::widget(array('view'=>'index','ext_id'=>$model->id,'type'=>'blog'));?>                      
                        <?php echo Ortherblog::widget(array('view'=>'index','catblog_id'=>$model->catblog_id,'blog_id'=>$model->id));?>                    
                    </div>
                     <div class="uk-width-1-3">  
                           <form action="<?php echo Url::toRoute(array('blog/index'));?>"  method="post">
                              <div class="boxsearch">
                              <?php
                              $txtseach = Yii::$app->request->post('txtseach','');
                              ?>
                                    <i class="uk-icon-search"></i><input type="text" name="txtseach" id="txtseach" value="<?php echo $txtseach;?>" placeholder="Search" />  
                              </div>      
                          </form>                         
                          <?php echo Catblog::widget(array('cat_id'=>$model->catblog_id,'view' =>'index'));?> 
                          <?php echo Lastblog::widget(array('view' =>'index','model'=>$model));?>
                          <?php echo Lastcomment::widget(array('view' =>'index'));?> 
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