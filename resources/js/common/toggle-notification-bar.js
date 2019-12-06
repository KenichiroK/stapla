$('#notification_icon').on('click', function () {
  $('#notification_bar').toggleClass('isActive');
});

$('#app').on('click', function (e) {
  if (!$('#notification_bar').hasClass('isActive')) {
    return;
  }

  if (!$(e.target).closest('#notification_icon').length) {
    setTimeout(function () {
      $('#notification_bar').removeClass('isActive');
    }, 100);
  }
});
