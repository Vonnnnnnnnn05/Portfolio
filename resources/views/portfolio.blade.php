<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="chat-endpoint" content="{{ route('chat') }}">
  <meta name="github-activity-endpoint" content="{{ route('github.activity') }}">
  <meta name="service-worker-url" content="{{ asset('sw.js') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Von Esson A. Vergara — IT student and developer building practical web systems and Arduino projects.">
  <link rel="canonical" href="{{ url('/') }}">
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ url('/') }}">
  <meta property="og:title" content="Von Vergara — Web Developer">
  <meta property="og:description" content="A portfolio of PHP, MySQL, JavaScript, and hardware systems built by Von Esson Vergara.">
  <meta property="og:image" content="{{ asset('image.png') }}">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="theme-color" content="#ffffff">
  <script>try{const t=localStorage.getItem('portfolio-theme');document.documentElement.dataset.theme=t==='dark'?'dark':'light'}catch(e){}</script>
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
  <link rel="stylesheet" href="{{ asset('enhancements.css?v=17') }}">
  <style>
    body.splash-active { overflow: hidden !important; height: 100vh !important; }
    #splash-screen {
      position: fixed; inset: 0; width: 100vw; height: 100vh;
      background-color: #ffffff; z-index: 999999;
      display: flex; align-items: center; justify-content: center;
    }
  </style>
  <title>Von Vergara — Developer Portfolio</title>
  <script type="application/ld+json">{"@@context":"https://schema.org","@@type":"Person","name":"Von Esson Vergara","url":"{{ url('/') }}","image":"{{ asset('image.png') }}","jobTitle":"Information Technology Student and Developer","email":"mailto:von.vergara.399@gmail.com","sameAs":["https://github.com/Vonnnnnnnnn05","https://ph.linkedin.com/in/von-esson-vergara-8454063b8"],"knowsAbout":["PHP","JavaScript","MySQL","CodeIgniter","Laravel","Arduino","Microsoft Azure","Nginx","Ubuntu"]}</script>
