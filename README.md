# Dash - Custom Moodle Theme

A modern, customizable Moodle 5.1.1 theme with dark mode support, customizable front page blocks, and comprehensive admin settings. Built for Dash Authority's LMS platform.

## Features

### Core Features
- **Dark Mode Toggle** - User preference stored in localStorage and synced with Moodle user preferences
- **CSS Custom Properties** - Easy theming with CSS variables for colors, spacing, and typography
- **Responsive Design** - Mobile-first approach with full tablet and desktop support
- **RTL Support** - Full right-to-left language layout support

### Customization
- **Front Page Blocks** - Pre-built HTML snippets (Hero, Features, CTA, Stats, Testimonials, FAQ, Partners)
- **Custom Login Page** - Multiple layouts with background image support
- **Footer Customization** - 4-column layout with social media links
- **Email Templates** - Branded HTML email templates

### SEO
- Custom favicon and Apple Touch Icon support
- Meta description configuration
- Open Graph tags for social sharing
- Theme color for browser chrome

### Performance
- SCSS compilation with aggressive caching
- AMD modules for JavaScript
- Font-display swap for Google Fonts
- Lazy loading for images

## Installation

1. Copy the `dash` folder to your Moodle's `theme/` directory
2. Navigate to Site Administration > Notifications to trigger the installation
3. Go to Site Administration > Appearance > Themes > Theme selector
4. Select "Dash" as your theme

## Configuration

After installation, configure the theme at:
**Site Administration > Appearance > Themes > Dash**

### Settings Tabs

- **General Settings** - Logo, favicon, dark mode default
- **Colors** - Primary/secondary colors, custom SCSS
- **Front Page** - Enable/disable blocks, edit content
- **Login Page** - Background image, box position
- **Footer** - 4 column content, social links, copyright
- **SEO** - Meta description, Open Graph settings
- **Email** - Custom email header/footer HTML

## File Structure

```
theme/dash/
├── config.php              # Theme configuration
├── version.php             # Plugin version
├── lib.php                 # Callbacks and utilities
├── settings.php            # Admin settings
├── lang/en/theme_dash.php  # Language strings
├── classes/output/         # Custom renderers
├── templates/              # Mustache templates
│   ├── columns2.mustache   # Main layout
│   ├── frontpage.mustache  # Front page
│   ├── login.mustache      # Login page
│   ├── footer.mustache     # Footer
│   ├── blocks/             # Front page block templates
│   └── core/               # Email templates
├── scss/                   # Styles
│   ├── preset/default.scss # Main entry point
│   ├── _variables.scss     # CSS custom properties
│   ├── _darkmode.scss      # Dark mode styles
│   ├── _topbar.scss        # Navigation
│   ├── _footer.scss        # Footer styles
│   ├── _blocks.scss        # Front page blocks
│   ├── _enrollment.scss    # Enrollment page
│   ├── _rtl.scss           # RTL support
│   └── _utilities.scss     # Utility classes
├── amd/src/                # JavaScript modules
│   ├── darkmode.js         # Dark mode toggle
│   └── frontpage.js        # Front page interactions
└── pix/                    # Images
```

## Color Palette

| Token | Light Mode | Dark Mode |
|-------|------------|-----------|
| Primary | #2563eb | #3b82f6 |
| Secondary | #0f172a | #f8fafc |
| Background | #ffffff | #0f172a |
| Surface | #f8fafc | #1e293b |
| Border | #e2e8f0 | #334155 |
| Success | #059669 | #10b981 |
| Warning | #d97706 | #f59e0b |
| Danger | #dc2626 | #ef4444 |

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome for Android)

## Development

### Compiling SCSS
SCSS is compiled automatically by Moodle. To force recompilation:
1. Enable Theme Designer mode in Site Administration > Appearance > Themes > Theme settings
2. Or purge caches in Site Administration > Development > Purge caches

### JavaScript (AMD)
AMD modules are located in `amd/src/`. After editing:
```bash
grunt amd
```

## Credits

- Inspired by Scholastica Theme
- Built on Moodle's Boost theme
- Typography: DM Sans (Google Fonts)

## License

GNU GPL v3 or later - http://www.gnu.org/copyleft/gpl.html

## Support

For support, please contact Dash Authority or submit an issue to the repository.

