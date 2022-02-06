
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
            <h1>Employee List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url();?>employee">Dashboard</a></li>
              <li class="breadcrumb-item "><a href="<?=base_url();?>employeeadd">Add Employee</a></li>
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
          <h3 class="card-title">Employee</h3>

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
          <table class="table table-striped projects" id="empTbl" >
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Designation</th>
                      <th class="text-center">Status</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                <?php 
                $i=0;
                foreach($employees as $empVal){
                  $i++;
                  $passingID = $empVal['empID'];
                ?>

                  <tr>
                    <?php echo '<td>'.$i.'</td>';?>
                      <td>
                          <a>
                            <?php echo $empVal['empName']; ?>
                          </a>
                          <br/>
                          <small>
                            <?php 
                            $date = date_create($empVal['empCreatedOn']);
                            $date = date_format($date, "d.m.Y");
                            echo 'Created '.$date; ?>
                          </small>
                      </td>
                      <td>
                        <?php echo $empVal['empEmail']; ?>
                      </td>
                      <td>
                        <?php echo $empVal['designation']; ?>
                      </td>
                      <td class="project-state">
                        <?php
                        if($empVal['empStatus']=='Active'){
                        ?>
                          <span class="badge badge-success">Active</span>
                          <input type="hidden" value="Active">
                        <?php }else{ ?>
                          <span class="badge badge-secondary">Inactive</span>
                          <input type="hidden" value="Inactive">
                        <?php } ?>
                      </td>
                      <td class="project-actions d-flex">
                          <!--<a class="btn btn-primary btn-sm" href="#">
                              <i class="fas fa-folder">
                              </i>
                              View
                          </a>-->
                          <form method="POST" action="<?=base_url();?>empledit">
                            <button class="btn btn-info btn-sm" name="editID" type="submit" value="<?=$passingID;?>">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                            </button>
                          </form>
                          <form method="POST" name="form" name="form" action="<?=base_url();?>empldelete">
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
              <tfoot>
                <tr>
                    <th></th>
                    <th >Name</th>
                    <th>Email</th>
                    <th >Designation</th>
                    <th >Status</th>
                    <th ></th>
                </tr>
            </tfoot>
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

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>.

<script >
 // Setup - add a text input to each footer cell
    $('#empTbl tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#empTbl').DataTable({
        initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                var that = this;
 
                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }
    });
</script>
<script type='text/javascript'>
  $(document).ready(function(){
  $('.deletecgry').click(function(e){
  e.preventDefault;
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
