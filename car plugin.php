<?php 
/*
Plugin Name: car plugin
Description: test plugin
Version: 1.0
Author: Igor 
*/

function cars() {
 $args = array(
 'label'  => 'Cars',
 'public' => true,
 'menu_icon' => 'dashicons-dashboard',
                 );
    register_post_type( 'cars', $args );
                }
add_action( 'init', 'cars' );




add_action( 'init', 'create_model_taxonomy', 0 );

function create_model_taxonomy() {

// Задаем названия для интерфейса

    $labels = array(
        'name' => _x( 'Model', 'taxonomy general name' ),
        'singular_name' => _x( 'Model', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Models' ),
        'popular_items' => __( 'Popular Models' ),
        'all_items' => __( 'All Models' ),
        'parent_item' => ( 'Parent Cars' ),
        'parent_item_colon' => ( 'Parent Cars:' ),
        'edit_item' => __( 'Edit Model' ),
        'update_item' => __( 'Update Model' ),
        'add_new_item' => __( 'Add New Model' ),
        'new_item_name' => __( 'New Model Name' ),
        'separate_items_with_commas' => __( 'Separate model with commas' ),
        'add_or_remove_items' => __( 'Add or remove models' ),
        'choose_from_most_used' => __( 'Choose from the most used models' ),
        'menu_name' => __( 'Model' ),
    );


    register_taxonomy('Model','cars',array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'update_count_callback' => '_update_cars_term_count',
        'query_var' => true,
        'rewrite' => array( 'slug' => 'Model' ),
    ));
}








add_shortcode('add_car_form', 'car_form' );
function car_form(){ ?>
    <form action="#" id="one" method="get">
        <label for="inp">Name:</label>
        <input type="text" id="inp">
        <label for="choose">Model:</label>
        <br>
        <select id="choose">
            <?php $args = array(
                'taxonomy' => 'Model',
                'hide_empty' => false,
            );
            $terms = get_terms($args);
            foreach ($terms as  $val){
                foreach ($val as $key=> $tax){?>

                   <?php if ($key=='name') {
                        echo "<option>" . $tax . "</option>";
                    }
                }
            }
            ?>
        </select>
        <br>
        <label for="description">Description:</label>
        <textarea id="description" cols="30" rows="10"></textarea>
        <input type="submit">
    </form>
<?php }
?>