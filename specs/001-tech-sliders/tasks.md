# Tasks: Infinite Dual-Row Technology Sliders

**Feature**: `001-tech-sliders`  
**Input**: Plan from [plan.md](file:///c:/xampp/htdocs/Portfolio/specs/001-tech-sliders/plan.md), Spec from [spec.md](file:///c:/xampp/htdocs/Portfolio/specs/001-tech-sliders/spec.md)  

---

## Phase 1: Setup

**Purpose**: Baseline verification of existing assets and stylesheets

- [x] T001 Verify existing Devicon assets, card styles, and CSS variables in resources/views/portfolio.blade.php and public/enhancements.css

---

## Phase 2: Foundational (Blocking Prerequisites)

**Purpose**: Core CSS marquee infrastructure required by both rows

- [x] T002 Implement marquee CSS keyframes (`marquee-ltr` and `marquee-rtl`), track layout, and edge fade gradient masks in public/enhancements.css

---

## Phase 3: User Story 1 - Ambient Continuous Scrolling Showcase (Priority: P1) [MVP]

**Goal**: Convert static `.tech-stack` into two continuous infinite scrolling rows moving in opposite directions without gaps or visible resets.

**Independent Test**: Load the portfolio page, verify Row 1 moves Left-to-Right and Row 2 moves Right-to-Left seamlessly across consecutive loop cycles.

- [x] T003 [US1] Structure Row 1 technology cards (PHP, Composer, JavaScript, MySQL, CodeIgniter 4, Laravel, Bootstrap) with duplicate set in resources/views/portfolio.blade.php
- [x] T004 [US1] Structure Row 2 technology cards (Tailwind CSS, Arduino, Git, Nginx, Ubuntu, AI Integration, Azure) with duplicate set in resources/views/portfolio.blade.php
- [x] T005 [US1] Update AI Integration card to title "AI Integration", subtitle "Gemini • Groq • OpenRouter", and multi-provider vector icon in resources/views/portfolio.blade.php
- [x] T006 [US1] Style card dimensions, typography, spacing, and CSS animation bindings in public/enhancements.css

---

## Phase 4: User Story 2 - Interactive Card Inspection & Hover Pause (Priority: P2)

**Goal**: Hovering over any row pauses scrolling immediately while maintaining smooth individual card micro-hover elevation.

**Independent Test**: Hover over Row 1; verify Row 1 stops while Row 2 continues. Move cursor away; verify Row 1 resumes smoothly without jumping.

- [x] T007 [US2] Implement row hover-pause rules via `animation-play-state: paused` in public/enhancements.css
- [x] T008 [US2] Implement subtle card elevation, border tint, and micro-scale hover effects in public/enhancements.css

---

## Phase 5: User Story 3 - Responsive Containment, Accessibility & Theme Harmony (Priority: P3)

**Goal**: Guarantee zero horizontal document overflow, support mobile devices, honor `prefers-reduced-motion`, and preserve light/dark theme aesthetics.

**Independent Test**: Test at 375px viewport (no horizontal scrollbar), enable `prefers-reduced-motion` (animations stop), and toggle dark mode (colors adapt cleanly).

- [x] T009 [US3] Implement overflow containment and mobile responsive spacing in public/enhancements.css
- [x] T010 [US3] Implement `prefers-reduced-motion` media queries disabling marquee animation in public/enhancements.css
- [x] T011 [US3] Verify dark mode color token mapping for marquee cards in public/enhancements.css

---

## Phase 6: Polish & Validation

**Purpose**: End-to-end verification and quality check

- [x] T012 Run full quickstart.md validation scenarios across viewport sizes and animation loop cycles

---

## Dependencies & Execution Order

- **Phase 1 (Setup)** -> **Phase 2 (Foundational)** -> **Phase 3 (User Story 1 - MVP)** -> **Phase 4 (User Story 2)** -> **Phase 5 (User Story 3)** -> **Phase 6 (Polish & Validation)**
- T003, T004, and T005 in `resources/views/portfolio.blade.php` are implemented sequentially.
- T002, T006, T007, T008, T009, T010, T011 in `public/enhancements.css` build sequentially on the core animation system.
