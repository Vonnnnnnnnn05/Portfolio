# Implementation Plan: Infinite Dual-Row Technology Sliders

**Branch**: `001-tech-sliders` | **Date**: 2026-10-13 | **Spec**: [spec.md](file:///c:/xampp/htdocs/Portfolio/specs/001-tech-sliders/spec.md)

**Input**: Feature specification from `specs/001-tech-sliders/spec.md`

---

## Summary

Convert the existing static technology card grid in the portfolio's About section into **two horizontal infinite marquee sliders stacked vertically**. Row 1 moves continuously Left-to-Right and displays 7 backend/frontend/database technologies. Row 2 moves continuously Right-to-Left and displays 7 styling/hardware/infra/AI technologies, including an updated "AI Integration" card (Gemini • Groq • OpenRouter). Both sliders run on GPU-accelerated pure CSS keyframe animations, seamlessly looping with zero jumps or gaps across all screen sizes (mobile to 4K), pausing on row hover, featuring subtle alpha edge fade masks, and strictly preserving existing card styles and site tokens without external JavaScript carousel libraries.

---

## Technical Context

**Language/Version**: PHP 8.2+ (Laravel 12 Blade template), Vanilla CSS (CSS3 Keyframes & Masks), Modern HTML5  
**Primary Dependencies**: None (0 new npm/composer/CDN carousel packages; pure CSS animation)  
**Storage**: N/A (Static presentation data embedded in Blade view)  
**Testing**: Manual end-to-end browser validation across desktop, tablet, and mobile; `prefers-reduced-motion` emulation  
**Target Platform**: Cross-browser modern web (Chrome, Edge, Firefox, Safari on Windows, macOS, iOS, Android)  
**Project Type**: Web application frontend enhancement (Laravel Blade + Vanilla CSS)  
**Performance Goals**: Solid 60fps/120fps smooth scrolling running on GPU compositor thread via `translate3d`; 0ms main thread blocking; 0 KB added JS  
**Constraints**: Zero document horizontal scrollbar/overflow (`scrollWidth === innerWidth`); no jumps during loop reset; strict adherence to scope boundaries (modify only the tech section; do NOT add "What I Do" section or redesign site)  
**Scale/Scope**: 14 distinct technology cards (7 in Row 1, 7 in Row 2) duplicated for infinite rendering across viewports from 320px to 3840px  

---

## Constitution Check

*GATE: Must pass before Phase 0 research. Re-check after Phase 1 design.*

- **Scope Boundary Compliance**: Passed. The change is isolated exclusively to the technology stack section within `resources/views/portfolio.blade.php` and its styling in `public/enhancements.css`. No navigation, hero, project, or footer layouts are modified.
- **Minimalist Architecture (No Unnecessary Dependencies)**: Passed. Pure CSS animation chosen over heavy third-party carousel libraries (Swiper, Splide, Slick), keeping bundle size and page load speed pristine.
- **Accessibility & Motion Safety**: Passed. Screen-reader duplicate suppression using `aria-hidden="true"` and complete motion suspension under `prefers-reduced-motion: reduce`.
- **Aesthetic & Design Preservation**: Passed. Existing typography (`Inter`), CSS tokens (`--white`, `--line`, `--ink`, `--muted`), dimensions, and micro-hover states are 100% preserved.

---

## Project Structure

### Documentation (this feature)

```text
specs/001-tech-sliders/
├── spec.md              # Feature specification
├── checklists/
│   └── requirements.md  # Quality checklist
├── plan.md              # Implementation plan (this file)
├── research.md          # Phase 0 architectural & math decisions
├── data-model.md        # Phase 1 structured technology item definitions
├── contracts/
│   └── tech-sliders-contract.md # Phase 1 DOM hierarchy & CSS contracts
└── quickstart.md        # Phase 1 validation scenarios
```

### Source Code (repository root)

```text
resources/
└── views/
    └── portfolio.blade.php      # Replace .tech-stack with dual .tech-marquee-row structure

public/
└── enhancements.css             # Add marquee keyframes, tracks, fade masks, hover, and responsive styles
```

**Structure Decision**: Direct modification of the target Blade view `resources/views/portfolio.blade.php` and the designated CSS enhancement stylesheet `public/enhancements.css`. No controllers, routes, migrations, or JavaScript bundles need modification.

---

## Complexity Tracking

| Violation | Why Needed | Simpler Alternative Rejected Because |
|---|---|---|
| None | N/A | Fully complies with all simplicity and scope principles |
