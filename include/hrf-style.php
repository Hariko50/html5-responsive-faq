<?php
// Gibt im Footer die CSS-Regeln aus.
function fn_hrf_styles() {
    $main_title_size   = get_option('hrf_main_title_size', '18px');
    $question_color    = get_option('hrf_question_text_color', '#444444');
    $question_bgcolor  = get_option('hrf_question_bgcolor', '#ffffff');
    $question_size     = get_option('hrf_question_text_size', '18px');
    $answer_color      = get_option('hrf_answer_text_color', '#444444');
    $answer_bgcolor    = get_option('hrf_answer_bgcolor', '#ffffff');
    $answer_size       = get_option('hrf_answer_text_size', '14px');
    $bullets_bgcolor   = get_option('hrf_bullets_bgcolor', '#444444');
    $faqs_bottom_gap   = get_option('hrf_faqs_bottom_gap', '0px');
    $heading_style     = get_option('hrf_question_headingtype', 'h3');

    // Icons aus dem images-Ordner – passe ggf. den Pfad an.
    $open_icon  = plugins_url( 'images/open.png', dirname(__FILE__) );
    $close_icon = plugins_url( 'images/close.png', dirname(__FILE__) );
    
    $css = '<style type="text/css">
        h2.frq-main-title {
            font-size: ' . esc_attr($main_title_size) . ';
        }
        .hrf-entry {
            border: none !important;
            margin-bottom: ' . esc_attr($faqs_bottom_gap) . ' !important;
            padding-bottom: 0 !important;
        }
        .hrf-content {
            display: none;
            color: ' . esc_attr($answer_color) . ';
            background: ' . esc_attr($answer_bgcolor) . ';
            font-size: ' . esc_attr($answer_size) . ';
            padding: 10px;
            padding-left: 50px;
        }
        ' . esc_attr($heading_style) . '.hrf-title {
            font-size: ' . esc_attr($question_size) . ';
            color: ' . esc_attr($question_color) . ';
            background: ' . esc_attr($question_bgcolor) . ';
            padding: 10px;
            padding-left: 50px;
            margin: 0;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            outline: none;
        }
        .hrf-title.close-faq {
            cursor: pointer;
        }
        .hrf-title.close-faq span {
            width: 30px;
            height: 30px;
            display: inline-block;
            position: relative;
            left: 0;
            top: 8px;
            margin-right: 12px;
            margin-left: -42px;
            background: ' . esc_attr($bullets_bgcolor) . ' url(' . esc_url($open_icon) . ') no-repeat center center;
        }
        .hrf-title.open-faq span {
            width: 30px;
            height: 30px;
            display: inline-block;
            position: relative;
            left: 0;
            top: 8px;
            margin-right: 12px;
            margin-left: -42px;
            background: ' . esc_attr($bullets_bgcolor) . ' url(' . esc_url($close_icon) . ') no-repeat center center;
        }
    </style>';
    echo $css;
}
add_action( 'wp_footer', 'fn_hrf_styles' );
