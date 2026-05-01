document.addEventListener("DOMContentLoaded", function () {
    const headers = document.querySelectorAll(".accordion-header");

    headers.forEach(header => {
        header.addEventListener("click", () => toggle(header));
    });

    // 🔥 AUTO OPEN PRVE (NAJNOVIJE) GODINE
    if (headers.length > 0) {
        toggle(headers[0]);
    }

    function toggle(header) {
        const body = header.nextElementSibling;
        const icon = header.querySelector(".icon");

        const isOpen = body.classList.contains("open");

        document.querySelectorAll(".accordion-body").forEach(b => {
            b.classList.remove("open");
            b.style.maxHeight = null;
        });

        document.querySelectorAll(".icon").forEach(i => {
            i.textContent = "+";
        });

        if (!isOpen) {
            body.classList.add("open");
            body.style.maxHeight = body.scrollHeight + "px";
            icon.textContent = "−";
        }
    }
});

document.addEventListener("DOMContentLoaded", function () {
  const activeKey = document.body.dataset.activeMenu;
  if (!activeKey) return;

  document.querySelectorAll(".menu li").forEach(li => {
    if (li.dataset.key === activeKey) {
      li.classList.add("active");
    }
  });
});

// Мобилни мени – отварање/затварање
document.addEventListener("DOMContentLoaded", function () {
  var header = document.querySelector(".site-header");
  var toggle = document.querySelector(".nav-toggle");
  var menu = document.getElementById("main-menu");
  if (!header || !toggle || !menu) return;

  function openMenu() {
    header.classList.add("nav-open");
    toggle.setAttribute("aria-expanded", "true");
    toggle.setAttribute("aria-label", "Затвори мени");
  }

  function closeMenu() {
    header.classList.remove("nav-open");
    toggle.setAttribute("aria-expanded", "false");
    toggle.setAttribute("aria-label", "Отвори мени");
  }

  toggle.addEventListener("click", function () {
    if (header.classList.contains("nav-open")) {
      closeMenu();
    } else {
      openMenu();
    }
  });

  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape" && header.classList.contains("nav-open")) {
      closeMenu();
    }
  });

  menu.querySelectorAll("a").forEach(function (link) {
    link.addEventListener("click", function () {
      closeMenu();
    });
  });
});
document.addEventListener("DOMContentLoaded", function () {
    const gallery = document.getElementById("news-gallery");
    const lightbox = document.getElementById("lightbox");
    if (!gallery || !lightbox) return; // na stranicama bez galerije ne radi ništa
  
    const images = Array.from(gallery.querySelectorAll(".news-thumb"));
    const imgEl = document.getElementById("lightbox-image");
    const btnClose = document.getElementById("lightbox-close");
    const btnPrev = document.getElementById("lightbox-prev");
    const btnNext = document.getElementById("lightbox-next");
  
    let currentIndex = 0;
  
    function showImage(index) {
      if (index < 0) index = images.length - 1;
      if (index >= images.length) index = 0;
      currentIndex = index;
      imgEl.src = images[currentIndex].src;
      lightbox.hidden = false;
    }
  
    images.forEach((img, idx) => {
      img.addEventListener("click", () => showImage(idx));
    });
  
    btnClose.addEventListener("click", () => {
      lightbox.hidden = true;
    });
  
    btnPrev.addEventListener("click", () => {
      showImage(currentIndex - 1);
    });
  
    btnNext.addEventListener("click", () => {
      showImage(currentIndex + 1);
    });
  
    // ESC za zatvaranje
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape") {
        lightbox.hidden = true;
      }
    });
  
    // Klik na pozadinu zatvara lightbox
    lightbox.addEventListener("click", (e) => {
      if (e.target === lightbox) {
        lightbox.hidden = true;
      }
    });
  });

document.addEventListener("DOMContentLoaded", function () {
  const modal = document.getElementById("bio-modal");
  if (!modal) return;

  const titleEl = document.getElementById("bio-modal-title");
  const roleEl = document.getElementById("bio-modal-role");
  const contentEl = document.getElementById("bio-modal-content");
  const triggers = Array.from(document.querySelectorAll(".bio-trigger"));
  const closers = Array.from(modal.querySelectorAll("[data-bio-close]"));
  const dialog = modal.querySelector(".bio-modal-dialog");
  let closeTimer = null;
  let lastFocused = null;

  function getFocusableElements() {
    if (!dialog) return [];
    return Array.from(
      dialog.querySelectorAll(
        'button, a[href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
      )
    ).filter((el) => !el.hasAttribute("disabled"));
  }

  function closeModal() {
    modal.classList.remove("is-open");
    document.body.classList.remove("modal-open");
    if (closeTimer) {
      window.clearTimeout(closeTimer);
    }
    closeTimer = window.setTimeout(() => {
      modal.hidden = true;
      if (lastFocused && typeof lastFocused.focus === "function") {
        lastFocused.focus();
      }
      lastFocused = null;
    }, 180);
  }

  function openModal(name, role, bio) {
    lastFocused = document.activeElement;
    titleEl.textContent = name || "";
    roleEl.textContent = role || "";
    contentEl.innerHTML = "";

    const paragraphs = (bio || "")
      .split(/\n+/)
      .map((line) => line.trim())
      .filter(Boolean);

    if (paragraphs.length === 0) {
      const p = document.createElement("p");
      p.textContent = "Биографија тренутно није доступна.";
      contentEl.appendChild(p);
    } else {
      paragraphs.forEach((line) => {
        const p = document.createElement("p");
        p.textContent = line;
        contentEl.appendChild(p);
      });
    }

    if (closeTimer) {
      window.clearTimeout(closeTimer);
      closeTimer = null;
    }
    modal.hidden = false;
    requestAnimationFrame(() => {
      modal.classList.add("is-open");
    });
    document.body.classList.add("modal-open");
    window.setTimeout(() => {
      const focusables = getFocusableElements();
      if (focusables.length > 0) {
        focusables[0].focus();
      }
    }, 20);
  }

  triggers.forEach((button) => {
    button.addEventListener("click", () => {
      openModal(
        button.dataset.bioName || "",
        button.dataset.bioRole || "",
        button.dataset.bioText || ""
      );
    });
  });

  closers.forEach((el) => {
    el.addEventListener("click", closeModal);
  });

  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && !modal.hidden) {
      closeModal();
      return;
    }
    if (e.key !== "Tab" || modal.hidden) return;

    const focusables = getFocusableElements();
    if (focusables.length === 0) return;
    const first = focusables[0];
    const last = focusables[focusables.length - 1];

    if (e.shiftKey && document.activeElement === first) {
      e.preventDefault();
      last.focus();
    } else if (!e.shiftKey && document.activeElement === last) {
      e.preventDefault();
      first.focus();
    }
  });
});

