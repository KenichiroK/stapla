(function() {
  const allTodos = document.getElementById("all_todos");
  const passed3DaysTodos = document.getElementById("passed_3days_todos");
  const toggleTodoBtn = document.getElementById("toggle_todo_btn");
  let shownAllTodos = true;

  toggleTodoBtn.addEventListener("click", function() {
    shownAllTodos = !shownAllTodos;
    if (shownAllTodos) {
      allTodos.style.display = "block";
      passed3DaysTodos.style.display = "none";
    } else {
      allTodos.style.display = "none";
      passed3DaysTodos.style.display = "block";
    }
  });

  const setDefault = () => {
    allTodos.style.display = "block";
    passed3DaysTodos.style.display = "none";
  };

  setDefault();
})();
