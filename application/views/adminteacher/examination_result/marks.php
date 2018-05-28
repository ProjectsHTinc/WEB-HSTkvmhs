<div class="main-panel">

 <div class="content">
            <div class="container-fluid">
			<?php if($this->session->flashdata('msg')): ?>
         <div class="alert alert-success">
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
       ×</button> <?php echo $this->session->flashdata('msg'); ?>
         </div>
       <?php endif; ?>
	   <?php if(empty($edate)){ echo "<p style=color:red;>Exam Couldn't Complete</p>";}else{ ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Enter Exam Marks
								 <?php  $exam_id=$this->input->get('var2'); //echo$exam_id;  ?>
								<?php //print_r($cla_tea_id);
								    $cid=$cla_tea_id[0]->class_teacher;
									//echo $cid;
									$cls_masid=$this->input->get('var1');
									//echo $cls_masid;
									if($cid==$cls_masid)
									{?>
<a href="<?php echo base_url(); ?>examinationresult/exam_mark_details_cls_teacher?var1=<?php echo $cid; ?>&var2=<?php  echo $exam_id; ?>"  class="btn btn-info btn-fill btn-wd">View Class Mark</a>	
									<?php }
									//foreach($res as $row){}echo $row->class_id;
									?>

					<button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go Back</button> </h4>
                                <p class="category"></p>
                            </div>
                            <div class="content table-responsive table-full-width">
					<form method="post" action="<?php echo base_url(); ?>examinationresult/marks_details" class="form-horizontal" enctype="multipart/form-data" id="markform">
                                <table class="table table-hover table-striped">
								<?php 
									 if(!empty($result))
									  {
										foreach($result as $exam)
								         {}
									        $id=$exam->exam_id;
                                      echo '<input type="hidden" name="examid" value="'.$id.'" />';
									  }else{ echo "";}

                                      if(!empty($res))
									  {?>
                                    <thead>
									 <th>Sno</th>
                                     <th>Name</th>
									 <?php
                                      if(empty($res))
									  {?>
										  <p style="padding:15px;">Student Not Found </p>
									 <?php  }else{
										foreach($res as $row)
										      { }?>
				<th> Internal <?php echo $row->subject_name; ?> Marks
				<input type="hidden" name="subjectid" value="<?php echo $row->subject_id; ?>" /></th>
				
								<th> External <?php echo $row->subject_name; ?> Marks<input type="hidden" name="subjectid" value="<?php echo $row->subject_id; ?>" /></th>
									<?php
									  }?>
                                    </thead>
                                    <tbody>
										<?php
										$i=1;
										if(!empty($mark)){
										foreach($mark as $rows){?>
										<tr>
										<td><?php echo $i;?></td>
										<td style="">
										<?php  $stdid=$rows->stu_id;
										       $sql="SELECT enroll_id,name FROM edu_enrollment WHERE enroll_id='$stdid'";
											   $result=$this->db->query($sql);
			                                   $row123=$result->result();
											   foreach($row123 as $name){ }
											   echo $name->name;
										?>
										</td>
										<td style="width: 30%;"><?php echo $rows->internal_mark; ?> ( <?php echo $rows->internal_grade; ?> )</td>
										<td style="width: 30%;"><?php echo $rows->external_mark; ?> ( <?php echo $rows->external_grade; ?> )</td>
										</tr>
										<?php $i++;}
										}else{
										foreach($res as $row)
										      { ?>
										<tr>
										<td><?php echo $i;?></td>
										<td style="">
										<?php echo $row->name; ?>
										<input type="hidden" name="sutid[]" value="<?php echo $row->enroll_id; ?>" />
										<input type="hidden" name="teaid" value="<?php echo $row->teacher_id; ?>" />
                                        <input type="hidden" name="clsmastid" value="<?php echo $row->class_id; ?>" />
										</td>
										<td style="width: 30%;">
										<input style="width:60%;" type="text" maxlength="2" name="internal_marks[]"  class="form-control inputBox"/>
										</td>
										<td style="width: 30%;">
										<input style="width:60%;" type="text" maxlength="2" required name="external_marks[]"  class="form-control inputBox1"/>
										</td>
										</tr>
										<?php $i++;}
										}
										if(empty($mark) && !empty($res) ){ ?>
										<tr>
										<td></td><td></td><td></td>
										<td>
										 <div class="col-sm-10">
                                             <button type="submit" class="btn btn-info btn-fill center">Save</button>
                                          </div>
										 </td>
										<?php }else{ echo ""; }?>
										</tr>

                                    </tbody>
									  <?php }else{ echo "<p style=text-align:center;color:red;>Student Not Found </p>"; } ?>
                                </table>

								</form>

                            </div>
                        </div>
                    </div>
                </div>
	   <?php } ?>

            </div>
        </div>
	</div>
  <script>
  $('#examinationmenu').addClass('collapse in');
  $('#exam').addClass('active');
  $('#exam1').addClass('active');
  
  $(".inputBox").on("keyup keydown", function(e){
    var currentValue = String.fromCharCode(e.which);
    var finalValue = $(this).val() + currentValue;
    if(finalValue >40){
        e.preventDefault();
    }
});

$(".inputBox1").on("keyup keydown", function(e){
    var currentValue = String.fromCharCode(e.which);
    var finalValue = $(this).val() + currentValue;
    if(finalValue >60){
        e.preventDefault();
    }
});

  </script>
