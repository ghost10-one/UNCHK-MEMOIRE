import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            colors: {
                primary: {
                    50:  '#ECFDF7',
                    100: '#D1FAE9',
                    200: '#A7F3D6',
                    300: '#6EE7BE',
                    400: '#34D399',
                    500: '#1D9E75',
                    600: '#157F5E',
                    700: '#12684E',
                    800: '#11543F',
                    900: '#0F4435',
                    DEFAULT: '#1D9E75',
                },
                secondary: {
                    50:  '#F0FDFA',
                    100: '#CCFBF1',
                    200: '#99F6E4',
                    500: '#0EA5A5',
                    600: '#0F8585',
                    700: '#115E5E',
                    DEFAULT: '#0EA5A5',
                },
                success: { DEFAULT: '#22C55E', light: '#DCFCE7', dark: '#15803D' },
                danger:  { DEFAULT: '#EF4444', light: '#FEE2E2', dark: '#991B1B' },
                warning: { DEFAULT: '#F59E0B', light: '#FEF3C7', dark: '#92400E' },
                surface: {
                    DEFAULT: '#FFFFFF',
                    secondary: '#F5F7FB',
                    tertiary:  '#E8ECF4',
                },
                content: {
                    DEFAULT:   '#1A202C',
                    secondary: '#4A5568',
                    tertiary:  '#8A94A6',
                },
                dark: {
                    bg:      '#0F172A',
                    surface: '#1E293B',
                    border:  '#334155',
                    text:    '#E2E8F0',
                    muted:   '#94A3B8',
                },
            },
            fontFamily: {
                sans:    ['Inter', 'Poppins', ...defaultTheme.fontFamily.sans],
                heading: ['Poppins', 'Inter', ...defaultTheme.fontFamily.sans],
            },
            borderRadius: {
                xl:    '1rem',
                '2xl': '1.25rem',
                '3xl': '1.5rem',
            },
            boxShadow: {
                sm:      '0 2px 8px rgba(15,23,42,0.04)',
                md:      '0 8px 24px rgba(15,23,42,0.08)',
                lg:      '0 18px 48px rgba(15,23,42,0.12)',
                'dark-sm': '0 2px 8px rgba(0,0,0,0.3)',
                'dark-md': '0 4px 20px rgba(0,0,0,0.4)',
            },
            keyframes: {
                'fade-in':  { '0%': { opacity: '0', transform: 'translateY(4px)' }, '100%': { opacity: '1', transform: 'translateY(0)' } },
                'scale-in': { '0%': { opacity: '0', transform: 'scale(0.95)' }, '100%': { opacity: '1', transform: 'scale(1)' } },
                'slide-in': { '0%': { opacity: '0', transform: 'translateX(-8px)' }, '100%': { opacity: '1', transform: 'translateX(0)' } },
            },
            animation: {
                'fade-in':  'fade-in 0.2s ease-out',
                'scale-in': 'scale-in 0.15s ease-out',
                'slide-in': 'slide-in 0.2s ease-out',
            },
        },
    },

    plugins: [
        forms,
        function ({ addComponents, addUtilities, theme }) {
            addComponents({
                '.btn': {
                    display: 'inline-flex', alignItems: 'center', gap: theme('spacing.2'),
                    padding: `${theme('spacing[2.5]')} ${theme('spacing.4')}`,
                    borderRadius: theme('borderRadius.xl'),
                    fontSize: theme('fontSize.sm')[0], fontWeight: '600',
                    border: '1.5px solid transparent',
                    transition: 'all 0.2s ease', cursor: 'pointer',
                    '&:focus-visible': { outline: `2px solid ${theme('colors.primary.DEFAULT')}`, outlineOffset: '2px' },
                },
                '.btn-primary': {
                    backgroundColor: theme('colors.primary.DEFAULT'), color: '#fff',
                    '&:hover': { backgroundColor: theme('colors.primary.600') },
                },
                '.btn-secondary': {
                    backgroundColor: theme('colors.secondary.DEFAULT'), color: '#fff',
                    '&:hover': { backgroundColor: theme('colors.secondary.600') },
                },
                '.btn-outline': {
                    backgroundColor: 'transparent', color: theme('colors.content.secondary'),
                    borderColor: theme('colors.surface.tertiary'),
                    '&:hover': { backgroundColor: theme('colors.surface.secondary') },
                },
                '.btn-danger': {
                    backgroundColor: theme('colors.danger.DEFAULT'), color: '#fff',
                    '&:hover': { backgroundColor: theme('colors.danger.dark') },
                },
                '.btn-ghost': {
                    backgroundColor: 'transparent', color: theme('colors.content.secondary'),
                    '&:hover': { backgroundColor: theme('colors.surface.secondary') },
                },
                '.btn-sm': { padding: `${theme('spacing[1.5]')} ${theme('spacing.3')}`, fontSize: theme('fontSize.xs')[0] },
                '.btn-lg': { padding: `${theme('spacing.3')} ${theme('spacing.6')}`, fontSize: theme('fontSize.base')[0] },
                '.card': {
                    backgroundColor: '#FFFFFF',
                    borderRadius: theme('borderRadius.xl'),
                    border: `0.5px solid ${theme('colors.surface.tertiary')}`,
                    boxShadow: theme('boxShadow.sm'),
                    padding: theme('spacing.6'),
                },
                '.dark .card': {
                    backgroundColor: theme('colors.dark.surface'),
                    borderColor: theme('colors.dark.border'),
                    boxShadow: theme('boxShadow[dark-sm]'),
                },
                '.badge': {
                    display: 'inline-flex', alignItems: 'center',
                    padding: `${theme('spacing[0.5]')} ${theme('spacing[2.5]')}`,
                    borderRadius: '9999px', fontSize: theme('fontSize.xs')[0], fontWeight: '600',
                },
                '.badge-success': { backgroundColor: theme('colors.success.light'), color: theme('colors.success.dark') },
                '.badge-danger':  { backgroundColor: theme('colors.danger.light'),  color: theme('colors.danger.dark') },
                '.badge-warning': { backgroundColor: theme('colors.warning.light'), color: theme('colors.warning.dark') },
                '.badge-primary': { backgroundColor: theme('colors.primary.100'), color: theme('colors.primary.700') },
                '.badge-secondary': { backgroundColor: theme('colors.secondary.100'), color: theme('colors.secondary.700') },
                '.badge-gray': { backgroundColor: theme('colors.surface.tertiary'), color: theme('colors.content.secondary') },
                '.form-input': {
                    width: '100%',
                    padding: `${theme('spacing[2.5]')} ${theme('spacing.4')}`,
                    border: `1.5px solid ${theme('colors.surface.tertiary')}`,
                    borderRadius: theme('borderRadius.xl'),
                    fontSize: theme('fontSize.sm')[0], color: theme('colors.content.DEFAULT'),
                    backgroundColor: '#FFFFFF', transition: 'all 0.2s ease',
                    '&:focus': { outline: 'none', borderColor: theme('colors.primary.DEFAULT'), boxShadow: `0 0 0 3px ${theme('colors.primary.100')}` },
                    '&::placeholder': { color: theme('colors.content.tertiary') },
                },
                '.form-label': {
                    display: 'block', fontSize: theme('fontSize.sm')[0],
                    fontWeight: '600', color: theme('colors.content.secondary'),
                    marginBottom: theme('spacing[1.5]'),
                },
                '.form-error': { marginTop: theme('spacing[1]'), fontSize: theme('fontSize.xs')[0], color: theme('colors.danger.DEFAULT') },
                '.form-select': {
                    width: '100%',
                    padding: `${theme('spacing[2.5]')} ${theme('spacing.4')}`,
                    border: `1.5px solid ${theme('colors.surface.tertiary')}`,
                    borderRadius: theme('borderRadius.xl'),
                    fontSize: theme('fontSize.sm')[0], backgroundColor: '#FFFFFF',
                    '&:focus': { outline: 'none', borderColor: theme('colors.primary.DEFAULT') },
                },
                '.nav-link': {
                    display: 'flex', alignItems: 'center', gap: theme('spacing.3'),
                    padding: `${theme('spacing[2.5]')} ${theme('spacing.4')}`,
                    borderRadius: theme('borderRadius.xl'),
                    fontSize: theme('fontSize.sm')[0], fontWeight: '500',
                    color: theme('colors.content.secondary'), transition: 'all 0.2s ease',
                    '&:hover': { backgroundColor: theme('colors.primary.50'), color: theme('colors.primary.DEFAULT') },
                },
                '.nav-link.active': {
                    backgroundColor: theme('colors.primary.DEFAULT'), color: '#FFFFFF',
                    boxShadow: theme('boxShadow.md'),
                },
            });

            addUtilities({
                '.focus-ring': {
                    '&:focus-visible': {
                        outline: `2px solid ${theme('colors.primary.DEFAULT')}`,
                        outlineOffset: '2px', borderRadius: '4px',
                    },
                },
                '.scrollbar-thin': {
                    scrollbarWidth: 'thin',
                    scrollbarColor: `${theme('colors.surface.tertiary')} transparent`,
                },
                '.text-2xs': { fontSize: '0.625rem', lineHeight: '0.875rem' },
            });
        },
    ],
};
