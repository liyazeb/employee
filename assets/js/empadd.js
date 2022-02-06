
  $('#quickForm').validate({
    rules: {
      email: {
        required: true,
        email: true,
        remote:{
          url: base_url+"employee/checkemail",
          type: "post",
          data: 
          {
            email: function(){ return $("#email").val(); },
            empID: function(){ return $("#empID").val(); }
          }
        }  
      },
      name: {
        required: true
      },
      designation: {
        required: true
      },
      status: {
        required: true
      },
    },
    messages: {
      email: {
        required: "Please enter a email address",
        email: "Please enter a valid email address",
        remote: "Already used"
      },
      name: {
        required: "Please provide a name"
      },
      designation: {
        required: "Please provide a designation"
      },
      status: {
        required: "Please provide a status"
      },
      submitHandler: function (form) {
        form.submit();
      }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });