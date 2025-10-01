(function (window, document) {
  const App = (window.App = window.App || {});

  function getNested(source, path) {
    if (!source) {
      return undefined;
    }

    const parts = path.split('.');
    let value = source;

    for (let i = 0; i < parts.length; i += 1) {
      if (value === null || typeof value !== 'object' || !(parts[i] in value)) {
        return undefined;
      }

      value = value[parts[i]];
    }

    return value;
  }

  function setCookie(name, value, days) {
    const expires = new Date();
    expires.setTime(expires.getTime() + days * 24 * 60 * 60 * 1000);
    document.cookie = `${name}=${encodeURIComponent(value)}; expires=${expires.toUTCString()}; path=/`;
  }

  function I18n(config) {
    this.locale = config.locale;
    this.defaultLocale = config.defaultLocale;
    this.translations = config.translations || {};
    this.availableLocales = config.availableLocales || {};
    this.cookieName = config.cookies ? config.cookies.locale : 'nerp_locale';
    this.listeners = [];
  }

  I18n.prototype.getLocale = function () {
    return this.locale;
  };

  I18n.prototype.get = function (key) {
    const value = getNested(this.translations, key);
    return value === undefined ? null : value;
  };

  I18n.prototype.t = function (key) {
    const value = this.get(key);
    return value === null ? key : value;
  };

  I18n.prototype.applyTranslations = function (root) {
    const scope = root || document;
    const elements = scope.querySelectorAll('[data-i18n-key]');

    for (let i = 0; i < elements.length; i += 1) {
      const el = elements[i];
      const key = el.getAttribute('data-i18n-key');
      if (!key) {
        continue;
      }

      const value = this.t(key);

      if (typeof value === 'string') {
        let rendered = value;
        const yearReplacement = el.getAttribute('data-i18n-replace-year');
        if (yearReplacement) {
          rendered = rendered.replace('%year%', yearReplacement);
        }

        el.textContent = rendered;
      }
    }
  };

  I18n.prototype.onChange = function (callback) {
    if (typeof callback === 'function') {
      this.listeners.push(callback);
    }
  };

  I18n.prototype.emitChange = function () {
    for (let i = 0; i < this.listeners.length; i += 1) {
      try {
        this.listeners[i](this);
      } catch (error) {
        console.error('i18n listener error', error);
      }
    }
  };

  I18n.prototype.changeLocale = function (locale) {
    if (!locale || locale === this.locale) {
      return Promise.resolve(this.locale);
    }

    const query = encodeURIComponent(locale);
    return fetch(`api/translations.php?lang=${query}`)
      .then((response) => {
        if (!response.ok) {
          throw new Error('Failed to load translations');
        }

        return response.json();
      })
      .then((payload) => {
        this.locale = payload.locale || locale;
        this.translations = payload.translations || {};
        if (payload.availableLocales) {
          this.availableLocales = payload.availableLocales;
        }
        this.applyTranslations();
        if (document && document.documentElement) {
          document.documentElement.setAttribute('lang', this.locale);
        }
        this.emitChange();
        setCookie(this.cookieName, this.locale, 365);
        return this.locale;
      })
      .catch((error) => {
        console.error(error);
        return this.locale;
      });
  };

  App.I18n = I18n;
})(window, document);
