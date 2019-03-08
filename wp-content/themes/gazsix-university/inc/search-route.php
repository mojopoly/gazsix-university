<?php 
function universityRegisterSearch() {
    register_rest_route('university/v1','search', array(
        'methods' => WP_REST_SERVER::READABLE, //to make this bulletproof, you can use WP_REST_SERVER::READABLE insetad of GET
        'callback' => 'universitySearchResults'
    )); //1st arg is the namespace like 'wp' in our http://localhost:3000/wp-json/wp/v2/posts, 2nd arg is the route, here 'posts'
}
add_action('rest_api_init', 'universityRegisterSearch');

function universitySearchResults($data) {//we're adding data here since we know wp passes info when calling this function on top
    // return 'you created a route!';
    // return array('red', 'orange', 'yellow'); //wp automatically converts php data into json data
//     return array(
//         'cat' => 'meow',
//         'dog' => 'bark'
//     );
    $mainQuery = new WP_Query(array(
        'post_type' => array('post', 'page' , 'professor', 'program', 'campus', 'event'),
        's' => sanitize_text_field($data['term'])//s stand for search, term is a madeup name that we chose, sanitize is a security measure
    ));
    // var_dump($professors);
    //since we dont need to generate html, we dont need to do perform regualr while loop
    $results = array(
        'generalInfo' => array(),
        'professors' => array(),
        'programs' => array(),
        'events' => array(),
        'campuses' => array()
    ); //we created this array to only filter the few properties that we need

    // return $professors->posts;// this prints all info about posts, which we will only need a few
    while($mainQuery->have_posts()) {
        $mainQuery->the_post(); //the_post gets all relevant data for posts ready and accessable
        if(get_post_type() == 'post' OR get_post_type() == 'page') {
            array_push($results['generalInfo'], array( //1st arg is the array the we want to add on to, 2nd is what u wanna add on to the array
                'title' => get_the_title(),  
                'permalink' => get_the_permalink()
            ));
        }
        if(get_post_type() == 'professor' ) {
            array_push($results['professors'], array( //1st arg is the array the we want to add on to, 2nd is what u wanna add on to the array
                'title' => get_the_title(),  
                'permalink' => get_the_permalink()
            ));
        }
        if(get_post_type() == 'program') {
            array_push($results['programs'], array( //1st arg is the array the we want to add on to, 2nd is what u wanna add on to the array
                'title' => get_the_title(),  
                'permalink' => get_the_permalink()
            ));

        }
        if(get_post_type() == 'campus') {
            array_push($results['campuses'], array( //1st arg is the array the we want to add on to, 2nd is what u wanna add on to the array
                'title' => get_the_title(),  
                'permalink' => get_the_permalink()
            ));
        }
        if(get_post_type() == 'event') {
            array_push($results['events'], array( //1st arg is the array the we want to add on to, 2nd is what u wanna add on to the array
                'title' => get_the_title(),  
                'permalink' => get_the_permalink()
            ));
        }
        }
    return $results;
}