import { clickMoreBtn, showDefaultElement } from "@/modules/more-btn/logic";
import { switchShownItem, switchIsActiveBtn } from "@/modules/switch-btn/logic";
import { displayType } from "@/modules/switch-btn/type";
import elementObject from "./elements";

// task morebtn
let defaultShowNum = 5;
const moreShowNum = 5;

elementObject.taskMoreBtn.addEventListener("click", () => {
  defaultShowNum = clickMoreBtn(defaultShowNum, moreShowNum, elementObject.tasks, elementObject.taskMoreBtnElement);
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
  showDefaultElement(defaultShowNum, elementObject.tasks, elementObject.taskMoreBtnElement);

  //表示している task の status で status テーブルの表示を切り替える
  const task_status = location.href.split("/")[location.href.split("/").length - 1];
  if (task_status <= task_approval_partner) {
    switchShownItem(tableItems, elementObject.taskStatusTable, displayType.flex);
    switchIsActiveBtn(tabBtns, elementObject.taskStatusBtn);
  } else if (task_status <= order_approval_partner) {
    switchShownItem(tableItems, elementObject.orderStatusTable, displayType.flex);
    switchIsActiveBtn(tabBtns, elementObject.orderStatusBtn);
  } else if (task_status <= acceptance) {
    switchShownItem(tableItems, elementObject.workingStatusTable, displayType.flex);
    switchIsActiveBtn(tabBtns, elementObject.workingStatusBtn);
  } else if (task_status <= approval_accounting) {
    switchShownItem(tableItems, elementObject.invoiceStatusTable, displayType.flex);
    switchIsActiveBtn(tabBtns, elementObject.invoiceStatusBtn);
  } else if (task_status <= task_canceled) {
    switchShownItem(tableItems, elementObject.completeStatusTable, displayType.flex);
    switchIsActiveBtn(tabBtns, elementObject.completeStatusBtn);
  } else {
    switchShownItem(tableItems, elementObject.taskStatusTable, displayType.flex);
    switchIsActiveBtn(tabBtns, elementObject.taskStatusBtn);
  }
};
