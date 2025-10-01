# nERP Landing

A fast PHP 8.4 + Vanilla JS marketing site for the nERP Web3 ERP builder. The application renders server-side with lightweight assets, internationalisation, and theme support to stay maintainable and SEO friendly.

## Features

- **PHP 8.4 application shell** with a clean `public/` entry point and `src/` helpers for configuration.
- **Internationalisation (i18n)** powered by PHP arrays with locale fallback (`ru` default, `en` available).
- **Locale switcher** that persists the visitor choice and exposes translated content to both PHP and JS.
- **Client theme switching** with `system`, `light`, and `dark` modes stored in `localStorage` and applied before paint to avoid flashes.
- **SEO optimised markup** with meta tags, canonical and alternate links, semantic structure, and lean assets delivered from `/public`.
- **Vanilla JavaScript enhancements** (audience focus, pricing calculator, FAQ accordion) using translated content and modern APIs.

## Project structure

```
.
├── config/             # App-wide configuration (locales, themes)
├── public/             # Web server document root (index.php, assets)
│   └── assets/
│       ├── css/
│       │   └── app.css
│       └── js/
│           └── app.js
├── resources/
│   └── lang/           # Locale files (PHP arrays)
├── src/
│   ├── bootstrap.php   # Bootstraps config, locale, translations
│   └── helpers.php     # Common helper functions
├── templates/          # Reserved for future templates/partials
└── README.md
```

## Requirements

- PHP **8.4** (or the latest 8.x build with `intl` extension for localisation helpers).
- Web server (Nginx/Apache/Caddy) configured to serve the `public/` directory.
- Node is not required; assets are plain CSS/JS.

## Local development

1. Ensure PHP 8.4 is available on your machine.
2. Install project dependencies (none at the moment).
3. Serve the site using PHP's built-in web server:

   ```bash
   php -S localhost:8000 -t public/
   ```

4. Open [http://localhost:8000](http://localhost:8000) in your browser.

The language picker and theme switcher persist selections via cookies/localStorage. Clear them if you need a fresh view.

## Production deployment

### Nginx sample configuration

```nginx
server {
    listen 80;
    server_name example.com;

    root /var/www/nerp/public;
    index index.php;

    access_log /var/log/nginx/nerp.access.log;
    error_log  /var/log/nginx/nerp.error.log;

    location /assets/ {
        try_files $uri =404;
        expires 7d;
        add_header Cache-Control "public";
    }

    location / {
        try_files $uri /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

- Point `root` to the repository `public/` directory.
- Serve static assets directly and let PHP handle page rendering.
- Configure TLS/HTTPS on the same server block for production.

### Caching & performance notes

- CSS is preloaded and minified enough for optimal First Contentful Paint.
- Fonts are loaded via Google Fonts with `preconnect` hints.
- All copy is rendered server-side to keep HTML crawlable for SEO.
- JavaScript enhances UX but the core content remains accessible without it.

## Internationalisation

- Locale files live in `resources/lang/{locale}.php` and return associative arrays.
- Add a new language by creating a file (e.g. `resources/lang/de.php`), translating keys, and extending `config/app.php` with locale metadata.
- The locale switcher uses `?lang=code` query parameters and sets a cookie for persistence.
- JavaScript receives translated snippets through the `window.__APP_I18N__` object.

## Theming

- The document `<html>` element carries a `data-theme` attribute (`system`, `light`, or `dark`).
- Theme preference is applied as early as possible to avoid flashes.
- Custom properties drive the design, making it simple to adjust or extend the palette.

## Extending the site

- Keep PHP presentation in `public/` or `templates/` and business logic/helpers within `src/`.
- Use the helper `t($translations, 'key.path')` to read translated strings.
- Add new JS behaviours to `public/assets/js/app.js` and expose any required data via the PHP bootstrapping script.

## License

The project inherits your organisation's licensing policy. Update this section as needed.
