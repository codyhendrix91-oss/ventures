# S.Ventures — Design Context (Canonical)

## Brand Palette
- Primary Dark Gradient (footer 3-column): linear-gradient(135deg, #2B234A 0%, #3d3158 100%)
- Secondary Accents: Cyan #00d9ff, Green #2efc86 (use sparingly)
- Purple Highlights (newsletter CTA & select pills):
  - Button gradient: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%)
  - “Re.Ventures” word: #ddd6fe
- Text:
  - Body on light: #1a1d35
  - On dark gradients: #ffffff
- Contact icons in footer: white background (#ffffff)

## Typography
- Headings font: Colour Brown / "proxima-nova", sans-serif
- Body: system UI stack
- Line-height for blog content: ~1.62

## Component-level Rules
- **Newsletter**
  - Appears on all marketing pages, not on single-domain pages.
  - Background matches surrounding section (not full purple).
  - Spam layers: honeypot, time delay, pattern block, rate limit.
- **Footer**
  - Background gradient: #2B234A→#3d3158.
  - Centered headings, white text.
- **Contact icons bar**
  - White background icons under footer gradient.
- **Blog**
  - Archive: 3-column grid on desktop.
  - Single post: clean, readable, minimal purple.
- **Single Domain Pages**
  - Always H2 “About {Title}.com”.
  - No newsletter block.
  - Minimal gradients.

## Interaction
- Subtle lifts, minimal shadows, no global uppercase.

## Do / Don’t
- DO respect page-type differences.
- DO use color variables and CSS vars where possible.
- DON’T dump full SVGs inline.
- DON’T unify gradients unless requested.
