<?php
/*
 * @package WordPress
 * Template Name: Home Page
*/

//style="left:-800px"
?>
<?php get_header(); ?>

	<?php if (have_posts()) : the_post(); ?>
	<?php
	$big_slides = get_field("big_slide");
	if(!empty($big_slides)){
	
		$slideshow_speed = get_field('slideshow_speed');
		
	?>
<section class="home-slider">
	<div class="slides cf">
	<?php foreach($big_slides as $big_slide){?>
		<div class="slide" style="background-image:url(<?php echo $big_slide['big_image']['url']; ?>);">
			<div class="holder">
				<div class="box"> 
					<?php if(!empty($big_slide['title'])){ ?><h1><?php echo $big_slide['title']; ?></h1><?php }?>
					<?php if(!empty($big_slide['text'])){ ?><p class="pc-visible"><?php echo $big_slide['text']; ?></p><?php } ?>
					<?php if(!empty($big_slide['link_url'])){ ?><a href="<?php echo $big_slide['link_url']; ?>" class="link-video mobile-hide"><?php } ?>
					<?php if(!empty($big_slide['link_icon']['url'])){ ?><span><img src="<?php echo $big_slide['link_icon']['url']; ?>" alt=""></span><?php } ?>
					<?php if(!empty($big_slide['link_text'])){ ?><span><?php echo $big_slide['link_text']; ?></span><?php } ?>
					<?php if(!empty($big_slide['link_url'])){ ?></a><?php } ?>
				</div>
			</div>
		</div>
	<?php } ?>	
	</div>
</section>
	<script type="text/javascript">
	(function(){
		$(function(){
			
			var $window = $(window), flexslider;
	
			setTimeout(function(){ $('.widgets-slider .holder').equalHeightColumns(); }, 300);
			
			var slideshow_speed = <?php echo $slideshow_speed;?>;
			$('.home-slider').flexslider({
				animation: "fade",
				selector: ".slides > div",
				slideshowSpeed: <?php the_field('slideshow_speed'); ?>,
				animationSpeed: <?php the_field('animation_speed'); ?>,
				controlNav: false,
				directionNav: false,
				touch: false,
				smoothHeight: false,
				/*
				start: function(){
					jQuery(".flex-active-slide .box").animate({left: "0px"}, slideshow_speed/4);
				},
				after: function(){
					//jQuery(".flex-active-slide .box").show("slow");
					jQuery(".flex-active-slide .box").animate({left: "0px"}, slideshow_speed/4, function(){ 
									setTimeout(function() {
									//	jQuery(".flex-active-slide .box").animate({left: "2000px"}, slideshow_speed/5);
									jQuery(".flex-active-slide .box").fadeOut(slideshow_speed/5);
									}, slideshow_speed/2);
					});
				},
				before: function(){				
					jQuery(".slide .box").css("left", "-800px").fadeIn();
				} */
			});
			
			$('.widgets-slider').flexslider({
				animation: "slide",
				selector: ".slides > aside",
				animationLoop: false,
				slideshowSpeed: 10000,
				animationSpeed: 600,
				controlNav: false,
				touch: false,
				smoothHeight: true,
				itemWidth: 1,
				itemMargin: 50,
				minItems: getGridSize(),
				maxItems: getGridSize()
			});
			
			function getGridSize(){
				return (window.innerWidth < 500) ? 1 : 
				(window.innerWidth < 960) ? 2 : 3;
			}
			
			/*$window.resize(function() {
				var gridSize = getGridSize();
				//flexslider.vars.itemWidth = gridSize;
				flexslider.vars.minItems = gridSize;
				flexslider.vars.maxItems = gridSize;
			});*/
			
		});
		
	})(jQuery);
	</script>
	<?php } ?>
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