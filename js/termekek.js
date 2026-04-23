document.addEventListener("DOMContentLoaded", () => {
  const grid = document.getElementById("termekek-grid");
  const pagination = document.getElementById("termekek-pagination");
  const counter = document.querySelector(".termekek-counter");
  const clearBtn = document.querySelector(".termekek-clear");
  const pills = document.querySelectorAll(".filter-pill");

  let currentCategory = "all";
  let currentPage = 1;

  // Load products via AJAX
  function loadProducts(category = "all", page = 1) {
    grid.innerHTML = '<p class="loading">Betöltés...</p>';

    const formData = new FormData();
    formData.append("action", "get_termekek");
    formData.append("category", category);
    formData.append("page", page);

    fetch(ajaxUrl, { method: "POST", body: formData })
      .then((res) => res.json())
      .then((data) => {
        renderProducts(data.products);
        renderCounter(data.total);
        renderPagination(data.pages, page);
        updateURL(category, page);
      });
  }

  // Render product cards
  function renderProducts(products) {
    if (!products.length) {
      grid.innerHTML = '<p class="no-products">Nincs találat.</p>';
      return;
    }
    grid.innerHTML = products
      .map(
        (p) => `
            <a href="${p.url}" class="termek-card">
                <div class="termek-image">
                    <img src="${p.image}" alt="${p.title}" />
                </div>
                <p class="termek-title">${p.title}</p>
            </a>
        `,
      )
      .join("");
  }

  // Render counter
  function renderCounter(total) {
    counter.textContent = `${total} termék`;
  }

  // Render pagination
  function renderPagination(pages, current) {
    if (pages <= 1) {
      pagination.innerHTML = "";
      return;
    }
    let html = "";
    for (let i = 1; i <= pages; i++) {
      html += `<button class="page-btn ${i === current ? "active" : ""}" data-page="${i}">${i}</button>`;
    }
    pagination.innerHTML = html;

    pagination.querySelectorAll(".page-btn").forEach((btn) => {
      btn.addEventListener("click", () => {
        currentPage = parseInt(btn.dataset.page);
        loadProducts(currentCategory, currentPage);
        window.scrollTo({ top: 0, behavior: "smooth" });
      });
    });
  }

  // Update URL without reload
  function updateURL(category, page) {
    const params = new URLSearchParams();
    if (category !== "all") params.set("category", category);
    if (page > 1) params.set("page", page);
    const newUrl =
      window.location.pathname +
      (params.toString() ? "?" + params.toString() : "");
    window.history.pushState({}, "", newUrl);
  }

  // Filter pill click
  pills.forEach((pill) => {
    pill.addEventListener("click", () => {
      pills.forEach((p) => p.classList.remove("active"));
      pill.classList.add("active");
      currentCategory = pill.dataset.category;
      currentPage = 1;
      clearBtn.style.display =
        currentCategory === "all" ? "none" : "inline-block";
      loadProducts(currentCategory, currentPage);
    });
  });

  // Clear button
  clearBtn.addEventListener("click", () => {
    pills.forEach((p) => p.classList.remove("active"));
    document.querySelector('[data-category="all"]').classList.add("active");
    currentCategory = "all";
    currentPage = 1;
    clearBtn.style.display = "none";
    loadProducts("all", 1);
  });

  // Read URL params on load (for shareable links)
  const params = new URLSearchParams(window.location.search);
  const initCat = params.get("category") || "all";
  const initPage = parseInt(params.get("page")) || 1;
  currentCategory = initCat;
  currentPage = initPage;

  if (initCat !== "all") {
    pills.forEach((p) => p.classList.remove("active"));
    const activePill = document.querySelector(`[data-category="${initCat}"]`);
    if (activePill) activePill.classList.add("active");
    clearBtn.style.display = "inline-block";
  }

  loadProducts(currentCategory, currentPage);
});
