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

  taskStatusBtn.addEventListener("click", function() {
    taskStatusTable.style.display = "flex";
    orderStatusTable.style.display = "none";
    workingStatusTable.style.display = "none";
    invoiceStatusTable.style.display = "none";
    completeStatusTable.style.display = "none";
    navBarBtn.map(n => n.classList.remove("is-active"));
    taskStatusBtn.classList.add("is-active");
  });

  orderStatusBtn.addEventListener("click", function() {
    taskStatusTable.style.display = "none";
    orderStatusTable.style.display = "flex";
    workingStatusTable.style.display = "none";
    invoiceStatusTable.style.display = "none";
    completeStatusTable.style.display = "none";
    navBarBtn.map(n => n.classList.remove("is-active"));
    orderStatusBtn.classList.add("is-active");
  });

  workingStatusBtn.addEventListener("click", function() {
    taskStatusTable.style.display = "none";
    orderStatusTable.style.display = "none";
    workingStatusTable.style.display = "flex";
    invoiceStatusTable.style.display = "none";
    completeStatusTable.style.display = "none";
    navBarBtn.map(n => n.classList.remove("is-active"));
    workingStatusBtn.classList.add("is-active");
  });

  invoiceStatusBtn.addEventListener("click", function() {
    taskStatusTable.style.display = "none";
    orderStatusTable.style.display = "none";
    workingStatusTable.style.display = "none";
    invoiceStatusTable.style.display = "flex";
    completeStatusTable.style.display = "none";
    navBarBtn.map(n => n.classList.remove("is-active"));
    invoiceStatusBtn.classList.add("is-active");
  });

  completeStatusBtn.addEventListener("click", function() {
    taskStatusTable.style.display = "none";
    orderStatusTable.style.display = "none";
    workingStatusTable.style.display = "none";
    invoiceStatusTable.style.display = "none";
    completeStatusTable.style.display = "flex";
    navBarBtn.map(n => n.classList.remove("is-active"));
    completeStatusBtn.classList.add("is-active");
  });

  window.onload = function() {
    taskStatusTable.style.display = "flex";
    orderStatusTable.style.display = "none";
    workingStatusTable.style.display = "none";
    invoiceStatusTable.style.display = "none";
    completeStatusTable.style.display = "none";
  };
})();
