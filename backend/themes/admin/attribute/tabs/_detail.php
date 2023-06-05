 <?php
 $arr_ids = array();
 if(!empty($attgroup_ids)){
      foreach($attgroup_ids as $row){
         $arr_ids[$row->attribute_group_id] = $row->attribute_group_id;
      } 
 } 
 ?>
 <div class="control-group">
    <div class="controls">
    <ul class="treeview-default treeview">
        <?php
        if(!empty($attgroup)){
            foreach($attgroup as $row){
                $id_group = $row->id;
                $title    = $row->title;
                $checked = '';
                if (in_array ($id_group, $arr_ids)) {
                    $checked = 'checked="checked"';
                }
         ?>
            <li class="collapsable" style="height: 24px;width:280px;float: left;" >
                 <input <?php echo $checked;?> id="cat-<?php echo $id_group;?>" class="tree-cat-cb" type="checkbox" value="<?php echo $id_group;?>" name="Attribute[attgroup_ids][]" />
                 <span class=""><?php echo $title;?></span>
              </li>
         <?php   
          }
        }
        ?>
      </ul>
    </div>
</div>