(function (window, document) {
  const App = (window.App = window.App || {});

  function parseConfig() {
    const el = document.getElementById('app-config');
    if (!el) {
      return {};
    }

    try {
      return JSON.parse(el.textContent || '{}');
    } catch (error) {
      console.error('Unable to parse app config', error);
      return {};
    }
  }

  function getLocaleForNumbers(locale) {
    if (!locale) {
      return 'en-US';
    }

    if (locale.indexOf('-') !== -1) {
      return locale;
    }

    switch (locale) {
      case 'ru':
        return 'ru-RU';
      case 'en':
      default:
        return 'en-US';
    }
  }

  function init() {
    const config = parseConfig();
    if (!config.locale) {
      return;
    }

    const i18n = new App.I18n(config);
    App.i18n = i18n;
    i18n.applyTranslations();

    const themeManager = new App.ThemeManager(config);
    App.theme = themeManager;
    themeManager.apply(config.theme, false);
    themeManager.bindToggle(document.getElementById('themeToggle'));

    const languageSwitcher = document.getElementById('languageSwitcher');
    if (languageSwitcher) {
      languageSwitcher.addEventListener('change', (event) => {
        const locale = event.target.value;
        i18n.changeLocale(locale).then(() => {
          refreshAudiencePitch();
          updateNumberFormatting();
        });
      });
    }

    const audienceButtons = Array.prototype.slice.call(document.querySelectorAll('.aud-card'));
    const audiencePitch = document.getElementById('audiencePitch');

    function renderAudiencePitch(key) {
      if (!audiencePitch) {
        return;
      }

      const pitch = i18n.get(`audience.pitches.${key}`);
      if (!pitch) {
        return;
      }

      audiencePitch.dataset.current = key;
      audiencePitch.innerHTML = '';

      const row = document.createElement('div');
      row.className = 'card-row';

      const iconWrap = document.createElement('div');
      iconWrap.className = 'icon-bubble';
      const icon = document.createElement('span');
      icon.className = `icon ${pitch.icon || ''}`;
      iconWrap.appendChild(icon);

      const textWrap = document.createElement('div');
      const title = document.createElement('div');
      title.className = 'card-title';
      title.setAttribute('data-i18n-key', `audience.pitches.${key}.title`);
      title.textContent = pitch.title || '';
      const desc = document.createElement('p');
      desc.className = 'card-desc';
      desc.setAttribute('data-i18n-key', `audience.pitches.${key}.description`);
      desc.textContent = pitch.description || '';

      textWrap.appendChild(title);
      textWrap.appendChild(desc);

      row.appendChild(iconWrap);
      row.appendChild(textWrap);
      audiencePitch.appendChild(row);
      i18n.applyTranslations(audiencePitch);
    }

    function setAudience(key) {
      audienceButtons.forEach((button) => {
        button.classList.toggle('selected', button.dataset.audience === key);
      });
      renderAudiencePitch(key);
    }

    audienceButtons.forEach((button) => {
      button.addEventListener('click', () => {
        setAudience(button.dataset.audience);
      });
    });

    function refreshAudiencePitch() {
      const current = (audiencePitch && audiencePitch.dataset.current) || (audienceButtons[0] && audienceButtons[0].dataset.audience);
      if (current) {
        setAudience(current);
      }
    }

    refreshAudiencePitch();

    const people = document.getElementById('people');
    const apd = document.getElementById('apd');
    const peopleVal = document.getElementById('peopleVal');
    const apdVal = document.getElementById('apdVal');
    const opsMonthly = document.getElementById('opsMonthly');
    const nerpTotal = document.getElementById('nerpTotal');
    const usdApprox = document.getElementById('usdApprox');
    let calculatorHandler = null;

    function estimateCost(peopleCount, actionsPerDay) {
      const actionsMonthly = actionsPerDay * 30 * Math.max(peopleCount, 1);
      const microFee = 0.001;
      const totalNerp = actionsMonthly * microFee;
      const usdRate = 1; // Placeholder for demo purposes
      return {
        actionsMonthly,
        totalNerp,
        usd: totalNerp * usdRate,
      };
    }

    function updateNumberFormatting() {
      if (!people || !apd || !peopleVal || !apdVal || !opsMonthly || !nerpTotal || !usdApprox) {
        return;
      }

      if (calculatorHandler) {
        people.removeEventListener('input', calculatorHandler);
        apd.removeEventListener('input', calculatorHandler);
      }

      const locale = getLocaleForNumbers(i18n.getLocale());
      const numberFormatter = new Intl.NumberFormat(locale);
      const currencyFormatter = new Intl.NumberFormat(locale, { style: 'currency', currency: 'USD' });

      calculatorHandler = function updateCalc() {
        const peopleCount = parseInt(people.value, 10);
        const actions = parseInt(apd.value, 10);
        peopleVal.textContent = peopleCount.toString();
        apdVal.textContent = actions.toString();
        const result = estimateCost(peopleCount, actions);
        const operationsFormatted = numberFormatter.format(result.actionsMonthly);
        opsMonthly.innerHTML = operationsFormatted.replace(/\s/g, '&nbsp;');
        nerpTotal.innerHTML = result.totalNerp.toLocaleString(locale, { maximumFractionDigits: 2 });
        usdApprox.innerHTML = currencyFormatter.format(result.usd);
      };

      people.addEventListener('input', calculatorHandler);
      apd.addEventListener('input', calculatorHandler);
      calculatorHandler();
    }

    updateNumberFormatting();

    i18n.onChange(() => {
      refreshAudiencePitch();
      updateNumberFormatting();
    });

    document.querySelectorAll('.faq-item').forEach((item) => {
      const button = item.querySelector('.faq-q');
      if (!button) {
        return;
      }
      button.addEventListener('click', () => {
        item.classList.toggle('open');
      });
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})(window, document);
