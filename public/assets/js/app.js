const docEl = document.documentElement;

function smoothScrollTo(target) {
  if (!target) {
    return;
  }
  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const behavior = prefersReducedMotion ? 'auto' : 'smooth';
  target.scrollIntoView({ behavior, block: 'start' });
}

function getLocaleCycle(button) {
  if (!button) return [];
  try {
    const raw = button.getAttribute('data-locale-cycle') || '[]';
    const parsed = JSON.parse(raw);
    if (!Array.isArray(parsed)) {
      return [];
    }
    return parsed
      .map((entry) => ({
        code: typeof entry.code === 'string' ? entry.code : '',
        href: typeof entry.href === 'string' ? entry.href : '',
        label: typeof entry.label === 'string' ? entry.label : '',
      }))
      .filter((entry) => entry.code && entry.href);
  } catch (error) {
    return [];
  }
}

function iconForLocale(locale) {
  const value = (locale || '').toLowerCase();
  if (value.startsWith('ru')) return 'flag-ru';
  if (value.startsWith('en')) return 'flag-en';
  return 'globe';
}

document.addEventListener('DOMContentLoaded', () => {
  docEl.classList.remove('no-js');

  const headerEl = document.querySelector('[data-header]');
  const navToggle = document.querySelector('[data-nav-toggle]');
  const nav = document.querySelector('[data-nav]');
  const themeToggle = document.querySelector('[data-theme-toggle]');
  const themeIcon = document.querySelector('[data-theme-icon]');
  const languageButton = document.querySelector('[data-language-button]');
  const languageIcon = document.querySelector('[data-language-icon]');
  const floatingCtaButton = document.querySelector('[data-floating-cta]');
  const pilotForm = document.querySelector('[data-pilot-form]');

  const applyTargets = document.querySelectorAll('[data-scroll-to-apply]');
  applyTargets.forEach((node) => {
    node.addEventListener('click', (event) => {
      const form = document.getElementById('pilotForm') || pilotForm;
      if (!form) {
        return;
      }
      event.preventDefault();
      smoothScrollTo(form);
      const firstField = form.querySelector('input, textarea');
      if (firstField instanceof HTMLElement) {
        firstField.focus({ preventScroll: true });
      }
    });
  });

  if (floatingCtaButton && pilotForm instanceof HTMLElement) {
    floatingCtaButton.addEventListener('click', () => {
      smoothScrollTo(pilotForm);
      const firstField = pilotForm.querySelector('input, textarea');
      if (firstField instanceof HTMLElement) {
        firstField.focus({ preventScroll: true });
      }
    });
  } else if (floatingCtaButton && !pilotForm) {
    floatingCtaButton.parentElement?.remove();
  }

  if (navToggle instanceof HTMLButtonElement && headerEl instanceof HTMLElement && nav instanceof HTMLElement) {
    const closeNav = () => {
      headerEl.classList.remove('nav-open');
      navToggle.setAttribute('aria-expanded', 'false');
    };
    const openNav = () => {
      headerEl.classList.add('nav-open');
      navToggle.setAttribute('aria-expanded', 'true');
    };

    navToggle.addEventListener('click', () => {
      const expanded = navToggle.getAttribute('aria-expanded') === 'true';
      if (expanded) {
        closeNav();
      } else {
        openNav();
      }
    });

    nav.querySelectorAll('a').forEach((link) => {
      link.addEventListener('click', () => {
        if (window.innerWidth < 860) {
          closeNav();
        }
      });
    });

    window.addEventListener('resize', () => {
      if (window.innerWidth >= 860) {
        closeNav();
      }
    });

    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape' && navToggle.getAttribute('aria-expanded') === 'true') {
        closeNav();
        navToggle.focus();
      }
    });
  }

  const themes = ['light', 'dark'];
  const storedTheme = localStorage.getItem('theme');
  const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
  const initialTheme = storedTheme && themes.includes(storedTheme)
    ? storedTheme
    : prefersDark
      ? 'dark'
      : docEl.getAttribute('data-theme') || themes[0];

  function renderTheme(theme) {
    if (themeIcon instanceof HTMLElement) {
      themeIcon.classList.remove('sun', 'moon');
      themeIcon.classList.add(theme === 'dark' ? 'moon' : 'sun');
    }
    if (themeToggle instanceof HTMLElement) {
      themeToggle.setAttribute('aria-pressed', String(theme === 'dark'));
    }
  }

  function setTheme(theme) {
    const next = themes.includes(theme) ? theme : themes[0];
    docEl.setAttribute('data-theme', next);
    localStorage.setItem('theme', next);
    document.cookie = `theme=${next}; path=/; max-age=${60 * 60 * 24 * 30}`;
    renderTheme(next);
  }

  setTheme(initialTheme);

  if (themeToggle instanceof HTMLButtonElement) {
    themeToggle.addEventListener('click', () => {
      const current = docEl.getAttribute('data-theme') || themes[0];
      const index = themes.indexOf(current);
      const next = themes[(index + 1) % themes.length];
      setTheme(next);
    });
  }

  if (languageButton instanceof HTMLButtonElement && languageIcon instanceof HTMLElement) {
    const localeCycle = getLocaleCycle(languageButton);
    let currentLocale = languageButton.getAttribute('data-current-locale') || (localeCycle[0]?.code ?? '');

    const updateLanguageButton = () => {
      languageIcon.className = `icon ${iconForLocale(currentLocale)}`;
      const label = languageButton.getAttribute('data-label') || 'Language';
      languageButton.setAttribute('title', label);
    };

    updateLanguageButton();

    languageButton.addEventListener('click', () => {
      if (localeCycle.length === 0) {
        return;
      }
      const currentIndex = localeCycle.findIndex((entry) => entry.code === currentLocale);
      const nextIndex = currentIndex >= 0 ? (currentIndex + 1) % localeCycle.length : 0;
      const nextLocale = localeCycle[nextIndex];
      currentLocale = nextLocale.code;
      updateLanguageButton();
      window.location.href = nextLocale.href;
    });
  }

  if (pilotForm instanceof HTMLFormElement) {
    const successMessage = pilotForm.querySelector('[data-pilot-success]');
    const errorMessage = pilotForm.querySelector('[data-pilot-error]');
    const submitButton = pilotForm.querySelector('button[type="submit"]');

    const setMessage = (node, visible) => {
      if (!(node instanceof HTMLElement)) {
        return;
      }
      if (visible) {
        node.removeAttribute('hidden');
        node.setAttribute('aria-live', 'polite');
      } else {
        node.setAttribute('hidden', 'hidden');
      }
    };

    pilotForm.addEventListener('submit', async (event) => {
      event.preventDefault();
      if (!(submitButton instanceof HTMLButtonElement)) {
        pilotForm.submit();
        return;
      }

      submitButton.disabled = true;
      setMessage(successMessage, false);
      setMessage(errorMessage, false);

      try {
        const formData = new FormData(pilotForm);
        formData.append('lang', document.documentElement.lang || '');
        const response = await fetch(pilotForm.getAttribute('action') || '', {
          method: 'POST',
          body: formData,
        });

        const data = await response.json().catch(() => null);
        if (response.ok && data && data.success) {
          pilotForm.reset();
          setMessage(successMessage, true);
          if (floatingCtaButton) {
            floatingCtaButton.focus({ preventScroll: true });
          }
        } else {
          setMessage(errorMessage, true);
        }
      } catch (error) {
        setMessage(errorMessage, true);
      } finally {
        submitButton.disabled = false;
      }
    });
  }
});
