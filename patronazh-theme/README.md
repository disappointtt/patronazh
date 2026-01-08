# Patronazh.kz WordPress Theme

Production-ready WordPress classic theme with Gutenberg support for a patronazh service website.

## Install
1. Copy the `patronazh-theme` folder to `wp-content/themes/`.
2. In WordPress admin, activate **Patronazh.kz**.
3. Create pages with these slugs (or rename and adjust links):
   - `home` (set as Homepage in Settings -> Reading)
   - `services`
   - `pricing`
   - `about`
   - `reviews`
   - `contacts`
   - `privacy`
4. Assign menus in Appearance -> Menus to **Primary Menu** and **Footer Menu**.

## Where to edit contacts / texts
- Contacts (phones, email, address, work hours): `functions.php` -> `patronazh_get_contact_info()`.
- FAQ items: `functions.php` -> `patronazh_get_faq_items()`.
- Page copy and section text:
  - `front-page.php` and `template-parts/section-*.php`
  - `page-services.php`, `page-pricing.php`, `page-about.php`, `page-contacts.php`, `page-privacy.php`
- Images: `assets/images/` (copied from the old site backup).

## Reviews (CPT)
- Reviews are stored in CPT `review` and shown on `/reviews` and the homepage.
- New reviews from the form are saved as **pending** and must be published in WP Admin -> Reviews.

## Requests (CPT)
- Requests are stored in CPT `request` with status **private**.
- View them in WP Admin -> Requests.
- Each form submission also emails the site admin (Settings -> General).

## Forms: enable/disable
- Disable all theme forms by adding this to `functions.php` (or a small plugin):

```php
add_filter('patronazh_forms_enabled', '__return_false');
```

## Security in forms
- Nonce validation
- Server-side validation + sanitization
- Honeypot + minimum fill time
- IP-based rate limit via transients
- No secrets in frontend

## Supabase extension (future)
If you later need Supabase:
- Create a **server-side** WP REST proxy endpoint.
- Store Supabase keys **only** on the server (never in JS).
- Use Supabase RLS (Row Level Security) for all tables.
- The proxy should validate nonces and enforce rate limits before sending to Supabase.

## Content sources from the old site
Used only as content references (no old code reused):
- Text blocks (About, staff description, services lists, pricing explanations)
- Contacts: phone numbers, email, address
- Images/icons/logos from `wp-content/uploads/2016/03`

### TODO placeholders
- `page-services.php` and `template-parts/section-services.php`: уточнить список услуг для стационара.
- `page-contacts.php`: точный адрес/карта.
- `page-privacy.php`: финальная редакция политики.
