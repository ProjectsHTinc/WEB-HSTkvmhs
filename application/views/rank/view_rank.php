<style>
   .formdesign
   {
   padding-bottom: 48px;
   padding-top: 10px;
   border-radius: 12px;
   }
</style>
<div class="main-panel">
   <div class="content">
      <?php if($this->session->flashdata('msg')): ?>
      <div class="alert alert-success">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
         ×</button> <?php echo $this->session->flashdata('msg'); ?>
      </div>
      <?php endif; ?>
      <div class="content">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
                  <div class="card">
                     <div class="content">
                        <div class="fresh-datatables">
                           <h4 class="title" style="padding-bottom:10px;">List of Rank
                            <button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-bottom:10px;">Go Back</button> </h4>
                           <div class="toolbar">
                              <!--  Here you can write extra buttons/actions for the toolbar -->
                           </div>
                       <table id="example" class="table table-striped table-no-bordered table-hover" cellspacing="0" >
                          <thead>
                             <th>S.no</th>
                             <th>Student-Name</th>
                             <th>Class</th>
                             <th>Total</th>
                             <th>Status</th>
                          </thead>
                          <tbody>
                          <?php
                            $s=1;
                            if(!empty($cls_rank))
                            {
                              foreach ($cls_rank as $rows)
                              { 
                                $sts=$rows->Subject_marks;
                                $im=$rows->inm;
                                $em=$rows->exm;
                                $c=explode(',',$sts);
                                $in=explode(',',$im);
                                $e=explode(',',$em);
                                $co=count($c);
                                $cc=array_count_values($c);
                               ?>
                              <tr>
                                <td><?php echo $s; ?></td>
                                <td><?php echo $rows->name; ?></td>
                                <td><?php echo $rows->class_name; ?> ( <?php echo $rows->sec_name; ?> ) </td>
                                <td><?php echo $rows->total; ?></td>
                                <td>
                                <?php 
                                 foreach ($cc as $key => $value) 
                                 {
                                   if($key=='Fail')
                                   { 
                                      echo'<span style=color:red;> ';  echo $key; echo'</span>';
                                    }else{
                                       for($i=0;$i<$co;++$i)
                                       { 
                                         if(!is_numeric(($in[$i])) || !is_numeric(($e[$i])) )
                                         {
                                           echo'<span style=color:red;> '; echo"Fail"; echo'</span>';
                                        }
                                      } 
                                    }  
                                 }
                                // for($i=0;$i<$co;++$i)
                                // { 
                                //  if($c[$i]=="Fail" || !is_numeric(($in[$i])) || !is_numeric(($e[$i])) )
                                //   {
                                //     echo'<span style=color:red;> '; echo"Fail"; echo'</span>';
                                //   }else{
                                //    //echo "Pass";
                                //   } 
                                // } ?> 
                                </td>
                             </tr>
                             <?php  $s++;  } } ?>
                          </tbody>
                       </table>
                        </div>
                     </div>
                     <!-- end content-->
                  </div>
                  <!--  end card  -->
               </div>
               <!-- end col-md-12 -->
            </div>
            <!-- end row -->
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   $(document).ready(function() {
   jQuery('#rank').addClass('collapse in');
   $('#rank').addClass('active');
   $('#rank').addClass('active');
   $('#example').DataTable({
      dom: 'lBfrtip',
      buttons: [
           {
               extend: 'excelHtml5',
               exportOptions: {
               columns: ':visible'
               }
           },
           {
               extend: 'pdfHtml5',
               exportOptions: {
               columns: ':visible'
               }
           },
           'colvis'
       ],
       "pagingType": "full_numbers",
       "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
       responsive: true,
       language: {
       search: "_INPUT_",
       searchPlaceholder: "Search records",
       }
         });
      });
   
       
</script>

