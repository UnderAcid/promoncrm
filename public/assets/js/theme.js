(function (window, document) {
  const App = (window.App = window.App || {});

  function setCookie(name, value, days) {
    const expires = new Date();
    expires.setTime(expires.getTime() + days * 24 * 60 * 60 * 1000);
    document.cookie = `${name}=${encodeURIComponent(value)}; expires=${expires.toUTCString()}; path=/`;
  }

  function ThemeManager(config) {
    this.theme = config.theme || 'light';
    this.themes = Object.keys(config.themes || { light: {}, dark: {} });
    this.cookieName = config.cookies ? config.cookies.theme : 'nerp_theme';
    this.toggleButton = null;
    this.html = document.documentElement;
  }

  ThemeManager.prototype.apply = function (theme, persist = true) {
    if (!theme || this.themes.indexOf(theme) === -1) {
      theme = this.themes[0] || 'light';
    }

    this.theme = theme;
    this.html.setAttribute('data-theme', theme);

    if (persist) {
      setCookie(this.cookieName, theme, 365);
    }

    if (this.toggleButton) {
      this.toggleButton.setAttribute('data-i18n-theme', theme);
      const label = this.toggleButton.querySelector('[data-i18n-key^="common.theme_toggle"]');
      if (label) {
        label.setAttribute('data-i18n-key', `common.theme_toggle.${theme}`);
        if (App.i18n) {
          App.i18n.applyTranslations(this.toggleButton);
        }
      }
    }
  };

  ThemeManager.prototype.bindToggle = function (button) {
    this.toggleButton = button;
    if (!button) {
      return;
    }

    button.addEventListener('click', () => {
      const nextTheme = this.theme === 'dark' ? 'light' : 'dark';
      this.apply(nextTheme);
    });
  };

  App.ThemeManager = ThemeManager;
})(window, document);
