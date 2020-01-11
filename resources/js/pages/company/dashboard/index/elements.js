const elementObject = {
  allTodosItems: document.querySelectorAll(".all_todo_item"),
  todoMoreBtnElement: document.getElementById("all_todo_more_btn_area"),
  allTodoBtn: document.getElementById("all_todo_more_btn"),

  passed3DaysTodoItems: document.querySelectorAll(".passed_3days_todo_item"),
  passed3DaysMoreBtnElement: document.getElementById("passed_3days_todo_more_btn_area"),
  passed3DaysMoreBtn: document.getElementById("passed_3days_todo_more_btn"),

  projects: document.querySelectorAll(".project_item"),
  projectMoreBtnElement: document.getElementById("project_more_btn_area"),
  projectMoreBtn: document.getElementById("project_more_btn"),

  tasks: document.querySelectorAll(".task_item"),
  taskMoreBtnElement: document.getElementById("task_more_btn_area"),
  taskMoreBtn: document.getElementById("task_more_btn"),

  allTodos: document.getElementById("all_todos"),
  passed3DaysTodos: document.getElementById("passed_3days_todos"),
  toggleTodoBtn: document.getElementById("toggle_todo_btn"),

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
