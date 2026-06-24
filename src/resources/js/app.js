/**
 * ╔══════════════════════════════════════════════════════════════╗
 * ║  SPRINT 4 · AB — Abibou Ndione                             ║
 * ║  Carte #4 — Composants Alpine.js                           ║
 * ║  Carte #5 — Dark mode localStorage                         ║
 * ║  Carte #6 — Accessibilité ARIA + navigation clavier        ║
 * ║  COLLER DANS : resources/js/app.js                         ║
 * ╚══════════════════════════════════════════════════════════════╝
 */

import Alpine   from 'alpinejs';
import focus    from '@alpinejs/focus';
import collapse from '@alpinejs/collapse';

Alpine.plugin(focus);
Alpine.plugin(collapse);

// ════════════════════════════════════════════════════════════════
// CARTE #5 — DARK MODE + SIDEBAR MOBILE (Carte #3)
// Toggle dark/light · préférence sauvegardée localStorage
// Checklist : test toggle · test rafraîchissement page
// ════════════════════════════════════════════════════════════════
window.appLayout = function () {
    return {
        sidebarOpen: false,

        // Lecture initiale depuis localStorage ou préférence OS
        darkMode: (() => {
            const saved = localStorage.getItem('medrep_dark_mode');
            if (saved !== null) return saved === 'true';
            return window.matchMedia('(prefers-color-scheme: dark)').matches;
        })(),

        init() {
            this.applyDarkMode();

            // Écouter les changements préférence OS
            window.matchMedia('(prefers-color-scheme: dark)')
                .addEventListener('change', (e) => {
                    if (localStorage.getItem('medrep_dark_mode') === null) {
                        this.darkMode = e.matches;
                        this.applyDarkMode();
                    }
                });

            // Fermer sidebar avec ESC (Carte #6 — accessibilité)
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') this.sidebarOpen = false;
            });
        },

        // Carte #5 — toggle dark/light
        toggleDarkMode() {
            this.darkMode = !this.darkMode;
            localStorage.setItem('medrep_dark_mode', String(this.darkMode));
            this.applyDarkMode();
        },

        applyDarkMode() {
            document.documentElement.classList.toggle('dark', this.darkMode);
        },
    };
};

// ════════════════════════════════════════════════════════════════
// CARTE #4 — MODAL CONFIRMATION SUPPRESSION
// Checklist : fermeture ESC + clic extérieur · accessibilité focus
// ════════════════════════════════════════════════════════════════
window.confirmModal = function () {
    return {
        isOpen:  false,
        message: 'Cette action est irréversible.',
        url:     '',
        method:  'DELETE',

        open(message, url, method = 'DELETE') {
            this.message = message;
            this.url     = url;
            this.method  = method;
            this.isOpen  = true;
            // Focus sur le bouton Annuler (Carte #6 — accessibilité)
            this.$nextTick(() => this.$refs.cancelBtn?.focus());
        },

        close() {
            this.isOpen = false;
        },

        confirm() {
            const form       = document.createElement('form');
            form.method      = 'POST';
            form.action      = this.url;

            const csrf       = document.createElement('input');
            csrf.type        = 'hidden';
            csrf.name        = '_token';
            csrf.value       = document.querySelector('meta[name="csrf-token"]').content;

            const method     = document.createElement('input');
            method.type      = 'hidden';
            method.name      = '_method';
            method.value     = this.method;

            form.append(csrf, method);
            document.body.appendChild(form);
            form.submit();
        },

        // Fermeture ESC (Carte #6)
        handleKeydown(e) {
            if (e.key === 'Escape') this.close();
        },
    };
};

// ════════════════════════════════════════════════════════════════
// CARTE #4 — MODAL APERÇU DOCUMENT
// ════════════════════════════════════════════════════════════════
window.documentPreview = function () {
    return {
        isOpen:   false,
        fileUrl:  '',
        fileType: '',
        title:    '',

        open(url, type, title = '') {
            this.fileUrl  = url;
            this.fileType = type;
            this.title    = title;
            this.isOpen   = true;
            this.$nextTick(() => {
                document.body.style.overflow = 'hidden';
                this.$refs.closeBtn?.focus();
            });
        },

        close() {
            this.isOpen  = false;
            this.fileUrl = '';
            document.body.style.overflow = '';
        },

        handleKeydown(e) {
            if (e.key === 'Escape') this.close();
        },
    };
};

// ════════════════════════════════════════════════════════════════
// CARTE #4 — DROPDOWN
// Checklist : fermeture ESC + clic extérieur · accessibilité focus
// ════════════════════════════════════════════════════════════════
window.dropdown = function () {
    return {
        open: false,

        toggle() { this.open = !this.open; },
        close()  { this.open = false; },

        handleKeydown(e) {
            if (e.key === 'Escape') {
                this.close();
                // Remettre le focus sur le déclencheur (Carte #6)
                this.$refs.trigger?.focus();
            }
        },
    };
};

