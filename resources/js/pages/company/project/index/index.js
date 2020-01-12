import { clickMoreBtn, showDefaultElement } from "@/modules/more-btn/logic";

window.onload = () => {
  showDefaultElement(defaultShowNum, projects, moreBtnElement);
};

let defaultShowNum = 5;
const moreShowNum = 5;
const projects = document.querySelectorAll(".project_item");
const moreBtnElement = document.getElementById("project_more_btn_area");

document.getElementById("project_more_btn").addEventListener("click", () => {
  defaultShowNum = clickMoreBtn(defaultShowNum, moreShowNum, projects, moreBtnElement);
});
