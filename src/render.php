<?php
/**
 * PHP file to use when rendering the block type on the server to show on the front end.
 *
 * The following variables are exposed to the file:
 *     $attributes (array): The block attributes.
 *     $content (string): The block default content.
 *     $block (WP_Block): The block instance.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */


// Adds the global state.
wp_interactivity_state(
	'create-block',
	array(
		'isDark'    => false,
		'darkText'  => esc_html__( 'Switch to Light', 'interactivity-quiz' ),
		'lightText' => esc_html__( 'Switch to Dark', 'interactivity-quiz' ),
		'themeText'	=> esc_html__( 'Switch to Dark', 'interactivity-quiz' ),
	)
);
?>

<div class="paying-attention-frontend" data-wp-interactive="create-block" data-wp-context='{"clickCount": 0}'>
	<p>Question here</p>
	<ul>
		<li>Answer 1</li>
		<li>Answer 2</li>
		<li>Answer 3</li>
	</ul>
</div>



