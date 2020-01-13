import { showElements } from "@/modules/more-btn/logic";
import { switchShownItem, switchIsActiveBtn } from "@/modules/switch-btn/logic";
import { displayType } from "@/modules/switch-btn/type";

window.onload = () => {
  showElements(defaultShowNum, tasks, taskMoreBtnElement);

  //表示している task の status で status テーブルの表示を切り替える
  const task_status = location.href.split("/")[location.href.split("/").length - 1];
  if (task_status <= task_approval_partner) {
    switchShownItem(tableItems, taskStatusTable, displayType.flex);
    switchIsActiveBtn(tabBtns, taskStatusBtn);
  } else if (task_status <= order_approval_partner) {
    switchShownItem(tableItems, orderStatusTable, displayType.flex);
    switchIsActiveBtn(tabBtns, orderStatusBtn);
  } else if (task_status <= acceptance) {
    switchShownItem(tableItems, workingStatusTable, displayType.flex);
    switchIsActiveBtn(tabBtns, workingStatusBtn);
  } else if (task_status <= approval_accounting) {
    switchShownItem(tableItems, invoiceStatusTable, displayType.flex);
    switchIsActiveBtn(tabBtns, invoiceStatusBtn);
  } else if (task_status <= task_canceled) {
    switchShownItem(tableItems, completeStatusTable, displayType.flex);
    switchIsActiveBtn(tabBtns, completeStatusBtn);
  } else {
    switchShownItem(tableItems, taskStatusTable, displayType.flex);
    switchIsActiveBtn(tabBtns, taskStatusBtn);
  }
};

// task morebtn
let defaultShowNum = 5;
const moreShowNum = 5;

const tasks = document.querySelectorAll(".task_item");
const taskMoreBtnElement = document.getElementById("task_more_btn_area");
const taskMoreBtn = document.getElementById("task_more_btn");

taskMoreBtn.addEventListener("click", () => {
  defaultShowNum += moreShowNum;
  showElements(defaultShowNum, tasks, taskMoreBtnElement);
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
