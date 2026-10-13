# Quickstart & Validation Guide: Infinite Dual-Row Technology Sliders

**Feature Branch**: `001-tech-sliders`  
**Date**: 2026-10-13  
**Status**: Ready for Implementation  

---

## Prerequisites

- Local PHP environment (PHP 8.2+ installed with Composer, or Apache via XAMPP running at `c:\xampp\htdocs\Portfolio`).
- Modern web browser (Chrome, Edge, Firefox, or Safari).

---

## Launching the Local Portfolio

Open a terminal in the project root and start the Laravel development server (if not already running through XAMPP):

```bash
php artisan serve
```

Alternatively, open your local URL (e.g. `http://localhost:8000` or `http://localhost/Portfolio/public`).

---

## Validation Scenarios

### Scenario 1: Verify Row 1 Direction & Contents
1. Scroll down to Section 01 (About / Technologies).
2. **Observe Row 1**:
   - Verify movement is strictly **LEFT TO RIGHT** (→).
   - Verify the 7 technologies in order:
     - `PHP` (Subtitle: `Backend`)
     - `Composer` (Subtitle: `Dependencies`)
     - `JavaScript` (Subtitle: `Frontend & APIs`)
     - `MySQL` (Subtitle: `Database`)
     - `CodeIgniter 4` (Subtitle: `Framework`)
     - `Laravel` (Subtitle: `Framework`)
     - `Bootstrap` (Subtitle: `UI toolkit`)

### Scenario 2: Verify Row 2 Direction & Contents
1. **Observe Row 2**:
   - Verify movement is strictly **RIGHT TO LEFT** (←).
   - Verify the 7 technologies in order:
     - `Tailwind CSS` (Subtitle: `UI styling`)
     - `Arduino` (Subtitle: `Hardware`)
     - `Git` (Subtitle: `Version control`)
     - `Nginx` (Subtitle: `Web server`)
     - `Ubuntu` (Subtitle: `Server OS`)
     - `AI Integration` (Subtitle: `Gemini • Groq • OpenRouter`)
     - `Azure` (Subtitle: `Cloud platform`)

### Scenario 3: Verify AI Integration Card Specifics
1. Inspect the 6th card in Row 2.
2. Verify Title is exactly **AI Integration** (NOT "Groq Integration" or "AI & APIs").
3. Verify Subtitle is exactly **Gemini • Groq • OpenRouter**.
4. Verify the logo is a clean, multi-provider AI icon rather than a vendor-locked logo.

### Scenario 4: Verify Independent Hover-to-Pause
1. Move the mouse cursor over Row 1.
   - **Expected**: Row 1 stops scrolling immediately. Row 2 continues scrolling smoothly Right-to-Left.
   - The hovered card demonstrates a subtle lift (`translateY(-2px) scale(1.02)`) and darkened border.
2. Move cursor away from Row 1.
   - **Expected**: Row 1 immediately resumes scrolling Left-to-Right from its paused position without jumping.
3. Move cursor over Row 2.
   - **Expected**: Row 2 stops scrolling immediately; Row 1 continues scrolling unaffected.

### Scenario 5: Verify Seamless Infinite Loop & Zero Reset Jump
1. Watch either row continuously for at least 2 full rotation cycles (~70 seconds).
2. **Expected**:
   - There is NO blank space or gap anywhere in the stream.
   - There is NO visible jump, stutter, or flicker when the animation resets at `-50%` or `0`.
   - The cards appear as an unbroken, continuous ribbon.

### Scenario 6: Verify Responsive Containment & Zero Page Overflow
1. Open Chrome DevTools (`F12`) and enable Device Mode (`Ctrl+Shift+M`).
2. Test viewports:
   - Mobile: 375px width (iPhone SE)
   - Tablet: 768px width (iPad Mini)
   - Desktop: 1280px width
   - Ultrawide: 2560px width
3. In Console, run:
   ```javascript
   console.log("Overflow check:", document.documentElement.scrollWidth <= window.innerWidth);
   ```
4. **Expected**: Returns `true`. No horizontal scrollbar appears on the webpage.

### Scenario 7: Verify Edge Fade Masks
1. Observe the far left and far right edges of both slider rows.
2. **Expected**: Cards smoothly fade into visibility as they enter and fade out as they exit, creating a soft edge transition rather than an abrupt cutoff.

### Scenario 8: Verify Accessibility (`prefers-reduced-motion`)
1. In Chrome DevTools, open the Rendering tab (`Ctrl+Shift+P` -> type "Rendering").
2. Under "Emulate CSS media feature prefers-reduced-motion", select `prefers-reduced-motion: reduce`.
3. **Expected**: Continuous auto-scrolling stops immediately. Cards remain accessible and cleanly formatted.

### Scenario 9: Verify Theme Compatibility
1. Toggle the theme switcher between Light and Dark mode.
2. **Expected**: In both modes, card background, borders, text, and SVG logos adapt cleanly according to `--white`, `--line`, `--ink`, and `--muted`.
