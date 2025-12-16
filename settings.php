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
 * Theme Dash - Settings file.
 *
 * @package    theme_dash
 * @copyright  2024 Dash Authority
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {
    $settings = new theme_boost_admin_settingspage_tabs('themesettingdash', get_string('configtitle', 'theme_dash'));

    // =========================================================================
    // General Settings Tab
    // =========================================================================
    $page = new admin_settingpage('theme_dash_general', get_string('generalsettings', 'theme_dash'));

    // General settings description.
    $name = 'theme_dash/generalinfo';
    $heading = '';
    $information = get_string('generalsettings_desc', 'theme_dash');
    $setting = new admin_setting_heading($name, $heading, $information);
    $page->add($setting);

    // Logo upload.
    $name = 'theme_dash/logo';
    $title = get_string('logo', 'theme_dash');
    $description = get_string('logo_desc', 'theme_dash');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logo');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Favicon upload.
    $name = 'theme_dash/favicon';
    $title = get_string('favicon', 'theme_dash');
    $description = get_string('favicon_desc', 'theme_dash');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'favicon', 0,
        ['maxfiles' => 1, 'accepted_types' => ['.ico', '.png']]);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Apple Touch Icon upload.
    $name = 'theme_dash/appletouchicon';
    $title = get_string('appletouchicon', 'theme_dash');
    $description = get_string('appletouchicon_desc', 'theme_dash');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'appletouchicon', 0,
        ['maxfiles' => 1, 'accepted_types' => ['.png']]);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Theme preset.
    $name = 'theme_dash/preset';
    $title = get_string('preset', 'theme_dash');
    $description = get_string('preset_desc', 'theme_dash');
    $default = 'default';
    $choices = [
        'default' => 'Default',
    ];
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Default dark mode.
    $name = 'theme_dash/defaultdarkmode';
    $title = get_string('defaultdarkmode', 'theme_dash');
    $description = get_string('defaultdarkmode_desc', 'theme_dash');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);

    // =========================================================================
    // Colors Tab
    // =========================================================================
    $page = new admin_settingpage('theme_dash_colors', get_string('colorsettings', 'theme_dash'));

    // Colors description.
    $name = 'theme_dash/colorsinfo';
    $heading = '';
    $information = get_string('colorsettings_desc', 'theme_dash');
    $setting = new admin_setting_heading($name, $heading, $information);
    $page->add($setting);

    // Brand color.
    $name = 'theme_dash/brandcolor';
    $title = get_string('brandcolor', 'theme_dash');
    $description = get_string('brandcolor_desc', 'theme_dash');
    $default = '#2563eb';
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Secondary color.
    $name = 'theme_dash/secondarycolor';
    $title = get_string('secondarycolor', 'theme_dash');
    $description = get_string('secondarycolor_desc', 'theme_dash');
    $default = '#0f172a';
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Success color.
    $name = 'theme_dash/successcolor';
    $title = get_string('successcolor', 'theme_dash');
    $description = get_string('successcolor_desc', 'theme_dash');
    $default = '#059669';
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Warning color.
    $name = 'theme_dash/warningcolor';
    $title = get_string('warningcolor', 'theme_dash');
    $description = get_string('warningcolor_desc', 'theme_dash');
    $default = '#d97706';
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Danger color.
    $name = 'theme_dash/dangercolor';
    $title = get_string('dangercolor', 'theme_dash');
    $description = get_string('dangercolor_desc', 'theme_dash');
    $default = '#dc2626';
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Raw initial SCSS.
    $name = 'theme_dash/scsspre';
    $title = get_string('scsspre', 'theme_dash');
    $description = get_string('scsspre_desc', 'theme_dash');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Raw SCSS.
    $name = 'theme_dash/scss';
    $title = get_string('scss', 'theme_dash');
    $description = get_string('scss_desc', 'theme_dash');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);

    // =========================================================================
    // Front Page Tab
    // =========================================================================
    $page = new admin_settingpage('theme_dash_frontpage', get_string('frontpagesettings', 'theme_dash'));

    // Front page description.
    $name = 'theme_dash/frontpageinfo';
    $heading = '';
    $information = get_string('frontpagesettings_desc', 'theme_dash');
    $setting = new admin_setting_heading($name, $heading, $information);
    $page->add($setting);

    // --- Hero Block ---
    $name = 'theme_dash/heroheading';
    $heading = 'Hero Block';
    $setting = new admin_setting_heading($name, $heading, '');
    $page->add($setting);

    $name = 'theme_dash/enablehero';
    $title = get_string('enablehero', 'theme_dash');
    $description = get_string('enablehero_desc', 'theme_dash');
    $default = 1;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_dash/herocontent';
    $title = get_string('herocontent', 'theme_dash');
    $description = get_string('herocontent_desc', 'theme_dash');
    $default = '<h1>Welcome to Our Learning Platform</h1>
