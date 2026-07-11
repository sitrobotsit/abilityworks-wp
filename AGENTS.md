# AGENTS.md

## Cursor Cloud specific instructions

### What this repo is
This repository tracks a single WordPress theme, `wp-content/themes/abilityworks21/`
(see `.gitignore` — everything else is intentionally ignored). WordPress core, the
database, and plugins (notably **ACF Pro**) are NOT in this repo; they live on the
hosting environment and the theme is deployed on top of an existing WP install
(`.cpanel.yml`, `.github/workflows/deploy-staging.yml`). The developable/buildable
part here is the theme's asset pipeline (SCSS + JS bundled by Webpack).

### Node version (important gotcha)
The build toolchain is old: `node-sass@4.14.1` + Webpack 4 + Babel 6. It only works
on **Node 14**, not the VM default. A daemon-injected `/exec-daemon/node` (Node 22)
sits earlier in `PATH` than nvm, so `nvm use`/`nvm exec` do NOT take effect. Node 14
is installed via nvm and the agent's `~/.bashrc` prepends it, so a fresh interactive
shell already runs `node -v` → `v14.21.3`. If you hit a shell where Node 22 is active
(e.g. a non-login shell), prepend it explicitly:
`export PATH="$HOME/.nvm/versions/node/v14.21.3/bin:$PATH"`.
Running Webpack under Node 22 fails because the `node-sass` native binary is built
for the Node 14 ABI.

### Commands (run inside `wp-content/themes/abilityworks21/`)
- Build assets (production): `npm run build` → emits `css/style.min.css` + `js/script.min.js` (both are committed artifacts; avoid committing incidental rebuild diffs).
- Dev watch loop: `npm run watch` → Webpack `--watch` (development mode) + BrowserSync. This is the "run" command for local development.
- `npm run watch-admin` is broken (references a missing `webpack.admin.config.js`).
- There is no lint or automated-test setup in this repo.

### BrowserSync caveat
`npm run watch` starts BrowserSync proxying `http://abilityworks.local` (an external
WordPress host). In the cloud VM that host does not resolve, so `http://localhost:3000`
cannot serve page content — but the BrowserSync server itself is up (UI at
`http://localhost:3001` returns 200) and Webpack still watches/recompiles on file
changes. To render the full theme you would need a separate running WordPress + MySQL
stack with ACF Pro activated (not available in this repo/VM).
