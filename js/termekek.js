document.addEventListener("DOMContentLoaded", () => {
  const grid = document.getElementById("termekek-grid");
  const pagination = document.getElementById("termekek-pagination");
  const pills = document.querySelectorAll(".filter-pill");

  let currentPage = 1;
  let activeCategories = [];

  // Pill click logic
  pills.forEach((pill) => {
    pill.addEventListener("click", () => {
      const category = pill.dataset.category;

      if (category === "all") {
        activeCategories = [];
        pills.forEach((p) => p.classList.remove("active"));
        pill.classList.add("active");
      } else {
        document
          .querySelector("[data-category='all']")
          .classList.remove("active");

        if (activeCategories.includes(category)) {
          activeCategories = activeCategories.filter((c) => c !== category);
          pill.classList.remove("active");
        } else {
          activeCategories.push(category);
          pill.classList.add("active");
        }

        if (activeCategories.length === 0) {
          document
            .querySelector("[data-category='all']")
            .classList.add("active");
        }
      }

      currentPage = 1;
      loadProducts(activeCategories, 1);
    });
  });

  // Load products via AJAX
  function loadProducts(categories, page) {
    grid.innerHTML = '<p class="loading">Betöltés...</p>';

    const formData = new FormData();
    formData.append("action", "get_termekek");
    formData.append("page", page);

    if (categories.length === 0) {
      formData.append("category[]", "all");
    } else {
      categories.forEach((cat) => formData.append("category[]", cat));
    }

    fetch(ajaxUrl, { method: "POST", body: formData })
      .then((res) => res.json())
      .then((data) => {
        renderProducts(data.products);
        renderCounter(data.total, categories);
        renderPagination(data.pages, page);
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

  // Render counter + active tags
  function renderCounter(total, categories) {
    if (!Array.isArray(categories)) categories = [];
    const meta = document.querySelector(".termekek-meta");

    if (categories.length === 0) {
      meta.innerHTML = `<span>${total} termék</span>`;
      return;
    }

    const tags = categories
      .map((cat) => {
        const pill = document.querySelector(
          `.filter-pill[data-category="${cat}"]`,
        );
        const name = pill ? pill.textContent.trim() : cat;
        return `
        <span class="active-filter-tag" data-category="${cat}">
          <button class="remove-filter">×</button>
          ${name}
        </span>
      `;
      })
      .join("");

    meta.innerHTML = `
      <span>${total} termék</span>
      ${tags}
      <button class="termekek-clear">Összes törlése</button>
    `;

    // ✅ querySelectorAll not querySelector
    meta.querySelectorAll(".remove-filter").forEach((btn) => {
      btn.addEventListener("click", (e) => {
        const tag = e.target.closest(".active-filter-tag");
        const cat = tag.dataset.category;

        activeCategories = activeCategories.filter((c) => c !== cat);
        document
          .querySelector(`.filter-pill[data-category="${cat}"]`)
          .classList.remove("active");

        if (activeCategories.length === 0) {
          document
            .querySelector('[data-category="all"]')
            .classList.add("active");
        }

        loadProducts(activeCategories, 1);
      });
    });

    meta
      .querySelector(".termekek-clear")
      .addEventListener("click", clearFilter);
  }

  // Clear all filters
  function clearFilter() {
    activeCategories = [];
    pills.forEach((p) => p.classList.remove("active"));
    document.querySelector('[data-category="all"]').classList.add("active");
    currentPage = 1;
    loadProducts([], 1);
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
        loadProducts(activeCategories, currentPage); // ✅ array not string
        window.scrollTo({ top: 0, behavior: "smooth" });
      });
    });
  }

  // Initial load
  loadProducts([], 1);
});