<p>Discover amazing courses and enhance your skills with our comprehensive learning programs.</p>
<a href="/course" class="btn-dash-primary btn-dash-lg">Browse Courses</a>
<a href="/login" class="btn-dash-outline btn-dash-lg">Get Started</a>';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_dash/herobackgroundimage';
    $title = get_string('herobackgroundimage', 'theme_dash');
    $description = get_string('herobackgroundimage_desc', 'theme_dash');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'herobackgroundimage');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // --- Features Block ---
    $name = 'theme_dash/featuresheading';
    $heading = 'Features Block';
    $setting = new admin_setting_heading($name, $heading, '');
    $page->add($setting);

    $name = 'theme_dash/enablefeatures';
    $title = get_string('enablefeatures', 'theme_dash');
    $description = get_string('enablefeatures_desc', 'theme_dash');
    $default = 1;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_dash/featurescontent';
    $title = get_string('featurescontent', 'theme_dash');
    $description = get_string('featurescontent_desc', 'theme_dash');
    $default = '<div class="dash-block-header">
    <h2 class="dash-block-title">Why Choose Us?</h2>
    <p class="dash-block-subtitle">Discover the features that make our platform stand out.</p>
</div>
<div class="dash-features-grid">
    <div class="dash-feature-card">
        <div class="dash-feature-icon"><i class="fa fa-graduation-cap"></i></div>
        <h3>Expert Instructors</h3>
        <p>Learn from industry professionals with years of experience.</p>
    </div>
    <div class="dash-feature-card">
        <div class="dash-feature-icon"><i class="fa fa-clock"></i></div>
        <h3>Flexible Learning</h3>
        <p>Study at your own pace, anytime and anywhere.</p>
    </div>
    <div class="dash-feature-card">
        <div class="dash-feature-icon"><i class="fa fa-certificate"></i></div>
        <h3>Certificates</h3>
        <p>Earn recognized certificates upon course completion.</p>
    </div>
</div>';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // --- CTA Block ---
    $name = 'theme_dash/ctaheading';
    $heading = 'Call to Action Block';
    $setting = new admin_setting_heading($name, $heading, '');
    $page->add($setting);

    $name = 'theme_dash/enablecta';
    $title = get_string('enablecta', 'theme_dash');
    $description = get_string('enablecta_desc', 'theme_dash');
    $default = 1;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_dash/ctacontent';
    $title = get_string('ctacontent', 'theme_dash');
    $description = get_string('ctacontent_desc', 'theme_dash');
    $default = '<div class="dash-cta-content">
    <h2>Ready to Start Learning?</h2>
    <p>Join thousands of students who are already advancing their careers with our courses.</p>
    <a href="/login/signup.php" class="btn-dash-primary btn-dash-lg" style="background: #fff; color: #2563eb;">Sign Up Free</a>
    <a href="/course" class="btn-dash-outline btn-dash-lg" style="border-color: #fff; color: #fff;">Browse Courses</a>
</div>';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // --- Stats Block ---
    $name = 'theme_dash/statsheading';
    $heading = 'Statistics Block';
    $setting = new admin_setting_heading($name, $heading, '');
    $page->add($setting);

    $name = 'theme_dash/enablestats';
    $title = get_string('enablestats', 'theme_dash');
    $description = get_string('enablestats_desc', 'theme_dash');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_dash/statscontent';
    $title = get_string('statscontent', 'theme_dash');
    $description = get_string('statscontent_desc', 'theme_dash');
    $default = '<div class="dash-block-header">
    <h2 class="dash-block-title">Our Impact</h2>
</div>
<div class="dash-stats-grid">
    <div class="dash-stat-item">
        <div class="dash-stat-number" data-count="5000">5,000+</div>
        <div class="dash-stat-label">Students</div>
    </div>
    <div class="dash-stat-item">
        <div class="dash-stat-number" data-count="100">100+</div>
        <div class="dash-stat-label">Courses</div>
    </div>
    <div class="dash-stat-item">
        <div class="dash-stat-number" data-count="50">50+</div>
        <div class="dash-stat-label">Instructors</div>
    </div>
    <div class="dash-stat-item">
        <div class="dash-stat-number" data-count="95">95%</div>
        <div class="dash-stat-label">Satisfaction</div>
    </div>
