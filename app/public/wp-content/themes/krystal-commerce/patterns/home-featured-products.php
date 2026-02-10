<?php
/**
 * Title: Home Featured Products
 * Slug: krystal-commerce/home-featured-products
 * Categories: featured
 */
?>
<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"1rem","bottom":"2rem"}}}} -->
<div class="wp-block-group alignwide" style="padding-top:1rem;padding-bottom:2rem"><!-- wp:group {"layout":{"type":"flex","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:heading -->
<h2 class="wp-block-heading">New arrivals</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><a href="/shop">View all</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:woocommerce/product-collection {"query":{"postType":"product","perPage":8,"woocommerceStockStatus":["instock"],"order":"desc","orderBy":"date"},"displayLayout":{"type":"flex","columns":4},"collection":"woocommerce/product-collection/featured"} -->
<div class="wp-block-woocommerce-product-collection"><!-- wp:woocommerce/product-template -->
<!-- wp:group {"className":"kc-product-card","style":{"spacing":{"blockGap":"0.5rem"}}} -->
<div class="wp-block-group kc-product-card"><!-- wp:woocommerce/product-image {"imageSizing":"thumbnail"} /-->
<!-- wp:woocommerce/product-title {"isLink":true,"fontSize":"m"} /-->
<!-- wp:woocommerce/product-rating /-->
<!-- wp:woocommerce/product-price /-->
<!-- wp:woocommerce/product-button {"text":"Quick add"} /--></div>
<!-- /wp:group -->
<!-- /wp:woocommerce/product-template --></div>
<!-- /wp:woocommerce/product-collection --></div>
<!-- /wp:group -->
