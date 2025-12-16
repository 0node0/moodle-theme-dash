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
 * Theme Dash - Core renderer.
 *
 * @package    theme_dash
 * @copyright  2024 Dash Authority
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_dash\output;

defined('MOODLE_INTERNAL') || die();

use moodle_url;
use html_writer;
use custom_menu;
use custom_menu_item;
use stdClass;
use context_course;
use theme_config;

/**
 * Theme Dash core renderer class.
 *
 * @package    theme_dash
 * @copyright  2024 Dash Authority
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_renderer extends \theme_boost\output\core_renderer {

    /**
     * Return the site's logo URL, if any.
     *
     * @param int $maxwidth The maximum width, or null when the maximum width does not matter.
     * @param int $maxheight The maximum height, or null when the maximum height does not matter.
     * @return moodle_url|false
     */
    public function get_logo_url($maxwidth = null, $maxheight = 200) {
        $theme = theme_config::load('dash');

        if (!empty($theme->settings->logo)) {
            $url = $theme->setting_file_url('logo', 'logo');
            if ($url) {
                return new moodle_url($url);
            }
        }

        return parent::get_logo_url($maxwidth, $maxheight);
    }

    /**
     * Return the site's compact logo URL, if any.
     *
     * @param int $maxwidth The maximum width, or null when the maximum width does not matter.
     * @param int $maxheight The maximum height, or null when the maximum height does not matter.
     * @return moodle_url|false
     */
    public function get_compact_logo_url($maxwidth = 300, $maxheight = 300) {
        return $this->get_logo_url($maxwidth, $maxheight);
    }

    /**
     * Return the favicon URL.
     *
     * @return moodle_url|string
     */
    public function favicon() {
        $theme = theme_config::load('dash');

        if (!empty($theme->settings->favicon)) {
            return $theme->setting_file_url('favicon', 'favicon');
        }

        return $this->image_url('favicon', 'theme_dash');
    }

    /**
     * Renders the header bar.
     *
     * @param array $headerinfo The header info.
     * @param int $headinglevel What level the 'h' tag will be.
     * @return string HTML for the header bar.
     */
    public function context_header($headerinfo = null, $headinglevel = 1) {
        return parent::context_header($headerinfo, $headinglevel);
    }

    /**
     * Returns the HTML for the page header additions (meta tags, etc).
     *
     * @return string HTML for additional head content.
     */
    public function standard_head_html() {
        $output = parent::standard_head_html();
        
        // Add theme-specific head content.
        $output .= $this->get_theme_head_additions();
        
        return $output;
    }

    /**
     * Get theme-specific head additions.
     *
     * @return string HTML for head additions.
     */
    protected function get_theme_head_additions() {
        $theme = theme_config::load('dash');
        $html = '';

        // Add custom favicon if set.
        if (!empty($theme->settings->favicon)) {
            $faviconurl = $theme->setting_file_url('favicon', 'favicon');
            $html .= '<link rel="shortcut icon" href="' . $faviconurl . '" />';
            $html .= '<link rel="icon" href="' . $faviconurl . '" />';
        }

        // Add Apple Touch Icon.
        if (!empty($theme->settings->appletouchicon)) {
            $appletouchiconurl = $theme->setting_file_url('appletouchicon', 'appletouchicon');
            $html .= '<link rel="apple-touch-icon" href="' . $appletouchiconurl . '" />';
        }

        // Add theme color for browser chrome.
        if (!empty($theme->settings->themecolor)) {
            $html .= '<meta name="theme-color" content="' . s($theme->settings->themecolor) . '" />';
        } else {
            $html .= '<meta name="theme-color" content="#2563eb" />';
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
            $html .= '<meta property="og:title" content="' . s($this->page->title) . '" />';

            if (!empty($theme->settings->ogimage)) {
                $ogimageurl = $theme->setting_file_url('ogimage', 'ogimage');
                $html .= '<meta property="og:image" content="' . $ogimageurl . '" />';
            }

            if (!empty($theme->settings->metadescription)) {
                $html .= '<meta property="og:description" content="' . s($theme->settings->metadescription) . '" />';
            }
        }

        // Add preconnect for Google Fonts.
        $html .= '<link rel="preconnect" href="https://fonts.googleapis.com">';
        $html .= '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';

        return $html;
    }

    /**
     * Renders the footer.
     *
     * @return string HTML for the footer.
     */
    public function footer() {
        return parent::footer();
    }

    /**
     * Get footer template context.
     *
     * @return array Template context.
     */
    public function get_footer_context() {
        $theme = theme_config::load('dash');
        $context = [];

        // Footer columns.
        for ($i = 1; $i <= 4; $i++) {
            $settingname = 'footercol' . $i;
            if (!empty($theme->settings->$settingname)) {
                $context['footercol' . $i] = format_text($theme->settings->$settingname, FORMAT_HTML);
            }
        }

        // Copyright.
        if (!empty($theme->settings->copyright)) {
            $year = date('Y');
            $context['copyright'] = str_replace('{year}', $year, $theme->settings->copyright);
        } else {
            $context['copyright'] = '© ' . date('Y') . ' ' . format_string(get_site()->fullname);
        }

        // Social links.
        $socials = ['facebook', 'twitter', 'linkedin', 'instagram', 'youtube', 'github'];
        $hassociallinks = false;
        foreach ($socials as $social) {
            $settingname = 'social' . $social;
            if (!empty($theme->settings->$settingname)) {
                $context['social' . $social] = $theme->settings->$settingname;
                $hassociallinks = true;
            }
        }
        $context['hassociallinks'] = $hassociallinks;

        return $context;
    }

    /**
     * Get front page template context.
     *
     * @return array Template context.
     */
    public function get_frontpage_context() {
        $theme = theme_config::load('dash');
        $context = [];

        // Hero block.
        $context['enablehero'] = !empty($theme->settings->enablehero);
        if ($context['enablehero'] && !empty($theme->settings->herocontent)) {
            $context['herocontent'] = format_text($theme->settings->herocontent, FORMAT_HTML);
        }
        if (!empty($theme->settings->herobackgroundimage)) {
            $context['heroimage'] = $theme->setting_file_url('herobackgroundimage', 'herobackgroundimage');
        }

        // Features block.
        $context['enablefeatures'] = !empty($theme->settings->enablefeatures);
        if ($context['enablefeatures'] && !empty($theme->settings->featurescontent)) {
            $context['featurescontent'] = format_text($theme->settings->featurescontent, FORMAT_HTML);
        }

        // CTA block.
        $context['enablecta'] = !empty($theme->settings->enablecta);
        if ($context['enablecta'] && !empty($theme->settings->ctacontent)) {
            $context['ctacontent'] = format_text($theme->settings->ctacontent, FORMAT_HTML);
        }

        // Stats block.
        $context['enablestats'] = !empty($theme->settings->enablestats);
        if ($context['enablestats'] && !empty($theme->settings->statscontent)) {
            $context['statscontent'] = format_text($theme->settings->statscontent, FORMAT_HTML);
        }

        // Testimonials block.
        $context['enabletestimonials'] = !empty($theme->settings->enabletestimonials);
        if ($context['enabletestimonials'] && !empty($theme->settings->testimonialscontent)) {
            $context['testimonialscontent'] = format_text($theme->settings->testimonialscontent, FORMAT_HTML);
        }

        // FAQ block.
        $context['enablefaq'] = !empty($theme->settings->enablefaq);
        if ($context['enablefaq'] && !empty($theme->settings->faqcontent)) {
            $context['faqcontent'] = format_text($theme->settings->faqcontent, FORMAT_HTML);
        }

        // Partners block.
        $context['enablepartners'] = !empty($theme->settings->enablepartners);
        if ($context['enablepartners'] && !empty($theme->settings->partnerscontent)) {
            $context['partnerscontent'] = format_text($theme->settings->partnerscontent, FORMAT_HTML);
        }

        // Courses showcase block.
        $context['enablecourses'] = !empty($theme->settings->enablecourses);
        if ($context['enablecourses'] && !empty($theme->settings->coursescontent)) {
            $context['coursescontent'] = format_text($theme->settings->coursescontent, FORMAT_HTML);
        }

        return $context;
    }

    /**
     * Get login page template context.
     *
     * @return array Template context.
     */
    public function get_login_context() {
        $theme = theme_config::load('dash');
        $context = [];

        // Site name.
        $context['sitename'] = format_string(get_site()->fullname);

        // Logo URL.
        $logourl = $this->get_logo_url();
        if ($logourl) {
            $context['logourl'] = $logourl->out(false);
        }

        // Login background image.
        if (!empty($theme->settings->loginbackgroundimage)) {
            $context['loginbackgroundimage'] = $theme->setting_file_url('loginbackgroundimage', 'loginbackgroundimage');
        }

        // Login box position.
        $context['loginboxposition'] = !empty($theme->settings->loginboxposition) ? $theme->settings->loginboxposition : 'center';

        // Custom HTML above login form.
        if (!empty($theme->settings->logincustomhtml)) {
            $context['logincustomhtml'] = format_text($theme->settings->logincustomhtml, FORMAT_HTML);
        }

        return $context;
    }

    /**
     * Returns HTML for the dark mode toggle button.
     *
     * @return string HTML for the dark mode toggle.
     */
    public function dark_mode_toggle() {
        return html_writer::tag('button', 
            html_writer::tag('span', 
                html_writer::tag('i', '', ['class' => 'fa fa-sun-o', 'aria-hidden' => 'true']),
                ['class' => 'icon-sun']
            ) .
            html_writer::tag('span', 
                html_writer::tag('i', '', ['class' => 'fa fa-moon-o', 'aria-hidden' => 'true']),
                ['class' => 'icon-moon']
            ),
            [
                'class' => 'dash-darkmode-toggle',
                'type' => 'button',
                'aria-label' => get_string('toggledarkmode', 'theme_dash'),
                'title' => get_string('toggledarkmode', 'theme_dash'),
            ]
        );
    }

    /**
     * Returns HTML for the back to top button.
     *
     * @return string HTML for back to top button.
     */
    public function back_to_top_button() {
        return html_writer::tag('button',
            html_writer::tag('i', '', ['class' => 'fa fa-chevron-up', 'aria-hidden' => 'true']),
            [
                'class' => 'dash-back-to-top',
                'type' => 'button',
                'aria-label' => get_string('backtotop', 'theme_dash'),
            ]
        );
    }
}

