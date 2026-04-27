document.addEventListener("DOMContentLoaded", () => {
  const cards = document.querySelectorAll("#szolg-grid .ref-szolg-card");
  const pagination = document.getElementById("szolg-pagination");
  const perPage = 4;
  const total = cards.length;
  const pages = Math.ceil(total / perPage);
  let current = 1;

  function showPage(page) {
    const start = (page - 1) * perPage;
    const end = start + perPage;

    cards.forEach((card, i) => {
      card.style.display = i >= start && i < end ? "" : "none";
    });
  }

  function buildPagination() {
    if (pages <= 1) return;

    let html = "";
    for (let i = 1; i <= pages; i++) {
      html += `<button class="szolg-page-btn ${i === 1 ? "active" : ""}" data-page="${i}">${i}</button>`;
    }
    pagination.innerHTML = html;

    pagination.querySelectorAll(".szolg-page-btn").forEach((btn) => {
      btn.addEventListener("click", () => {
        pagination
          .querySelectorAll(".szolg-page-btn")
          .forEach((b) => b.classList.remove("active"));
        btn.classList.add("active");

        current = parseInt(btn.dataset.page);
        showPage(current);
      });
    });
  }

  buildPagination();
  showPage(1);
});
