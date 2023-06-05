<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
 <div class="section white-bg boxhome">
                <div class="container">
                    <div class="row">
                    <?php
                       if(!empty($rows)){
                        ?>
                        <div class="col-sm-6" >
                                <h2>Last news</h2>
                                <div class="toggle-container box" id="accordion1">
                                <?php
                                  $i=1;
                                  foreach($rows as $row){
                                        $id       = $row->id;
                                        $title    = Html::encode($row->title);
                                        $introtxt = HtmlPurifier::process($row->introtxt);
                                        //$url      = $row->createUrl($row);
                                        ?>
                                         <div class="panel style1">
                                                <h5 class="panel-title">
                                                    <a class="collapsed" href="#acc<?php echo $i;?>" data-toggle="collapse" data-parent="#accordion1"><?php echo $title;?></a>
                                                </h5>
                                                <div class="panel-collapse collapse" id="acc<?php echo $i;?>">
                                                    <div class="panel-content">
                                                       <?php echo $introtxt;?>
                                                    </div><!-- end content -->
                                                </div>
                                          </div>
                                        <?php
                                        $i++;
                                     } ?>
                               
                                </div>
                            </div>
                        <?php 
                        }
                        ?>
                        
                        <div class="col-sm-6" >
                            <h2>Testimonial</h2>
                            <div class="testimonial style1 box">
                                <ul class="slides ">
                                    <li>
                                        <p class="description">This is the 3rd time I’ve used Travelo website and telling you the truth their services are always realiable and it only takes few minutes to plan and finalize your entire trip using their extremely fast website and up to date listings. I’m super excited about my next trip to Paris.</p>
                                        <div class="author clearfix">
                                            <a href="#"><img src="<?php echo Url::base();?>/themes/web/images/team/jessica.png" alt="" width="74" height="74" /></a>
                                            <h5 class="name">Jessica Brown<small>guest</small></h5>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="description">This is the 3rd time I’ve used Travelo website and telling you the truth their services are always realiable and it only takes few minutes to plan and finalize your entire trip using their extremely fast website and up to date listings. I’m super excited about my next trip to Paris.</p>
                                        <div class="author clearfix">
                                            <a href="#"><img src="<?php echo Url::base();?>/themes/web/images/team/david.png" alt="" width="74" height="74" /></a>
                                            <h5 class="name">Lisa Kimberly<small>guest</small></h5>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="description">This is the 3rd time I’ve used Travelo website and telling you the truth their services are always realiable and it only takes few minutes to plan and finalize your entire trip using their extremely fast website and up to date listings. I’m super excited about my next trip to Paris.</p>
                                        <div class="author clearfix">
                                            <a href="#"><img src="<?php echo Url::base();?>/themes/web/images/team/kyle.png" alt="" width="74" height="74" /></a>
                                            <h5 class="name">Jessica Brown<small>guest</small></h5>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
</div>