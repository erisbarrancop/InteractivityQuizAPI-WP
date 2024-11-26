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
		'isDark' => false,
		'darkText' => esc_html__('Switch to Light', 'interactivity-quiz'),
		'lightText' => esc_html__('Switch to Dark', 'interactivity-quiz'),
		'themeText' => esc_html__('Switch to Dark', 'interactivity-quiz'),
	)
);

$answers = array();
for ($i = 0; $i < count($attributes['answers']); $i++) {
	$answers[$i]['index'] = $i;
	$answers[$i]['text'] = $attributes['answers'][$i];
	$answers[$i]['correct'] = $attributes['correctAnswer'] == $i;
}
$ourContext = array('answers' => $answers, 'solved' => false, 'showCongrats' => false, 'showSorry' => false, 'correctAnswer' => $attributes['correctAnswer']);

?>



<div style="background-color: <?php echo $attributes['bgColor'] ?>" class="paying-attention-frontend"
	data-wp-interactive="create-block" <?php echo wp_interactivity_data_wp_context($ourContext) ?>>
	<p><?php echo $attributes['question'] ?></p>
	<ul>
		<?php
		foreach ($ourContext['answers'] as $answer) { ?>
			<li data-wp-class--no-click="callbacks.noclickclass" data-wp-class--fade-incorrect="callbacks.fadedclass" <?php echo wp_interactivity_data_wp_context($answer) ?> data-wp-on--click="actions.guessAttempt"><span data-wp-bind--hidden="!context.solved">
				<span data-wp-bind--hidden="!context.correct">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 16">
                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z" />
                    </svg>
				</span>
				<span data-wp-bind--hidden="context.correct">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                    </svg>
				</span>
			</span> <?php echo $answer['text'] ?></li>
		<?php }
		?>
	</ul>
	
	<div class="correct-message" data-wp-class--correct-message--visible="context.showCongrats">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" className="bi bi-emoji-smile" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
            <path d="M4.285 9.567a.5.5 0 0 1 .683.183A3.5 3.5 0 0 0 8 11.5a3.5 3.5 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5m4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5" />
        </svg>
        <p>That is correct!</p>
	</div>

	<div class="incorrect-message" data-wp-class--incorrect-message--visible="context.showSorry">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" className="bi bi-hand-thumbs-down"
			viewBox="0 0 16 16">
			<path
				d="M8.864 15.674c-.956.24-1.843-.484-1.908-1.42-.072-1.05-.23-2.015-.428-2.59-.125-.36-.479-1.012-1.04-1.638-.557-.624-1.282-1.179-2.131-1.41C2.685 8.432 2 7.85 2 7V3c0-.845.682-1.464 1.448-1.546 1.07-.113 1.564-.415 2.068-.723l.048-.029c.272-.166.578-.349.97-.484C6.931.08 7.395 0 8 0h3.5c.937 0 1.599.478 1.934 1.064.164.287.254.607.254.913 0 .152-.023.312-.077.464.201.262.38.577.488.9.11.33.172.762.004 1.15.069.13.12.268.159.403.077.27.113.567.113.856s-.036.586-.113.856c-.035.12-.08.244-.138.363.394.571.418 1.2.234 1.733-.206.592-.682 1.1-1.2 1.272-.847.283-1.803.276-2.516.211a10 10 0 0 1-.443-.05 9.36 9.36 0 0 1-.062 4.51c-.138.508-.55.848-1.012.964zM11.5 1H8c-.51 0-.863.068-1.14.163-.281.097-.506.229-.776.393l-.04.025c-.555.338-1.198.73-2.49.868-.333.035-.554.29-.554.55V7c0 .255.226.543.62.65 1.095.3 1.977.997 2.614 1.709.635.71 1.064 1.475 1.238 1.977.243.7.407 1.768.482 2.85.025.362.36.595.667.518l.262-.065c.16-.04.258-.144.288-.255a8.34 8.34 0 0 0-.145-4.726.5.5 0 0 1 .595-.643h.003l.014.004.058.013a9 9 0 0 0 1.036.157c.663.06 1.457.054 2.11-.163.175-.059.45-.301.57-.651.107-.308.087-.67-.266-1.021L12.793 7l.353-.354c.043-.042.105-.14.154-.315.048-.167.075-.37.075-.581s-.027-.414-.075-.581c-.05-.174-.111-.273-.154-.315l-.353-.354.353-.354c.047-.047.109-.176.005-.488a2.2 2.2 0 0 0-.505-.804l-.353-.354.353-.354c.006-.005.041-.05.041-.17a.9.9 0 0 0-.121-.415C12.4 1.272 12.063 1 11.5 1" />
		</svg>
		<p>Sorry! You failed</p>
	</div>
</div>