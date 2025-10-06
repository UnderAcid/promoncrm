const docEl = document.documentElement;

document.addEventListener('DOMContentLoaded', () => {
  docEl.classList.remove('no-js');

  const header = document.querySelector('[data-header]');
  const navToggle = document.querySelector('[data-nav-toggle]');
  const nav = document.querySelector('[data-nav]');
  const floatingCta = document.querySelector('[data-floating-cta]');
  const form = document.querySelector('[data-application-form]');
  const successMessage = form?.querySelector('[data-form-success]') ?? null;
  const errorMessage = form?.querySelector('[data-form-error]') ?? null;
  const submitButton = form?.querySelector('button[type="submit"]') ?? null;

  const closeNav = () => {
    if (!(header instanceof HTMLElement) || !(navToggle instanceof HTMLElement)) {
      return;
    }
    header.classList.remove('nav-open');
    navToggle.setAttribute('aria-expanded', 'false');
  };

  const openNav = () => {
    if (!(header instanceof HTMLElement) || !(navToggle instanceof HTMLElement)) {
      return;
    }
    header.classList.add('nav-open');
    navToggle.setAttribute('aria-expanded', 'true');
  };

  if (navToggle instanceof HTMLElement) {
    navToggle.addEventListener('click', () => {
      if (!(header instanceof HTMLElement)) {
        return;
      }
      const isOpen = header.classList.contains('nav-open');
      if (isOpen) {
        closeNav();
      } else {
        openNav();
      }
    });
  }

  if (nav instanceof HTMLElement) {
    nav.querySelectorAll('a[href^="#"]').forEach((link) => {
      link.addEventListener('click', () => {
        if (window.innerWidth < 860) {
          closeNav();
        }
      });
    });
  }

  window.addEventListener('resize', () => {
    if (window.innerWidth >= 860) {
      closeNav();
    }
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
      closeNav();
    }
  });

  const scrollToId = (targetId) => {
    if (!targetId) return;
    const element = document.getElementById(targetId);
    if (!element) return;
    const rect = element.getBoundingClientRect();
    const offset = window.pageYOffset + rect.top - (parseInt(getComputedStyle(docEl).getPropertyValue('--anchor-offset'), 10) || 0);
    window.scrollTo({ top: offset, behavior: 'smooth' });
  };

  document.querySelectorAll('[data-scroll-target]').forEach((node) => {
    node.addEventListener('click', (event) => {
      const targetId = node.getAttribute('data-scroll-target') || node.getAttribute('href')?.replace('#', '');
      if (!targetId) {
        return;
      }
      if (node instanceof HTMLAnchorElement) {
        event.preventDefault();
      }
      scrollToId(targetId);
    });
  });

  if (floatingCta instanceof HTMLElement) {
    if (!form) {
      floatingCta.remove();
    } else {
      const targetId = floatingCta.getAttribute('data-scroll-target') || 'apply';
      floatingCta.addEventListener('click', () => scrollToId(targetId));
    }
  }

  if (form instanceof HTMLFormElement) {
    const params = new URLSearchParams(window.location.search);
    params.forEach((value, key) => {
      if (!value || form.elements.namedItem(key)) {
        return;
      }
      const hidden = document.createElement('input');
      hidden.type = 'hidden';
      hidden.name = key;
      hidden.value = value;
      form.appendChild(hidden);
    });

    form.addEventListener('submit', async (event) => {
      event.preventDefault();
      if (!(form instanceof HTMLFormElement)) {
        return;
      }

      if (successMessage instanceof HTMLElement) {
        successMessage.hidden = true;
      }
      if (errorMessage instanceof HTMLElement) {
        errorMessage.hidden = true;
      }

      if (submitButton instanceof HTMLButtonElement) {
        submitButton.disabled = true;
      }

      try {
        const formData = new FormData(form);
        const response = await fetch(form.action || 'form-submit.php', {
          method: 'POST',
          body: formData,
          headers: {
            'Accept': 'application/json',
          },
        });

        if (!response.ok) {
          throw new Error('Network error');
        }

        const payload = await response.json();
        if (payload?.success) {
          form.reset();
          if (successMessage instanceof HTMLElement) {
            successMessage.hidden = false;
          }
          if (errorMessage instanceof HTMLElement) {
            errorMessage.hidden = true;
          }
        } else {
          throw new Error('Invalid response');
        }
      } catch (error) {
        if (errorMessage instanceof HTMLElement) {
          errorMessage.hidden = false;
        }
      } finally {
        if (submitButton instanceof HTMLButtonElement) {
          submitButton.disabled = false;
        }
      }
    });
  }
});
