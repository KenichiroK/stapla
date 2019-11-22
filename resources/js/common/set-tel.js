$(function () {
  const tel_front = document.getElementById('tel_front');
  const tel_middle = document.getElementById('tel_middle');
  const tel_back = document.getElementById('tel_back');
  const tel = document.getElementById('tel');

  function setTel() {
    tel.value = tel_front.value + tel_middle.value + tel_back.value;
    console.log(tel.value);
  }

  tel_front.addEventListener("change", setTel);
  tel_middle.addEventListener('change', setTel);
  tel_back.addEventListener('change', setTel);

  window.onload = function () {
    setTel();
  }

})
