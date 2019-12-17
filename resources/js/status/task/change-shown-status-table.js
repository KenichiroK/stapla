(function() {
  const taskStatusBtn = document.getElementById("task-status-btn");
  const orderStatusBtn = document.getElementById("order-status-btn");
  const workingStatusBtn = document.getElementById("working-status-btn");
  const invoiceStatusBtn = document.getElementById("invoice-status-btn");
  const completeStatusBtn = document.getElementById("complete-status-btn");
  const navBarBtn = [].slice.call(document.querySelectorAll(".navbar-btn"));

  const taskStatusTable = document.getElementById("task-status-table");
  const orderStatusTable = document.getElementById("order-status-table");
  const workingStatusTable = document.getElementById("working-status-table");
  const invoiceStatusTable = document.getElementById("invoice-status-table");
  const completeStatusTable = document.getElementById("complete-status-table");

  const clickStatusBtn = type => {
    taskStatusTable.style.display = type === "task" ? "flex" : "none";
    orderStatusTable.style.display = type === "order" ? "flex" : "none";
    workingStatusTable.style.display = type === "working" ? "flex" : "none";
    invoiceStatusTable.style.display = type === "invoice" ? "flex" : "none";
    completeStatusTable.style.display = type === "complete" ? "flex" : "none";
    navBarBtn.map(n => n.classList.remove("is-active"));
    type === "task"
      ? taskStatusBtn.classList.add("is-active")
      : type === "order"
      ? orderStatusBtn.classList.add("is-active")
      : type === "working"
      ? workingStatusBtn.classList.add("is-active")
      : type === "invoice"
      ? invoiceStatusBtn.classList.add("is-active")
      : completeStatusBtn.classList.add("is-active");
  };

  taskStatusBtn.addEventListener("click", function() {
    clickStatusBtn("task");
  });

  orderStatusBtn.addEventListener("click", function() {
    clickStatusBtn("order");
  });

  workingStatusBtn.addEventListener("click", function() {
    clickStatusBtn("working");
  });

  invoiceStatusBtn.addEventListener("click", function() {
    clickStatusBtn("invoice");
  });

  completeStatusBtn.addEventListener("click", function() {
    clickStatusBtn("complete");
  });

  window.onload = function() {
    clickStatusBtn("task");
  };
})();
