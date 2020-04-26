<?php
/* 
* WPAC Popular Posts
* This widget will show most liked or disliked posts.
*/
class WPAC_Popular_Posts_Widget extends WP_Widget {

	function __construct() {

		parent::__construct(
			'wpacpopularposts_widget',
			esc_html__( 'WPAC Popular Posts', 'wpaclike' ),
			array( 'description' => esc_html__( 'Show most liked or disliked posts anywhere on your website.', 'wpaclike' ), ) // Args
		);
	}

	private $widget_fields = array(
		array(
			'label' => 'Posts Type',
			'id' => 'wpac_widget_show_type',
			'default' => '1',
			'type' => 'select',
			'options' => array(
				'Liked',
				'Disliked',
			),
		),
		array(
			'label' => 'Total Posts to Show',
			'id' => 'wpac_widget_total_number',
			'default' => '10',
			'type' => 'number',
		),
		array(
			'label' => 'Featured Image',
			'id' => 'wpac_widget_show_featured',
			'type' => 'checkbox',
		),
		array(
			'label' => 'Show Badge',
			'id' => 'wpac_widget_show_count',
			'type' => 'checkbox',
		),
	);

	public function widget( $args, $instance ) {
		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo '<div class="wpac-widget-title">';
			echo '<span>'.$instance['title'].'</span>';
			echo '</div>';
        }
		echo '<div class="wpac-widget-content">';
        if($instance['wpac_widget_show_type'] == "Liked") {
			
            $liked_args = array(
				"post_type" => array("post"),
				"posts_per_page" => $instance['wpac_widget_total_number'],
				'orderby' => 'meta_value_num',
				'meta_key' => '_wpac_post_likes',
				'meta_value'   => 1,
				'meta_compare' => '>='
			);
		} else {
			$liked_args = array(
				"post_type" => array("post"),
				"posts_per_page" => $instance['wpac_widget_total_number'],
				'orderby' => 'meta_value_num',
				'meta_key' => '_wpac_post_dislikes',
				'meta_value'   => 1,
				'meta_compare' => '>='
			);
		}
		$most_liked = new WP_Query($liked_args);
		//print_r($query);
		$badge_count = 1;
		$wpac_db = new WPAC_DB;
		
		while( $most_liked->have_posts() ){
			$most_liked->the_post();
			$like_count = $wpac_db->wpac_count_likes(get_the_ID());
			$like_count = wpac_format_reaction_numbers($like_count);
			$dislike_count = $wpac_db->wpac_count_dislikes(get_the_ID());
			$dislike_count = wpac_format_reaction_numbers($dislike_count);
			?>
				<div class="wpac-widget-posts-row">
					<?php if(isset($instance['wpac_widget_show_featured']) && $instance['wpac_widget_show_featured'] == 1) {?>
					<div class="wpac-widget-post-thumb">
						<a href="<?php the_permalink() ?>">
						<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail('thumbnail');
							}
							else {
								echo '<img src="' . wpac_default_post_thumb() . '" alt="Thumbnail" />';
							}
						?>
						</a>
						<?php if(isset($instance['wpac_widget_show_count']) && $instance['wpac_widget_show_count'] == 1) {?>
						<span class="wpac-post-thumb-badge badge-<?php echo $badge_count ?>"><?php echo $badge_count ?></span>
						<?php } ?>
					</div>
					<?php } ?>
					<div class="wpac-widget-post-title">
						<h3><a href="<?php the_permalink() ?>"><?php echo substr(get_the_title(),0,40) ?>...</a></h3>
						<?php if($instance['wpac_widget_show_type'] == "Liked") {?>
							<span class="wpac-widget-liked-count">Liked <?php echo $like_count ?> times</span>
						<?php } else { ?>
							<span class="wpac-widget-liked-count">Disliked <?php echo $dislike_count ?> times</span>
						<?php } ?>
					</div>
				</div>
			<?php 
		$badge_count++; }
        echo '</div>';
		// Output generated fields
		//echo '<p>'.$instance['wpac_widget_show_type'].'</p>';
		//echo '<p>'.$instance['wpac_widget_total_number'].'</p>';
		//echo '<p>'.$instance['wpac_widget_show_featured'].'</p>';
		//echo '<p>'.$instance['wpac_widget_show_count'].'</p>';
        
		
		echo $args['after_widget'];
	}

	public function field_generator( $instance ) {
		$output = '';
		foreach ( $this->widget_fields as $widget_field ) {
			$default = '';
			if ( isset($widget_field['default']) ) {
				$default = $widget_field['default'];
			}
			$widget_value = ! empty( $instance[$widget_field['id']] ) ? $instance[$widget_field['id']] : esc_html__( $default, 'wpaclike' );
			switch ( $widget_field['type'] ) {
				case 'checkbox':
					$output .= '<p>';
					$output .= '<input class="checkbox" type="checkbox" '.checked( $widget_value, true, false ).' id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" value="1">';
					$output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'wpaclike' ).'</label>';
					$output .= '</p>';
					break;
				case 'select':
					$output .= '<p>';
					$output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'textdomain' ).':</label> ';
					$output .= '<select id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'">';
					foreach ($widget_field['options'] as $option) {
						if ($widget_value == $option) {
							$output .= '<option value="'.$option.'" selected>'.$option.'</option>';
						} else {
							$output .= '<option value="'.$option.'">'.$option.'</option>';
						}
					}
					$output .= '</select>';
					$output .= '</p>';
					break;
				default:
					$output .= '<p>';
					$output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'wpaclike' ).':</label> ';
					$output .= '<input class="widefat" id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" type="'.$widget_field['type'].'" value="'.esc_attr( $widget_value ).'">';
					$output .= '</p>';
			}
		}
		echo $output;
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'wpaclike' );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'wpaclike' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
		$this->field_generator( $instance );
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		foreach ( $this->widget_fields as $widget_field ) {
			switch ( $widget_field['type'] ) {
				default:
					$instance[$widget_field['id']] = ( ! empty( $new_instance[$widget_field['id']] ) ) ? strip_tags( $new_instance[$widget_field['id']] ) : '';
			}
		}
		return $instance;
	}
}

function register_wpacpopularposts_widget() {
	register_widget( 'WPAC_Popular_Posts_Widget' );
}
add_action( 'widgets_init', 'register_wpacpopularposts_widget' );