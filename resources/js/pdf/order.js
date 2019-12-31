import { createPdfFromHtml } from "./logic";
import { type } from "./type";

const orderPrintBtn = document.querySelector("#order_print_btn");
const pdfContent = document.querySelector("#pdf_content");

orderPrintBtn.onclick = () => {
  createPdfFromHtml(pdfContent, type.order);
};
