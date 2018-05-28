<div class="main-panel">

 <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Enter Exam Mark <button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go Back</button></h4>
                                <p class="category"></p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                          <?php  if(!empty($result))
										       { foreach($result as $exam)
								               {
									           $id=$exam->exam_id;}
											   }else{ echo "";}
									           //echo $id; 
											   if(!empty($stu))
										       { foreach($stu as $row)
									            { 
												 $tname=$row->enroll_id;}
												 $su=$row->subject;
												 $clsid=$row->class_teacher;
											   }else{ echo "";}
											 ?>
                                    <thead>
									 <th>Sno</th>
                                     <th>Name</th>
									 <?php 
									 
										 if($status=="Success" )
										 { 
										   $cnt= count($subject_name);
										   for($i=0;$i<$cnt;$i++)
										    { 
									       ?>
										<th><?php echo $subject_name[$i];?><?php //echo $subject_id[$i];?></th>
										 <?php  }
										}else{  ?>
										<th style="color:red;">Subject Not Found</th><?php  }?> 

                                    </thead>
                                    <tbody>
										<?php 
										$i=1;
										foreach($stu as $row)
										 { ?>
										<tr>
										<td><?php echo $i;?></td>
										<td style=""><?php echo $row->name; ?></td>	
										<td><input style="width:50%;" type="text" required name="marks[]" value class="form-control"/></td>
<td><input style="width:50%;" type="text" required name="marks[]" value class="form-control"/></td>
<td><input style="width:50%;" type="text" required name="marks[]" value class="form-control"/></td>										
										</tr>
										<?php $i++;} ?>
										<tr>
										<td></td><td></td>	
										 <td><div class="col-sm-10">
                                             <button type="submit" class="btn btn-info btn-fill center">Save </button>
                                          </div> </td>
										</tr>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
	</div>	