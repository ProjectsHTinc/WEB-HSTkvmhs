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
            .grade{
            color: #1e20ba;
            }
         </style>
         <div class="row">
            <div class="col-md-8">
               <div class="card">
                  <div class="header">
                     <h4 class="title">Exam Marks <button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go Back</button> </h4>
                     <p class="category"></p>
                  </div>
                  <div class="content table-responsive table-full-width">
                     <form method="post" action="<?php echo base_url(); ?>examinationresult/marks_details" class="form-horizontal" enctype="multipart/form-data" id="markform">
                        <table id="resulttable" class="table table-hover table-striped">
               <thead>
                <th>Sno</th>
                <th>Subject Name</th>
                <th>Internal Marks</th>
                <th>External Marks</th>
                <th>Total Marks</th>
               </thead>
               <tbody>
               <?php
                  $i=1;
                  if(!empty($result))
                  {
                     foreach ($result as $rows) 
                     {
                      $tm=$rows->total_marks;
                      $im=$rows->internal_mark; $ig=$rows->internal_grade;
                      $em=$rows->external_mark; $eg=$rows->external_grade;
                    ?>
                     <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $subid=$rows->subject_name;?> </td>
                      <?php if($im==0 && $em==0 && $ig==0 && $eg==0) { ?>
                      <td></td><td></td>
                         <td>
                       <input type="hidden" style="width:30%;" name="marks" disabled id="smark" class="form-control" value="<?php echo $rows->total_marks; ?>" /> 
                       <span class="total"><?php //echo $rows->total_marks; ?></span>   <span class="grade"><?php echo $rows->total_grade; ?>  </span>
                     </td>
                      <?php }else{ ?>
                          <td><?php //echo $rows->internal_mark; ?>  <span class="grade"><?php echo $rows->internal_grade; ?>  </span></td> 
                      <td><?php //echo $rows->external_mark; ?>   <span class="grade"><?php echo $rows->external_grade; ?>  </span></td>
                      <td>
                       <input type="hidden" style="width:30%;" name="marks" disabled id="smark" class="form-control" value="<?php echo $rows->total_marks; ?>" /> 
                       <span class="total"><?php //echo $rows->total_marks; ?></span>  <span class="grade"><?php echo $rows->total_grade; ?> </span>
                     </td>
                      <?php } ?>
                     </tr>
                      <?php $i++;  } }else{ echo "<p style=text-align:center;color:red;>No exam added for any class </p>"; }  
                     ?>      
                         <!--td></td><td></td><td></td>
                        <?php //if(!empty($result)){ ?>
                         <td>TOTAL</td>
                        <td>
                              <p id="totals"></p>
                          </td-->
                        <?php //}else{ echo"";}?>
               
                  </tbody>
               </table>
                     </form>
                  </div>
               </div>
            </div>
            <div class="col-md-4">
               <img class="img-responsive" src="<?php echo base_url(); ?>assets/exam_marks_details.jpg"/>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   $(window).load(function($) {
       loadmarks();
   });
   	
   function loadmarks()
   {
   		var tot=0;
   		$("input[name=marks]").each (function() {
   			tot=tot + parseInt($(this).val());
   		})
   	$("#totals").html(tot);
   	
   }
    $(document).ready(function () {
      $('#examinationmenu').addClass('collapse in');
      $('#exam').addClass('active');
      $('#exam2').addClass('active');
     
      });
</script>
<script type="text/javascript">
   /*   function insertfun()
     {
      var m=document.getElementById("mark").value;
      var s=document.getElementById("sid").value;
      var c=document.getElementById("cid").value;
      var sub=document.getElementById("subid").value;
      var t=document.getElementById("tid").value;
      var ex=document.getElementById("eid").value;
   
      //alert(m);alert(s);alert(ex);//exit;
      
     $.ajax({
   		type:'post',
   		url:'<?php echo base_url(); ?>/examinationresult/ajaxmarkinsert',
   		data:'examid=' + ex + '&suid=' + sub + '&stuid=' + s + '&clsid=' + c + '&teid=' + t + '&mark=' + m,
   
   		success:function(test)
   		{   alert(test);exit;
   			if(test=="Email Id already Exit")
   			{
   			/* alert(test);
   				$("#msg").html(test);
   				$("#save").hide();
   			}
   			else{
   				/* alert(test);s
   				$("#msg").html(test);
   				$("#save").show();
   			}
   
   		}
     });
   } */
</script>

