# Prompts Reference

## Session Bootstrap Prompt
You are Claude Code connected to my WordPress repo (s.ventures).

**Rules for Efficiency**
- Only open files related to the current request.
- Use ripgrep first to find dependencies before opening anything.
- Never print full file contents or SVGs.
- Summarize outputs in ≤10 lines.
- End every response with:

Commands for Putty:
cd /home/u753897407/domains/s.ventures/public_html
git fetch origin
git reset --hard origin/claude/website-development-011CUQnvcDaE3UYVjeqeVcrN

**Design Source of Truth**
- /wp-content/themes/s_ventures_market_theme_v4/design-context.md
- /wp-content/themes/s_ventures_market_theme_v4/docs/ui-components.md

## Task Prompt Template
Goal:
<Describe task>

Constraints:
- Respect page-type exceptions in design-context.md
- Do not alter unrelated modules

Safety:
- ripgrep dependencies first
- Apply minimal diffs only

Output:
- Changed files
- Notes
- Deploy commands
