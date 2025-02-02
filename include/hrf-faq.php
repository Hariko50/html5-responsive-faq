<?php

function fn_hrf_faqs($attr) {
    $faq_params = shortcode_atts( array(
        'category' => '',
        'title'    => '',
    ), $attr );
    
    $html = '<div class="hrf-faq-list">';
    
    if ( !empty( $faq_params['title'] ) ) {
        $html .= '<h2 class="frq-main-title">' . esc_html( $faq_params['title'] ) . '</h2>';
    }
    
    // Erlaube nur bestimmte Überschriften-Tags
    $allowed_tags = array('h2', 'h3', 'h4', 'h5', 'h6');
    $head_tag = in_array( get_option('hrf_question_headingtype'), $allowed_tags ) ? get_option('hrf_question_headingtype') : 'h3';
    
    $faq_args = array(
        'post_type'      => 'hrf_faq',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    );
    
    if ( !empty( $faq_params['category'] ) ) {
        $faq_args['category_name'] = sanitize_text_field( $faq_params['category'] );
    }
    
    $faq_query = new WP_Query( $faq_args );
    
    if ( $faq_query->have_posts() ) {
        while ( $faq_query->have_posts() ) {
            $faq_query->the_post();
            $post_id = get_the_ID();
            $html   .= '<article class="hrf-entry" id="hrf-entry-' . intval($post_id) . '">';
            
            // Sicher ausgegebener Titel
            $html .= '<' . $head_tag . ' class="hrf-title close-faq" data-content-id="hrf-content-' . intval($post_id) . '">';
            $html .= '<span></span>' . esc_html( get_the_title() ) . '</' . $head_tag . '>';
            
            // Sicher ausgegebener Inhalt
            $html   .= '<div class="hrf-content" id="hrf-content-' . intval($post_id) . '">' . wp_kses_post( apply_filters( 'the_content', get_the_content() ) ) . '</div>';
            $html   .= '</article>';
        }
    } else {
        $html .= 'No FAQs Found';
    }
    wp_reset_postdata();
    $html .= '</div>';
    return $html;
}
add_shortcode('hrf_faqs', 'fn_hrf_faqs');
