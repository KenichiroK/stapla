(function() {
  const allTodos = document.getElementById("all_todos");
  const afterThreeDaysTodos = document.getElementById("after_three_days_todos");
  const toggleTodoBtn = document.getElementById("toggle_todo_btn");
  let shownAllTodos = true;

  toggleTodoBtn.addEventListener("click", function() {
    shownAllTodos = !shownAllTodos;
    if (shownAllTodos) {
      allTodos.style.display = "block";
      afterThreeDaysTodos.style.display = "none";
    } else {
      allTodos.style.display = "none";
      afterThreeDaysTodos.style.display = "block";
    }
  });
})();
