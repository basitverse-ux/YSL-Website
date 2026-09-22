/* ============================================================================
   site.js — YSL. Vanilla, no dependencies, <15 KB (CLAUDE.md §8).
   Milestone 1: sticky-header state, mobile menu (keyboard + Escape),
   scroll-in reveals via IntersectionObserver. All motion respects
   prefers-reduced-motion. Timing/easing tokens live in site.css.
   ========================================================================== */
(function () {
  "use strict";

  var reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  /* ---- Sticky header: add .is-scrolled past a threshold ------------------ */
  var header = document.querySelector("[data-header]");
  if (header) {
    var TRIGGER = 24; // px — PLACEHOLDER; align with measured Finovate change point
    var ticking = false;
    var onScroll = function () {
      if (ticking) return;
      ticking = true;
      window.requestAnimationFrame(function () {
        header.classList.toggle("is-scrolled", window.scrollY > TRIGGER);
        ticking = false;
      });
    };
    window.addEventListener("scroll", onScroll, { passive: true });
    onScroll();
  }

  /* ---- Mobile menu: toggle, focus, Escape, click-out -------------------- */
  var toggle = document.querySelector("[data-nav-toggle]");
  var nav = document.querySelector("[data-nav]");
  if (toggle && nav) {
    var open = function () {
      nav.classList.add("is-open");
      document.body.classList.add("menu-open");
      toggle.setAttribute("aria-expanded", "true");
      toggle.setAttribute("aria-label", "Close menu");
      var first = nav.querySelector("a");
      if (first) first.focus();
    };
    var close = function (returnFocus) {
      nav.classList.remove("is-open");
      document.body.classList.remove("menu-open");
      toggle.setAttribute("aria-expanded", "false");
      toggle.setAttribute("aria-label", "Open menu");
      if (returnFocus) toggle.focus();
    };
    toggle.addEventListener("click", function () {
      nav.classList.contains("is-open") ? close(false) : open();
    });
    document.addEventListener("keydown", function (e) {
      if (e.key === "Escape" && nav.classList.contains("is-open")) close(true);
    });
    // Close after choosing a destination
    nav.addEventListener("click", function (e) {
      if (e.target.closest("a")) close(false);
    });
  }

  /* ---- Scroll-in reveals ------------------------------------------------- */
  var revealables = document.querySelectorAll(".reveal");
  if (revealables.length) {
    if (reduceMotion || !("IntersectionObserver" in window)) {
      // No motion / no support: show everything immediately.
      revealables.forEach(function (el) { el.classList.add("is-visible"); });
    } else {
      var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (!entry.isIntersecting) return;
          var el = entry.target;
          // Optional per-item stagger via data-reveal-index
          var i = parseInt(el.getAttribute("data-reveal-index") || "0", 10);
          el.style.transitionDelay = (i * 80) + "ms"; // PLACEHOLDER stagger (see --reveal-stagger)
          el.classList.add("is-visible");
          io.unobserve(el);
        });
      }, { rootMargin: "0px 0px -10% 0px", threshold: 0.05 });
      revealables.forEach(function (el) { io.observe(el); });
    }
  }
})();
