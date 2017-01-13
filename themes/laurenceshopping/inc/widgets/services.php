<?php

class Stm_Services_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'services', // Base ID
			__('Services', 'bestbuild'), // Name
			array( 'description' => __( 'Services widget', 'bestbuild' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
		}

		$services = get_posts( array( 'post_type' => 'service', 'posts_per_page' => -1 ) );

		if( $services ){
			$output = '<ul>';
			foreach( $services as $service ){
				$output .= '<li' . (( get_the_ID() == $service->ID ) ? ' class="active"' : '' ) . '><a href="' . get_permalink( $service->ID ) . '">' . get_the_title( $service->ID ) . '</a></li>';
			}
			$output .= '</ul>';
			echo $output;
		}

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		$title = '';

		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}else {
			$title = __( 'Services', 'bestbuild' );
		}

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'bestbuild' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
	<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? esc_attr( $new_instance['title'] ) : '';

		return $instance;
	}

}

function register_services_widget() {
	register_widget( 'Stm_Services_Widget' );
}
add_action( 'widgets_init', 'register_services_widget' );