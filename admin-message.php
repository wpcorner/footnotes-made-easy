/**
 * Show Admin Message
 *
 * Display message on the administration screen.
 */ 
function fme_add_admin_notice() {
    if (is_admin()) {
        echo '<div class="notice notice-error"><p>';
        echo __( sprintf( '⚠️The Footnotes Made Easy plugin will be discontinued December 2024. After this time there will be no further updates, including security vulnerabilities. It is important that you disable it and find an alternative plugin before then. <a href="%s">Find out more here</a>.', 'https://wordpress.org/support/topic/important-please-read-before-posting-4/' ), 'footnotes-made-easy' );
        echo '</p></div>';
    }
}
add_action( 'admin_notices', 'fme_add_admin_notice' );
