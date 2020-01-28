import { showElements } from "@/modules/more-btn/logic";
import { switchShownItem, switchIsActive } from "@/modules/switch-btn/logic";
import { displayType } from "@/modules/switch-btn/type";

window.onload = () => {
  showElements(todoDefaultShowNum, allTodosItems, todoMoreBtnElement);
  showElements(pass3DaysTodoDefaultShowNum, passed3DaysTodoItems, passed3DaysMoreBtnElement);
  showElements(taskDefaultShowNum, tasks, taskMoreBtnElement);
  switchShownItem(todoTables, allTodos, displayType.block);
  switchShownItem(tableItems, taskStatusTable, displayType.flex);
  switchIsActive(tabBtns, taskStatusBtn);
  switchIsActive(statusNums, taskStatusNum);
};

// todo morebtn
let todoDefaultShowNum = 4;
const todoMoreShowNum = 4;

const allTodosItems = document.querySelectorAll(".all_todo_item");
const todoMoreBtnElement = document.getElementById("all_todo_more_btn_area");
const allTodoBtn = document.getElementById("all_todo_more_btn");

allTodoBtn.addEventListener("click", () => {
  todoDefaultShowNum += todoMoreShowNum;
  showElements(todoDefaultShowNum, allTodosItems, todoMoreBtnElement);
});

//pass 3 days todos morebtn
let pass3DaysTodoDefaultShowNum = 4;
const pass3DaysTodoMoreShowNum = 4;

const passed3DaysTodoItems = document.querySelectorAll(".passed_3days_todo_item");
const passed3DaysMoreBtnElement = document.getElementById("passed_3days_todo_more_btn_area");
const passed3DaysMoreBtn = document.getElementById("passed_3days_todo_more_btn");

passed3DaysMoreBtn.addEventListener("click", () => {
  pass3DaysTodoDefaultShowNum += pass3DaysTodoMoreShowNum;
  showElements(pass3DaysTodoDefaultShowNum, passed3DaysTodoItems, passed3DaysMoreBtnElement);
});

// task morebtn
let taskDefaultShowNum = 5;
const taskMoreShowNum = 5;

const tasks = document.querySelectorAll(".task_item");
const taskMoreBtnElement = document.getElementById("task_more_btn_area");
const taskMoreBtn = document.getElementById("task_more_btn");

taskMoreBtn.addEventListener("click", () => {
  taskDefaultShowNum += taskMoreShowNum;
  showElements(taskDefaultShowNum, tasks, taskMoreBtnElement);
});

// toggle todo
let shownAllTodos = true;
const allTodos = document.getElementById("all_todos");
const passed3DaysTodos = document.getElementById("passed_3days_todos");
const todoTables = [allTodos, passed3DaysTodos];

const toggleTodoBtn = document.getElementById("toggle_todo_btn");

toggleTodoBtn.addEventListener("click", () => {
  shownAllTodos = !shownAllTodos;
  switchShownItem(todoTables, shownAllTodos ? allTodos : passed3DaysTodos, displayType.block);
});

// toggle status table
const taskStatusTable = document.getElementById("task_status_table");
const workingStatusTable = document.getElementById("working_status_table");
const invoiceStatusTable = document.getElementById("invoice_status_table");
const completeStatusTable = document.getElementById("complete_status_table");
const tableItems = [taskStatusTable, workingStatusTable, invoiceStatusTable, completeStatusTable];

const taskStatusBtn = document.getElementById("task_status_btn");
const workingStatusBtn = document.getElementById("working_status_btn");
const invoiceStatusBtn = document.getElementById("invoice_status_btn");
const completeStatusBtn = document.getElementById("complete_status_btn");
const tabBtns = [taskStatusBtn, workingStatusBtn, invoiceStatusBtn, completeStatusBtn];

const taskStatusNum = document.getElementById("task_status_num");
const workingStatusNum = document.getElementById("working_status_num");
const invoiceStatusNum = document.getElementById("invoice_status_num");
const completeStatusNum = document.getElementById("complete_status_num");
const statusNums = [taskStatusNum, workingStatusNum, invoiceStatusNum, completeStatusNum];

taskStatusBtn.addEventListener("click", () => {
  switchShownItem(tableItems, taskStatusTable, displayType.flex);
  switchIsActive(tabBtns, taskStatusBtn);
  switchIsActive(statusNums, taskStatusNum);
});
workingStatusBtn.addEventListener("click", () => {
  switchShownItem(tableItems, workingStatusTable, displayType.flex);
  switchIsActive(tabBtns, workingStatusBtn);
  switchIsActive(statusNums, workingStatusNum);
});
invoiceStatusBtn.addEventListener("click", () => {
  switchShownItem(tableItems, invoiceStatusTable, displayType.flex);
  switchIsActive(tabBtns, invoiceStatusBtn);
  switchIsActive(statusNums, invoiceStatusNum);
});
completeStatusBtn.addEventListener("click", () => {
  switchShownItem(tableItems, completeStatusTable, displayType.flex);
  switchIsActive(tabBtns, completeStatusBtn);
  switchIsActive(statusNums, completeStatusNum);
});
