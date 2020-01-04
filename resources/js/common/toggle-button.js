window.onload = function() {
  window.onsubmit = function() {
    let btns = document.querySelectorAll('button[type="submit"]');
    for (let i = 0; i < btns.length; i++) {
      btns[i].setAttribute("disabled", "disabled");
    }
  };
};

$(function() {
  $("input").keydown(function(e) {
    if ((e.which && e.which === 13) || (e.keyCode && e.keyCode === 13)) {
      return false;
    } else {
      return true;
    }
  });
});
