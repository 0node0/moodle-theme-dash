// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Theme Dash - Dark mode toggle functionality.
 *
 * @module     theme_dash/darkmode
 * @copyright  2024 Dash Authority
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define(['jquery', 'core/ajax', 'core/notification'], function($, Ajax, Notification) {

    /**
     * Storage key for dark mode preference.
     * @type {string}
     */
    const STORAGE_KEY = 'theme_dash_darkmode';

    /**
     * Attribute name for theme data.
     * @type {string}
     */
    const THEME_ATTR = 'data-theme';

    /**
     * CSS class for dark mode.
     * @type {string}
     */
    const DARK_CLASS = 'dark-mode';

    /**
     * Get the current theme preference.
     *
     * @returns {string} 'light' or 'dark'
     */
    const getStoredTheme = function() {
        try {
            return localStorage.getItem(STORAGE_KEY);
        } catch (e) {
            return null;
        }
    };

    /**
     * Store the theme preference.
     *
     * @param {string} theme - 'light' or 'dark'
     */
    const setStoredTheme = function(theme) {
        try {
            localStorage.setItem(STORAGE_KEY, theme);
        } catch (e) {
            // localStorage not available, fail silently
        }
    };

    /**
     * Get the system preference for color scheme.
     *
     * @returns {string} 'light' or 'dark'
     */
    const getSystemPreference = function() {
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            return 'dark';
        }
        return 'light';
    };

    /**
     * Get the effective theme considering stored preference, system preference, and default.
     *
     * @param {string} defaultTheme - The default theme from settings
     * @returns {string} 'light' or 'dark'
     */
    const getEffectiveTheme = function(defaultTheme) {
        const stored = getStoredTheme();
        if (stored) {
            return stored;
        }

        // Check if there's a default from the theme settings
        if (defaultTheme) {
            return defaultTheme;
        }

        // Fall back to system preference
        return getSystemPreference();
    };

    /**
     * Apply the theme to the document.
     *
     * @param {string} theme - 'light' or 'dark'
     */
    const applyTheme = function(theme) {
        const html = document.documentElement;
        const body = document.body;

        if (theme === 'dark') {
            html.setAttribute(THEME_ATTR, 'dark');
            body.classList.add(DARK_CLASS);
        } else {
            html.setAttribute(THEME_ATTR, 'light');
            body.classList.remove(DARK_CLASS);
        }

        // Update any toggle buttons
        updateToggleButtons(theme);
    };

    /**
     * Update toggle button states and icons.
     *
     * @param {string} theme - Current theme
     */
    const updateToggleButtons = function(theme) {
        const toggleButtons = document.querySelectorAll('.dash-darkmode-toggle');

        toggleButtons.forEach(function(button) {
            const sunIcon = button.querySelector('.icon-sun');
            const moonIcon = button.querySelector('.icon-moon');

            if (theme === 'dark') {
                button.setAttribute('aria-pressed', 'true');
                button.setAttribute('title', M.util.get_string('lightmode', 'theme_dash'));
                if (sunIcon) sunIcon.style.display = 'block';
                if (moonIcon) moonIcon.style.display = 'none';
            } else {
                button.setAttribute('aria-pressed', 'false');
                button.setAttribute('title', M.util.get_string('darkmode', 'theme_dash'));
                if (sunIcon) sunIcon.style.display = 'none';
                if (moonIcon) moonIcon.style.display = 'block';
            }
        });
    };

    /**
     * Toggle between light and dark mode.
     *
     * @returns {string} The new theme
     */
    const toggleTheme = function() {
        const currentTheme = document.documentElement.getAttribute(THEME_ATTR) || 'light';
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

        applyTheme(newTheme);
        setStoredTheme(newTheme);
        saveUserPreference(newTheme);

        return newTheme;
    };

    /**
     * Save user preference to Moodle user preferences API.
     *
     * @param {string} theme - 'light' or 'dark'
     */
    const saveUserPreference = function(theme) {
        // Only save if user is logged in (M.cfg.sesskey indicates a session)
        if (typeof M !== 'undefined' && M.cfg && M.cfg.sesskey) {
            Ajax.call([{
                methodname: 'core_user_update_user_preferences',
                args: {
                    preferences: [{
                        type: 'theme_dash_darkmode',
                        value: theme
                    }]
                }
            }])[0].fail(Notification.exception);
        }
    };

    /**
     * Setup event listeners for toggle buttons.
     */
    const setupToggleButtons = function() {
        $(document).on('click', '.dash-darkmode-toggle', function(e) {
            e.preventDefault();
            toggleTheme();
        });

        // Keyboard support
        $(document).on('keydown', '.dash-darkmode-toggle', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                toggleTheme();
            }
        });
    };

    /**
     * Setup listener for system preference changes.
     */
    const setupSystemPreferenceListener = function() {
        if (window.matchMedia) {
            const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');

            const handleChange = function(e) {
                // Only auto-switch if user hasn't set a preference
                if (!getStoredTheme()) {
                    applyTheme(e.matches ? 'dark' : 'light');
                }
            };

            // Modern browsers
            if (mediaQuery.addEventListener) {
                mediaQuery.addEventListener('change', handleChange);
            } else if (mediaQuery.addListener) {
                // Older browsers
                mediaQuery.addListener(handleChange);
            }
        }
    };

    /**
     * Initialize the dark mode functionality.
     *
     * @param {Object} config - Configuration options
     * @param {string} config.defaultTheme - Default theme from settings
     */
    const init = function(config) {
        config = config || {};

        // Apply theme immediately to prevent flash
        const theme = getEffectiveTheme(config.defaultTheme);
        applyTheme(theme);

        // Setup event listeners when DOM is ready
        $(document).ready(function() {
            setupToggleButtons();
            setupSystemPreferenceListener();
        });
    };

    return {
        init: init,
        toggle: toggleTheme,
        getTheme: function() {
            return document.documentElement.getAttribute(THEME_ATTR) || 'light';
        },
        setTheme: function(theme) {
            applyTheme(theme);
            setStoredTheme(theme);
            saveUserPreference(theme);
        }
    };
});

