<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="chat-endpoint" content="{{ route('chat') }}">

  <meta name="service-worker-url" content="{{ asset('sw.js') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="Von Esson A. Vergara — IT student and developer building practical web systems and Arduino projects.">
  <link rel="canonical" href="{{ url('/') }}">
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ url('/') }}">
  <meta property="og:title" content="Von Vergara — Web Developer">
  <meta property="og:description"
    content="A portfolio of PHP, MySQL, JavaScript, and hardware systems built by Von Esson Vergara.">
  <meta property="og:image" content="{{ asset('image.png') }}">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="theme-color" content="#ffffff">
  <script>try { const t = localStorage.getItem('portfolio-theme'); document.documentElement.dataset.theme = t === 'dark' ? 'dark' : 'light' } catch (e) { }</script>
  <link rel="manifest" href="{{ asset('manifest.json?v=3') }}">
  <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg?v=3') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png?v=3') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png?v=3') }}">
  <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('images/vt-logo-badge.png?v=3') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/vt-logo-badge.png?v=3') }}">
  <link rel="shortcut icon" href="{{ asset('favicon.ico?v=3') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('styles.css') }}">
  <link rel="stylesheet" href="{{ asset('enhancements.css?v=28') }}">
  <style>
    body.splash-active {
      overflow: hidden !important;
      height: 100vh !important;
    }

    #splash-screen {
      position: fixed;
      inset: 0;
      width: 100vw;
      height: 100vh;
      background-color: #ffffff;
      z-index: 999999;
      display: flex;
      align-items: center;
      justify-content: center;
    }
  </style>
  <title>Von Vergara — Developer Portfolio</title>
  <script
    type="application/ld+json">{"@@context":"https://schema.org","@@type":"Person","name":"Von Esson Vergara","url":"{{ url('/') }}","image":"{{ asset('image.png') }}","jobTitle":"Information Technology Student and Developer","email":"mailto:von.vergara.399@gmail.com","sameAs":["https://github.com/Vonnnnnnnnn05","https://ph.linkedin.com/in/von-esson-vergara-8454063b8"],"knowsAbout":["PHP","JavaScript","MySQL","CodeIgniter","Laravel","Arduino","Microsoft Azure","Nginx","Ubuntu"]}</script>
</head>

