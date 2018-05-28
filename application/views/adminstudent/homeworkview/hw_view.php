<style>
.datewidth{
    width:100px;
}
    </style>
</style>
<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <div class="card">
                  <div class="header">
                     <h4 class="title">Homework & Class Test</h4>
                  </div>
                    <div class="content">
                     <div class="fresh-datatables">
                        <table id="bootstrap-table" class="table">
                           <thead>
                              <th>S.no</th>
                              <th>Teacher</th>
                              <th>Subject</th>
                              <th>Type</th>
                              <th>Title</th>
                              <th>DATE</th>
                              <th>Details</th>
                              <th>View Marks </th>
                           </thead>
                           <tbody>
                              <?php
                                 $i=1;
                                 foreach ($result as $rows)
								 {
                                 $type=$rows->hw_type;
                                 $sta=$rows->mark_status;
								 $hw=$rows->hw_type;
                                  ?>
                              <tr>
                                 <td><?php   echo $i; ?></td>
                                <td>
                                    <?php
                                       $id=$rows->teacher_id;
                                       $query="SELECT name,teacher_id FROM edu_teachers WHERE teacher_id='$id'";
                                       $resultset=$this->db->query($query);
                                       $row=$resultset->result();
									   foreach($row as $row1){}
                                       $tname=$row1->name;
									   echo $tname; ?>
							  </td>

                                 <td><?php $su=$rows->subject_id;
                                       $sub="SELECT * FROM edu_subject WHERE subject_id='$su'";
                                       $result=$this->db->query($sub);
                                       $row2=$result->result();
									   foreach($row2 as $row3){}
                                       $subname=$row3->subject_name;
									   echo $subname;

								 ?></td>
                                 <td><?php if($hw=="HT")
								 {echo "Class Test";}else{ echo "Home Work";}?></td>
                                 <td><?php echo $rows->title; ?></td>

							    <td class="datewidth">
							    <?php if($hw=="HT") {$date=date_create($rows->test_date);
                                    echo date_format($date,"d-m-Y");
                                    }else{ $duedate=date_create($rows->due_date);
								echo date_format($duedate,"d-m-Y"); }
									 ?>
									 </td>
                                 <td><?php echo $rows->hw_details; ?></td>
                                 <td>
                                    <?php if($sta==0 && $type=="HT")
                                       {?>
                                    <a href="" rel="tooltip" title="Doesn't Add Mark Details" class="btn btn-simple btn-info btn-icon table-action view" >
                                    <i class="fa fa-id-card-o" aria-hidden="true"></i></a>
                                    <?php }elseif($sta==1){?> <a href="<?php echo base_url();?>student/view_mark/<?php echo $rows->hw_id; ?>" title="View Mark Details" rel="tooltip" class="btn btn-simple btn-warning btn-icon edit" style="color:red;"><i class="fa fa-id-card-o" aria-hidden="true"></i></a>	<?php }?>
                                 </td>
                              </tr>
                              <?php $i++;  }  ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  </div>
               </div>
            </div> <!-- row -->
         </div>

      </div>
</div>
<script type="text/javascript">
   $(document).ready(function () {
   $('#homework').addClass('collapse in');
   $('#homework').addClass('active');
   $('#homework').addClass('active');
    $('#classsection').validate({ // initialize the plugin
        rules: {
            test_type:{required:true },
			title:{required:true },
			subject_name:{required:true },
			tet_date:{required:true },
			details:{required:true },
			class_id:{required:true }
        },
        messages: {
              test_type: "Please Select Type Of Test",
			  title: "Please Enter Title Name",
			  subject_name: "Please Select Subject Name",
			  tet_date: "Please Select Date",
			  details: "Please Enter Details",
			  class_id: "Please Enter Class Name"

            }
    });
   });

   var $table = $('#bootstrap-table');
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


         });
</script>
<script type="text/javascript">
   $().ready(function(){

     $('.datepicker').datetimepicker({
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
