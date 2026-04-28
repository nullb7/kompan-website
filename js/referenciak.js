document.addEventListener("DOMContentLoaded", () => {
  const grid = document.getElementById("szolg-grid");
  const wrapper = document.querySelector(".szolg-slider-wrapper");
  const cards = document.querySelectorAll("#szolg-grid .ref-szolg-card");
  const count = document.getElementById("szolg-count");
  const prev = document.getElementById("szolg-prev");
  const next = document.getElementById("szolg-next");
  const visible = 4;
  const gap = 24;
  const total = cards.length;
  let start = 0;

  const containerWidth = wrapper.offsetWidth;
  const cardWidth = (containerWidth - gap * (visible - 1)) / visible;

  cards.forEach((card) => {
    card.style.width = cardWidth + "px";
    card.style.minWidth = cardWidth + "px";
    card.style.maxWidth = cardWidth + "px";
  });

  function showCards() {
    grid.style.transform = `translateX(-${start * (cardWidth + gap)}px)`;
    count.textContent = total + " items";
    prev.disabled = start === 0;
    next.disabled = start + visible >= total;
  }

  prev.addEventListener("click", () => {
    if (start > 0) {
      start--;
      showCards();
    }
  });

  next.addEventListener("click", () => {
    if (start + visible < total) {
      start++;
      showCards();
    }
  });

  showCards();
});
