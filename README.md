# nERP Landing

Одностраничное промо-приложение на PHP 8.4 и Vanilla JS для сайта [nerp.app](https://nerp.app). Структура проекта переработана под классическую схему `public/` + `src/`, добавлены серверная локализация с языковыми URL, поддержка темы в стиле мезенской росписи и оптимизации для быстрой загрузки.

## Ключевые возможности

- **SSR + i18n** — тексты рендерятся на сервере в зависимости от выбранного языка (русский / английский). Каждая версия доступна по отдельному URL (`/ru/`, `/en/`).
- **Темы** — светлая, тёмная и новая тема «Мезенская роспись» с запоминанием выбора пользователя (cookie + `localStorage`).
- **Пилотные заявки** — форма присоединения к пилотной программе с серверной валидацией и сохранением заявок в `storage/pilot_requests.jsonl`.
- **SEO оптимизация** — корректный `<html lang>`, метаданные, канонический URL, Open Graph и Twitter карточки.
- **Производительность** — минифицированных сборок нет, проект грузится «как есть». Кеш-бастинг для статики через `filemtime`, CSS построен на CSS-переменных с поддержкой `prefers-reduced-motion`.
- **Адаптивный UI** — сетки и компоненты адаптируются под мобильные и десктопные разрешения.

## Структура проекта

```
├── public/              # Документ-рут для web-сервера
│   ├── assets/
│   │   ├── css/app.css  # Основные стили (темы + компоненты)
│   │   └── js/app.js    # Клиентская логика (i18n, тема, калькулятор)
│   └── index.php        # Точка входа
├── src/
│   ├── Localization/    # LocaleManager и Translator
│   ├── Theming/         # ThemeManager
│   ├── Support/         # Утилиты/хелперы
│   ├── View.php         # Простая view-фабрика
│   └── bootstrap.php    # Стартовая инициализация
├── translations/        # Файлы переводов (ru.php, en.php)
├── views/               # PHP-шаблоны (layout + partials + страницы)
└── README.md
```

## Требования

- PHP 8.4+
- Веб-сервер с поддержкой работы через `public/` как document root (nginx, Caddy и т.д.)

## Локальный запуск

```bash
# Установите зависимости (их нет) и запустите встроенный сервер PHP
php -S 0.0.0.0:8000 -t public
```

После запуска приложение будет доступно по адресу [http://localhost:8000](http://localhost:8000). Языковые версии открываются по путям `/ru/` и `/en/`.

## Продакшен (nginx + PHP-FPM)

Пример минимальной конфигурации nginx:

```nginx
server {
    listen 80;
    server_name nerp.app www.nerp.app; # замените на свой домен

    root /var/www/nerp/public;
    index index.php;

    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header Referrer-Policy "strict-origin-when-cross-origin" always;

    location / {
        try_files $uri /index.php?$query_string;
    }

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        fastcgi_pass unix:/run/php/php8.4-fpm.sock; # скорректируйте под свою среду
        fastcgi_buffers 16 16k;
        fastcgi_buffer_size 32k;
    }

    location ~* \.(?:css|js|svg|woff2?)$ {
        expires 30d;
        access_log off;
    }
}
```

## Переводы

- Файлы переводов хранятся в `translations/<locale>.php` и возвращают массив с ключами.
- Для добавления нового языка достаточно создать новый файл перевода и зарегистрировать его в `$languages` (`public/index.php`).
- Клиентская логика автоматически подхватывает тексты из серверного конфига (`window.__APP_CONFIG__`).

## Темы

- Доступные темы задаются в `ThemeManager` и передаются на фронтенд через `window.__APP_CONFIG__`.
- Выбор пользователя сохраняется в cookie `theme` и в `localStorage`, поэтому сервер отдаёт страницу сразу с корректной темой.

## Настройка контента

Основной контент находится в `views/home.php`. Для правок:

1. Добавьте/измените строки в файле перевода.
2. Используйте `$t->get('ключ')` в шаблоне.
3. При необходимости расширьте `window.__APP_CONFIG__` в `public/index.php`, чтобы передать данные на фронт.

## Тестирование

Проект не требует сборки. Для smoke-теста достаточно пройтись по основным сценариям:

- Переключить язык в шапке и убедиться, что URL меняется на `/ru/` или `/en/`.
- Переключить тему.
- Потыкать слайдеры калькулятора и убедиться в пересчёте.
- Отправить тестовую заявку в пилот (файл появится в `storage/pilot_requests.jsonl`).
- Открыть/закрыть вопросы FAQ.

## Дополнительные рекомендации

- Для продакшена добавьте HTTP/2 + gzip/brotli, preconnect к CDN-шрифтам уже настроен.
- При необходимости можно вынести переводы в JSON/БД, реализовав свой загрузчик в `LocaleManager`.
