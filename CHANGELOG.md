### 0.6.7: December 10th, 2020
* **Fix** - Security Fix

### 0.6.6: August 07th, 2020
* **Tweak** - Gravity Forms CSS refactoring

### 0.6.5: August 06th, 2020
* **Tweak** - Gravity Forms handle gf_list_inline

### 0.6.4: August 06th, 2020
* **Tweak** - Gravity Forms handle ginput_left and ginput_right classes

### 0.6.3: May 13th, 2020
* **Tweak** - Update WooCommerce template compatibility to 4.1.0

### 0.6.2: May 12th, 2020
* **Tweak** - content.php template tweak: exclude date from SERP

### 0.6.1: May 11h, 2020
* **Fix** - Gravity Forms hidden labels were still visible

### 0.6.0: May 11h, 2020
* **Fix** - Gravity Forms hidden fields were still visible

### 0.5.9: December 5th, 2019
* **Fix** - Update obsolete filter woocommerce_stock_html by woocommerce_get_stock_html
* **Fix** - Enable again the bottom description field

### 0.5.8: October 29th, 2019
* **Fix** - WooCommerce Availability Text class was visibile even when available

### 0.5.7: August 21st, 2019
* **Tweak** - WooCommerce: HTML for Availability Text, create alert
* **Tweak** - Now requires PHP 7.0

### 0.5.6: June 20th, 2019
* **Fix** - Gravity Forms: Email confirmation field alignment

### 0.5.5: May 13th, 2019
* **Tweak** - Update templates for WooCommerce 3.6
* **Tweak** - Archives: add link to post thumbnail

### 0.5.4: April 12th, 2019
* **Tweak** - Remove Hustle ads
* **Tweak** - HTML rich text type: WebPage
* **Tweak** - Updated class only for posts
* **Fix** - WooCommerce templates for 3.5.0

### 0.5.3: November 20th, 2018
* **Fix** - Remove woocommerce-info 0 padding
* **Fix** - FR Localization missing keywords in pot file
* **Fix** - Prevent Owl Images from being "Lazy Image"
* **Tweak** - Remove FOUT fixes for Hustle

### 0.5.2: September 1st, 2018
* **Tweak** - Remove `thumbnail` class from images inserted in editor

### 0.5.1: August 20th, 2018
* **Fix** - Style WooCommerce notices
* **Fix** - Retro-compatibility for WooCommerce versions < 3.4.0

### 0.5.0: July 19th, 2018
* **Fix** - Bug with Gravity Forms multi page forms
* **Tweak** - Template compatibility with WooCommerce 3.4.0
* **Tweak**- Correct sanitize of preprocessor mod
* **Tweak** - Avoid PHP notices

### 0.4.9: May 11th, 2018
* **Fix** - Version update

### 0.4.8: May 11th, 2018
* **Fix** - obsolete function calls
* **Fix** - conflict in Elementor
* **Fix** - missing viewport

### 0.4.7: January 31st, 2018
* **Tweak** - Remove automatic last-child bottom 
* **Tweak** - Remove SelectWoo from enqueued scripts
* **Tweak** - WooCommerce 3.3.0 templates compatibility

### 0.4.6: January 5th, 2018
* **Tweak** Webfontloader: disable completely FOUT effect
* **Fix** - Webfontloader: force loading after 5 seconds

### 0.4.5: January 4th, 2018
* **Tweak** - Webfontloader: prevent FOUT
* **Tweak** - Body class template independant of post type

### 0.4.4: December 18th, 2017
* **Tweak** - Jetpack: Infinite Scroll compatibility in product archive
* **Tweak** - Navbarscrolltotop: compatibility with WooCommerce checkout page

### 0.4.3: December 13th, 2017
* **Fix** - Nav Stuck To Top: adjust to #navigation height, not #header height
* **Fix** - WooCommerce: products per page on product_tag 
* **Tweak** - Woocommerce Grid/List Toggle: change position of html description (after title, instead of after price)

### 0.4.2: November 20th, 2017
* **Fix** - WooCommerce: number of products in admin
* **Tweak** - WooCommerce: replace deprecated add_to_cart_fragments with woocommerce_add_to_cart_fragments
* **Tweak** - WooCommerce: columns for product_tag in body class
* **Tweak** - Assets: remove version number
* **Tweak** - WooCommerce: nowrap download expires cell

### 0.4.1: October 31st, 2017
* **New** - Empty WP Rocket cache on save product
* **New** - WooCommerce: cart items refreshed by ajax (compatible with cache plugins like WP Rocket)
* **Tweak** - WooCommerce: Style woocommerce-notice
* **Tweak** - WooCommerce: update templates for 3.2.0
* **Tweak** - WooCommerce: product inner also on subcategories
* **Tweak** - WooCommerce: widget price, hide input
* **Tweak** - WooCommerce: replace deprecated WC_Cart::get_cart_url by wc_get_cart_url()
* **Tweak** - WooCommerce: focus search input in handheld bar
* **Fix** - Grunt assets filename fix with minutes and seconds

### 0.4.0: October 6th, 2017
* **New** - Lazy Load: disable on carousels
* **New** - Lazy Load: effect when showing 
* **New** - Hooks before content and after content 
* **Tweak** - Menu .active class for current item
* **Tweak** - Well last paragraph margin
* **Tweak** - WooCommerce: align coupon code input
* **Tweak** - WooCommerce: tabs panel styling
* **Tweak** - WooCommerce: adjust padding on widget cart
* **Tweak** - Hide empty sidebar message (sidebars: blog main shop)
* **Fix** - Gravity Forms: Hide hidden sublabels
* **Fix** - Gravity Forms: Remove submission to Analytics event
* **Fix** - Bug showing adminbar

