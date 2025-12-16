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
 * Theme Dash - Language strings.
 *
 * @package    theme_dash
 * @copyright  2024 Dash Authority
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// General.
$string['pluginname'] = 'Dash';
$string['choosereadme'] = 'Dash is a modern, customizable theme for Moodle with dark mode support, customizable front page blocks, and comprehensive admin settings.';
$string['configtitle'] = 'Dash Settings';
$string['region-side-pre'] = 'Right';
$string['region-frontpage-top'] = 'Front page top';
$string['region-frontpage-bottom'] = 'Front page bottom';

// General Settings.
$string['generalsettings'] = 'General Settings';
$string['generalsettings_desc'] = 'Configure general theme settings including logo, favicon, and appearance options.';

$string['logo'] = 'Logo';
$string['logo_desc'] = 'Upload your site logo. Recommended size: 200x50 pixels.';

$string['favicon'] = 'Favicon';
$string['favicon_desc'] = 'Upload a favicon for your site. Recommended size: 32x32 pixels in ICO or PNG format.';

$string['appletouchicon'] = 'Apple Touch Icon';
$string['appletouchicon_desc'] = 'Upload an Apple Touch Icon for iOS devices. Recommended size: 180x180 pixels.';

$string['preset'] = 'Theme preset';
$string['preset_desc'] = 'Select the theme preset to use.';

$string['defaultdarkmode'] = 'Default to dark mode';
$string['defaultdarkmode_desc'] = 'If enabled, the theme will default to dark mode for new visitors.';

// Color Settings.
$string['colorsettings'] = 'Colors';
$string['colorsettings_desc'] = 'Customize the color scheme of your theme.';

$string['brandcolor'] = 'Primary color';
$string['brandcolor_desc'] = 'The primary brand color used for buttons, links, and accents. Default: #2563eb';

$string['secondarycolor'] = 'Secondary color';
$string['secondarycolor_desc'] = 'The secondary color used for text and headings. Default: #0f172a';

$string['successcolor'] = 'Success color';
$string['successcolor_desc'] = 'The color used for success messages and indicators. Default: #059669';

$string['warningcolor'] = 'Warning color';
$string['warningcolor_desc'] = 'The color used for warning messages. Default: #d97706';

$string['dangercolor'] = 'Danger color';
$string['dangercolor_desc'] = 'The color used for error messages and danger indicators. Default: #dc2626';

$string['scsspre'] = 'Raw initial SCSS';
$string['scsspre_desc'] = 'SCSS code that will be added before all other styles. Use this for variable overrides.';

$string['scss'] = 'Raw SCSS';
$string['scss_desc'] = 'SCSS code that will be added after all other styles. Use this for custom styling.';

// Front Page Settings.
$string['frontpagesettings'] = 'Front Page';
$string['frontpagesettings_desc'] = 'Configure the front page layout and content blocks.';

$string['enablehero'] = 'Enable hero block';
$string['enablehero_desc'] = 'Show a hero section at the top of the front page.';

$string['herocontent'] = 'Hero content';
$string['herocontent_desc'] = 'HTML content for the hero section.';

$string['herobackgroundimage'] = 'Hero background image';
$string['herobackgroundimage_desc'] = 'Upload a background image for the hero section.';

$string['enablefeatures'] = 'Enable features block';
$string['enablefeatures_desc'] = 'Show a features grid on the front page.';

$string['featurescontent'] = 'Features content';
$string['featurescontent_desc'] = 'HTML content for the features section.';

$string['enablecta'] = 'Enable CTA block';
$string['enablecta_desc'] = 'Show a call-to-action section on the front page.';

$string['ctacontent'] = 'CTA content';
$string['ctacontent_desc'] = 'HTML content for the call-to-action section.';

$string['enablestats'] = 'Enable stats block';
$string['enablestats_desc'] = 'Show a statistics section on the front page.';

$string['statscontent'] = 'Stats content';
$string['statscontent_desc'] = 'HTML content for the statistics section.';

$string['enabletestimonials'] = 'Enable testimonials block';
$string['enabletestimonials_desc'] = 'Show a testimonials section on the front page.';

$string['testimonialscontent'] = 'Testimonials content';
$string['testimonialscontent_desc'] = 'HTML content for the testimonials section.';

$string['enablefaq'] = 'Enable FAQ block';
$string['enablefaq_desc'] = 'Show an FAQ section on the front page.';

$string['faqcontent'] = 'FAQ content';
$string['faqcontent_desc'] = 'HTML content for the FAQ section.';

