(function(){
  const config = window.__APP_CONFIG__ || {};
  const docEl = document.documentElement;
  const dropdowns = document.querySelectorAll('.dropdown');

  function closeDropdowns(exception){
    dropdowns.forEach(drop => {
      if (drop !== exception) {
        drop.classList.remove('open');
        const trigger = drop.querySelector('[aria-expanded="true"]');
        if (trigger) trigger.setAttribute('aria-expanded', 'false');
      }
    });
  }

  dropdowns.forEach(drop => {
    const trigger = drop.querySelector('[data-trigger]');
    if (!trigger) return;
    trigger.addEventListener('click', event => {
      event.preventDefault();
      const isOpen = drop.classList.toggle('open');
      trigger.setAttribute('aria-expanded', String(isOpen));
      if (isOpen) {
        closeDropdowns(drop);
      }
    });
  });

  document.addEventListener('click', event => {
    if (!(event.target instanceof Node)) return;
    const dropdown = event.target.closest('.dropdown');
    if (!dropdown) {
      closeDropdowns();
    }
  });

  const themeSwitcher = document.querySelector('[data-component="theme-switcher"]');
  const themeIcon = themeSwitcher ? themeSwitcher.querySelector('[data-theme-icon]') : null;
  const themeOptions = themeSwitcher ? themeSwitcher.querySelectorAll('[data-theme-option]') : [];
  const systemMedia = window.matchMedia('(prefers-color-scheme: dark)');

  function persist(name, value){
    const expires = new Date(Date.now() + 1000 * 60 * 60 * 24 * 30).toUTCString();
    document.cookie = `${name}=${value}; expires=${expires}; path=/; SameSite=Lax`;
  }

  function getResolvedTheme(mode){
    if (mode === 'auto') {
      return systemMedia.matches ? 'dark' : 'light';
    }
    return mode;
  }

  function setTheme(mode){
    config.theme = mode;
    persist('app_theme', mode);
    const resolved = getResolvedTheme(mode);
    ['theme-light', 'theme-dark'].forEach(cls => docEl.classList.remove(cls));
    docEl.classList.add(`theme-${resolved}`);
    if (themeIcon) {
      const iconClass = mode === 'dark' ? 'moon' : mode === 'light' ? 'sun' : (resolved === 'dark' ? 'moon' : 'sun');
      themeIcon.className = `icon ${iconClass}`;
    }
    docEl.style.colorScheme = resolved;
  }

  if (themeOptions.length){
    themeOptions.forEach(button => {
      button.addEventListener('click', () => {
        const mode = button.dataset.themeOption || 'auto';
        setTheme(mode);
        closeDropdowns();
      });
    });
  }

  function handleSystemChange(){
    if (config.theme === 'auto') {
      setTheme('auto');
    }
  }

  if (typeof systemMedia.addEventListener === 'function') {
    systemMedia.addEventListener('change', handleSystemChange);
  } else if (typeof systemMedia.addListener === 'function') {
    systemMedia.addListener(handleSystemChange);
  }

  setTheme(config.theme || 'auto');

  const audienceRoot = document.querySelector('[data-component="audience"]');
  const pitchBox = document.getElementById('audiencePitch');
  const pitches = (config.audiencePitches || {});

  function renderPitch(key){
    const pitch = pitches[key];
    if (!pitch || !pitchBox) return;
    pitchBox.innerHTML = `
      <div class="card-row">
        <div class="icon-bubble"><span class="icon ${pitch.icon || 'sparkles'}" aria-hidden="true"></span></div>
        <div>
          <h3 class="card-title">${pitch.title}</h3>
          <p class="card-desc">${pitch.description}</p>
        </div>
      </div>
    `;
  }

  if (audienceRoot && pitchBox){
    audienceRoot.addEventListener('click', event => {
      const button = event.target.closest('.aud-card');
      if (!button) return;
      const key = button.dataset.audience;
      audienceRoot.querySelectorAll('.aud-card').forEach(card => {
        card.classList.toggle('selected', card === button);
      });
      renderPitch(key);
    });
    const first = audienceRoot.querySelector('.aud-card');
    if (first) {
      renderPitch(first.dataset.audience);
    }
  }

  const faqItems = document.querySelectorAll('.faq-item');
  faqItems.forEach(item => {
    const trigger = item.querySelector('.faq-q');
    if (!trigger) return;
    trigger.addEventListener('click', () => {
      item.classList.toggle('open');
    });
  });

  const calculator = document.querySelector('[data-component="calculator"]');
  if (calculator) {
    const peopleInput = calculator.querySelector('#people');
    const apdInput = calculator.querySelector('#apd');
    const peopleVal = calculator.querySelector('#peopleVal');
    const apdVal = calculator.querySelector('#apdVal');
    const opsMonthly = document.getElementById('opsMonthly');
    const nerpTotal = document.getElementById('nerpTotal');
    const usdApprox = document.getElementById('usdApprox');
    const { micro_fee: microFee = 0.001, days_per_month: daysPerMonth = 30, currency = 'USD' } = config.pricing || {};
    const numberFormatter = new Intl.NumberFormat(config.locale || 'en-US');
    const currencyFormatter = new Intl.NumberFormat(config.locale || 'en-US', { style: 'currency', currency });

    function update(){
      const people = Number(peopleInput.value);
      const actions = Number(apdInput.value);
      if (peopleVal) peopleVal.textContent = people.toString();
      if (apdVal) apdVal.textContent = actions.toString();
      const actionsMonthly = Math.max(people, 1) * Math.max(actions, 0) * daysPerMonth;
      const totalNerp = actionsMonthly * microFee;
      const usdValue = totalNerp;
      if (opsMonthly) opsMonthly.textContent = numberFormatter.format(actionsMonthly);
      if (nerpTotal) nerpTotal.textContent = numberFormatter.format(totalNerp);
      if (usdApprox) usdApprox.textContent = currencyFormatter.format(usdValue);
    }

    peopleInput.addEventListener('input', update);
    apdInput.addEventListener('input', update);
    update();
  }
})();
