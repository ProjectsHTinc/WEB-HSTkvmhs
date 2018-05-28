<style>
.col-md-2{
    width: 13%;
}
</style>
<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
	  <?php if(empty($cls_view)){  }else{ ?>
	  <div class="row">
            <div class="col-md-12">
               <div class="card">
                  <div class="header">
                     <h4 class="title"> Class Name </h4>
                  </div>
                  <div class="content">
                     <div class="row">
                        <?php 
                            foreach($cls_view as $rows)
                              {
                           	 $cls_id=$rows->class_id;
                           	 $clsname=$rows->class_name;
                           	?>
                        <div class="col-md-2">
                           <a href="<?php echo base_url();?>rank/get_all_rank/<?php echo $cls_id; ?>/<?php echo $examid; ?>" class="btn btn-wd"><?php echo $clsname; ?></a>
                        </div>
                        <?php  } } ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
