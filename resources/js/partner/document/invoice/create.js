
const calculateSumPrice = () => {
    var sum = document.getElementById('sum');
    var itemNums = document.getElementsByName('item_num[]');
    var itemUnitPrices = document.getElementsByName('item_unit_price[]');
    var itemTaxes = document.getElementsByName('item_tax[]');
    var itemTotals = document.getElementsByName('item_total[]');
    var taskRequestTotals = document.querySelectorAll('.task_request_total');
    var expencesNums = document.getElementsByName('expences_num[]');
    var expencesUnitPrices = document.getElementsByName('expences_unit_price[]');
    var expencesTaxes = document.getElementsByName('expences_tax[]');
    var expencesTotals = document.getElementsByName('expences_total[]');
    var expenceTotals = document.querySelectorAll('.expence_total');
    var taskSum = 0;
    var taskSumTax = 0;
    var expencesSum = 0;
    var expencesSumTax = 0;
    for (i = 0; i < itemNums.length; i++) {
    const taskNum = itemNums[i].value === undefined ? 0 : Number(itemNums[i].value);
    const taskUnitPrice = itemUnitPrices[i].value === undefined ? 0 : Number(itemUnitPrices[i].value);
    const taskTax = itemTaxes[i].value === undefined ? 0 : Number(itemTaxes[i].value);
    if (taskNum !== 0 && taskUnitPrice !== 0) taskRequestTotals[i].textContent = Math.floor(taskNum * taskUnitPrice * taskTax);
    if (taskNum !== 0 && taskUnitPrice !== 0) itemTotals[i].value = Math.floor(taskNum * taskUnitPrice * taskTax);
    taskSum += taskNum * taskUnitPrice;
    taskSumTax +=  taskNum * taskUnitPrice * taskTax;
    }

    for (i = 0; i < expencesNums.length; i++) {
    const expencesNum = expencesNums[i].value === undefined ? 0 : Number(expencesNums[i].value);
    const expencesUnitPrice = expencesUnitPrices[i].value === undefined ? 0 : Number(expencesUnitPrices[i].value);
    const expencesTax = expencesTaxes[i].value === undefined ? 0 : Number(expencesTaxes[i].value);
    if (expencesNum !== 0 && expencesUnitPrice !== 0) expenceTotals[i].textContent = Math.floor(expencesNum * expencesUnitPrice * expencesTax);
    if (expencesNum !== 0 && expencesUnitPrice !== 0) expencesTotals[i].value = Math.floor(expencesNum * expencesUnitPrice * expencesTax);
    expencesSum += expencesNum * expencesUnitPrice;
    expencesSumTax += expencesNum * expencesUnitPrice * expencesTax;
    }
    sum.textContent = `￥${(taskSum + expencesSum).toLocaleString()}`;
    sum_plus_tax.textContent = `￥${Math.floor(taskSumTax + expencesSumTax).toLocaleString()}`;

    // タスク予算額
    var task_taxIncludedPriceValue = document.getElementById('task_taxIncludedPrice').value;
    task_taxIncludedPrice = Number(task_taxIncludedPriceValue);

    // 請求書合計金額
    var invoiceAmount = document.getElementById('invoiceAmount').value;
    invoiceAmount = taskSum + expencesSum;

    const invoiceAmount_alert = document.getElementById('invoiceAmount_alert');

    if(task_taxIncludedPrice < invoiceAmount){
        invoiceAmount_alert.style.display = 'block';
    }else {
        invoiceAmount_alert.style.display = 'none';
    }
}

// 担当者が選択された場合、担当者(自由記入)の記入不可へ 
function selectStaff() {
    var free_staff_name = document.getElementById('free_staff_name');
    free_staff_name.disabled = true;
}
// 担当者selectbox未選択状態へ
function setNonSelect(idname){
    var selectedStaff = document.getElementById(idname);
    selectedStaff.selectedIndex = -1;
    free_staff_name.disabled = false;
}
// 担当者(自由記入) input記入不可状態へ
function billingText(){
    var input_staff_name = document.getElementById('free_staff_name').value;
    if(input_staff_name != "") {
        staff_name.disabled = true;
    } else {
        staff_name.disabled = false;
    }
}
// taskレコード削除
function delTaskRecord(button) {
    var parent = button.parentNode;
    parent.remove(parent);
    calculateSumPrice();
}
// expencesレコード削除
function delExpenceRecord(button) {
    var parent = button.parentNode;
    parent.remove(parent);
    calculateSumPrice();
}
