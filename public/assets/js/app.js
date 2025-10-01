const config = window.__APP_CONFIG__ || {};
const docEl = document.documentElement;
const defaultAudience = config.defaultAudience || 'business';
const audiencePitches = config.audiencePitches || {};
const numberLocale = config.numberLocale || 'en-US';
const currencyCode = config.currency || 'USD';
const themeLabels = config.themeLabels || {};
const themes = config.themes || ['light', 'dark'];
const microFee = typeof config.microFee === 'number' ? config.microFee : 0.001;
const fiatPerUsd = typeof config.fiatPerUsd === 'number' ? config.fiatPerUsd : 1;
const tokenDecimals = Number.isInteger(config.tokenDecimals) ? config.tokenDecimals : 6;
const usdPerTokenOptions = Array.isArray(config.usdPerTokenOptions)
  ? config.usdPerTokenOptions
      .map((value) => Number.parseFloat(value))
      .filter((value) => Number.isFinite(value) && value > 0)
  : [];
const defaultUsdPerToken = (() => {
  const value = Number.parseFloat(config.usdPerTokenDefault);
  if (Number.isFinite(value) && value > 0) {
    return value;
  }
  if (usdPerTokenOptions.length > 0) {
    return usdPerTokenOptions[0];
  }
  return 1;
})();
let usdPerToken = defaultUsdPerToken;
let tokensPerUsd = usdPerToken > 0 ? 1 / usdPerToken : 1;

if (!localStorage.getItem('prefersDarkSet')) {
  const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
  document.cookie = `prefersDark=${prefersDark}; path=/; max-age=${60 * 60 * 24 * 30}`;
  localStorage.setItem('prefersDarkSet', '1');
}

