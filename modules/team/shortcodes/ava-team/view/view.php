<?php

/**
 @array $data shortcode output data from controller
**/

$atts = $data['atts'];
$content = isset( $data['content'] ) ? $data['content'] : '';

$css = '';
extract(shortcode_atts(array(
	'css' => ''
), $atts));

$css_class = $this->get_css_class( $css, $data );

?>
<div id="<?php echo esc_attr( $data['id'] ); ?>" class="<?php echo esc_attr( $css_class ); ?>">
<h2 class="title-head"><?php echo wp_kses_post( $atts['heading'] ); ?></h2>

<?php
if (!empty($data['list'])) {
	$members_per_row = (int)$atts['members_per_row'];
	$members_per_row = $members_per_row ? $members_per_row : 4;

	echo '<ul>';

	$count = 0;
	foreach ( $data['list'] as $post ) {
		if (++$count > $members_per_row) { $count = 1; echo '</ul><ul>'; }
		?>
		<li class="appear wpb_animate_when_almost_visible">
			<img src="<?php echo esc_attr( $post->thumbnail['url'] ); ?>" alt="<?php echo esc_attr( $post->thumbnail['alt'] ); ?>">
			<div class="inside">
				<a href="<?php echo esc_attr( $post->meta['member_link'] ); ?>" class="name">
					<?php echo esc_html($post->post_title); ?>
				</a>
				<span><?php echo esc_html($post->meta['member_position']); ?></span>
			</div>
		</li>
		<?php
	}
	echo '</ul>';
}
?>
</div>