</div>';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // --- Testimonials Block ---
    $name = 'theme_dash/testimonialsheading';
    $heading = 'Testimonials Block';
    $setting = new admin_setting_heading($name, $heading, '');
    $page->add($setting);

    $name = 'theme_dash/enabletestimonials';
    $title = get_string('enabletestimonials', 'theme_dash');
    $description = get_string('enabletestimonials_desc', 'theme_dash');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_dash/testimonialscontent';
    $title = get_string('testimonialscontent', 'theme_dash');
    $description = get_string('testimonialscontent_desc', 'theme_dash');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // --- FAQ Block ---
    $name = 'theme_dash/faqheading';
    $heading = 'FAQ Block';
    $setting = new admin_setting_heading($name, $heading, '');
    $page->add($setting);

    $name = 'theme_dash/enablefaq';
    $title = get_string('enablefaq', 'theme_dash');
    $description = get_string('enablefaq_desc', 'theme_dash');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_dash/faqcontent';
    $title = get_string('faqcontent', 'theme_dash');
    $description = get_string('faqcontent_desc', 'theme_dash');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // --- Partners Block ---
    $name = 'theme_dash/partnersheading';
    $heading = 'Partners Block';
    $setting = new admin_setting_heading($name, $heading, '');
    $page->add($setting);

    $name = 'theme_dash/enablepartners';
    $title = get_string('enablepartners', 'theme_dash');
    $description = get_string('enablepartners_desc', 'theme_dash');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_dash/partnerscontent';
    $title = get_string('partnerscontent', 'theme_dash');
    $description = get_string('partnerscontent_desc', 'theme_dash');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // --- Courses Showcase Block ---
    $name = 'theme_dash/coursesheading';
    $heading = 'Courses Showcase Block';
    $setting = new admin_setting_heading($name, $heading, '');
    $page->add($setting);

    $name = 'theme_dash/enablecourses';
    $title = get_string('enablecourses', 'theme_dash');
    $description = get_string('enablecourses_desc', 'theme_dash');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_dash/coursescontent';
    $title = get_string('coursescontent', 'theme_dash');
    $description = get_string('coursescontent_desc', 'theme_dash');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);

    // =========================================================================
    // Login Page Tab
    // =========================================================================
    $page = new admin_settingpage('theme_dash_login', get_string('loginsettings', 'theme_dash'));

    // Login settings description.
    $name = 'theme_dash/logininfo';
    $heading = '';
    $information = get_string('loginsettings_desc', 'theme_dash');
    $setting = new admin_setting_heading($name, $heading, $information);
    $page->add($setting);

    // Login background image.
    $name = 'theme_dash/loginbackgroundimage';
    $title = get_string('loginbackgroundimage', 'theme_dash');
    $description = get_string('loginbackgroundimage_desc', 'theme_dash');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'loginbackgroundimage');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Login box position.
    $name = 'theme_dash/loginboxposition';
    $title = get_string('loginboxposition', 'theme_dash');
    $description = get_string('loginboxposition_desc', 'theme_dash');
    $default = 'center';
    $choices = [
        'left' => get_string('loginboxleft', 'theme_dash'),
        'center' => get_string('loginboxcenter', 'theme_dash'),
        'right' => get_string('loginboxright', 'theme_dash'),
    ];
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Custom HTML above login form.
    $name = 'theme_dash/logincustomhtml';
    $title = get_string('logincustomhtml', 'theme_dash');
    $description = get_string('logincustomhtml_desc', 'theme_dash');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);

    // =========================================================================
    // Footer Tab
    // =========================================================================
    $page = new admin_settingpage('theme_dash_footer', get_string('footersettings', 'theme_dash'));

    // Footer description.
    $name = 'theme_dash/footerinfo';
    $heading = '';
    $information = get_string('footersettings_desc', 'theme_dash');
    $setting = new admin_setting_heading($name, $heading, $information);
    $page->add($setting);

    // Footer column 1.
    $name = 'theme_dash/footercol1';
    $title = get_string('footercol1', 'theme_dash');
    $description = get_string('footercol1_desc', 'theme_dash');
    $default = '<h5>About Us</h5>
<p>We are dedicated to providing the best online learning experience with high-quality courses and expert instructors.</p>';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Footer column 2.
    $name = 'theme_dash/footercol2';
    $title = get_string('footercol2', 'theme_dash');
    $description = get_string('footercol2_desc', 'theme_dash');
    $default = '<h5>Quick Links</h5>
<ul>
    <li><a href="/course">All Courses</a></li>
    <li><a href="/login">Login</a></li>
    <li><a href="/login/signup.php">Register</a></li>
