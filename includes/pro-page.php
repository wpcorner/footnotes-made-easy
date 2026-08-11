<?php
/**
 * In-plugin "Footnotes Made Easy Pro" sales page.
 *
 * Rendered at admin.php?page=footnotes-pro. Presents the Pro features,
 * ratings, and pricing inside wp-admin. Public marketing lives on the
 * external page (FME_PRO_URL); this converts users already in the dashboard.
 *
 * @package footnotes-made-easy
 * @since   3.2.2
 */

defined( 'ABSPATH' ) || exit;
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound -- Template file included from within class method scope; all variables use the fme_ prefix.

// Per-tier Freemius checkout links.
$fme_star     = '<svg viewBox="0 0 14 14" fill="currentColor" width="16" height="16"><path d="M7 0l1.8 4.2L13 4.6 9.8 7.6l1 4.4L7 9.8 3.2 12l1-4.4L1 4.6l4.2-.4z"/></svg>';
$fme_check    = '<svg viewBox="0 0 14 14" fill="none" width="14" height="14"><path d="M2.5 7.5l3 3 6-7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';

// Pricing tiers (hardcoded).
$fme_plans = array(
	array(
		'name'     => __( 'Personal', 'footnotes-made-easy' ),
		'tagline'  => __( 'Everything you need to reference one site beautifully', 'footnotes-made-easy' ),
		'price'    => '39',
		'period'   => __( '/year', 'footnotes-made-easy' ),
		'url'      => 'https://checkout.freemius.com/plugin/30819/plan/50586/licenses/1/',
		'featured' => false,
		'features' => array(
			__( '1 site licence', 'footnotes-made-easy' ),
			__( 'All Pro features', 'footnotes-made-easy' ),
			__( '1 year of updates & support', 'footnotes-made-easy' ),
		),
	),
	array(
		'name'     => __( 'Professional', 'footnotes-made-easy' ),
		'tagline'  => __( 'For freelancers and studios running a handful of sites', 'footnotes-made-easy' ),
		'price'    => '79',
		'period'   => __( '/year', 'footnotes-made-easy' ),
		'url'      => 'https://checkout.freemius.com/plugin/30819/plan/50586/licenses/5/',
		'featured' => true,
		'features' => array(
			__( '5 site licences', 'footnotes-made-easy' ),
			__( 'All Pro features', 'footnotes-made-easy' ),
			__( '1 year of updates & support', 'footnotes-made-easy' ),
		),
	),
	array(
		'name'     => __( 'Agency', 'footnotes-made-easy' ),
		'tagline'  => __( 'Unlimited sites, one predictable yearly price', 'footnotes-made-easy' ),
		'price'    => '199',
		'period'   => __( '/year', 'footnotes-made-easy' ),
		'url'      => 'https://checkout.freemius.com/plugin/30819/plan/50586/licenses/unlimited/',
		'featured' => false,
		'features' => array(
			__( 'Unlimited site licences', 'footnotes-made-easy' ),
			__( 'All Pro features', 'footnotes-made-easy' ),
			__( '1 year of updates & support', 'footnotes-made-easy' ),
		),
	),
);

// Pro features.
$fme_features = array(
	array( 'M9 12h6M9 16h6M9 8h6M5 4h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1z', __( 'Academic citations', 'footnotes-made-easy' ), __( 'Format references in APA, MLA, and Chicago styles automatically.', 'footnotes-made-easy' ) ),
	array( 'M12 2 2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5', __( '10 source types', 'footnotes-made-easy' ), __( 'Books, journals, websites, films, theses and more — each formatted correctly.', 'footnotes-made-easy' ) ),
	array( 'CLOCK', __( 'DOI & ISBN auto-fetch', 'footnotes-made-easy' ), __( 'Paste a DOI or ISBN and the source details fill in for you.', 'footnotes-made-easy' ) ),
	array( 'M4 6h16M4 10h16M4 14h10M4 18h7M20 14l-3 3-1.5-1.5', __( 'Reusable citation library', 'footnotes-made-easy' ), __( 'Save a reference once and reuse it across any post in seconds.', 'footnotes-made-easy' ) ),
	array( 'M14 3h7v7h-7zM14 14h7v7h-7z', __( 'Gutenberg sidebar', 'footnotes-made-easy' ), __( 'Manage, edit, and insert footnotes from the block editor sidebar.', 'footnotes-made-easy' ) ),
	array( 'M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8z', __( 'Priority support', 'footnotes-made-easy' ), __( 'Direct help from the AltviseWP team — faster, dedicated attention.', 'footnotes-made-easy' ) ),
);

