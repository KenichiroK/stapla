import html2canvas from "html2canvas";
import pdfMake from "pdfmake/build/pdfmake";
import dayjs from "dayjs";

updateText(document.getElementById("c_company_name"), COMPANY_NAME);
updateText(document.getElementById("c_company_name_2"), COMPANY_NAME);
updateText(document.getElementById("c_company_address"), COMPANY_ADDRESS);
updateText(document.getElementById("c_representive_name"), REPRESENTIVE_NAME);
updateText(document.getElementById("c_partner_name"), PARTNER_NAME);
updateText(document.getElementById("c_partner_name_2"), PARTNER_NAME);
updateText(document.getElementById("c_partner_address"), PARTNER_ADDRESS);
updateText(document.getElementById("c_court"), COURT);
updateText(document.getElementById("c_contract_date_input"), CONTRACT_DATE);

document.getElementById("submit_btn").addEventListener("click", submitContract);

function updateText(element, text) {
  if ("textContent" in element) {
    element.textContent = text;
  }
}

const PAGE_WIDTH = 594;
const PAGE_HEIGHT = 847;
const CONTENT_WIDTH = 594;
const CONTENT_HEIGHT = 847;
// const PAGE_MARGINS = [0 * RATE, 0 * RATE];

async function createPdfFromHtml(element) {
  const options = {
    // HACK: ブラウザ依存でcanvasサイズが変わらないように、scaleは固定値。IEでのぼやけ対策で十分大きめの2にした
    scale: 2,
  };
  const page = await html2canvas(element, options);
  const dataUrl = page.toDataURL();

  const documentDefinitions = {
    pageSize: "A4",
    content: [
      {
        image: dataUrl,
        width: CONTENT_WIDTH,
        // height: CONTENT_HEIGHT,
      },
    ],
  };

  pdfMake.createPdf(documentDefinitions).download(`業務委託基本契約書-${dayjs(new Date()).format("YYYYMMDDHHmm")}`);
}

async function submitContract(event) {
  const formElement = document.getElementById("contract_form");
  await createPdfFromHtml(document.getElementById("contract"));

  // TODO: pdfの生成が終わったらsubmitする
}
