# WooCommerce FSE Implementation Plan (Krystal)

## 1) High-Level Plan

1. Build a custom lightweight block theme (`krystal-commerce`) to avoid heavy builders.
2. Define design tokens in `theme.json` for typography, spacing, color, shadows, radii.
3. Create reusable homepage block patterns (hero, category grid, products, USPs, testimonials, newsletter CTA).
4. Build WooCommerce templates for shop, product, cart, checkout, and account pages.
5. Apply minimal PHP enhancements for checkout field simplification and shipping/returns product tab.
6. Add minimal JS only for mobile sticky add-to-cart scrolling behavior.
7. Configure WooCommerce settings for shipping/tax/payments and harden performance/security/SEO.

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
│   ├── header.html
│   └── footer.html
├── patterns/
│   ├── home-hero.php
│   ├── home-featured-categories.php
│   ├── home-featured-products.php
│   ├── home-usp-row.php
│   ├── home-testimonials.php
│   └── home-newsletter.php
├── templates/
│   ├── archive-product.html
│   ├── front-page.html
│   ├── index.html
│   ├── page-cart.html
│   ├── page-checkout.html
│   ├── page-my-account.html
│   ├── page.html
│   ├── single-product.html
│   └── single.html
├── functions.php
├── README.md
├── style.css
└── theme.json
```

## 3) Commands

```bash
# Activate theme
wp theme activate krystal-commerce

# Ensure WooCommerce installed
wp plugin install woocommerce --activate

# Optional: create core pages
wp post create --post_type=page --post_title='Shop' --post_status=publish
wp post create --post_type=page --post_title='Cart' --post_status=publish
wp post create --post_type=page --post_title='Checkout' --post_status=publish
wp post create --post_type=page --post_title='My Account' --post_status=publish
```

## 4) Production Deployment Checklist

- PHP 8.2+, MariaDB/MySQL modern version, HTTP/2 or HTTP/3.
- Persistent object cache (Redis) and full-page caching.
- CDN + image optimization with next-gen formats.
- Daily backups, staging environment, and rollback procedure.
- Error monitoring (server + application logs).
- Security hardening and periodic vulnerability scans.
- Smoke-test checkout after each deploy.
