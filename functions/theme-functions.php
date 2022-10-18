<?php
function mos_home_url_replace($data) {
    $replace_fnc = str_replace('home_url()', home_url(), $data);
    $replace_br = str_replace('{{home_url}}', home_url(), $replace_fnc);
    return $replace_br;
}
function mos_get_posts($post_type = 'post', $post_status = 'publish'){
    global $wpdb;
    $output = array();
    $all_posts = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}posts WHERE post_status = '{$post_status}' AND post_type = '{$post_type}'" );          
    foreach ($all_posts as $key => $value) {
        $output[$value->ID] = $value->post_title;
    }
    return $output;
}
//var_dump(mos_get_posts ('case-study'));

function mos_get_terms ($taxonomy = 'category', $return='all') {
    global $wpdb;
    $output = array();
    $all_taxonomies = $wpdb->get_results( "SELECT {$wpdb->prefix}term_taxonomy.term_id, {$wpdb->prefix}term_taxonomy.taxonomy, {$wpdb->prefix}terms.name, {$wpdb->prefix}terms.slug, {$wpdb->prefix}term_taxonomy.description, {$wpdb->prefix}term_taxonomy.parent, {$wpdb->prefix}term_taxonomy.count, {$wpdb->prefix}terms.term_group FROM {$wpdb->prefix}term_taxonomy INNER JOIN {$wpdb->prefix}terms ON {$wpdb->prefix}term_taxonomy.term_id={$wpdb->prefix}terms.term_id", ARRAY_A);
    if ($return=='all'){
        foreach ($all_taxonomies as $key => $value) {
            if ($value["taxonomy"] == $taxonomy) {
                $output[] = $value;
            }
        }
    } else {        
        foreach ($all_taxonomies as $key => $value) {
            if ($value["taxonomy"] == $taxonomy) {
                $output[$value['term_id']] = $value['name'];
            }
        }
    }
    return $output;
}
//var_dump(mos_get_terms ('case_study_category', 'small'));
function mos_calculate_reading_time( $post_id ) {

    $post_content       = get_post_field( 'post_content', $post_id );
    $stripped_content   = strip_shortcodes( $post_content );
    $strip_tags_content = wp_strip_all_tags( $stripped_content );
    $word_count         = count( preg_split( '/\s+/', $strip_tags_content ) );
    $reading_time       = ceil( $word_count / 220 );

    return $reading_time .' minutes of reading';
}
/*Variables*/
$template_parts = array(
    'Enabled'  => array(
        'content' => 'Content Section',
    ),
    'Disabled' => array(
        'banner' => 'Home Banner',
    ),
);
/*Variables*/