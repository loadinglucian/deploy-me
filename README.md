# Deploy Me

A minimal PHP application for testing [deployer-php](https://github.com/loadinglucian/deployer-php). Use this as a reference project or deploy target when following the package documentation.

## What's Inside

- Single `index.php` entry point displaying an environment variable
- Tailwind CSS (v4) compiled via Vite
- Confetti celebration on page load

## Local Setup

```bash
composer install
bun install        # or: npm install
```

### Development

```bash
bun run dev        # starts Vite on localhost:5173
php -S localhost:8000
```

The PHP app auto-detects the Vite dev server and loads assets from it with hot reload.

### Production

```bash
bun run build      # or: npm run build
```

Outputs to `dist/` with a manifest. The PHP reads this manifest automatically — no config needed.

## Environment

Create a `.env` file:

```env
APP_MESSAGE="Yay, confetti! 🎉"
```

This message displays on the page.
