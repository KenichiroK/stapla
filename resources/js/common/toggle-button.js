window.onload = function() {
  window.onsubmit = function() {
    const btns = document.querySelectorAll('button[type="submit"]');
    for (let i = 0; i < btns.length; i++) {
      btns[i].setAttribute("disabled", "disabled");
    }
  };
};

// NOTE: カスタム属性は他ライブラリと被らないようにimproの文字列を追加
const onceBtns = document.querySelectorAll('button[data-impro-button="once"]');
for (let i = 0; i < onceBtns.length; i++) {
  onceBtns[i].addEventListener("click", () => {
    onceBtns[i].setAttribute("disabled", "disabled");
  });
}
