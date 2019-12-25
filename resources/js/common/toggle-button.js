window.onload = function() {
  window.onsubmit = function() {
    let btns = document.querySelectorAll('button[type="submit"]');
    for (let i = 0; i < btns.length; i++) {
      btns[i].setAttribute("disabled", "disabled");
    }
  };
};
