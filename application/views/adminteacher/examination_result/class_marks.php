<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
         <?php if($this->session->flashdata('msg')): ?>
         <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
            ×</button> <?php echo $this->session->flashdata('msg'); ?>
         </div>
         <?php endif; ?>
		 <style>
		 .grade{color: #1a0edd;padding: 10px;}
		 .grade1{color: #0d871f;padding: 10px;}
		 .grade2{color: #c117e3;padding: 10px;}
		 .space{ padding:05px;}
		  th tr td{padding:0px !important;}
		 </style>
		<?php $cls_masid = $this->input->get('var1'); 
			  $exam_id=$this->input->get('var2');?>
         <div class="row">
            <div class="col-md-12">
               <div class="card">
                  <div class="header">
                     <h4 class="title">View Exam Marks <button class="btn btn-info btn-fill center" onclick="generatefromtable()">Generate PDF</button> <button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go Back</button> </h4>
                     <p class="category"></p>
                  </div>
                  <div class="content table-responsive table-full-width">
                     <form method="post" action="<?php echo base_url(); ?>examinationresult/marks_status" class="form-horizontal" enctype="multipart/form-data" id="markform">
                        <?php
                           $student_array_generate = function($stu,&$student_arr) use ($subject_name,$subject_id)
                           {
                           	foreach ($stu as $v) {
                           		$cnt= count($subject_name);
                           
                           		for($i=0;$i<$cnt;$i++)
                           		{
                           			if($subject_id[$i] == $v->subject_id)
                           			{
                           				$student_arr[$v->name][$subject_id[$i]] = $v;
                           			}else{
                           				if(!isset($student_arr[$v->name][$subject_id[$i]]))
                           				$student_arr[$v->name][$subject_id[$i]] = array();
                           			}
                           		}
                           	}
                           }
                           ?>
						   <input type="hidden" name="clsid" value="<?php echo $cls_masid;?>">
						   <input type="hidden" name="examid" value="<?php echo $exam_id;?>">
                        <table id="bootstrap-table" class="table table-hover table-striped">
                           <?php 
                               if(!empty($stu))
                              {?>
                           <thead>
                              <th>Sno</th>
                              <th>Name</th>
                              <?php
                                 if($status=="Success")
                                 {
								  $cnt= count($subject_name);
								  for($i=0;$i<$cnt;$i++)
                                 { ?>
                              <th> <?php echo $subject_name[$i]; ?> <?php echo $subject_id[$i]; ?></th>
                              <?php  }
                                 }else{  ?>
                              <th style="color:red;">Subject Not Found</th>
                              <?php  }?>
                              <th style="color:red;">Total</th>
                           </thead>
                           <?php
                              $tecid=$marks1[0]->teacher_id;
                              echo '<input type="hidden" id="tid" name="teaid" value="'.$tecid.'" />';
                                                          }?>
                           <tbody>
                              <?php
			 if(!empty($stu))
			 {
				$student_arr = array();
				$student_array_generate($stu,$student_arr);
				
				$i = 1;
				foreach ($student_arr as $k => $s1)
				{
					echo '<tr>';
					echo '<td>' . $i . '</td>';
					echo '<td>' . $k . '</td>';
					$k = 1;
					foreach ($s1 as $k1 => $s)
					{
						if(empty($s) === false && $k == 1){
							echo '<input type="hidden" id="sid" name="sutid[]" value="'.$s->enroll_id.'" />';
							echo '<input type="hidden" id="cid" name="clsmastid" value="'.$s->class_id.'" />';
							$k++;
						}
						if($status=="Success")
					   {    echo '<input type="hidden" required  name="subid" value="'.$k1.'" class="form-control"/>';
							
			              echo '<td>';
							if(!empty($s))
							{
							 echo '<span class="grade">'; echo $s->internal_mark;   echo '<span class="space">';echo $s->internal_grade;echo'</span>';echo'</span>'; 
							 echo '<span class="grade1">'; echo $s->external_mark;   echo '<span class="space">';echo $s->external_grade;echo'</span>';echo'</span>';
							 echo'<span class="combat">';
							 echo '<span class="grade2">'; echo $s->total_marks;   echo '<span class="space">';echo $s->total_grade;echo'</span>';echo'</span>';
							 echo'</span>';
							}else{
								'<form method="post" class="form-horizontal" enctype="multipart/form-data" id="markform">';
								echo '<input required style="width:50%;" type="text" readonly name="totalmarks" class="form-control"/>';
								'</form>';
								echo '<input type="hidden" required id="subid" name="subjectid[]" value="'.$k1.'" class="form-control"/>';
							}
							echo '</td>';
						}
					}
				echo '<td class="total-combat">
								  </td>';
						
					 echo '</tr>';
					$i++;
				}
				  if(!empty($smark)){ echo "";}else{ ?>
				  <tr><td></td><td></td>
					 <td>
						   <button type="submit" class="btn btn-info btn-fill center">Approve</button>
					 </td>
				  </tr>
				  <?php }
					 }else{ echo "<p style=color:red;text-align:center;>No Exam Mark Added</p>"; }
						?>
                           </tbody>
                        </table>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
 <?php  $cls_masid = $this->input->get('var1');
         $sql="SELECT cm.*,c.class_id,c.class_name,se.sec_id,se.sec_name FROM edu_classmaster AS cm,edu_class AS c,edu_sections AS se WHERE cm.class_sec_id='$cls_masid' AND cm.class=c.class_id AND cm.section=se.sec_id";
         $resultset=$this->db->query($sql);
         $row=$resultset->result();
         foreach ($row as $rows) {} $cls=$rows->class_name; $sec=$rows->sec_name;
		// echo $cls; echo $sec; ?>  
<script type="text/javascript">
   $('tr').each(function () {
          var sum = 0;
        $(this).find('.combat').each(function () {
            var combat = $(this).text();
            if (combat !='NA'&& combat.length!==0) {
                sum += parseInt(combat);
            }
        });
        $(this).find('.total-combat').html(sum);
      });

   $('#examinationmenu').addClass('collapse in');
   $('#exam').addClass('active');
   $('#exam1').addClass('active');
   
   $('#markform').validate({ // initialize the plugin
           rules: {
               totalmarks:{required:true,number:true }
           },
           messages: {
                 totalmarks: "Please Enter The Marks"
   			  
               }
       });
   	   function insertfun()
   	   {//onkeyup="insertfun(this.value)"
   		   var m=document.getElementById("mark").value;
   		   var s=document.getElementById("sid").value;
   		   var c=document.getElementById("cid").value;
   		   var sub=document.getElementById("subid").value;
   		   var t=document.getElementById("tid").value;
   		   var ex=document.getElementById("eid").value;
   
   		  // alert(m);alert(s);alert(ex);//exit;
   
   		  $.ajax({
   				type:'post',
   				url:'<?php echo base_url(); ?>examinationresult/ajaxmarkinsert',
   				data:'examid=' + ex + '&suid=' + sub + '&stuid=' + s + '&clsid=' + c + '&teid=' + t + '&mark=' + m,
   
   				success:function(test)
   				{   alert(test);exit;
   					if(test=="Email Id already Exit")
   					{
   					/* alert(test); */
   						$("#msg").html(test);
   						$("#save").hide();
   					}
   					else{
   						/* alert(test); */
   						$("#msg").html(test);
   						$("#save").show();
   					}
   
   				}
   		  });
   	}
	 var $table = $('#bootstrap-table');
         $().ready(function(){
           jQuery('#teachermenu').addClass('collapse in');
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
		 
		 function generatefromtable() {
				var data = [], fontSize = 12, height = 0, doc;
				doc = new jsPDF('p', 'pt', 'a4', true);
				doc.setFont("times", "normal");
				doc.setFontSize(fontSize);
				doc.text(50,20, "Exam Result");
				data = [];
				data = doc.tableToJson('bootstrap-table');
				height = doc.drawTable(data, {
					xstart : 30,
					ystart : 10,
					tablestart : 40,
					marginleft : 10,
					xOffset : 10,
					yOffset : 15
				});
				//doc.text(50, height + 20, 'hi world');
				doc.save("<?php  echo $this->session->userdata('name'); ?>( <?php echo $cls; echo $sec; ?> ).pdf");
			}
		 
</script>

