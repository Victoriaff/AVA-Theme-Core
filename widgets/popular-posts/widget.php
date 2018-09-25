<?php


// Creating the widget
class WPM_Widget_Popular_Posts extends WP_Widget {

	public $args = array(
		'class_widget' => 'widget-popular'
	);

	function __construct() {
		parent::__construct(
			// Base ID of your widget
			'WPM_Widget_Popular_Posts',

			// Widget name will appear in UI
			__('Popular Posts', 'wpm-theme-core'),

			// Widget description
			array( 'description' => __( 'Output most popular posts', 'wpm-theme-core' ), )
		);
	}

	// Creating widget front-end
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		// before and after widget arguments are defined by themes
		if (!empty($this->args['class_widget'])) $args['before_widget'] = preg_replace('/widget\-content/', $this->args['class_widget'], $args['before_widget']);
		echo wp_kses_post($args['before_widget']);

		if ( ! empty( $title ) )
			echo wp_kses_post($args['before_title'] . $title . $args['after_title']);

		// This is where you run the code and display the output
		$query = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => absint( $instance['posts_count'] ),
			//'order' => $atts['order'],
			//'orderby' => $atts['orderby'],
		);
		$posts = new WP_Query( $query );

		if (!empty($posts->posts)) {
			echo '<ul>';
			foreach ( $posts->posts as $post ) {
				echo '<li><a href="'.get_the_permalink($post->ID).'">'.get_the_title($post->ID).'</a></li>';
			}
			echo '</ul>';
		}

		echo wp_kses_post($args['after_widget']);
	}

	// Widget Backend
	public function form( $instance ) {
		$title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : __( 'Most Popular', 'wpm-theme-core' );
		$posts_count = isset( $instance[ 'posts_count' ] ) ? $instance[ 'posts_count' ] : 3;

		// Widget admin form
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php __( 'Title', 'wpm-theme-core' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'posts_count' )); ?>"><?php __( 'Posts count', 'wpm-theme-core' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'posts_count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'posts_count' )); ?>" type="text" value="<?php echo esc_attr( $posts_count ); ?>" />
		</p>
		<?php
	}

	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();

		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['posts_count'] = ( ! empty( $new_instance['title'] ) && is_int((int)$new_instance['posts_count'])) ? (int)$new_instance['posts_count'] : '';

		return $instance;
	}
}