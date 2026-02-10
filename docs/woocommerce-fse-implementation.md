# WooCommerce FSE Implementation Plan (Krystal)

## 1) High-Level Plan

1. Use a custom lightweight block theme (`krystal-commerce`) to stay native/FSE and avoid heavy builders.
2. Configure a cohesive design system in `theme.json` (type scale, spacing scale, radii, shadows, colors, gradients, button/form defaults).
3. Build reusable homepage patterns for conversion sections (hero, categories, featured products, USPs, testimonials, newsletter).
4. Implement WooCommerce-specific templates: shop archive, product category archive, single product, cart, checkout, and account.
5. Add minimal PHP and JS enhancements for conversion + UX:
   - simplified checkout fields,
   - product specs + shipping/returns tabs,
   - recently viewed products,
   - mobile sticky add-to-cart.
6. Ship operational guidance for setup, performance, security, SEO/analytics, and store manager workflows.

## 2) File Structure

```text
app/public/wp-content/themes/krystal-commerce/
├── assets/
│   ├── css/theme.css
│   └── js/store.js
├── inc/
│   ├── theme-setup.php
│   └── woocommerce.php
├── parts/
│   ├── checkout-footer.html
│   ├── checkout-header.html
│   ├── footer.html
│   └── header.html
├── patterns/
│   ├── home-featured-categories.php
│   ├── home-featured-products.php
│   ├── home-hero.php
│   ├── home-newsletter.php
│   ├── home-testimonials.php
│   └── home-usp-row.php
├── templates/
│   ├── archive-product.html
│   ├── front-page.html
│   ├── index.html
│   ├── page-cart.html
│   ├── page-checkout.html
│   ├── page-my-account.html
│   ├── page.html
│   ├── single-product.html
│   ├── single.html
│   └── taxonomy-product_cat.html
├── functions.php
├── README.md
├── style.css
└── theme.json
```

## 3) Local Setup

### Option A: LocalWP
1. Create a LocalWP site using PHP 8.2+ and MySQL 8+
2. Copy this theme into `wp-content/themes/krystal-commerce`.
3. In WP Admin install/activate plugins listed below.
4. Activate theme in **Appearance → Themes**.

### Option B: Docker + WP-CLI
```bash
# Start stack
docker compose up -d

# Install and activate WooCommerce
wp plugin install woocommerce --activate --path=/var/www/html

# Activate theme
wp theme activate krystal-commerce --path=/var/www/html
```

## 4) Minimal Plugins (Production)

- WooCommerce
- SEO: Yoast SEO **or** Rank Math
- Performance cache: LiteSpeed Cache **or** WP Rocket
- Security: Wordfence **or** Solid Security
- SMTP: WP Mail SMTP
- Optional lightweight wishlist: TI WooCommerce Wishlist (if needed)

## 5) IA + Required Pages

Create/verify these pages:
- Home
- Shop
- Cart
- Checkout
- My Account
- About
- Contact
- FAQ
- Shipping & Returns
- Privacy Policy
- Terms & Conditions

Shop category pages use `taxonomy-product_cat.html`; product pages use `single-product.html`.

## 6) Theme Configuration Steps

1. **Navigation**:
   - Add product categories to primary nav as dropdown items.
   - Header includes sticky behavior, search, account icon, mini-cart.
2. **Homepage**:
   - Uses reusable patterns in `front-page.html`.
   - Edit copy/images in Site Editor without code changes.
3. **Checkout**:
   - Uses dedicated checkout header/footer for distraction-free flow.
   - Guest checkout and account creation should be enabled in Woo settings.
4. **Store design**:
   - Maintain consistency via Global Styles (`theme.json`) instead of ad-hoc block styles.

## 7) WooCommerce Settings

- **General**: store address, currency, units.
- **Products**: categories, attributes, variations, stock notifications.
- **Shipping**: zones and methods (flat, free threshold, pickup).
- **Tax**: enable and configure classes/rates (country-specific values configurable).
- **Payments**: configure gateways via dashboard/env variables; never hardcode API keys.
- **Accounts & Privacy**:
  - enable guest checkout,
  - allow account creation at checkout,
  - define data retention.
- **Emails**: set sender identity, logo, color branding.

## 8) Performance Checklist + Tradeoffs

- Enable full page cache (best speed gains, must bypass cart/checkout/my-account).
- Enable object cache (Redis/Memcached) for catalog/query performance.
- Serve WebP/AVIF + responsive images (better LCP, slightly more processing/storage).
- Keep plugin footprint minimal (fewer features, lower JS/CSS bloat).
- Use block cart/checkout and HPOS (better Woo scalability, requires plugin compatibility check).
- Delay non-critical third-party scripts (better CWV, analytics tools may fire later).

## 9) Security Checklist

- Enforce least privilege roles (`Administrator`, `Shop Manager`, `Editor` split).
- Enable MFA for privileged users.
- Keep WP core, plugins, theme updated.
- Force HTTPS, secure cookies, and WAF/rate limits.
- Schedule backups + restore test.
- Add activity logs and malware scanning.
- Keep payment secrets in server config (`wp-config.php` constants or env vars), not in theme files.

## 10) SEO + Analytics Setup

- Configure title/meta templates and XML sitemap from SEO plugin.
- Keep product schema via WooCommerce enabled; validate in rich-results tools.
- Configure canonical URLs and robots index/follow as appropriate.
- Add Open Graph and Twitter cards via SEO plugin templates.
- GA4 ecommerce events:
  - `view_item`
  - `add_to_cart`
  - `begin_checkout`
  - `purchase`

## 11) QA Checklist

- Responsive checks at 320/375/768/1024/1440 widths.
- Keyboard-only navigation and visible focus checks.
- Contrast, heading hierarchy, alt text, form labels.
- Product flow: simple + variable product add-to-cart.
- Checkout flow: guest and account create path, payment failures, coupon flow.
- Performance validation: Lighthouse Home/Shop/Product/Checkout.
- Security validation: plugin updates, role audits, backup restore drill.