// Reviews.
$fme_reviews = array(
	array( __( '"Very easy to set up and understand. Makes creating useful, interactive footnotes a total breeze."', 'footnotes-made-easy' ), 'Greg Taylor' ),
	array( __( '"I use it for adding academic style bibliographic references to web pages. It makes adding footnotes effortless."', 'footnotes-made-easy' ), 'Stephen Cactus' ),
	array( __( '"If you need footnotes, this is the plugin for you. Simple to master, easy to use. Works out of the box."', 'footnotes-made-easy' ), 'twg144' ),
);
$fme_version     = get_plugin_data( plugin_dir_path( __FILE__ ) . '../footnotes-made-easy.php', false, false )['Version'] ?? '';
$fme_pro_active  = defined( 'FME_PRO_VERSION' ) && function_exists( 'fmep_fs' ) && fmep_fs() && fmep_fs()->is_paying();
?>

<div class="wrap fme-wrap fme-pro-page">

	<!-- Topbar (shared with the other plugin pages) -->
	<div class="fme-topbar">
		<div class="fme-topbar-brand">
			<a href="<?php echo esc_url( swas_wp_footnotes::get_admin_page_url( 'footnotes-made-easy' ) ); ?>" class="fme-topbar-brand-link"><span class="fme-topbar-icon" aria-hidden="true">
				<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABwAAAAcCAYAAAByDd+UAAAGzElEQVR4nK2WaXCVZxXHf8+73Xtzl6ylZANSpCCQVlqWlLK1Yy1g1Y7gqB+cadXSqYodB7dpXeqM1i/iOANlCmr54Dg66tixlFKYqaVJSkux1KZAICwC2dMkTXJzl7zLc/zw5l4Ii5MPnpn3y/Oe55znnPM//3PUpo0HhGmICBiG5vGt81izbg4oeOOfl9i98wyiTZSajhUwpqNkmopsxuPzX5zNJx+ch+3YWLbNA+s/xsObZ5HNeJjm9Dxa01ESAcOERY3liAgigIAYivkfT6GMybNpiAGgFBiGwrhZvAq0FoaHciilEAGZvDfykY/oUOeGDgyFYahiyi3DUExMaFzXxzINojETmPpiBWitGOhzrzPY3ZVGRF3nL3SgyGYDdKBxHBMnYmBlMh6zG2I0zE3wYX+O9hPjGKZJNGoQBFe8GkrR2zN+jUHo6cpimMaUB5qmIp/TiPg0fqKUigqHcx2jdHW6WJ/aMIPHt95JNBoBNEdau3jh+TN0d06QTNmICFoLpmXQ3TUOaAzDQCnQOqC3J4dlGYgISoFSitERj1lzHL72RCMr7qkFFJlMjl2/aUPl83mJRCIEgRRzPTaW5ffPn+TQK73EYg62o3DzQqoMnvvdGhLJEgAGB9NsfayVibzCthWuK0xMeKx/qJpHtywimYwhEtbfNBWjI+MYpnk1UgQdCKlUCd/5/jK+9/RiIlFhPO0TiRqMjfr092ev1K8zzXjaIxIxSad9Eknhhz9ZzLe3LSWZjKF1Ac5hvg0TjL17PkBrH9NUKKVAQRCEju9/4DZ+taOJxXfEGRv1cCeErsvposOuy2k8TzE6mmdZUynbd65izX0NBIEU66+UwrQMXNdj7+4OrH/8rYfT7WnWb6xn+cqZlJaWFA16nqa2rpxnt6/iDy+cZO+e83ScHmPt/eH/0+2jeG7AE0/ezuYvzQdMPE9j21eyNjQ4zpGWLg4d6ObCuTxWSdymoz3DqbaTzKg+y/KmKlbfV8vCxZXYth2mwrB45LE7qa2P07z4MkEQEATC8FCGZ7cvZcXKOkRC5Nq2wcSEy/vvDdDyeg/H/zXM0KCH41jE4xZq08YDUgCL6wr5nI9tw5zbYqxYOZOme2cyd145BRbs6xuioiKJaMV4Jk9lZTKsvgScbh/kSEsvx94epPNSDq0VsZiFbSu0DntbXU3eBcbRGlxX43sBkaiitq6EO5aUsXpdDQsW3joFZO+/10PL4T5Oto3Q25PHcwXbMXEcAxSInkoiNySzSexMvlyhRdCaSdRNFS0awzAxzJDCpti5gW0rrFHowXM1+ZyPZQuzG+Isa6rknlW13D6/HDABGB5Kk0jGEBGymTxL7qpnyV31gOZsxxBvtfZy9MgAly/m8T2IxiwcRxX7UX3hoVcllw3wg4BbqyMsXV7F6nXVLGqswrLsySjDqFubL3Fw/wV++ou1aK352dNv8JmH59F076yiTohujxNtH9L8ejfHj31Ef18e27aIxUysbNZnUWOSBz9dx7IV1SRTsWL4BYgrpfnzH9vZveMMn9s0C8syAIPKqhRPbXuXbzyZYfOXFwBq8o7NkrtrWHJ3DSMjWd55q5eD+7s4fSoNv911XER8KUgQaPH98BMR6e8bkx//oFk2rNsn69fuk1f3ny3qvrKvQ9aveUk2rtsnzzzVIgMDYyIixftBoK+y68mOXx8V6ytfXYiIidZSnIeF6d3afJHdO9oZGtSkUg7ZnMus2cliBurqk1g2JBIOR98c4fzZVrZ8awGr1jSEgNISkn8gmJbFo1sWYfl+QCRSQFQ4hDOZHHv3nODAS704EYdUysJ1NamkSXVNouiwuqaERMJkYkKTLLVJjwq/fOYDNnx2iEe+vphEIhq2RKG2rsbYvbONbDaHYSqU0rx7rIvvbn2Tl1/sI56IYFkht3qe5paZEUrLokWHFZUlVM2I4PthFJYN8XiEl//ey7ZvtvLO210opTFNRSaTZ8+uU1ivHRzkTHsLDXOTjAy7nDqRBkxKy5wiAZumwvc1dXUJlDKL/WgYFjW1cc535IhG7WIKS8scens8fv6jf7Ow8TzlFREunEvT3elixeM2/T0BnReHMUxFLGaDkinTvlCPulkFGrtyXltfEvbXVV0eBEIkqkBsTrZlCII0jmNSErewtBZsR+FErKJhriEUAQxDqK6Jca3U1sVRSq69Ei5WCLESEzCLm4NVeLH8jz1PBCzToOqWeHGVCM+FsnI7RPdNrl9Lh9NahJUCPxBOnRgIhzThp5TiTPsYWqv/7+YtWojFbP76p0s0H/4POvAJAo/XDp3jxb9cpiRuX1fzm8l/AaRZYMdk2OauAAAAAElFTkSuQmCC" width="16" height="16" alt="" style="width:16px;height:16px;object-fit:contain;" />
			</span>
			<span class="fme-topbar-name"><?php esc_html_e( 'Footnotes Made Easy', 'footnotes-made-easy' ); ?></span></a>
			<?php if ( $fme_version ) : ?>
			<span class="fme-version-badge">v<?php echo esc_html( $fme_version ); ?></span>
			<?php endif; ?>
		</div>
		<div class="fme-topbar-links">
			<a href="<?php echo esc_url( swas_wp_footnotes::get_admin_page_url( 'footnotes-help' ) ); ?>"><?php esc_html_e( 'Help', 'footnotes-made-easy' ); ?></a>
			<a href="https://docs.altvisewp.com/footnotes-made-easy/" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Docs', 'footnotes-made-easy' ); ?></a>
		</div>
	</div>


	<!-- Hero -->
	<div class="fme-pro-hero">
		<span class="fme-pro-hero__badge"><?php esc_html_e( 'Footnotes Made Easy Pro', 'footnotes-made-easy' ); ?></span>
		<h1 class="fme-pro-hero__title"><?php esc_html_e( 'Turn footnotes into proper academic citations', 'footnotes-made-easy' ); ?></h1>
		<p class="fme-pro-hero__sub"><?php esc_html_e( 'Pro is built on top of the free plugin you already use — it adds APA, MLA, and Chicago citations, a reusable library, and a Gutenberg sidebar, without changing anything you have today.', 'footnotes-made-easy' ); ?></p>
		<a href="#fme-pricing" class="fme-pro-hero__cta"><?php esc_html_e( 'See pricing', 'footnotes-made-easy' ); ?></a>
	</div>

	<!-- Features -->
	<div class="fme-pro-features">
		<?php foreach ( $fme_features as $f ) : ?>
			<div class="fme-pro-feature">
				<span class="fme-pro-feature__icon">
					<svg viewBox="0 0 24 24" fill="none" width="22" height="22"><?php
					if ( 'CLOCK' === $f[0] ) {
						echo '<circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.6"/><path d="M12 7v5l3 3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>';
					} else {
						echo '<path d="' . esc_attr( $f[0] ) . '" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>';
					}
					?></svg>
				</span>
				<h3><?php echo esc_html( $f[1] ); ?></h3>
				<p><?php echo esc_html( $f[2] ); ?></p>
			</div>
		<?php endforeach; ?>
	</div>

	<!-- Ratings -->
	<div class="fme-pro-ratings">
		<div class="fme-pro-ratings__head">
			<span class="fme-pro-ratings__score">4.9</span>
			<span class="fme-pro-ratings__stars"><?php echo str_repeat( $fme_star, 5 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></span>
			<span class="fme-pro-ratings__label"><?php esc_html_e( 'Rated five stars on WordPress.org', 'footnotes-made-easy' ); ?></span>
		</div>
		<div class="fme-pro-reviews">
			<?php foreach ( $fme_reviews as $r ) : ?>
				<div class="fme-pro-review">
					<div class="fme-pro-review__stars"><?php echo str_repeat( $fme_star, 5 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></div>
					<p><?php echo esc_html( $r[0] ); ?></p>
					<span class="fme-pro-review__author"><?php echo esc_html( $r[1] ); ?></span>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

	<!-- Pricing -->
	<div class="fme-pro-pricing" id="fme-pricing">
		<h2 class="fme-pro-pricing__title"><?php esc_html_e( 'Choose your plan', 'footnotes-made-easy' ); ?></h2>
		<p class="fme-pro-pricing__sub"><?php esc_html_e( 'Every plan includes all Pro features. Choose the number of sites you need.', 'footnotes-made-easy' ); ?></p>

		<div class="fme-pro-coupon">
			<?php echo str_replace( '16', '20', $fme_star ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?>
			<span><?php
				printf(
					/* translators: %s: coupon code */
					esc_html__( 'Founders launch offer — use code %s at checkout for 30%% off any plan.', 'footnotes-made-easy' ),
					'<strong>FOUNDRS30</strong>' // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static markup.
				);
			?></span>
		</div>

		<div class="fme-pro-plans">
			<?php foreach ( $fme_plans as $plan ) : ?>
				<div class="fme-pro-plan<?php echo $plan['featured'] ? ' fme-pro-plan--featured' : ''; ?>">
					<?php if ( $plan['featured'] ) : ?>
						<span class="fme-pro-plan__badge"><?php esc_html_e( 'Most popular', 'footnotes-made-easy' ); ?></span>
					<?php endif; ?>
					<h3 class="fme-pro-plan__name"><?php echo esc_html( $plan['name'] ); ?></h3>
					<p class="fme-pro-plan__tagline"><?php echo esc_html( $plan['tagline'] ); ?></p>
					<div class="fme-pro-plan__price">
						<span class="fme-pro-plan__currency">$</span><span class="fme-pro-plan__amount"><?php echo esc_html( $plan['price'] ); ?></span><span class="fme-pro-plan__period"><?php echo esc_html( $plan['period'] ); ?></span>
					</div>
					<a href="<?php echo esc_url( $plan['url'] ); ?>" target="_blank" rel="noopener noreferrer" class="fme-pro-plan__btn"><?php esc_html_e( 'Buy now', 'footnotes-made-easy' ); ?></a>
					<ul class="fme-pro-plan__list">
						<?php foreach ( $plan['features'] as $item ) : ?>
							<li><?php echo $fme_check; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?><?php echo esc_html( $item ); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endforeach; ?>
		</div>

		<p class="fme-pro-pricing__note"><?php esc_html_e( '30-day money-back guarantee · Secure checkout via Freemius', 'footnotes-made-easy' ); ?></p>
	</div>

	<?php include dirname( __FILE__ ) . '/footer.php'; ?>

</div>

