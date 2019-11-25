$('#user_name').click(function () {
  $('#header_ballon').toggleClass('isActive');
});

$('#app').on('click', function (e) {
  if (!$('#header_ballon').hasClass('isActive')) {
    return;
  }

  if (!$(e.target).closest('#user_name').length) {
    setTimeout(function () {
      $('#header_ballon').removeClass('isActive');
    }, 100);
  }
});
