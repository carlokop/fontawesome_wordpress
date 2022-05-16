<?php

/**
 * @package  font-awesome-local
 * Enqueue assets
 **/

namespace Inc\Modules;

class Enqueue_Plugin 
{
    function __construct() {
        add_action('wp_enqueue_scripts', array($this, 'enqueue')); 
    }
    
    //frontend scripts
    function enqueue() {
        $folderName = 'Assets/fontawesome-free-' . PLUGIN_OPTIONS['version'];

        $resourcesToLoad = array();
        if(isset(PLUGIN_OPTIONS['brands'])) { array_push($resourcesToLoad,'brands');}
        if(isset(PLUGIN_OPTIONS['duotone'])) { array_push($resourcesToLoad,'duotone');}
        if(isset(PLUGIN_OPTIONS['light'])) { array_push($resourcesToLoad,'light');}
        if(isset(PLUGIN_OPTIONS['regular'])) { array_push($resourcesToLoad,'regular');}
        if(isset(PLUGIN_OPTIONS['solid'])) { array_push($resourcesToLoad,'solid');}
        if(isset(PLUGIN_OPTIONS['thin'])) { array_push($resourcesToLoad,'thin');}

        if(count($resourcesToLoad) > 0 && count($resourcesToLoad) < 6) {;

            array_push($resourcesToLoad,'fontawesome'); //initial resources

            //load icon libraries individualy
            foreach($resourcesToLoad as $resource) {
                wp_enqueue_style('fontawesomelocalcss'.$resource, PLUGIN_URL . $folderName . "/css/". $resource .".min.css", null, PLUGIN_OPTIONS['version'] );
                wp_enqueue_script('fontawesomelocaljs'.$resource, PLUGIN_URL . $folderName . "/js/". $resource .".min.js", null, PLUGIN_OPTIONS['version'], true );
            }
            
        } else {
            //just load all.css and all.js
            wp_enqueue_style('fontawesomelocalcss', PLUGIN_URL . $folderName . "/css/all.min.css", null, PLUGIN_OPTIONS['version'] );
            wp_enqueue_script('fontawesomelocaljs', PLUGIN_URL . $folderName . "/js/all.min.js", null, PLUGIN_OPTIONS['version'], true );
        }
 
    }

} //class