(() => {
  const menuButton = document.querySelector('.menu-toggle');
  const nav = document.querySelector('.site-nav');
  const navLinks = [...document.querySelectorAll('.site-nav a')];
  const sections = navLinks.map((link) => document.querySelector(link.getAttribute('href'))).filter(Boolean);
  const backToTop = document.querySelector('.back-to-top');
  menuButton?.addEventListener('click', () => { const open = nav.classList.toggle('open'); menuButton.setAttribute('aria-expanded', String(open)); });
  navLinks.forEach((link) => link.addEventListener('click', () => { nav?.classList.remove('open'); menuButton?.setAttribute('aria-expanded', 'false'); }));
  const observer = new IntersectionObserver((entries) => entries.forEach((entry) => { if (entry.isIntersecting) entry.target.classList.add('visible'); }), { threshold: 0.12 });
  document.querySelectorAll('.reveal').forEach((item) => observer.observe(item));
  const navObserver = new IntersectionObserver((entries) => entries.forEach((entry) => { if (entry.isIntersecting) navLinks.forEach((link) => link.classList.toggle('active', link.getAttribute('href') === `#${entry.target.id}`)); }), { rootMargin: '-30% 0px -60% 0px', threshold: 0 });
  sections.forEach((section) => navObserver.observe(section));
  window.addEventListener('scroll', () => backToTop?.classList.toggle('visible', window.scrollY > 600), { passive: true });
  backToTop?.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
  const chatToggle = document.querySelector('.chat-toggle');
  const chatPanel = document.querySelector('.chat-panel');
  const chatClose = document.querySelector('.chat-close');
  const chatForm = document.querySelector('.chat-form');
  const chatInput = document.querySelector('#chat-input');
  const chatMessages = document.querySelector('.chat-messages');
  const setChatOpen = (open) => {
    if (!chatPanel || !chatToggle) return;
    chatPanel.hidden = !open;
    chatToggle.setAttribute('aria-expanded', String(open));
    if (open) chatInput?.focus();
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
      const response = await fetch('/api/chat', { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ message: text }) });
      const data = await response.json();
      pending.textContent = data.reply || data.error || 'I could not generate a response. Please email Von directly.';
    } catch {
      pending.textContent = 'The assistant is unavailable right now. Please email Von directly.';
    } finally {
      submit.disabled = false;
      chatInput.focus();
    }
  }
  chatForm?.addEventListener('submit', (event) => { event.preventDefault(); sendMessage(chatInput.value); });
  document.addEventListener('keydown', (event) => { if (event.key === 'Escape' && chatPanel && !chatPanel.hidden) setChatOpen(false); });
  if ('serviceWorker' in navigator) window.addEventListener('load', () => navigator.serviceWorker.register('/sw.js').catch(() => {}));
})();
