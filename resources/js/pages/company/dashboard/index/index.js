import { clickMoreBtn, showDefaultElement } from "@/modules/more-btn/logic";
import { switchShownItem, switchIsActiveBtn } from "@/modules/switch-btn/logic";
import { displayType } from "@/modules/switch-btn/type";
import {
  allTodosItems,
  todoMoreBtnElement,
  allTodoBtn,
  passed3DaysTodoItems,
  passed3DaysMoreBtnElement,
  passed3DaysMoreBtn,
  projects,
  projectMoreBtnElement,
  projectMoreBtn,
  tasks,
  taskMoreBtnElement,
  taskMoreBtn,
  allTodos,
  passed3DaysTodos,
  todoTables,
  toggleTodoBtn,
  taskStatusTable,
  orderStatusTable,
  workingStatusTable,
  invoiceStatusTable,
  completeStatusTable,
  taskStatusBtn,
  orderStatusBtn,
  workingStatusBtn,
  invoiceStatusBtn,
  completeStatusBtn,
} from "./elements";

// todo morebtn
let todoDefaultShowNum = 4;
const todoMoreShowNum = 4;

allTodoBtn.addEventListener("click", () => {
  clickMoreBtn(todoDefaultShowNum, todoMoreShowNum, allTodosItems, todoMoreBtnElement);
});

//pass 3 days todos morebtn
let pass3DaysTodoDefaultShowNum = 4;
const pass3DaysTodoMoreShowNum = 4;

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

projectMoreBtn.addEventListener("click", () => {
  projectDefaultShowNum = clickMoreBtn(projectDefaultShowNum, projectMoreShowNum, projects, projectMoreBtnElement);
});

// task morebtn
let taskDefaultShowNum = 5;
const taskMoreShowNum = 5;

taskMoreBtn.addEventListener("click", () => {
  taskDefaultShowNum = clickMoreBtn(taskDefaultShowNum, taskMoreShowNum, tasks, taskMoreBtnElement);
});

// toggle todo
let shownAllTodos = true;

toggleTodoBtn.addEventListener("click", () => {
  shownAllTodos = !shownAllTodos;
  switchShownItem(todoTables, shownAllTodos ? allTodos : passed3DaysTodos, displayType.block);
});

// toggle status table
const tableItems = [taskStatusTable, orderStatusTable, workingStatusTable, invoiceStatusTable, completeStatusTable];
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
