<?php get_header();?>
	<div class="primary">
		<main class="site-main" role="main">
		    <div class="container">
		        <script>window.useloadmore=true;</script>
                <?php if (have_posts()): ?>
                        <div class="masonry-grid">
                            <?php while (have_posts()) {
    the_post();
    the_content();
}?>
                        </div>
                        <?php
else: ?>
                    <script>window.early.done();</script>
                <?php endif;?>
            </div>
		</main>
	</div>
<?php get_footer();?>