</head>
<body class="splash-active">
  <!-- Splash Screen / Preloader -->
  <div id="splash-screen" class="splash-screen" role="status" aria-live="polite" aria-label="Loading Von Tech Portfolio">
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
          <img src="{{ asset('images/vt-logo-dark.png?v=5') }}" alt="Von Tech Logo" class="splash-logo-image" width="112" height="112">
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
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="9 18 15 12 9 6"/></svg>
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
        <a href="#about">About</a><a href="#work">Work</a><a href="#activity">Activity</a><a href="#experience">Experience</a><a href="#contact">Contact</a>
      </nav>
      <button class="theme-toggle" type="button" aria-label="Switch to dark mode" aria-pressed="false">
        <svg class="theme-icon theme-icon-moon" aria-hidden="true" viewBox="0 0 24 24"><path d="M20.2 15.7A8.5 8.5 0 0 1 8.3 3.8 8.5 8.5 0 1 0 20.2 15.7Z"/></svg>
        <svg class="theme-icon theme-icon-sun" aria-hidden="true" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3.5"/><path d="M12 2v2M12 20v2M4.93 4.93l1.42 1.42M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.42-1.41M17.66 6.34l1.41-1.41"/></svg>
      </button>
      <a class="nav-cta" href="{{ asset('Von_Esson_Vergara_Resume.pdf') }}" target="_blank" rel="noopener noreferrer">View Resume <span aria-hidden="true">↗</span></a>
    </div>
  </header>
  <main id="main-content">
    <section id="top" class="hero shell reveal">
      <div class="hero-copy">
        <p class="eyebrow">IT student · Web developer</p>
        <h1>Von Esson<br>Vergara<span>.</span></h1>
        <p class="hero-summary">I build PHP and MySQL applications that turn manual school and small-business workflows into dependable digital systems.</p>
        <p class="availability"><span aria-hidden="true"></span> Open to internships, junior opportunities, and project collaborations.</p>
        <div class="hero-actions"><a class="button button-primary" href="#work">View my best work <span aria-hidden="true">↓</span></a><a class="button button-secondary" href="{{ asset('Von_Esson_Vergara_Resume.pdf') }}" download>Download résumé</a></div>
        <ul class="social-list" aria-label="Professional links"><li><a href="https://github.com/Vonnnnnnnnn05" target="_blank" rel="noopener noreferrer">GitHub ↗</a></li><li><a href="https://ph.linkedin.com/in/von-esson-vergara-8454063b8" target="_blank" rel="noopener noreferrer">LinkedIn ↗</a></li></ul>
      </div>
      <figure class="portrait-frame"><img src="{{ asset('image.png') }}" width="1024" height="1055" alt="Portrait of Von Esson Vergara"></figure>
    </section>
    <section id="about" class="shell section reveal">
      <div class="section-label">01 / About</div>
      <div class="about-grid"><h2>I turn real-world processes into usable digital tools.</h2><div><p>I am an Information Technology student and developer with a focus on web systems, databases, and Arduino integration. My work combines thoughtful interfaces with the practical details that make systems dependable.</p><p>I am especially interested in work that connects people, data, and hardware—from attendance and inventory systems to connected hardware projects.</p></div></div>
      <div class="capability-grid" aria-label="Capabilities"><article><span>01</span><h3>Web systems</h3><p>PHP, CodeIgniter, Laravel, JavaScript, and responsive interfaces.</p></article><article><span>02</span><h3>Data &amp; workflows</h3><p>MySQL-backed management tools, reporting, tracking, and automation.</p></article><article><span>03</span><h3>Hardware integration</h3><p>Arduino, RFID, sensors, and database-connected prototypes.</p></article></div>
      <div class="tech-stack" aria-label="Technology stack"><article><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/php/php-original.svg" width="40" height="40" loading="lazy" alt=""><div><strong>PHP</strong><span>Backend</span></div></article><article><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/composer/composer-original.svg" width="40" height="40" loading="lazy" alt=""><div><strong>Composer</strong><span>Dependencies</span></div></article><article><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/javascript/javascript-original.svg" width="40" height="40" loading="lazy" alt=""><div><strong>JavaScript</strong><span>Frontend &amp; APIs</span></div></article><article><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/mysql/mysql-original.svg" width="40" height="40" loading="lazy" alt=""><div><strong>MySQL</strong><span>Database</span></div></article><article><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/codeigniter/codeigniter-plain.svg" width="40" height="40" loading="lazy" alt=""><div><strong>CodeIgniter 4</strong><span>Framework</span></div></article><article><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/laravel/laravel-original.svg" width="40" height="40" loading="lazy" alt=""><div><strong>Laravel</strong><span>Framework</span></div></article><article><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/bootstrap/bootstrap-original.svg" width="40" height="40" loading="lazy" alt=""><div><strong>Bootstrap</strong><span>UI toolkit</span></div></article><article><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/tailwindcss/tailwindcss-original.svg" width="40" height="40" loading="lazy" alt=""><div><strong>Tailwind CSS</strong><span>UI styling</span></div></article><article><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/arduino/arduino-original.svg" width="40" height="40" loading="lazy" alt=""><div><strong>Arduino</strong><span>Hardware</span></div></article><article><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/git/git-original.svg" width="40" height="40" loading="lazy" alt=""><div><strong>Git</strong><span>Version control</span></div></article><article class="tech-recent"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/nginx/nginx-original.svg" width="40" height="40" loading="lazy" alt=""><div><strong>Nginx</strong><span>Web server</span></div><small>Recent</small></article><article class="tech-recent"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/ubuntu/ubuntu-original.svg" width="40" height="40" loading="lazy" alt=""><div><strong>Ubuntu</strong><span>Server OS</span></div><small>Recent</small></article><article class="tech-recent"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/openapi/openapi-original.svg" width="40" height="40" loading="lazy" alt=""><div><strong>AI &amp; APIs</strong><span>Groq integration</span></div><small>Recent</small></article><article class="tech-recent"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/azure/azure-original.svg" width="40" height="40" loading="lazy" alt=""><div><strong>Azure</strong><span>Cloud platform</span></div><small>Recent</small></article></div>
    </section>
    <section id="work" class="shell section work-section reveal">
      <div class="section-heading"><div class="section-label">02 / Selected work</div><p>Three systems that show how I approach real operational problems.</p></div>
      <div class="selected-grid">
        <article class="project"><a class="project-image" href="https://github.com/Vonnnnnnnnn05/Scholarship-Data-Profiling-System" target="_blank" rel="noopener noreferrer"><img src="{{ asset('images/sdp.png') }}" width="1898" height="866" loading="lazy" alt="Dashboard of the Scholarship Data Profiling System"></a><div class="project-meta"><span>01</span><span>Records &amp; analytics</span></div><h2>Scholarship Data Profiling</h2><p class="project-lead">A centralized workspace for maintaining scholar records and supporting program monitoring.</p><dl class="case-study"><div><dt>Problem</dt><dd>Scholar information, reporting, and compliance data can be difficult to review when handled across disconnected records.</dd></div><div><dt>Approach</dt><dd>Combined structured profiles, reporting tools, and visual analytics in one MySQL-backed system.</dd></div><div><dt>Key features</dt><dd>Scholar profiles · Reports · Analytics dashboard</dd></div></dl><div class="tag-row"><span>PHP</span><span>MySQL</span><span>Chart.js</span></div><div class="project-actions"><a class="project-link" href="https://github.com/Vonnnnnnnnn05/Scholarship-Data-Profiling-System" target="_blank" rel="noopener noreferrer">Explore repository ↗</a><span>Demo not hosted</span></div></article>
        <article class="project"><a class="project-image" href="https://github.com/Vonnnnnnnnn05/Carwash-Management-System" target="_blank" rel="noopener noreferrer"><img src="{{ asset('images/carwash.png') }}" width="1919" height="878" loading="lazy" alt="Interface of the Carwash CRM system"></a><div class="project-meta"><span>02</span><span>Customer workflow</span></div><h2>Carwash CRM</h2><p class="project-lead">An operational system that keeps customer details, services, and visit history together.</p><dl class="case-study"><div><dt>Problem</dt><dd>Manual customer and transaction records make it harder to follow service history and daily activity.</dd></div><div><dt>Approach</dt><dd>Designed a connected workflow around reusable customer records and service transactions.</dd></div><div><dt>Key features</dt><dd>Customer records · Transactions · Visit history</dd></div></dl><div class="tag-row"><span>PHP</span><span>MySQL</span><span>JavaScript</span></div><div class="project-actions"><a class="project-link" href="https://github.com/Vonnnnnnnnn05/Carwash-Management-System" target="_blank" rel="noopener noreferrer">Explore repository ↗</a><span>Demo not hosted</span></div></article>
        <article class="project"><a class="project-image" href="https://github.com/Vonnnnnnnnn05/Ams" target="_blank" rel="noopener noreferrer"><img src="{{ asset('images/ams.png') }}" width="1919" height="873" loading="lazy" alt="Dashboard of the Attendance Management System"></a><div class="project-meta"><span>03</span><span>QR workflow</span></div><h2>Attendance Management</h2><p class="project-lead">A QR-based attendance workflow with live monitoring and report generation.</p><dl class="case-study"><div><dt>Problem</dt><dd>Manual attendance recording is repetitive and makes timely monitoring and reporting more difficult.</dd></div><div><dt>Approach</dt><dd>Connected QR-based check-ins to centralized records, analytics, and automated reports.</dd></div><div><dt>Key features</dt><dd>QR check-in · Live monitoring · Reports</dd></div></dl><div class="tag-row"><span>PHP</span><span>MySQL</span><span>QR Code API</span></div><div class="project-actions"><a class="project-link" href="https://github.com/Vonnnnnnnnn05/Ams" target="_blank" rel="noopener noreferrer">Explore repository ↗</a><span>Demo not hosted</span></div></article>
      </div>
      <div class="additional-work">
        <div class="section-heading">
          <div class="section-label">Additional work</div>
          <p>Technical services, practical client work, web systems, and hardware prototypes.</p>
        </div>

        <div class="work-index">
          <div class="work-group">
            <h3>Web systems</h3>
            <a href="https://github.com/Vonnnnnnnnn05/CodeIgnighter4-Crud" target="_blank" rel="noopener noreferrer"><span>Product Management System</span><small>CodeIgniter 4 · MySQL</small><b>↗</b></a>
            <a href="https://github.com/Vonnnnnnnnn05/Scholarship-System" target="_blank" rel="noopener noreferrer"><span>Scholarship Eligibility Checker</span><small>PHP · MySQL</small><b>↗</b></a>
            <a href="https://github.com/Vonnnnnnnnn05/Weather-API-Integration" target="_blank" rel="noopener noreferrer"><span>Weather Forecasting System</span><small>CodeIgniter 4 · API</small><b>↗</b></a>
            <a href="https://github.com/Vonnnnnnnnn05/Boarding-House-V2" target="_blank" rel="noopener noreferrer"><span>Boarding House Management</span><small>PHP · MySQL</small><b>↗</b></a>
            <a href="https://github.com/Vonnnnnnnnn05/Healthworker-Patient-System" target="_blank" rel="noopener noreferrer"><span>Healthcare Management System</span><small>PHP · MySQL</small><b>↗</b></a>
            <a href="https://github.com/Vonnnnnnnnn05/cosmetics-Inventory-Management-System" target="_blank" rel="noopener noreferrer"><span>Inventory Management System</span><small>PHP · Chart.js</small><b>↗</b></a>
          </div>
          <div class="work-group">
            <h3>Arduino &amp; Hardware</h3>
            <a href="https://github.com/Vonnnnnnnnn05/RFID-ATTENDANCE-WITH-WEB-UI-AND-DATABASE" target="_blank" rel="noopener noreferrer"><span>RFID Attendance System</span><small>Arduino · RFID · MySQL</small><b>↗</b></a>
            <div class="work-unavailable"><span>Smart Mousetrap System</span><small>Arduino · SMS alerts</small><b>Source unavailable</b></div>
            <div class="work-unavailable"><span>Mood Lamp Controller</span><small>Arduino · RGB LED · WiFi</small><b>Source unavailable</b></div>
            <a href="https://github.com/Vonnnnnnnnn05/Memory-Game-Arduino-X-PHP" target="_blank" rel="noopener noreferrer"><span>Interactive Memory Games</span><small>Arduino · LCD · PHP</small><b>↗</b></a>
          </div>
          <div class="work-group">
            <h3>Technical &amp; IT Services</h3>
            <a href="#experience" class="work-service-item"><span>Contract Making (Rabbitry)</span><small>Documentation · MS Word</small><b>View ↘</b></a>
            <a href="#experience" class="work-service-item"><span>Reformatting Windows</span><small>OS Clean Install · Recovery</small><b>View ↘</b></a>
            <a href="#experience" class="work-service-item"><span>Microsoft Office Setup</span><small>Download &amp; Activation</small><b>View ↘</b></a>
            <a href="#experience" class="work-service-item"><span>Web Prototyping</span><small>HTML · CSS · JS · Bootstrap · Tailwind</small><b>View ↘</b></a>
          </div>
        </div>
      </div>
    </section>
    <section id="activity" class="shell section activity-section reveal">
      <script id="github-initial-data" type="application/json">{!! json_encode($githubData ?? null) !!}</script>
      <div class="section-label">03 / GitHub Activity</div>

      <div class="github-calendar-panel">
        <div class="calendar-topbar">
          <div class="calendar-headline-wrap">
            <h3 class="calendar-headline"><span id="github-total-contributions">{{ $githubData['totals']['2026'] ?? 138 }}</span> contributions in <span id="github-selected-year">2026</span></h3>
            <span class="calendar-subtext">Live commit activity from <a href="https://github.com/Vonnnnnnnnn05" target="_blank" rel="noopener noreferrer" class="text-link">@Vonnnnnnnnn05 ↗</a></span>
          </div>
          <div class="year-selector" role="tablist" aria-label="Contribution year">
            <button class="year-btn active" type="button" data-year="2026" aria-selected="true">2026</button>
            <button class="year-btn" type="button" data-year="2025" aria-selected="false">2025</button>
            <button class="year-btn" type="button" data-year="2024" aria-selected="false">2024</button>
          </div>
        </div>

        <div class="calendar-mobile-hint" aria-hidden="true">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="8 7 3 12 8 17"/><polyline points="16 7 21 12 16 17"/><line x1="3" y1="12" x2="21" y2="12"/></svg>
          <span>Scroll horizontally to view all months</span>
        </div>

        <div class="calendar-scroll-wrapper" id="calendar-scroll-wrapper">
          <div class="calendar-stage" id="calendar-stage">
            <div class="calendar-skeleton">Loading contribution calendar…</div>
          </div>
        </div>

        <div class="calendar-footer">
          <a class="calendar-info-link" href="https://github.com/Vonnnnnnnnn05" target="_blank" rel="noopener noreferrer">View GitHub profile ↗</a>
          <div class="calendar-legend" aria-label="Contribution intensity scale">
            <span class="legend-text">Less</span>
            <span class="legend-cell level-0" title="0 contributions"></span>
            <span class="legend-cell level-1" title="1-3 contributions"></span>
            <span class="legend-cell level-2" title="4-6 contributions"></span>
            <span class="legend-cell level-3" title="7-9 contributions"></span>
            <span class="legend-cell level-4" title="10+ contributions"></span>
            <span class="legend-text">More</span>
          </div>
        </div>
      </div>
      <div id="calendar-tooltip" class="calendar-tooltip" role="tooltip" aria-hidden="true"></div>
    </section>
    <section id="experience" class="shell section reveal">
      <div class="section-label">04 / Experience &amp; education</div>
      <div class="resume-grid">
        <div>
          <h2>Experience</h2>
          <ol class="timeline">
            <li>
              <h3>Encoder / Inventory Manager</h3>
              <p>Alocada Enterprises</p>
              <span>Managed inventory data and improved stock-management workflows through digital tools.</span>
              <div class="leadership-gallery">
                <div class="leadership-gallery-heading"><strong>Inventory data operations</strong><span>Encode · Verify · Label</span></div>
                <div class="encoding-photos">
                  <figure><img src="{{ asset('encoding/3e722534-94c3-49df-983e-1b0d50a564e6.jpg') }}" width="950" height="1920" loading="lazy" alt="Inventory master list with product descriptions and prices being encoded"></figure>
                  <figure><img src="{{ asset('encoding/437ce2a5-4f83-4c12-89d6-4c4228d42acf.jpg') }}" width="950" height="1920" loading="lazy" alt="Product inventory and barcode data being verified in a spreadsheet"></figure>
                  <figure><img src="{{ asset('encoding/4b063139-381c-4c83-81e0-e0362e49c835.jpg') }}" width="950" height="1920" loading="lazy" alt="Product records displayed in inventory management software"></figure>
                  <figure><img src="{{ asset('encoding/6e092d96-e090-48fd-a9b0-a52dba3f642f.jpg') }}" width="950" height="1920" loading="lazy" alt="Hardware inventory item codes, prices, and descriptions in a spreadsheet"></figure>
                  <figure><img src="{{ asset('encoding/9437138e-c6fe-4bd7-b8bf-177586fd13e7.jpg') }}" width="950" height="1920" loading="lazy" alt="Barcode label being prepared from encoded product information"></figure>
                </div>
              </div>
            </li>
            <li>
              <h3>System Developer</h3>
              <p>Independent projects</p>
              <span>Designed custom web-based management systems and hardware-integrated solutions.</span>
              <div class="leadership-gallery">
                <div class="leadership-gallery-heading"><strong>Development in practice</strong><span>Build · Test · Iterate</span></div>
                <div class="leadership-photos">
                  <figure><img src="{{ asset('developer/developer.jpg') }}" width="1536" height="2048" loading="lazy" alt="Von developing a software project on a laptop"></figure>
                  <figure><img src="{{ asset('developer/download%20(2).jpg') }}" width="1536" height="2048" loading="lazy" alt="A dual-screen development workspace with source code open"></figure>
                  <figure><img src="{{ asset('developer/image.png') }}" width="3024" height="4032" loading="lazy" alt="Von working on a laptop while away from his usual workspace"></figure>
                </div>
              </div>
            </li>
            <li class="timeline-it-services">
              <h3>IT Support &amp; Technical Services</h3>
              <p>Freelance &amp; Client Projects</p>
              <span>Delivered practical technical solutions including contract making (Rabbitry), reformatting Windows, activation or download of Microsoft Office, and web prototyping.</span>
              <div class="leadership-gallery it-services-gallery">
                <div class="leadership-gallery-heading it-services-heading"><strong>Additional works in practice</strong><span>Contract · Reformat · Prototype</span></div>
                <div class="leadership-photos additional-works-photos">
                  <figure><img src="{{ asset('images/additional/rabbitry-contract.png') }}" class="media-contract" width="768" height="1024" loading="lazy" alt="Contract making (Rabbitry) document layout in Microsoft Word"></figure>
                  <figure><img src="{{ asset('images/additional/windows-reformat.png') }}" width="1024" height="768" loading="lazy" alt="Reformatting Windows, driver setup, and Microsoft Office installation"></figure>
                  <figure><img src="{{ asset('images/additional/server-prototyping.png') }}" width="1024" height="768" loading="lazy" alt="Web prototyping on multi-display setup with HTML, CSS, JavaScript, Bootstrap, and Tailwind CSS"></figure>
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
            <div class="education-gallery-heading"><h3>Academic recognition</h3><span>Dean’s List · President’s List</span></div>
            <div class="education-photos">
              <figure class="education-photo education-photo-featured"><img src="{{ asset('education/photo_2026-01-18_14-28-47.jpg') }}" width="1920" height="2560" loading="lazy" alt="Von holding President's List certificates at the university academic recognition ceremony"></figure>
              <figure class="education-photo"><img src="{{ asset('education/photo_2026-08-07_17-30-48.jpg') }}" width="1920" height="2560" loading="lazy" alt="President's List certificates and university academic recognition program"></figure>
              <figure class="education-photo"><img src="{{ asset('education/photo_2026-01-18_14-28-44.jpg') }}" width="1920" height="2560" loading="lazy" alt="Von showing an academic honor ribbon and recognition certificates"></figure>
              <figure class="education-photo"><img src="{{ asset('education/download%20(1).jpg') }}" width="960" height="1280" loading="lazy" alt="Von holding two academic certificates outside the university administration building"></figure>
              <figure class="education-photo"><img src="{{ asset('education/download.jpg') }}" width="960" height="1280" loading="lazy" alt="Von holding an academic certificate on the university campus"></figure>
            </div>
          </div>
          <ol class="timeline team-leader-timeline">
            <li>
              <h3>Team Leader</h3>
              <p>Academic projects</p>
              <span>Coordinated school development teams across software and hardware work.</span>
              <div class="leadership-gallery">
                <div class="leadership-gallery-heading"><strong>Capstone defense</strong><span>Project leadership · Team delivery</span></div>
                <div class="capstone-lead-wrap">
                  <figure class="capstone-lead-figure"><img src="{{ asset('team_leader/team_leader.jpg') }}" width="2048" height="1152" loading="lazy" alt="Von and his project team after successfully completing their capstone defense"></figure>
                </div>
                <div class="capstone-sub-container">
                  <div class="leadership-gallery-heading capstone-subheading"><strong>Defense results</strong><span>Outcome · Defended</span></div>
                  <div class="leadership-photos capstone-subphotos">
                    <figure><img src="{{ asset('team_leader/team_leader2.jpg') }}" width="960" height="1280" loading="lazy" alt="Von holding a laptop displaying the word Defended after the capstone presentation"></figure>
                    <figure><img src="{{ asset('team_leader/team_leader3.jpg') }}" width="960" height="1280" loading="lazy" alt="Von standing beside the successful capstone defense presentation screen"></figure>
                  </div>
                </div>
              </div>
            </li>
          </ol>
        </div>
      </div>
    </section>
    <section id="contact" class="contact-section reveal"><div class="shell contact-inner"><div><p class="eyebrow">05 / Contact</p><h2>Let’s build something useful.</h2></div><div><p>I’m open to opportunities, collaboration, and conversations about web systems and hardware projects.</p><a class="button button-light" href="mailto:von.vergara.399@gmail.com">Email Von ↗</a></div></div></section>
  </main>
  <footer class="site-footer"><div class="shell"><span>© 2026 Von Esson Vergara</span><div><a href="mailto:von.vergara.399@gmail.com">Email</a><a href="https://github.com/Vonnnnnnnnn05" target="_blank" rel="noopener noreferrer">GitHub</a><a href="https://ph.linkedin.com/in/von-esson-vergara-8454063b8" target="_blank" rel="noopener noreferrer">LinkedIn</a></div></div></footer>
  <button class="back-to-top" type="button" aria-label="Back to top"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"/></svg></button><script src="{{ asset('script.js?v=21') }}"></script>
</body></html>
