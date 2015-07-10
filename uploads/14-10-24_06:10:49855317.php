<?php
/**
 * Plugin Name: Simple BMI calculator
 * Plugin URI: 
 * Description: Plugin that provides BMI calculator to be used as a widget. It is totally free to use anywhere you want.
 * Version: 1.0
 * Author: youlek
 * Author URI: http://znajomek.com
 */


add_action( 'widgets_init', 'bmi_load_widget' );

function bmi_load_widget() {
	register_widget( 'bmi_calculator' );
}

wp_enqueue_style('main-styles', WP_PLUGIN_URL . '/simple-body-mass-index-calculator/css/main.css');

class bmi_calculator extends WP_Widget {

	function bmi_calculator() {
	
		$widget_ops = array( 'classname' => 'bmi_calculator', 'description' => 'Simple Body Mass Index Calculator Widget' );

		$control_ops = array( 'id_base' => 'bmi-calculator-widget' );

		$this->WP_Widget( 'bmi-calculator-widget', 'Simple BMI Calculator', $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		$calculate = $instance['calculate'];
		$yourbmi = $instance['yourbmi'];
		$background = $instance['background'];
		$border = $instance['border'];

		$bmi_error = $instance['bmi_error'];
		$show_link = $instance['show_link'];
	
		echo $before_widget; ?>
			
		<style type="text/css">
			
			#bmi_calculator {
				background-color: <?php echo $background; ?>;
				border: 1px solid <?php echo $border; ?>;
			}

			#bmi_calculator h2 {
				background-color: <?php echo $border; ?>;
			}

		</style>

		<div id="bmi_calculator">
			<h2><?php echo $title; ?></h2>
			<table>

			<tr><td><label for="bmi_weight">Weight:</label></td><td><input type="text" name="bmi_weight" id="bmi_weight" /><span>kg</span></td></tr>
			<tr><td><label for="bmi_height">Height:</label></td><td><input type="text" name="bmi_height" id="bmi_height" /><span>cm</span></td></tr>

			</table>

			<button onclick="calculate_bmi()" name="bmi_calculate" id="bmi_submit"><?php echo $calculate; ?></button>

			<div id="bmi_result"></div>

			<?php if($show_link == 'on') { ?>
					<a class="poweredby" href="http://bmi.znajomek.com">Powered by BMI calculator</a>
			<?php } ?>
		</div>
			
<script type="text/javascript">

function calculate_bmi() {

	var weight = document.getElementById('bmi_weight').value;
	var height = document.getElementById('bmi_height').value/100;
	var bmi = weight/(height*height);
	var msg = '';

	if(bmi < 15) {
		msg = 'Very severely underweight';
	} else if(bmi > 15 && bmi < 16) {
		msg = 'Severely underweight';
	} else if(bmi > 16 && bmi < 18.5) {
		msg = 'Underweight';
	} else if(bmi > 18.5 && bmi < 25) {
		msg = 'Normal';
	} else if(bmi > 25 && bmi < 30) {
		msg = 'Overweight';
	} else if(bmi > 30 && bmi < 35) {
		msg = 'Obese Class I (Moderately obese)';
	} else if(bmi > 35 && bmi < 40) {
		msg = 'Obese Class II (Severely obese)';
	} else if(bmi > 40) {
		msg = 'Obese Class III (Very severely obese)';
	}

	if(weight > 0 && height > 0 && weight != null && height != null) {
		bmi_result.innerHTML = '<p><?php echo $yourbmi; ?><strong>' + bmi.toFixed(2) + '</strong></p><p><strong>' + msg + '</strong></p>';
	} else {
		alert('<?php echo $bmi_error; ?>');
	}
}

	</script>
	<?php echo $after_widget; 	
}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['background'] = $new_instance['background'];
		$instance['border'] = $new_instance['border'];
		
		$instance['calculate'] = $new_instance['calculate'];
		$instance['yourbmi'] = $new_instance['yourbmi'];

		$instance['bmi_error'] = $new_instance['bmi_error'];
		$instance['show_link'] = $new_instance['show_link'];
		
		return $instance;
	}

	function form( $instance ) {

		$defaults = array( 'title' => 'BMI Calculator', 'calculate' => 'Calculate', 'yourbmi' => 'Your BMI = ', 'bmi_error' => 'Please enter valid data!', 'background' => '#fafafa', 'border' => '#72b352', 'show_link' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" /></label>
		</p>
        
		<p>
			<label for="<?php echo $this->get_field_id( 'background' ); ?>">Background color:
			<input id="<?php echo $this->get_field_id( 'background' ); ?>" name="<?php echo $this->get_field_name( 'background' ); ?>" value="<?php echo $instance['background']; ?>" class="widefat" type="text" /></label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'border' ); ?>">Border color:</label>
			<input id="<?php echo $this->get_field_id( 'border' ); ?>" name="<?php echo $this->get_field_name( 'border' ); ?>" value="<?php echo $instance['border']; ?>" class="widefat" type="text" />
		</p>
        
		<p>
			<label for="<?php echo $this->get_field_id( 'calculate' ); ?>">Text: Calculate BMI
			<input id="<?php echo $this->get_field_id( 'calculate' ); ?>" name="<?php echo $this->get_field_name( 'calculate' ); ?>" value="<?php echo $instance['calculate']; ?>" class="widefat" type="text" /></label>
		</p> 
 
		<p>
			<label for="<?php echo $this->get_field_id( 'yourbmi' ); ?>">Text: Your BMI is
			<input id="<?php echo $this->get_field_id( 'yourbmi' ); ?>" name="<?php echo $this->get_field_name( 'yourbmi' ); ?>" value="<?php echo $instance['yourbmi']; ?>" class="widefat" type="text" /></label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'bmi_error' ); ?>">Text: Incorrect data
			<input id="<?php echo $this->get_field_id( 'bmi_error' ); ?>" name="<?php echo $this->get_field_name( 'bmi_error' ); ?>" value="<?php echo $instance['bmi_error']; ?>" class="widefat" type="text" /></label>
		</p>
		
		<p><label for="<?php echo $this->get_field_id( 'show_link' ); ?>">Support the Author and allow link to bmi.znajomek.com&nbsp;&nbsp;<input id="<?php echo $this->get_field_id( 'show_link' ); ?>" name="<?php echo $this->get_field_name( 'show_link' ); ?>" class="checkbox" type="checkbox" <?php checked($instance['show_link'], 'on'); ?> /></label>
		</p>  
		
<?php } 
} ?>