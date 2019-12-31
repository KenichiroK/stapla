import { createPdfFromHtml } from "./logic";
import { type } from "./type";

const invoicePrintBtn = document.querySelector("#invoice_print_btn");
const pdfContent = document.querySelector("#pdf_content");

invoicePrintBtn.onclick = () => {
  createPdfFromHtml(pdfContent, type.invoice);
};
