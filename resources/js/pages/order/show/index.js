import { createPdfFromHtml } from "@/modules/pdf/logic";
import { type } from "@/modules/pdf/type";

const orderPrintBtn = document.getElementById("order_print_btn");
const pdfContent = document.getElementById("pdf_content");

orderPrintBtn.onclick = () => {
  createPdfFromHtml(pdfContent, type.order);
};
