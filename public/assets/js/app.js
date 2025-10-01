const config = window.__APP_CONFIG__ || {};
const docEl = document.documentElement;
const defaultAudience = config.defaultAudience || 'business';
const audiencePitches = config.audiencePitches || {};
const numberLocale = config.numberLocale || 'en-US';
const currencyCode = config.currency || 'USD';
const themeLabels = config.themeLabels || {};
const themes = config.themes || ['light', 'dark'];
const microFee = typeof config.microFee === 'number' ? config.microFee : 0.001;
const fiatPerUsd = typeof config.fiatPerUsd === 'number' && config.fiatPerUsd > 0 ? config.fiatPerUsd : 1;
const tokenDecimals = Number.isInteger(config.tokenDecimals) ? config.tokenDecimals : 6;
const fiatDecimals = Number.isInteger(config.fiatDecimals) ? config.fiatDecimals : 2;
const baseCurrency = typeof config.baseCurrency === 'string' ? config.baseCurrency : 'USD';
const baseCurrencyLocale = typeof config.baseCurrencyLocale === 'string' ? config.baseCurrencyLocale : 'en-US';
const defaultUsdPerToken = (() => {
  const value = Number.parseFloat(config.usdPerToken);
  if (Number.isFinite(value) && value > 0) {
    return value;
  }
  return 1;
})();
let usdPerToken = defaultUsdPerToken;

if (!localStorage.getItem('prefersDarkSet')) {
  const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
  document.cookie = `prefersDark=${prefersDark}; path=/; max-age=${60 * 60 * 24 * 30}`;
  localStorage.setItem('prefersDarkSet', '1');
}

