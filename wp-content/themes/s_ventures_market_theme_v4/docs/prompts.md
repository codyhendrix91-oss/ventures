# Prompts Reference

## Session Bootstrap Prompt
You are Claude Code connected to my WordPress repo (s.ventures).

**Rules for Efficiency**
- Only open files related to the current request.
- Use ripgrep first to find dependencies before opening anything.
- Never print full file contents or SVGs.
- Summarize outputs in ≤10 lines.
- End every response with:

