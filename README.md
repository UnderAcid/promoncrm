# nERP Landing

Одностраничное приложение nERP перезапущено на PHP 8.4 + Vanilla JS с поддержкой локализации и тем. Проект структурирован для дальнейшего развития и удобной поддержки.

## Стек и структура

```
.
├── bootstrap.php           # простой автозагрузчик и вспомогательные функции
├── public/                 # публичные файлы (документ-рута nginx/php -S)
│   ├── index.php           # точка входа, SSR с выбранным языком/темой
│   ├── api/translations.php# JSON API для переключения языка на клиенте
│   └── assets/
│       ├── css/main.css    # стилевой слой с поддержкой тем
│       └── js/             # app.js, i18n.js, theme.js
├── resources/lang/         # словари локализаций (ru, en)
├── src/                    # PHP-код приложения
│   ├── Config/AppConfig.php
│   ├── Services/TranslationService.php
│   └── Support/helpers.php
└── README.md
```

## Возможности

- 🌐 **i18n**: серверная отрисовка с выбранным языком, переключатель языков и загрузка переводов без перезагрузки страницы.
- 🎨 **Темы**: светлая и тёмная тема с сохранением выбора в cookie (учитываются на сервере при первичной отрисовке).
- ⚡ **Быстрая загрузка**: минимальный JS (Vanilla), отложенные скрипты `defer`, использование CSS‑переменных и градиентов без тяжёлых зависимостей.
- 🔍 **SEO**: динамический `<title>`, `<meta name="description">`, `<meta property="og:*">`, локализованный `lang` на `<html>`.

## Запуск в разработке

Требуется PHP >= 8.1 (проект ориентирован на 8.4). Установите зависимости (их нет) и стартуйте встроенный сервер:

```bash
php -S 0.0.0.0:8000 -t public
```

После запуска приложение доступно на `http://localhost:8000`.

### Nginx + PHP-FPM

Пример минимальной конфигурации nginx (замените `your_domain` и пути на актуальные):

```
server {
    listen 80;
    server_name your_domain;
    root /var/www/nerp/public;
    index index.php;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_pass unix:/run/php/php8.4-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
    }

    location ~* \.(css|js|png|jpg|jpeg|gif|svg|webp|ico)$ {
        try_files $uri $uri/ =404;
        expires 7d;
        add_header Cache-Control "public";
    }
}
```

## Локализации

- Добавляйте новые языки в `resources/lang/<locale>.php` по аналогии с `ru.php`/`en.php`.
- Обновите `App\Config\AppConfig::get()` — добавьте язык в `available_locales`.
- Текстовые элементы в верстке помечены `data-i18n-key` (JS обновляет их при переключении языка).

## Темы

Тематические переменные определены в `public/assets/css/main.css`. Для добавления новой темы расширьте карту в `AppConfig::get()['themes']`, задайте переменные CSS и обработку в `ThemeManager` (JS).

## Тестирование

- Запустите приложение (`php -S ...`) и убедитесь, что:
  - переключение языков обновляет контент без перезагрузки;
  - выбранный язык и тема сохраняются при обновлении страницы;
  - переключение темы мгновенно меняет палитру без визуальных артефактов.

## Разработка

- JavaScript не использует сборщиков; файлы подключены c `defer`.
- PHP-код придерживается строгой типизации (`declare(strict_types=1);`).
- Для добавления новых API‑эндпоинтов создавайте файлы в `public/api` и используйте автозагрузку из `bootstrap.php`.

Удачной разработки! 🚀
