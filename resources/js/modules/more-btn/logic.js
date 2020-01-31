/**
 *
 * @param {Number} elementNum 表示する数
 * @param {HTMTLElement[]} renderElements 表示する全ての要素
 * @param {HTMLElement} moreBtnElement もっと見るボタン
 */
export const showElements = (elementNum, renderElements, moreBtnElement) => {
  renderElements.forEach((re, i) => {
    re.style.display = i < elementNum ? "flex" : "none";
  });

  if (elementNum < renderElements.length) {
    moreBtnElement.classList.add("is-active");
  }

  if (elementNum >= renderElements.length) {
    moreBtnElement.classList.remove("is-active");
  }
};
