<?php
//reasons to create your own new REST API URL: custom search logic with relationships, respond with less JSON data for faster loading, send
//only 1 getJSON request instead of 6 in our JS, -->  the function for creating this is inside inc folder; below we are requiring it
require get_theme_file_path('/inc/search-route.php');



function university_custom_rest() {//this function adds new custom field to wp api
    register_rest_field('post','authorName',array(
        'get_callback' => function() {return get_the_author();}
    ));
    //add new rest fields here
}
add_action('rest_api_init', 'university_custom_rest'); //first argument is the wp function that we want to hook onto
//create a recycleable function for page banners and is flexible depedning on input; use get_template_part for 
//non-changing inputs like events setup
function pageBanner($args = NULL) {//null will make args optional
    if (!$args['title']) {
       $args['title'] = get_the_title();
    }
    if (!$args['subtitle']) {
        $args['subtitle'] = get_field('page_banner_subtitle');
    }
    if (!$args['photo']) {
        if (get_field('page_banner_background_image')) {
            $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
        } else {
            $args['photo'] = get_theme_file_uri('images/ocean.jpg');
        }

    }
    ?>
    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo'] ?>);"></div> 
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"><?php echo $args['title'] ?></h1>
            <div class="page-banner__intro">
                <p><?php echo $args['subtitle'] ?></p>
            </div>
        </div>  
    </div>
<?php }
function university_files() {
    wp_enqueue_script('googleMap', '//maps.googleapis.com/maps/api/js?key=AIzaSyDU2nVP2YQ4ObDg2_USq3vVcz_X0Ib3Pj8', NULL, microtime(), true ); //this line to activate js for loading Gmaps
    wp_enqueue_script('main-university-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, microtime(), true ); //if we dont use bundling like the way in js structure in this project, instead of NULL, we wanna add "array('jquery')"
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('university_main_styles', get_stylesheet_uri(), NULL, microtime());
    wp_localize_script('main-university-js', 'universityData', array( //this function will make our JSON API request flexible so it runs on every machine
        'root_url' => get_site_url(),
    ));
}
add_action('wp_enqueue_scripts', 'university_files');



function university_features() {
    // register_nav_menu('headerMenuLocation', 'Header Menu Location'); //function to register menu in Appearance dashboard
    // register_nav_menu('footerLocationOne', 'Footer Location One');
    // register_nav_menu('footerLocationTwo', 'Footer Location Two');
    //function to add each pages title as a tag for each page
    add_theme_support('post-thumbnails');
    add_image_size('professorLandscape', 400, 260, true); //true will crop the image, you can use an array like array('left', 'top'))
    add_image_size('professorPortrait', 480, 650, true);
    add_image_size('pageBanner', 1500, 350, true);
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'university_features');
//below code will modify default query archive page for events instead of creating a brand new custom query
function university_adjust_queries($query) {
    //this block of code will customize campus archive query to make it flexible, no matter how many campuses we have
    if (!is_admin() AND is_post_type_archive('campus') AND $query->is_main_query()) {
        $query->set('posts_per_page', -1);      
    }
    //this block of code will customize program archive query
    if (!is_admin() AND is_post_type_archive('program') AND $query->is_main_query()) {
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');  
        $query->set('posts_per_page', -1);      
    }
    //this block of code will customize event query
    if (!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()) {
        $today = date('Ymd');
        $query->set('meta_key', 'event_date');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        $query->set('meta_query', array( array(
            'key' => 'event_date',
            'compare' => '>=',
            'value' => $today,
            'type' => 'numeric'
          )
        )
        );
    }
}
add_action('pre_get_posts', 'university_adjust_queries');

//api key from google to be activated with following function
function universityMapKey($api) {
    $api['key'] = 'AIzaSyDU2nVP2YQ4ObDg2_USq3vVcz_X0Ib3Pj8';
    return $api;
}
add_filter('acf/fields/google_map/api', 'universityMapKey');