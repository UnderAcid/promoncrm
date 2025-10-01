# nERP Landing

Одностраничное промо-приложение для конструктора nERP, написанное на **PHP 8.4** и **Vanilla JS**. Проект структурирован таким образом, чтобы обеспечить лёгкое расширение, локализацию и поддержку тем.

## Архитектура проекта

```
.
├── config/              # Конфигурация приложения (локали и пр.)
├── public/              # Публичные ассеты и единственная точка входа (index.php)
│   └── assets/
│       ├── css/
│       └── js/
├── resources/
│   ├── lang/            # Файлы переводов (ru.php, en.php)
│   └── views/           # Шаблоны представлений (layout.php)
├── src/
│   ├── Support/         # Классы ядра (переводчик)
│   ├── bootstrap.php    # Инициализация приложения
│   └── helpers.php      # Вспомогательные функции
└── README.md
```

Основные возможности:

- Серверный рендеринг с использованием простых PHP-шаблонов.
- Встроенная i18n (русский и английский языки), переключение на лету, сохранение предпочтений в cookie.
- Поддержка светлой, тёмной и системной темы (автовыбор по `prefers-color-scheme`).
- Быстрая загрузка: минимальное количество ассетов, отложенная загрузка JS (`defer`), SEO мета-теги, предзагрузка шрифтов.
- Калькулятор стоимости и интерактивные блоки на чистом JavaScript без зависимостей.

## Требования

- PHP >= 8.4
- Composer не требуется.
- Любой веб-сервер, умеющий проксировать запросы в директорию `public/` (Nginx, Caddy, Apache и т.д.).

## Локальная разработка

1. Установите PHP 8.4 (с поддержкой `intl`, т.к. используется `Intl\NumberFormat` на клиенте).
2. Запустите встроенный сервер PHP:
   ```bash
   php -S localhost:8000 -t public
   ```
3. Откройте [http://localhost:8000](http://localhost:8000) в браузере.

При изменении переводов или шаблонов просто обновите страницу — дополнительной сборки не требуется.

## Nginx конфигурация

Минимальный пример виртуального хоста, который можно адаптировать под свои нужды:

```nginx
server {
    listen 80;
    server_name nerp.local;

    root /var/www/nerp/public;
    index index.php;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";
    add_header Referrer-Policy "strict-origin-when-cross-origin";

    location / {
        try_files $uri /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~* \.(?:css|js|png|jpe?g|svg|webp|ico)$ {
        expires 7d;
        access_log off;
    }
}
```

## Добавление новых переводов

1. Скопируйте существующий файл из `resources/lang/` и дайте ему имя нового языка (`es.php`, `de.php` и т.д.).
2. Добавьте язык в массив `locales` в `config/app.php`.
3. Переведите значения, сохраняя структуру массива.

## Расширение функционала

- Новые блоки добавляются в шаблон `resources/views/layout.php`. Все текстовые значения следует хранить в переводах.
- Для сложных страниц можно создать дополнительные шаблоны и подключать их в `public/index.php`.
- Клиентский код живёт в `public/assets/js/main.js`; придерживайтесь безбиблиотечного подхода для сохранения скорости загрузки.

## SEO и производительность

- Используются ключевые мета-теги (`title`, `description`, `keywords`, OG).
- Стили оптимизированы под современные браузеры, поддерживается `prefers-reduced-motion`.
- Шрифты Google Fonts загружаются с `preconnect` и `preload` для ускорения.
- JS подключается с `defer`, чтобы не блокировать отрисовку.

## Лицензия

Проект распространяется под лицензией MIT (по необходимости замените на актуальную для вашего продукта).
