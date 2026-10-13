# Feature Specification: Infinite Dual-Row Technology Sliders

**Feature Branch**: `001-tech-sliders`  
**Created**: 2026-10-13  
**Status**: Draft  
**Input**: User description: "Modify the existing Technologies/Skills section of my portfolio into TWO horizontal infinite sliders stacked vertically."

---

## User Scenarios & Testing *(mandatory)*

### User Story 1 - Continuous Ambient Exploration of Technical Skills (Priority: P1)

As a portfolio visitor, recruiter, or engineering manager, I want to see the developer's core technologies moving smoothly in dual opposite-direction horizontal streams without having to click navigation arrows or pagination dots, so that I immediately get an engaging, comprehensive impression of the developer's stack.

**Why this priority**: Core visual requirement that replaces the static grid with a modern, dynamic showcase while preserving all existing technology data.

**Independent Test**: Load the portfolio page on desktop, scroll to the About/Technologies section, and observe Row 1 scrolling Left-to-Right and Row 2 scrolling Right-to-Left continuously without manual user intervention.

**Acceptance Scenarios**:
1. **Given** the user views the portfolio page, **When** the Technologies section enters view, **Then** Row 1 moves continuously and smoothly from Left to Right and Row 2 moves continuously and smoothly from Right to Left.
2. **Given** either row is scrolling, **When** cards scroll past the container boundary, **Then** the sequence loops infinitely with zero visible reset jumps, zero flickering, and zero blank spaces or gaps between duplicated sequences.
3. **Given** any screen resolution (from 320px mobile up to 3840px 4K ultrawide), **When** watching the sliders, **Then** there is never a gap where cards disappear or leave empty canvas.

---

### User Story 2 - Focused Card Inspection via Hover Pause (Priority: P2)

As a visitor reviewing specific technology proficiencies, I want to hover my mouse cursor over any technology card or slider row so that the animation pauses, allowing me to inspect the technology name, subtitle, and logo with ease.

**Why this priority**: Usability and ergonomics. Continuous movement can frustrate users trying to read specific card details; interactive pausing provides instant control.

**Independent Test**: Hover cursor over a card in Row 1. Verify Row 1 pauses its motion immediately while Row 2 continues moving. Move cursor away, and verify Row 1 resumes smoothly from its exact current position without jumping.

**Acceptance Scenarios**:
1. **Given** Row 1 is scrolling, **When** the user moves their cursor over Row 1, **Then** Row 1 pauses smoothly in place and the hovered card exhibits a subtle elevation and border highlight.
2. **Given** Row 1 is paused due to hover, **When** the user moves their cursor away, **Then** Row 1 resumes scrolling at its standard steady pace from its current position.
3. **Given** Row 1 is hovered, **When** Row 2 is not hovered, **Then** Row 2 continues its independent Right-to-Left motion unaffected.

---

### User Story 3 - Responsive and Non-Intrusive Layout (Priority: P3)

As a mobile or tablet visitor, I want the sliders to remain within the screen bounds without causing any horizontal document overflow or breaking page scroll, while respecting system accessibility preferences.

**Why this priority**: Mobile compatibility and accessibility compliance ensure the portfolio remains professional and accessible to all visitors.

**Independent Test**: Test on viewport widths 375px, 768px, 1024px, and 1440px. Confirm `document.documentElement.scrollWidth === window.innerWidth`. Toggle `prefers-reduced-motion` in browser settings and verify animations stop gracefully.

**Acceptance Scenarios**:
1. **Given** a mobile viewport (375px), **When** viewing the portfolio, **Then** no horizontal scrollbar is introduced to the document window and the sliders remain safely contained.
2. **Given** a user with the operating system setting `prefers-reduced-motion: reduce`, **When** the page loads, **Then** continuous scrolling animation is disabled/paused to avoid motion sickness, displaying the technology cards in a stable, accessible layout.
3. **Given** light or dark theme active, **When** inspecting cards, **Then** card background, borders, text, and SVG logos adhere to the site theme tokens without visual defects.

---

## Edge Cases

- **Ultrawide & 4K Displays (>2560px)**: If card sets are insufficiently duplicated, empty gaps appear before the loop reset. To prevent this, card sets must be duplicated with sufficient repetitions so total track length exceeds screen width plus the loop offset at all times.
- **Mouse Hover at Seam Boundary**: Hovering near where duplicated items meet must not trigger glitches or reset animations.
- **Window Resize**: Resizing the window while animation is playing must not break the scroll offset or cause jumping.
- **Variable Font & Asset Loading**: If Devicon SVGs load asynchronously, card dimensions must remain fixed and stable via explicit height/min-width and image aspect-ratio rules to avoid layout shift.

