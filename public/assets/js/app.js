const config = window.__APP_CONFIG__ || {};
const docEl = document.documentElement;
const defaultAudience = config.defaultAudience || 'business';
const audiencePitches = config.audiencePitches || {};
const numberLocale = config.numberLocale || 'en-US';
const currencyCode = config.currency || 'USD';
const currencySymbol = typeof config.currencySymbol === 'string' ? config.currencySymbol : '$';
const themeLabels = config.themeLabels || {};
const themes = config.themes || ['light', 'dark'];
const microFee = typeof config.microFee === 'number' ? config.microFee : 0.001;
let tokenPrice = typeof config.tokenPrice === 'number' && config.tokenPrice > 0 ? config.tokenPrice : 1;

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
  const tokenPriceInput = document.getElementById('tokenPrice');
  const tokenConditionEl = document.querySelector('[data-token-condition]');
  const operationItems = document.querySelectorAll('[data-operation]');

  const numberFormatter = new Intl.NumberFormat(numberLocale);
  const tokenAmountFormatter = new Intl.NumberFormat(numberLocale, {
    minimumFractionDigits: 6,
    maximumFractionDigits: 6,
  });
  const currencyFormatter = new Intl.NumberFormat(numberLocale, {
    style: 'currency',
    currency: currencyCode,
    minimumFractionDigits: 2,
    maximumFractionDigits: 6,
  });
  const tokenFormatter = new Intl.NumberFormat(numberLocale, {
    minimumFractionDigits: 6,
    maximumFractionDigits: 6,
  });

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

  function estimate(peopleCount, actionsPerDay) {
    const monthlyActions = actionsPerDay * 30 * Math.max(peopleCount, 1);
    const nerpSpend = monthlyActions * microFee;
    const fiat = nerpSpend * tokenPrice;
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
    opsMonthly.textContent = numberFormatter.format(result.monthlyActions);
    nerpTotal.textContent = tokenAmountFormatter.format(result.nerpSpend);
    fiatApprox.textContent = currencyFormatter.format(result.fiat);
  }

  function updateTokenCondition() {
    if (!tokenConditionEl) return;
    const pattern = tokenConditionEl.dataset.tokenPattern || '';
    const tokensPerCurrency = tokenPrice > 0 ? 1 / tokenPrice : 0;
    const formattedTokens = tokenFormatter.format(tokensPerCurrency);
    if (pattern.includes(':currency') || pattern.includes(':tokens')) {
      tokenConditionEl.textContent = pattern
        .replaceAll(':currency', currencySymbol)
        .replaceAll(':tokens', formattedTokens);
    } else {
      tokenConditionEl.textContent = `${currencySymbol} → ${formattedTokens}`;
    }
  }

  function updateOperations() {
    if (!operationItems.length) return;
    operationItems.forEach((item) => {
      const tokenAmount = Number.parseFloat(item.dataset.operationTokens || '0') || 0;
      const fiatValue = tokenAmount * tokenPrice;
      const currencyEl = item.querySelector('[data-operation-currency]');
      if (currencyEl) {
        currencyEl.textContent = `≈ ${currencyFormatter.format(fiatValue)}`;
      }
    });
  }

  people?.addEventListener('input', updateCalc);
  apd?.addEventListener('input', updateCalc);
  updateCalc();
  updateTokenCondition();
  updateOperations();

  const handleTokenChange = () => {
    if (!tokenPriceInput) return;
    const parsed = Number.parseFloat(tokenPriceInput.value);
    if (!Number.isFinite(parsed) || parsed <= 0) {
      return;
    }
    tokenPrice = parsed;
    updateTokenCondition();
    updateOperations();
    updateCalc();
  };

  tokenPriceInput?.addEventListener('input', handleTokenChange);
  tokenPriceInput?.addEventListener('change', handleTokenChange);

  document.querySelectorAll('.faq-item').forEach((item) => {
    const trigger = item.querySelector('.faq-q');
    const answer = item.querySelector('.faq-a');
    if (!(trigger instanceof HTMLElement) || !(answer instanceof HTMLElement)) {
      return;
    }

    if (!item.classList.contains('open')) {
      answer.style.maxHeight = '0px';
    }
    trigger.setAttribute('aria-expanded', item.classList.contains('open') ? 'true' : 'false');
    answer.setAttribute('aria-hidden', item.classList.contains('open') ? 'false' : 'true');

    const collapse = () => {
      item.classList.remove('open');
      trigger.setAttribute('aria-expanded', 'false');
      answer.setAttribute('aria-hidden', 'true');
      answer.style.maxHeight = `${answer.scrollHeight}px`;
      requestAnimationFrame(() => {
        answer.style.maxHeight = '0px';
      });
    };

    const expand = () => {
      item.classList.add('open');
      trigger.setAttribute('aria-expanded', 'true');
      answer.setAttribute('aria-hidden', 'false');
      answer.style.maxHeight = `${answer.scrollHeight}px`;
      const handleTransitionEnd = () => {
        if (item.classList.contains('open')) {
          answer.style.maxHeight = 'none';
        }
        answer.removeEventListener('transitionend', handleTransitionEnd);
      };
      answer.addEventListener('transitionend', handleTransitionEnd);
    };

    trigger.addEventListener('click', () => {
      const isOpen = item.classList.contains('open');
      if (answer.style.maxHeight === 'none') {
        answer.style.maxHeight = `${answer.scrollHeight}px`;
      }
      if (isOpen) {
        collapse();
      } else {
        expand();
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