</ul>';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Footer column 3.
    $name = 'theme_dash/footercol3';
    $title = get_string('footercol3', 'theme_dash');
    $description = get_string('footercol3_desc', 'theme_dash');
    $default = '<h5>Support</h5>
<ul>
    <li><a href="#">Help Center</a></li>
    <li><a href="#">Contact Us</a></li>
    <li><a href="#">Privacy Policy</a></li>
</ul>';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Footer column 4.
    $name = 'theme_dash/footercol4';
    $title = get_string('footercol4', 'theme_dash');
    $description = get_string('footercol4_desc', 'theme_dash');
    $default = '<h5>Contact</h5>
<ul class="footer-contact">
    <li><i class="fa fa-envelope"></i> support@example.com</li>
    <li><i class="fa fa-phone"></i> +1 (555) 123-4567</li>
</ul>';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Copyright text.
    $name = 'theme_dash/copyright';
    $title = get_string('copyright', 'theme_dash');
    $description = get_string('copyright_desc', 'theme_dash');
    $default = '© {year} Your Company. All rights reserved.';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Social media links heading.
    $name = 'theme_dash/socialheading';
    $heading = 'Social Media Links';
    $setting = new admin_setting_heading($name, $heading, '');
    $page->add($setting);

    // Facebook URL.
    $name = 'theme_dash/socialfacebook';
    $title = get_string('socialfacebook', 'theme_dash');
    $description = get_string('socialfacebook_desc', 'theme_dash');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Twitter URL.
    $name = 'theme_dash/socialtwitter';
    $title = get_string('socialtwitter', 'theme_dash');
    $description = get_string('socialtwitter_desc', 'theme_dash');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // LinkedIn URL.
    $name = 'theme_dash/sociallinkedin';
    $title = get_string('sociallinkedin', 'theme_dash');
    $description = get_string('sociallinkedin_desc', 'theme_dash');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Instagram URL.
    $name = 'theme_dash/socialinstagram';
    $title = get_string('socialinstagram', 'theme_dash');
    $description = get_string('socialinstagram_desc', 'theme_dash');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // YouTube URL.
    $name = 'theme_dash/socialyoutube';
    $title = get_string('socialyoutube', 'theme_dash');
    $description = get_string('socialyoutube_desc', 'theme_dash');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // GitHub URL.
    $name = 'theme_dash/socialgithub';
    $title = get_string('socialgithub', 'theme_dash');
    $description = get_string('socialgithub_desc', 'theme_dash');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);

    // =========================================================================
    // SEO Tab
    // =========================================================================
    $page = new admin_settingpage('theme_dash_seo', get_string('seosettings', 'theme_dash'));

    // SEO description.
    $name = 'theme_dash/seoinfo';
    $heading = '';
    $information = get_string('seosettings_desc', 'theme_dash');
    $setting = new admin_setting_heading($name, $heading, $information);
    $page->add($setting);

    // Meta description.
    $name = 'theme_dash/metadescription';
    $title = get_string('metadescription', 'theme_dash');
    $description = get_string('metadescription_desc', 'theme_dash');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Theme color.
    $name = 'theme_dash/themecolor';
    $title = get_string('themecolor', 'theme_dash');
    $description = get_string('themecolor_desc', 'theme_dash');
    $default = '#2563eb';
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Enable Open Graph.
    $name = 'theme_dash/enableopengraph';
    $title = get_string('enableopengraph', 'theme_dash');
    $description = get_string('enableopengraph_desc', 'theme_dash');
    $default = 1;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Open Graph image.
    $name = 'theme_dash/ogimage';
    $title = get_string('ogimage', 'theme_dash');
    $description = get_string('ogimage_desc', 'theme_dash');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'ogimage');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);

    // =========================================================================
    // Email Tab
    // =========================================================================
    $page = new admin_settingpage('theme_dash_email', get_string('emailsettings', 'theme_dash'));

    // Email description.
    $name = 'theme_dash/emailinfo';
    $heading = '';
    $information = get_string('emailsettings_desc', 'theme_dash');
    $setting = new admin_setting_heading($name, $heading, $information);
    $page->add($setting);

    // Email header.
    $name = 'theme_dash/emailheader';
    $title = get_string('emailheader', 'theme_dash');
    $description = get_string('emailheader_desc', 'theme_dash');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Email footer.
    $name = 'theme_dash/emailfooter';
    $title = get_string('emailfooter', 'theme_dash');
    $description = get_string('emailfooter_desc', 'theme_dash');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);
}

