const config = window.__APP_CONFIG__ || {};
const docEl = document.documentElement;
const defaultAudience = config.defaultAudience || 'business';
const audiencePitches = config.audiencePitches || {};
const numberLocale = config.numberLocale || 'en-US';
const currencyCode = config.currency || 'USD';
const themes = config.themes || ['light', 'dark'];
const themeLabels = config.themeLabels || {};
const microFee = typeof config.microFee === 'number' ? config.microFee : 0.001;
const fiatPerUsd = typeof config.fiatPerUsd === 'number' ? config.fiatPerUsd : 1;
const tokenDecimals = Number.isInteger(config.tokenDecimals) ? config.tokenDecimals : 6;
const priceDecimals = Number.isInteger(config.tokenPriceDecimals) ? config.tokenPriceDecimals : 2;
const toNumberOr = (value, fallback) => {
  const parsed = Number.parseFloat(value);
  return Number.isFinite(parsed) ? parsed : fallback;
};

const tokenPriceMinUsd = (() => {
  const value = toNumberOr(config.tokenPriceMinUsd, 0.1);
  if (value > 0) {
    return value;
  }
  return 0.1;
})();

const tokenPriceMaxUsd = (() => {
  const value = toNumberOr(config.tokenPriceMaxUsd, 2);
  if (value >= tokenPriceMinUsd) {
    return value;
  }
  return Math.max(tokenPriceMinUsd, 2);
})();

const tokenPriceStepUsd = (() => {
  const value = toNumberOr(config.tokenPriceStepUsd, 0.1);
  if (value > 0) {
    return value;
  }
  return 0.1;
})();

const defaultTokenPriceUsd = (() => {
  const value = toNumberOr(config.tokenPriceUsd, 1);
  if (value > 0) {
    return value;
  }
  return 1;
})();

const clampTokenPrice = (value) => {
  const safe = Number.isFinite(value) ? value : tokenPriceMinUsd;
  const limited = Math.min(Math.max(safe, tokenPriceMinUsd), tokenPriceMaxUsd);
  const step = tokenPriceStepUsd > 0 ? tokenPriceStepUsd : 0.1;
  const stepsFromMin = Math.round((limited - tokenPriceMinUsd) / step);
  const snapped = tokenPriceMinUsd + stepsFromMin * step;
  return Number.parseFloat(snapped.toFixed(6));
};

let tokenPriceUsd = clampTokenPrice(defaultTokenPriceUsd);

if (!localStorage.getItem('prefersDarkSet')) {
  const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
  document.cookie = `prefersDark=${prefersDark}; path=/; max-age=${60 * 60 * 24 * 30}`;
  localStorage.setItem('prefersDarkSet', '1');
}

