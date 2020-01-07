(function() {
  let shownPassed3DaysTodosNum = 4;
  const passed3DaysTodos = document.querySelectorAll(".passed_3days_todo_item");
  const moreBtnElement = document.getElementById("passed_3days_todo_more_btn_area");

  passed3DaysTodos.forEach((t, i) => {
    t.style.display = i < shownPassed3DaysTodosNum ? "flex" : "none";
  });
  if (shownPassed3DaysTodosNum < passed3DaysTodos.length) {
    moreBtnElement.classList.add("is-active");
  }

  // click more btn
  document.getElementById("passed_3days_todo_more_btn").addEventListener("click", function() {
    shownPassed3DaysTodosNum += 4;
    passed3DaysTodos.forEach((t, i) => {
      if (i < shownPassed3DaysTodosNum) {
        t.style.display = "flex";
      }
    });

    if (shownPassed3DaysTodosNum >= passed3DaysTodos.length) {
      moreBtnElement.classList.remove("is-active");
    }
  });
})();