---

## Requirements *(mandatory)*

### Functional Requirements

- **FR-001**: The system MUST replace the static technology grid with exactly TWO horizontally scrolling slider rows stacked vertically.
- **FR-002**: Row 1 MUST continuously scroll from Left to Right (→) and contain exactly the following technologies:
  1. PHP (Subtitle: Backend)
  2. Composer (Subtitle: Dependencies)
  3. JavaScript (Frontend & APIs)
  4. MySQL (Subtitle: Database)
  5. CodeIgniter 4 (Subtitle: Framework)
  6. Laravel (Subtitle: Framework)
  7. Bootstrap (Subtitle: UI toolkit)
- **FR-003**: Row 2 MUST continuously scroll from Right to Left (←) and contain exactly the following technologies:
  1. Tailwind CSS (Subtitle: UI styling)
  2. Arduino (Subtitle: Hardware)
  3. Git (Subtitle: Version control)
  4. Nginx (Subtitle: Web server)
  5. Ubuntu (Subtitle: Server OS)
  6. AI Integration (Subtitle: Gemini • Groq • OpenRouter)
  7. Azure (Subtitle: Cloud platform)
- **FR-004**: The AI card in Row 2 MUST display the title "AI Integration" and subtitle "Gemini • Groq • OpenRouter", paired with a clean, multi-provider AI icon (sparkles/neural) rather than a single-vendor logo.
- **FR-005**: Both rows MUST animate continuously and automatically using pure CSS marquee animations without requiring any external carousel libraries (e.g. Swiper, Slick, Splide).
- **FR-006**: Both rows MUST loop infinitely without visible jumps, stuttering, or blank gaps during animation cycle reset.
- **FR-007**: When a user hovers over a row, that row's animation MUST pause (`animation-play-state: paused`). When the cursor departs, the animation MUST resume seamlessly from its current position.
- **FR-008**: The slider container MUST prevent horizontal page scrolling/overflow (`overflow: hidden`).
- **FR-009**: The slider container MUST feature subtle edge gradient/fade masks on the left and right sides so cards fade smoothly into view and out of view at the edges.
- **FR-010**: Technology cards MUST preserve the existing visual design language:
  - Clean card surface (`var(--white)` background, `1px solid var(--line)` border)
  - Consistent fixed/minimum dimensions and padding
  - Vertically centered contents: icon on left (32px x 32px), title on right (semi-bold `var(--ink)`), subtitle underneath (smaller `var(--muted)`)
  - Subtle hover state: slight elevation/translateY, subtle border tint, minor scale
- **FR-011**: The system MUST respect `prefers-reduced-motion: reduce` by halting automatic scrolling and rendering cards in a stable or statically scrollable manner.
- **FR-012**: The system MUST NOT create a "What I Do" section, add service cards, or alter any unrelated sections (Navbar, Hero, Selected Work, Contact, Footer).

---

## Success Criteria *(mandatory)*

### Measurable Outcomes

- **SC-001**: Zero horizontal document overflow (`document.documentElement.scrollWidth === window.innerWidth`) across all tested screen widths (320px to 3840px).
- **SC-002**: 100% pure CSS animation implementation with 0 KB added external JavaScript libraries.
- **SC-003**: Seamless infinite loop with 0 frames of visual jump or empty gap during marquee cycle reset across 10 consecutive full loop cycles.
- **SC-004**: Hover pause response time is immediate (<16ms, single frame) with 0 layout shift or positional jump.
- **SC-005**: Strict compliance with accessibility guidelines: motion completely halts when `prefers-reduced-motion: reduce` is activated.
- **SC-006**: Visual consistency: 100% of card fonts, colors, and borders match existing site CSS variables in both light and dark themes.

---

## Assumptions

- Card duplication is performed directly in the Blade template markup using semantic grouping with `aria-hidden="true"` on duplicate tracks so screen readers do not read repetitive technology lists.
- Existing Devicon CDN SVGs remain available and reliable; the AI Integration card uses an embedded high-resolution SVG icon to ensure zero third-party lookup failures.
- No backend controller changes, database migrations, or API route modifications are required.