### 0.3.9: September 19th, 2017
* Up version fix

### 0.3.8: September 8th, 2017
* **New** - Full screen form feature
* **New** - i18n: RU, DE, ZH
* **Tweak** - i18n: FR
* **Fix** - Hide navigation when Elementor editor is active
* **Fix** - Hustle popups visibility
* **Tweak** - Version the main CSS and JS file
* **New** - Datepicker update version to 1.6.4 and fix lang "zh"
* **Tweak** - Frontpage body class
* **New** - Gravity Forms width

### 0.3.7: August 22nd, 2017
* **New** - WooCommerce: class for cart widgets empty/notempty
* **New** - WooCommerce: account page title in shortcode
* **Fix** - Hustle popup classes
* **Fix** - Login/rememberme order
* **Fix** - Remove PHP Notices
* **Fix** - Remove console.log
* **Fix** - Elementor buttons color
* **Fix** - Undefined variable: class in footer.php

### 0.3.6: August 7th, 2017
* WooCommerce: Shortcode for displaying a link to account
* WooCommerce: Checkout, fix coupon_code
* WooCommerce: Product Single: product variations as list-item
* WooCommerce: Adjust handheld bar
* Hustle: Flash Of Unstyled Text fix
* Fix conflict between Toggle Grid and Hustle (with dashicons enqueue)

### 0.3.5: July 27th, 2017
* Gravity Forms: fix submit button
* Template: allow fullwidth for post
* WooCommerce: Sticky payment
* WooCommerce: Add to cart spinner

### 0.3.4: July 25th, 2017
* WooCommerce CSS compatibility
* New shortcode [woocommerce_cart_link] to display a link to Woocommerce cart
* New shortcode [woocommerce_account_link] to display a link to Woocommerce account

### 0.3.3: June 09th, 2017
* Fix styling of elementor buttons
* Gravity forms compatibility with address and name fields

### 0.3.2: May 11th, 2017
* Fix password protected form action

### 0.3.1: May 3rd, 2017
* WooCommerce 3.0.x compatibility

### 0.3.0: March 17th, 2017
* Elementor compatibilty: buttons

### 0.2.9: March 17th, 2017
* Theme check

### 0.2.8: February 15th, 2017
* WooCommerce compatibility (new attempt)

### 0.2.7: January 19th, 2017
* Separate stormbringer and godspeed optimizations

### 0.2.6: February 1st, 2016
* Owlcarousel shortcode
* Owlcarousel library

### 0.2.5: January 26th, 2016
* Nav toggle collapse
* Animate library
* Waypoints library

### 0.2.4: January 20th, 2016
* Customizer: enable/disabled libraries
* Lazyload library
* Lazyload library

### 0.2.3: January 19th, 2016
* Datepicker library

### 0.2.2: December 18th, 2015
* Refactorization, for child theme compatibility
* Removed Fancybox
* Upgrade Boostrap to v3.3.6

### 0.2.1: October 26th, 2015
* Grunt generated files versioning: css and js files now contain datetime in the filename

### 0.2.0: July 2nd, 2015
* Upgrade Boostrap to v3.3.5
* Fix gallery shortcode compatibility with jetpack tiled gallery
* Gravity Forms: remove obsolete scss
* Gravity Forms: ajax forms javascript non-render blocking
* Use new WordPress functions: the_archive_title, the_archive_description, the_posts_pagination
* Fix <time> in ISO 8601 format 
* Remove custom breadcrumb function in favor of Yoast SEO breadcrumb function

### 0.1.9: April 15th, 2015
* Upgrade Boostrap to v3.3.4
* Fix images align and max-width
* Update JS libraries
* New Typekit setting
* New setting for livereload for servers with custom livereload url
* Update Grunt dependencies

### 0.1.8: December 1st, 2014
* Upgrade Boostrap to v3.3.1

### 0.1.7: November 8th, 2014
* Upgrade Boostrap to v3.3.0

### 0.1.6: September 24nd, 2014
* Refactoring of localization
* Added french (fr_FR) localization

### 0.1.5: September 24nd, 2014
* Fix "Theme My Login" plugin Compatibility

### 0.1.4: July 22nd, 2014
* Upgrade Boostrap to v3.2.0
* Adding Boostrap Sass and Grunt support (see readme for installation)

### 0.1.3: February 5th, 2014
* Upgrade Boostrap to v3.1.0
* Upgrade Less to v1.6.2

### 0.1.2: December 10th, 2013
* Included Respond.js for IE6-IE8 compatibility with Media Queries
* Removed javascript from carousel

### 0.1.1: November 22nd, 2013
* Upgrade Boostrap to v3.0.2

### 0.0.3: February 27th, 2013
* Login/Register plugin compatible with TB (Theme My Login)
* Carousel shortcode

### 0.0.2: February 27th, 2013
* Created variable for modal  : bootstrap, fancybox 1 or none
* Modal compatible with Gravity Forms
* Fix gallery page
* New template for attachements
* New template page for TB styles
* Moved sidebar containers to sidebar templates
* Comments: now use .media-list
* Removed JS files replaced by calls to CDNJS (http://cdnjs.com/)

### 0.0.1: September 18th, 2012
* Started the theme with Twitter Bootstrap