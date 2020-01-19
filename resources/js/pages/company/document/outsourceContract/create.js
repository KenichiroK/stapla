// HACK: resources/js/company/task/toggle-calendar.jsと共通化

import "jquery-datetimepicker/build/jquery.datetimepicker.full";
import "jquery-datetimepicker/jquery";

$(function() {
  $("#contract-date-input").datetimepicker({ timepicker: false, format: "Y/m/d" });
  $("#calender-icon").on("click", function() {
    $("#contract-date-input").focus();
  });
});

document.getElementById("company_name").addEventListener("input", updateText);

function updateText(e) {
  switch (e.target.id) {
    case "company_name":
      const targetElement = document.getElementById("c_company_name");
      if (e.target.value) {
        targetElement.textContent = e.target.value;
        break;
      }
      targetElement.textContent = "【企業を入力してください】";
      break;

    default:
      break;
  }
}
