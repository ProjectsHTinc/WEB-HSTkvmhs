

<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.3/css/fixedHeader.dataTables.min.css">
<script src="https://cdn.datatables.net/fixedheader/3.1.3/js/dataTables.fixedHeader.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.table2excel.js" type="text/javascript"></script>
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
                     <h4 class="title">
                        View Exam Marks( <?php foreach ($cls_exname as $rows) {} echo $rows->exam_name; ?>  )
                        <button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="float:right; ">Go Back</button>
                        <button style="float:right;margin-right: 10px;" class="btn btn-info btn-fill center download">Export Excel</button>
                        <!-- <button style="float:right;margin-right: 10px;" class="btn btn-info btn-fill center" onclick="generatefromtable()">Export PDF</button-->
                     </h4>
                     <p class="category"></p>
                  </div>
                  <div class="content table-responsive table-full-width">
                     <form method="post" action="<?php echo base_url(); ?>examinationresult/marks_status" class="form-horizontal" enctype="multipart/form-data" id="markform">
                        <?php
                           $student_array_generate = function($stu,&$student_arr) use($subject_name,$subject_id)
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
                              <th>Preferred Language</th>
                              <?php
                                 if($status=="Success")
                                  {
                                  $cnt= count($subject_name);//echo $cnt;
                                  for($i=0;$i<$cnt;$i++)
                                  { ?>
                              <th> <?php echo $subject_name[$i]; ?> <?php //echo $subject_id[$i]; ?></th>
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
                                      //echo $s->language;
                                      $k++;
                                 echo'<td>';
                                  if ($s->pref_language!=''){
                                    echo'('; echo' ';  echo $s->pref_language;  echo' '; echo')'; 
								 }
                                 echo'</td>';
                                    }
                                 if($status=="Success")
                                 {
                                 echo '<td>';
                                 echo '<input type="hidden" required  name="subid" value="'.$k1.'" class="form-control"/>';
                                      if(!empty($s))
                                      {
                                        $im=$s->internal_mark;
                                        $em=$s->external_mark;
                                        $tm=$s->total_marks;
                                        //echo $tm;
                                 
                                        foreach($result as $flag){}
                                        $ef=$flag->is_internal_external;
                                         $efsi=$flag->subject_id;
                                 
                                        // if($im==0 && $em==0 && is_numeric($im) && is_numeric($em))
                                          if($ef==0)
                                         {
                                              echo '<span class="grade2">';
                                              if(is_numeric($tm))
                                              {
                                                if($tm <'35'){
                                                     echo'<span class="combat" style="color:red;">';
                                                 echo $s->total_marks; echo "&nbsp";
                                                 echo'</span>';
                                                 echo '<span class="space" style="color:red;">';echo $s->total_grade;echo'</span>';
                                                 }else{
                                                     echo'<span class="combat">';
                                                 echo $s->total_marks; echo "&nbsp";
                                                 echo'</span>';
                                                 echo '<span class="space">';echo $s->total_grade;echo'</span>';
                                                 }   
                                              }else{
                                                //echo"AB";
                                                echo '<span class="space" style="color:red;">';echo $s->total_marks;echo'</span>';
                                                 }
                                            echo'</span>';
                                          }else{
                                                echo '<span class="grade">';
                                              if(is_numeric($im)){
                                              echo $s->internal_mark;  echo "&nbsp";
                                              echo '<span class="space">';echo $s->internal_grade;echo'</span>';
                                              }else{ echo'<span style="color:red;">'; echo $s->internal_mark; echo'</span>'; }
                                              echo'</span>';
                                                  echo "&nbsp";
                                                echo '<span class="grade1">';
                                               if(is_numeric($em)){
                                              echo $s->external_mark;  echo "&nbsp";
                                              echo '<span class="space">';echo $s->external_grade;echo'</span>';
                                            }else{ echo'<span style="color:red;">'; echo $s->external_mark; echo'</span>'; }
                                              echo'</span>';
                                              echo "&nbsp";
                                             echo '<span class="grade2">';
                                               if(is_numeric($tm)){
                                                  if($tm < '35' || !is_numeric($im) || !is_numeric($em)){
                                                    echo'<span class="combat" style="color:red;">';
                                                   echo $s->total_marks; echo "&nbsp";
                                                  echo'</span>';
                                             echo '<span class="space" style="color:red;">';echo $s->total_grade;echo'</span>';
                                                   }else{
                                                  echo'<span class="combat">';
                                                   echo $s->total_marks; echo "&nbsp";
                                                  echo'</span>';
                                             echo '<span class="space">';echo $s->total_grade;echo'</span>';
                                                  }
                                            
                                               }else{  echo $s->total_marks; }
                                             echo'</span>';
                                          }
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
                                 } //print_r($smark);
                                   if(!empty($smark)){ echo "";}else{ ?>
                              <tr>
                                 <td></td>
                                 <td></td>
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
<?php
   foreach ($cls_exname as $rows) {} $cls=$rows->class_name; $sec=$rows->sec_name;
   // echo $cls; echo $sec; ?>
<script type="text/javascript">

  $(document).ready(function(){
   $('th').attr('class','-');
 });

   $('tr').each(function () {
          var sum = 0;
        $(this).find('.combat').each(function () {
            var combat1 = $(this).text();
            //alert(combat1);
            if (combat1 !='NA') {
                sum += parseInt(combat1);
            }
        });
        $(this).find('.total-combat').html(sum);
      });
   
   $('#examinationmenu').addClass('collapse in');
   $('#exam').addClass('active');
   $('#exam4').addClass('active');
   
   $('#markform').validate({ // initialize the plugin
           rules: {
               totalmarks:{required:true,number:true }
           },
           messages: {
                 totalmarks: "Please Enter The Marks"
   
               }
       });
   
   var $table = $('#bootstrap-table');
         $(document).ready(function(){
           jQuery('#markform').addClass('collapse in');
             $table.bootstrapTable({
                 toolbar: ".toolbar",
                 clickToSelect: true,
                 showRefresh: true,
                 search: true,
                 showToggle: true,
                 showColumns: true,
                 pagination: true,
                 searchAlign: 'left',
                 pageSize:50,
                 clickToSelect: false,
                 pageList: [10,25,50,100],
   
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
   
   function generatefromtable() 
   {
    var data = [], fontSize =10, height = 0, doc;
    doc = new jsPDF('p', 'pt', 'a3', true);
    doc.setFont("times", "normal");
    doc.setFontSize(fontSize);
    doc.text(40,20, "Exam Result Of ( <?php echo $cls; echo $sec; ?> )");
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
   
   $(function() {
   $(".download").click(function() {
   $("#bootstrap-table").table2excel({
      exclude: ".noExl",
      name: "Excel Document Name",
      filename: "Exam Result Of ( <?php echo $cls; echo $sec; ?> ) ",
      fileext: ".xls",
      exclude_img: true,
      exclude_links: true,
      exclude_inputs: true
    });
   });
   
   });
   
   var table = $('#bootstrap-table').DataTable( {
       responsive: true,
       paging: false
   } );
   new $.fn.dataTable.FixedHeader( table );
</script>

