(function() {
  let shownNum = 5;
  const projects = document.querySelectorAll(".project_item");

  const defaultShowList = () => {
    projects.forEach((p, i) => {
      p.style.display = i < shownNum ? "block" : "none";
    });

    if (shownNum >= projects.length) {
      hideShowMoreBtn();
    }
  };

  const hideShowMoreBtn = () => {
    document.getElementById("project_more_btn_area").classList.remove("is-active");
  };

  // click more btn
  document.getElementById("project_more_btn").addEventListener("click", function() {
    shownNum += 5;
    projects.forEach((p, i) => {
      if (i < shownNum) {
        p.style.display = "block";
      }
    });
    if (shownNum >= projects.length) {
      hideShowMoreBtn();
    }
  });

  defaultShowList();
})();
