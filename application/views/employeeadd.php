
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
            <h1>Employee <?php if(isset($curntdata)){ echo 'Edit'; }else{ echo 'Add';} ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url();?>employee">Dashboard</a></li>
              <li class="breadcrumb-item active"><a href="<?=base_url();?>employeelist">Employee List</a></li>
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
              <form id="quickForm" method="POST" enctype="multipart/form-data" >
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="name">Name *</label>
                        <input type="text" name="name" class="form-control" id="name" value="<?php if(isset($curntdata)){ echo $curntdata[0]['empName']; } ?>" placeholder="Enter Name" required>
                      </div>
                      <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" name="email" id="email" value="<?php if(isset($curntdata)){ echo $curntdata[0]['empEmail']; } ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter email" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="designation">Designation *</label>
                        <select id="designation" name="designation" class="form-control custom-select" required>
                          <option value="" selected disabled>Select one</option>
                          <?php
                          if(count($designation)>0){
                            foreach($designation as $desig){
                              $selected='';
                              if(isset($curntdata) && $desig['desigID']==$curntdata[0]['empDesig']){
                                $selected='selected';
                              }
                              echo '<option value="'.$desig['desigID'].'" '.$selected.' >'.$desig['designation'].'</option>';
                            }
                          }
                          ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="status">Status *</label>
                        <select id="status" name="status" class="form-control custom-select" required>
                          <option value="" selected disabled>Select one</option>
                          <option value="Active" <?php if(isset($curntdata) && $curntdata[0]['empStatus']=='Active'){ echo 'selected'; } ?>>Active</option>
                          <option value="Inactive" <?php if(isset($curntdata) && $curntdata[0]['empStatus']=='Inactive'){ echo 'selected'; } ?>>Inactive</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group">
                          <div class="btn">
                            <label>Upload Photo </label>
                              <input type="file" class="file-upload-thumb" name="profilePic" id="profilePic" <?php if(isset($curntdata) && $curntdata[0]['empImgName']){echo 'value="'.$curntdata[0]['empImgName'].'"';}?>  onchange='readURLthumb(this);' accept="image/png, image/jpeg" >
                          </div> 
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">               
                        <img src="<?php if(isset($curntdata) && $curntdata[0]['empImgName']){ echo base_url().'uploads/'.$curntdata[0]['empImgName'];}else{echo base_url().'uploads/noimage.png';} ?>" id="propic" style="width:100px;height:auto;">
                          <span style="color:red;" class="imgErr"></span>
                    </div>
                  </div>
                </div>
                <input type="hidden" name="empID" id="empID" value="<?php if(isset($curntdata)){ echo $curntdata[0]['empID']; } ?>">
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="submitbtn" id="submitbtn" value="submit" class="btn btn-primary">Submit</button>
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

<script>
  var base_url = "<?php echo base_url(); ?>";
</script>
<!-- jquery-validation -->
<script src="<?=base_url();?>plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?=base_url();?>plugins/jquery-validation/additional-methods.min.js"></script>
<script src="<?=base_url();?>assets/js/empadd.js"></script>

  <script>
    // cover image preview
var readURLthumb = function(input) {
  if (input.files && input.files[0]) {

    var file = input.files[0];
    var _URL = window.URL || window.webkitURL;
    img = new Image();
    img.src = _URL.createObjectURL(file);
    img.onload = function() {
        var sizeKB = file.size / 1024;
        //console.log(sizeKB);
        if(sizeKB>5000){         
          //alert('Please Select Image with maximum size 5mb');
          $('.imgErr').html('Please Select Image with maximum size 5mb');
          $('#submitbtn').attr('disabled',true);
        }else{
          $('.imgErr').html('');
          $('#submitbtn').attr('disabled',false);       
          
        }
      
    }
    ////////////
    var reader = new FileReader();
    
    reader.onload = function (e) {
      $('#propic').attr('src', e.target.result );
      $('#propic').hide();
      $('#propic').fadeIn(650);
    }

    reader.readAsDataURL(input.files[0]);
  }
}
$(".file-upload-thumb").on('change', function(){
  readURLthumb(this);
});
  </script>

</body>
</html>
