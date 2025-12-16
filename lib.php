<?php
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
 * Theme Dash - Library file.
 *
 * @package    theme_dash
 * @copyright  2024 Dash Authority
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Returns the main SCSS content.
 *
 * @param theme_config $theme The theme config object.
 * @return string The main SCSS content.
 */
function theme_dash_get_main_scss_content($theme) {
    global $CFG;

    $scss = '';

    // Get the preset file.
    $preset = !empty($theme->settings->preset) ? $theme->settings->preset : 'default';
    $presetfile = $CFG->dirroot . '/theme/dash/scss/preset/' . $preset . '.scss';

    if (file_exists($presetfile)) {
        $scss .= file_get_contents($presetfile);
    }

    return $scss;
}

/**
 * Returns the pre SCSS content.
 *
 * @param theme_config $theme The theme config object.
 * @return string The pre SCSS content.
 */
function theme_dash_get_pre_scss($theme) {
    $scss = '';
    $configurable = [
        // Config key => [SCSS variable name, default value].
        'brandcolor' => ['primary', '#2563eb'],
        'secondarycolor' => ['secondary', '#0f172a'],
        'successcolor' => ['success', '#059669'],
        'warningcolor' => ['warning', '#d97706'],
        'dangercolor' => ['danger', '#dc2626'],
    ];

    // Add configurable SCSS variables.
    foreach ($configurable as $configkey => $config) {
        list($scssvar, $default) = $config;
        $value = isset($theme->settings->$configkey) ? $theme->settings->$configkey : $default;
        $scss .= '$' . $scssvar . ': ' . $value . ";\n";
    }

    // Dark mode colors.
    $scss .= '
$dark-primary: #3b82f6;
$dark-secondary: #f8fafc;
$dark-bg: #0f172a;
$dark-surface: #1e293b;
$dark-border: #334155;
$dark-success: #10b981;
$dark-warning: #f59e0b;
$dark-danger: #ef4444;

$light-bg: #ffffff;
$light-surface: #f8fafc;
$light-border: #e2e8f0;
';

    // Add Google Font import.
    $scss .= '
@import url("https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap");
';

    // Add any pre-scss from settings.
    if (!empty($theme->settings->scsspre)) {
        $scss .= $theme->settings->scsspre;
    }

    return $scss;
}

/**
 * Returns the extra SCSS content.
 *
 * @param theme_config $theme The theme config object.
 * @return string The extra SCSS content.
 */
function theme_dash_get_extra_scss($theme) {
    $scss = '';

    // Add any custom CSS from settings.
    if (!empty($theme->settings->scss)) {
        $scss .= $theme->settings->scss;
    }

    return $scss;
}

/**
 * Serves any files associated with the theme settings.
 *
 * @param stdClass $course Course object.
 * @param stdClass $cm Course module object.
 * @param context $context Context.
 * @param string $filearea File area.
 * @param array $args Arguments.
 * @param bool $forcedownload Force download.
 * @param array $options Options.
 * @return bool
 */
function theme_dash_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = []) {
    if ($context->contextlevel == CONTEXT_SYSTEM) {
        $theme = theme_config::load('dash');

        // Serve logo files.
        if ($filearea === 'logo') {
            return $theme->setting_file_serve('logo', $args, $forcedownload, $options);
        }

        // Serve favicon files.
        if ($filearea === 'favicon') {
            return $theme->setting_file_serve('favicon', $args, $forcedownload, $options);
        }

        // Serve Apple Touch Icon files.
        if ($filearea === 'appletouchicon') {
            return $theme->setting_file_serve('appletouchicon', $args, $forcedownload, $options);
        }

        // Serve login background image.
        if ($filearea === 'loginbackgroundimage') {
            return $theme->setting_file_serve('loginbackgroundimage', $args, $forcedownload, $options);
        }

        // Serve hero background image.
        if ($filearea === 'herobackgroundimage') {
            return $theme->setting_file_serve('herobackgroundimage', $args, $forcedownload, $options);
        }

        send_file_not_found();
    }
}

/**
 * Returns the HTML for the page header.
 *
 * @return string HTML to be added to the page header.
 */
function theme_dash_get_page_head_additions() {
    global $PAGE;

    $theme = theme_config::load('dash');
    $html = '';

    // Add favicon.
    if (!empty($theme->settings->favicon)) {
        $faviconurl = $theme->setting_file_url('favicon', 'favicon');
        $html .= '<link rel="shortcut icon" href="' . $faviconurl . '" />';
    }

    // Add Apple Touch Icon.
    if (!empty($theme->settings->appletouchicon)) {
        $appletouchiconurl = $theme->setting_file_url('appletouchicon', 'appletouchicon');
        $html .= '<link rel="apple-touch-icon" href="' . $appletouchiconurl . '" />';
    }

    // Add theme color for browser chrome.
    if (!empty($theme->settings->themecolor)) {
        $html .= '<meta name="theme-color" content="' . $theme->settings->themecolor . '" />';
    }

    // Add meta description.
    if (!empty($theme->settings->metadescription)) {
        $html .= '<meta name="description" content="' . s($theme->settings->metadescription) . '" />';
    }

    // Add Open Graph tags.
    if (!empty($theme->settings->enableopengraph)) {
        $sitename = format_string(get_site()->fullname);
        $html .= '<meta property="og:site_name" content="' . s($sitename) . '" />';
        $html .= '<meta property="og:type" content="website" />';

        if (!empty($theme->settings->ogimage)) {
            $ogimageurl = $theme->setting_file_url('ogimage', 'ogimage');
            $html .= '<meta property="og:image" content="' . $ogimageurl . '" />';
        }
    }

    return $html;
}

