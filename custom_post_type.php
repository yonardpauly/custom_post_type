<?php

/**
 * Plugin Name: Boast Forum Custom Post Type
 * Description: A practice by JYP for eggc boast forum
 * Author: John Yonard Pauly
 *
 **/

 function bf_custom_post_type()
 {
    register_post_type('Custom',
        array(
            'labels' => array(
                'name' => __('Customs'),
                'singular_name' => __('Custom'),
                'add_new' => __('Add New Custom Post'),
                'add_new_item' => __('Add New Custom Item'),
                'edit_item' => __('Edit Custom Item'),
                'search_item' => __('Search Custom Post')
            ),
            'menu_position' => 5,
            'public' => true,
            'exclude_from_search' => true,
            'has_archive' => false,
            'register_meta_box_cb' => 'custompost_metabox',
            'supports' => array( 'title', 'editor', 'thumbnail' )
        )
    );
 }
add_action('init', 'bf_custom_post_type');

function custompost_metabox()
{
    add_meta_box('custom_metabox_customfields', 'Custom Fields', 'custom_metabox_display', 'custom', 'normal', 'high');
}
add_action('add_meta_boxes', 'custompost_metabox');

function custom_metabox_display()
{
    echo "Here it is ...";
}

function get_bf_custom_post_types()
{
    $args = array(
        'posts_per_page' => -1,
        'post_type' => 'custom'
    );

    $customPosts = get_posts($args);

    $content = "";

    foreach ($customPosts as $k => $v) {
        $content .= "<a href='". get_permalink($v->ID) ."'>". $v->post_title ."</a><br />";
        $content .=  $v->post_content . "<br />";
        $content .=  "<hr />";
    }

    return $content;
}
add_shortcode('get_custom_posts', 'get_bf_custom_post_types');