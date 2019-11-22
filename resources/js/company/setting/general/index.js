// 郵便番号
const postalFront = document.getElementById('postal_front');
const postalBack = document.getElementById('postal_back');

function setPostal() {
  const postal = document.getElementById('postal');
  postal.value = postalFront.value + postalBack.value;
}

// 郵便番号自動遷移
function nextField() {
  if (postalFront.value.length >= 3) {
    postalBack.focus();
  }
}

postalFront.addEventListener('change', setPostal);
postalBack.addEventListener('change', setPostal);

postalFront.addEventListener('keyup', nextField);

// 電話番号
const telFront = document.getElementById('tel_front');
const telMiddle = document.getElementById('tel_middle');
const telBack = document.getElementById('tel_back');
const tel = document.getElementById('tel');

function setTel() {
  tel.value = telFront.value + telMiddle.value + telBack.value;
}

telFront.addEventListener("change", setTel);
telMiddle.addEventListener('change', setTel);
telBack.addEventListener('change', setTel);


window.onload = function () {
  setPostal();
  setTel();
}
