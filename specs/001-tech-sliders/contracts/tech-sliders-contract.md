# Interface Contract: Infinite Dual-Row Technology Sliders

**Feature Branch**: `001-tech-sliders`  
**Date**: 2026-10-13  
**Status**: Completed  

---

## 1. DOM Hierarchy & Component Structure Contract

The technology section adheres to the following markup hierarchy inside `resources/views/portfolio.blade.php`:

```html
<!-- Outer Container -->
<div class="tech-marquee-wrapper" aria-label="Technologies and frameworks">
  <div class="tech-marquee-header">
    <span class="tech-marquee-label">Technologies I work with</span>
  </div>

  <!-- ROW 1: Left to Right (→) -->
  <div class="tech-marquee-row tech-marquee-ltr" aria-label="Technologies row 1">
    <div class="tech-marquee-track">
      <div class="tech-marquee-group">
        <!-- 7 Technology Cards (PHP, Composer, JS, MySQL, CI4, Laravel, Bootstrap) -->
        <article class="tech-card">...</article>
        ...
      </div>
      <div class="tech-marquee-group" aria-hidden="true">
        <article class="tech-card">...</article>
        ...
      </div>
    </div>
  </div>

  <!-- ROW 2: Right to Left (←) -->
  <div class="tech-marquee-row tech-marquee-rtl" aria-label="Technologies row 2">
    <div class="tech-marquee-track">
      <div class="tech-marquee-group">
        <!-- 7 Technology Cards (Tailwind, Arduino, Git, Nginx, Ubuntu, AI Integration, Azure) -->
        <article class="tech-card">...</article>
        ...
      </div>
      <div class="tech-marquee-group" aria-hidden="true">
        <article class="tech-card">...</article>
        ...
      </div>
    </div>
  </div>

</div>
```

---

## 2. Card Markup Contract

Each card matches the exact card markup structure and typography:

```html
<article class="tech-card">
  <!-- Devicon CDN SVG or Inline Vector SVG -->
  <img src="..." width="24" height="24" loading="lazy" alt="[Technology Name] logo" class="tech-icon">
  <!-- Alternatively for AI Integration: -->
  <!-- <svg class="tech-icon" width="24" height="24" viewBox="0 0 32 32" ...>...</svg> -->
  <strong>[Technology Name]</strong>
</article>
```

---

## 3. CSS Classes & Monochrome Aesthetic Contract

| Selector | Required Properties & Constraints |
|---|---|
| `.tech-marquee-wrapper` | `display: flex; flex-direction: column; gap: 14px; margin-top: 36px; overflow: hidden; width: 100%; contain: layout paint;` |
| `.tech-marquee-row` | `position: relative; width: 100%; overflow: hidden; contain: paint; mask-image: linear-gradient(to right, transparent 0%, black 6%, black 94%, transparent 100%);` |
| `.tech-marquee-track` | `display: flex; width: max-content; will-change: transform; transform: translateZ(0); backface-visibility: hidden; perspective: 1000px;` |
| `.tech-marquee-ltr .tech-marquee-track` | `animation: marquee-ltr 55s linear infinite;` |
| `.tech-marquee-rtl .tech-marquee-track` | `animation: marquee-rtl 55s linear infinite;` |
| `.tech-marquee-row:hover .tech-marquee-track` | `animation-play-state: paused;` |
| `.tech-marquee-group` | `display: flex; align-items: center; gap: 12px; padding-right: 12px; flex-shrink: 0;` |
| `.tech-card` | `width: auto; height: 48px; padding: 8px 16px; box-sizing: border-box; border: 1px solid rgba(0, 0, 0, 0.08); background: var(--white); color: var(--ink);` |
| `html[data-theme="dark"] .tech-card` | `border-color: rgba(255, 255, 255, 0.08);` |
| `.tech-card img, .tech-card .tech-icon` | `width: 24px; height: 24px; filter: grayscale(100%); opacity: 0.82; transition: filter 260ms ease, opacity 260ms ease, transform 260ms cubic-bezier(0.16, 1, 0.3, 1);` |
| `.tech-card strong` | `display: inline-block; font-size: .84rem; font-weight: 600; line-height: 1; color: var(--ink); white-space: nowrap;` |
| `.tech-card:hover` | `transform: translateY(-2px) scale(1.02); border-color: rgba(0, 0, 0, 0.22); box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);` |
| `.tech-card:hover img, .tech-card:hover .tech-icon` | `filter: grayscale(100%) contrast(1.15); opacity: 1; transform: scale(1.06);` |

---

## 4. Keyframe Definitions Contract

```css
@keyframes marquee-rtl {
  0% {
    transform: translate3d(0, 0, 0);
  }
  100% {
    transform: translate3d(-50%, 0, 0);
  }
}
```

---

## 5. Accessibility & Reduced Motion Contract

```css
@media (prefers-reduced-motion: reduce) {
  .tech-marquee-rtl .tech-marquee-track {
    animation: none !important;
  }
  .tech-marquee-row {
    overflow-x: auto;
    scrollbar-width: thin;
    mask-image: none !important;
    -webkit-mask-image: none !important;
  }
  .tech-card {
    transition: none !important;
  }
}
```
