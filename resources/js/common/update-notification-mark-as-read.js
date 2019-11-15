$(function () {
  function update() {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      url: `${$('meta[name="url"]').attr('content')}/notification/mark_as_read`,
      data: { user_id: $('meta[name="auth-id"]').attr('content') },
      dataType: 'json'
    }).done(function (data) {
      $('#stylesheet').html('button[data-badge]:after{display: none}');
    }).fail(function (e) {
      // 失敗処理
    });
  }

  $('#notification_icon').on('click', update);
});
