<?php 
 /* The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage weblizar
 */
?>
<footer>
    <div class="footer">
        <div class="container">
            <div class="footer-wrapper">
                <div class="row">
				<?php 
				if(is_active_sidebar( 'footer-widget-area' ))
				{ 
					dynamic_sidebar( 'footer-widget-area' ); 
				} else 
				{ ?>
				<!-- Footer Col. -->
						<div class="col-md-3 col-sm-3 footer-col">
							<div class="footer-content">
								<div class="footer-content-logo">
									<img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/web-logo.png" alt=""/>
								</div>
								<div class="footer-content-text">
									<p>Lorem ipsum dolor sit amet nec, consectetuer adipiscing elit. Aenean commodo ligula eget
									dolor.</p>
									<p>Lorem ipsum dolor sit amet nec, consectetuer adipiscing elit. Aenean commodo ligula eget
									dolor.</p>
								</div>
							</div>
						</div>
						<!-- //Footer Col.// -->

						<!-- Footer Col. -->
						<div class="col-md-3 col-sm-3 footer-col">
							<div class="footer-title">Recent Posts </div>
							<div class="footer-content">
								<div class="footer-posts">
									<ul class="posts-list">
										<li>
											<div class="posts-list-thumbnail">
												<a href="">
													<img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/blog4-thumb.jpg" alt=""/>
												</a>
											</div>
											<div class="posts-list-content">
												<a href="" class="posts-list-title">Sidebar post example </a>
												<span class="posts-list-meta">
													July 30, 2013
												</span>
											</div>
										</li>
										<li>
											<div class="posts-list-thumbnail">
												<a href="">
													<img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/blog3-thumb.jpg" alt=""/>
												</a>
											</div>
											<div class="posts-list-content">
												<a href="" class="posts-list-title">Sidebar post example </a>
												<span class="posts-list-meta">
													July 30, 2013
												</span>
											</div>
										</li>                                       
										<li>
											<div class="posts-list-thumbnail">
												<a href="">
													<img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/blog3-thumb.jpg" alt=""/>
												</a>
											</div>
											<div class="posts-list-content">
												<a href="" class="posts-list-title">Sidebar post example </a>
												<span class="posts-list-meta">
													July 30, 2013
												</span>
											</div>
										</li>
										<li>
											<div class="posts-list-thumbnail">
												<a href="">
													<img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/blog4-thumb.jpg" alt=""/>
												</a>
											</div>
											<div class="posts-list-content">
												<a href="" class="posts-list-title">Sidebar post example </a>
												<span class="posts-list-meta">
													July 30, 2013
												</span>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<!-- //Footer Col.// -->

						<!-- Footer Col. -->
						<div class="col-md-3 col-sm-3 footer-col">
							<div class="footer-title">
								Get In Touch
							</div>
							<div class="footer-content">
								<ul class="contact-info">
									<li>
										<div class="contact-title">
											<i class="fa fa-map-marker"></i>Address
										</div>
										<div class="contact-details">38222 California, Los Angeles 22</div>
									</li>
									<li>
										<div class="contact-title">
											<i class="fa fa-phone"></i>phone
										</div>
										<div class="contact-details">123-345-6666</div>
									</li>
									<li>
										<div class="contact-title">
											<i class="fa fa-envelope"></i>eMail
										</div>
										<div class="contact-details"><a href="mailto:info@company.com">info@companyname.com</a></div>
									</li>
									<li>
										<div class="contact-title">
											<i class="fa fa-globe"></i>Website
										</div>
										<div class="contact-details"><a href="#">www.companyname.com</a></div>
									</li>
									
								</ul>
							</div>
						</div>
						<!-- //Footer Col.// -->
						
						<!-- Footer Col. -->
						<div class="col-md-3 col-sm-3 footer-col">
							<div class="footer-title">
								Photostream
							</div>
							<div class="footer-content">
								<div class="flickr_badge_wrapper">
									<div class="flickr_badge_image" id="flickr_badge_image1"><a href="#"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/blog4-thumb.jpg" alt="A photo on Flickr" title="" height="75" width="75"></a></div>
								</div>
								<div class="flickr_badge_wrapper">
									<div class="flickr_badge_image" id="flickr_badge_image2"><a href="#"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/blog3-thumb.jpg" alt="A photo on Flickr" title="" height="75" width="75"></a></div>
								</div>
								<div class="flickr_badge_wrapper">
									<div class="flickr_badge_image" id="flickr_badge_image3"><a href="#"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/blog2-thumb.jpg" alt="A photo on Flickr" title="" height="75" width="75"></a></div>
								</div>
							<!-- //Footer Col.// -->
							</div>
						</div>				
				<?php } ?>
                </div>			
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <div class="row">
				<?php $wl_theme_options = weblizar_get_options(); ?>
                    <div class="col-md-6 col-sm-6">
                        <div class="copyright-text weblizar_footer_customizations"><?php 
							if($wl_theme_options['footer_customizations']) { echo esc_html($wl_theme_options['footer_customizations']); }
							if($wl_theme_options['developed_by_text']) { echo "|" .esc_html($wl_theme_options['developed_by_text']); } ?>
							<a  rel="nofollow" href="<?php if($wl_theme_options['developed_by_link']) { echo esc_url($wl_theme_options['developed_by_link']); } ?>" target="_blank">
							<?php if($wl_theme_options['developed_by_weblizar_text']) { echo esc_html($wl_theme_options['developed_by_weblizar_text']); } ?>
							</a>
						</div>
                    </div>
                    <div class="weblizar_social_media_enbled">
					<?php if($wl_theme_options['footer_section_social_media_enbled'] == 'on') { ?>
                    <div class="col-md-6 col-sm-6"> 
						<div class="social-icons">
							<ul> 
								<?php if($wl_theme_options['social_media_facebook_link']) { ?>
								<li><a href="<?php echo esc_url($wl_theme_options['social_media_facebook_link']); ?>" title="facebook" target="_blank" class="social-media-icon facebook-icon"><?php esc_html_e('Facebook','weblizar'); ?></a></li>
								<?php } 
								if($wl_theme_options['social_media_twitter_link']) { ?>
								<li><a href="<?php echo esc_url($wl_theme_options['social_media_twitter_link']); ?>" title="twitter" target="_blank" class="social-media-icon twitter-icon"><?php esc_html_e('Twitter','weblizar'); ?></a></li>
								<?php } 
								if($wl_theme_options['social_media_google_plus']) { ?>
								<li><a href="<?php echo esc_url($wl_theme_options['social_media_google_plus']); ?>" title="googleplus" target="_blank" class="social-media-icon googleplus-icon"><?php esc_html_e('Googleplus','weblizar'); ?></a></li>
								<?php } 
								if($wl_theme_options['social_media_linkedin_link']) { ?>
								<li class="weblizar_social_media_linkedin_link"><a href="<?php echo esc_url($wl_theme_options['social_media_linkedin_link']); ?>" title="linkedin" target="_blank" class="social-media-icon linkedin-icon"><?php esc_html_e('Linkedin','weblizar'); ?></a></li>
								<?php } ?>
							</ul>
						</div>
                    </div>
					<?php } ?>
				</div>
                </div>
            </div>
        </div>	
		<?php if($wl_theme_options['custom_css']) ?>
		<style type="text/css">
			<?php { echo esc_html($wl_theme_options['custom_css']); } ?>
		</style>		
   <span id="blog_count" style="display:none;"><?php global $published_posts; echo esc_attr($wl_theme_options['blog_count']).' ,'.esc_attr($published_posts); ?></span> </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>