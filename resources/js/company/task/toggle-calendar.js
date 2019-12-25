import "jquery-datetimepicker/build/jquery.datetimepicker.full";
import "jquery-datetimepicker/jquery";

$(function() {
  $("#start_calendar").datetimepicker();
  $("#start_calendar_icon").on("click", function() {
    $("#start_calendar").focus();
  });

  $("#end_calendar").datetimepicker();
  $("#end_calendar_icon").on("click", function() {
    $("#end_calendar").focus();
  });
});
