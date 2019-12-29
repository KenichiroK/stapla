(function() {
  let shownPassed3DaysTodosNum = 4;
  const passed3DaysTodos = document.querySelectorAll(".passed_3days_todo_item");

  const defaultShowList = () => {
    passed3DaysTodos.forEach((t, i) => {
      t.style.display = i < shownPassed3DaysTodosNum ? "flex" : "none";
    });
    if (shownPassed3DaysTodosNum < passed3DaysTodos.length) {
      showMoreBtn();
    }
  };

  const showMoreBtn = () => {
    document.getElementById("passed_3days_todo_more_btn_area").classList.add("is-active");
  };

  const hideMoreBtn = () => {
    document.getElementById("passed_3days_todo_more_btn_area").classList.remove("is-active");
  };

  // click more btn
  document.getElementById("passed_3days_todo_more_btn").addEventListener("click", function() {
    shownPassed3DaysTodosNum += 4;
    passed3DaysTodos.forEach((t, i) => {
      if (i < shownPassed3DaysTodosNum) {
        t.style.display = "flex";
      }
    });

    if (shownPassed3DaysTodosNum >= passed3DaysTodos.length) {
      hideMoreBtn();
    }
  });

  defaultShowList();
})();
