document.addEventListener("DOMContentLoaded", () => {
  const grid       = document.getElementById("szolg-grid");
  const wrapper    = document.querySelector(".szolg-slider-wrapper");
  const cards      = document.querySelectorAll("#szolg-grid .ref-szolg-card");
  const pagination = document.getElementById("szolg-pagination");
  const count      = document.getElementById("szolg-count");
  const prev       = document.getElementById("szolg-prev");
  const next       = document.getElementById("szolg-next");
  const gap        = 24;
  const total      = cards.length;
  let start        = 0;
  let visible, cardWidth;

  function getVisible() {
    const w = window.innerWidth;
    if (w > 1024) return 4;
    if (w > 640)  return 2;
    return 0; // mobile: native touch scroll
  }

  function recalc() {
    visible = getVisible();

    if (visible === 0) {
      cards.forEach((card) => {
        card.style.width = card.style.minWidth = card.style.maxWidth = "";
      });
      grid.style.transform = "";
      pagination.style.display = "none";
      return;
    }

    pagination.style.display = "";
    const wrapperWidth = wrapper.getBoundingClientRect().width;
    cardWidth = (wrapperWidth - gap * (visible - 1)) / visible;
    cards.forEach((card) => {
      card.style.width    = cardWidth + "px";
      card.style.minWidth = cardWidth + "px";
      card.style.maxWidth = cardWidth + "px";
    });
    if (start + visible > total) start = Math.max(0, total - visible);
    showCards();
  }

  function showCards() {
    grid.style.transform = `translateX(-${start * (cardWidth + gap)}px)`;
    count.textContent    = total + " items";
    prev.disabled        = start === 0;
    next.disabled        = start + visible >= total;
  }

  prev.addEventListener("click", () => { if (start > 0)               { start--; showCards(); } });
  next.addEventListener("click", () => { if (start + visible < total) { start++; showCards(); } });

  let resizeTimer;
  window.addEventListener("resize", () => {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(recalc, 150);
  });

  // requestAnimationFrame ensures layout is fully computed before measuring
  requestAnimationFrame(recalc);
});
