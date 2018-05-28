
<div class="main-panel">
<div class="content">
<div class="col-md-12">

                  <!-- end card -->


						 <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Update Marks Details <button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go Back</button></h4>
								<?php foreach ($result as $rows)
									{} ?>
									<?php
                                         $sPlatform=$rows->subject_id;
                                         $sQuery = "SELECT * FROM edu_subject";
                                         $objRs=$this->db->query($sQuery);
                                      //print_r($objRs);
                                      $row=$objRs->result();
                                      foreach ($row as $rows1) {
                                      $s= $rows1->subject_id;
                                      $sec=$rows1->subject_name;

                                      $arryPlatform = explode(",", $sPlatform);
                                     $sPlatform_id  = trim($s);
                                     $sPlatform_name  = trim($sec);
                                     if (in_array($sPlatform_id, $arryPlatform ))
									 {
									 ?>

									  <p class="category"><b>Subject Name </b>= <?php echo $sec ; }}?> </br>
                                        <?php
                                         $sPlatform=$rows->class_id;
                                        $sQuery = "SELECT c.class_name,s.sec_name,cm.class_sec_id,cm.class FROM edu_class AS c,edu_sections AS s ,edu_classmaster AS cm WHERE cm.class = c.class_id AND cm.section = s.sec_id ORDER BY c.class_name";
                                         $objRs=$this->db->query($sQuery);
                                      //print_r($objRs);
                                      $row=$objRs->result();
                                      foreach ($row as $rows1) {
                                      $s= $rows1->class_sec_id;
                                      $sec=$rows1->class;
                                      $clas=$rows1->class_name;
                                        $sec_name=$rows1->sec_name;
                                      $arryPlatform = explode(",", $sPlatform);
                                     $sPlatform_id  = trim($s);
                                     $sPlatform_name  = trim($sec);
                                     if (in_array($sPlatform_id, $arryPlatform )) {
										 ?>
									  <b>Class&Section Name </b>= <?php echo $clas ;?> - <?php echo $sec_name; }}?> </p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>S.No</th>
                                    	<th>Name</th>
                                    	<th>Marks</th>
                                    	<th>ReMarks</th>

                                    </thead>
		 <form method="post" action="<?php echo base_url(); ?>homework/update" class="form-horizontal" enctype="multipart/form-data" id="markform">
                                    <tbody>
									<?php $i=1;
									foreach ($result as $rows)
									{
										//$sub=$res->subject_name;
										//$enr_id=$res->enroll_id;
									?>

                                        <tr>
                                        	<td><?php echo $i; ?></td>
                                        	<td><?php echo $rows->name; ?>

											<input type="hidden" name="enroll[]" value="<?php echo $rows->enroll_mas_id;?>"/>
									         <input type="hidden" name="hwid" value="<?php echo $rows->hw_mas_id;?>"/>
									       </td>
                                        	<td style="width:20%;">
											<input type="text" name="marks[]" value="<?php echo $rows->marks; ?>" class="form-control"/>
											</td>
                                        	<td> <textarea name="remarks[]" MaxLength="150" placeholder="MaxLength 150" value="" class="form-control" rows="1" cols="03"><?php echo $rows->remarks; ?></textarea></td>
                                        	<td></td>
                                        </tr>

                                   <?php $i++;  }?>
								   <tr>
								   <td></td><td></td>
                          <td>

                                   <button type="submit" id="save" class="btn btn-info btn-fill center">Update </button>

							</td>	<td></td><td></td>
								   </tr>
                                    </tbody>

								</form>
                                </table>

                            </div>
                        </div>
                    </div><!-- end col-md-12 -->
                </div>

                    </div>
</div>
</div>
<script type="text/javascript">
var loadFile = function(event) {
 var output = document.getElementById('output');
 output.src = URL.createObjectURL(event.target.files[0]);
};


$(document).ready(function () {

	$('#homeworkmenu').addClass('collapse in');
	$('#home').addClass('active');
	$('#home1').addClass('active');
	
 $('#admissionform').validate({ // initialize the plugin
     rules: {

         name:{required:true }, address:{required:true },
         email:{required:true,email:true
         },
         sex:{required:true },
         dob:{required:true },
         age:{required:true,number:true,maxlength:2 },
         nationality:{required:true },
         religion:{required:true },
         community_class:{required:true },
         community:{required:true },

         mobile:{required:true }

     },
     messages: {

           address: "Enter Address",
           admission_date: "Select Admission Date",
           name: "Enter Name",
            email: "Enter Email Address",
             remote: "Email already in use!",
           sex: "Select Gender",
           dob: "Select Date of Birth",
           age: "Enter AGE",
           nationality: "Nationality",
           religion: "Enter the Religion",
           community:"Enter the Community",
           community_class:"Enter the Community Class",
           mother_tongue:"Enter The Mother tongue",
           mobile:"Enter the mobile Number"

         }
 });
});

</script>
<script type="text/javascript">
function checkMailStatus(){
    //alert("came");
var email=$("#email").val();// value in field email
alert(email);
$.ajax({
        type:'post',
        url:'check_email',// put your real file name
        data:{email: email},
        success:function(msg){
        alert(msg); // your message will come here.
        }
 });
}



</script>
