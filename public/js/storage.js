$(function () {
  var path = window.location.pathname;
  var page = path.split("/").pop();

  if (!sessionStorage.getItem('auth_token') && (page != "login.php" && page != "register.php")) {
    window.location.href = "login.php";
  } else if (sessionStorage.getItem('auth_token') && (page === "login.php" || page === "register.php")) {
    window.location.href = "index.php";
  }

  $('#logout').on('click', function (){
    sessionStorage.clear();
    window.location.href = "login.php?logout=true";
  });

  $('.name').text(sessionStorage.getItem('name'));

  if (page == "index.php") {
    $('.page-title').html("Dashboard");
  } else {
    $('.page-title').html("Vendas");
  }

});
