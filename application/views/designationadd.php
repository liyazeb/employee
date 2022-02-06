
<?php
 $this->load->view('includes/headertop');
 $this->load->view('includes/sidebar');
?>
    

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Designation <?php if(isset($curntdata)){ echo 'Edit'; }else{ echo 'Add';} ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url();?>employee">Dashboard</a></li>
              <li class="breadcrumb-item active"><a href="<?=base_url();?>designationlist">Designation List</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?php if(isset($curntdata)){ echo 'Edit'; }else{ echo 'Add';} ?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="desigForm" method="POST" >
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name *</label>
                    <input type="text" name="name" class="form-control" id="name" value="<?php if(isset($curntdata)){ echo $curntdata[0]['designation']; } ?>" placeholder="Enter Name" required>
                  </div>
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" required class="form-control custom-select">
                      <option value="" selected disabled>Select one</option>
                      <option value="Active" <?php if(isset($curntdata) && $curntdata[0]['desigstatus']=='Active'){ echo 'selected'; } ?>>Active</option>
                      <option value="Inactive" <?php if(isset($curntdata) && $curntdata[0]['desigstatus']=='Inactive'){ echo 'selected'; } ?>>Inactive</option>
                    </select>
                  </div>
                </div>
                <?php if(isset($curntdata)){ echo '<input type="hidden" name="desigID" value="'.$curntdata[0]['desigID'].'">'; } ?>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="submitbtn" value="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
 $this->load->view('includes/footer');
?>
<!-- jquery-validation -->
<script src="<?=base_url();?>plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?=base_url();?>plugins/jquery-validation/additional-methods.min.js"></script>
<script src="<?=base_url();?>assets/js/desigadd.js"></script>

</body>
</html>
