const terms = document.getElementById("terms");
const checkbox = document.getElementById("checkbox");
const registerBtn = document.getElementById("register_btn");

window.onload = () => {
  checkbox.disabled = true;
  registerBtn.disabled = true;
};

checkbox.addEventListener("click", () => {
  registerBtn.disabled = !checkbox.checked;
});

terms.addEventListener("scroll", e => {
  if (e.target.clientHeight + event.target.scrollTop === event.target.scrollHeight) {
    checkbox.disabled = false;
  }
});

// 何度もクリックされるのを防ぐ
registerBtn.addEventListener("click", () => {
  if (!registerBtn.disabled) {
    registerBtn.disabled = true;
  }
});
