const config = window.__APP_CONFIG__ || {};
const docEl = document.documentElement;
const defaultAudience = config.defaultAudience || 'business';
const audiencePitches = config.audiencePitches || {};
const numberLocale = config.numberLocale || 'en-US';
const currencyCode = config.currency || 'USD';
const themeLabels = config.themeLabels || {};
const themes = config.themes || ['light', 'dark'];
const microFee = typeof config.microFee === 'number' ? config.microFee : 0.001;
const usdRate = typeof config.usdRate === 'number' ? config.usdRate : 1;
const pilotEndpoint = config.pilotEndpoint || '';
const pilotSuccess = config.pilotSuccess || '';
const pilotError = config.pilotError || '';

if (!localStorage.getItem('prefersDarkSet')) {
  const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
  document.cookie = `prefersDark=${prefersDark}; path=/; max-age=${60 * 60 * 24 * 30}`;
  localStorage.setItem('prefersDarkSet', '1');
}

document.addEventListener('DOMContentLoaded', () => {
  docEl.classList.remove('no-js');

  const audienceButtons = document.querySelectorAll('[data-audience]');
  const audiencePitchEl = document.querySelector('[data-audience-pitch]');
  const languageForm = document.querySelector('[data-language-switcher]');
  const themeToggle = document.querySelector('[data-theme-toggle]');
  const themeLabel = themeToggle?.querySelector('[data-theme-label]');
  const floatingCta = document.querySelector('[data-floating-cta]')?.parentElement;
  const pilotForm = document.querySelector('[data-pilot-form]');
  const pilotStatus = pilotForm?.querySelector('[data-pilot-status]');
  const pilotSubmit = pilotForm?.querySelector('[data-pilot-submit]');

  const numberFormatter = new Intl.NumberFormat(numberLocale);
  const currencyFormatter = new Intl.NumberFormat(numberLocale, {
    style: 'currency',
    currency: currencyCode,
    maximumFractionDigits: 2,
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

  if (languageForm) {
    languageForm.addEventListener('change', () => {
      const select = languageForm.querySelector('select');
      const selectedOption = select?.options[select.selectedIndex];
      const url = selectedOption?.dataset.url;
      if (url) {
        window.location.href = url;
      } else {
        languageForm.submit();
      }
    });
  }

  const people = document.getElementById('people');
  const apd = document.getElementById('apd');
  const peopleVal = document.getElementById('peopleVal');
  const apdVal = document.getElementById('apdVal');
  const opsMonthly = document.getElementById('opsMonthly');
  const nerpTotal = document.getElementById('nerpTotal');
  const usdApprox = document.getElementById('usdApprox');

  function estimate(peopleCount, actionsPerDay) {
    const monthlyActions = actionsPerDay * 30 * Math.max(peopleCount, 1);
    const nerpSpend = monthlyActions * microFee;
    const usd = nerpSpend * usdRate;
    return { monthlyActions, nerpSpend, usd };
  }

  function updateCalc() {
    if (!(people && apd && peopleVal && apdVal && opsMonthly && nerpTotal && usdApprox)) {
      return;
    }

    const p = Number.parseInt(people.value, 10) || 0;
    const a = Number.parseInt(apd.value, 10) || 0;
    peopleVal.textContent = p.toString();
    apdVal.textContent = a.toString();
    const result = estimate(p, a);
    opsMonthly.textContent = numberFormatter.format(result.monthlyActions);
    nerpTotal.textContent = numberFormatter.format(result.nerpSpend);
    usdApprox.textContent = currencyFormatter.format(result.usd);
  }

  people?.addEventListener('input', updateCalc);
  apd?.addEventListener('input', updateCalc);
  updateCalc();

  document.querySelectorAll('.faq-item').forEach((item) => {
    const trigger = item.querySelector('.faq-q');
    if (!trigger) return;
    trigger.addEventListener('click', () => {
      item.classList.toggle('open');
    });
  });

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

  document.querySelector('[data-floating-cta]')?.addEventListener('click', () => {
    const target = document.getElementById('pilot');
    target?.scrollIntoView({ behavior: 'smooth', block: 'start' });
  });

  if (pilotForm && pilotSubmit && pilotStatus) {
    const resetStatus = () => {
      pilotStatus.textContent = '';
      pilotStatus.classList.remove('is-success', 'is-error');
    };

    pilotForm.addEventListener('submit', async (event) => {
      event.preventDefault();
      if (!pilotForm.checkValidity()) {
        pilotForm.reportValidity();
        return;
      }

      resetStatus();
      pilotSubmit.setAttribute('disabled', 'disabled');
      pilotSubmit.classList.add('is-loading');

      const formData = new FormData(pilotForm);
      const payload = Object.fromEntries(formData.entries());

      const targetEndpoint = pilotEndpoint || pilotForm.getAttribute('action') || '';

      if (!targetEndpoint) {
        pilotStatus.textContent = pilotError || 'Endpoint is not configured.';
        pilotStatus.classList.add('is-error');
        pilotSubmit.removeAttribute('disabled');
        pilotSubmit.classList.remove('is-loading');
        return;
      }

      try {
        const response = await fetch(targetEndpoint, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            Accept: 'application/json',
          },
          body: JSON.stringify(payload),
        });

        if (!response.ok) {
          throw new Error('Request failed');
        }

        pilotForm.reset();
        pilotStatus.textContent = pilotSuccess || 'Application sent successfully.';
        pilotStatus.classList.add('is-success');
      } catch (error) {
        pilotStatus.textContent = pilotError || 'Something went wrong. Please try again.';
        pilotStatus.classList.add('is-error');
      } finally {
        pilotSubmit.removeAttribute('disabled');
        pilotSubmit.classList.remove('is-loading');
      }
    });
  }
});
