// HACK: resources/js/company/task/toggle-calendar.jsと共通化

import "jquery-datetimepicker/build/jquery.datetimepicker.full";
import "jquery-datetimepicker/jquery";

$(function() {
  $("#contract_date_input").datetimepicker({
    timepicker: false,
    format: "Y-m-d",
  });
  $("#calender_icon").on("click", function() {
    $("#contract_date_input").focus();
  });

  $("#contract_date_input").on("onselect", function() {
    console.log("testing");
  });
});

document.getElementById("company_name").addEventListener("input", updateText);
document.getElementById("company_address").addEventListener("input", updateText);
document.getElementById("representive_name").addEventListener("input", updateText);
document.getElementById("partner_name").addEventListener("input", updateText);
document.getElementById("partner_address").addEventListener("input", updateText);
document.getElementById("contract_date_input").addEventListener("input", updateDate);

function updateText(e) {
  const targetElement = document.getElementById(`c_${e.target.id}`);

  // HACK: いけてない気もする
  const targetElement2 = document.getElementById(`c_${e.target.id}_2`);
  if (targetElement2) {
    targetElement2.textContent = e.target.value;
  }

  if (e.target.value && targetElement) {
    targetElement.textContent = e.target.value;
    return;
  }

  switch (e.target.id) {
    case "company_name":
      targetElement.textContent = "【企業名を入力してください】";
      targetElement2.textContent = "【企業名を入力してください】";
      break;

    case "partner_name":
      targetElement.textContent = "【パートナー名を入力してください】";
      targetElement2.textContent = "【パートナー名を入力してください】";
      break;

    case "company_address":
      targetElement.textContent = "【企業住所を入力してください】";
      break;

    case "representive_name":
      targetElement.textContent = "【企業代表者名を入力してください】";
      break;

    case "partner_address":
      targetElement.textContent = "【パートナ住所を入力してください】";
      break;

    default:
      break;
  }
}

function updateDate(e) {
  const targetElement = document.getElementById(`c_${e.target.id}`);
  if (e.target.value && targetElement) {
    const dateString = new Date(e.target.value).toLocaleDateString("ja-JP-u-ca-japanese", {
      era: "long",
      year: "numeric",
      month: "long",
      day: "numeric",
    });

    targetElement.textContent = dateString;
    return;
  }

  targetElement.textContent = "【契約締結日を入力してください】";
}
