<?php
          $server_url = $_SERVER['HTTP_HOST'];
          $query="SELECT user_pic,school_id,name FROM edu_users WHERE user_type=1";
		  $objRs=$this->db->query($query);
		  $row=$objRs->result();
		  foreach ($row as $rows1)
		  {
			   $pic=$rows1->user_pic;
			   $sid=$rows1->school_id;
			   $sname=$rows1->name;
		  }
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title><?php echo $sname; ?></title>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Light Bootstrap Dashboard core CSS    -->
    <link href="<?php echo base_url(); ?>assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="<?php echo base_url(); ?>assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/stroke/css/pe-icon-7-stroke.css">

</head>
<style>
body{
	background-image: url('<?php echo base_url(); ?>assets/bg-1.jpg');

	 background-position: contain;
	     background-size: cover;
}

</style>
<body>




<div class="wrapper wrapper-full-page">
    <div class="login-page">

    <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
        <div class="content">
            <div class="container">

                <div class="row">
                    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">

												<?php if($this->session->flashdata('msg')): ?>
													<div class="alert alert-danger">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
												×</button> <?php echo $this->session->flashdata('msg'); ?>
								</div>

					<?php endif; ?>

                        <form method="post" action="" id="forgotform">

                        <!--   if you want to have the card without animation please remove the ".card-hidden" class   -->

                            <div class="card card-hidden">

							<?php
									  if($pic!='')
									  {
								?>
                                  <div class="header text-center">
					                <img src="http://<?php echo $server_url; ?>/<?php echo $sid; ?>/assets/admin/profile/<?php echo $pic; ?>" class="img-circle" style="width:150px;height: 150px;"> </div>
						 <?php }else{
							   ?><div class="header text-center">
							  <img src="http://<?php echo $server_url; ?>/<?php echo $sid; ?>/assets/main_logo.png"> </div>
						 <?php } ?>

                                <div class="content">
								<!-- <div class="form-group">
										<label>School ID</label>
										<input type="text" placeholder="Enter School ID" name="school_id" class="form-control" value="">
								</div> -->
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" placeholder="Enter Username" name="username" class="form-control">
                                    </div>

                                  </div>

                                <div class="footer text-center">
                                    <button type="submit" class="btn btn-fill btn-warning btn-wd">Reset</button><br>
								  <a class  href="<?php echo base_url(); ?>">Back To Login</a>
                                </div>
																

                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>



    </div>

</div>


</body>

<style>
.alert button.close {
	position: relative;top:10px;
}
.card .form-group > label {float: left;}
</style>
    <!--   Core JS Files and PerfectScrollbar library inside jquery.ui   -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>


	<!--  Forms Validations Plugin -->
	<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>

	<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
	<script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>

    <!--  Date Time Picker Plugin is included in this js file -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.js"></script>

    <!--  Select Picker Plugin -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-selectpicker.js"></script>

	<!--  Checkbox, Radio, Switch and Tags Input Plugins -->
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-checkbox-radio-switch-tags.js"></script>

	<!--  Charts Plugin -->
	<script src="<?php echo base_url(); ?>assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-notify.js"></script>

    <!-- Sweet Alert 2 plugin -->
	<script src="<?php echo base_url(); ?>assets/js/sweetalert2.js"></script>

    <!-- Vector Map plugin -->
	<script src="<?php echo base_url(); ?>assets/js/jquery-jvectormap.js"></script>


	<!-- Wizard Plugin    -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.bootstrap.wizard.min.js"></script>

    <!--  Datatable Plugin    -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-table.js"></script>

    <!--  Full Calendar Plugin    -->
    <script src="<?php echo base_url(); ?>assets/js/fullcalendar.min.js"></script>

    <!-- Light Bootstrap Dashboard Core javascript and methods -->
	<script src="<?php echo base_url(); ?>assets/js/light-bootstrap-dashboard.js"></script>

	<!--   Sharrre Library    -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.sharrre.js"></script>

	<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
	<script src="<?php echo base_url(); ?>assets/js/demo.js"></script>

    <script type="text/javascript">
        $().ready(function(){
            lbd.checkFullPageBackgroundImage();

            setTimeout(function(){
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
            }, 700)
        });




				$('#forgotform').validate({ // initialize the plugin
				    rules: {
				        username:{required:true },
				    },
				    messages: {
				          username: "Enter Username"
				        },
				      submitHandler: function(form) {
				       $.ajax({
				           url: "<?php echo base_url(); ?>adminlogin/forgotpassword",
				            type:'POST',
				           data: $('#forgotform').serialize(),
				           success: function(response) {
										 //alert(response);
										 if(response=="Password  Reset and send to your Mail Please check it"){
											 swal({
												   title: "Success",
												    text: response,
												     type: "success"
												   },
												   function(){
												     window.location.href = '<?php echo base_url(); ?>';
												 });


										 }else if(response=="Username Not found"){
											 sweetAlert("Oops...", response, "error");
										 }
										 else{
											  sweetAlert("Oops...", "Something went wrong!", "error");
										 }

				           }
				       });

				}
				});

    </script>

</html>
