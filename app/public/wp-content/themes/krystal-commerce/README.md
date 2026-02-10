# Krystal Commerce Theme

A lightweight Full Site Editing (FSE) WooCommerce block theme focused on performance, accessibility, and clean conversion UX.

## Local Development Setup

### Option A: Docker (recommended)
```bash
docker compose up -d
wp plugin install woocommerce --activate --path=/var/www/html
wp theme activate krystal-commerce --path=/var/www/html
```

### Option B: LocalWP
1. Create a new LocalWP site with PHP 8.2+, MySQL 8+, Nginx preferred.
2. Copy `krystal-commerce` to `wp-content/themes/`.
3. Activate WooCommerce plugin.
4. Activate **Krystal Commerce** in Appearance → Themes.

## Required Plugins (minimal)
- WooCommerce
- SEO plugin (Yoast SEO or Rank Math)
- Caching/performance plugin (LiteSpeed Cache or WP Rocket)
- Security plugin (Wordfence or Solid Security)
- SMTP/email delivery plugin (WP Mail SMTP)

## Suggested Page Structure
- Home (`front-page.html` + patterns)
- Shop (`archive-product.html`)
- Category (`taxonomy-product_cat.html`)
- Product (`single-product.html`)
- Cart (`page-cart.html`)
- Checkout (`page-checkout.html`)
- My Account (`page-my-account.html`)
- About, Contact, FAQ, Shipping & Returns, Privacy, Terms (`page.html`)

## WooCommerce Configuration Steps
1. **General**: set store address, currency, units.
2. **Products**: configure categories, attributes, variations, inventory policies.
3. **Shipping**: create zones + methods (flat/free/local pickup).
4. **Tax**: enable taxes and set classes/rates per jurisdiction.
5. **Payments**: configure gateways using environment keys (never hardcode).
6. **Accounts & Privacy**:
   - Allow guest checkout.
   - Allow account creation during checkout.
   - Configure retention and privacy text.
7. **Emails**: update sender address, logo/brand colors, and templates.

## Conversion UX Notes
- Sticky header with search, account, and mini-cart.
- Quick add on product cards.
- Simplified checkout fields (company and address line 2 removed by default).
- Mobile sticky add-to-cart on single product pages.

## Performance Checklist
- Enable full-page cache and object cache (Redis) where available.
- Serve WebP/AVIF with responsive srcset sizes.
- Keep plugin count low; audit JS/CSS payload regularly.
- Use WooCommerce HPOS and block-based cart/checkout.
- Use CDN for static assets and image transformations.
- Preload critical fonts and avoid third-party script bloat.

## Security Checklist
- Enforce MFA for admins and least-privilege roles.
- Keep core/theme/plugins updated and remove unused extensions.
- Use HTTPS + HSTS + secure cookies.
- Disable XML-RPC if not required; protect `/wp-admin` with WAF/rate limiting.
- Backups + malware scanning + activity logging.
- Store API/payment secrets in environment/server config, not in code.

## SEO & Analytics Checklist
- Configure SEO plugin titles, meta templates, XML sitemap, robots, canonicals.
- Ensure product schema (via WooCommerce) is valid.
- Add Open Graph/Twitter metadata through SEO plugin templates.
- Install GA4 via GTM or plugin and map ecommerce events:
  - `view_item`, `add_to_cart`, `begin_checkout`, `purchase`.

## QA Checklist
- Responsive: 320px, 375px, 768px, 1024px, 1440px.
- Accessibility: keyboard navigation, focus states, labels, contrast, heading hierarchy.
- Checkout flow: guest + logged-in, success/failure payments, coupon and shipping updates.
- Performance: Lighthouse mobile tests on Home, Shop, Product, Checkout.
- Security: plugin updates, role audit, brute-force protection, backup restore test.

## Store Manager Quick Guide
- Add product: Products → Add New (title, gallery, price, inventory, shipping).
- Variable product: add attributes first, then generate variations.
- Merchandising: use categories, featured products, and homepage patterns.
- Orders: WooCommerce → Orders to process/refund.
- Content updates: Appearance → Editor for header/footer/templates/patterns.


## Optional Wishlist
- If wishlist is required, use a lightweight plugin (e.g. TI WooCommerce Wishlist) and keep scripts disabled on non-store pages when supported.
