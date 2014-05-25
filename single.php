<?php get_header(); ?>

<p>TEST TEST TEST</p>

<div id="content">
<?php include TEMPLATEPATH . '/landingsite.php'; ?>

				
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<div class="post">
			<h1 id="post-<?php the_ID(); ?>"><a href="<?php echo get_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>"><?php the_title(); ?></a></h1>
	
			<div class="entrytext">
				<?php the_content('<p class="serif">Lies den Rest dieses Eintrags &raquo;</p>'); ?>
	
				<?php link_pages('<p><strong>Seite:</strong> ', '</p>', 'number'); ?>
	
				<p class="postmetadata alt">
					<small>
						Dieser Eintrag wurde geschrieben 
						am <?php the_date() ?> um <?php the_time() ?>
						und ist gespeichert unter <?php the_category(', ') ?>.  <?php the_tags('Die Tags sind ', ', ','. ' ); ?> 
						Du kannst alle Kommentare über den Kommentar <?php comments_rss_link('RSS 2.0'); ?> Feed verfolgen. 
						
						<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Both Comments and Pings are open ?>
							Du kannst <a href="#respond">einen Kommentar schreiben</a>, oder einen <a href="<?php trackback_url(display); ?>">Trackback</a> von deiner Seite schicken.
						
						<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Only Pings are Open ?>
							Die Kommentarfunktion ist ausgeschaltet, aber du kannst einen <a href="<?php trackback_url(display); ?> ">Trackback</a> von deiner Seite schicken.
						
						<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Comments are open, Pings are not ?>
							Du kannst <a href="#respond">einen Kommentar schreiben</a>. Trackbacks sind zur Zeit abgeschaltet.
			
						<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Neither Comments, nor Pings are open ?>
							Kommentare und Treckbacks sind abgeschaltet.			
						
						<?php } edit_post_link('Bearbeite diesen Eintrag.','',''); ?>
						
					</small>
				</p>
	
			</div>
<!--
<?php trackback_rdf(); ?>
-->
		</div>
<div id="related_posts">
<?php wp_related_posts(); ?>
</div>

		
	<?php comments_template(); ?>
	
		<div class="navigation">
			<div class="alignleft"><?php previous_post('&laquo; %','','yes') ?></div>
			<div class="alignright"><?php next_post(' % &raquo;','','yes') ?></div>
		</div>
	
	<?php endwhile; else: ?>
	
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	
<?php endif; ?>
	
	</div>


</div>

<?php get_footer(); ?>