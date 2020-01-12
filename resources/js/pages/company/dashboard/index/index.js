import { clickMoreBtn, showDefaultElement } from "@/modules/more-btn/logic";
import { switchShownItem, switchIsActiveBtn } from "@/modules/switch-btn/logic";
import { displayType } from "@/modules/switch-btn/type";

// todo morebtn
let todoDefaultShowNum = 4;
const todoMoreShowNum = 4;

const allTodosItems = document.querySelectorAll(".all_todo_item");
const todoMoreBtnElement = document.getElementById("all_todo_more_btn_area");
const allTodoBtn = document.getElementById("all_todo_more_btn");

allTodoBtn.addEventListener("click", () => {
  clickMoreBtn(todoDefaultShowNum, todoMoreShowNum, allTodosItems, todoMoreBtnElement);
});

//pass 3 days todos morebtn
let pass3DaysTodoDefaultShowNum = 4;
const pass3DaysTodoMoreShowNum = 4;

const passed3DaysTodoItems = document.querySelectorAll(".passed_3days_todo_item");
const passed3DaysMoreBtnElement = document.getElementById("passed_3days_todo_more_btn_area");
const passed3DaysMoreBtn = document.getElementById("passed_3days_todo_more_btn");

passed3DaysMoreBtn.addEventListener("click", () => {
  pass3DaysTodoDefaultShowNum = clickMoreBtn(
    pass3DaysTodoDefaultShowNum,
    pass3DaysTodoMoreShowNum,
    passed3DaysTodoItems,
    passed3DaysMoreBtnElement,
  );
});

// project morebtn
let projectDefaultShowNum = 5;
const projectMoreShowNum = 5;

const projects = document.querySelectorAll(".project_item");
const projectMoreBtnElement = document.getElementById("project_more_btn_area");
const projectMoreBtn = document.getElementById("project_more_btn");

projectMoreBtn.addEventListener("click", () => {
  projectDefaultShowNum = clickMoreBtn(projectDefaultShowNum, projectMoreShowNum, projects, projectMoreBtnElement);
});

// task morebtn
let taskDefaultShowNum = 5;
const taskMoreShowNum = 5;

const tasks = document.querySelectorAll(".task_item");
const taskMoreBtnElement = document.getElementById("task_more_btn_area");
const taskMoreBtn = document.getElementById("task_more_btn");

taskMoreBtn.addEventListener("click", () => {
  taskDefaultShowNum = clickMoreBtn(taskDefaultShowNum, taskMoreShowNum, tasks, taskMoreBtnElement);
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
const orderStatusTable = document.getElementById("order_status_table");
const workingStatusTable = document.getElementById("working_status_table");
const invoiceStatusTable = document.getElementById("invoice_status_table");
const completeStatusTable = document.getElementById("complete_status_table");
const tableItems = [taskStatusTable, orderStatusTable, workingStatusTable, invoiceStatusTable, completeStatusTable];

const taskStatusBtn = document.getElementById("task_status_btn");
const orderStatusBtn = document.getElementById("order_status_btn");
const workingStatusBtn = document.getElementById("working_status_btn");
const invoiceStatusBtn = document.getElementById("invoice_status_btn");
const completeStatusBtn = document.getElementById("complete_status_btn");
const tabBtns = [taskStatusBtn, orderStatusBtn, workingStatusBtn, invoiceStatusBtn, completeStatusBtn];

taskStatusBtn.addEventListener("click", () => {
  switchShownItem(tableItems, taskStatusTable, displayType.flex);
  switchIsActiveBtn(tabBtns, taskStatusBtn);
});
orderStatusBtn.addEventListener("click", () => {
  switchShownItem(tableItems, orderStatusTable, displayType.flex);
  switchIsActiveBtn(tabBtns, orderStatusBtn);
});
workingStatusBtn.addEventListener("click", () => {
  switchShownItem(tableItems, workingStatusTable, displayType.flex);
  switchIsActiveBtn(tabBtns, workingStatusBtn);
});
invoiceStatusBtn.addEventListener("click", () => {
  switchShownItem(tableItems, invoiceStatusTable, displayType.flex);
  switchIsActiveBtn(tabBtns, invoiceStatusBtn);
});
completeStatusBtn.addEventListener("click", () => {
  switchShownItem(tableItems, completeStatusTable, displayType.flex);
  switchIsActiveBtn(tabBtns, completeStatusBtn);
});

window.onload = () => {
  showDefaultElement(todoDefaultShowNum, allTodosItems, todoMoreBtnElement);
  showDefaultElement(pass3DaysTodoDefaultShowNum, passed3DaysTodoItems, passed3DaysMoreBtnElement);
  showDefaultElement(projectDefaultShowNum, projects, projectMoreBtnElement);
  showDefaultElement(taskDefaultShowNum, tasks, taskMoreBtnElement);
  switchShownItem(todoTables, allTodos, displayType.block);
  switchShownItem(tableItems, taskStatusTable, displayType.flex);
  switchIsActiveBtn(tabBtns, taskStatusBtn);
};
