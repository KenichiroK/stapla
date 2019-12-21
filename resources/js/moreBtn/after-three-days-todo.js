(function() {
  let shownAfter3DaysTodosNum = 4;
  const after3DaysTodos = document.querySelectorAll(".after_three_days_todo_item");

  const defaultShowList = () => {
    after3DaysTodos.forEach((t, i) => {
      t.style.display = i < shownAfter3DaysTodosNum ? "flex" : "none";
    });
    if (shownAfter3DaysTodosNum >= after3DaysTodos.length) {
      hideShowMoreBtn();
    }
  };

  const hideShowMoreBtn = () => {
    document.getElementById("after_three_days_todo_more_btn_area").classList.remove("is-active");
  };

  // click more btn
  document.getElementById("after_three_days_todo_more_btn").addEventListener("click", function() {
    shownAfter3DaysTodosNum += 4;
    after3DaysTodos.forEach((t, i) => {
      if (i < shownAfter3DaysTodosNum) {
        t.style.display = "flex";
      }
    });
    if (shownAfter3DaysTodosNum >= after3DaysTodos.length) {
      hideShowMoreBtn();
    }
  });

  defaultShowList();
})();
