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
        <button class="remove-filter"><svg width="9" height="9" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M5.095 5.685L0.723333 10.0567C0.645556 10.1344 0.55 10.1761 0.436666 10.1817C0.323333 10.1872 0.222222 10.1456 0.133333 10.0567C0.0444443 9.96778 0 9.86944 0 9.76167C0 9.65389 0.0444443 9.55556 0.133333 9.46667L4.505 5.095L0.133333 0.723333C0.0555554 0.645556 0.0138887 0.55 0.00833313 0.436666C0.00277757 0.323333 0.0444443 0.222222 0.133333 0.133333C0.222222 0.0444443 0.320556 0 0.428333 0C0.536111 0 0.634444 0.0444443 0.723333 0.133333L5.095 4.505L9.46667 0.133333C9.54445 0.0555554 9.64028 0.0138887 9.75417 0.00833313C9.86694 0.00277757 9.96778 0.0444443 10.0567 0.133333C10.1456 0.222222 10.19 0.320556 10.19 0.428333C10.19 0.536111 10.1456 0.634444 10.0567 0.723333L5.685 5.095L10.0567 9.46667C10.1344 9.54445 10.1761 9.64028 10.1817 9.75417C10.1872 9.86694 10.1456 9.96778 10.0567 10.0567C9.96778 10.1456 9.86944 10.19 9.76167 10.19C9.65389 10.19 9.55556 10.1456 9.46667 10.0567L5.095 5.685Z" fill="black"/>
        </svg>
        </button>
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

    //redirect from home-page
    const params = new URLSearchParams(window.location.search);
    const kat = params.get('kat'); 
  
      if (kat) {
        const pill = document.querySelector(`.filter-pill[data-category="${kat}"]`)
        if (pill) {
          document.querySelectorAll('.filter-pill').forEach(p => p.classList.remove('active'));
          pill.classList.add('active');
          activeCategories = [kat];
          loadProducts([kat], 1)
        } else {
          loadProducts([], 1)
        }
        
      } else {
        //initial load
        loadProducts([], 1);

      } 
    
  });
  