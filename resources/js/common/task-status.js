window.onload = function () {
  var url_task_status = location.href.split("/")[
    location.href.split("/").length - 1
  ];

  var completeLabel = document.getElementById("complete_label");
  var nonCompleteLabel = document.getElementById("non_complete_label");
  function setCompleteLabel() {
    completeLabel.classList.add("isActive");
    nonCompleteLabel.classList.remove("isActive");
  }
  function setNonCompleteLabel() {
    completeLabel.classList.remove("isActive");
    nonCompleteLabel.classList.add("isActive");
  }
  url_task_status === "17" ? setCompleteLabel() : setNonCompleteLabel();
};
