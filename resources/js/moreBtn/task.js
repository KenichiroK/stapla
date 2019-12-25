(function() {
  let shownNum = 5;
  const tasks = document.querySelectorAll(".task_item");

  const defaultShowList = () => {
    tasks.forEach((t, i) => {
      t.style.display = i < shownNum ? "flex" : "none";
    });
    if (shownNum >= tasks.length) {
      hideShowMoreBtn();
    }
  };

  const hideShowMoreBtn = () => {
    document.getElementById("task_more_btn_area").classList.remove("is-active");
  };

  // click more btn
  document.getElementById("task_more_btn").addEventListener("click", function() {
    shownNum += 5;
    tasks.forEach((t, i) => {
      if (i < shownNum) {
        t.style.display = "flex";
      }
    });
    if (shownNum >= tasks.length) {
      hideShowMoreBtn();
    }
  });

  defaultShowList();
})();
