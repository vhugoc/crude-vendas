$(function () {
  $('#register_form').submit(function (e) {
    e.preventDefault(false);

    var form = $('#register_form')[0];
    var fd = new FormData(form);

    $('#register_form button').prop('disabled', true);

    $.ajax({
      type: "POST",
      enctype: 'multipart/form-data',
      url: 'http://localhost:8000/api/register',
      data: fd,
      processData: false,
      contentType: false,
      success: function (response) {
        if (response.success) {
          window.location.href = `login.php?login=${$('input[name="login"]').val()}`;
        }
        $("#register_form button").prop("disabled", false);
      }, error: function (response) {
        if (response.responseJSON.login.length && response.responseJSON.login[0] == "The login has already been taken.") {
          $('.debug').html("Esse login já existe, inicie uma sessão para continuar").slideDown();
        }else {
          $('.debug').html("Preencha os campos corretamente").slideDown();
        }
        $('input[name="name"]').focus();
        $("#register_form button").prop("disabled", false);
      }
    });

  });
});