# Phase 0 Research: Infinite Dual-Row Technology Sliders

**Feature Branch**: `001-tech-sliders`  
**Date**: 2026-10-13  
**Status**: Completed  

---

## Unknowns & Clarifications Resolved

### 1. Slider Architecture: Pure CSS Keyframes vs JavaScript Slider

- **Decision**: Implement the dual-row infinite sliders using **pure CSS keyframe animations** operating on CSS 3D transforms (`transform: translate3d(...)` / `translateX(...)`).
- **Rationale**:
  - The project does not currently use any slider libraries (Swiper, Slick, Splide, etc.). Introducing an external npm/CDN package would add unnecessary bundle weight, require JavaScript initialization, and violate the project's minimalist architecture and user instructions ("Keep the implementation lightweight. Prefer CSS animations... Do NOT install Swiper, Slick, Splide").
  - CSS transform animations execute on the browser compositor thread, ensuring 60fps/120fps hardware acceleration without triggering layout or paint reflows during continuous scrolling.
  - Interactive pausing on hover is achieved natively via `animation-play-state: paused` with zero JavaScript listeners.
- **Alternatives Considered**:
  - *Swiper / Splide (CDN/npm)*: Rejected due to unnecessary bundle overhead, complex DOM structure, and direct user prohibition.
  - *Custom JavaScript `requestAnimationFrame` loop*: Rejected because JS-driven position updating requires manual touch/hover listeners, risks micro-stutter during main thread work, and adds maintenance complexity compared to declarative CSS.

---

### 2. Opposite Direction Scrolling Math & Seamless Loop Geometry

- **Decision**: Use dual identical groups per track animated between `0` and `-50%` (or `-50%` and `0`):
  - **Row 1 (Left to Right →)**:
    - Animation: `marquee-ltr`
    - Keyframes: `from { transform: translateX(-50%); } to { transform: translateX(0); }`
    - Math: Translates positively along the X axis. At `translateX(0)`, Group 1 occupies the exact screen position that Group 2 occupied at `translateX(-50%)`. When the animation restarts at `-50%`, the visual state is 100% identical.
  - **Row 2 (Right to Left ←)**:
    - Animation: `marquee-rtl`
    - Keyframes: `from { transform: translateX(0); } to { transform: translateX(-50%); }`
    - Math: Translates negatively along the X axis. At `translateX(-50%)`, Group 2 occupies the exact screen position that Group 1 occupied at `translateX(0)`. When the animation restarts at `0`, the visual state is 100% identical.
- **Velocity & Duration**:
  - Linear easing (`animation-timing-function: linear`) with `infinite` repetition.
  - Pacing: 32s to 38s per full cycle, yielding a smooth velocity of ~40–50px/sec that allows effortless reading without visual distraction.
- **Alternatives Considered**:
  - *Single track with `%` translate based on card width*: Requires fixed pixel widths and JS recalculations on window resize. The 2-group `-50%` technique is resolution-independent.

---

### 3. Screen Width Resilience & Gap Prevention (Ultrawide / 4K Displays)

- **Decision**: Each row track will contain two groups (`.tech-marquee-group`), where each group contains the 7 cards repeated twice (14 cards total per group, 28 cards per track row), or two wide groups totaling > 3000px per group.
  - 1 card width (~200px) + gap (14px) = 214px.
  - 14 cards per group = ~3000px width.
  - 2 groups per track = ~6000px total track width.
  - Because 3000px exceeds standard 1080p, 1440p, and even full 4K viewports (3840px minus container margins), the track will always have cards overflowing both sides, completely preventing blank spaces or edge cutoffs during infinite rotation.
- **Accessibility & DOM Cleanliness**:
  - The first group contains real cards accessible to screen readers.
  - All duplicated groups/repetitions are marked with `aria-hidden="true"` to prevent screen readers from announcing repetitive content.

---

### 4. Edge Fade Masks via CSS Alpha Masking

- **Decision**: Apply CSS `mask-image` / `-webkit-mask-image` to the row container:
  ```css
  mask-image: linear-gradient(to right, transparent, black 6%, black 94%, transparent);
  -webkit-mask-image: linear-gradient(to right, transparent, black 6%, black 94%, transparent);
  ```
- **Rationale**:
  - Masking operates on element alpha transparency rather than solid color overlays. This eliminates the need for theme-specific gradient background pseudo-elements (`::before` / `::after`) and ensures cards fade seamlessly into the background in both light (`#ffffff`) and dark (`#101113`) themes.
  - Cards smoothly appear from invisible at the left edge and gently dissolve at the right edge.

---

### 5. Card Aesthetics, Typography, and Hover Micro-Interactions

- **Decision**: Strictly preserve existing `.tech-stack article` design tokens and dimensions while adapting to flex layout inside the slider track:
  - Surface: `background: var(--white); border: 1px solid var(--line); border-radius: 0;` (matching the portfolio's clean architectural look).
  - Dimensions: Fixed min-width (approx 200px–220px), height 72px, flex alignment `center`, gap `10px`, padding `12px 14px`.
  - Content:
    - Logo: 32px x 32px Devicon SVG or inline vector SVG, object-fit contain.
    - Title: `.tech-name` font-size `0.78rem`, font-weight `600`, line-height `1.25`, color `var(--ink)`.
    - Subtitle: `.tech-sub` font-size `0.66rem`, font-weight `400`, color `var(--muted)`, margin-top `3px`.
  - Micro-interaction on hover:
    - `transform: translateY(-2px) scale(1.02);`
    - `border-color: var(--ink);`
    - `box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);`
    - Parent track sets `animation-play-state: paused;` so only the hovered row stops.

---

### 6. AI Integration Icon Selection

- **Decision**: Update card title to **AI Integration** and subtitle to **Gemini • Groq • OpenRouter**. Replace the OpenAPI logo with an elegant, modern multi-model AI sparkle / intelligence SVG icon.
- **Rationale**:
  - The developer's work encompasses multiple model providers (Gemini, Groq, OpenRouter). A single-vendor logo misrepresents the broader scope.
  - An inline vector SVG formatted with `fill="currentColor"` or dual-tone theme colors ensures razor-sharp rendering at all resolutions, matches Devicon dimensions (32px x 32px), and eliminates third-party CDN lookup failures.
