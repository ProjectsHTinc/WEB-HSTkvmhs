<style>
    .subject-info-box-1,
    .subject-info-box-2 {
        float: left;
        width: 45%;
        padding-left: 30px;
        select {
            height: 200px;
            padding: 0;
            option {
                padding: 4px 10px 4px 10px;
            }
            option:hover {
                background: #EEEEEE;
            }
        }
    }

    .subject-info-arrows {
        float: left;
        width: 10%;
        input {
            width: 70%;
            margin-bottom: 5px;
        }
    }

    .modalheading {
        padding-left: 30px;
    }

    #lstBox1 {
        height: 300px;
    }

    #lstBox2 {
        height: 300px;
    }
</style>
<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">

                        <div class="header">
                            Edit Promotion History
                        </div>
                        <?php foreach ($res_pro as $rows_res) {

                       } ?>
                            <div class="content">
                                <form method="post" action="" class="form-horizontal" name="edit_promotion_forms" enctype="multipart/form-data" id="edit_promotion_forms">
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Current Year</label>
                                            <div class="col-sm-6">
                                                <input type="hidden" name="current_year_id" id="current_year_id" class="form-control" value="<?php  echo $rows_res->current_academic_year_id; ?>" readonly="">
                                                <input type="hidden" name="student_admission_id" id="student_admission_id" class="form-control" value="<?php  echo $rows_res->student_admission_id; ?>" readonly="">
                                                <input type="text" name="year_id" id="year_id" class="form-control" value="<?php echo date('Y', strtotime($rows_res->last_year));  echo " - "; echo date('Y', strtotime( $rows_res->to_year));  ?>" readonly="">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Promoted Year</label>
                                            <div class="col-sm-6">
                                                <select name="next_year_id" id="next_year_id" class="form-control">
                                                    <option value="">Select Year</option>
                                                    <?php foreach($res_year as $years)  {?>
                                                        <option value="<?php echo $years->year_id ?>">
                                                            <?php echo date('Y', strtotime($years->from_month));  echo "-"; echo date('Y', strtotime( $years->to_month));  ?>
                                                        </option>
                                                        <?php } ?>
                                                </select>
                                                <script language="JavaScript">
                                                    document.edit_promotion_forms.next_year_id.value = "<?php echo $rows_res->promotion_academic_year_id; ?>";
                                                </script>

                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Name</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="name" class="form-control" value="<?php echo $rows_res->name; ?>" readonly="">
                                                <input type="hidden" name="id" class="form-control" value="<?php echo $rows_res->id; ?>" readonly="">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Current Studying</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="name" class="form-control" value="<?php echo $rows_res->last_class; ?>-<?php echo $rows_res->last_sec; ?>" readonly="">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Promoted To </label>
                                            <div class="col-sm-6">
                                                <select name="promotion_class_master_id" id="promotion_class_master_id" class="selectpicker" data-style=" btn-block" data-menu-style="dropdown-blue">
                                                    <?php foreach($res_class_all as $rows){ ?>
                                                        <option value="<?php echo $rows->class_id; ?>">
                                                            <?php echo $rows->class_name; ?>-
                                                                <?php echo $rows->sec_name; ?>
                                                        </option>
                                                        <?php    } ?>
                                                </select>
                                                <script language="JavaScript">
                                                    document.edit_promotion_forms.promotion_class_master_id.value = "<?php echo $rows_res->promotion_class_master_id; ?>";
                                                </script>

                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Result Status </label>
                                            <div class="col-sm-6">
                                                <select name="result_status" id="result_status" class="form-control">
                                                    <option value="Promote">Promote</option>
                                                    <option value="Demoted">Demoted</option>
                                                </select>
                                                <script language="JavaScript">
                                                    document.edit_promotion_forms.result_status.value = "<?php echo $rows_res->result_status; ?>";
                                                </script>

                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"> </label>
                                            <div class="col-sm-6">

                                                <input type="submit" name="name" class="form-control btn-info btn-fill" value="Save">
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
    $('#edit_promotion_forms').validate({ // initialize the plugin
        rules: {
            year_id: {
                required: true
            },
            next_year_id: {
                required: true,
                notEqualTo: "#current_year_id"
            },
            class_master_id_for_last_academic_year: {
                required: true
            },
            promotion_class_master_id: {
                required: true
            },
            "student_reg_id_for_last_academic_year[]": {
                required: true
            },
            result_status: {
                required: true
            },
        },
        messages: {
            year_id: "Enter Grouping Name",
            next_year_id: {
                required: "Select year",
                notEqualTo: "Current Year and To Year Cannot be Same"
            },
            class_master_id_for_last_academic_year: "Select From Class",
            promotion_class_master_id: "Select To Class",
            "student_reg_id_for_last_academic_year[]": "Select Student ",
            status: "select status"

        },
        
        submitHandler: function(form) {
         //alert("hi");
         swal({
                       title: "Are you sure?",
                       text: "You Want Confirm this form",
                       type: "success",
                       showCancelButton: true,
                       confirmButtonColor: '#DD6B55',
                       confirmButtonText: 'Yes, I am sure!',
                       cancelButtonText: "No, cancel it!",
                       closeOnConfirm: false,
                       closeOnCancel: false
                   },
                   function(isConfirm) {
                       if (isConfirm) {
        $.ajax({
            url: "<?php echo base_url(); ?>promotion/save_promotion",
             type:'POST',
            data: $('#edit_promotion_forms').serialize(),
            success: function(response) {
                if(response=="success"){
                 //  swal("Success!", "Thanks for Your Note!", "success");
                   $('#edit_promotion_forms')[0].reset();
                   swal({
            title: "Wow!",
            text: "Message!",
            type: "success"
        }, function() {
           window.location.href = "<?php echo base_url(); ?>promotion/home";
        });
                }else{
                  sweetAlert("Oops...", "Something went wrong!", "error");
                }
            }
        });
      }else{
          swal("Cancelled", "Process Cancel :)", "error");
      }
    });
 }

    });

    var $table = $('#bootstrap-table');
    $().ready(function() {
        $table.bootstrapTable({
            toolbar: ".toolbar",
            clickToSelect: true,
            showRefresh: true,
            search: true,
            showToggle: true,
            showColumns: true,
            pagination: true,
            searchAlign: 'left',
            pageSize: 10,
            clickToSelect: false,
            pageList: [8, 10, 25, 50, 100],

            formatShowingRows: function(pageFrom, pageTo, totalRows) {
                //do nothing here, we don't want to show the text "showing x of y from..."
            },
            formatRecordsPerPage: function(pageNumber) {
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

        $(window).resize(function() {
            $table.bootstrapTable('resetView');
        });

    });
    $('#promotionmenu').addClass('collapse in');
    $('#promotion').addClass('active');
    $('#promo1').addClass('active');
</script>
