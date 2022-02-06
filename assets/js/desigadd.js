
  $('#desigForm').validate({
    rules: {
      name: {
        required: true,
      },
      status: {
        required: true
      },
    },
    messages: {
      name: {
        required: "Please enter a designation"
      },
      status: {
        required: "Please provide a password"
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