// HACK: resources/js/company/task/toggle-calendar.jsと共通化

import "jquery-datetimepicker/build/jquery.datetimepicker.full";
import "jquery-datetimepicker/jquery";

$(function() {
  $("#contract-date-input").datetimepicker({ timepicker: false, format: "Y/m/d" });
  $("#calender-icon").on("click", function() {
    $("#contract-date-input").focus();
  });
});
