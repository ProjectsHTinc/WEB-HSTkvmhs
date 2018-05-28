<div class="main-panel">
<div class="content">
<div class="container-fluid">

		 <?php if($this->session->flashdata('msg')): ?>
         <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
            ×</button> <?php echo $this->session->flashdata('msg'); ?>
         </div>
         <?php endif; ?>
         <div class="row">
            <div class="col-md-12">
               <div class="card">
                  <div class="content">
                     <div class="fresh-datatables">
					 <h4 class="title">Marks Details<button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go Back</button></h4>
                        <table id="bootstrap-table" class="table">
                           <thead>
                              <th>S.no</th>
                              <th>Teacher</th>
                              <th>Class/Section</th>
                              <th>Subject</th>
                              <th>Exam Name</th>
                              <th>Actions</th>
                           </thead>
                           <tbody>
                              <?php
                                 $i=1;
                                 foreach ($marks as $rows)
								 {//echo $rows->exam_marks_id;
                                  ?>
                              <tr>
                                 <td><?php echo $i; ?></td>
                                 <td><?php echo $rows->name;  ?> </td>
                                 <td><?php $cid=$rows->classmaster_id;
                           $sql="SELECT c.*,s.*,cm.* FROM edu_class AS c,edu_sections AS s ,edu_classmaster AS cm WHERE cm.class_sec_id='$cid' AND cm.section = s.sec_id AND cm.class=c.class_id";
								     $resultset=$this->db->query($sql);
									 $row=$resultset->result();
									 foreach($row as $row1)
									 {
										 echo $row1->class_name;
										 echo '-';
										 echo $row1->sec_name;
									 }
								 ?> </td>
                                 <td><?php echo $rows->subject_name;  ?> </td>
                                 <td><?php $id=$rows->exam_id;
								     $sql="SELECT exam_id,exam_name FROM edu_examination WHERE exam_id='$id' ";
								     $resultset=$this->db->query($sql);
									 $row=$resultset->result();
									 foreach($row as $row1)
									 {}
									 echo $row1->exam_name;
								 ?> </td>

                                 <td>
                                    <a href="<?php echo base_url(); ?>examinationresult/exam_mark_edit_details?var1=<?php echo $rows->subject_id; ?>&var2=<?php echo $rows->classmaster_id; ?>&var3=<?php echo $rows->exam_id; ?>" title="Edit Mark Details" rel="tooltip" class="btn btn-simple btn-warning btn-icon edit" ><i class="fa fa-edit"></i></a>
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

		 </div></div></div>

		 <script type="text/javascript">
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
				$('#examinationmenu').addClass('collapse in');
				$('#exam').addClass('active');
				$('#exam2').addClass('active'); 
</script>
