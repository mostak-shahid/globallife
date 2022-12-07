<?php 
global $globallife_options;
if (is_home()) $page_id = get_option( 'page_for_posts' );
elseif (is_front_page()) $page_id = get_option('page_on_front');
else $page_id = get_the_ID();
if (!function_exists('is_plugin_active')) {
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="<?php echo get_post_meta( get_the_ID(),'_yoast_wpseo_focuskw', true ) ?>">
    <meta name="description" content="<?php echo get_post_meta( get_the_ID(),'_yoast_wpseo_metadesc', true ) ?>">
	<meta name="author" content="Md. Mostak Shahid">
    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
    <![endif]-->
    <?php echo carbon_get_theme_option( 'header_scripts' ); ?>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if (carbon_get_theme_option( 'mos-page-loader' ) == 'on') : ?>
    <div class="se-pre-con <?php echo carbon_get_theme_option( 'mos-page-loader-class' )?>" <?php if (carbon_get_theme_option( 'mos-page-loader-background' )) echo 'style="background-color:'.carbon_get_theme_option( 'mos-page-loader-background' ).'"' ?>>
    <?php if(carbon_get_theme_option( 'mos-page-loader-image' )): ?>
        <?php echo wp_get_attachment_image( carbon_get_theme_option( 'mos-page-loader-image' ), 'full', "", array( "class" => "loading-image" ) );  ?>
    <?php else: ?>
        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
    <?php endif?>
    </div>
<?php endif; ?>
	<header id="main-header" class="main-header <?php echo carbon_get_theme_option( 'mos-header-class' ) ?>">
		<div class="content-wrap">
			<div class="container">
			
				<nav class="navbar bg-light fixed-top">	
					<?php echo do_shortcode('[site-identity class="" container_class="navbar-brand"]') ?>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar" aria-controls="collapsibleNavbar" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<?php
					wp_nav_menu([
						'menu'            => 'mainmenu',
						'theme_location'  => 'mainmenu',
						'container'       => 'div',
						'container_id'    => 'collapsibleNavbar',
						'container_class' => 'collapse navbar-collapse',
						'menu_id'         => false,
						'menu_class'      => 'navbar-nav ml-auto',
						'depth'           => 2,
						'fallback_cb'     => 'bs4navwalker::fallback',
						//'walker'          => new bs4navwalker()
						]);
					?>
				</nav>				
			</div>
		</div>
	</header>
<?php if ( !is_front_page() ) :?>	
    <section id="page-title" class="page-title">			
        <div class="content-wrap">
            <div class="container">
                <?php 
                if (is_home()) :
                    $page_for_posts = get_option( 'page_for_posts' );
                $title = get_the_title($page_for_posts);
                elseif (is_404()) :
                    $title = '404 Page';
                elseif(is_tax()) :
                    $title = single_term_title( '', false );
                elseif(is_plugin_active('woocommerce/woocommerce.php')) :
                    if (is_shop()) :
                        $title = get_the_title(get_option('woocommerce_shop_page_id'));
                    endif;
                else :
                    $title = get_the_title();
                endif; 
                ?>
                <span class="heading"><?php echo $title ?></span>
            </div>
        </div>
    </section>

    <section id="section-breadcrumbs" class="section-breadcrumbs">
        <div class="content-wrap">
            <div class="container">
                <?php mos_breadcrumbs(); ?>
            </div>
        </div>
    </section>
<?php endif?>	