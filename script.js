// Audience switcher + pricing calculator + FAQ
(function(){
  const audienceButtons = document.querySelectorAll('.aud-card');
  const audiencePitch = document.getElementById('audiencePitch');
  const yearEl = document.getElementById('year');
  if (yearEl) yearEl.textContent = new Date().getFullYear().toString();

  const pitches = {
    business: {
      icon: 'shield',
      title: 'Запускайте процессы за часы',
      desc: 'Готовые блоки CRM/HR/Склад + автоматические политики доступа. Без закупки серверов.'
    },
    integrator: {
      icon: 'coins',
      title: 'Доля с транзакций',
      desc: 'Подключайте клиентов к сети и получайте до 30% с микроплатежей за операции.'
    },
    dev: {
      icon: 'boxes',
      title: 'Магазин модулей',
      desc: 'Публикуйте функции и зарабатывайте автоматически по факту использования.'
    }
  };

  function setAudience(key){
    audienceButtons.forEach(b => b.classList.toggle('selected', b.dataset.audience === key));
    const p = pitches[key];
    audiencePitch.innerHTML = `
      <div class="card-row">
        <div class="icon-bubble"><span class="icon ${p.icon}"></span></div>
        <div>
          <div class="card-title">${p.title}</div>
          <p class="card-desc">${p.desc}</p>
        </div>
      </div>
    `;
  }

  audienceButtons.forEach(btn => {
    btn.addEventListener('click', () => setAudience(btn.dataset.audience));
  });

  // Init default
  setAudience('business');

  // Calculator
  const people = document.getElementById('people');
  const apd = document.getElementById('apd');
  const peopleVal = document.getElementById('peopleVal');
  const apdVal = document.getElementById('apdVal');
  const opsMonthly = document.getElementById('opsMonthly');
  const nerpTotal = document.getElementById('nerpTotal');
  const usdApprox = document.getElementById('usdApprox');

  function formatNumber(n){
    return n.toLocaleString('ru-RU');
  }

  function estimateCost(people, actionsPerDay){
    const actionsMonthly = actionsPerDay * 30 * Math.max(people, 1);
    const microFee = 0.001; // nERP per action (demo)
    const totalNerp = actionsMonthly * microFee;
    const assumedRateUSD = 1; // 1 nERP = $1 (placeholder)
    return {
      actionsMonthly,
      totalNerp,
      usd: totalNerp * assumedRateUSD
    };
  }

  function updateCalc(){
    const p = parseInt(people.value, 10);
    const a = parseInt(apd.value, 10);
    peopleVal.textContent = p;
    apdVal.textContent = a;
    const res = estimateCost(p, a);
    opsMonthly.innerHTML = formatNumber(res.actionsMonthly);
    nerpTotal.innerHTML = res.totalNerp.toLocaleString('ru-RU', {maximumFractionDigits:2});
    usdApprox.innerHTML = res.usd.toLocaleString('ru-RU', {style:'currency', currency:'USD'});
  }

  people.addEventListener('input', updateCalc);
  apd.addEventListener('input', updateCalc);
  updateCalc();

  // FAQ
  document.querySelectorAll('.faq-item').forEach(item => {
    const btn = item.querySelector('.faq-q');
    btn.addEventListener('click', () => {
      item.classList.toggle('open');
    });
  });
})();
