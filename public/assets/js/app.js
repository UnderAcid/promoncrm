const config = window.__APP_CONFIG__ || {};
const docEl = document.documentElement;
const defaultAudience = config.defaultAudience || 'business';
const audiencePitches = config.audiencePitches || {};
const numberLocale = config.numberLocale || 'en-US';
const currencyCode = config.currencyCode || 'USD';
const themeLabels = config.themeLabels || {};
const themes = config.themes || ['light', 'dark'];
const microFee = typeof config.microFee === 'number' ? config.microFee : 0.001;
const defaultTokensPerCurrency =
  typeof config.tokensPerCurrency === 'number' && config.tokensPerCurrency > 0
    ? config.tokensPerCurrency
    : 1;

if (!localStorage.getItem('prefersDarkSet')) {
  const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
  document.cookie = `prefersDark=${prefersDark}; path=/; max-age=${60 * 60 * 24 * 30}`;
  localStorage.setItem('prefersDarkSet', '1');
}

document.addEventListener('DOMContentLoaded', () => {
  docEl.classList.remove('no-js');

  const audienceButtons = document.querySelectorAll('[data-audience]');
  const audiencePitchEl = document.querySelector('[data-audience-pitch]');
  const languageSelect = document.querySelector('[data-language-select]');
  const themeToggle = document.querySelector('[data-theme-toggle]');
  const themeLabel = themeToggle?.querySelector('[data-theme-label]');
  const navToggle = document.querySelector('[data-nav-toggle]');
  const nav = document.querySelector('[data-nav]');
  const headerEl = document.querySelector('[data-header]');
  const floatingCtaButton = document.querySelector('[data-floating-cta]');
  const floatingCta = floatingCtaButton?.parentElement ?? null;
  const pilotForm = document.querySelector('[data-pilot-form]');
  const tokenInput = document.querySelector('[data-token-input]');
  const tokenDisplay = document.querySelector('[data-token-display]');

  const integerFormatter = new Intl.NumberFormat(numberLocale);
  const tokenFormatter = new Intl.NumberFormat(numberLocale, {
    minimumFractionDigits: 6,
    maximumFractionDigits: 6,
  });
  const currencyFormatter = new Intl.NumberFormat(numberLocale, {
    style: 'currency',
    currency: currencyCode,
    minimumFractionDigits: 2,
    maximumFractionDigits: 2,
  });

  let currentTokensPerCurrency = defaultTokensPerCurrency;

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

  if (languageSelect) {
    languageSelect.addEventListener('change', () => {
      const target = languageSelect.value;
      if (typeof target === 'string' && target !== '') {
        window.location.href = target;
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

  function updateTokenMeta(value) {
    if (!tokenDisplay) return;
    const normalized = Number.isFinite(value) && value > 0 ? value : defaultTokensPerCurrency;
    tokenDisplay.textContent = normalized.toFixed(6);
  }

  function estimate(peopleCount, actionsPerDay) {
    const monthlyActions = actionsPerDay * 30 * Math.max(peopleCount, 1);
    const nerpSpend = monthlyActions * microFee;
    const fiat = currentTokensPerCurrency > 0 ? nerpSpend / currentTokensPerCurrency : 0;
    return { monthlyActions, nerpSpend, fiat };
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
    opsMonthly.textContent = integerFormatter.format(result.monthlyActions);
    nerpTotal.textContent = tokenFormatter.format(result.nerpSpend);
    fiatApprox.textContent = currencyFormatter.format(result.fiat);
  }

  people?.addEventListener('input', updateCalc);
  apd?.addEventListener('input', updateCalc);
  updateCalc();

  if (tokenInput) {
    const clampTokenValue = (value) => {
      const numeric = Number.parseFloat(String(value).replace(',', '.'));
      if (!Number.isFinite(numeric) || numeric <= 0) {
        return defaultTokensPerCurrency;
      }
      return numeric;
    };

    const commitTokenValue = (value) => {
      currentTokensPerCurrency = clampTokenValue(value);
      tokenInput.value = currentTokensPerCurrency.toFixed(6);
      updateTokenMeta(currentTokensPerCurrency);
      updateCalc();
    };

    tokenInput.addEventListener('input', () => {
      const numeric = Number.parseFloat(String(tokenInput.value).replace(',', '.'));
      if (!Number.isFinite(numeric) || numeric <= 0) {
        updateTokenMeta(currentTokensPerCurrency);
        return;
      }
      currentTokensPerCurrency = numeric;
      updateTokenMeta(numeric);
      updateCalc();
    });

    ['change', 'blur'].forEach((eventName) => {
      tokenInput.addEventListener(eventName, () => {
        commitTokenValue(tokenInput.value);
      });
    });

    tokenInput.setAttribute('inputmode', 'decimal');
    tokenInput.value = currentTokensPerCurrency.toFixed(6);
    updateTokenMeta(currentTokensPerCurrency);
  } else {
    updateTokenMeta(currentTokensPerCurrency);
  }

  document.querySelectorAll('.faq-item').forEach((item) => {
    const trigger = item.querySelector('.faq-q');
    const answer = item.querySelector('.faq-a');
    if (!(trigger && answer)) return;
    let animating = false;

    const expand = () => {
      animating = true;
      answer.style.maxHeight = '0px';
      item.classList.add('open');
      requestAnimationFrame(() => {
        answer.style.maxHeight = `${answer.scrollHeight}px`;
      });
    };

    const collapse = () => {
      animating = true;
      const currentHeight = answer.scrollHeight;
      answer.style.maxHeight = `${currentHeight}px`;
      requestAnimationFrame(() => {
        item.classList.remove('open');
        answer.style.maxHeight = '0px';
      });
    };

    trigger.addEventListener('click', () => {
      if (animating) return;
      const isOpen = item.classList.contains('open');
      if (isOpen) {
        collapse();
      } else {
        expand();
      }
    });

    answer.addEventListener('transitionend', (event) => {
      if (event.propertyName !== 'max-height') return;
      animating = false;
      if (item.classList.contains('open')) {
        answer.style.maxHeight = 'none';
      } else {
        answer.style.maxHeight = '';
      }
    });

    window.addEventListener('resize', () => {
      if (!item.classList.contains('open')) return;
      answer.style.maxHeight = 'none';
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
