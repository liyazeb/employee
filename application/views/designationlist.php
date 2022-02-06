
<?php
 $this->load->view('includes/headertop');
 echo '<link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css" />';
 $this->load->view('includes/sidebar');
?>
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Designation</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url();?>employee">Dashboard</a></li>
              <li class="breadcrumb-item "><a href="<?=base_url();?>designationadd">Add Designations</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->

          <?php
          if($this->session->flashdata('msg')){
            echo '<center><h5 style="color:red;">'.$this->session->flashdata('msg').'</h5></center>';
          }
          ?>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Designations</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
           <!-- <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>-->
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects" id="desigTbl">
              <thead>
                  <tr>
                      <th style="width: 20%">
                          #
                      </th>
                      <th style="width: 30%">
                          Name
                      </th>
                      <th style="width: 20%" class="text-center">
                          Status
                      </th>
                      <th style="width: 30%">
                        Action
                      </th>
                  </tr>
              </thead>
              <tbody>
                <?php 
                $i=0;
                foreach($designation as $desigVal){
                  $i++;
                  $passingID = $desigVal['desigID'];
                ?>

                  <tr>
                    <?php echo '<td>'.$i.'</td>';?>
                      <td>
                          <a>
                            <?php echo $desigVal['designation']; ?>
                          </a>
                          <br/>
                          <small>
                            <?php 
                            $date = date_create($desigVal['createdOn']);
                            $date = date_format($date, "d.m.Y");
                            echo 'Created '.$date; ?>
                          </small>
                      </td>
                      <td class="project-state">
                        <?php
                        if($desigVal['desigstatus']=='Active'){
                        ?>
                          <span class="badge badge-success">Active</span>
                        <?php }else{ ?>
                          <span class="badge badge-secondary">Inactive</span>
                        <?php } ?>
                      </td>
                      <td class="project-actions d-flex">
                          <!--<a class="btn btn-primary btn-sm" href="#">
                              <i class="fas fa-folder">
                              </i>
                              View
                          </a>-->
                          <form method="POST" action="<?=base_url();?>designationedit">
                            <button class="btn btn-info btn-sm" name="editID" type="submit" value="<?=$passingID;?>">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                            </button>
                          </form>
                          <form method="POST" name="desigdeleteform" action="<?=base_url();?>designationdelete">
                            <button class="btn btn-danger btn-sm ml-2 deletecgry" name="deleteID" type="submit" value="<?=$passingID;?>">
                                <i class="fas fa-trash">
                                </i>
                                Delete
                            </button>
                          </form>
                      </td>
                  </tr>
                  <?php } ?>
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
 $this->load->view('includes/footer');
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>.

<script >
    $('#desigTbl').dataTable();
</script>
<script type='text/javascript'>
  $(document).ready(function(){
    $('.deletecgry').click(function(e){
      e.preventDefault;
      var deleteID=$(this).val();
       
      if(confirm('Are you sure to delete?'))
      {
         return true; 
      }
      else
      {
        return false;
      }
    });
  });
</script>  
</body>
</html>
