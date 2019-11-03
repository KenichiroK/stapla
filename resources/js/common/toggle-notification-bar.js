$(function () {
  function toggleNotificationBar() {
    $('#notification_icon').on('click', function () {
      $('#notification_bar').toggleClass('isActive');
    });
  }

  toggleNotificationBar();
});
