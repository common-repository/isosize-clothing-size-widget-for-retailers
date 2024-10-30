<?php

/*
Main setting method whatever is called inside will be in setting
*/
function isosize_render_settings_page() {
  isosize_render_widget_settings_form();
}


/*
Register settings
*/
function isosize_plugin_parameters() {

    // regisiter settings function save any variable through wordpress api
    // regisiter_settings(1,2,3)
    // 1- A settings group name. Must exist prior to the register_setting call
    // 2- The name of an option to sanitize and save.
    // 3- optional its a callback function
	register_setting( 'isosize-plugin-settings-group', 'isosize_widget_api_key' );
	register_setting( 'isosize-plugin-settings-group', 'isosize_widget_position' );
}
// when admin inits, register settings
add_action( 'admin_init', 'isosize_plugin_parameters' );

/*
Form with all input data
*/
function isosize_render_widget_settings_form(){
?>

    <div class="wrap">

        <h2>Isosize Widget settings</h2>

        <form method="post" action="options.php">

            <!--accessing fields and section-->
            <?php settings_fields( 'isosize-plugin-settings-group' ); ?>
            <?php do_settings_sections( 'isosize-plugin-settings-group' ); ?>

            <table class="form-table">

                <!--Api key-->
                <tr valign="top">
                    <th scope="row">Widget Api key</th>
                    <td><input type="text" name="isosize_widget_api_key" value="<?php echo esc_attr( get_option('isosize_widget_api_key') ); ?>" /></td>
                </tr>

                <!--Position-->
                <tr valign="top">
                    <th scope="row">Widget Position</th>
                    <td>
                        <input type="radio" name="isosize_widget_position" value="left" <?php checked(left, get_option('isosize_widget_position'), true); ?> />left
                        <input type="radio" name="isosize_widget_position" value="right" <?php checked(right, get_option('isosize_widget_position'), true); ?> />right
                    </td>
                </tr>

            </table>
            <?php submit_button(); ?>
        </form>
    </div>

<?php

}


/*
Reloads the widget(by removing and reinserting) with new/old parameters
*/
function isosize_reload_widget(){

    //echo get_option('isosize_widget_position');

    //var_dump(get_option('isosize_widget_position'));
    // creating array to be passed with only key inside
    $arr = array("key"=>get_option("isosize_widget_api_key"), "position"=>get_option('isosize_widget_position'));

    // dequeueing the widget script
    wp_dequeue_script( 'isosize-widget' );

    // renqueue
    wp_enqueue_script('isosize-widget', plugin_dir_url(__FILE__) . 'isosize-widget.js', array('jquery'));

    //creating variable to be passed to js
    wp_localize_script("isosize-widget","php_var", $arr);
}

add_action('wp_enqueue_scripts','isosize_reload_widget');

?>
