<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'SantePlus') }} - Rapport Automatique</title>
    <style>
        /* Clone de la configuration Figtree/Tailwind de app.blade.php */
        body { 
            font-family: 'Figtree', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; 
            background-color: #f8fafc; 
            color: #111827; 
            margin: 0; 
            padding: 0; 
            -webkit-font-smoothing: antialiased;
        }
        .wrapper {
            width: 100%;
            padding: 40px 0;
        }
        .container { 
            max-width: 600px; 
            margin: 0 auto; 
            background-color: #ffffff; 
            border-radius: 16px; 
            overflow: hidden; 
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05), 0 1px 2px -1px rgba(0, 0, 0, 0.05); 
            border: 1px solid #f1f5f9; 
        }
        
        .header { 
            background-color: #ffffff; 
            padding: 24px 32px; 
            border-bottom: 1px solid #f1f5f9; 
        }
        .app-brand {
            font-size: 20px;
            font-weight: 700;
            color: #1e293b; 
            letter-spacing: -0.025em;
        }
        .app-brand span {
            color: #059669; 
        }
       
        .content { 
            padding: 32px; 
        }
        .welcome-text {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin-top: 0;
            margin-bottom: 8px;
        }
        .badge { 
            display: inline-block; 
            background-color: #d1fae5; 
            color: #065f46; 
            font-weight: 600; 
            font-size: 11px; 
            padding: 4px 10px; 
            border-radius: 8px; 
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        p {
            font-size: 14px;
            line-height: 1.6;
            color: #475569; 
            margin-bottom: 16px;
        }
        
        .info-box { 
            background-color: #f8fafc; 
            border: 1px solid #f1f5f9;
            padding: 20px; 
            border-radius: 12px; 
            margin: 24px 0; 
        }
        .info-title {
            font-size: 12px;
            font-weight: 700;
            color: #94a3b8; 
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 12px;
        }
        .info-item {
            font-size: 14px;
            color: #334155;
            margin-bottom: 8px;
        }
        .info-item:last-child {
            margin-bottom: 0;
        }
        .info-item strong {
            color: #0f172a;
        }
        /* Signature Area */
        .signature {
            margin-top: 32px;
            border-top: 1px solid #f1f5f9;
            padding-top: 20px;
        }
        /* Footer Muted Text */
        .footer { 
            background-color: #ffffff; 
            padding: 24px; 
            text-align: center; 
            font-size: 12px; 
            color: #94a3b8; 
            border-top: 1px solid #f1f5f9; 
        }
    </style>
</head>
<body>

    <div class="wrapper">
        <div class="container">
            <div class="header">
                <div class="app-brand">Med<span>Rep</span> / Sante<span>+</span></div>
            </div>

            <div class="content">
                <span class="badge">Rapport {{ $period }}</span>
                
                <h2 class="welcome-text">Bonjour Administrateur,</h2>
                <p>Le planificateur automatique de tâches vient de générer un nouveau document pour votre analyse d'activité.</p>
                
                <div class="info-box">
                    <div class="info-title">Métadonnées du Rapport</div>
                    <div class="info-item">• Type de fichier : <strong>Microsoft Excel (.xlsx)</strong></div>
                    <div class="info-item">• Périodicité : <strong>{{ $period }}</strong></div>
                    <div class="info-item">• Date d'extraction : <strong>{{ now()->format('d/m/Y à H:i') }}</strong></div>
                </div>

                <p>L'intégralité du registre des visites médicales a été consolidée. Le fichier est attaché directement en pièce jointe de cet e-mail.</p>
                <p>Vous pouvez l'ouvrir avec n'importe quel logiciel de tableur (Excel, Google Sheets, Calc) pour filtrer et approfondir les statistiques de productivité.</p>
                
                <div class="signature">
                    <p style="margin: 0; font-size: 13px;">Généré automatiquement par le <strong>Système de Rapports Sante+</strong>.</p>
                </div>
            </div>

            <div class="footer">
                Ceci est un message automatisé, merci de ne pas y répondre.<br>
                © {{ now()->year }} {{ config('app.name', 'Sante+') }}. Tous droits réservés.
            </div>
        </div>
    </div>

</body>
</html>