<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sante+ — Plateforme Digitale des Délégués Médicaux</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

  :root {
    --blue: #1D6EF5;
    --blue-dark: #1252C0;
    --blue-light: #EBF2FF;
    --navy: #0A1628;
    --navy-mid: #162040;
    --white: #FFFFFF;
    --gray-50: #F8F9FC;
    --gray-100: #F0F2F8;
    --gray-200: #DDE1EE;
    --gray-400: #8A92A9;
    --gray-600: #4B5470;
    --gray-800: #1E2545;
    --green: #15B077;
    --amber: #F5A623;
    --coral: #F04E37;
    --radius: 16px;
    --radius-sm: 8px;
    --radius-pill: 100px;
  }

  html { scroll-behavior: smooth; }

  body {
    font-family: 'Inter', sans-serif;
    background: var(--white);
    color: var(--gray-800);
    line-height: 1.6;
    overflow-x: hidden;
  }

  /* ── NAV ── */
  nav {
    position: fixed; top: 0; left: 0; right: 0; z-index: 100;
    display: flex; align-items: center; justify-content: space-between;
    padding: 0 5%;
    height: 72px;
    background: rgba(255,255,255,0.9);
    backdrop-filter: blur(12px);
    border-bottom: 1px solid var(--gray-200);
  }
  .nav-logo {
    display: flex; align-items: center; gap: 10px;
    font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 800; font-size: 22px; color: var(--navy);
    text-decoration: none;
  }
  .nav-logo-icon {
    width: 38px; height: 38px; border-radius: 10px;
    background: var(--blue);
    display: flex; align-items: center; justify-content: center;
    color: white; font-size: 20px; font-weight: 800;
  }
  .nav-links { display: flex; align-items: center; gap: 32px; }
  .nav-links a {
    font-size: 15px; color: var(--gray-600); text-decoration: none; font-weight: 500;
    transition: color 0.2s;
  }
  .nav-links a:hover { color: var(--blue); }
  .nav-cta {
    display: flex; align-items: center; gap: 12px;
  }
  .btn-outline {
    padding: 9px 20px; border-radius: var(--radius-pill);
    border: 1.5px solid var(--gray-200); background: transparent;
    font-size: 14px; font-weight: 500; color: var(--gray-800);
    cursor: pointer; text-decoration: none; transition: all 0.2s;
  }
  .btn-outline:hover { border-color: var(--blue); color: var(--blue); }
  .btn-primary {
    padding: 10px 22px; border-radius: var(--radius-pill);
    background: var(--blue); color: white;
    font-size: 14px; font-weight: 600;
    cursor: pointer; text-decoration: none;
    border: none; transition: all 0.2s;
    box-shadow: 0 4px 14px rgba(29,110,245,0.35);
  }
  .btn-primary:hover { background: var(--blue-dark); transform: translateY(-1px); }

  /* ── HERO ── */
  .hero {
    min-height: 100vh;
    background: linear-gradient(160deg, #0A1628 0%, #162040 60%, #1a2d55 100%);
    display: flex; align-items: center; justify-content: center;
    flex-direction: column;
    text-align: center;
    padding: 120px 5% 80px;
    position: relative;
    overflow: hidden;
  }
  .hero::before {
    content: '';
    position: absolute; inset: 0;
    background: radial-gradient(ellipse 80% 60% at 50% 0%, rgba(29,110,245,0.25) 0%, transparent 70%);
    pointer-events: none;
  }
  .hero-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(29,110,245,0.15);
    border: 1px solid rgba(29,110,245,0.4);
    color: #7aadff;
    padding: 6px 16px; border-radius: var(--radius-pill);
    font-size: 13px; font-weight: 500;
    margin-bottom: 32px;
    letter-spacing: 0.02em;
  }
  .hero-badge::before {
    content: ''; width: 8px; height: 8px; border-radius: 50%;
    background: #4d9cff; box-shadow: 0 0 8px #4d9cff;
  }
  .hero h1 {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: clamp(40px, 6vw, 78px);
    font-weight: 800;
    color: white;
    line-height: 1.08;
    max-width: 860px;
    margin-bottom: 24px;
  }
  .hero h1 span { color: #4d9cff; }
  .hero-sub {
    font-size: clamp(16px, 2vw, 20px);
    color: rgba(255,255,255,0.6);
    max-width: 580px;
    margin-bottom: 48px;
    line-height: 1.7;
  }
  .hero-actions {
    display: flex; align-items: center; gap: 16px; flex-wrap: wrap;
    justify-content: center;
    margin-bottom: 80px;
  }
  .btn-hero {
    padding: 15px 32px; border-radius: var(--radius-pill);
    background: var(--blue); color: white;
    font-size: 16px; font-weight: 600;
    cursor: pointer; text-decoration: none;
    border: none; transition: all 0.25s;
    box-shadow: 0 8px 30px rgba(29,110,245,0.5);
    display: inline-flex; align-items: center; gap: 8px;
  }
  .btn-hero:hover { background: var(--blue-dark); transform: translateY(-2px); box-shadow: 0 12px 36px rgba(29,110,245,0.6); }
  .btn-hero-ghost {
    padding: 14px 28px; border-radius: var(--radius-pill);
    border: 1.5px solid rgba(255,255,255,0.25);
    color: white; font-size: 16px; font-weight: 500;
    cursor: pointer; text-decoration: none;
    background: rgba(255,255,255,0.07);
    transition: all 0.25s;
    display: inline-flex; align-items: center; gap: 8px;
  }
  .btn-hero-ghost:hover { border-color: rgba(255,255,255,0.5); background: rgba(255,255,255,0.12); }

  /* Hero stats */
  .hero-stats {
    display: flex; align-items: center; gap: 48px; flex-wrap: wrap; justify-content: center;
  }
  .stat-item { text-align: center; }
  .stat-num {
    font-family: 'Plus Jakarta Sans', sans-serif; font-size: 36px; font-weight: 800; color: white;
    display: block;
  }
  .stat-label { font-size: 13px; color: rgba(255,255,255,0.5); letter-spacing: 0.04em; }
  .stat-sep { width: 1px; height: 48px; background: rgba(255,255,255,0.15); }

  /* ── DASHBOARD MOCKUP ── */
  .mockup-section {
    background: var(--gray-50);
    padding: 80px 5%;
    display: flex; justify-content: center;
  }
  .mockup-wrap {
    max-width: 1100px; width: 100%;
    background: white;
    border-radius: 24px;
    border: 1px solid var(--gray-200);
    overflow: hidden;
    box-shadow: 0 40px 120px rgba(10,22,40,0.15);
  }
  .mockup-bar {
    background: var(--navy); padding: 14px 20px;
    display: flex; align-items: center; gap: 8px;
  }
  .dot { width: 12px; height: 12px; border-radius: 50%; }
  .dot-r { background: #FF5F57; }
  .dot-y { background: #FEBC2E; }
  .dot-g { background: #28C840; }
  .mockup-bar span {
    margin-left: auto; font-size: 13px; color: rgba(255,255,255,0.5);
    font-family: monospace;
  }
  .mockup-body { display: flex; min-height: 460px; }
  .mock-sidebar {
    width: 220px; background: var(--navy-mid);
    padding: 24px 16px; flex-shrink: 0;
    display: flex; flex-direction: column; gap: 4px;
  }
  .mock-logo {
    display: flex; align-items: center; gap: 8px;
    color: white; font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 800; font-size: 18px;
    margin-bottom: 32px;
  }
  .mock-logo-icon {
    width: 30px; height: 30px; background: var(--blue);
    border-radius: 8px; display: flex; align-items: center; justify-content: center;
    color: white; font-size: 14px; font-weight: 800;
  }
  .mock-nav-item {
    display: flex; align-items: center; gap: 10px;
    padding: 9px 12px; border-radius: 10px;
    font-size: 14px; color: rgba(255,255,255,0.5);
    cursor: default;
  }
  .mock-nav-item.active { background: var(--blue); color: white; }
  .mock-nav-item .icon { font-size: 16px; width: 18px; text-align: center; }
  .mock-nav-badge {
    margin-left: auto; background: var(--coral); color: white;
    font-size: 11px; font-weight: 600;
    width: 18px; height: 18px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
  }
  .mock-main { flex: 1; background: var(--gray-50); padding: 28px; overflow: hidden; }
  .mock-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; }
  .mock-title { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 22px; font-weight: 800; color: var(--navy); }
  .mock-avatar {
    width: 36px; height: 36px; border-radius: 50%;
    background: var(--blue); color: white;
    font-size: 13px; font-weight: 700;
    display: flex; align-items: center; justify-content: center;
  }
  .mock-kpis { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin-bottom: 20px; }
  .mock-kpi {
    background: white; border-radius: 12px; padding: 16px;
    border: 1px solid var(--gray-200);
  }
  .mock-kpi-label { font-size: 12px; color: var(--gray-400); margin-bottom: 6px; }
  .mock-kpi-val { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 24px; font-weight: 800; color: var(--navy); }
  .mock-kpi-trend { font-size: 11px; color: var(--green); margin-top: 2px; }
  .mock-kpi-trend.warn { color: var(--amber); }
  .mock-bottom { display: grid; grid-template-columns: 1.4fr 1fr; gap: 12px; }
  .mock-card { background: white; border-radius: 12px; padding: 16px; border: 1px solid var(--gray-200); }
  .mock-card-title { font-size: 14px; font-weight: 600; color: var(--navy); margin-bottom: 14px; }
  .mock-visit-item {
    display: flex; align-items: center; gap: 10px;
    padding: 8px 0; border-bottom: 1px solid var(--gray-100);
  }
  .mock-visit-item:last-child { border-bottom: none; }
  .mock-time { font-size: 12px; color: var(--gray-400); width: 36px; }
  .mock-dr { font-size: 13px; font-weight: 500; color: var(--navy); flex: 1; }
  .mock-dr span { display: block; font-size: 11px; color: var(--gray-400); font-weight: 400; }
  .mock-badge {
    font-size: 10px; font-weight: 600; padding: 3px 8px; border-radius: 100px;
  }
  .badge-green { background: #E3F8EF; color: #0D7C51; }
  .badge-amber { background: #FEF3DC; color: #9A6200; }
  .badge-blue { background: #E8F1FF; color: #1252C0; }
  .mock-perf-bar { margin-bottom: 10px; }
  .mock-perf-label { display: flex; justify-content: space-between; font-size: 12px; margin-bottom: 4px; color: var(--gray-600); }
  .mock-bar-bg { height: 8px; background: var(--gray-100); border-radius: 100px; overflow: hidden; }
  .mock-bar-fill { height: 100%; border-radius: 100px; background: var(--blue); }
  .mock-bar-fill.green { background: var(--green); }
  .mock-bar-fill.amber { background: var(--amber); }

  /* ── FEATURES ── */
  section { padding: 100px 5%; }
  .section-label {
    font-size: 13px; font-weight: 600; color: var(--blue);
    letter-spacing: 0.1em; text-transform: uppercase;
    margin-bottom: 16px;
  }
  .section-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: clamp(32px, 4vw, 52px);
    font-weight: 800; color: var(--navy);
    line-height: 1.1; max-width: 600px;
    margin-bottom: 20px;
  }
  .section-sub { font-size: 18px; color: var(--gray-400); max-width: 520px; line-height: 1.7; }

  .features-grid {
    display: grid; grid-template-columns: repeat(3, 1fr);
    gap: 24px; margin-top: 60px;
  }
  .feat-card {
    background: white; border-radius: var(--radius);
    border: 1px solid var(--gray-200); padding: 32px;
    transition: box-shadow 0.25s, transform 0.25s;
    position: relative; overflow: hidden;
  }
  .feat-card:hover { box-shadow: 0 20px 60px rgba(10,22,40,0.1); transform: translateY(-3px); }
  .feat-icon {
    width: 52px; height: 52px; border-radius: 14px;
    margin-bottom: 20px; font-size: 26px;
    display: flex; align-items: center; justify-content: center;
  }
  .feat-icon.blue { background: #EBF2FF; }
  .feat-icon.green { background: #E3F8EF; }
  .feat-icon.amber { background: #FEF3DC; }
  .feat-icon.coral { background: #FCECEA; }
  .feat-icon.purple { background: #F0EEFF; }
  .feat-icon.teal { background: #E2F9F4; }
  .feat-title { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 20px; font-weight: 700; color: var(--navy); margin-bottom: 12px; }
  .feat-desc { font-size: 15px; color: var(--gray-400); line-height: 1.7; }
  .feat-card::after {
    content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 3px;
    background: var(--blue); transform: scaleX(0); transform-origin: left;
    transition: transform 0.3s;
  }
  .feat-card:hover::after { transform: scaleX(1); }

  /* ── ROLES ── */
  .roles-section { background: var(--navy); }
  .roles-section .section-title { color: white; }
  .roles-section .section-sub { color: rgba(255,255,255,0.5); }
  .roles-grid {
    display: grid; grid-template-columns: repeat(3, 1fr);
    gap: 24px; margin-top: 60px;
  }
  .role-card {
    border-radius: var(--radius); padding: 36px;
    border: 1px solid rgba(255,255,255,0.1);
    background: rgba(255,255,255,0.05);
    transition: all 0.25s;
  }
  .role-card:hover { background: rgba(29,110,245,0.15); border-color: rgba(29,110,245,0.5); }
  .role-num {
    font-family: 'Plus Jakarta Sans', sans-serif; font-size: 48px; font-weight: 800;
    color: rgba(29,110,245,0.3); margin-bottom: 20px; display: block;
  }
  .role-title { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 22px; font-weight: 800; color: white; margin-bottom: 12px; }
  .role-sub { font-size: 13px; color: rgba(29,110,245,0.8); font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase; margin-bottom: 16px; }
  .role-desc { font-size: 15px; color: rgba(255,255,255,0.55); line-height: 1.7; }
  .role-features { list-style: margin-top: 24px; display: flex; flex-direction: column; gap: 10px; }
  .role-features li {
    font-size: 14px; color: rgba(255,255,255,0.7);
    display: flex; align-items: center; gap: 10px;
  }
  .role-features li::before { content: '✓'; color: var(--blue); font-weight: 700; font-size: 14px; }

  /* ── TECH ── */
  .tech-section { background: var(--gray-50); text-align: center; }
  .tech-title { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 38px; font-weight: 800; color: var(--navy); margin-bottom: 16px; }
  .tech-sub { font-size: 18px; color: var(--gray-400); margin-bottom: 60px; }
  .tech-grid {
    display: grid; grid-template-columns: repeat(4, 1fr);
    gap: 20px; max-width: 900px; margin: 0 auto;
  }
  .tech-card {
    background: white; border-radius: var(--radius); padding: 28px 20px;
    border: 1px solid var(--gray-200); text-align: center;
    transition: all 0.25s;
  }
  .tech-card:hover { box-shadow: 0 12px 40px rgba(10,22,40,0.1); transform: translateY(-2px); }
  .tech-logo { font-size: 36px; margin-bottom: 12px; }
  .tech-name { font-weight: 700; font-size: 16px; color: var(--navy); margin-bottom: 6px; }
  .tech-role { font-size: 12px; color: var(--gray-400); }

  /* ── KPIs STRIP ── */
  .kpi-strip {
    background: var(--blue); padding: 64px 5%;
    display: grid; grid-template-columns: repeat(4, 1fr);
    gap: 40px; text-align: center;
  }
  .kpi-strip-num { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 52px; font-weight: 800; color: white; display: block; }
  .kpi-strip-label { font-size: 15px; color: rgba(255,255,255,0.7); }

  /* ── CTA ── */
  .cta-section {
    background: white; text-align: center; padding: 120px 5%;
  }
  .cta-title { font-family: 'Plus Jakarta Sans', sans-serif; font-size: clamp(36px, 5vw, 64px); font-weight: 800; color: var(--navy); margin-bottom: 20px; line-height: 1.1; }
  .cta-sub { font-size: 20px; color: var(--gray-400); max-width: 500px; margin: 0 auto 48px; }
  .cta-actions { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; }

  /* ── FOOTER ── */
  footer {
    background: var(--navy); padding: 60px 5% 40px;
  }
  .footer-top { display: flex; justify-content: space-between; gap: 40px; flex-wrap: wrap; margin-bottom: 48px; }
  .footer-brand .nav-logo { margin-bottom: 16px; }
  .footer-brand p { font-size: 14px; color: rgba(255,255,255,0.45); max-width: 260px; line-height: 1.7; }
  .footer-links h4 { font-size: 13px; font-weight: 600; color: rgba(255,255,255,0.35); letter-spacing: 0.08em; text-transform: uppercase; margin-bottom: 16px; }
  .footer-links ul { list-style: none; display: flex; flex-direction: column; gap: 10px; }
  .footer-links a { font-size: 14px; color: rgba(255,255,255,0.6); text-decoration: none; transition: color 0.2s; }
  .footer-links a:hover { color: white; }
  .footer-bottom { border-top: 1px solid rgba(255,255,255,0.1); padding-top: 24px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; }
  .footer-bottom p { font-size: 13px; color: rgba(255,255,255,0.35); }
  .footer-badges { display: flex; gap: 8px; }
  .footer-badge {
    font-size: 11px; font-weight: 600; padding: 4px 10px; border-radius: 100px;
    border: 1px solid rgba(255,255,255,0.2); color: rgba(255,255,255,0.5);
    letter-spacing: 0.05em;
  }

  /* ── ANIMATIONS ── */
  @keyframes fadeUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
  .hero > * { animation: fadeUp 0.7s ease both; }
  .hero-badge { animation-delay: 0.1s; }
  .hero h1 { animation-delay: 0.25s; }
  .hero-sub { animation-delay: 0.4s; }
  .hero-actions { animation-delay: 0.55s; }
  .hero-stats { animation-delay: 0.7s; }

  @media (max-width: 900px) {
    .features-grid, .roles-grid, .tech-grid { grid-template-columns: 1fr 1fr; }
    .kpi-strip { grid-template-columns: repeat(2, 1fr); }
    .mock-sidebar { width: 160px; }
    .mock-kpis { grid-template-columns: repeat(2, 1fr); }
    .mock-bottom { grid-template-columns: 1fr; }
    nav .nav-links { display: none; }
  }
  @media (max-width: 600px) {
    .features-grid, .roles-grid, .tech-grid { grid-template-columns: 1fr; }
    .kpi-strip { grid-template-columns: 1fr 1fr; }
    .hero-stats { gap: 24px; }
    .stat-sep { display: none; }
    .mockup-section { padding: 40px 5%; }
    .mock-sidebar { display: none; }
  }
</style>
</head>
<body>

<!-- NAV -->
<nav>
  <a class="nav-logo" href="#">
    <div class="nav-logo-icon">+</div>
    Sante+
  </a>
  <div class="nav-links">
    <a href="#features">Fonctionnalités</a>
    <a href="#roles">Rôles</a>
    <a href="#contact">Contact</a>
  </div>
  <div class="nav-cta">
    <a href="{{ route('login') }}" class="btn-outline">Se connecter</a>
    <a href="{{ route('register') }}" class="btn-primary">Démo gratuite →</a>
  </div>
</nav>

<!-- HERO -->
<section class="hero">
  <div class="hero-badge">Projet L3 IDA — UNCHK · 2024–2025</div>
  <h1>Gérez vos délégués<br><span>médicaux</span> depuis<br>une seule plateforme</h1>
  <p class="hero-sub">Digitalisez les visites, suivez les performances en temps réel et coordonnez vos équipes terrain avec Sante+ — la solution pensée pour le secteur pharmaceutique africain.</p>
  <div class="hero-actions">
    <a href="{{ route('register') }}" class="btn-hero">Essayer Sante+ →</a>
    <a href="#features" class="btn-hero-ghost">Voir les fonctionnalités</a>
  </div>
  <div class="hero-stats">
    <div class="stat-item">
      <span class="stat-num">3</span>
      <span class="stat-label">Rôles utilisateurs</span>
    </div>
    <div class="stat-sep"></div>
    <div class="stat-item">
      <span class="stat-num">28</span>
      <span class="stat-label">Fonctionnalités</span>
    </div>
    <div class="stat-sep"></div>
    <div class="stat-item">
      <span class="stat-num">99.5%</span>
      <span class="stat-label">Disponibilité cible</span>
    </div>
    <div class="stat-sep"></div>
    <div class="stat-item">
      <span class="stat-num">100%</span>
      <span class="stat-label">Sécurisé JWT+RBAC</span>
    </div>
  </div>
</section>

<!-- DASHBOARD MOCKUP -->
<div class="mockup-section">
  <div class="mockup-wrap">
    <div class="mockup-bar">
      <div class="dot dot-r"></div>
      <div class="dot dot-y"></div>
      <div class="dot dot-g"></div>
      <span>app.Sante+.sn</span>
    </div>
    <div class="mockup-body">
      <div class="mock-sidebar">
        <div class="mock-logo"><div class="mock-logo-icon">+</div> Sante+</div>
        <div class="mock-nav-item active"><span class="icon">⬛</span> Tableau de bord</div>
        <div class="mock-nav-item"><span class="icon">📅</span> Calendrier</div>
        <div class="mock-nav-item"><span class="icon">📋</span> Visites</div>
        <div class="mock-nav-item"><span class="icon">🗺</span> Carte & Tournées</div>
        <div class="mock-nav-item"><span class="icon">📊</span> Rapports</div>
        <div class="mock-nav-item"><span class="icon">🔔</span> Notifications <span class="mock-nav-badge">3</span></div>
        <div class="mock-nav-item"><span class="icon">📢</span> Campagnes</div>
        <div class="mock-nav-item"><span class="icon">⚙️</span> Paramètres</div>
      </div>
      <div class="mock-main">
        <div class="mock-header">
          <span class="mock-title">Tableau de bord</span>
          <div class="mock-avatar">AD</div>
        </div>
        <div class="mock-kpis">
          <div class="mock-kpi">
            <div class="mock-kpi-label">Visites du jour</div>
            <div class="mock-kpi-val">5</div>
            <div class="mock-kpi-trend">↑ +20% vs hier</div>
          </div>
          <div class="mock-kpi">
            <div class="mock-kpi-label">Visites semaine</div>
            <div class="mock-kpi-val">18</div>
            <div class="mock-kpi-trend">↑ +25% vs sem.</div>
          </div>
          <div class="mock-kpi">
            <div class="mock-kpi-label">Rapports en attente</div>
            <div class="mock-kpi-val">3</div>
            <div class="mock-kpi-trend warn">⚠ À compléter</div>
          </div>
          <div class="mock-kpi">
            <div class="mock-kpi-label">Taux de réalisation</div>
            <div class="mock-kpi-val">75%</div>
            <div class="mock-kpi-trend">15 / 20 visites</div>
          </div>
        </div>
        <div class="mock-bottom">
          <div class="mock-card">
            <div class="mock-card-title">Prochaines visites aujourd'hui</div>
            <div class="mock-visit-item">
              <span class="mock-time">09:00</span>
              <div class="mock-dr">Dr. Martin Pierre <span>Cardiologue · Hôpital Fann</span></div>
              <span class="mock-badge badge-green">Confirmée</span>
            </div>
            <div class="mock-visit-item">
              <span class="mock-time">11:30</span>
              <div class="mock-dr">Dr. Awa Ndiaye <span>Pédiatre · Clinique International</span></div>
              <span class="mock-badge badge-amber">En attente</span>
            </div>
            <div class="mock-visit-item">
              <span class="mock-time">14:30</span>
              <div class="mock-dr">Dr. Bernard Sophie <span>Généraliste · Cabinet Médical</span></div>
              <span class="mock-badge badge-green">Confirmée</span>
            </div>
          </div>
          <div class="mock-card">
            <div class="mock-card-title">Performance — Mai 2026</div>
            <div class="mock-perf-bar">
              <div class="mock-perf-label"><span>Amadou Diallo</span><span>90%</span></div>
              <div class="mock-bar-bg"><div class="mock-bar-fill" style="width:90%"></div></div>
            </div>
            <div class="mock-perf-bar">
              <div class="mock-perf-label"><span>Fatima Sow</span><span>110%</span></div>
              <div class="mock-bar-bg"><div class="mock-bar-fill green" style="width:100%"></div></div>
            </div>
            <div class="mock-perf-bar">
              <div class="mock-perf-label"><span>Moussa Kane</span><span>75%</span></div>
              <div class="mock-bar-bg"><div class="mock-bar-fill amber" style="width:75%"></div></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- KPI STRIP -->
<div class="kpi-strip">
  <div>
    <span class="kpi-strip-num">124</span>
    <span class="kpi-strip-label">Visites enregistrées / mois</span>
  </div>
  <div>
    <span class="kpi-strip-num">92%</span>
    <span class="kpi-strip-label">Couverture territoriale</span>
  </div>
  <div>
    <span class="kpi-strip-num">€45K</span>
    <span class="kpi-strip-label">Chiffre de vente suivi</span>
  </div>
  <div>
    <span class="kpi-strip-num">+12%</span>
    <span class="kpi-strip-label">Croissance mensuelle</span>
  </div>
</div>

<!-- FEATURES -->
<section id="features">
  <div style="max-width:1100px; margin:0 auto;">
    <div class="section-label">Fonctionnalités</div>
    <div class="section-title">Tout ce dont vous avez besoin, en un seul endroit</div>
    <div class="section-sub">6 modules intégrés pour digitaliser l'intégralité du cycle de vie des délégués médicaux.</div>
    <div class="features-grid">
      <div class="feat-card">
        <div class="feat-icon blue">🔐</div>
        <div class="feat-title">Authentification sécurisée</div>
        <div class="feat-desc">Connexion JWT, gestion RBAC par profil, vérification OTP, et protection OWASP. Vos données médicales sont protégées à chaque niveau.</div>
      </div>
      <div class="feat-card">
        <div class="feat-icon green">📍</div>
        <div class="feat-title">Gestion des visites</div>
        <div class="feat-desc">Planifiez, géolocalisez et archivez chaque visite médicale. Saisissez des rapports complets avec produits, remarques et résultats en temps réel.</div>
      </div>
      <div class="feat-card">
        <div class="feat-icon amber">🗺️</div>
        <div class="feat-title">Carte & Tournées optimisées</div>
        <div class="feat-desc">Visualisez vos circuits sur carte interactive et bénéficiez d'itinéraires optimisés. Réduisez les temps de trajet et maximisez le nombre de visites.</div>
      </div>
      <div class="feat-card">
        <div class="feat-icon coral">📊</div>
        <div class="feat-title">KPI & Tableaux de bord</div>
        <div class="feat-desc">Suivez les taux de couverture, comparez les performances entre délégués et recevez des alertes automatiques. Décidez sur la base de données fiables.</div>
      </div>
      <div class="feat-card">
        <div class="feat-icon purple">📢</div>
        <div class="feat-title">Campagnes promotionnelles</div>
        <div class="feat-desc">Créez et déployez des campagnes digitales, associez des supports (brochures, fiches produit) et suivez la distribution des échantillons médicaux.</div>
      </div>
      <div class="feat-card">
        <div class="feat-icon teal">📑</div>
        <div class="feat-title">Rapports automatiques</div>
        <div class="feat-desc">Générez des rapports PDF personnalisés par période, par délégué ou par territoire. Téléchargement immédiat, prêts pour les réunions de direction.</div>
      </div>
    </div>
  </div>
</section>

<!-- ROLES -->
<section class="roles-section" id="roles">
  <div style="max-width:1100px; margin:0 auto;">
    <div class="section-label" style="color:#4d9cff;">Trois profils, une plateforme</div>
    <div class="section-title">Conçu pour chaque acteur du terrain</div>
    <div class="section-sub">Sante+ s'adapte au rôle de chaque utilisateur grâce à des espaces cloisonnés et sécurisés.</div>
    <div class="roles-grid">
      <div class="role-card">
        <span class="role-num">01</span>
        <div class="role-sub">Terrain</div>
        <div class="role-title">Délégué médical</div>
        <div class="role-desc">Gérez vos visites quotidiennes, naviguez avec l'itinéraire optimisé et soumettez vos rapports directement depuis le terrain.</div>
        <ul class="role-features">
          <li>Calendrier de visites hebdomadaire/mensuel</li>
          <li>Géolocalisation automatique de chaque visite</li>
          <li>Rapport de visite complet et archivage</li>
          <li>Suivi des campagnes et échantillons</li>
          <li>Notifications et rappels push</li>
        </ul>
      </div>
      <div class="role-card">
        <span class="role-num">02</span>
        <div class="role-sub">Supervision</div>
        <div class="role-title">Manager</div>
        <div class="role-desc">Pilotez votre équipe avec des KPI en temps réel, validez les rapports de visite et déployez des campagnes promotionnelles ciblées.</div>
        <ul class="role-features">
          <li>Tableau de bord KPI centralisé</li>
          <li>Validation / rejet des rapports de visite</li>
          <li>Comparaison des performances individuelles</li>
          <li>Création et gestion des campagnes</li>
          <li>Alertes en cas d'inactivité ou dépassement</li>
        </ul>
      </div>
      <div class="role-card">
        <span class="role-num">03</span>
        <div class="role-sub">Partenaire</div>
        <div class="role-title">Professionnel de santé</div>
        <div class="role-desc">Médecins et pharmaciens accèdent à un espace d'échange sécurisé pour consulter les fiches produits et communiquer avec les délégués.</div>
        <ul class="role-features">
          <li>Espace d'échange chiffré AES-256</li>
          <li>Consultation des fiches produits</li>
          <li>Téléchargement des documents médicaux</li>
          <li>Gestion du profil (spécialité, établissement)</li>
          <li>Notifications personnalisées</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-section" id="contact">
  <div class="cta-title">Prêt à digitaliser<br>vos équipes terrain ?</div>
  <p class="cta-sub">Découvrez Sante+ en action avec un compte de démonstration gratuit — aucune installation requise.</p>
  <div class="cta-actions">
    <a href="{{ route('login') }}" class="btn-hero">Accéder à la démo →</a>
    <a href="#contact" class="btn-outline" style="padding:14px 28px; font-size:16px;">En savoir plus</a>
  </div>
  
</section>

<!-- FOOTER -->
<footer>
  <div class="footer-top">
    <div class="footer-brand">
      <a class="nav-logo" href="#" style="color:white;">
        <div class="nav-logo-icon">+</div> Sante +
      </a>
      <p>Plateforme digitale de gestion des délégués médicaux. Projet de fin de cycle — Licence 3 IDA, UNCHK.</p>
    </div>

  </div>
  <div class="footer-bottom">
    <p>© 2025 Sante+</p>
  </div>
</footer>

</body>
</html>
