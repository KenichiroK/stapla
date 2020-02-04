updateText(document.getElementById("c_company_name"), COMPANY_NAME);
updateText(document.getElementById("c_company_name_2"), COMPANY_NAME);
updateText(document.getElementById("c_company_address"), COMPANY_ADDRESS);
updateText(document.getElementById("c_representive_name"), REPRESENTIVE_NAME);
updateText(document.getElementById("c_partner_name"), PARTNER_NAME);
updateText(document.getElementById("c_partner_name_2"), PARTNER_NAME);
updateText(document.getElementById("c_partner_address"), PARTNER_ADDRESS);
updateText(document.getElementById("c_court"), COURT);
updateText(document.getElementById("c_contract_date_input"), CONTRACT_DATE);

function updateText(element, text) {
  if ("textContent" in element) {
    element.textContent = text;
  }
}
