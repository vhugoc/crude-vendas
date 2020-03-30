$(function () {
  $('#login_form').submit(function (e) {
    e.preventDefault(false);

    var form = $('#login_form')[0];
    var fd = new FormData(form);

    $('#login_form button').prop('disabled', true);

    $.ajax({
      type: "POST",
      enctype: 'multipart/form-data',
      url: 'http://localhost:8000/api/signin',
      data: fd,
      processData: false,
      contentType: false,
      success: function (response) {
        if (!response.success) {
          $('.debug').html("Login e/ou senha incorreto(s)").slideDown();
          $('input[name="login"]').focus();
        } else {
          sessionStorage.setItem('auth_token', response.token);
          sessionStorage.setItem('login', response.user.login);
          sessionStorage.setItem('name', response.user.name);
          window.location.href = 'index.php';
        }
        $("#login_form button").prop("disabled", false);
      }, error: function () {
        $('.debug').html("Preencha os campos corretamente").slideDown();
        $('input[name="login"]').focus();
        $("#login_form button").prop("disabled", false);
      }
    });

  });
});