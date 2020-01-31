/**
 *
 * @param {HTMTLElement[]} elements 全ての要素
 * @param {HTMTLElement} willShownElement 表示する要素
 * @param {String} displayType 表示する display の種類
 */
export const switchShownItem = (elements, willShownElement, displayType) => {
  elements.filter(el => el !== willShownElement).map(el => (el.style.display = "none"));
  willShownElement.style.display = displayType;
};

/**
 *
 * @param {HTMTLElement[]} btns 全てのボタン
 * @param {HTMTLElement} willActiveBtn 表示するボタン
 */
export const switchIsActive = (btns, willActiveBtn) => {
  btns.filter(btn => btn !== willActiveBtn).map(btn => btn.classList.remove("is-active"));
  willActiveBtn.classList.add("is-active");
};
