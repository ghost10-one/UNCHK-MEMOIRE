<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
/**
* Run the migrations.
*/
public function up(): void
{
		$driver = Schema::getConnection()->getDriverName();
		// Some view SQL uses Postgres-specific syntax; skip on SQLite
		if ($driver === 'sqlite') {
			return;
		}

		// Vue 1 : Visites par délégué
		DB::statement(<<<'SQL'
CREATE OR REPLACE VIEW visites_par_delegue AS
SELECT
	u.id,
	u.name,
	COUNT(v.id) AS total_visites,
	COUNT(CASE WHEN v.statut = 'realisee' THEN 1 END) AS visites_completees,
	COUNT(CASE WHEN v.statut IN ('planifiee','confirmee','en_cours') THEN 1 END) AS visites_en_attente,
	ROUND(
		COUNT(CASE WHEN v.statut = 'realisee' THEN 1 END)::numeric /
		NULLIF(COUNT(v.id), 0) * 100, 2
	) AS taux_realisation,
	MAX(v.date_visite) AS derniere_visite
FROM users u
LEFT JOIN visites v ON u.id = v.delegue_id
WHERE u.role = 'delegate'
GROUP BY u.id, u.name
ORDER BY total_visites DESC;
SQL
		);

		// Vue 2 : Campagnes actives par zone
		DB::statement(<<<'SQL'
CREATE OR REPLACE VIEW campagnes_actives_par_zone AS
SELECT
	c.id,
	c.titre AS campagne_titre,
	z.name AS zone_name,
	COUNT(v.id) AS total_visites,
	COUNT(CASE WHEN v.statut = 'realisee' THEN 1 END) AS visites_completees,
	c.statut,
	c.date_debut,
	c.date_fin,
	CASE
		WHEN CURRENT_DATE < c.date_debut THEN 'À venir'
		WHEN CURRENT_DATE BETWEEN c.date_debut AND c.date_fin THEN 'En cours'
		ELSE 'Terminée'
	END AS periode_statut
FROM campaigns c
LEFT JOIN visites v ON c.id = v.campagne_id
LEFT JOIN zones z ON c.zone_id = z.id
GROUP BY c.id, c.titre, z.name, c.statut, c.date_debut, c.date_fin
ORDER BY c.date_debut DESC;
SQL
		);

		// Vue 3 : Taux de réalisation tournées (via pivot visite_tournee)
		DB::statement(<<<'SQL'
CREATE OR REPLACE VIEW taux_realisation_tournees AS
SELECT
	t.id,
	t.titre AS tournee_titre,
	t.delegue_id,
	u.name AS delegue_name,
	COUNT(vt.visite_id) AS visites_planifiees,
	COUNT(CASE WHEN v.statut = 'realisee' THEN 1 END) AS visites_completees,
	ROUND(
		COUNT(CASE WHEN v.statut = 'realisee' THEN 1 END)::numeric /
		NULLIF(COUNT(vt.visite_id), 0) * 100, 2
	) AS taux_completion,
	t.created_at
FROM tournees t
LEFT JOIN users u ON t.delegue_id = u.id
LEFT JOIN visite_tournee vt ON t.id = vt.tournee_id
LEFT JOIN visites v ON vt.visite_id = v.id
GROUP BY t.id, t.titre, t.delegue_id, u.name, t.created_at
ORDER BY taux_completion DESC;
SQL
		);

		// Vue 4 : Performance globale par mois (basée sur date_visite)
		DB::statement(<<<'SQL'
CREATE OR REPLACE VIEW performance_mensuelle AS
SELECT
	DATE_TRUNC('month', v.date_visite)::DATE AS mois,
	COUNT(v.id) AS total_visites,
	COUNT(CASE WHEN v.statut = 'realisee' THEN 1 END) AS visites_completees,
	COUNT(DISTINCT v.delegue_id) AS delegues_actifs,
	COUNT(DISTINCT v.campagne_id) AS campagnes_actives,
	ROUND(
		COUNT(CASE WHEN v.statut = 'realisee' THEN 1 END)::numeric /
		NULLIF(COUNT(v.id), 0) * 100, 2
	) AS taux_global
FROM visites v
GROUP BY DATE_TRUNC('month', v.date_visite)
ORDER BY mois DESC;
SQL
		);

		// Vue 5 : Distribution des statuts de visites
		DB::statement(<<<'SQL'
CREATE OR REPLACE VIEW distribution_statuts_visites AS
SELECT
	v.statut,
	COUNT(v.id) AS nombre,
	ROUND(COUNT(v.id)::numeric / NULLIF((SELECT COUNT(*) FROM visites),0) * 100, 2) AS pourcentage
FROM visites v
GROUP BY v.statut
ORDER BY nombre DESC;
SQL
		);
}

/**
* Reverse the migrations.
*/
public function down(): void
{
	$driver = Schema::getConnection()->getDriverName();
	if ($driver === 'sqlite') {
		return;
	}

	DB::statement('DROP VIEW IF EXISTS visites_par_delegue');
	DB::statement('DROP VIEW IF EXISTS campagnes_actives_par_zone');
	DB::statement('DROP VIEW IF EXISTS taux_realisation_tournees');
	DB::statement('DROP VIEW IF EXISTS performance_mensuelle');
	DB::statement('DROP VIEW IF EXISTS distribution_statuts_visites');
}
};