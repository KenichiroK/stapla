export const clickMoreBtn = (defaultShowNum, moreShowNum, renderElements, moreBtnElement) => {
  defaultShowNum += moreShowNum;
  renderElements.forEach((re, i) => {
    if (i < defaultShowNum) {
      re.style.display = "flex";
    }
  });

  if (defaultShowNum >= renderElements.length) {
    moreBtnElement.classList.remove("is-active");
  }

  return defaultShowNum;
};

export const showDefaultElement = (defaultShowNum, renderElements, moreBtnElement) => {
  renderElements.forEach((re, i) => {
    re.style.display = i < defaultShowNum ? "flex" : "none";
  });

  defaultShowNum < renderElements.length && moreBtnElement.classList.add("is-active");
};

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
