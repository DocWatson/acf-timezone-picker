<?php

class acf_field_timezone_picker extends acf_field {

    // vars
    var $settings, // will hold info such as dir / path
        $defaults; // will hold default field options


    /*
    *  __construct
    *
    *  Set name / label needed for actions / filters
    *
    *  @since	3.6
    *  @date	23/01/13
    */

    function __construct()
    {
        // vars
        $this->name = 'timezone_picker';
        $this->label = __('Timezone');
        $this->category = __("Choice",'acf'); // Basic, Content, Choice, etc
        $this->defaults = array(
            // add default here to merge into your field.
            // This makes life easy when creating the field options as you don't need to use any if( isset('') ) logic. eg:
            //'preview_size' => 'thumbnail'
        );


        // do not delete!
        parent::__construct();


        // settings
        $this->settings = array(
            'path' => apply_filters('acf/helpers/get_path', __FILE__),
            'dir' => apply_filters('acf/helpers/get_dir', __FILE__),
            'version' => '1.0.0'
        );

    }




    /*
    *  create_field()
    *
    *  Create the HTML interface for your field
    *
    *  @param	$field - an array holding all the field's data
    *
    *  @type	action
    *  @since	3.6
    *  @date	23/01/13
    */

    function create_field( $field )
    {
        /*
        *  Create a select dropdown with all available timezones
        */
        $utc = new DateTimeZone('UTC');
        $dt = new DateTime('now', $utc);
        ?>
        <select name="<?php echo esc_attr($field['name']) ?>">
            <?php
            foreach (\DateTimeZone::listIdentifiers() as $tz) {
                $current_tz = new \DateTimeZone($tz);
                $transition = $current_tz->getTransitions($dt->getTimestamp(), $dt->getTimestamp());
                $abbr = $transition[0]['abbr'];
                ?>
                <option value="<?php echo trim($tz); ?>" <?php echo (trim($tz) == trim($field["value"])) ? 'selected="selected"' : ''; ?>><?php echo $tz . ' (' . $abbr . ')'; ?></option>
            <?php } ?>
        </select>
    <?php
    }



}


// create field
new acf_field_timezone_picker();

?>
