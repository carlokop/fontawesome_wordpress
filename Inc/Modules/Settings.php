<?php

/**
 * @package  font-awesome-local
 * this code is based on https://deliciousbrains.com/create-wordpress-plugin-settings-page/
 * thanks Iain Poulson
 **/

namespace Inc\Modules;

class Settings
{
    function __construct()
    {
        add_action('admin_menu', array($this, 'font_awesome_local_add_settings_page'));
        add_action( 'admin_init', array($this,'font_awesome_local_register_settings' ));
    }

    function font_awesome_local_add_settings_page()
    {
        add_options_page('Font Awesome page', 'Font Awesome', 'manage_options', 'font_awesome_local-plugin', array($this,'font_awesome_local_settings_page'));
    }

    function font_awesome_local_settings_page()
    {
        
?>
        <form action="options.php" method="post">
            <?php
                settings_fields( 'font_awesome_local_plugin_options' );
                do_settings_sections( 'font_awesome_local_plugin' ); 
            ?>
            <input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e('Save'); ?>" />
        </form>
<?php
    }


    function font_awesome_local_register_settings() {
        register_setting( 'font_awesome_local_plugin_options', 'font_awesome_local_plugin_options');
        add_settings_section( 'font_awesome_settings', __( 'Font Awesome local', 'font_awesome_local' ), array($this,'font_awesome_local_plugin_section_text'), 'font_awesome_local_plugin' );
        add_settings_section( 'font_awesome_libs', __( 'Icon libraries to load', 'font_awesome_local' ), array($this,'font_awesome_local_plugin_section_libs_text'), 'font_awesome_local_plugin' );
    
        add_settings_field( 'font_awesome_local_plugin_setting_version', 'Version', array($this,'font_awesome_local_plugin_setting_version'), 'font_awesome_local_plugin', 'font_awesome_settings' );

        add_settings_field( 'font_awesome_local_plugin_setting_brands', 'Brands icons', array($this,'font_awesome_local_plugin_setting_brands'), 'font_awesome_local_plugin', 'font_awesome_libs' );
        add_settings_field( 'font_awesome_local_plugin_setting_regular', 'Regular icons', array($this,'font_awesome_local_plugin_setting_regular'), 'font_awesome_local_plugin', 'font_awesome_libs' );
        add_settings_field( 'font_awesome_local_plugin_setting_solid', 'Solid icons', array($this,'font_awesome_local_plugin_setting_solid'), 'font_awesome_local_plugin', 'font_awesome_libs' );
    }
    
    function font_awesome_local_plugin_section_text() {
        echo '<p>'.__( 'Change plugin settings here', 'font_awesome_local' ) . '</p>';
    }

    function font_awesome_local_plugin_section_libs_text() {
        echo '<p>Load these icons. For every type of icon checked here resources will be loaded seperately.<br>';
        echo 'If you wish to load all icons check none. This will load only one css and js file with all icons will be loaded.</p>';
    }
    
    function font_awesome_local_plugin_setting_version() {
        $options = get_option( 'font_awesome_local_plugin_options' );
        $selected = array();
        $selected['5.0.1'] = esc_attr( $options['version']) == '5.0.1' ? 'selected="selected"' : null;
        $selected['5.1.0'] = esc_attr( $options['version']) == '5.1.0' ? 'selected="selected"' : null; 
        $selected['5.10.0'] = esc_attr( $options['version']) == '5.10.0' ? 'selected="selected"' : null; 
        $selected['5.15.5'] = esc_attr( $options['version']) == '5.15.4' ? 'selected="selected"' : null; 
        $selected['6.0.0'] = esc_attr( $options['version']) == '6.0.0' ? 'selected="selected"' : null; 
        $selected['6.1.1'] = esc_attr( $options['version']) == '6.1.1' ? 'selected="selected"' : null; 
        $select = <<<EOD
            <select name='font_awesome_local_plugin_options[version]' id='font_awesome_local_plugin_setting_version'>
                <option {$selected['5.0.1']} value="5.0.1">5.0.1</option>
                <option {$selected['5.1.0']} value="5.1.0">5.1.0</option>
                <option {$selected['5.10.0']} value="5.10.0">5.10.0</option>
                <option {$selected['5.15.5']} value="5.15.4">5.15.4</option>
                <option {$selected['6.0.0']} value="6.0.0">6.0.0</option>
                <option {$selected['6.1.1']} value="6.1.1">6.1.1</option>
            </select>
        EOD;
        echo $select;
    }

    function font_awesome_local_plugin_setting_brands() {
        $options = get_option( 'font_awesome_local_plugin_options' );
        $checked = isset( $options['brands']) == true ? 'checked="checked"' : null;
        echo '<input type="checkbox" id="font_awesome_local_plugin_setting_brands" name="font_awesome_local_plugin_options[brands]" value="1" '.$checked.'>';
    }

    function font_awesome_local_plugin_setting_regular() {
        $options = get_option( 'font_awesome_local_plugin_options' );
        $checked = isset( $options['regular']) == true ? 'checked="checked"' : null;
        echo '<input type="checkbox" id="font_awesome_local_plugin_setting_regular" name="font_awesome_local_plugin_options[regular]" value="1" '.$checked.'>';
    }

    function font_awesome_local_plugin_setting_solid() {
        $options = get_option( 'font_awesome_local_plugin_options' );
        $checked = isset( $options['solid']) == true ? 'checked="checked"' : null;
        echo '<input type="checkbox" id="font_awesome_local_plugin_setting_solid" name="font_awesome_local_plugin_options[solid]" value="1" '.$checked.'>';
    }
    

} //class