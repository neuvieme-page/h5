<?php
/*
Template Name: Contact page
*/
?>
<?php get_header(); ?>
	<div class="primary">
		<main class="site-main" role="main">
		    <div class="container">
                <?php
                if ( have_posts() ):
                    while ( have_posts() ) {
                        the_post();
                        the_content();
                    }
                else: ?>
                    <script id="findme">window.early.done();</script>
                <?php endif; ?>
		        
                <!--
                    <div class="subscribe">
                        
                        
                        <h4><?php // pll_e('Mailchimp subscribe'); ?></h4>
                        <form name="mailchimp-subscribe">
                            <input name="email" type="text" placeholder="<?php // pll_e('Mailchimp email'); ?>">
    
                            <input name="fname" type="hidden" value="">
                            <input name="lname" type="hidden" value="">
                            <p class="mailchimp-msg mailchimp-invalid hidden"><?php // pll_e('Mailchimp invalid'); ?></p>
                            <p class="mailchimp-msg mailchimp-success hidden"><?php // pll_e('Mailchimp success'); ?></p>
                            <p class="mailchimp-msg mailchimp-exists hidden"><?php // pll_e('Mailchimp user exists'); ?></p>
                            <p class="mailchimp-msg mailchimp-generic hidden"><?php // pll_e('Mailchimp generic error'); ?></p>
                            <button type="submit"><?php // pll_e('Mailchimp subscribebutton'); ?></button>
                        </form>
                    </div>
                -->
            </div>
		</main>
	</div>
<?php get_footer(); ?>