/**
 * Get the current dark mode state.
 *
 * @return string 'light' or 'dark'.
 */
function theme_dash_get_darkmode_state() {
    global $USER;

    $theme = theme_config::load('dash');
    $default = !empty($theme->settings->defaultdarkmode) ? 'dark' : 'light';

    // Check user preference.
    if (isloggedin() && !isguestuser()) {
        $preference = get_user_preferences('theme_dash_darkmode', null);
        if ($preference !== null) {
            return $preference;
        }
    }

    return $default;
}

/**
 * Get footer content for a specific column.
 *
 * @param int $column Column number (1-4).
 * @return string HTML content.
 */
function theme_dash_get_footer_column($column) {
    $theme = theme_config::load('dash');
    $settingname = 'footercol' . $column;

    if (!empty($theme->settings->$settingname)) {
        return format_text($theme->settings->$settingname, FORMAT_HTML);
    }

    return '';
}

/**
 * Get social media links for footer.
 *
 * @return array Array of social media links.
 */
function theme_dash_get_social_links() {
    $theme = theme_config::load('dash');
    $socials = [];

    $networks = ['facebook', 'twitter', 'linkedin', 'instagram', 'youtube', 'github'];

    foreach ($networks as $network) {
        $settingname = 'social' . $network;
        if (!empty($theme->settings->$settingname)) {
            $socials[] = [
                'network' => $network,
                'url' => $theme->settings->$settingname,
                'icon' => 'fa-' . $network,
            ];
        }
    }

    return $socials;
}

/**
 * Get the copyright text for footer.
 *
 * @return string Copyright text.
 */
function theme_dash_get_copyright() {
    $theme = theme_config::load('dash');

    if (!empty($theme->settings->copyright)) {
        $year = date('Y');
        return str_replace('{year}', $year, $theme->settings->copyright);
    }

    return '© ' . date('Y') . ' ' . format_string(get_site()->fullname);
}

/**
 * Get front page block content.
 *
 * @param string $blockname Block name.
 * @return array Block data for mustache template.
 */
function theme_dash_get_frontpage_block($blockname) {
    $theme = theme_config::load('dash');
    $enablesetting = 'enable' . $blockname;
    $contentsetting = $blockname . 'content';

    if (empty($theme->settings->$enablesetting)) {
        return ['enabled' => false];
    }

    return [
        'enabled' => true,
        'content' => !empty($theme->settings->$contentsetting)
            ? format_text($theme->settings->$contentsetting, FORMAT_HTML)
            : '',
    ];
}

/**
 * Get email header HTML.
 *
 * @return string HTML content.
 */
function theme_dash_get_email_header() {
    $theme = theme_config::load('dash');

    if (!empty($theme->settings->emailheader)) {
        return $theme->settings->emailheader;
    }

    // Default email header.
    $sitename = format_string(get_site()->fullname);
    $brandcolor = !empty($theme->settings->brandcolor) ? $theme->settings->brandcolor : '#2563eb';

    return '
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: ' . $brandcolor . '; padding: 20px;">
        <tr>
            <td align="center">
                <h1 style="color: #ffffff; margin: 0; font-family: \'DM Sans\', Arial, sans-serif;">' . $sitename . '</h1>
            </td>
        </tr>
    </table>
    ';
}

/**
 * Get email footer HTML.
 *
 * @return string HTML content.
 */
function theme_dash_get_email_footer() {
    $theme = theme_config::load('dash');

    if (!empty($theme->settings->emailfooter)) {
        return $theme->settings->emailfooter;
    }

    // Default email footer.
    $sitename = format_string(get_site()->fullname);
    $year = date('Y');

    return '
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f8fafc; padding: 20px; margin-top: 20px;">
        <tr>
            <td align="center" style="color: #64748b; font-family: \'DM Sans\', Arial, sans-serif; font-size: 12px;">
                © ' . $year . ' ' . $sitename . '. All rights reserved.
            </td>
        </tr>
    </table>
    ';
}

/**
 * Inject page requirements.
 *
 * @param moodle_page $page The page object.
 */
function theme_dash_page_init(moodle_page $page) {
    $page->requires->js_call_amd('theme_dash/darkmode', 'init');
}

