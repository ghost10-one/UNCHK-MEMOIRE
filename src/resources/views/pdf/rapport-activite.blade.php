<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Sante+ — Rapport de Productivité</title>
    <style>
        @page { margin: 0cm; }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            background-color: #F8FAFC;
            color: #1E2545;
            margin: 0;
            padding: 2cm 1.5cm 1.5cm 1.5cm;
            font-size: 13px;
            line-height: 1.5;
        }

        /* ── HEADER ── */
        .header {
            border-bottom: 1px solid #DDE1EE;
            padding-bottom: 20px;
            margin-bottom: 25px;
        }
        .logo-area { float: left; width: 50%; }
        .meta-area { float: right; width: 50%; text-align: right; }
        .clear { clear: both; }
        
        .nav-logo-icon {
            display: inline-block;
            width: 34px;
            height: 34px;
            background-color: #1D6EF5;
            color: #FFFFFF;
            text-align: center;
            line-height: 34px;
            font-size: 22px;
            font-weight: bold;
            border-radius: 8px;
            margin-right: 8px;
        }
        .nav-logo-text {
            font-size: 22px;
            font-weight: bold;
            color: #0A1628;
            vertical-align: middle;
            display: inline-block;
        }
        .project-badge {
            font-size: 10px;
            color: #1D6EF5;
            background-color: #EBF2FF;
            padding: 3px 10px;
            border-radius: 100px;
            display: inline-block;
            margin-top: 5px;
            font-weight: 600;
        }
        .report-title {
            font-size: 20px;
            font-weight: bold;
            color: #111827;
            margin-top: 0;
            margin-bottom: 5px;
        }
        .report-date { font-size: 12px; color: #8A92A9; }

        /* ── KPI CARDS ── */
        .kpi-table {
            width: 100%;
            margin-bottom: 25px;
            border-collapse: separate;
            border-spacing: 12px 0;
            margin-left: -12px;
        }
        .kpi-card {
            background-color: #FFFFFF;
            border: 1px solid #F0F2F8;
            border-radius: 16px;
            padding: 16px;
            width: 25%;
            vertical-align: top;
        }
        .kpi-label {
            font-size: 12px;
            font-weight: 500;
            color: #6B7280;
            margin-bottom: 8px;
            display: block;
        }
        .kpi-value {
            font-size: 24px;
            font-weight: bold;
            color: #111827;
            display: block;
        }
        .kpi-trend {
            font-size: 11px;
            color: #059669;
            font-weight: 500;
            margin-top: 4px;
        }

        /* ── GRILLE PRINCIPALE ── */
        .content-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 20px 0;
            margin-left: -20px;
        }
        .column-left { width: 45%; vertical-align: top; }
        .column-right { width: 55%; vertical-align: top; }

        .card {
            background-color: #FFFFFF;
            border: 1px solid #F0F2F8;
            border-radius: 16px;
            padding: 20px;
        }
        .card-title {
            font-size: 15px;
            font-weight: bold;
            color: #111827;
            margin-top: 0;
            margin-bottom: 15px;
            border-bottom: 1px solid #F3F4F6;
            padding-bottom: 10px;
        }

        /* Liste des Visites */
        .visit-item {
            padding: 12px 0;
            border-bottom: 1px solid #F3F4F6;
        }
        .visit-item:last-child { border-bottom: none; }
        
        .visit-time { font-size: 12px; color: #6B7280; font-weight: 500; margin-bottom: 4px; }
        .visit-doctor { font-size: 13px; font-weight: bold; color: #111827; }
        .visit-specialty { font-size: 12px; color: #6B7280; margin-bottom: 2px; }
        .visit-address { font-size: 11px; color: #9CA3AF; }

        /* Graphique & Blocs Performance */
        .perf-box { text-align: center; padding: 20px 0; }
        .perf-circle-text { font-size: 36px; font-weight: bold; color: #1D6EF5; }
        .perf-sub { font-size: 13px; color: #6B7280; margin-top: 5px; }

        /* Badges de Statut */
        .badge { font-size: 10px; font-weight: 600; padding: 2px 8px; border-radius: 100px; float: right; }
        .badge-confirm { background-color: #D1FAE5; color: #065F46; }
        .badge-pending { background-color: #FEF3DC; color: #9A6200; }

        .footer {
            position: fixed; bottom: 0.8cm; left: 1.5cm; right: 1.5cm;
            text-align: center; font-size: 10px; color: #9CA3AF;
            border-top: 1px solid #E5E7EB; padding-top: 10px;
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="logo-area">
            <div>
                <span class="nav-logo-icon">+</span>
                <span class="nav-logo-text">Sante+</span>
            </div>
            <div class="project-badge">Projet L3 IDA — UNCHK · 2024–2025</div>
        </div>
        <div class="meta-area">
            <h1 class="report-title">Rapport de Productivité</h1>
            <div class="report-date">Généré le {{ now()->translatedFormat('d F Y à H:i') }}</div>
        </div>
        <div class="clear"></div>
    </div>

    <table class="kpi-table">
        <tr>
            <td class="kpi-card">
                <span class="kpi-label">Visites du jour</span>
                <span class="kpi-value">{{ $visitesDuJour }}</span>
                <span class="kpi-trend">+20% vs hier</span>
            </td>
            <td class="kpi-card">
                <span class="kpi-label">Visites semaine</span>
                <span class="kpi-value">{{ $visitesSemaine }}</span>
                <span class="kpi-trend">+25% vs sem. dern.</span>
            </td>
            <td class="kpi-card">
                <span class="kpi-label">Rapports en attente</span>
                <span class="kpi-value">{{ $rapportsEnAttente }}</span>
                <span class="kpi-trend" style="color: #F5A623;">À compléter</span>
            </td>
            <td class="kpi-card">
                <span class="kpi-label">Taux Réalisation</span>
                <span class="kpi-value">{{ $tauxRealisation }}%</span>
                <span class="kpi-trend">{{ $realiseCount }} / {{ $totalVisitesObj }} visites</span>
            </td>
        </tr>
    </table>

    <table class="content-table">
        <tr>
            <td class="column-left">
                <div class="card">
                    <h3 class="card-title">Prochaines visites</h3>
                    
                    @forelse($prochainesVisites as $visite)
                    <div class="visit-item">
                        <span class="badge {{ $visite->statut === 'confirme' ? 'badge-confirm' : 'badge-pending' }}">
                            {{ $visite->statut_label ?? 'Statut' }}
                        </span>
                        <div class="visit-time">🕒 {{ $visite->heure_debut ? $visite->heure_debut->format('H:i') : 'N/A' }}</div>
                        <div class="visit-doctor">{{ $visite->praticien->nom ?? 'Inconnu' }} {{ $visite->praticien->prenom ?? '' }}</div>
                        <div class="visit-specialty">{{ $visite->praticien->specialite->nom ?? 'Médecin' }}</div>
                        <div class="visit-address">📍 {{ $visite->adresse_visite ?? 'Non précisée' }}</div>
                    </div>
                    @empty
                    <div style="color: #6B7280; text-align: center; padding: 20px 0;">Aucune visite aujourd'hui.</div>
                    @endforelse
                </div>
            </td>

            <td class="column-right">
                <div class="card" style="margin-bottom: 20px;">
                    <h3 class="card-title">Performance Globale</h3>
                    <div class="perf-box">
                        <div class="perf-circle-text">{{ $tauxRealisation }}%</div>
                        <div class="perf-sub">De l'objectif mensuel d'activité atteint</div>
                        <div style="font-size: 12px; color: #1D6EF5; font-weight: bold; margin-top: 10px;">
                            {{ $realiseCount }} visites validées / Objectif de {{ $totalVisitesObj }}
                        </div>
                    </div>
                </div>

                <div class="card">
                    <h3 class="card-title">Note d'audit</h3>
                    <p style="color: #4B5470; font-size: 11px; margin: 0;">
                        Ce document PDF certifie l'état actuel des bases de données de l'application Sante+. Les données ci-dessus reflètent fidèlement l'activité terrain de la période mentionnée.
                    </p>
                </div>
            </td>
        </tr>
    </table>

    <div class="footer">
        Sante+ — Plateforme Digitale des Délégués Médicaux · L3 IDA UNCHK · Généré de manière sécurisée.
    </div>

</body>
</html>