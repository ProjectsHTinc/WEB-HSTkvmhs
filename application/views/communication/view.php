<style>
   td
   {
   text-align: left;
   }
   button.btn.dropdown-toggle.btn-default {
   width:100%;
   }
   .btn-group.bootstrap-select{
	   padding-top: 10px;
   }
</style>
<div class="main-panel">
   <div class="content">
      <?php if($this->session->flashdata('msg')): ?>
      <div class="alert alert-success">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
         ×</button> <?php echo $this->session->flashdata('msg'); ?>
      </div>
      <?php endif; ?>
      <div class="content">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
                  <div class="card">
                     <div class="content">
                        <h4 class="title">Circular Details</h4>
                        <div class="fresh-datatables">
                           <table id="bootstrap-table" class="table">
                              <thead>
                                 <th data-field="id" class="text-left">S.No</th>
                                 <th data-field="year"  class="text-left"  data-sortable="true">Title</th>
                                  
                                 <th data-field="name"  class="text-left" data-sortable="true">DATE</th>
								 <th data-field="mobile"  class="text-left" data-sortable="true">TEACHERS & CLASS</th> 
                                 
                                 
                                 <th data-field="Section" class="text-left"  data-sortable="true">Action</th>
                              </thead>
                              <tbody>
                                 <?php
                                    $i=1;
                                    foreach ($result as $rows) {
                                          //echo $rows->commu_id;
                                    ?>
                                 <tr>
                                    <td class="text-left"><?php echo $i; ?></td>
                                    <td class="text-left"><?php echo $rows->commu_title;  ?></td>
                                   <!-- <td class="text-left"><?php// echo $rows->commu_details;?></td>-->
                                    <td class="text-left"><?php $date=date_create($rows->commu_date);
                                       echo date_format($date,"d-m-Y");
                                       ?></td>
									 <?php $tid=$rows->teacher_id; $cid=$rows->class_id;
									 
									 //echo $tid; echo $cid;
									?>
						
									  <?php if($tid!='null' && $cid!='null'){?>
									   <td>
									  <select  data-title="Select More Than one class" style="width:300px;" name="multiple-class" class="selectpicker" >
                                       <?php
                                          $sPlatform=$rows->class_id;
                                          $sQuery = "SELECT c.class_name,s.sec_name,cm.class_sec_id,cm.class FROM edu_class AS c,edu_sections AS s ,edu_classmaster AS cm WHERE cm.class = c.class_id AND cm.section = s.sec_id ORDER BY c.class_name";
                                          $objRs=$this->db->query($sQuery);
                                          //print_r($objRs);
                                          $row=$objRs->result();
                                          foreach ($row as $rows1)
                                          {
                                          $s= $rows1->class_sec_id;
                                          $sec=$rows1->class;
                                          $clas=$rows1->class_name;
                                          $sec_name=$rows1->sec_name;
                                          $arryPlatform = explode(",", $sPlatform);
                                          $sPlatform_id  = trim($s);
                                          $sPlatform_name  = trim($sec);
                                          if (in_array($sPlatform_id, $arryPlatform )) {
                                              echo "<option  value=\"$sPlatform_id\" selected  />$clas-$sec_name</option>";
                                                 }
                                                        }
                                              ?>
                                       </select>
									 
									     <select  class="selectpicker form-control" data-title="Select More Than one Teacher" name="multiple-teacher" >
                                       <?php
                                          $tea_name=$rows->teacher_id;
                                          $sQuery = "SELECT * FROM edu_teachers";
                                          $objRs=$this->db->query($sQuery);
                                          $row=$objRs->result();
                                          foreach ($row as $rows1)
                                          {
											  $s=$rows1->teacher_id;
											  $sec=$rows1->name;
											  $arryPlatform = explode(",",$tea_name);
											  $sPlatform_id  = trim($s);
											  $sPlatform_name  = trim($sec);
											  if (in_array($sPlatform_id, $arryPlatform ))
											  {
												  ?>
										   <?php
											  echo "<option  value=\"$s\" selected  /> $sec</option>";
											  }
                                          }
                                              ?>
                                       </select></td>
									  <?php }elseif($tid=='null' && $cid!='null'  ){?>	
                                   <td>
                                       <select  data-title="Select More Than one class"  name="multiple-class" class="selectpicker" >
                                       <?php
                                          $sPlatform=$rows->class_id;
                                          $sQuery = "SELECT c.class_name,s.sec_name,cm.class_sec_id,cm.class FROM edu_class AS c,edu_sections AS s ,edu_classmaster AS cm WHERE cm.class = c.class_id AND cm.section = s.sec_id ORDER BY c.class_name";
                                          $objRs=$this->db->query($sQuery);
                                          //print_r($objRs);
                                          $row=$objRs->result();
                                          foreach ($row as $rows1)
                                          {
                                          $s= $rows1->class_sec_id;
                                          $sec=$rows1->class;
                                          $clas=$rows1->class_name;
                                          $sec_name=$rows1->sec_name;
                                          $arryPlatform = explode(",", $sPlatform);
                                          $sPlatform_id  = trim($s);
                                          $sPlatform_name  = trim($sec);
                                          if (in_array($sPlatform_id, $arryPlatform )) {
                                              echo "<option  value=\"$sPlatform_id\" selected  />$clas-$sec_name</option>";
                                                 }
                                                        }
                                              ?>
                                       </select></td>
									  <?php }else{ ?>
								<td>
								      <select class="selectpicker form-control" data-title="Select More Than one Teacher" name="multiple-teacher" >
                                       <?php
                                          $tea_name=$rows->teacher_id;
                                          $sQuery = "SELECT * FROM edu_teachers";
                                          $objRs=$this->db->query($sQuery);
                                          $row=$objRs->result();
                                          foreach ($row as $rows1)
                                          {
											  $s=$rows1->teacher_id;
											  $sec=$rows1->name;
											  $arryPlatform = explode(",",$tea_name);
											  $sPlatform_id  = trim($s);
											  $sPlatform_name  = trim($sec);
											  if (in_array($sPlatform_id, $arryPlatform ))
											  {
												  ?>
										   <?php
											  echo "<option  value=\"$s\" selected  /> $sec</option>";
											  }
                                          }
                                              ?>
                                       </select>
									   </td>
									  <?php } ?>			   

                                    <td>
                                       <a href="<?php echo base_url(); ?>communication/edit_commu/<?php echo $rows->commu_id;; ?>" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
                                    </td>
                                 </tr>
                                 <?php $i++;  }  ?>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <!-- end content-->
                  </div>
                  <!--  end card  -->
               </div>
               <!-- end col-md-12 -->
            </div>
            <!-- end row -->
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   var $table = $('#bootstrap-table');
   $('#communcicationmenu').addClass('collapse in');
   $('#communication').addClass('active');
   $('#communication2').addClass('active');
        /* $().ready(function(){
            $table.bootstrapTable({
                toolbar: ".toolbar",
                clickToSelect: true,
                showRefresh: true,
                search: true,
                showToggle: true,
                showColumns: true,
                pagination: true,
                searchAlign: 'left',
                pageSize: 8,
                clickToSelect: false,
                pageList: [8,10,25,50,100],

                formatShowingRows: function(pageFrom, pageTo, totalRows){
                    //do nothing here, we don't want to show the text "showing x of y from..."
                },
                formatRecordsPerPage: function(pageNumber){
                    return pageNumber + " rows visible";
                },
                icons: {
                    refresh: 'fa fa-refresh',
                    toggle: 'fa fa-th-list',
                    columns: 'fa fa-columns',
                    detailOpen: 'fa fa-plus-circle',
                    detailClose: 'fa fa-minus-circle'
                }
            });

            //activate the tooltips after the data table is initialized
            $('[rel="tooltip"]').tooltip();

            $(window).resize(function () {
                $table.bootstrapTable('resetView');
            });


        });  */
</script>