document.addEventListener('DOMContentLoaded', () => {
  docEl.classList.remove('no-js');

  const audienceButtons = document.querySelectorAll('[data-audience]');
  const audiencePitchEl = document.querySelector('[data-audience-pitch]');
  const languageSwitcher = document.querySelector('[data-language-switcher]');
  const languageToggle = languageSwitcher?.querySelector('[data-language-toggle]');
  const languageMenu = languageSwitcher?.querySelector('[data-language-menu]');
  const languageOptions = languageMenu ? Array.from(languageMenu.querySelectorAll('[data-language-option]')) : [];
  const themeToggle = document.querySelector('[data-theme-toggle]');
  const themeLabel = themeToggle?.querySelector('[data-theme-label]');
  const navToggle = document.querySelector('[data-nav-toggle]');
  const nav = document.querySelector('[data-nav]');
  const headerEl = document.querySelector('[data-header]');
  const floatingCtaButton = document.querySelector('[data-floating-cta]');
  const floatingCta = floatingCtaButton?.parentElement ?? null;
  const pilotForm = document.querySelector('[data-pilot-form]');

  const numberFormatter = new Intl.NumberFormat(numberLocale);
  const currencyFormatter = new Intl.NumberFormat(numberLocale, {
    style: 'currency',
    currency: currencyCode,
    minimumFractionDigits: Math.min(2, Math.max(fiatDecimals, 0)),
    maximumFractionDigits: Math.max(fiatDecimals, 0),
  });
  const tokenFormatter = new Intl.NumberFormat(numberLocale, {
    minimumFractionDigits: tokenDecimals,
    maximumFractionDigits: tokenDecimals,
  });
  const baseCurrencyFormatter = new Intl.NumberFormat(baseCurrencyLocale, {
    style: 'currency',
    currency: baseCurrency,
    minimumFractionDigits: 2,
    maximumFractionDigits: 2,
  });

  const safeFiatPerUsd = fiatPerUsd > 0 ? fiatPerUsd : 1;

  function getFiatPerToken() {
    return usdPerToken * safeFiatPerUsd;
  }

  function updateThemeLabel(theme) {
    if (themeLabel) {
      themeLabel.textContent = themeLabels[theme] || theme;
    }
  }

  function setTheme(theme) {
    const next = themes.includes(theme) ? theme : themes[0];
    docEl.setAttribute('data-theme', next);
    updateThemeLabel(next);
    document.cookie = `theme=${next}; path=/; max-age=${60 * 60 * 24 * 30}`;
    localStorage.setItem('theme', next);
  }

  if (themeToggle) {
    const storedTheme = localStorage.getItem('theme');
    if (storedTheme && themes.includes(storedTheme)) {
      setTheme(storedTheme);
    } else {
      updateThemeLabel(docEl.getAttribute('data-theme') || themes[0]);
    }

    themeToggle.addEventListener('click', () => {
      const current = docEl.getAttribute('data-theme') || themes[0];
      const currentIndex = themes.indexOf(current);
      const nextTheme = themes[(currentIndex + 1) % themes.length];
      setTheme(nextTheme);
    });
  }

  if (navToggle && nav && headerEl instanceof HTMLElement) {
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

  function renderAudience(key) {
    audienceButtons.forEach((btn) => {
      const isActive = btn.dataset.audience === key;
      btn.classList.toggle('selected', isActive);
      btn.setAttribute('aria-pressed', String(isActive));
    });

    if (!audiencePitchEl) return;
    const pitch = audiencePitches[key];
    if (!pitch) return;

    audiencePitchEl.innerHTML = `
      <div class="card-row">
        <div class="icon-bubble"><span class="icon ${pitch.icon}" aria-hidden="true"></span></div>
        <div>
          <div class="card-title">${pitch.title}</div>
          <p class="card-desc">${pitch.desc}</p>
        </div>
      </div>
    `;
  }

  audienceButtons.forEach((btn) => {
    btn.addEventListener('click', () => renderAudience(btn.dataset.audience || defaultAudience));
  });

  renderAudience(defaultAudience);

  if (languageToggle && languageMenu) {
    const closeMenu = () => {
      languageMenu.hidden = true;
      languageSwitcher?.classList.remove('open');
      languageToggle.setAttribute('aria-expanded', 'false');
    };

    const openMenu = () => {
      languageMenu.hidden = false;
      languageSwitcher?.classList.add('open');
      languageToggle.setAttribute('aria-expanded', 'true');
    };

    const toggleMenu = () => {
      if (languageMenu.hidden) {
        openMenu();
        const focusTarget = languageOptions.find((option) => !option.hasAttribute('aria-current')) || languageOptions[0];
        focusTarget?.focus();
      } else {
        closeMenu();
      }
    };

    languageToggle.addEventListener('click', (event) => {
      event.preventDefault();
      event.stopPropagation();
      toggleMenu();
    });

    languageOptions.forEach((option) => {
      if (option.getAttribute('aria-current') === 'true') {
        option.addEventListener('click', (event) => {
          event.preventDefault();
          closeMenu();
          languageToggle.focus();
        });
        return;
      }

      option.addEventListener('click', (event) => {
        event.preventDefault();
        const target = option.getAttribute('href');
        if (typeof target === 'string' && target !== '') {
          closeMenu();
          window.location.href = target;
        }
      });
    });

    document.addEventListener('click', (event) => {
      if (!languageSwitcher?.contains(event.target)) {
        closeMenu();
      }
    });

    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape') {
        if (!languageMenu.hidden) {
          closeMenu();
          languageToggle.focus();
        }
      }
      if ((event.key === 'ArrowDown' || event.key === 'ArrowUp') && !languageMenu.hidden) {
        if (languageOptions.length === 0) {
          return;
        }
        event.preventDefault();
        const currentIndex = languageOptions.indexOf(document.activeElement);
        const direction = event.key === 'ArrowDown' ? 1 : -1;
        let nextIndex = currentIndex + direction;
        if (nextIndex < 0) nextIndex = languageOptions.length - 1;
        if (nextIndex >= languageOptions.length) nextIndex = 0;
        languageOptions[nextIndex]?.focus();
      }
    });
  }

  const people = document.getElementById('people');
  const apd = document.getElementById('apd');
  const peopleVal = document.getElementById('peopleVal');
  const apdVal = document.getElementById('apdVal');
  const opsMonthly = document.getElementById('opsMonthly');
  const nerpTotal = document.getElementById('nerpTotal');
  const fiatApprox = document.getElementById('fiatApprox');
  const tokenInput = document.querySelector('[data-token-input]');
  const tokenPreviewValue = document.querySelector('[data-token-preview-value]');
  const operationFiatNodes = document.querySelectorAll('[data-operation-fiat]');

  function estimate(peopleCount, actionsPerDay) {
    const monthlyActions = actionsPerDay * 30 * Math.max(peopleCount, 1);
    const nerpSpend = monthlyActions * microFee;
    return { monthlyActions, nerpSpend };
  }

  function updateTokenDerived() {
    const fiatPerToken = getFiatPerToken();

    if (tokenPreviewValue instanceof HTMLElement) {
      tokenPreviewValue.textContent = baseCurrencyFormatter.format(usdPerToken);
    }

    operationFiatNodes.forEach((node) => {
      if (!(node instanceof HTMLElement)) return;
      const prefix = node.dataset.prefix || '≈';
      const cost = Number.parseFloat(node.dataset.operationFiat || '0');
      if (!Number.isFinite(cost) || cost <= 0) {
        node.textContent = `${prefix} —`;
        return;
      }
      const fiatValue = cost * fiatPerToken;
      node.textContent = `${prefix} ${currencyFormatter.format(fiatValue)}`;
    });
  }

  function updateCalc() {
    if (!(people && apd && peopleVal && apdVal && opsMonthly && nerpTotal && fiatApprox)) {
      return;
    }

    const p = Number.parseInt(people.value, 10) || 0;
    const a = Number.parseInt(apd.value, 10) || 0;
    peopleVal.textContent = p.toString();
    apdVal.textContent = a.toString();
    const result = estimate(p, a);
    opsMonthly.textContent = numberFormatter.format(result.monthlyActions);
    nerpTotal.textContent = tokenFormatter.format(result.nerpSpend);
    const fiatValue = result.nerpSpend * getFiatPerToken();
    fiatApprox.textContent = currencyFormatter.format(fiatValue);
    updateTokenDerived();
  }

  people?.addEventListener('input', updateCalc);
  apd?.addEventListener('input', updateCalc);
  if (tokenInput instanceof HTMLInputElement) {
    const parseFiatValue = () => {
      const raw = tokenInput.value.replace(',', '.');
      const next = Number.parseFloat(raw);
      if (!Number.isFinite(next) || next <= 0) {
        return null;
      }
      return next;
    };

    const applyFiatValue = (value) => {
      if (!Number.isFinite(value) || value <= 0) {
        return;
      }
      usdPerToken = value / safeFiatPerUsd;
      updateCalc();
    };

    tokenInput.addEventListener('input', () => {
      const next = parseFiatValue();
      if (next !== null) {
        applyFiatValue(next);
      }
    });

    tokenInput.addEventListener('change', () => {
      const next = parseFiatValue();
      if (next !== null) {
        applyFiatValue(next);
        tokenInput.value = next.toFixed(fiatDecimals);
      } else {
        tokenInput.value = getFiatPerToken().toFixed(fiatDecimals);
      }
    });

    tokenInput.value = getFiatPerToken().toFixed(fiatDecimals);
  }
  updateCalc();

  document.querySelectorAll('.faq-item').forEach((item) => {
    const trigger = item.querySelector('.faq-q');
    const answer = item.querySelector('.faq-a');
    if (!(trigger instanceof HTMLElement) || !(answer instanceof HTMLElement)) return;

    answer.style.height = '0px';

    trigger.addEventListener('click', () => {
      const isOpen = item.classList.contains('open');
      if (isOpen) {
        const currentHeight = answer.scrollHeight;
        if (currentHeight) {
          answer.style.height = `${currentHeight}px`;
          void answer.offsetHeight;
        }
        answer.style.height = '0px';
        item.classList.remove('open');
      } else {
        item.classList.add('open');
        const targetHeight = answer.scrollHeight;
        answer.style.height = `${targetHeight}px`;
      }
    });

    answer.addEventListener('transitionend', (event) => {
      if (event.propertyName !== 'height') return;
      if (item.classList.contains('open')) {
        answer.style.height = 'auto';
      } else {
        answer.style.height = '0px';
      }
    });
  });

  function focusPilotForm() {
    if (!pilotForm) return;
    const firstField = pilotForm.querySelector('input, textarea');
    if (firstField instanceof HTMLElement) {
      setTimeout(() => {
        try {
          firstField.focus({ preventScroll: true });
        } catch (error) {
          firstField.focus();
        }
      }, 300);
    }
  }

  function scrollToPilots(event) {
    if (!pilotForm) return;
    if (event) {
      event.preventDefault();
    }
    pilotForm.scrollIntoView({ behavior: 'smooth', block: 'start' });
    focusPilotForm();
  }

  document.querySelectorAll('[data-scroll-to-pilots]').forEach((el) => {
    el.addEventListener('click', scrollToPilots);
  });

  if (floatingCtaButton) {
    floatingCtaButton.addEventListener('click', scrollToPilots);
  }

  if (floatingCta) {
    const toggleFloating = () => {
      const threshold = 400;
      if (window.scrollY > threshold) {
        floatingCta.classList.add('is-visible');
      } else {
        floatingCta.classList.remove('is-visible');
      }
    };

    toggleFloating();
    window.addEventListener('scroll', toggleFloating, { passive: true });
  }

  if (pilotForm) {
    const successMessage = pilotForm.querySelector('[data-pilot-success]');
    const errorMessage = pilotForm.querySelector('[data-pilot-error]');
    const submitButton = pilotForm.querySelector('button[type="submit"]');
    let fallbackSubmission = false;

    pilotForm.addEventListener('submit', async (event) => {
      if (fallbackSubmission) {
        fallbackSubmission = false;
        return;
      }

      event.preventDefault();

      if (successMessage) successMessage.hidden = true;
      if (errorMessage) errorMessage.hidden = true;
      if (submitButton) submitButton.disabled = true;

      const formData = new FormData(pilotForm);
      const payload = {};
      formData.forEach((value, key) => {
        payload[key] = typeof value === 'string' ? value : String(value);
      });

      const action = pilotForm.getAttribute('action') || '';
      const method = (pilotForm.getAttribute('method') || 'POST').toUpperCase();

      try {
        if (!action || action === '#') {
          pilotForm.reset();
          if (successMessage) successMessage.hidden = false;
          return;
        }

        const response = await fetch(action, {
          method,
          headers: {
            Accept: 'application/json',
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(payload),
          credentials: 'omit',
        });

        if (!response.ok) {
          throw new Error('Request failed');
        }

        pilotForm.reset();
        if (successMessage) successMessage.hidden = false;
      } catch (error) {
        if (action && action !== '#') {
          fallbackSubmission = true;
          if (submitButton) submitButton.disabled = false;
          pilotForm.submit();
          return;
        }

        if (errorMessage) errorMessage.hidden = false;
      } finally {
        if (submitButton) submitButton.disabled = false;
      }
    });
  }
});
