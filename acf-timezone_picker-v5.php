<?php

class acf_field_timezone_picker extends acf_field {


	/*
	*  __construct
	*
	*  This function will setup the field type data
	*
	*  @type	function
	*  @date	5/03/2014
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/

	function __construct() {

		/*
		*  name (string) Single word, no spaces. Underscores allowed
		*/

		$this->name = 'timezone_picker';


		/*
		*  label (string) Multiple words, can include spaces, visible when selecting a field type
		*/

		$this->label = __('Timezone', 'acf-timezone_picker');


		/*
		*  category (string) basic | content | choice | relational | jquery | layout | CUSTOM GROUP NAME
		*/

		$this->category = 'choice';


		/*
		*  l10n (array) Array of strings that are used in JavaScript. This allows JS strings to be translated in PHP and loaded via:
		*  var message = acf._e('timezone_picker', 'error');
		*/

		$this->l10n = array(
			'error'	=> __('Error! Please select a value.', 'acf-timezone_picker'),
		);


		// do not delete!
    	parent::__construct();

	}


	/*
	*  render_field()
	*
	*  Create the HTML interface for your field
	*
	*  @param	$field (array) the $field being rendered
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field (array) the $field being edited
	*  @return	n/a
	*/

	function render_field( $field ) {

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
                $is_selected = trim($field['value']) === trim($tz) ? ' selected="selected"' : '';
                ?>
                <option value="<?php echo $tz; ?>"<?php echo $is_selected;?>><?php echo $tz . ' (' . $abbr . ')'; ?></option>
            <?php } ?>
        </select>
    <?php
    }
}


// create field
new acf_field_timezone_picker();

?>
