<?php 

if ( ! defined( '_S_VERSION' ) ) {
	define( '_S_VERSION', '1.0.1' );
}

function enqueue_task_scripts() {
    wp_enqueue_style( 'task-child-style', get_stylesheet_uri(), array(), _S_VERSION );
    wp_enqueue_script( 'fullcalendar-js', get_stylesheet_directory_uri() . '/js/fullCalendar.js', array(), _S_VERSION, true );

    $array_events = array();
    $customValue = '';
    $posts = get_posts(array(
        'post_type' => 'events',
        'posts_per_page' => -1,
    ));

    foreach ($posts as $post) {
        $start_event = get_field('start_event', $post->ID);
        $end_event = get_field('end_event', $post->ID);
        
        if(!empty($start_event && $end_event)) {
            $array_events[] = array(
                'title' => get_the_title($post->ID),
                'start' => $start_event,
                'end' => $end_event,
                'custom_data' => $post->ID
            );
        }

    }
    $events = json_encode($array_events);

    wp_localize_script('fullcalendar-js', 'acf_data', $events);

    wp_localize_script( 'fullcalendar-js', 'array_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php'
	) );

    wp_enqueue_script('fullcalendar', 'https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js', array(), '6.1.10', true);
}

add_action( 'wp_enqueue_scripts', 'enqueue_task_scripts' );

function events_ajax_handler(){

        $post_ID = $_POST['customData'];

        $post = get_post($post_ID);

        if ($post) {
            
            set_query_var('post', $post);
    
            get_template_part('template-parts/content', 'post-events');
    
            wp_reset_query();
        }

        wp_die();
}

add_action('wp_ajax_events', 'events_ajax_handler');
add_action('wp_ajax_nopriv_events', 'events_ajax_handler');

function eventsCpt_ajax_handler(){
    $post_id_post = $_POST['customDataCpt'];

    $post_ID = 24;

    $postTest = get_post($post_id_post);

    if ($postTest) {
        $title_post = get_the_title($post_id_post);
    }

    $customDataCpt = array(
        'name'  => sanitize_text_field($_POST['name']),
        'phone' => sanitize_text_field($_POST['phone']),
        'email' => sanitize_text_field($_POST['email']),
        'event' => sanitize_text_field($title_post)
    );

    $repeater_values = get_field('list_repeater', $post_ID);

    $repeater_values[] = $customDataCpt;

    update_field('list_repeater', $repeater_values, $post_ID);

    wp_die();
}

add_action('wp_ajax_events_cpt', 'eventsCpt_ajax_handler');
add_action('wp_ajax_nopriv_events_cpt', 'eventsCpt_ajax_handler');

