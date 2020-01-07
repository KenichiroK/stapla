export const clickMoreBtn = (defaultShowNum, moreShowNum, renderElements, moreBtnElement) => {
  let shownNum = defaultShowNum;
  shownNum += moreShowNum;
  renderElements.forEach((re, i) => {
    if (i < shownNum) {
      re.style.display = "flex";
    }
  });

  if (shownNum >= renderElements.length) {
    moreBtnElement.classList.remove("is-active");
  }

  return shownNum;
};

export const showDefaultElement = (defaultShowNum, renderElements, moreBtnElement) => {
  renderElements.forEach((re, i) => {
    re.style.display = i < defaultShowNum ? "flex" : "none";
  });

  defaultShowNum < renderElements.length && moreBtnElement.classList.add("is-active");
};
