<?php
/*
 * @package WordPress
 * Template Name: Home Page
*/

//style="left:-800px"
?>
<?php get_header(); ?>
<?php 
    echo do_shortcode("[metaslider id=480]"); 
?>
	<?php if (have_posts()) : the_post(); ?>
	
	<div class="home-area center-wrap-790">
	<?php
	$link_under_slider_url = get_field('link-under-slider-url');
	$link_under_slider_text = get_field('link-under-slider-text');
	$link_under_slider_icon = get_field('link-under-slider-icon');
	if($link_under_slider_url){
	?>
	<a href="<?php echo $link_under_slider_url; ?>" class="video-link mobile-visible">
		<span class="column"><img src="<?php echo $link_under_slider_icon; ?>" alt="video icon"></span>
		<span class="column"><?php echo $link_under_slider_text; ?></span>
	</a>
	<?php } ?>
	<?php
	$slides = get_field('slides');
	if($slides){
	?>
	<section class="widgets-slider">
		<div class="slides">
		<?php foreach($slides as $slide){ ?>
			<aside class="widget">
				<div class="holder">
					<h3><a href="<?php echo $slide['link']; ?>"><img src="<?php echo $slide['icon']['url']; ?>" alt=""><?php echo $slide['title']; ?></a></h3>
					<p><?php echo $slide['text']; ?> <a href="<?php echo $slide['link']; ?>" class="link-view pc-visible">ViEW</a></p>
					<div class="link-holder pc-hide">
						<a href="<?php echo $slide['link']; ?>" class="link-view">ViEW</a>
					</div>
				</div>
			</aside>
		<?php } ?>	
		</div>
	</section>
	<?php } ?>
			
	<div class="main-area cf">
		<div id="sidebar" class="sidebar-home right">
		<?php
		$blog_query = new WP_Query( array('post_type'=>'post','posts_per_page'=>1) );
		if ( $blog_query->have_posts() ) {
		?>
			<aside class="widget widget-blog cf">
				<h3 class="tablet-hide"><img src="<?php echo TDU; ?>/images/ico-blog.png" alt="">Our Blog</h3>
				<?php while ( $blog_query->have_posts() ) { $blog_query->the_post();?>
				<?php if(has_post_thumbnail()){ 
						$post_thumbnail_id = get_post_thumbnail_id();
						$post_thumbnail_src = wp_get_attachment_image_src($post_thumbnail_id, 'full'); ?>
				<a href="<?php the_title(); ?>" class="image tablet-hide"><img src="<?php echo $post_thumbnail_src[0]; ?>" alt="<?php the_title(); ?>"></a>
				<a href="<?php the_title(); ?>" class="image tablet-visible"><img src="<?php echo $post_thumbnail_src[0]; ?>" alt="<?php the_title(); ?>"></a>
				<?php } ?>
				<article>
					<h3 class="tablet-visible"><img src="<?php echo TDU; ?>/images/ico-blog.png" alt="">Our Blog</h3>
					<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
					<strong class="date"><?php the_time('j M Y'); ?></strong>
						<?php
						if(!empty($post->post_excerpt)){
							$excerpt = $post->post_excerpt;
						}else{
							$excerpt = get_content_excerpt($post->post_content, 150);
						}						
						echo '<p>'.$excerpt.'... <a href="'.get_permalink().'" class="link-view pc-visible">view</a></p>';
						?>					
					<div class="link-holder pc-hide">
						<a href="<?php the_permalink(); ?>" class="link-view">ViEW</a>
					</div>
				</article>
				<?php } ?>
			</aside>
		<?php } wp_reset_postdata(); ?>	
		</div>

		<article id="content" class="content-home left">
			<?php the_content(); ?>
		</article>

	</div>
</div>

	<?php endif; ?>
<?php get_footer(); ?>