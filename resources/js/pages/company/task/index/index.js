import { showElements } from "@/modules/more-btn/logic";
import { switchShownItem, switchIsActive } from "@/modules/switch-btn/logic";
import { displayType } from "@/modules/switch-btn/type";

window.onload = () => {
  showElements(defaultShowNum, tasks, taskMoreBtnElement);

  //表示している task の status で status テーブルの表示を切り替える
  const task_status = location.href.split("/")[location.href.split("/").length - 1];
  if (task_status <= task_approval_partner) {
    switchShownItem(tableItems, taskStatusTable, displayType.flex);
    switchIsActive(tabBtns, taskStatusBtn);
    switchIsActive(statusNums, taskStatusNum);
  } else if (task_status <= order_approval_partner) {
    switchShownItem(tableItems, orderStatusTable, displayType.flex);
    switchIsActive(tabBtns, orderStatusBtn);
  } else if (task_status <= acceptance) {
    switchShownItem(tableItems, workingStatusTable, displayType.flex);
    switchIsActive(tabBtns, workingStatusBtn);
    switchIsActive(statusNums, workingStatusNum);
  } else if (task_status <= approval_accounting) {
    switchShownItem(tableItems, invoiceStatusTable, displayType.flex);
    switchIsActive(tabBtns, invoiceStatusBtn);
    switchIsActive(statusNums, invoiceStatusNum);
  } else if (task_status <= task_canceled) {
    switchShownItem(tableItems, completeStatusTable, displayType.flex);
    switchIsActive(tabBtns, completeStatusBtn);
    switchIsActive(statusNums, completeStatusNum);
  } else {
    switchShownItem(tableItems, taskStatusTable, displayType.flex);
    switchIsActive(tabBtns, taskStatusBtn);
    switchIsActive(statusNums, taskStatusNum);
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
