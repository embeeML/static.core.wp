<p align="center">
<a href="https://blog.embeemedialab.com/staticpress">
  <img alt="StaticCore Wordpress Theme Starter for Elementor" src="https://embeemedialab.com/assets/img/logo/navnamelite2.png">
</a>
</p>


# StaticCore WordPress Theme

**StaticCore** is a lightweight WordPress starter theme built for static HTML/CSS websites that require CMS capabilities for select pages. Optimized for Elementor, StaticCore provides a flexible foundation for developers building streamlined WordPress projects.

---

## Table of Contents
1. [Features](#features)
2. [Requirements](#requirements)
3. [Installation](#installation)
4. [Getting Started](#getting-started)
5. [Template Structure](#template-structure)
6. [Customization](#customization)
7. [Contributing](#contributing)
8. [License](#license)
9. [Support](#support)

---

## Features

### Core Capabilities
- Designed for static HTML/CSS websites with select CMS-managed pages.
- Lightweight and fast — minimal overhead and a streamlined CSS reset baseline.
- Developer-friendly for quick setup and easy customization.
- Fully responsive layout with mobile hamburger navigation menu.

### Page Builder & Plugin Compatibility
- **Elementor** ready — includes `appearance-tools` support for Elementor's site editor.
- **WooCommerce** compatible out of the box via `add_theme_support( 'woocommerce' )`.

### SEO & Structured Data
- Auto-generated `<meta name="description">` tag (uses excerpt on single posts, site description elsewhere).
- Open Graph meta tags (`og:title`, `og:description`, `og:url`, `og:image`, `og:type`).
- Twitter Card meta tags (`twitter:card`, `twitter:title`, `twitter:description`, `twitter:image`).
- Canonical URL tag on every page.
- JSON-LD structured data blocks for `WebSite` and `Organization` schemas.
- Schema.org `itemscope`/`itemtype` attributes on the `<html>` element and navigation links.
- Automatic pingback link tag on singular posts.
- Customizable document title separator (defaults to `|`).

### Accessibility
- Skip-to-content link rendered via `wp_body_open` action.
- Screen-reader-only text utility class (`.screen-reader-text`).
- Keyboard-accessible hamburger navigation with Escape-key close and focus-trap looper spans.

### Media & Assets
- **Responsive video** — `js/videos.js` automatically wraps embeds from YouTube, Vimeo, Dailymotion, Twitch, TikTok, Spotify, SoundCloud, and more into a fluid aspect-ratio container.
- **SVG icon library** — hundreds of brand and technology logo icons included in `/icons/` (SimpleIcons-compatible SVGs) with a pre-built `icons.css` stylesheet.
- Social media SVG icons (Facebook, Instagram, Pinterest, Twitter/X, YouTube) in `/images/`.
- `add_theme_support( 'post-thumbnails' )` — featured image support on all post types.
- `add_theme_support( 'responsive-embeds' )` — responsive block embeds.
- Image size optimization: removes the `medium_large`, `1536x1536`, and `2048x2048` auto-generated sizes to reduce server storage.

### Layout & Utility CSS Classes
- **Color helpers**: `.blue`, `.blue-dark`, `.green`, `.green-dark`, `.orange`, `.purple`, `.red`, `.yellow`, `.black`, `.white`, `.lighter`, `.darker`.
- **Box grid system**: `.box` (100%), `.box-2` (50%), `.box-3` / `.box-1-3` (33%), `.box-4` (25%), `.box-5` (20%), `.box-6` (17%), `.box-2-3` (67%).
- **Text alignment**: `.left`, `.center`, `.right`.
- **Float helpers**: `.float-left`, `.float-right`, `.clear`, `.clear-left`, `.clear-right`.
- **Layer / section helpers**: `.layer`, `.layer-inner`, `.overlay`, `.offset`, `.spacer`.
- **Shape helpers**: `.round`, `.circle`.
- **Responsive visibility**: `.mobile` (visible ≤768 px), `.desktop` (visible ≥769 px).
- Print-friendly stylesheet (hides header, sidebar, footer, comments, and media when printing).

### Other
- jQuery enqueued with `$` alias restored (`window.$ = window.jQuery`).
- Font Awesome Kit integration hooks already included in `functions.php` (replace the kit URL to activate).
- Google Fonts and Google Tag Manager placeholders commented in `header.php` for easy activation.
- Sidebar widget area (`primary-widget-area`) — automatically hides when no widgets are active and expands content to full width.
- Threaded comment reply script enqueued only when needed.
- Automatic feed links via `add_theme_support( 'automatic-feed-links' )`.
- Translation-ready with `load_theme_textdomain`.

---

## Requirements
- **WordPress** 5.2 or higher (tested up to 6.6.2).
- **PHP** 7.4 or higher.
- A working MySQL/MariaDB database.
- **Elementor** (free or Pro) — optional, but the theme is optimized for it.
- **WooCommerce** — optional, supported out of the box.

---

## Installation
1. Download the latest release ZIP from the [StaticCore GitHub repository](https://github.com/embeeML/static.core.wp).
2. In your WordPress admin panel go to **Appearance > Themes > Add New > Upload Theme**.
3. Upload the ZIP file and click **Install Now**.
4. Click **Activate** once installation completes.

**Manual installation:**
1. Extract the ZIP and copy the `static.core.wp` folder into `wp-content/themes/`.
2. In the WordPress admin panel go to **Appearance > Themes** and activate **StaticCore**.

---

## Getting Started

### 1. Set Up Your Navigation Menu
1. Go to **Appearance > Menus** and create a new menu.
2. Assign it to the **Main Menu** location.

### 2. Configure Your Logo
- Go to **Appearance > Customize > Site Identity**.
- Upload a **Site Logo** — StaticCore renders it automatically in the header.
- If no logo is uploaded, the Site Title text is displayed instead.

### 3. Add a Favicon
- Go to **Appearance > Customize > Site Identity** and upload a **Site Icon**, or
- Place your favicon at `assets/icons/favicon.svg` inside the theme folder (the header links to it automatically).

### 4. Configure Open Graph / Twitter Card Images
- Open `header.php` and update the `og:image` and `twitter:image` paths to point to your own social preview image:
  ```php
  // header.php — update this path:
  get_template_directory_uri() . '/assets/img/og/your-og-image.png'
  ```

### 5. Add Static HTML Sections to Pages
`page.php` includes a placeholder comment for static HTML/PHP blocks that appear on every WordPress page:
```php
<!-- 
** place html/php for any static sections that will be on all pages here. 
** See examples in docs
-->
```
Place any hero sections, announcement bars, or other shared HTML directly above or below that comment.

### 6. Set Up Widgets (Optional Sidebar)
- Go to **Appearance > Widgets** and add widgets to the **Sidebar Widget Area**.
- When widgets are active the sidebar appears automatically; when empty the content area expands to full width.

---

## Template Structure

| File | Purpose |
|---|---|
| `header.php` | Site header — `<html>`, `<head>`, SEO meta, branding, main nav, search form |
| `footer.php` | Site footer — copyright, `wp_footer()` |
| `index.php` | Default blog loop (posts archive) |
| `page.php` | Individual WordPress pages (supports inline static HTML sections) |
| `single.php` | Single blog post with comments and prev/next navigation |
| `archive.php` | Category, tag, date, and author archives |
| `search.php` | Search results |
| `404.php` | 404 Not Found page with search form fallback |
| `sidebar.php` | Sidebar widget area (rendered only when widgets are active) |
| `comments.php` | Comments list and comment form |
| `entry.php` | Single article partial (title, meta, content/summary switcher) |
| `entry-content.php` | Full post content partial |
| `entry-summary.php` | Excerpt/summary partial (used on archive and home pages) |
| `entry-meta.php` | Post meta partial (author, date, categories, tags) |
| `entry-footer.php` | Post footer partial (used on singular views) |
| `nav-below.php` | Older/newer post pagination (archives) |
| `nav-below-single.php` | Previous/next post navigation (single posts) |
| `author.php` | Author archive |
| `category.php` | Category archive |
| `tag.php` | Tag archive |
| `attachment.php` | Media attachment view |
| `functions.php` | Theme setup, enqueue scripts/styles, hooks, and filters |
| `style.css` | Theme stylesheet — CSS reset, layout, typography, utilities |
| `js/videos.js` | Responsive video wrapper jQuery plugin |
| `icons/icons.css` | Icon library stylesheet for `/icons/*.svg` files |

---

## Customization

### Styles
- Edit `style.css` to update the base reset, typography, colors, layout, or responsive breakpoints.
- The primary brand color used throughout the theme is `#007acc` — search and replace it to re-brand quickly.
- A **dark mode** media query is included in `style.css` but commented out — uncomment the `@media(prefers-color-scheme:dark)` block to enable it.

### Adding Stylesheets and Scripts
Add vendor or custom CSS/JS files in `functions.php` inside `staticCore_enqueue()`. Commented examples are already provided:
```php
// CSS example
wp_enqueue_style( 'my-lib', get_template_directory_uri() . '/assets/vendor/css/my-lib.min.css', array(), '1.0' );

// JS example
wp_enqueue_script( 'my-script', get_template_directory_uri() . '/assets/vendor/js/my-script.js', array( 'jquery' ), null, true );
```

### Font Awesome Icons
Functions for Font Awesome Kit support are already wired up in `functions.php`. To activate:
1. Get your kit URL from [fontawesome.com](https://fontawesome.com).
2. Replace the placeholder URL in `staticCore_enqueue_fa_kit()`:
   ```php
   $fa_kit_url = 'https://kit.fontawesome.com/YOUR-KIT-ID.js';
   ```
3. Uncomment the two `add_action` / `add_filter` calls at the bottom of `functions.php` if needed.

### Google Fonts
A commented `<link>` tag for Google Fonts is already present in `header.php`:
```html
<!-- google fonts if needed, uncomment and change to the correct url for your fonts.
<link href="https://fonts.googleapis.com/css2?family=YourFont&display=swap" rel="stylesheet">
-->
```

### Google Tag Manager
A commented GTM snippet is included in `header.php`. Replace `G-YOURTAG` with your actual Measurement ID and uncomment to activate.

### SVG Icon Library
The `/icons/` directory contains hundreds of SimpleIcons SVG brand logos. Reference them in your templates using the `icons.css` stylesheet or directly as `<img>` tags:
```html
<!-- as an image -->
<img src="<?php echo get_template_directory_uri(); ?>/icons/github.svg" alt="GitHub" width="32" height="32">
```

### Responsive Videos
Any `<iframe>` embed from YouTube, Vimeo, Dailymotion, Twitch, TikTok, Spotify, SoundCloud, and others is automatically wrapped in a fluid `.video-wrap` container by `js/videos.js` — no extra markup needed.

### Color & Layout Utility Classes
Use the built-in CSS utility classes directly in your HTML or Elementor custom CSS fields:
```html
<!-- Colored section -->
<div class="layer blue">
  <div class="layer-inner center">
    <h2>Hello World</h2>
  </div>
</div>

<!-- Three-column grid -->
<div class="boxes">
  <div class="box-3 white">Column 1</div>
  <div class="box-3 white">Column 2</div>
  <div class="box-3 white">Column 3</div>
</div>
```

### Elementor
StaticCore registers `appearance-tools` support which enables Elementor's full site editing capabilities. Build page layouts with Elementor's drag-and-drop builder; the theme handles the surrounding header, footer, sidebar, and global styles.

---

## Contributing
Contributions are welcome! To get started:
1. Fork the repository.
2. Create a feature or fix branch: `git checkout -b feature/your-feature-name`
3. Commit your changes with clear messages.
4. Open a Pull Request describing what you changed and why.

Please keep pull requests focused — one feature or fix per PR.

---

## License
StaticCore WordPress Theme is distributed under the terms of the [GNU General Public License v3 or later](https://www.gnu.org/licenses/gpl.html).

© Matthew Boyles Media 2023–2025

---

## Support
For questions or bug reports, please [open a GitHub issue](https://github.com/embeeML/static.core.wp/issues) or visit [embeemedialab.com](https://www.embeemedialab.com).
