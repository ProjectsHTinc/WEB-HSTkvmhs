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
                <div class="col-md-12">
                    <div class="card">
                        <a rel="" href="#myModal" data-id="12" title="Promotion" class="open-AddBookDialog btn btn  edit" data-toggle="modal" data-target="#myModal" style="margin:20px;">
                    Add Promotion</a>
                        <div class="header">
                            List Of Year
                        </div>
                        <div class="row">

                            <?php foreach($res_year as $years_r)  {?>
                                <div class="col-md-2">
                                    <a rel="" href="<?php echo base_url(); ?>promotion/view_list_for_year/<?php echo $years_r->year_id; ?>" data-id="12" title="Promotion" class="btn btn  edit" style="margin:20px;">
                                        <?php echo date('Y', strtotime($years_r->from_month));  echo "-"; echo date('Y', strtotime( $years_r->to_month));  ?>
                                    </a>
                                </div>
                                <?php } ?>

                        </div>

                        <div class="header">
                            Promotion History
                        </div>

                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Promoting Students</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post" class="form-horizontal" id="promotion_forms">
                                            <fieldset>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Current Year</label>
                                                    <div class="col-sm-6">
                                                        <?php  $status=$years['status']; if($status=="success"){
                                                foreach($years['all_years'] as $rows){}
                                                  ?>
                                                            <input type="hidden" name="current_academic_year_id" id="year_id" value="<?php  echo $rows->year_id; ?>">
                                                            <input type="text" name="year_name" class="form-control" value="<?php echo date('Y', strtotime($rows->from_month));  echo " - "; echo date('Y', strtotime( $rows->to_month));  ?>" readonly="">
                                                            <?php   }else{  ?>
                                                                <input type="text" name="year_id" class="form-control" value="" readonly="">
                                                                <?php     } ?>

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">To Year</label>
                                                    <div class="col-sm-6">
                                                        <select name="next_year_id" data-title="select year" id="status" class="form-control">
                                                            <option value="">Select Year</option>
                                                            <?php foreach($res_year as $years)  {?>
                                                                <option value="<?php echo $years->year_id ?>">
                                                                    <?php echo date('Y', strtotime($years->from_month));  echo "-"; echo date('Y', strtotime( $years->to_month));  ?>
                                                                </option>
                                                                <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-6">
                                                        <select name="class_master_id_for_last_academic_year" id="class_master_id" data-title="From Class" class="selectpicker" data-style=" btn-block" data-menu-style="dropdown-blue" onchange="get_student_list()">
                                                            <?php foreach($res_class as $rows){ ?>
                                                                <option value="<?php echo $rows->class_id; ?>">
                                                                    <?php echo $rows->class_name; ?>-
                                                                        <?php echo $rows->sec_name; ?>
                                                                </option>
                                                                <?php    } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <select name="promotion_class_master_id" id="to_class_master_id" data-title="To Class" class="selectpicker" data-style=" btn-block" data-menu-style="dropdown-blue">
                                                            <?php foreach($res_class_all as $rows){ ?>
                                                                <option value="<?php echo $rows->class_id; ?>">
                                                                    <?php echo $rows->class_name; ?>-
                                                                        <?php echo $rows->sec_name; ?>
                                                                </option>
                                                                <?php    } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="form-group">
                                                    <center>List of Students to include </center>
                                                    <div class="subject-info-box-1">
                                                        <select multiple="multiple" id='lstBox1' class="form-control">
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                    <div class="subject-info-arrows text-center">
                                                        <input type="button" id="btnAllRight" value=">>" class="btn btn-default" />
                                                        <br />
                                                        <input type="button" id="btnRight" value=">" class="btn btn-default" />
                                                        <br />
                                                        <input type="button" id="btnLeft" value="<" class="btn btn-default" />
                                                        <br />
                                                        <input type="button" id="btnAllLeft" value="<<" class="btn btn-default" />
                                                    </div>
                                                    <div class="subject-info-box-2">
                                                        <select multiple="multiple" name="student_reg_id_for_last_academic_year[]" id='lstBox2' class="form-control">
                                                        </select>
                                                    </div>

                                                </div>
                                                <input type="button" id="select_all" class="pull-right" name="select_all" value="Confirm All">
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Result Status</label>
                                                    <div class="col-sm-6">
                                                        <select name="result_status" id="status" class="form-control">
                                                            <option value="Promote">Promote</option>
                                                            <option value="Demoted">Demoted</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">&nbsp;</label>
                                                    <div class="col-sm-6">
                                                        <button type="submit" id="save" class="btn btn-info btn-fill center">Save </button>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="fresh-datatables">
                            <table id="bootstrap-table" class="table">
                                <thead>
                                    <th data-field="id">S.No</th>
                                    <th data-field="Name" data-sortable="true"> Name </th>
                                    <th data-field="Last_year" data-sortable="true">Last year </th>
                                    <th data-field="Promoted" data-sortable="true">Promoted year </th>
                                    <th data-field="Last" data-sortable="true">Last Studied </th>
                                    <th data-field="Result" data-sortable="true">Result </th>
                                    <th data-field="Promotion" data-sortable="true">Promotion To </th>
                                    <th data-field="Action" data-sortable="true">Action </th>

                                </thead>
                                <tbody>
                                    <?php
                                   $i=1;
                                   foreach ($res_pro as $rows) {

                                   ?>
                                        <tr>
                                            <td class="btn-simple btn-icon">
                                                <?php echo $i; ?>
                                            </td>
                                            <td>
                                                <?php echo $rows->student_name;?>
                                            </td>
                                            <td>
                                                <?php echo date('Y', strtotime($rows->last_year));  echo "-"; echo date('Y', strtotime( $rows->to_year));  ?>
                                            </td>
                                            <td>
                                                <?php echo date('Y', strtotime($rows->from_month));  echo "-"; echo date('Y', strtotime( $rows->to_month));  ?>
                                            </td>
                                            <td>
                                                <?php echo $rows->last_class; ?>-
                                                    <?php echo $rows->last_sec; ?>
                                            </td>
                                            <td>
                                                <?php echo $rows->result_status;?>
                                            </td>
                                            <td>
                                                <?php echo $rows->class_name; ?>-
                                                    <?php echo $rows->sec_name; ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url(); ?>promotion/edit_promotion/<?php echo $rows->id; ?>" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-pencil-square-o"></i></a>
                                            </td>
                                        </tr>
                                        <?php $i++;  }  ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<script type="text/javascript">
$('#promotionmenu').addClass('collapse in');
$('#promotion').addClass('active');
$('#promo1').addClass('active');

    function get_student_list() {

        var class_master_id = $('#class_master_id').val();
        //alert(class_master_id);
        $.ajax({
            url: '<?php echo base_url(); ?>grouping/getListstudent',
            method: "POST",
            data: {
                class_master_id: class_master_id
            },
            dataType: "JSON",
            cache: false,
            success: function(data) {

                var stat = data.status;
                $("#lstBox1").empty();
                if (stat == "success") {
                    var res = data.res;
                    //alert(res.length);
                    var len = res.length;

                    for (i = 0; i < len; i++) {
                        $('<option>').val(res[i].enroll_id).text(res[i].name).appendTo('#lstBox1');
                    }

                } else {
                    $("#lstBox1").empty();
                }
            }
        });
    }
    $('#select_all').click(function() {
        $('#lstBox2 option').prop('selected', true);
    });
    (function() {
        $('#btnRight').click(function(e) {
            var selectedOpts = $('#lstBox1 option:selected');
            if (selectedOpts.length == 0) {
                alert("Nothing to move.");
                e.preventDefault();
            }

            $('#lstBox2').append($(selectedOpts).clone());
            $(selectedOpts).remove();
            e.preventDefault();
        });

        $('#btnAllRight').click(function(e) {
            var selectedOpts = $('#lstBox1 option');
            if (selectedOpts.length == 0) {
                alert("Nothing to move.");
                e.preventDefault();
            }

            $('#lstBox2').append($(selectedOpts).clone());
            $(this).prop("selected", true);
            $(selectedOpts).remove();
            e.preventDefault();
        });

        $('#btnLeft').click(function(e) {
            var selectedOpts = $('#lstBox2 option:selected');
            if (selectedOpts.length == 0) {
                alert("Nothing to move.");
                e.preventDefault();
            }

            $('#lstBox1').append($(selectedOpts).clone());
            $(selectedOpts).remove();
            e.preventDefault();
        });

        $('#btnAllLeft').click(function(e) {
            var selectedOpts = $('#lstBox2 option');
            if (selectedOpts.length == 0) {
                alert("Nothing to move.");
                e.preventDefault();
            }

            $('#lstBox1').append($(selectedOpts).clone());
            $(selectedOpts).remove();
            e.preventDefault();
        });

    }(jQuery));

    $('#promotion_forms').validate({ // initialize the plugin
        rules: {
            year_id: {
                required: true
            },
            next_year_id: {
                required: true,
                notEqualTo: "#year_id"
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
            url: "<?php echo base_url(); ?>promotion/create_promotion",
             type:'POST',
            data: $('#promotion_forms').serialize(),
            success: function(response) {
                if(response=="success"){
                 //  swal("Success!", "Thanks for Your Note!", "success");
                   $('#promotion_forms')[0].reset();
                   swal({
            title: "Wow!",
            text: "Message!",
            type: "success"
        }, function() {
             location.reload();
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
</script>
