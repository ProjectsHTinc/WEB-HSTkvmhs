<div class="main-panel">
<div class="content">
       <div class="container-fluid">
           <div class="row">
               <div class="col-md-8">
                   <div class="card">
                       <div class="header">
                           <h4 class="title">Update Year</h4>

                       </div>
<?php foreach($res as $row)
{
}	?>
                       <div class="content">
                           <form method="post" action="<?php echo base_url(); ?>years/update_year" class="form-horizontal" enctype="multipart/form-data" name="myformsection" id="myformsection">
					<input type="hidden" name="year_id" class="form-control" value="<?php echo $row->year_id; ?>">
                                 <fieldset>
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label">FROM Year</label>
                                          <div class="col-sm-4">
                                              <input type="text" required name="from_month" class="form-control datepicker" value="<?php $date=date_create($row->from_month);
                                       echo date_format($date,"d-m-Y");
									    ?>">

                                          </div>
                                          <label class="col-sm-2 control-label">To Year</label>
                                          <div class="col-sm-4">
                                              <input type="text" required name="end_month" class="form-control datepicker" value="<?php $date=date_create($row->to_month);
                                       echo date_format($date,"d-m-Y");
									    ?>" name="to_month" class="form-control" value=""  />
                                          </div>

                                      </div>
                                  </fieldset>
                                        <div class="form-group">
								<label class="col-sm-2 control-label">Status</label>
									<div class="col-sm-4">
										<select name="status" class="selectpicker form-control">
											<option value="Active">Active</option>
											<option value="Deactive">DeActive</option>
										</select>
									<script language="JavaScript">document.myformsection.status.value="<?php echo $row->status; ?>";</script>
									</div>
											<label class="col-sm-2 control-label">&nbsp;</label>

                                            <div class="col-sm-4">
                                                   <button type="submit" id="save" class="btn btn-info btn-fill center">Update </button>
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


      $('#mastersmenu').addClass('collapse in');
      $('#master').addClass('active');
      $('#masters1').addClass('active');
  </script>
