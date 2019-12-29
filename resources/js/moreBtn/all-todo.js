(function() {
  let shownAllTodoNum = 4;
  const allTodos = document.querySelectorAll(".all_todo_item");

  const defaultShowList = () => {
    allTodos.forEach((t, i) => {
      t.style.display = i < shownAllTodoNum ? "flex" : "none";
    });
    if (shownAllTodoNum < allTodos.length) {
      showMoreBtn();
    }
  };

  const showMoreBtn = () => {
    document.getElementById("all_todo_more_btn_area").classList.add("is-active");
  };

  const hideMoreBtn = () => {
    document.getElementById("all_todo_more_btn_area").classList.remove("is-active");
  };

  // click more btn
  document.getElementById("all_todo_more_btn").addEventListener("click", function() {
    shownAllTodoNum += 4;
    allTodos.forEach((t, i) => {
      if (i < shownAllTodoNum) {
        t.style.display = "flex";
      }
    });

    if (shownAllTodoNum >= allTodos.length) {
      hideMoreBtn();
    }
  });

  defaultShowList();
})();