$string['enablepartners'] = 'Enable partners block';
$string['enablepartners_desc'] = 'Show a partners/sponsors section on the front page.';

$string['partnerscontent'] = 'Partners content';
$string['partnerscontent_desc'] = 'HTML content for the partners section.';

$string['enablecourses'] = 'Enable courses showcase';
$string['enablecourses_desc'] = 'Show featured courses on the front page.';

$string['coursescontent'] = 'Courses showcase content';
$string['coursescontent_desc'] = 'HTML content for the courses showcase section.';

// Login Page Settings.
$string['loginsettings'] = 'Login Page';
$string['loginsettings_desc'] = 'Customize the login page appearance.';

$string['loginbackgroundimage'] = 'Login background image';
$string['loginbackgroundimage_desc'] = 'Upload a background image for the login page.';

$string['loginboxposition'] = 'Login box position';
$string['loginboxposition_desc'] = 'Choose the position of the login box on the page.';
$string['loginboxleft'] = 'Left';
$string['loginboxcenter'] = 'Center';
$string['loginboxright'] = 'Right';

$string['logincustomhtml'] = 'Custom HTML above login form';
$string['logincustomhtml_desc'] = 'Add custom HTML content above the login form.';

// Footer Settings.
$string['footersettings'] = 'Footer';
$string['footersettings_desc'] = 'Configure the footer content and layout.';

$string['footercol1'] = 'Footer column 1';
$string['footercol1_desc'] = 'HTML content for footer column 1.';

$string['footercol2'] = 'Footer column 2';
$string['footercol2_desc'] = 'HTML content for footer column 2.';

$string['footercol3'] = 'Footer column 3';
$string['footercol3_desc'] = 'HTML content for footer column 3.';

$string['footercol4'] = 'Footer column 4';
$string['footercol4_desc'] = 'HTML content for footer column 4.';

$string['copyright'] = 'Copyright text';
$string['copyright_desc'] = 'Copyright text displayed in the footer. Use {year} for the current year.';

$string['socialfacebook'] = 'Facebook URL';
$string['socialfacebook_desc'] = 'Enter your Facebook page URL.';

$string['socialtwitter'] = 'Twitter URL';
$string['socialtwitter_desc'] = 'Enter your Twitter/X profile URL.';

$string['sociallinkedin'] = 'LinkedIn URL';
$string['sociallinkedin_desc'] = 'Enter your LinkedIn page URL.';

$string['socialinstagram'] = 'Instagram URL';
$string['socialinstagram_desc'] = 'Enter your Instagram profile URL.';

$string['socialyoutube'] = 'YouTube URL';
$string['socialyoutube_desc'] = 'Enter your YouTube channel URL.';

$string['socialgithub'] = 'GitHub URL';
$string['socialgithub_desc'] = 'Enter your GitHub profile or organization URL.';

// SEO Settings.
$string['seosettings'] = 'SEO';
$string['seosettings_desc'] = 'Configure search engine optimization settings.';

$string['metadescription'] = 'Meta description';
$string['metadescription_desc'] = 'Default meta description for the site.';

$string['themecolor'] = 'Theme color';
$string['themecolor_desc'] = 'The theme color for browser chrome and mobile devices.';

$string['enableopengraph'] = 'Enable Open Graph tags';
$string['enableopengraph_desc'] = 'Add Open Graph meta tags for better social media sharing.';

$string['ogimage'] = 'Open Graph image';
$string['ogimage_desc'] = 'Default image for social media sharing. Recommended size: 1200x630 pixels.';

// Email Settings.
$string['emailsettings'] = 'Email Templates';
$string['emailsettings_desc'] = 'Customize system email templates.';

$string['emailheader'] = 'Email header HTML';
$string['emailheader_desc'] = 'HTML content displayed at the top of system emails.';

$string['emailfooter'] = 'Email footer HTML';
$string['emailfooter_desc'] = 'HTML content displayed at the bottom of system emails.';

// Dark mode.
$string['darkmode'] = 'Dark mode';
$string['lightmode'] = 'Light mode';
$string['toggledarkmode'] = 'Toggle dark mode';

// Front page.
$string['viewallcourses'] = 'View all courses';
$string['featuredcourses'] = 'Featured courses';
$string['getstarted'] = 'Get started';
$string['learnmore'] = 'Learn more';

// Enrollment.
$string['enrollnow'] = 'Enrol now';
$string['courseduration'] = 'Duration';
$string['courselevel'] = 'Level';
$string['courseinstructor'] = 'Instructor';

// Misc.
$string['backtotop'] = 'Back to top';
$string['privacy:metadata'] = 'The Dash theme does not store any personal data.';

