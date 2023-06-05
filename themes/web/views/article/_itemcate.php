<?php
use common\models\Article;
?>
<div class="guidevoyageitem">    
     <div class="border-top-left"> 
            <h1><?php echo $row->title;?></h1>         
            <div id="accordion_<?php echo $row->id;?>" class="uk-accordion" data-uk-accordion="{showfirst:<?php echo $showfirst;?>}" >             
           <?php
              $items = Article::getListArticle($row->id,'ordering asc');
              if(!empty($items)){
                     $n = count($items);
                      $i=1;
                      foreach($items as $item){  
                             $clss="";
                             if($i==$n) $clss="lastitem";
                             echo $this->render('_item_accordion',array('row'=>$item,'clss'=>$clss,'cate'=>$row));  
                             $i++;                   
                       }
              }          
              ?> 
             </div>
       </div>        
</div>      