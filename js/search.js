const searchToggle = document.querySelector(".nav-search-toggle");
const searchBar = document.getElementById("navSearchBar");

searchToggle.addEventListener("click", () => {
  searchBar.classList.toggle("active");
  if (searchBar.classList.contains("active")) {
    searchBar.querySelector("input").focus();
  }
});

// Close when clicking outside
document.addEventListener("click", (e) => {
  if (!searchBar.contains(e.target) && !searchToggle.contains(e.target)) {
    searchBar.classList.remove("active");
  }
});

const searchInput = document.querySelector(".nav-search-bar input");
const searchForm = document.querySelector(".nav-search-bar form");

// Create dropdown
const dropdown = document.createElement("div");
dropdown.classList.add("search-suggestions");
searchForm.appendChild(dropdown);

let debounceTimer;

searchInput.addEventListener("input", () => {
  clearTimeout(debounceTimer);
  const term = searchInput.value.trim();

  if (term.length < 2) {
    dropdown.innerHTML = "";
    dropdown.style.display = "none";
    return;
  }

  debounceTimer = setTimeout(() => {
    const formData = new FormData();
    formData.append("action", "search_suggestions");
    formData.append("term", term);

    fetch(ajaxUrl, { method: "POST", body: formData })
      .then((res) => res.json())
      .then((data) => {
        if (!data.length) {
          dropdown.innerHTML = "";
          dropdown.style.display = "none";
          return;
        }

        dropdown.innerHTML = data
          .map(
            (item) => `
                    <a href="${item.url}" class="suggestion-item suggestion-${item.type}">
                        <span class="suggestion-type">${item.type === "category" ? "Kategória" : "Termék"}</span>
                        ${item.label}
                    </a>
                `,
          )
          .join("");

        dropdown.style.display = "block";
      });
  }, 300); // 300ms debounce
});

// Hide on click outside
document.addEventListener("click", (e) => {
  if (!searchForm.contains(e.target)) {
    dropdown.style.display = "none";
  }
});
