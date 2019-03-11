<?php


function universityLikeRoutes()  { //a route is a rest api url
    register_rest_route('university/v1', 'manageLike', array(
        'methods' => 'POST', //post method is a type of http request that this route is responsible for
        'callback' => 'createLike'
    ));
    register_rest_route('university/v1', 'manageLike', array(
        'methods' => 'DELETE',
        'callback' => 'deleteLike'
    ));
}
add_action('rest_api_init', 'universityLikeRoutes');


function createLike($data) {
    $professor = sanitize_text_field($data['professorId']); //via our ajax request in Like.js, wp smooshes all sent info in an array, which we can access by adding $data inside paranthesis
    // return 'thanks for creating a like';
    wp_insert_post(array(//this function lets us programatically create post right from our PHP
        'post_type' => 'like',
        'post_status' => 'publish',
        'post_title' => '2nd PHP Create Post Test',
        'meta_input' => array( //this will create wp custom/meta fields
            'liked_professor_id' => $professor, 
        )
        // 'post_content' => 'Hellow world 123'
    )); 
}

function deleteLike() {
    return 'thanks for deleting a like';
}