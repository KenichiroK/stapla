import html2canvas from "html2canvas";
import pdfMake from "pdfmake/build/pdfmake";
import dayjs from "dayjs";

// 72dpi 時の mm => px 換算比
// 計算式は 1/(25.4mm / 72dpi)
const RATE = 2.83464566929;

// A4 297mm × 419mm
const PAGE_WIDTH = 297 * RATE;
const PAGE_HEIGHT = 419 * RATE;

// TODO: 仮置き。後でページ設計に合わせて修正
const CONTENT_WIDTH = 297 * RATE;
const CONTENT_HEIGHT = 419 * RATE;
const PAGE_MARGINS = [0 * RATE, 0 * RATE];

/**
 * HTMLからPDFを生成
 * @param {HTMLElement} element
 */
export async function createPdfFromHtml(element, documentType) {
  const pdfProps = await createPdfProps(element);
  createPdf(pdfProps, documentType);
}

/**
 * PDF出力用のPdfPropsを作成
 * @param {HTMLElement} element
 * @param {boolean} isOnlyQrCode
 * @returns {Promise<PdfProps>}
 */
async function createPdfProps(element) {
  // html2canvas実行
  const options = {
    // HACK: ブラウザ依存でcanvasサイズが変わらないように、scaleは固定値。IEでのぼやけ対策で十分大きめの2にした
    scale: 2,
  };
  const canvas = await html2canvas(element, options);

  const dataUrl = canvas.toDataURL();

  const pdfProps = {
    dataUrl,
    pageSize: {
      width: PAGE_WIDTH,
      height: PAGE_HEIGHT,
    },
    pageOrientation: "PORTRAIT",
    contentSize: {
      width: CONTENT_WIDTH,
      height: CONTENT_HEIGHT,
    },
    pageMargins: PAGE_MARGINS,
  };

  return pdfProps;
}

/**
 * エンコードされた画像URLを貼り付けたPDFを出力する
 * @param {PdfProps} pdfProps
 */
function createPdf(pdfProps, documentType) {
  const { dataUrl, contentSize, pageMargins } = pdfProps;
  // tsエラー回避のため一時的にany
  const pageSize = pdfProps.pageSize;
  const pageOrientation = pdfProps.pageOrientation;

  const documentDefinitions = {
    pageSize,
    pageOrientation,
    content: {
      image: dataUrl,
      ...contentSize,
    },
    pageMargins,
  };

  pdfMake.createPdf(documentDefinitions).download(`${documentType}-${dayjs(new Date()).format("YYYYMMDDHHmm")}`);
}
