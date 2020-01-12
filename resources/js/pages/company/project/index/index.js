import { showElements } from "@/modules/more-btn/logic";

window.onload = () => {
  showElements(defaultShowNum, projects, moreBtnElement);
};

let defaultShowNum = 5;
const moreShowNum = 5;
const projects = document.querySelectorAll(".project_item");
const moreBtnElement = document.getElementById("project_more_btn_area");

document.getElementById("project_more_btn").addEventListener("click", () => {
  defaultShowNum += moreShowNum;
  showElements(defaultShowNum, projects, moreBtnElement);
});
