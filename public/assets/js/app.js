(function(){
  const config = window.__APP_CONFIG__ || {};
  const i18n = window.__APP_I18N__ || {};
  const locale = config.locale || 'en';
  const numberFormatter = new Intl.NumberFormat(locale);
  const currencyFormatter = new Intl.NumberFormat(locale, { style: 'currency', currency: 'USD' });

  const yearEl = document.getElementById('year');
  if (yearEl) {
    yearEl.textContent = String(new Date().getFullYear());
  }

  const languageSelect = document.getElementById('languageSelect');
  if (languageSelect) {
    languageSelect.addEventListener('change', (event) => {
      const target = event.target;
      if (target instanceof HTMLSelectElement) {
        const { value } = target;
        if (value) {
          window.location.href = value;
        }
      }
    });
  }

  const themeButton = document.getElementById('themeToggle');
  const themes = config.themes || ['system', 'light', 'dark'];
  const themeLabels = config.themeLabels || {};

  function setTheme(theme) {
    if (!themes.includes(theme)) {
      theme = 'system';
    }

    document.documentElement.dataset.theme = theme;
    if (theme === 'system') {
      localStorage.removeItem('theme');
    } else {
      localStorage.setItem('theme', theme);
    }

    if (themeButton) {
      const label = themeLabels[theme] || theme;
      themeButton.textContent = label;
      themeButton.setAttribute('aria-label', (themeLabels.toggle || 'Toggle theme') + ': ' + label);
    }
  }

  function cycleTheme() {
    const current = document.documentElement.dataset.theme || 'system';
    const idx = themes.indexOf(current);
    const next = themes[(idx + 1) % themes.length];
    setTheme(next);
  }

  if (themeButton) {
    themeButton.addEventListener('click', cycleTheme);
  }

  const storedTheme = localStorage.getItem('theme');
  if (storedTheme) {
    setTheme(storedTheme);
  } else {
    setTheme(document.documentElement.dataset.theme || 'system');
  }

  // Audience switcher
  const audienceButtons = document.querySelectorAll('[data-audience]');
  const audiencePitch = document.getElementById('audiencePitch');
  const pitches = (i18n.audience && i18n.audience.pitches) || {};

  function setAudience(key) {
    if (!pitches[key] || !audiencePitch) {
      return;
    }

    audienceButtons.forEach((button) => {
      if (button instanceof HTMLElement) {
        button.classList.toggle('selected', button.dataset.audience === key);
      }
    });

    const pitch = pitches[key];
    audiencePitch.innerHTML = `
      <div class="card-row">
        <div class="icon-bubble"><span class="icon ${pitch.icon}"></span></div>
        <div>
          <div class="card-title">${pitch.title}</div>
          <p class="card-desc">${pitch.description}</p>
        </div>
      </div>
    `;
  }

  audienceButtons.forEach((button) => {
    button.addEventListener('click', () => {
      setAudience(button.dataset.audience || '');
    });
  });

  if (audienceButtons.length) {
    const defaultKey = audienceButtons[0].dataset.audience || 'business';
    setAudience(defaultKey);
  }

  // Calculator
  const people = document.getElementById('people');
  const apd = document.getElementById('apd');
  const peopleVal = document.getElementById('peopleVal');
  const apdVal = document.getElementById('apdVal');
  const opsMonthly = document.getElementById('opsMonthly');
  const nerpTotal = document.getElementById('nerpTotal');
  const usdApprox = document.getElementById('usdApprox');

  function estimateCost(teamSize, actionsPerDay) {
    const actionsMonthly = actionsPerDay * 30 * Math.max(teamSize, 1);
    const microFee = 0.001;
    const totalNerp = actionsMonthly * microFee;
    const assumedRateUSD = 1;

    return {
      actionsMonthly,
      totalNerp,
      usd: totalNerp * assumedRateUSD,
    };
  }

  function updateCalc() {
    if (!people || !apd || !peopleVal || !apdVal || !opsMonthly || !nerpTotal || !usdApprox) {
      return;
    }

    const team = Number.parseInt(people.value, 10) || 0;
    const actions = Number.parseInt(apd.value, 10) || 0;

    peopleVal.textContent = numberFormatter.format(team);
    apdVal.textContent = numberFormatter.format(actions);

    const result = estimateCost(team, actions);
    opsMonthly.innerHTML = numberFormatter.format(result.actionsMonthly);
    nerpTotal.innerHTML = result.totalNerp.toLocaleString(locale, { maximumFractionDigits: 2 });
    usdApprox.innerHTML = currencyFormatter.format(result.usd);
  }

  if (people && apd) {
    people.addEventListener('input', updateCalc);
    apd.addEventListener('input', updateCalc);
    updateCalc();
  }

  // FAQ accordion
  document.querySelectorAll('.faq-item').forEach((item) => {
    const trigger = item.querySelector('.faq-q');
    if (trigger) {
      trigger.addEventListener('click', () => {
        item.classList.toggle('open');
      });
    }
  });
})();
