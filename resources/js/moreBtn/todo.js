(function() {
  let shownNum = 4;
  const todos = document.querySelectorAll(".todo_item");

  const defaultShowList = () => {
    todos.forEach((t, i) => {
      t.style.display = i < shownNum ? "flex" : "none";
    });
    if (shownNum >= todos.length) {
      hideShowMoreBtn();
    }
  };

  const hideShowMoreBtn = () => {
    document.getElementById("todo_more_btn_area").classList.remove("is-active");
  };

  // click more btn
  document.getElementById("todo_more_btn").addEventListener("click", function() {
    shownNum += 5;
    todos.forEach((t, i) => {
      if (i < shownNum) {
        t.style.display = "flex";
      }
    });
    if (shownNum >= todos.length) {
      hideShowMoreBtn();
    }
  });

  defaultShowList();
})();
