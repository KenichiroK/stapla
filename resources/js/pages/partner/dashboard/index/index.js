import { clickMoreBtn, showDefaultElement } from "@/modules/more-btn/logic";
import { switchShownItem, switchIsActiveBtn } from "@/modules/switch-btn/logic";
import { displayType } from "@/modules/switch-btn/type";
import elementObject from "./elements";

// todo morebtn
let todoDefaultShowNum = 4;
const todoMoreShowNum = 4;

elementObject.allTodoBtn.addEventListener("click", () => {
  clickMoreBtn(todoDefaultShowNum, todoMoreShowNum, elementObject.allTodosItems, elementObject.todoMoreBtnElement);
});

//pass 3 days todos morebtn
let pass3DaysTodoDefaultShowNum = 4;
const pass3DaysTodoMoreShowNum = 4;

elementObject.passed3DaysMoreBtn.addEventListener("click", () => {
  pass3DaysTodoDefaultShowNum = clickMoreBtn(
    pass3DaysTodoDefaultShowNum,
    pass3DaysTodoMoreShowNum,
    elementObject.passed3DaysTodoItems,
    elementObject.passed3DaysMoreBtnElement,
  );
});

// task morebtn
let taskDefaultShowNum = 5;
const taskMoreShowNum = 5;

elementObject.taskMoreBtn.addEventListener("click", () => {
  taskDefaultShowNum = clickMoreBtn(
    taskDefaultShowNum,
    taskMoreShowNum,
    elementObject.tasks,
    elementObject.taskMoreBtnElement,
  );
});

// toggle todo
let shownAllTodos = true;
const todoTables = [elementObject.allTodos, elementObject.passed3DaysTodos];

elementObject.toggleTodoBtn.addEventListener("click", () => {
  shownAllTodos = !shownAllTodos;
  switchShownItem(
    todoTables,
    shownAllTodos ? elementObject.allTodos : elementObject.passed3DaysTodos,
    displayType.block,
  );
});

// toggle status table
const tableItems = [
  elementObject.taskStatusTable,
  elementObject.orderStatusTable,
  elementObject.workingStatusTable,
  elementObject.invoiceStatusTable,
  elementObject.completeStatusTable,
];
const tabBtns = [
  elementObject.taskStatusBtn,
  elementObject.orderStatusBtn,
  elementObject.workingStatusBtn,
  elementObject.invoiceStatusBtn,
  elementObject.completeStatusBtn,
];

elementObject.taskStatusBtn.addEventListener("click", () => {
  switchShownItem(tableItems, elementObject.taskStatusTable, displayType.flex);
  switchIsActiveBtn(tabBtns, elementObject.taskStatusBtn);
});
elementObject.orderStatusBtn.addEventListener("click", () => {
  switchShownItem(tableItems, elementObject.orderStatusTable, displayType.flex);
  switchIsActiveBtn(tabBtns, elementObject.orderStatusBtn);
});
elementObject.workingStatusBtn.addEventListener("click", () => {
  switchShownItem(tableItems, elementObject.workingStatusTable, displayType.flex);
  switchIsActiveBtn(tabBtns, elementObject.workingStatusBtn);
});
elementObject.invoiceStatusBtn.addEventListener("click", () => {
  switchShownItem(tableItems, elementObject.invoiceStatusTable, displayType.flex);
  switchIsActiveBtn(tabBtns, elementObject.invoiceStatusBtn);
});
elementObject.completeStatusBtn.addEventListener("click", () => {
  switchShownItem(tableItems, elementObject.completeStatusTable, displayType.flex);
  switchIsActiveBtn(tabBtns, elementObject.completeStatusBtn);
});

window.onload = () => {
  showDefaultElement(todoDefaultShowNum, elementObject.allTodosItems, elementObject.todoMoreBtnElement);
  showDefaultElement(
    pass3DaysTodoDefaultShowNum,
    elementObject.passed3DaysTodoItems,
    elementObject.passed3DaysMoreBtnElement,
  );
  showDefaultElement(taskDefaultShowNum, elementObject.tasks, elementObject.taskMoreBtnElement);
  switchShownItem(todoTables, elementObject.allTodos, displayType.block);
  switchShownItem(tableItems, elementObject.taskStatusTable, displayType.flex);
  switchIsActiveBtn(tabBtns, elementObject.taskStatusBtn);
};
