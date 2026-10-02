(() => {
  /* -------------------------------------------------------------------------
     VON TECH Splash Screen Controller
     ------------------------------------------------------------------------- */
  const splashScreen = document.getElementById('splash-screen');
  if (splashScreen) {
    document.body.classList.add('splash-active');
    const progressBar = document.getElementById('splash-progress-bar');
    const statusLabel = document.getElementById('splash-status-label');
    const percentLabel = document.getElementById('splash-percent');
    const skipBtn = document.getElementById('splash-skip-btn');

    let currentProgress = 0;
    let isDismissed = false;

    const setProgress = (value, status) => {
      currentProgress = Math.min(100, Math.max(0, value));
      if (progressBar) progressBar.style.width = `${currentProgress}%`;
      if (percentLabel) percentLabel.textContent = `${Math.round(currentProgress)}%`;
      if (status && statusLabel) statusLabel.textContent = status;
    };

    const dismissSplash = () => {
      if (isDismissed) return;
      isDismissed = true;
      setProgress(100, 'SYSTEM READY');
      splashScreen.classList.add('splash-fading');
      document.body.classList.remove('splash-active');
      setTimeout(() => {
        splashScreen.classList.add('splash-hidden');
        splashScreen.setAttribute('aria-hidden', 'true');
      }, 900);
    };

    skipBtn?.addEventListener('click', (e) => {
      e.stopPropagation();
      dismissSplash();
    });

    splashScreen.addEventListener('click', dismissSplash);

    window.addEventListener('keydown', (e) => {
      if (!isDismissed && (e.key === 'Escape' || e.key === 'Enter' || e.key === ' ')) {
        dismissSplash();
      }
    });

    // Staged progress milestones for a smoother, slower, cinematic experience (~3.4s total)
    setTimeout(() => { if (!isDismissed) setProgress(18, 'INITIALIZING CORE'); }, 350);
    setTimeout(() => { if (!isDismissed) setProgress(42, 'LOADING MODULES'); }, 950);
    setTimeout(() => { if (!isDismissed) setProgress(68, 'CALIBRATING INTERFACE'); }, 1650);
    setTimeout(() => { if (!isDismissed) setProgress(88, 'PREPARING SHOWCASE'); }, 2350);
    setTimeout(() => { if (!isDismissed) setProgress(100, 'SYSTEM READY'); }, 2950);
    setTimeout(() => { if (!isDismissed) dismissSplash(); }, 3450);
  }

  const themeToggle = document.querySelector('.theme-toggle');
  const themeColor = document.querySelector('meta[name="theme-color"]');
  const applyTheme = (theme) => {
    const dark = theme === 'dark';
    document.documentElement.dataset.theme = theme;
    themeToggle?.setAttribute('aria-pressed', String(dark));
    themeToggle?.setAttribute('aria-label', `Switch to ${dark ? 'light' : 'dark'} mode`);
    themeColor?.setAttribute('content', dark ? '#111111' : '#ffffff');
  };
  const savedTheme = localStorage.getItem('portfolio-theme');
  // Light mode is the default mode
  applyTheme(savedTheme === 'dark' ? 'dark' : 'light');
  themeToggle?.addEventListener('click', () => {
    const nextTheme = document.documentElement.dataset.theme === 'dark' ? 'light' : 'dark';
    applyTheme(nextTheme);
    try { localStorage.setItem('portfolio-theme', nextTheme); } catch {}
  });
  const menuButton = document.querySelector('.menu-toggle');
  const nav = document.querySelector('.site-nav');
  const navLinks = [...document.querySelectorAll('.site-nav a')];
  const sections = navLinks.map((link) => document.querySelector(link.getAttribute('href'))).filter(Boolean);
  const backToTop = document.querySelector('.back-to-top');
  const footer = document.querySelector('.site-footer');
  navLinks.forEach((link) => link.addEventListener('click', () => { nav?.classList.remove('open'); menuButton?.setAttribute('aria-expanded', 'false'); }));
  document.addEventListener('click', (event) => {
    if (nav?.classList.contains('open') && !nav.contains(event.target) && !menuButton?.contains(event.target)) {
      nav.classList.remove('open');
      menuButton?.setAttribute('aria-expanded', 'false');
    }
  });
  const observer = new IntersectionObserver((entries) => entries.forEach((entry) => { if (entry.isIntersecting) entry.target.classList.add('visible'); }), { threshold: 0.12 });
  document.querySelectorAll('.reveal').forEach((item) => observer.observe(item));
  const navObserver = new IntersectionObserver((entries) => entries.forEach((entry) => { if (entry.isIntersecting) navLinks.forEach((link) => link.classList.toggle('active', link.getAttribute('href') === `#${entry.target.id}`)); }), { rootMargin: '-30% 0px -60% 0px', threshold: 0 });
  sections.forEach((section) => navObserver.observe(section));
  window.addEventListener('scroll', () => backToTop?.classList.toggle('visible', window.scrollY > 600), { passive: true });
  backToTop?.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
  if (footer && backToTop) {
    const footerObserver = new IntersectionObserver(([entry]) => {
      backToTop.classList.toggle('footer-visible', entry.isIntersecting);
    });
    footerObserver.observe(footer);
  }
  const chatToggle = document.querySelector('.chat-toggle');
  const chatWidget = document.querySelector('.chat-widget');
  const chatPanel = document.querySelector('.chat-panel');
  const chatClose = document.querySelector('.chat-close');
  const chatForm = document.querySelector('.chat-form');
  const chatInput = document.querySelector('#chat-input');
  const chatMessages = document.querySelector('.chat-messages');
  if (footer && chatWidget) {
    const chatFooterObserver = new IntersectionObserver(([entry]) => {
      chatWidget.classList.toggle('footer-visible', entry.isIntersecting);
    });
    chatFooterObserver.observe(footer);
  }
  let chatTrigger = null;
  const setChatOpen = (open) => {
    if (!chatPanel || !chatToggle) return;
    if (open) chatTrigger = document.activeElement;
    chatPanel.hidden = !open;
    chatToggle.setAttribute('aria-expanded', String(open));
    if (open) chatInput?.focus();
    else if (chatTrigger instanceof HTMLElement) chatTrigger.focus();
  };
  chatToggle?.addEventListener('click', () => setChatOpen(chatPanel.hidden));
  chatClose?.addEventListener('click', () => setChatOpen(false));
  document.querySelectorAll('.chat-suggestions button').forEach((button) => button.addEventListener('click', () => sendMessage(button.dataset.message)));
  const addMessage = (text, role) => {
    const message = document.createElement('p');
    message.className = `chat-message ${role}`;
    message.textContent = text;
    chatMessages?.append(message);
    if (chatMessages) chatMessages.scrollTop = chatMessages.scrollHeight;
    return message;
  };
  async function sendMessage(message) {
    const text = message?.trim();
    if (!text || !chatInput || !chatForm) return;
    addMessage(text, 'user');
    chatInput.value = '';
    const submit = chatForm.querySelector('button');
    submit.disabled = true;
    const pending = addMessage('Thinking…', 'bot');
    try {
      const response = await fetch(document.querySelector('meta[name="chat-endpoint"]').content, { method: 'POST', headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' }, body: JSON.stringify({ message: text }) });
      const data = await response.json();
      if (!response.ok) {
        console.error('Chat API error:', response.status, data);
      }
      pending.textContent = data.reply || data.error || 'I could not generate a response. Please email Von directly.';
    } catch (error) {
      console.error('Chat request failed:', error);
      pending.textContent = 'The assistant is unavailable right now. Please email Von directly.';
    } finally {
      submit.disabled = false;
      chatInput.focus();
    }
  }
  chatForm?.addEventListener('submit', (event) => { event.preventDefault(); sendMessage(chatInput.value); });
  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && chatPanel && !chatPanel.hidden) setChatOpen(false);
  });
  // ==========================================
  // GitHub Activity & Contributions Integration
  // ==========================================
  const initGitHubActivity = async () => {
    const calendarStage = document.getElementById('calendar-stage');
    const totalCountEl = document.getElementById('github-total-contributions');
    const yearLabelEl = document.getElementById('github-selected-year');
    const yearButtons = document.querySelectorAll('.year-btn');
    const tooltip = document.getElementById('calendar-tooltip');
    const endpoint = document.querySelector('meta[name="github-activity-endpoint"]')?.content || '/github-activity';

    if (!calendarStage) return;

    let cachedData = null;
    let currentYear = 2026;

    const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    const fullMonthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

    const formatTooltipDate = (dateStr, count) => {
      const parts = dateStr.split('-');
      if (parts.length !== 3) return `${count} contributions`;
      const y = parts[0];
      const m = parseInt(parts[1], 10) - 1;
      const d = parseInt(parts[2], 10);
      const countText = count === 0 ? 'No contributions' : (count === 1 ? '1 contribution' : `${count} contributions`);
      return `${countText} on ${fullMonthNames[m]} ${d}, ${y}`;
    };

    const buildCalendarTable = (year, contribList) => {
      const dateMap = new Map();
      if (Array.isArray(contribList)) {
        contribList.forEach(c => {
          if (c && c.date) dateMap.set(c.date, c);
        });
      }

      const startDate = new Date(year, 0, 1);
      const endDate = new Date(year, 11, 31);
      const firstSunday = new Date(startDate);
      firstSunday.setDate(startDate.getDate() - startDate.getDay());

      const weeks = [];
      let cur = new Date(firstSunday);

      while (cur <= endDate || cur.getDay() !== 0) {
        const weekIndex = Math.floor((cur.getTime() - firstSunday.getTime()) / (7 * 86400000));
        if (!weeks[weekIndex]) weeks[weekIndex] = [];

        const y = cur.getFullYear();
        const m = String(cur.getMonth() + 1).padStart(2, '0');
        const d = String(cur.getDate()).padStart(2, '0');
        const dateStr = `${y}-${m}-${d}`;
        const inYear = cur.getFullYear() === year;
        const contrib = dateMap.get(dateStr);

        weeks[weekIndex].push({
          date: dateStr,
          month: cur.getMonth(),
          inYear: inYear,
          count: inYear ? (contrib ? contrib.count : 0) : null,
          level: inYear ? (contrib ? contrib.level : 0) : null
        });

        cur.setDate(cur.getDate() + 1);
        if (cur.getFullYear() > year && cur.getDay() === 0) break;
      }

      // Compute month colspans
      const monthSpans = [];
      let lastMonth = -1;
      let currentSpan = 0;

      weeks.forEach((week) => {
        const primaryDay = week.find(day => day.inYear) || week[0];
        const m = primaryDay.month;
        if (m !== lastMonth) {
          if (lastMonth !== -1) {
            monthSpans.push({ month: monthNames[lastMonth], span: currentSpan });
          }
          lastMonth = m;
          currentSpan = 1;
        } else {
          currentSpan++;
        }
      });
      if (lastMonth !== -1) {
        monthSpans.push({ month: monthNames[lastMonth], span: currentSpan });
      }

      let html = '<table class="calendar-table" role="grid" aria-label="GitHub Contributions Calendar">';
      html += '<thead><tr class="calendar-month-row"><th></th>';
      monthSpans.forEach(m => {
        html += `<th colspan="${m.span}">${m.month}</th>`;
      });
      html += '</tr></thead><tbody>';

      const dayLabels = ['', 'Mon', '', 'Wed', '', 'Fri', ''];

      for (let day = 0; day < 7; day++) {
        html += `<tr><td class="calendar-weekday-header">${dayLabels[day]}</td>`;
        for (let w = 0; w < weeks.length; w++) {
          const cell = weeks[w] ? weeks[w][day] : null;
          if (!cell || !cell.inYear) {
            html += '<td class="calendar-day-cell" style="visibility:hidden" aria-hidden="true"></td>';
          } else {
            html += `<td class="calendar-day-cell level-${cell.level}" data-date="${cell.date}" data-count="${cell.count}" tabindex="0" role="gridcell" aria-label="${formatTooltipDate(cell.date, cell.count)}"></td>`;
          }
        }
        html += '</tr>';
      }

      html += '</tbody></table>';
      return html;
    };

    const attachTooltipListeners = () => {
      if (!tooltip) return;
      const cells = calendarStage.querySelectorAll('.calendar-day-cell[data-date]');

      const showTooltip = (cell) => {
        const date = cell.dataset.date;
        const count = parseInt(cell.dataset.count || '0', 10);
        tooltip.textContent = formatTooltipDate(date, count);

        const rect = cell.getBoundingClientRect();
        const padding = 12;
        const estHalfWidth = 95;
        let left = rect.left + rect.width / 2;
        left = Math.max(padding + estHalfWidth, Math.min(window.innerWidth - padding - estHalfWidth, left));

        tooltip.style.left = `${left}px`;
        if (rect.top < 60) {
          tooltip.style.top = `${rect.bottom + 8}px`;
          tooltip.style.transform = 'translate(-50%, 0)';
        } else {
          tooltip.style.top = `${rect.top}px`;
          tooltip.style.transform = 'translate(-50%, -100%) translateY(-8px)';
        }

        tooltip.classList.add('visible');
        tooltip.setAttribute('aria-hidden', 'false');
      };

      const hideTooltip = () => {
        tooltip.classList.remove('visible');
        tooltip.setAttribute('aria-hidden', 'true');
      };

      cells.forEach(cell => {
        cell.addEventListener('mouseenter', () => showTooltip(cell));
        cell.addEventListener('mouseleave', hideTooltip);
        cell.addEventListener('focus', () => showTooltip(cell));
        cell.addEventListener('blur', hideTooltip);
        cell.addEventListener('click', (e) => {
          e.stopPropagation();
          showTooltip(cell);
        });
      });
    };

    document.addEventListener('click', (e) => {
      if (!e.target.closest('.calendar-day-cell') && tooltip) {
        tooltip.classList.remove('visible');
        tooltip.setAttribute('aria-hidden', 'true');
      }
    });

    const scrollToLatest = (year) => {
      const scrollWrapper = document.getElementById('calendar-scroll-wrapper');
      if (scrollWrapper && window.innerWidth <= 768) {
        if (year === 2026) {
          requestAnimationFrame(() => {
            scrollWrapper.scrollLeft = scrollWrapper.scrollWidth - scrollWrapper.clientWidth;
          });
        } else {
          scrollWrapper.scrollLeft = 0;
        }
      }
    };

    const renderYear = (year) => {
      currentYear = year;
      if (yearLabelEl) yearLabelEl.textContent = year;
      if (totalCountEl && cachedData?.totals) {
        totalCountEl.textContent = cachedData.totals[year] ?? 0;
      }

      yearButtons.forEach(btn => {
        const isActive = parseInt(btn.dataset.year, 10) === year;
        btn.classList.toggle('active', isActive);
        btn.setAttribute('aria-selected', String(isActive));
      });

      const yearContribs = cachedData?.contributions?.filter(c => c && c.date && c.date.startsWith(`${year}-`)) || [];
      calendarStage.innerHTML = buildCalendarTable(year, yearContribs);
      attachTooltipListeners();
      scrollToLatest(year);
    };

    yearButtons.forEach(btn => {
      btn.addEventListener('click', () => {
        const selected = parseInt(btn.dataset.year, 10);
        if (selected && selected !== currentYear) {
          renderYear(selected);
        }
      });
    });

    // 1. Instantly render from pre-populated SSR initial data if available
    const initialDataEl = document.getElementById('github-initial-data');
    if (initialDataEl && initialDataEl.textContent.trim()) {
      try {
        const parsed = JSON.parse(initialDataEl.textContent);
        if (parsed && Array.isArray(parsed.contributions) && parsed.contributions.length > 0) {
          cachedData = parsed;
          renderYear(2026);
        }
      } catch (e) {
        console.warn('Initial data parse notice:', e);
      }
    }

    // 2. Fetch fresh updates from API endpoint
    try {
      const res = await fetch(endpoint, { headers: { 'Accept': 'application/json' } });
      if (res.ok) {
        const fresh = await res.json();
        if (fresh && Array.isArray(fresh.contributions) && fresh.contributions.length > 0) {
          cachedData = fresh;
          renderYear(currentYear);
        }
      }
    } catch (err) {
      if (!cachedData) {
        console.warn('Could not fetch GitHub activity:', err);
        if (calendarStage) {
          calendarStage.innerHTML = '<p class="calendar-skeleton">Could not load live GitHub activity at this time. Please visit <a href="https://github.com/Vonnnnnnnnn05" target="_blank" class="text-link">GitHub ↗</a>.</p>';
        }
      }
    }
  };

  initGitHubActivity();

  // Align Experience additional works gallery and Capstone defense subphotos level on desktop
  const alignExperienceGalleries = () => {
    const leftPhotos = document.querySelector('.additional-works-photos');
    const rightContainer = document.querySelector('.capstone-sub-container');
    const rightPhotos = document.querySelector('.capstone-subphotos');

    if (!leftPhotos || !rightPhotos) return;

    if (window.innerWidth <= 800) {
      if (rightContainer) rightContainer.style.marginTop = '';
      rightPhotos.style.marginTop = '';
      leftPhotos.style.marginTop = '';
      return;
    }

    // Reset to calculate natural positions
    if (rightContainer) rightContainer.style.marginTop = '18px';
    rightPhotos.style.marginTop = '';
    leftPhotos.style.marginTop = '';

    const leftRect = leftPhotos.getBoundingClientRect();
    const rightRect = rightPhotos.getBoundingClientRect();
    const diff = leftRect.top - rightRect.top;

    if (Math.abs(diff) > 1) {
      if (diff > 0) {
        if (rightContainer) {
          const baseMargin = 18;
          rightContainer.style.marginTop = `${baseMargin + diff}px`;
        } else {
          rightPhotos.style.marginTop = `${diff}px`;
        }
      } else {
        leftPhotos.style.marginTop = `${-diff}px`;
      }
    }
  };

  window.addEventListener('load', alignExperienceGalleries);
  window.addEventListener('resize', alignExperienceGalleries);
  if (document.fonts && document.fonts.ready) {
    document.fonts.ready.then(alignExperienceGalleries);
  }
  setTimeout(alignExperienceGalleries, 350);
  setTimeout(alignExperienceGalleries, 1200);

  if ('serviceWorker' in navigator) window.addEventListener('load', () => navigator.serviceWorker.register(document.querySelector('meta[name="service-worker-url"]').content).catch(() => {}));
})();
