(function() {
  let shownAllTodoNum = 4;
  const allTodos = document.querySelectorAll(".all_todo_item");
  const moreBtnElement = document.getElementById("all_todo_more_btn_area");

  allTodos.forEach((t, i) => {
    t.style.display = i < shownAllTodoNum ? "flex" : "none";
  });
  if (shownAllTodoNum < allTodos.length) {
    moreBtnElement.classList.add("is-active");
  }

  // click more btn
  document.getElementById("all_todo_more_btn").addEventListener("click", function() {
    shownAllTodoNum += 4;
    allTodos.forEach((t, i) => {
      if (i < shownAllTodoNum) {
        t.style.display = "flex";
      }
    });

    if (shownAllTodoNum >= allTodos.length) {
      moreBtnElement.classList.remove("is-active");
    }
  });
})();