document.addEventListener('DOMContentLoaded', () => {
  docEl.classList.remove('no-js');

  const audienceButtons = document.querySelectorAll('[data-audience]');
  const audiencePitchEl = document.querySelector('[data-audience-pitch]');
  const languageButton = document.querySelector('[data-language-button]');
  const languageIconTarget = document.querySelector('[data-language-icon]');
  const themeToggle = document.querySelector('[data-theme-toggle]');
  const themeIcon = document.querySelector('[data-theme-icon]');
  const navToggle = document.querySelector('[data-nav-toggle]');
  const nav = document.querySelector('[data-nav]');
  const headerEl = document.querySelector('[data-header]');
  const floatingCtaButton = document.querySelector('[data-floating-cta]');
  const floatingCta = floatingCtaButton?.parentElement ?? null;
  const pilotForm = document.querySelector('[data-pilot-form]');
  const pilotDisplay = document.querySelector('[data-pilot-display]');
  const pilotQuote = pilotDisplay?.querySelector('[data-pilot-quote]') ?? null;
  const pilotCompany = pilotDisplay?.querySelector('[data-pilot-company]') ?? null;
  const pilotRole = pilotDisplay?.querySelector('[data-pilot-role]') ?? null;
  const pilotMetric = pilotDisplay?.querySelector('[data-pilot-metric]') ?? null;
  const pilotTriggers = document.querySelectorAll('[data-pilot-trigger]');

  const numberFormatter = new Intl.NumberFormat(numberLocale);
  const currencyFormatter = new Intl.NumberFormat(numberLocale, {
    style: 'currency',
    currency: currencyCode,
    maximumFractionDigits: 2,
  });
  const tokenFormatter = new Intl.NumberFormat(numberLocale, {
    minimumFractionDigits: tokenDecimals,
    maximumFractionDigits: tokenDecimals,
  });

  function renderThemeState(theme) {
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
  }

  function setTheme(theme) {
    const next = themes.includes(theme) ? theme : themes[0];
    docEl.setAttribute('data-theme', next);
    document.cookie = `theme=${next}; path=/; max-age=${60 * 60 * 24 * 30}`;
    localStorage.setItem('theme', next);
    renderThemeState(next);
  }

  if (themeToggle) {
    const storedTheme = localStorage.getItem('theme');
    if (storedTheme && themes.includes(storedTheme)) {
      setTheme(storedTheme);
    }

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

  renderThemeState(docEl.getAttribute('data-theme') || themes[0]);

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

  if (languageButton instanceof HTMLButtonElement && languageIconTarget instanceof HTMLElement) {
    const baseLabel = languageButton.getAttribute('data-label') || '';
    const rawCycle = languageButton.getAttribute('data-locale-cycle') || '[]';
    let localeCycle = [];
    try {
      const parsed = JSON.parse(rawCycle);
      if (Array.isArray(parsed)) {
        localeCycle = parsed
          .map((entry) => ({
            code: typeof entry.code === 'string' ? entry.code : '',
            href: typeof entry.href === 'string' ? entry.href : '',
            label: typeof entry.label === 'string' ? entry.label : '',
          }))
          .filter((entry) => entry.code);
      }
    } catch (error) {
      localeCycle = [];
    }

    let currentLocale = languageButton.getAttribute('data-current-locale') || (localeCycle[0]?.code || '');

    const iconForLocale = (locale) => {
      const value = (locale || '').toLowerCase();
      if (value.startsWith('ru')) return 'flag-ru';
      if (value.startsWith('en')) return 'flag-en';
      return 'globe';
    };

    const applyLocaleState = () => {
      languageIconTarget.className = `icon ${iconForLocale(currentLocale)}`;
      const match = localeCycle.find((entry) => entry.code === currentLocale);
      const label = match?.label || (currentLocale ? currentLocale.toUpperCase() : baseLabel || 'Language');
      if (baseLabel) {
        const composed = `${baseLabel}: ${label}`;
        languageButton.setAttribute('aria-label', composed);
        languageButton.setAttribute('title', composed);
      } else {
        languageButton.setAttribute('aria-label', label);
        languageButton.setAttribute('title', label);
      }
    };

    applyLocaleState();

    if (localeCycle.length <= 1) {
      languageButton.disabled = true;
      languageButton.setAttribute('aria-disabled', 'true');
    } else {
      languageButton.addEventListener('click', (event) => {
        event.preventDefault();
        const currentIndex = localeCycle.findIndex((entry) => entry.code === currentLocale);
        const nextEntry = localeCycle[(currentIndex + 1) % localeCycle.length];
        if (!nextEntry) {
          return;
        }
        currentLocale = nextEntry.code;
        applyLocaleState();
        setTimeout(() => {
          if (nextEntry.href) {
            window.location.href = nextEntry.href;
          }
        }, 160);
      });
    }
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
  const tokenPresetButtons = document.querySelectorAll('[data-token-preset]');
  const tokenSlider = document.querySelector('[data-token-slider]');
  const tokenSliderMarks = document.querySelectorAll('[data-token-slider-mark]');

  const parseLocaleNumber = (value) => {
    if (typeof value !== 'string') return Number.NaN;
    const sanitized = value.replace(/\s+/g, '').replace(/,/g, '.');
    return Number.parseFloat(sanitized);
  };

  const getLocalTokenPrice = () => tokenPriceUsd * fiatPerUsd;

  function estimate(peopleCount, actionsPerDay) {
    const monthlyActions = actionsPerDay * 30 * Math.max(peopleCount, 1);
    const nerpSpend = monthlyActions * microFee;
    return { monthlyActions, nerpSpend };
  }

  function updateTokenDerived() {
    const localTokenPrice = getLocalTokenPrice();

    if (tokenPreviewValue instanceof HTMLElement) {
      tokenPreviewValue.textContent = currencyFormatter.format(localTokenPrice);
    }

    operationFiatNodes.forEach((node) => {
      if (!(node instanceof HTMLElement)) return;
      const prefix = node.dataset.prefix || '≈';
      const cost = Number.parseFloat(node.dataset.operationFiat || '0');
      if (!Number.isFinite(cost) || cost <= 0 || !Number.isFinite(localTokenPrice) || localTokenPrice <= 0) {
        node.textContent = `${prefix} —`;
        return;
      }
      const fiatValue = cost * localTokenPrice;
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
    const fiatValue = tokenPriceUsd > 0 ? result.nerpSpend * tokenPriceUsd * fiatPerUsd : 0;
    fiatApprox.textContent = currencyFormatter.format(fiatValue);
    updateTokenDerived();
  }

  people?.addEventListener('input', updateCalc);
  apd?.addEventListener('input', updateCalc);
  const updatePresetState = () => {
    tokenPresetButtons.forEach((button) => {
      if (!(button instanceof HTMLElement)) return;
      const preset = Number.parseFloat(button.dataset.tokenPreset || '0');
      const isActive = Number.isFinite(preset) && Math.abs(preset - tokenPriceUsd) < 1e-6;
      button.classList.toggle('active', isActive);
      button.setAttribute('aria-pressed', String(isActive));
    });

    tokenSliderMarks.forEach((mark) => {
      if (!(mark instanceof HTMLElement)) return;
      const preset = Number.parseFloat(mark.dataset.tokenSliderMark || '');
      const isActive = Number.isFinite(preset) && Math.abs(preset - tokenPriceUsd) < 1e-6;
      mark.classList.toggle('active', isActive);
    });
  };

  const applyTokenPriceUsd = (value) => {
    tokenPriceUsd = clampTokenPrice(value);
    if (tokenInput instanceof HTMLInputElement) {
      tokenInput.value = getLocalTokenPrice().toFixed(priceDecimals);
    }
    if (tokenSlider instanceof HTMLInputElement) {
      tokenSlider.value = tokenPriceUsd.toFixed(2);
    }
    updateCalc();
    updatePresetState();
  };

  if (tokenInput instanceof HTMLInputElement) {
    const commitTokenPrice = () => {
      const raw = parseLocaleNumber(tokenInput.value);
      if (!Number.isFinite(raw) || raw <= 0) {
        tokenInput.value = getLocalTokenPrice().toFixed(priceDecimals);
        updatePresetState();
        return;
      }
      const usdValue = fiatPerUsd > 0 ? raw / fiatPerUsd : raw;
      applyTokenPriceUsd(usdValue);
    };

    tokenInput.addEventListener('input', () => {
      const raw = parseLocaleNumber(tokenInput.value);
      if (!Number.isFinite(raw) || raw <= 0) {
        return;
      }
      const usdValue = fiatPerUsd > 0 ? raw / fiatPerUsd : raw;
      applyTokenPriceUsd(usdValue);
    });

    tokenInput.addEventListener('change', commitTokenPrice);
    tokenInput.addEventListener('blur', commitTokenPrice);
    tokenInput.addEventListener('keydown', (event) => {
      if (event.key === 'Enter') {
        event.preventDefault();
        commitTokenPrice();
      }
    });
    tokenInput.value = getLocalTokenPrice().toFixed(priceDecimals);
  }

  tokenPresetButtons.forEach((button) => {
    if (!(button instanceof HTMLElement)) return;
    button.addEventListener('click', () => {
      const preset = Number.parseFloat(button.dataset.tokenPreset || '0');
      if (!Number.isFinite(preset) || preset <= 0) {
        return;
      }
      applyTokenPriceUsd(preset);
    });
  });

  if (tokenSlider instanceof HTMLInputElement) {
    const sliderMin = Number.parseFloat(tokenSlider.min);
    if (Number.isFinite(sliderMin) && sliderMin > 0 && sliderMin > tokenPriceMinUsd) {
      tokenPriceUsd = clampTokenPrice(sliderMin);
    }
    tokenSlider.value = tokenPriceUsd.toFixed(2);
    tokenSlider.addEventListener('input', () => {
      const raw = Number.parseFloat(tokenSlider.value);
      if (!Number.isFinite(raw)) {
        return;
      }
      applyTokenPriceUsd(raw);
    });
  }

  updatePresetState();
  updateCalc();

  const pilotButtons = Array.from(pilotTriggers).filter((trigger) => trigger instanceof HTMLElement);

  const setPilotField = (target, value, { hideWhenEmpty = false, fallback = '' } = {}) => {
    if (!(target instanceof HTMLElement)) {
      return;
    }
    const text = typeof value === 'string' ? value.trim() : '';
    if (hideWhenEmpty) {
      if (!text) {
        target.textContent = '';
        target.setAttribute('hidden', 'true');
        return;
      }
      target.removeAttribute('hidden');
    }
    target.textContent = text || fallback;
  };

  const activatePilot = (trigger) => {
    if (!(trigger instanceof HTMLElement)) return;
    pilotButtons.forEach((btn) => {
      btn.classList.toggle('active', btn === trigger);
    });
    if (pilotDisplay instanceof HTMLElement) {
      pilotDisplay.setAttribute('data-active-pilot', trigger.dataset.pilotId || '');
    }
    setPilotField(pilotQuote, trigger.dataset.pilotQuote || '', { fallback: '—' });
    setPilotField(pilotCompany, trigger.dataset.pilotCompany || '', { fallback: '—' });
    setPilotField(pilotRole, trigger.dataset.pilotRole || '', { hideWhenEmpty: true });
    setPilotField(pilotMetric, trigger.dataset.pilotMetric || '', { hideWhenEmpty: true });
  };

  pilotButtons.forEach((button) => {
    button.addEventListener('click', () => {
      activatePilot(button);
    });
  });

  if (pilotButtons.length > 0) {
    const initial = pilotButtons.find((btn) => btn.classList.contains('active')) || pilotButtons[0];
    activatePilot(initial);
  }

  document.querySelectorAll('[data-faq-item]').forEach((item) => {
    if (!(item instanceof HTMLElement)) return;
    const trigger = item.querySelector('[data-faq-question]');
    const answer = item.querySelector('[data-faq-answer]');
    const iconNode = item.querySelector('.faq-toggle-icon .icon');
    if (!(trigger instanceof HTMLElement) || !(answer instanceof HTMLElement)) return;

    const setState = (open) => {
      item.classList.toggle('open', open);
      trigger.setAttribute('aria-expanded', String(open));
      answer.hidden = !open;
      if (iconNode instanceof HTMLElement) {
        iconNode.classList.remove('plus', 'minus');
        iconNode.classList.add(open ? 'minus' : 'plus');
      }
    };

    setState(trigger.getAttribute('aria-expanded') === 'true');

    trigger.addEventListener('click', () => {
      const isOpen = item.classList.contains('open');
      setState(!isOpen);
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
