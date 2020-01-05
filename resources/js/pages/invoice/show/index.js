import { createPdfFromHtml } from "@/modules/pdf/logic";
import { type } from "@/modules/pdf/type";

const invoicePrintBtn = document.getElementById("invoice_print_btn");
const pdfContent = document.getElementById("pdf_content");

invoicePrintBtn.onclick = () => {
  createPdfFromHtml(pdfContent, type.invoice);
};
