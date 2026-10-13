# Phase 1 Data Model: Infinite Dual-Row Technology Sliders

**Feature Branch**: `001-tech-sliders`  
**Date**: 2026-10-13  
**Status**: Completed  

---

## Entities & Structure

Although this feature is rendered directly via Laravel Blade and styled with Vanilla CSS without database persistence, the technology items follow a strict, structured entity model.

### 1. TechnologyCard Entity

Represents an individual technology displayed within a slider row.

| Field | Type | Description | Example |
|---|---|---|---|
| `id` | `string` | Unique identifier slug | `"ai-integration"` |
| `name` | `string` | Display name of the technology | `"AI Integration"` |
| `subtitle` | `string` | Short category description | `"Gemini • Groq • OpenRouter"` |
| `icon_type` | `enum ('cdn_svg', 'inline_svg')` | Method used to render the logo | `'inline_svg'` |
| `icon_src` | `string` | Devicon CDN URL or inline SVG path | `https://cdn.jsdelivr.net/...` |
| `icon_alt` | `string` | Accessibility alt label | `"AI Integration logo"` |
| `row` | `int (1 or 2)` | Assigned slider row | `2` |
| `order` | `int (1..7)` | Display sequence position | `6` |

#### Validation Rules:
- `name` MUST NOT be empty (max 30 characters).
- `subtitle` MUST NOT be empty (max 40 characters).
- `row` MUST be strictly `1` or `2`.
- `order` MUST be unique per row from `1` to `7`.

---

### 2. SliderRow Entity

Represents a single horizontal marquee slider track.

| Field | Type | Description | Example |
|---|---|---|---|
| `row_id` | `int` | Sequential row identifier | `1` |
| `direction` | `enum ('ltr', 'rtl')` | Motion direction | `'ltr'` (Left to Right) |
| `animation_name`| `string` | CSS keyframe identifier | `'marquee-ltr'` |
| `cycle_duration`| `string` | Total duration for one loop cycle | `'35s'` |
| `aria_label` | `string` | Screen reader region label | `"Technologies Row 1: Backend and UI toolkits"` |
| `items` | `TechnologyCard[]` | Array of exactly 7 cards | `[PHP, Composer, JavaScript, MySQL, CodeIgniter, Laravel, Bootstrap]` |

---

## Static Item Registry

### Row 1: Left to Right (`direction: ltr`)

| Order | Name | Subtitle | Icon URL / Asset |
|---|---|---|---|
| 1 | PHP | Backend | `https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/php/php-original.svg` |
| 2 | Composer | Dependencies | `https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/composer/composer-original.svg` |
| 3 | JavaScript | Frontend & APIs | `https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/javascript/javascript-original.svg` |
| 4 | MySQL | Database | `https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/mysql/mysql-original.svg` |
| 5 | CodeIgniter 4 | Framework | `https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/codeigniter/codeigniter-plain.svg` |
| 6 | Laravel | Framework | `https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/laravel/laravel-original.svg` |
| 7 | Bootstrap | UI toolkit | `https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/bootstrap/bootstrap-original.svg` |

---

### Row 2: Right to Left (`direction: rtl`)

| Order | Name | Subtitle | Icon URL / Asset |
|---|---|---|---|
| 1 | Tailwind CSS | UI styling | `https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/tailwindcss/tailwindcss-original.svg` |
| 2 | Arduino | Hardware | `https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/arduino/arduino-original.svg` |
| 3 | Git | Version control | `https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/git/git-original.svg` |
| 4 | Nginx | Web server | `https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/nginx/nginx-original.svg` |
| 5 | Ubuntu | Server OS | `https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/ubuntu/ubuntu-original.svg` |
| 6 | AI Integration | Gemini • Groq • OpenRouter | Inline crisp AI sparkle/neural vector SVG |
| 7 | Azure | Cloud platform | `https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/azure/azure-original.svg` |
