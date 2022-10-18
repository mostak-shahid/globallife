<?php $page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));?>
<?php get_template_part( 'template-parts/section', 'widgets' ); ?>
<footer id="footer" class="footer">
    <div class="content-wrap">
        <div class="container">
            Footer
        </div>
    </div>
</footer>
<?php if (carbon_get_theme_option( 'mos-back-to-top' ) == 'on') : ?>
<a href="javascript:void(0)" class="scrollup" style="display: none;">
    <?php if(carbon_get_theme_option( 'mos-page-loader-image' )) : ?>
    <?php echo wp_get_attachment_image( carbon_get_theme_option( 'mos-page-loader-image' ), 'full', "", array( "class" => "back-tot-top-img" ) );  ?>
    <?php else :?>
    <img class="back-tot-top-img" width="40" height="40" src="<?php echo get_template_directory_uri() ?>/images/icon_top.png" alt="Back To Top">
    <?php endif?>
</a>
<?php endif?>
<?php wp_footer(); ?>
<!--Theme Options CSS-->
<style>
    <?php
    $header_background = carbon_get_theme_option( 'mos-header-background' );
    ?>
    .main-header {
        <?php if(carbon_get_theme_option( 'mos-header-padding' )) : ?>
        padding: <?php echo carbon_get_theme_option( 'mos-header-padding' ) ?>
        <?php endif?>
        <?php if(carbon_get_theme_option( 'mos-header-margin' )) : ?>
        margin: <?php echo carbon_get_theme_option( 'mos-header-margin' ) ?>
        <?php endif?>
        <?php if(carbon_get_theme_option( 'mos-header-border' )) : ?>
        border: <?php echo carbon_get_theme_option( 'mos-header-border' ) ?>
        <?php endif?>            
        <?php if(@$header_background && sizeof($header_background)) : ?>
            <?php foreach($header_background as $value): ?>
                <?php //var_dump($value) ?>
                <?php foreach($value as $key => $val): ?>
                    <?php if ($key!= 'background-image' && $key != '_type'):  ?>
                        <?php echo $key . ':' . $val . ';' ?>
                    <?php elseif ($key== 'background-image'):  ?>
                        <?php echo $key . ':url(' . wp_get_attachment_url($val) . ');' ?>
                    <?php endif?>
                <?php endforeach?>
            <?php endforeach?>
            
        <?php endif?>
    }    
    <?php if(carbon_get_theme_option( 'mos-header-link-color' )) : ?>
    .main-header a {
        color: <?php echo carbon_get_theme_option( 'mos-header-link-color' ) ?>
    }
    <?php endif?>
    <?php if(carbon_get_theme_option( 'mos-header-link-color-hover' )) : ?>
    .main-header a:hover {
        color: <?php echo carbon_get_theme_option( 'mos-header-link-color-hover' ) ?>
    }
    <?php endif?>
</style>
<!--Theme Options CSS-->
<?php echo carbon_get_theme_option( 'footer_scripts' ); ?>
</body>

</html>
