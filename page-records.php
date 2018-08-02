<?php get_header();?>
	<div class="primary">

		<main class="site-main" role="main">
		    <div class="container">
		        <script>window.useloadmore=true;</script>
                <?php
if (have_posts()): ?>
                        <div class="logos">
<?php
the_post();
$gallery = get_field('items', get_the_ID());
foreach ($gallery as $logo):
?>
		    <div class="logo-item">
		        <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['title'] ?>" />
		    </div>

		                        <?php
endforeach;
else: ?>
                    <script>window.early.done();</script>
<?php endif;?>
</div>
            </div>
		</main>
	</div>
<?php get_footer();?>