// ════════════════════════════════════════════════════════════════
// CARTE #4 — TABS (dashboard, historique)
// Checklist : navigation clavier flèches (Carte #6)
// ════════════════════════════════════════════════════════════════
window.tabs = function (tabsList, defaultTab = null) {
    return {
        tabs:      tabsList,
        activeTab: defaultTab ?? tabsList[0],

        setActive(tab) { this.activeTab = tab; },
        isActive(tab)  { return this.activeTab === tab; },

        // Navigation clavier — Carte #6 accessibilité
        handleKeydown(e, tab) {
            const idx = this.tabs.indexOf(tab);
            if (e.key === 'ArrowRight' || e.key === 'ArrowDown') {
                e.preventDefault();
                this.setActive(this.tabs[(idx + 1) % this.tabs.length]);
            }
            if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') {
                e.preventDefault();
                this.setActive(this.tabs[(idx - 1 + this.tabs.length) % this.tabs.length]);
            }
        },
    };
};

// ════════════════════════════════════════════════════════════════
// CARTE #4 — TOAST NOTIFICATIONS
// ════════════════════════════════════════════════════════════════
window.toastManager = function () {
    return {
        toasts: [],

        add(message, type = 'success', duration = 4000) {
            const id = Date.now();
            this.toasts.push({ id, message, type });
            setTimeout(() => this.remove(id), duration);
        },

        remove(id) {
            this.toasts = this.toasts.filter(t => t.id !== id);
        },

        couleur(type) {
            return {
                success: 'bg-green-50 border-green-200 text-green-800',
                error:   'bg-red-50 border-red-200 text-red-800',
                warning: 'bg-yellow-50 border-yellow-200 text-yellow-800',
                info:    'bg-blue-50 border-blue-200 text-blue-800',
            }[type] ?? 'bg-gray-50 border-gray-200 text-gray-800';
        },
    };
};

// ════════════════════════════════════════════════════════════════
// CARTE #3 — RECHERCHE TEMPS RÉEL PRATICIENS (Alpine fetch)
// Checklist : test 0 résultats · test accent/casse · XSS protection
// ════════════════════════════════════════════════════════════════
window.searchPraticiens = function () {
    return {
        query:        '',
        results:      [],
        loading:      false,
        showDropdown: false,
        debounceTimer: null,

        init() {
            this.$watch('query', (val) => {
                clearTimeout(this.debounceTimer);
                if (val.length < 2) {
                    this.results      = [];
                    this.showDropdown = false;
                    return;
                }
                this.debounceTimer = setTimeout(() => this.search(val), 300);
            });
        },

        async search(terme) {
            this.loading = true;
            try {
                const res = await fetch(
                    `/praticiens/search?q=${encodeURIComponent(terme)}`,
                    {
                        headers: {
                            'Accept':           'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN':     document.querySelector('meta[name="csrf-token"]').content,
                        },
                    }
                );
                if (!res.ok) throw new Error('Erreur réseau');
                const data        = await res.json();
                // XSS protection : données brutes sans innerHTML
                this.results      = data.data ?? [];
                this.showDropdown = true;
            } catch (err) {
                console.error('Recherche praticiens :', err);
                this.results = [];
            } finally {
                this.loading = false;
            }
        },

        select(praticien) {
            this.query        = praticien.nom_complet;
            this.showDropdown = false;
            this.$dispatch('praticien-selected', { praticien });
        },

        clear() {
            this.query        = '';
            this.results      = [];
            this.showDropdown = false;
            this.$dispatch('praticien-selected', { praticien: null });
        },
    };
};

// ════════════════════════════════════════════════════════════════
// CARTE #6 — ACCESSIBILITÉ : Skip link clavier
// ════════════════════════════════════════════════════════════════
document.addEventListener('DOMContentLoaded', () => {
    const skip = document.createElement('a');
    skip.href        = '#main-content';
    skip.textContent = 'Aller au contenu principal';
    skip.className   = [
        'sr-only focus:not-sr-only',
        'focus:fixed focus:top-4 focus:left-4 focus:z-[9999]',
        'focus:px-4 focus:py-2 focus:bg-primary focus:text-white',
        'focus:rounded-xl focus:shadow-lg focus:text-sm focus:font-semibold',
    ].join(' ');
    document.body.prepend(skip);
});

// ── Démarrer Alpine ───────────────────────────────────────────
window.Alpine = Alpine;
Alpine.start();