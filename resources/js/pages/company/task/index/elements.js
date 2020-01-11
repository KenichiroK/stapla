const elementObject = {
  tasks: document.querySelectorAll(".task_item"),
  taskMoreBtnElement: document.getElementById("task_more_btn_area"),
  taskMoreBtn: document.getElementById("task_more_btn"),

  taskStatusTable: document.getElementById("task_status_table"),
  orderStatusTable: document.getElementById("order_status_table"),
  workingStatusTable: document.getElementById("working_status_table"),
  invoiceStatusTable: document.getElementById("invoice_status_table"),
  completeStatusTable: document.getElementById("complete_status_table"),

  taskStatusBtn: document.getElementById("task_status_btn"),
  orderStatusBtn: document.getElementById("order_status_btn"),
  workingStatusBtn: document.getElementById("working_status_btn"),
  invoiceStatusBtn: document.getElementById("invoice_status_btn"),
  completeStatusBtn: document.getElementById("complete_status_btn"),
};

export default elementObject;
