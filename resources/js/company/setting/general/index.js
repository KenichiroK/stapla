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


window.onload = function () {
  setPostal();
}