document.addEventListener('DOMContentLoaded', () => {
  docEl.classList.remove('no-js');

  const audienceButtons = document.querySelectorAll('[data-audience]');
  const audiencePitchEl = document.querySelector('[data-audience-pitch]');
  const languageSwitchers = document.querySelectorAll('[data-language-switcher]');
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
    maximumFractionDigits: 2,
  });
  const tokenFormatter = new Intl.NumberFormat(numberLocale, {
    minimumFractionDigits: tokenDecimals,
    maximumFractionDigits: tokenDecimals,
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

  if (languageSwitchers.length > 0) {
    const switcherNodes = Array.from(languageSwitchers).filter((node) => node instanceof HTMLElement);

    const closeAllLanguageMenus = (except = null) => {
      switcherNodes.forEach((switcher) => {
        if (switcher === except) return;
        switcher.classList.remove('open');
        const triggerEl = switcher.querySelector('[data-language-trigger]');
        if (triggerEl instanceof HTMLElement) {
          triggerEl.setAttribute('aria-expanded', 'false');
        }
      });
    };

    switcherNodes.forEach((switcher) => {
      const trigger = switcher.querySelector('[data-language-trigger]');
      const menu = switcher.querySelector('[data-language-menu]');
      if (!(trigger instanceof HTMLElement) || !(menu instanceof HTMLElement)) {
        return;
      }

      const options = menu.querySelectorAll('[data-language-option]');
      if (options.length === 0) {
        trigger.setAttribute('aria-disabled', 'true');
        trigger.setAttribute('tabindex', '-1');
        trigger.classList.add('is-disabled');
        return;
      }

      const closeMenu = () => {
        switcher.classList.remove('open');
        trigger.setAttribute('aria-expanded', 'false');
      };

      const openMenu = ({ focusFirst = false } = {}) => {
        closeAllLanguageMenus(switcher);
        switcher.classList.add('open');
        trigger.setAttribute('aria-expanded', 'true');
        if (focusFirst) {
          const firstOption = menu.querySelector('[data-language-option]');
          if (firstOption instanceof HTMLElement) {
            firstOption.focus();
          }
        }
      };

      const toggleMenu = () => {
        if (switcher.classList.contains('open')) {
          closeMenu();
        } else {
          openMenu({ focusFirst: true });
        }
      };

      trigger.addEventListener('click', (event) => {
        event.preventDefault();
        toggleMenu();
      });

      trigger.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
          closeMenu();
          trigger.blur();
        } else if (event.key === 'ArrowDown') {
          event.preventDefault();
          openMenu({ focusFirst: true });
        }
      });

      menu.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
          event.preventDefault();
          closeMenu();
          trigger.focus();
        }
      });

      options.forEach((option) => {
        option.addEventListener('click', () => {
          closeAllLanguageMenus();
        });
      });
    });

    document.addEventListener('click', (event) => {
      const target = event.target;
      if (!(target instanceof Node)) return;
      const inside = switcherNodes.some((switcher) => switcher.contains(target));
      if (!inside) {
        closeAllLanguageMenus();
      }
    });

    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape') {
        closeAllLanguageMenus();
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
  const tokenOptionButtons = document.querySelectorAll('[data-token-option]');
  const tokenPreviewValue = document.querySelector('[data-token-preview-value]');
  const operationFiatNodes = document.querySelectorAll('[data-operation-fiat]');

  const initialActiveTokenButton = Array.from(tokenOptionButtons).find((btn) => btn.classList.contains('active'));
  if (initialActiveTokenButton instanceof HTMLElement) {
    const initialValue = Number.parseFloat(initialActiveTokenButton.dataset.tokenOption || '0');
    if (Number.isFinite(initialValue) && initialValue > 0) {
      usdPerToken = initialValue;
      tokensPerUsd = 1 / usdPerToken;
    }
  }

  function updateTokenButtons() {
    tokenOptionButtons.forEach((button) => {
      if (!(button instanceof HTMLElement)) return;
      const value = Number.parseFloat(button.dataset.tokenOption || '0');
      const isActive = Number.isFinite(value) && Math.abs(value - usdPerToken) < 0.00001;
      button.classList.toggle('active', isActive);
      button.setAttribute('aria-pressed', String(isActive));
    });
  }

  function estimate(peopleCount, actionsPerDay) {
    const monthlyActions = actionsPerDay * 30 * Math.max(peopleCount, 1);
    const nerpSpend = monthlyActions * microFee;
    return { monthlyActions, nerpSpend };
  }

  function updateTokenDerived() {
    if (tokenPreviewValue instanceof HTMLElement) {
      const tokenValue = tokensPerUsd > 0 ? fiatPerUsd / tokensPerUsd : 0;
      tokenPreviewValue.textContent = currencyFormatter.format(tokenValue);
    }

    operationFiatNodes.forEach((node) => {
      if (!(node instanceof HTMLElement)) return;
      const prefix = node.dataset.prefix || '≈';
      const cost = Number.parseFloat(node.dataset.operationFiat || '0');
      if (!Number.isFinite(cost) || cost <= 0 || tokensPerUsd <= 0) {
        node.textContent = `${prefix} —`;
        return;
      }
      const fiatValue = (cost / tokensPerUsd) * fiatPerUsd;
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
    const fiatValue = tokensPerUsd > 0 ? (result.nerpSpend / tokensPerUsd) * fiatPerUsd : 0;
    fiatApprox.textContent = currencyFormatter.format(fiatValue);
    updateTokenDerived();
  }

  people?.addEventListener('input', updateCalc);
  apd?.addEventListener('input', updateCalc);
  tokenOptionButtons.forEach((button) => {
    if (!(button instanceof HTMLElement)) return;
    button.addEventListener('click', () => {
      const value = Number.parseFloat(button.dataset.tokenOption || '0');
      if (!Number.isFinite(value) || value <= 0) {
        return;
      }
      usdPerToken = value;
      tokensPerUsd = 1 / usdPerToken;
      updateTokenButtons();
      updateCalc();
    });
  });

  updateTokenButtons();
  updateCalc();

  document.querySelectorAll('.faq-item').forEach((item) => {
    const trigger = item.querySelector('.faq-q');
    const answer = item.querySelector('.faq-a');
    if (!(trigger instanceof HTMLElement) || !(answer instanceof HTMLElement)) return;

    answer.style.height = '0px';

    const openFaq = () => {
      answer.style.height = 'auto';
      const targetHeight = answer.scrollHeight;
      answer.style.height = '0px';
      requestAnimationFrame(() => {
        item.classList.add('open');
        answer.style.height = `${targetHeight}px`;
      });
    };

    const closeFaq = () => {
      const currentHeight = answer.scrollHeight;
      answer.style.height = `${currentHeight}px`;
      requestAnimationFrame(() => {
        answer.style.height = '0px';
        item.classList.remove('open');
      });
    };

    trigger.addEventListener('click', () => {
      const isOpen = item.classList.contains('open');
      if (isOpen) {
        closeFaq();
      } else {
        openFaq();
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
