const config = window.__APP_CONFIG__ || {};
const docEl = document.documentElement;
const themes = Array.isArray(config.themes) && config.themes.length ? config.themes : ['light', 'dark'];
const themeLabels = (config.themeLabels && typeof config.themeLabels === 'object') ? config.themeLabels : {};

if (!localStorage.getItem('prefersDarkSet')) {
  const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
  document.cookie = `prefersDark=${prefersDark}; path=/; max-age=${60 * 60 * 24 * 30}`;
  localStorage.setItem('prefersDarkSet', '1');
}

const trackEvent = (eventName, payload = {}) => {
  if (typeof window.track === 'function' && eventName) {
    window.track(eventName, payload);
  }
};

const resolveTargetElement = (value) => {
  if (!value) return null;
  const trimmed = value.trim();
  if (!trimmed) return null;
  const direct = document.querySelector(trimmed);
  if (direct instanceof HTMLElement) {
    return direct;
  }
  const selector = trimmed.startsWith('#') ? trimmed.slice(1) : trimmed.replace(/^#/, '');
  if (!selector) {
    return null;
  }
  const byId = document.getElementById(selector);
  if (byId instanceof HTMLElement) {
    return byId;
  }
  return null;
};

const scrollToElement = (element) => {
  if (!(element instanceof HTMLElement)) {
    return;
  }
  try {
    element.scrollIntoView({ behavior: 'smooth', block: 'start' });
  } catch (error) {
    element.scrollIntoView();
  }
};

document.addEventListener('DOMContentLoaded', () => {
  docEl.classList.remove('no-js');

  const lang = docEl.lang || '';
  const utmData = (window.__utm && typeof window.__utm === 'object') ? window.__utm : {};
  const utmEntries = Object.entries(utmData).filter(([, value]) => Boolean(value));
  const utmQueryString = utmEntries.map(([key, value]) => `${encodeURIComponent(key)}=${encodeURIComponent(value)}`).join('&');

  const navToggle = document.querySelector('[data-nav-toggle]');
  const nav = document.querySelector('[data-nav]');
  const header = document.querySelector('[data-header]');
  const languageButton = document.querySelector('[data-language-button]');
  const languageIcon = document.querySelector('[data-language-icon]');
  const themeToggle = document.querySelector('[data-theme-toggle]');
  const themeIcon = document.querySelector('[data-theme-icon]');
  const floatingCtaButton = document.querySelector('[data-floating-cta]');
  const floatingCta = floatingCtaButton?.parentElement ?? null;
  const applyForm = document.querySelector('[data-apply-form]');
  const submitButton = applyForm?.querySelector('button[type="submit"]') ?? null;
  const successMessage = applyForm?.querySelector('[data-form-success]') ?? null;
  const errorMessage = applyForm?.querySelector('[data-form-error]') ?? null;
  const firstField = applyForm ? applyForm.querySelector('input, textarea') : null;
  const defaultSuccessText = successMessage?.textContent || '';
  const defaultErrorText = errorMessage?.textContent || '';

  if (utmEntries.length) {
    document.querySelectorAll('[data-append-utm="true"]').forEach((node) => {
      if (!(node instanceof HTMLAnchorElement)) {
        return;
      }
      const rawHref = node.getAttribute('href') || '';
      if (rawHref.startsWith('#')) {
        node.addEventListener('click', () => {
          if (!utmQueryString) {
            return;
          }
          const base = window.location.pathname || '/';
          try {
            window.history.replaceState(null, '', `${base}?${utmQueryString}${rawHref}`);
          } catch (error) {
            /* ignore history errors */
          }
        });
        return;
      }
      try {
        const url = new URL(rawHref, window.location.origin);
        utmEntries.forEach(([key, value]) => {
          url.searchParams.set(key, value);
        });
        node.setAttribute('href', url.toString());
      } catch (error) {
        /* ignore malformed URLs */
      }
    });

    document.querySelectorAll('form[data-include-utm="true"]').forEach((form) => {
      if (!(form instanceof HTMLFormElement)) {
        return;
      }
      utmEntries.forEach(([key, value]) => {
        if (!form.querySelector(`[name="${CSS.escape(key)}"]`)) {
          const hidden = document.createElement('input');
          hidden.type = 'hidden';
          hidden.name = key;
          hidden.value = value;
          form.appendChild(hidden);
        }
      });
    });
  }

  document.querySelectorAll('[data-track-event]').forEach((node) => {
    if (!(node instanceof HTMLElement)) {
      return;
    }
    node.addEventListener('click', () => {
      const eventName = node.dataset.trackEvent;
      if (!eventName) {
        return;
      }
      const payload = {
        label: node.dataset.trackLabel || '',
        location: node.dataset.trackLocation || '',
        lang,
      };
      if (node instanceof HTMLAnchorElement) {
        payload.href = node.getAttribute('href') || '';
      }
      trackEvent(eventName, Object.assign(payload, utmData));
    });
  });

  const closeNav = () => {
    if (header instanceof HTMLElement && navToggle instanceof HTMLElement) {
      header.classList.remove('nav-open');
      navToggle.setAttribute('aria-expanded', 'false');
    }
  };

  if (navToggle instanceof HTMLElement && nav instanceof HTMLElement && header instanceof HTMLElement) {
    navToggle.addEventListener('click', () => {
      const expanded = navToggle.getAttribute('aria-expanded') === 'true';
      if (expanded) {
        closeNav();
      } else {
        header.classList.add('nav-open');
        navToggle.setAttribute('aria-expanded', 'true');
      }
    });

    nav.querySelectorAll('a').forEach((link) => {
      link.addEventListener('click', () => {
        if (window.innerWidth < 860) {
          closeNav();
        }
      });
    });
  }

  const focusForm = () => {
    if (firstField instanceof HTMLElement) {
      setTimeout(() => {
        try {
          firstField.focus({ preventScroll: true });
        } catch (error) {
          firstField.focus();
        }
      }, 280);
    }
  };

  const attachScrollTrigger = (node) => {
    if (!(node instanceof HTMLElement)) {
      return;
    }
    node.addEventListener('click', (event) => {
      const targetAttr = node.dataset.scrollTarget || node.getAttribute('href') || '';
      if (!targetAttr) {
        return;
      }
      if (node instanceof HTMLAnchorElement && !node.dataset.scrollTarget && !targetAttr.startsWith('#')) {
        return;
      }
      event.preventDefault();
      const targetElement = resolveTargetElement(targetAttr);
      if (targetElement) {
        scrollToElement(targetElement);
        if (applyForm && (targetElement === applyForm || targetElement.contains(applyForm))) {
          focusForm();
        }
      }
      if (window.innerWidth < 860) {
        closeNav();
      }
    });
  };

  document.querySelectorAll('[data-scroll-target]').forEach(attachScrollTrigger);
  if (floatingCtaButton instanceof HTMLElement) {
    attachScrollTrigger(floatingCtaButton);
  }

  if (!applyForm && floatingCta instanceof HTMLElement) {
    floatingCta.remove();
  }

  if (floatingCta instanceof HTMLElement) {
    const toggleFloating = () => {
      if (window.scrollY > 360) {
        floatingCta.classList.add('is-visible');
      } else {
        floatingCta.classList.remove('is-visible');
      }
    };
    toggleFloating();
    window.addEventListener('scroll', toggleFloating, { passive: true });
  }

  if (languageButton instanceof HTMLElement) {
    let cycle = [];
    try {
      cycle = JSON.parse(languageButton.dataset.localeCycle || '[]');
    } catch (error) {
      cycle = [];
    }
    languageButton.addEventListener('click', () => {
      if (!Array.isArray(cycle) || cycle.length === 0) {
        return;
      }
      const current = languageButton.dataset.currentLocale || '';
      let index = cycle.findIndex((entry) => entry.code === current);
      if (index < 0) {
        index = 0;
      }
      const next = cycle[(index + 1) % cycle.length];
      if (next && next.href) {
        window.location.href = next.href;
      }
    });

    if (languageIcon instanceof HTMLElement && Array.isArray(cycle) && cycle.length) {
      const current = languageButton.dataset.currentLocale || '';
      const normalized = current.replace(/[^a-z]/gi, '').slice(0, 2).toLowerCase();
      languageIcon.classList.remove('flag-ru', 'flag-en', 'globe');
      if (normalized === 'ru' || normalized === 'en') {
        languageIcon.classList.add(`flag-${normalized}`);
      } else {
        languageIcon.classList.add('globe');
      }
    }
  }

  const renderThemeState = (theme) => {
    if (themeIcon instanceof HTMLElement) {
      themeIcon.classList.remove('sun', 'moon');
      themeIcon.classList.add(theme === 'dark' ? 'moon' : 'sun');
    }
    if (themeToggle instanceof HTMLElement) {
      themeToggle.setAttribute('aria-pressed', String(theme === 'dark'));
      const currentIndex = themes.indexOf(theme);
      const hasCycle = themes.length > 1;
      const nextIndex = hasCycle ? (currentIndex + 1) % themes.length : currentIndex;
      const nextTheme = themes[nextIndex] || theme;
      const nextLabel = themeLabels[nextTheme] || nextTheme;
      themeToggle.setAttribute('title', nextLabel);
      themeToggle.toggleAttribute('disabled', !hasCycle);
    }
  };

  const setTheme = (theme) => {
    const next = themes.includes(theme) ? theme : themes[0];
    docEl.setAttribute('data-theme', next);
    document.cookie = `theme=${next}; path=/; max-age=${60 * 60 * 24 * 30}`;
    localStorage.setItem('theme', next);
    renderThemeState(next);
  };

  const storedTheme = localStorage.getItem('theme');
  if (storedTheme && themes.includes(storedTheme)) {
    setTheme(storedTheme);
  } else {
    renderThemeState(docEl.getAttribute('data-theme') || themes[0]);
  }

  if (themeToggle instanceof HTMLElement) {
    themeToggle.addEventListener('click', () => {
      if (themeToggle.hasAttribute('disabled')) {
        return;
      }
      const current = docEl.getAttribute('data-theme') || themes[0];
      const currentIndex = themes.indexOf(current);
      const nextTheme = themes[(currentIndex + 1) % themes.length];
      setTheme(nextTheme);
    });
  }

  if (successMessage instanceof HTMLElement) {
    successMessage.setAttribute('aria-live', 'polite');
  }
  if (errorMessage instanceof HTMLElement) {
    errorMessage.setAttribute('aria-live', 'assertive');
  }

  if (applyForm instanceof HTMLFormElement) {
    applyForm.addEventListener('submit', async (event) => {
      event.preventDefault();
      if (successMessage instanceof HTMLElement) {
        successMessage.hidden = true;
        successMessage.textContent = defaultSuccessText;
      }
      if (errorMessage instanceof HTMLElement) {
        errorMessage.hidden = true;
        errorMessage.textContent = defaultErrorText;
      }
      if (submitButton instanceof HTMLButtonElement) {
        submitButton.disabled = true;
      }

      const formData = new FormData(applyForm);
      utmEntries.forEach(([key, value]) => {
        if (!formData.has(key)) {
          formData.append(key, value);
        }
      });

      try {
        const response = await fetch(applyForm.action || '/api/pilot.php', {
          method: 'POST',
          body: formData,
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
          },
        });
        const isJson = (response.headers.get('content-type') || '').includes('application/json');
        const payload = isJson ? await response.json() : null;
        if (!response.ok) {
          const message = payload?.error || payload?.message || '';
          throw new Error(message);
        }
        if (successMessage instanceof HTMLElement) {
          const message = payload?.message || defaultSuccessText;
          successMessage.textContent = message;
          successMessage.hidden = false;
        }
        applyForm.reset();
        focusForm();
        trackEvent('form_submit', Object.assign({ form: 'pilot', status: 'success', lang }, utmData));
      } catch (error) {
        const message = error instanceof Error && error.message ? error.message : defaultErrorText;
        if (errorMessage instanceof HTMLElement) {
          errorMessage.textContent = message;
          errorMessage.hidden = false;
        }
        trackEvent('form_submit', Object.assign({ form: 'pilot', status: 'error', lang }, utmData));
      } finally {
        if (submitButton instanceof HTMLButtonElement) {
          submitButton.disabled = false;
        }
      }
    });
  }
});
