<div class="main-panel">
<div class="content">


<div class="container-fluid">
           <div class="row">
               <div class="col-md-12">

			   <?php if($this->session->flashdata('msg')): ?>
                              <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×</button> <?php echo $this->session->flashdata('msg'); ?>
                     </div>

                     <?php endif; ?>

         <div class="card">
                   <div class="header">
                     <legend>Update  Communication Details</legend>
                        </div>
						<?php foreach($res as $rows)
{


}	?>
                            <div class="content">

                       <div class="content">
                           <form method="post" action="<?php echo base_url(); ?>communication/update" class="form-horizontal" enctype="multipart/form-data" id="myformsection">




						    <fieldset>
                                        <div class="form-group">
									<label class="col-sm-2 control-label">Teacher</label>
									 <div class="col-sm-4">
                   <select multiple name="teacher[]" class="selectpicker form-control" data-title="Select More Than one Teacher" id="multiple-teacher" onchange="select_class('teacher')" data-menu-style="dropdown-blue" >

                                        <?php
                                         $tea_name=$rows->teacher_id;
                          $sQuery = "SELECT * FROM edu_teachers";
                          $objRs=$this->db->query($sQuery);
                          $row=$objRs->result();
                          foreach ($row as $rows1)
						  {
								 $s= $rows1->teacher_id;
								 $sec=$rows1->name;
								 $arryPlatform = explode(",",$tea_name);
								 $sPlatform_id  = trim($s);
								 $sPlatform_name  = trim($sec);
								 if (in_array($sPlatform_id, $arryPlatform ))
								  {
                                       echo "<option  value=\"$s\" selected  /> $sec &nbsp;&nbsp; </option>";
                                  }
                                 else {
                                echo "<option value=\"$s\" />$sec &nbsp;&nbsp;</option>";
                                 }
                                      }
                                        ?>
                                  </select>
                                            </div>

						         <label class="col-sm-2 control-label">Classes</label>
                                           <div class="col-sm-4">
              <select multiple data-title="Select More Than one class" name="class_name[]" id="multiple-class" class="selectpicker" onchange="select_class('classname')" data-menu-style="dropdown-blue">

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
  ?>
          <?php
                  echo "<option  value=\"$sPlatform_id\" selected  />$clas-$sec_name &nbsp;&nbsp; </option>";
             ?>

                                <?php }
                                  else {
                                echo "<option value=\"$sPlatform_id\" />$clas-$sec_name &nbsp;&nbsp;</option>";
                                 }
                                      }
                                        ?>

                                  </select>
                                            </div>

				                     </div>
                                    </fieldset>




                          <!-- </form> -->

                                <input type="hidden" name="comid" class="form-control" value="<?php echo $rows->commu_id; ?>">
								 <fieldset>
                                        <div class="form-group">
									<label class="col-sm-2 control-label">Title</label>
									 <div class="col-sm-4">
                     <input type="text" name="title" class="form-control"  placeholder="Enter Title" value="<?php echo $rows->commu_title; ?>">
                                            </div>

						         <label class="col-sm-2 control-label">Date</label>
                                           <div class="col-sm-4">
               <input type="text" name="date" class="form-control datepicker"  placeholder="Enter Date" value="<?php $date=date_create($rows->commu_date);
    echo date_format($date,"d-m-Y"); ?>">
                                            </div>

				                     </div>
                                    </fieldset>

								   <br/>
								   <fieldset>

                                        <div class="form-group">

                                          <label class="col-sm-2 control-label">Notes</label>
                                            <div class="col-sm-4">
                                        <textarea name="notes" class="form-control" rows="4" cols="80"><?php echo $rows->commu_details; ?></textarea>
                                            </div>
											<label class="col-sm-2 control-label">&nbsp;</label>

                                            <div class="col-sm-4">
                                       <button type="submit" id="save" class="btn btn-info btn-fill center">Update</button>
                                            </div>
                                        </div>
                                    </fieldset>
                             </form>

                            </div>
                        </div>
			</div>
			</div>
			</div>

 </div>
 </div>

<script type="text/javascript">
$(document).ready(function () {

 $('#myformsection').validate({ // initialize the plugin
    rules: {
         teacher:{required:true },
		 class_name:{required:true },
		 title:{required:true },
		 date:{required:true },
		 notes:{required:true },
     },
     messages: {
           teacher:"Select Teachers",
           class_name:"Select Classes",
           title:"Enter Title",
           date:"Enter Date",
           notes:"Enter The Details",
         }
 });
});

/* var $table = $('#bootstrap-table');
      $().ready(function(){
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
                  toggle: 'fa fa-th-list',`
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


      }); */
</script>

<script>
function myFunction() {
    var x = document.getElementById('myDIV');

    if (x.style.display === 'none')
	{
        x.style.display = 'block';
    } else {
        x.style.display = 'none';
    }
    $("#myDIV1").hide();
}


function myFunction1() {
    var x = document.getElementById('myDIV1');
    if (x.style.display === 'none') {
        x.style.display = 'block';
    } else {
        x.style.display = 'none';
    }
    $("#myDIV").hide();
}
</script>
<script type="text/javascript">
      $().ready(function(){
        $('#communcicationmenu').addClass('collapse in');
        $('#communication').addClass('active');
        $('#communication2').addClass('active');
          format: 'DD-MM-YYYY',
          icons: {
              time: "fa fa-clock-o",
              date: "fa fa-calendar",
              up: "fa fa-chevron-up",
              down: "fa fa-chevron-down",
              previous: 'fa fa-chevron-left',
              next: 'fa fa-chevron-right',
              today: 'fa fa-screenshot',
              clear: 'fa fa-trash',
              close: 'fa fa-remove'
          }
       });
      });
  </script>
