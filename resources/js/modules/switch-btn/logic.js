export const switchShownItem = (elements, willShownElement, displayType) => {
  elements.filter(el => el !== willShownElement).map(el => (el.style.display = "none"));
  willShownElement.style.display = displayType;
};

export const switchIsActiveBtn = (btns, willActiveBtn) => {
  btns.filter(btn => btn !== willActiveBtn).map(btn => btn.classList.remove("is-active"));
  willActiveBtn.classList.add("is-active");
};