<body class="splash-active">
  <!-- Splash Screen / Preloader -->
  <div id="splash-screen" class="splash-screen" role="status" aria-live="polite"
    aria-label="Loading Von Tech Portfolio">
    <div class="splash-backdrop">
      <div class="splash-cyber-grid"></div>
      <div class="splash-radial-glow"></div>
    </div>
    <div class="splash-container">
      <div class="splash-badge-wrap">
        <div class="splash-pulse-rings">
          <div class="splash-ring-wave splash-ring-wave-1"></div>
          <div class="splash-ring-wave splash-ring-wave-2"></div>
        </div>
        <div class="splash-orbit-outer"></div>
        <div class="splash-orbit-inner"></div>
        <div class="splash-logo-core">
          <img src="{{ asset('images/vt-logo-dark.png?v=5') }}" alt="Von Tech Logo" class="splash-logo-image"
            width="112" height="112">
        </div>
      </div>
      <div class="splash-text-group">
        <div class="splash-title">
          <span class="brand-von">VON</span><span class="brand-tech">TECH</span>
        </div>
        <p class="splash-caption">VON ESSON VERGARA &bull; IT &bull; SYSTEMS</p>
      </div>
      <div class="splash-progress-container">
        <div class="splash-progress-track">
          <div class="splash-progress-bar" id="splash-progress-bar"></div>
        </div>
        <div class="splash-status-row">
          <span class="splash-status-label" id="splash-status-label">INITIALIZING SYSTEM...</span>
          <span class="splash-percent" id="splash-percent">0%</span>
        </div>
      </div>
      <button type="button" class="splash-skip" id="splash-skip-btn" aria-label="Skip splash screen">
        <span>Skip</span>
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
          stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <polyline points="9 18 15 12 9 6" />
        </svg>
      </button>
    </div>
  </div>

  <a class="skip-link" href="#main-content">Skip to content</a>
  <header class="site-header">
    <div class="shell nav-wrap">
      <div class="wordmark" aria-label="Von Vergara">
        <img src="{{ asset('images/vt-logo-badge.png?v=3') }}" alt="" class="nav-brand-icon" width="28" height="28">
        <span>Von Esson Vergara<span>.</span></span>
      </div>
      <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="site-nav">Menu</button>
      <nav id="site-nav" class="site-nav" aria-label="Main navigation">
        <a href="#about">About</a><a href="#work">Work</a><a
          href="#experience">Experience</a><a href="#contact">Contact</a>
      </nav>
      <button class="theme-toggle" type="button" aria-label="Switch to dark mode" aria-pressed="false">
        <svg class="theme-icon theme-icon-moon" aria-hidden="true" viewBox="0 0 24 24">
          <path d="M20.2 15.7A8.5 8.5 0 0 1 8.3 3.8 8.5 8.5 0 1 0 20.2 15.7Z" />
        </svg>
        <svg class="theme-icon theme-icon-sun" aria-hidden="true" viewBox="0 0 24 24">
          <circle cx="12" cy="12" r="3.5" />
          <path
            d="M12 2v2M12 20v2M4.93 4.93l1.42 1.42M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.42-1.41M17.66 6.34l1.41-1.41" />
        </svg>
      </button>
      <a class="nav-cta" href="{{ asset('Von_Esson_Vergara_Resume.pdf') }}" target="_blank"
        rel="noopener noreferrer">View Resume <span aria-hidden="true">↗</span></a>
    </div>
  </header>
  <main id="main-content">
    <section id="top" class="hero shell reveal">
      <div class="hero-copy">
        <p class="eyebrow">IT student · Web developer</p>
        <h1>Von Esson<br>Vergara<span>.</span></h1>
        <p class="hero-summary">I build PHP and MySQL applications that turn manual school and small-business workflows
          into dependable digital systems.</p>
        <p class="availability"><span aria-hidden="true"></span> Open to internships, junior opportunities, and project
          collaborations.</p>
        <div class="hero-actions"><a class="button button-primary" href="#work">View my best work <span
              aria-hidden="true">↓</span></a><a class="button button-secondary"
            href="{{ asset('Von_Esson_Vergara_Resume.pdf') }}" download>Download résumé</a></div>
        <ul class="social-list" aria-label="Professional links">
          <li><a href="https://github.com/Vonnnnnnnnn05" target="_blank" rel="noopener noreferrer">GitHub ↗</a></li>
          <li><a href="https://ph.linkedin.com/in/von-esson-vergara-8454063b8" target="_blank"
              rel="noopener noreferrer">LinkedIn ↗</a></li>
        </ul>
      </div>
      <figure class="portrait-frame"><img src="{{ asset('image.png') }}" width="1024" height="1055"
          alt="Portrait of Von Esson Vergara"></figure>
    </section>
    <section id="about" class="shell section reveal">
      <div class="section-label">01 / About</div>
      <div class="about-grid">
        <h2>I turn real-world processes into usable digital tools.</h2>
        <div>
          <p>I am an Information Technology student and developer with a focus on web systems, databases, and Arduino
            integration. My work combines thoughtful interfaces with the practical details that make systems dependable.
          </p>
          <p>I am especially interested in work that connects people, data, and hardware—from clinic management and
            inventory systems to connected hardware projects.</p>
        </div>
      </div>
      <div class="capability-grid" aria-label="Capabilities">
        <article>
          <div class="capability-header">
            <span>01</span>
            <svg class="capability-icon" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <rect x="2" y="3" width="20" height="14" rx="2"></rect>
              <line x1="8" y1="21" x2="16" y2="21"></line>
              <line x1="12" y1="17" x2="12" y2="21"></line>
              <polyline points="9 8 7 10 9 12"></polyline>
              <polyline points="15 8 17 10 15 12"></polyline>
            </svg>
          </div>
          <h3>Web systems</h3>
          <p>PHP, CodeIgniter, Laravel, JavaScript, and responsive interfaces.</p>
        </article>
        <article>
          <div class="capability-header">
            <span>02</span>
            <svg class="capability-icon" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
              <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
              <path d="M3 12c0 1.66 4 3 9 3s9-1.34 9-3"></path>
            </svg>
          </div>
          <h3>Data &amp; workflows</h3>
          <p>MySQL-backed management tools, reporting, tracking, and automation.</p>
        </article>
        <article>
          <div class="capability-header">
            <span>03</span>
            <svg class="capability-icon" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <rect x="4" y="4" width="16" height="16" rx="2"></rect>
              <rect x="9" y="9" width="6" height="6"></rect>
              <line x1="9" y1="1" x2="9" y2="4"></line>
              <line x1="15" y1="1" x2="15" y2="4"></line>
              <line x1="9" y1="20" x2="9" y2="23"></line>
              <line x1="15" y1="20" x2="15" y2="23"></line>
              <line x1="20" y1="9" x2="23" y2="9"></line>
              <line x1="20" y1="14" x2="23" y2="14"></line>
              <line x1="1" y1="9" x2="4" y2="9"></line>
              <line x1="1" y1="14" x2="4" y2="14"></line>
            </svg>
          </div>
          <h3>Hardware integration</h3>
          <p>Arduino, RFID, sensors, and database-connected prototypes.</p>
        </article>
      </div>
      <!-- Tech Stack — Single RTL Marquee (all techs compiled) -->
      <div class="tech-marquee-wrapper" aria-label="Technologies and frameworks">
        <div class="tech-marquee-header">
          <span class="tech-marquee-label">Technologies I work with</span>
        </div>

        <div class="tech-marquee-row tech-marquee-rtl" aria-label="Technologies">
          <div class="tech-marquee-track">

            <!-- Primary set -->
            <div class="tech-marquee-group">
              <article class="tech-card"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/php/php-original.svg" width="24" height="24" loading="lazy" alt="PHP logo"><strong>PHP</strong></article>
              <article class="tech-card"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/javascript/javascript-original.svg" width="24" height="24" loading="lazy" alt="JavaScript logo"><strong>JavaScript</strong></article>
              <article class="tech-card"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/laravel/laravel-original.svg" width="24" height="24" loading="lazy" alt="Laravel logo"><strong>Laravel</strong></article>
              <article class="tech-card"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/codeigniter/codeigniter-plain.svg" width="24" height="24" loading="lazy" alt="CodeIgniter logo"><strong>CodeIgniter 4</strong></article>
              <article class="tech-card"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/bootstrap/bootstrap-original.svg" width="24" height="24" loading="lazy" alt="Bootstrap logo"><strong>Bootstrap</strong></article>
              <article class="tech-card"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/tailwindcss/tailwindcss-original.svg" width="24" height="24" loading="lazy" alt="Tailwind CSS logo"><strong>Tailwind CSS</strong></article>
              <article class="tech-card"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/composer/composer-original.svg" width="24" height="24" loading="lazy" alt="Composer logo"><strong>Composer</strong></article>
              <article class="tech-card"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/mysql/mysql-original.svg" width="24" height="24" loading="lazy" alt="MySQL logo"><strong>MySQL</strong></article>
              <article class="tech-card"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/git/git-original.svg" width="24" height="24" loading="lazy" alt="Git logo"><strong>Git</strong></article>
              <article class="tech-card"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/arduino/arduino-original.svg" width="24" height="24" loading="lazy" alt="Arduino logo"><strong>Arduino</strong></article>
              <article class="tech-card"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/nginx/nginx-original.svg" width="24" height="24" loading="lazy" alt="Nginx logo"><strong>Nginx</strong></article>
              <article class="tech-card"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/ubuntu/ubuntu-original.svg" width="24" height="24" loading="lazy" alt="Ubuntu logo"><strong>Ubuntu</strong></article>
              <article class="tech-card"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/azure/azure-original.svg" width="24" height="24" loading="lazy" alt="Azure logo"><strong>Azure</strong></article>
              <article class="tech-card tech-card-aws"><svg class="tech-icon" width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M13.527 21.529c0 .528.057 1.055.17 1.527.113.527.283.998.51 1.413.084.169.113.338.113.508 0 .22-.113.44-.396.66l-1.303.868c-.17.112-.34.168-.509.168-.226 0-.396-.112-.566-.28a5.95 5.95 0 01-.679-.882 14.9 14.9 0 01-.566-1.133c-1.416 1.667-3.172 2.5-5.267 2.5-1.53 0-2.72-.44-3.624-1.32-.905-.882-1.36-2.07-1.36-3.555 0-1.57.566-2.84 1.698-3.835 1.132-.995 2.605-1.47 4.473-1.47.622 0 1.245.056 1.924.14.68.085 1.36.225 2.095.395v-1.33c0-1.385-.283-2.35-.906-2.896-.622-.54-1.698-.817-3.17-.817-.679 0-1.359.084-2.038.253-.679.169-1.359.395-2.038.65-.283.112-.51.169-.623.197a1.067 1.067 0 01-.283.028c-.226 0-.396-.197-.396-.59v-.938c0-.309.056-.535.17-.675.112-.14.339-.281.622-.422.679-.338 1.472-.619 2.378-.826.905-.225 1.867-.338 2.887-.338 2.208 0 3.794.5 4.812 1.47 1.019.97 1.528 2.47 1.528 4.47v5.882h-.057zm-7.247 2.714c.622 0 1.245-.112 1.924-.338.679-.225 1.302-.619 1.812-1.17.283-.338.51-.732.622-1.161.113-.422.17-.938.17-1.526v-.732c-.51-.14-1.075-.253-1.641-.309a14.73 14.73 0 00-1.641-.112c-1.188 0-2.038.225-2.66.703-.623.478-.905 1.14-.905 2.013 0 .788.17 1.4.566 1.808.396.395 1.019.624 1.753.624zm14.044 1.892c-.283 0-.51-.056-.622-.197-.113-.112-.226-.365-.34-.732l-3.68-12.082c-.113-.422-.17-.704-.17-.845 0-.338.17-.507.509-.507h1.98c.283 0 .51.057.623.197.113.113.225.338.339.732l2.605 10.33 2.435-10.33c.113-.394.226-.62.34-.732.112-.113.339-.197.622-.197h1.585c.283 0 .51.057.623.197.113.113.225.338.34.732l2.434 10.47 2.66-10.47c.113-.394.227-.62.34-.732.112-.113.339-.197.622-.197h1.924c.34 0 .51.169.51.507 0 .112-.03.225-.057.366-.028.112-.113.337-.226.703l-3.794 12.082c-.113.394-.227.619-.34.732-.112.112-.339.197-.622.197h-1.698c-.283 0-.51-.056-.622-.197-.113-.14-.226-.394-.34-.759l-2.434-10.19-2.378 10.19c-.113.394-.226.619-.34.76-.112.14-.339.196-.622.196h-1.698zm19.65.394c-1.019 0-2.038-.14-3.001-.394-.963-.253-1.698-.506-2.208-.788-.283-.169-.453-.338-.509-.506a1.277 1.277 0 01-.113-.507v-.97c0-.394.17-.59.509-.59.113 0 .226 0 .34.056.112.057.282.113.452.197.622.281 1.302.506 2.038.647.735.14 1.471.225 2.207.225 1.19 0 2.095-.197 2.774-.59.679-.394 1.019-.995 1.019-1.779 0-.507-.17-.938-.509-1.3-.338-.365-.962-.704-1.924-1.02l-2.774-.87c-1.358-.422-2.378-1.048-3.001-1.86-.622-.815-.963-1.715-.963-2.741 0-.788.17-1.49.566-2.097.396-.619.905-1.153 1.528-1.575.622-.45 1.302-.76 2.095-1.013.792-.225 1.64-.338 2.49-.338.396 0 .849.028 1.246.084.396.057.792.14 1.188.225.37.084.736.197 1.075.338.339.141.623.281.849.422.283.197.51.394.623.59.113.197.17.422.17.703v.903c0 .394-.17.59-.51.59-.17 0-.452-.085-.848-.281-.679-.31-1.473-.563-2.208-.704-.736-.14-1.471-.225-2.208-.225-.963 0-1.754.168-2.264.478-.509.31-.792.787-.792 1.527 0 .506.17.9.509 1.244.339.338.962.675 1.924.98l2.717.871c1.302.422 2.321 1.02 2.943 1.804.623.787.906 1.675.906 2.656 0 .844-.17 1.63-.566 2.29-.396.675-.905 1.237-1.584 1.715-.68.479-1.472.844-2.378 1.1-.905.26-1.868.395-2.887.395z" fill="currentColor"/></svg><strong>AWS EC2</strong></article>
            </div>

            <!-- Duplicate for seamless loop (aria-hidden) -->
            <div class="tech-marquee-group" aria-hidden="true">
              <article class="tech-card"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/php/php-original.svg" width="24" height="24" loading="lazy" alt=""><strong>PHP</strong></article>
              <article class="tech-card"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/javascript/javascript-original.svg" width="24" height="24" loading="lazy" alt=""><strong>JavaScript</strong></article>
              <article class="tech-card"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/laravel/laravel-original.svg" width="24" height="24" loading="lazy" alt=""><strong>Laravel</strong></article>
              <article class="tech-card"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/codeigniter/codeigniter-plain.svg" width="24" height="24" loading="lazy" alt=""><strong>CodeIgniter 4</strong></article>
              <article class="tech-card"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/bootstrap/bootstrap-original.svg" width="24" height="24" loading="lazy" alt=""><strong>Bootstrap</strong></article>
              <article class="tech-card"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/tailwindcss/tailwindcss-original.svg" width="24" height="24" loading="lazy" alt=""><strong>Tailwind CSS</strong></article>
              <article class="tech-card"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/composer/composer-original.svg" width="24" height="24" loading="lazy" alt=""><strong>Composer</strong></article>
              <article class="tech-card"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/mysql/mysql-original.svg" width="24" height="24" loading="lazy" alt=""><strong>MySQL</strong></article>
              <article class="tech-card"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/git/git-original.svg" width="24" height="24" loading="lazy" alt=""><strong>Git</strong></article>
              <article class="tech-card"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/arduino/arduino-original.svg" width="24" height="24" loading="lazy" alt=""><strong>Arduino</strong></article>
              <article class="tech-card"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/nginx/nginx-original.svg" width="24" height="24" loading="lazy" alt=""><strong>Nginx</strong></article>
              <article class="tech-card"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/ubuntu/ubuntu-original.svg" width="24" height="24" loading="lazy" alt=""><strong>Ubuntu</strong></article>
              <article class="tech-card"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/azure/azure-original.svg" width="24" height="24" loading="lazy" alt=""><strong>Azure</strong></article>
              <article class="tech-card tech-card-aws"><svg class="tech-icon" width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M13.527 21.529c0 .528.057 1.055.17 1.527.113.527.283.998.51 1.413.084.169.113.338.113.508 0 .22-.113.44-.396.66l-1.303.868c-.17.112-.34.168-.509.168-.226 0-.396-.112-.566-.28a5.95 5.95 0 01-.679-.882 14.9 14.9 0 01-.566-1.133c-1.416 1.667-3.172 2.5-5.267 2.5-1.53 0-2.72-.44-3.624-1.32-.905-.882-1.36-2.07-1.36-3.555 0-1.57.566-2.84 1.698-3.835 1.132-.995 2.605-1.47 4.473-1.47.622 0 1.245.056 1.924.14.68.085 1.36.225 2.095.395v-1.33c0-1.385-.283-2.35-.906-2.896-.622-.54-1.698-.817-3.17-.817-.679 0-1.359.084-2.038.253-.679.169-1.359.395-2.038.65-.283.112-.51.169-.623.197a1.067 1.067 0 01-.283.028c-.226 0-.396-.197-.396-.59v-.938c0-.309.056-.535.17-.675.112-.14.339-.281.622-.422.679-.338 1.472-.619 2.378-.826.905-.225 1.867-.338 2.887-.338 2.208 0 3.794.5 4.812 1.47 1.019.97 1.528 2.47 1.528 4.47v5.882h-.057zm-7.247 2.714c.622 0 1.245-.112 1.924-.338.679-.225 1.302-.619 1.812-1.17.283-.338.51-.732.622-1.161.113-.422.17-.938.17-1.526v-.732c-.51-.14-1.075-.253-1.641-.309a14.73 14.73 0 00-1.641-.112c-1.188 0-2.038.225-2.66.703-.623.478-.905 1.14-.905 2.013 0 .788.17 1.4.566 1.808.396.395 1.019.624 1.753.624zm14.044 1.892c-.283 0-.51-.056-.622-.197-.113-.112-.226-.365-.34-.732l-3.68-12.082c-.113-.422-.17-.704-.17-.845 0-.338.17-.507.509-.507h1.98c.283 0 .51.057.623.197.113.113.225.338.339.732l2.605 10.33 2.435-10.33c.113-.394.226-.62.34-.732.112-.113.339-.197.622-.197h1.585c.283 0 .51.057.623.197.113.113.225.338.34.732l2.434 10.47 2.66-10.47c.113-.394.227-.62.34-.732.112-.113.339-.197.622-.197h1.924c.34 0 .51.169.51.507 0 .112-.03.225-.057.366-.028.112-.113.337-.226.703l-3.794 12.082c-.113.394-.227.619-.34.732-.112.112-.339.197-.622.197h-1.698c-.283 0-.51-.056-.622-.197-.113-.14-.226-.394-.34-.759l-2.434-10.19-2.378 10.19c-.113.394-.226.619-.34.76-.112.14-.339.196-.622.196h-1.698zm19.65.394c-1.019 0-2.038-.14-3.001-.394-.963-.253-1.698-.506-2.208-.788-.283-.169-.453-.338-.509-.506a1.277 1.277 0 01-.113-.507v-.97c0-.394.17-.59.509-.59.113 0 .226 0 .34.056.112.057.282.113.452.197.622.281 1.302.506 2.038.647.735.14 1.471.225 2.207.225 1.19 0 2.095-.197 2.774-.59.679-.394 1.019-.995 1.019-1.779 0-.507-.17-.938-.509-1.3-.338-.365-.962-.704-1.924-1.02l-2.774-.87c-1.358-.422-2.378-1.048-3.001-1.86-.622-.815-.963-1.715-.963-2.741 0-.788.17-1.49.566-2.097.396-.619.905-1.153 1.528-1.575.622-.45 1.302-.76 2.095-1.013.792-.225 1.64-.338 2.49-.338.396 0 .849.028 1.246.084.396.057.792.14 1.188.225.37.084.736.197 1.075.338.339.141.623.281.849.422.283.197.51.394.623.59.113.197.17.422.17.703v.903c0 .394-.17.59-.51.59-.17 0-.452-.085-.848-.281-.679-.31-1.473-.563-2.208-.704-.736-.14-1.471-.225-2.208-.225-.963 0-1.754.168-2.264.478-.509.31-.792.787-.792 1.527 0 .506.17.9.509 1.244.339.338.962.675 1.924.98l2.717.871c1.302.422 2.321 1.02 2.943 1.804.623.787.906 1.675.906 2.656 0 .844-.17 1.63-.566 2.29-.396.675-.905 1.237-1.584 1.715-.68.479-1.472.844-2.378 1.1-.905.26-1.868.395-2.887.395z" fill="currentColor"/></svg><strong>AWS EC2</strong></article>
            </div>

          </div>
        </div>
      </div>
    </section>
    <section id="work" class="shell section work-section reveal">
      <div class="section-heading">
        <div class="section-label">02 / Selected work</div>
        <p>Three systems that show how I approach real operational problems.</p>
      </div>
      <div class="selected-grid">
        <article class="project"><a class="project-image" href="https://scholarship.vonessonvergara.me/" target="_blank"
            rel="noopener noreferrer" title="View live Scholarship Data Profiling system"><img
              src="{{ asset('images/sdp.png') }}" width="1898" height="866" loading="lazy"
              alt="Dashboard of the Scholarship Data Profiling System"><span class="live-pill"><span class="live-dot"
                aria-hidden="true"></span>Live Demo</span></a>
          <div class="project-meta"><span>01</span><span>Records &amp; analytics</span></div>
          <h2>Scholarship Data Profiling</h2>
          <p class="project-lead">A centralized workspace for maintaining scholar records and supporting program
            monitoring.</p>
          <dl class="case-study">
            <div>
              <dt>Problem</dt>
              <dd>Scholar information, reporting, and compliance data can be difficult to review when handled across
                disconnected records.</dd>
            </div>
            <div>
              <dt>Approach</dt>
              <dd>Combined structured profiles, reporting tools, and visual analytics in one MySQL-backed system.</dd>
            </div>
            <div>
              <dt>Key features</dt>
              <dd>Scholar profiles · Reports · Analytics dashboard</dd>
            </div>
          </dl>
          <div class="tag-row"><span>PHP</span><span>MySQL</span><span>Chart.js</span></div>
          <div class="project-actions"><a class="project-link"
              href="https://github.com/Vonnnnnnnnn05/Scholarship-Data-Profiling-System" target="_blank"
              rel="noopener noreferrer">Explore repository ↗</a><a class="project-link project-live-link"
              href="https://scholarship.vonessonvergara.me/" target="_blank" rel="noopener noreferrer"><span
                class="live-dot" aria-hidden="true"></span>Live demo ↗</a></div>
        </article>
        <article class="project"><a class="project-image" href="https://carwash.vongarces.tech/" target="_blank"
            rel="noopener noreferrer" title="View live Carwash CRM system"><img src="{{ asset('images/carwash.png') }}" width="1919" height="878"
              loading="lazy" alt="Interface of the Carwash CRM system"><span class="live-pill"><span class="live-dot"
                aria-hidden="true"></span>Live Demo</span></a>
          <div class="project-meta"><span>02</span><span>Customer workflow</span></div>
          <h2>Carwash CRM</h2>
          <p class="project-lead">An operational system that keeps customer details, services, and visit history
            together.</p>
          <dl class="case-study">
            <div>
              <dt>Problem</dt>
              <dd>Manual customer and transaction records make it harder to follow service history and daily activity.
              </dd>
            </div>
            <div>
              <dt>Approach</dt>
              <dd>Designed a connected workflow around reusable customer records and service transactions.</dd>
            </div>
            <div>
              <dt>Key features</dt>
              <dd>Customer records · Transactions · Visit history</dd>
            </div>
          </dl>
          <div class="tag-row"><span>PHP</span><span>MySQL</span><span>JavaScript</span></div>
          <div class="project-actions"><a class="project-link"
              href="https://github.com/Vonnnnnnnnn05/Carwash-Management-System" target="_blank"
              rel="noopener noreferrer">Explore repository ↗</a><a class="project-link project-live-link"
              href="https://carwash.vongarces.tech/" target="_blank" rel="noopener noreferrer"><span
                class="live-dot" aria-hidden="true"></span>Live demo ↗</a></div>
        </article>
        <article class="project"><a class="project-image" href="https://dentaflow.vonessonvergara.me/" target="_blank"
            rel="noopener noreferrer" title="View live DentaFlow system"><img src="{{ asset('images/dentaflow.png') }}"
              width="1024" height="477" loading="lazy"
              alt="Landing page and interface of the DentaFlow Dental Clinic Management System"><span
              class="live-pill"><span class="live-dot" aria-hidden="true"></span>Live Demo</span></a>
          <div class="project-meta"><span>03</span><span>Clinic management</span></div>
          <h2>DentaFlow</h2>
          <p class="project-lead">A web-based dental clinic management system that centralizes patient profiles,
            appointments, treatment records, and billing.</p>
          <dl class="case-study">
            <div>
              <dt>Problem</dt>
              <dd>Dental clinics struggle with scattered paper records, disorganized appointment schedules, and manual
                payment tracking.</dd>
            </div>
            <div>
              <dt>Approach</dt>
              <dd>Built a centralized administrative web system to manage patient records, appointments, treatments,
                medical history, and payments in one place.</dd>
            </div>
            <div>
              <dt>Key features</dt>
              <dd>Patient profiles · Appointments · Treatment records · Billing</dd>
            </div>
          </dl>
          <div class="tag-row"><span>PHP</span><span>MySQL</span><span>Azure</span><span>Nginx</span></div>
          <div class="project-actions"><a class="project-link" href="https://github.com/Vonnnnnnnnn05/DentComs"
              target="_blank" rel="noopener noreferrer">Explore repository ↗</a><a
              class="project-link project-live-link" href="https://dentaflow.vonessonvergara.me/" target="_blank"
              rel="noopener noreferrer"><span class="live-dot" aria-hidden="true"></span>Live demo ↗</a></div>
        </article>
      </div>
      <div class="additional-work">
        <div class="section-heading">
          <div class="section-label">Additional work</div>
          <p>Technical services, practical client work, web systems, and hardware prototypes.</p>
        </div>

        <div class="work-index">
          <div class="work-group">
            <h3>Web systems</h3>
            <a href="https://github.com/Vonnnnnnnnn05/CodeIgnighter4-Crud" target="_blank"
              rel="noopener noreferrer"><span>Product Management System</span><small>CodeIgniter 4 ·
                MySQL</small><b>↗</b></a>
            <a href="https://scholarship.vonessonvergara.me/" target="_blank"
              rel="noopener noreferrer"><span>Scholarship Eligibility Checker</span><small>PHP · MySQL · Live
                demo</small><b>↗</b></a>
            <a href="https://github.com/Vonnnnnnnnn05/Weather-API-Integration" target="_blank"
              rel="noopener noreferrer"><span>Weather Forecasting System</span><small>CodeIgniter 4 ·
                API</small><b>↗</b></a>
            <a href="https://github.com/Vonnnnnnnnn05/Boarding-House-V2" target="_blank"
              rel="noopener noreferrer"><span>Boarding House Management</span><small>PHP · MySQL</small><b>↗</b></a>
            <a href="https://github.com/Vonnnnnnnnn05/Healthworker-Patient-System" target="_blank"
              rel="noopener noreferrer"><span>Healthcare Management System</span><small>PHP · MySQL</small><b>↗</b></a>
            <a href="https://github.com/Vonnnnnnnnn05/cosmetics-Inventory-Management-System" target="_blank"
              rel="noopener noreferrer"><span>Inventory Management System</span><small>PHP ·
                Chart.js</small><b>↗</b></a>
          </div>
          <div class="work-group">
            <h3>Arduino &amp; Hardware</h3>
            <a href="https://github.com/Vonnnnnnnnn05/RFID-ATTENDANCE-WITH-WEB-UI-AND-DATABASE" target="_blank"
              rel="noopener noreferrer"><span>RFID Attendance System</span><small>Arduino · RFID ·
                MySQL</small><b>↗</b></a>
            <a href="https://github.com/Vonnnnnnnnn05/Arduino-Reaction-Time-Game-With-Web-UI-and-Database" target="_blank"
              rel="noopener noreferrer"><span>Reaction Time Game</span><small>Arduino · Web UI ·
                MySQL</small><b>↗</b></a>
            <a href="https://github.com/Vonnnnnnnnn05/Arduino-Fortune-Teller-With-Web-UI-and-Database" target="_blank"
              rel="noopener noreferrer"><span>Fortune Teller System</span><small>Arduino · Web UI ·
                MySQL</small><b>↗</b></a>
            <a href="https://github.com/Vonnnnnnnnn05/Motion-Detector-with-Web-Based-UI-and-Database" target="_blank"
              rel="noopener noreferrer"><span>Motion Detector System</span><small>Arduino · PIR ·
                MySQL</small><b>↗</b></a>
            <a href="https://github.com/Vonnnnnnnnn05/Security-System-Using-Keypad-with-Web-UI-and-Database" target="_blank"
              rel="noopener noreferrer"><span>Keypad Security System</span><small>Arduino · Keypad ·
                MySQL</small><b>↗</b></a>
            <a href="https://github.com/Vonnnnnnnnn05/LDR-System-with-Web-UI-and-Database" target="_blank"
              rel="noopener noreferrer"><span>LDR Sensor System</span><small>Arduino · LDR ·
                MySQL</small><b>↗</b></a>
          </div>
          <div class="work-group">
            <h3>Domains &amp; Hosting</h3>
            <a href="https://scholarship.vonessonvergara.me/" target="_blank" rel="noopener noreferrer"><span>scholarship.vonessonvergara.me</span><small>Live · PHP · MySQL · Azure</small><b>↗</b></a>
            <a href="https://dentaflow.vonessonvergara.me/" target="_blank" rel="noopener noreferrer"><span>dentaflow.vonessonvergara.me</span><small>Live · Laravel · Nginx · Azure</small><b>↗</b></a>
            <a href="https://carwash.vongarces.tech/" target="_blank" rel="noopener noreferrer"><span>carwash.vongarces.tech</span><small>Live · PHP · MySQL · AWS EC2</small><b>↗</b></a>
            <a href="https://vonessonvergara.me/" target="_blank" rel="noopener noreferrer"><span>vonessonvergara.me</span><small>Portfolio · AWS EC2 · Nginx</small><b>↗</b></a>
          </div>
          <div class="work-group">
            <h3>Technical &amp; IT Services</h3>
            <a href="#experience" class="work-service-item"><span>Contract Making (Rabbitry)</span><small>Documentation
                · MS Word</small><b>View ↘</b></a>
            <a href="#experience" class="work-service-item"><span>Reformatting Windows</span><small>OS Clean Install ·
                Recovery</small><b>View ↘</b></a>
            <a href="#experience" class="work-service-item"><span>Microsoft Office Setup</span><small>Download &amp;
                Activation</small><b>View ↘</b></a>
            <a href="#experience" class="work-service-item"><span>Web Prototyping</span><small>HTML · CSS · JS ·
                Bootstrap · Tailwind</small><b>View ↘</b></a>
          </div>
        </div>
      </div>
    </section>
    <section id="experience" class="shell section reveal">
      <div class="section-label">03 / Experience &amp; education</div>
      <div class="resume-grid">
        <div>
          <h2>Experience</h2>
          <ol class="timeline">
            <li>
              <h3>Encoder / Inventory Manager</h3>
              <p>Alocada Enterprises</p>
              <span>Managed inventory data and improved stock-management workflows through digital tools.</span>
              <div class="leadership-gallery">
                <div class="leadership-gallery-heading"><strong>Inventory data operations</strong><span>Encode · Verify
                    · Label</span></div>
                <div class="encoding-photos">
                  <figure><img src="{{ asset('encoding/3e722534-94c3-49df-983e-1b0d50a564e6.jpg') }}" width="950"
                      height="1920" loading="lazy"
                      alt="Inventory master list with product descriptions and prices being encoded"></figure>
                  <figure><img src="{{ asset('encoding/437ce2a5-4f83-4c12-89d6-4c4228d42acf.jpg') }}" width="950"
                      height="1920" loading="lazy"
                      alt="Product inventory and barcode data being verified in a spreadsheet"></figure>
                  <figure><img src="{{ asset('encoding/4b063139-381c-4c83-81e0-e0362e49c835.jpg') }}" width="950"
                      height="1920" loading="lazy" alt="Product records displayed in inventory management software">
                  </figure>
                  <figure><img src="{{ asset('encoding/6e092d96-e090-48fd-a9b0-a52dba3f642f.jpg') }}" width="950"
                      height="1920" loading="lazy"
                      alt="Hardware inventory item codes, prices, and descriptions in a spreadsheet"></figure>
                  <figure><img src="{{ asset('encoding/9437138e-c6fe-4bd7-b8bf-177586fd13e7.jpg') }}" width="950"
                      height="1920" loading="lazy" alt="Barcode label being prepared from encoded product information">
                  </figure>
                </div>
              </div>
            </li>
            <li>
              <h3>System Developer</h3>
              <p>Independent projects</p>
              <span>Designed custom web-based management systems and hardware-integrated solutions.</span>
              <div class="leadership-gallery">
                <div class="leadership-gallery-heading"><strong>Development in practice</strong><span>Build · Test ·
                    Iterate</span></div>
                <div class="leadership-photos">
                  <figure><img src="{{ asset('developer/developer.jpg') }}" width="1536" height="2048" loading="lazy"
                      alt="Von developing a software project on a laptop"></figure>
                  <figure><img src="{{ asset('developer/download%20(2).jpg') }}" width="1536" height="2048"
                      loading="lazy" alt="A dual-screen development workspace with source code open"></figure>
                  <figure><img src="{{ asset('developer/image.png') }}" width="3024" height="4032" loading="lazy"
                      alt="Von working on a laptop while away from his usual workspace"></figure>
                </div>
              </div>
            </li>
            <li class="timeline-it-services">
              <h3>IT Support &amp; Technical Services</h3>
              <p>Freelance &amp; Client Projects</p>
              <span>Delivered practical technical solutions including contract making (Rabbitry), reformatting Windows,
              <span>Delivered practical technical solutions including reformatting Windows,
                activation or download of Microsoft Office, and web prototyping.</span>
              <div class="leadership-gallery it-services-gallery">
                <div class="leadership-gallery-heading it-services-heading"><strong>Additional works in
                    practice</strong><span>Contract · Reformat · Prototype</span></div>
                    practice</strong><span>Reformat · Prototype</span></div>
                <div class="leadership-photos additional-works-photos">
                  <figure><img src="{{ asset('images/additional/rabbitry-contract.png') }}" class="media-contract"
                      width="768" height="1024" loading="lazy"
                      alt="Contract making (Rabbitry) document layout in Microsoft Word"></figure>
                  <figure><img src="{{ asset('images/additional/windows-reformat.png') }}" width="1024" height="768"
                      loading="lazy" alt="Reformatting Windows, driver setup, and Microsoft Office installation">
                  </figure>
                  <figure><img src="{{ asset('images/additional/server-prototyping.png') }}" width="1024" height="768"
                      loading="lazy"
                      alt="Web prototyping on multi-display setup with HTML, CSS, JavaScript, Bootstrap, and Tailwind CSS">
                  </figure>
                </div>
                <div class="additional-works-list">
                  <div class="work-detail-item">
                    <strong>Contract making (Rabbitry)</strong>
                    <span>Custom sales agreement &amp; document formatting</span>
                  </div>
                  <div class="work-detail-item">
                    <strong>Reformatting Windows</strong>
                    <span>Clean OS installation, recovery &amp; driver setup</span>
                  </div>
                  <div class="work-detail-item">
                    <strong>Microsoft Office Suite</strong>
                    <span>Download, productivity setup &amp; activation</span>
                  </div>
                  <div class="work-detail-item">
                    <strong>Web Prototyping</strong>
                    <span>HTML, CSS, JS, Bootstrap &amp; Tailwind</span>
                  </div>
                </div>
              </div>
            </li>
          </ol>
        </div>
        <div>
          <h2>Education</h2>
          <ol class="timeline">
            <li>
              <h3>BS Information Technology</h3>
              <p>Sultan Kudarat State University</p>
              <span>Current student; recognized on the Dean's List and President's List.</span>
            </li>
            <li>
              <h3>STEM Track, With Honors</h3>
              <p>Sto. Niño National High School</p>
              <span>Built a foundation in analytical thinking and technical problem-solving.</span>
            </li>
          </ol>
          <div class="education-gallery">
            <div class="education-gallery-heading">
              <h3>Academic recognition</h3><span>Dean’s List · President’s List</span>
            </div>
            <div class="education-photos">
              <figure class="education-photo education-photo-featured"><img
                  src="{{ asset('education/photo_2026-01-18_14-28-47.jpg') }}" width="1920" height="2560" loading="lazy"
                  alt="Von holding President's List certificates at the university academic recognition ceremony">
              </figure>
              <figure class="education-photo"><img src="{{ asset('education/photo_2026-08-07_17-30-48.jpg') }}"
                  width="1920" height="2560" loading="lazy"
                  alt="President's List certificates and university academic recognition program"></figure>
              <figure class="education-photo"><img src="{{ asset('education/photo_2026-01-18_14-28-44.jpg') }}"
                  width="1920" height="2560" loading="lazy"
                  alt="Von showing an academic honor ribbon and recognition certificates"></figure>
              <figure class="education-photo"><img src="{{ asset('education/download%20(1).jpg') }}" width="960"
                  height="1280" loading="lazy"
                  alt="Von holding two academic certificates outside the university administration building"></figure>
              <figure class="education-photo"><img src="{{ asset('education/download.jpg') }}" width="960" height="1280"
                  loading="lazy" alt="Von holding an academic certificate on the university campus"></figure>
            </div>
          </div>
          <ol class="timeline team-leader-timeline">
            <li>
              <h3>Team Leader</h3>
              <p>Academic projects</p>
              <span>Coordinated school development teams across software and hardware work.</span>
              <div class="leadership-gallery">
                <div class="leadership-gallery-heading"><strong>Capstone defense</strong><span>Project leadership · Team
                    delivery</span></div>
                <div class="capstone-lead-wrap">
                  <figure class="capstone-lead-figure"><img src="{{ asset('team_leader/team_leader.jpg') }}"
                      width="2048" height="1152" loading="lazy"
                      alt="Von and his project team after successfully completing their capstone defense"></figure>
                </div>
                <div class="capstone-sub-container">
                  <div class="leadership-gallery-heading capstone-subheading"><strong>Defense
                      results</strong><span>Outcome · Defended</span></div>
                  <div class="leadership-photos capstone-subphotos">
                    <figure><img src="{{ asset('team_leader/team_leader2.jpg') }}" width="960" height="1280"
                        loading="lazy"
                        alt="Von holding a laptop displaying the word Defended after the capstone presentation">
                    </figure>
                    <figure><img src="{{ asset('team_leader/team_leader3.jpg') }}" width="960" height="1280"
                        loading="lazy" alt="Von standing beside the successful capstone defense presentation screen">
                    </figure>
                  </div>
                </div>
              </div>
            </li>
          </ol>
        </div>
      </div>
    </section>
    <section id="contact" class="contact-section reveal">
      <div class="shell contact-inner">
        <div>
          <p class="eyebrow">04 / Contact</p>
          <h2>Let’s build something useful.</h2>
        </div>
        <div>
          <p>I’m open to opportunities, collaboration, and conversations about web systems and hardware projects.</p><a
            class="button button-light" href="mailto:von.vergara.399@gmail.com">Email Von ↗</a>
        </div>
      </div>
    </section>
  </main>
  <footer class="site-footer">
    <div class="shell"><span>© 2026 Von Esson Vergara</span>
      <div><a href="mailto:von.vergara.399@gmail.com">Email</a><a href="https://github.com/Vonnnnnnnnn05"
          target="_blank" rel="noopener noreferrer">GitHub</a><a
          href="https://ph.linkedin.com/in/von-esson-vergara-8454063b8" target="_blank"
          rel="noopener noreferrer">LinkedIn</a></div>
    </div>
  </footer>
  <button class="back-to-top" type="button" aria-label="Back to top"><svg width="24" height="24" viewBox="0 0 24 24"
      fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
      <polyline points="18 15 12 9 6 15" />
    </svg></button>
  <script src="{{ asset('script.js?v=22') }}"></script>
</body>

</html>