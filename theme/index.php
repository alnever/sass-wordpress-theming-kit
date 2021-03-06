<?php get_header(); ?>


  <div class="swtk-container">
    <?php get_template_part('nav'); ?>
    <div class="swtk-main">
        <!-- header -->
        <header class="swtk-header" style="background-image:url( <?php header_image(); ?> );">
            <div class="swtk-header-logo">
                <?php
                    $custom_logo_id = get_theme_mod( 'custom_logo' );
                    $custom_logo_url = wp_get_attachment_image_url( $custom_logo_id , 'full' );
                    echo '<img src="' . esc_url( $custom_logo_url ) . '" alt="">';
                ?>
            </div>
            <div class="swtk-header-text-block">
                <div class="swtk-header-title" style="color: #<?php header_textcolor(); ?>">
                    <?php bloginfo('name'); ?>
                </div>
                <div class="swtk-header-text">
                    <?php bloginfo('description'); ?>
                </div>
            </div>
        </header>

        <!-- header sidebar -->
        <div class="swtk-horizontal-sidebar swtk-header-sidebar">
          <?php dynamic_sidebar('header-sidebar'); ?>
        </div>

        <!-- content -->
        <div class="swtk-content">
            <!-- left sidebar -->
            <div class="swtk-vertical-sidebar swtk-left-sidebar">
                <?php wp_nav_menu([
                        'theme_location' => 'secondary',
                        'depth' => 3,
                        'container_class' => 'vertical-menu',
                    ]);
                ?>
                <?php dynamic_sidebar('left-sidebar'); ?>
            </div>

            <!-- posts -->
            <div class="swtk-posts">
                <!-- sticky post -->
                <div class="swtk-sticky-posts">
                    <?php
                        $sticky = get_option('sticky_posts');
                        $args = [
                            'posts_per_page' => 1,
                            'post__in' => $sticky,
                            'ignore_sticky_posts' => 1,
                        ];
                        $query = new WP_Query($args);
                        while ( $query->have_posts() ): $query->the_post();
                    ?>
                        <article class="swtk-post-sticky" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <div class="swtk-post-image">
                                <?php if (has_post_thumbnail()):  ?>
                                    <img src="<?php the_post_thumbnail_url(); ?>" alt="">
                                <?php endif; ?>
                            </div>
                            <div class="swtk-post-text">
                                <!-- post header -->
                                <div class="swtk-post-title">
                                    <?php the_title(); ?>
                                </div>
                                <!-- post before main text -->
                                <div class="swtk-post-before">
                                    <div class="swtk-post-author">
                                        <?php the_author(); ?>
                                    </div>
                                    <div class="swtk-post-date">
                                        <?php the_date(); ?>
                                    </div>
                                </div>
                                <div class="swtk-post-content">
                                    <?php the_excerpt(); ?>
                                </div>
                                <div class="swtk-post-categories">
                                    <?php the_category(); ?>
                                </div>
                                <div class="swtk-post-tags">
                                    <?php the_tags(); ?>
                                </div>
                                <div class="swtk-post-link">
                                    <a href="<?php echo (get_permalink()); ?>"><?php _e('More...','sass-wordpress-theming-kit') ?></a>
                                </div>
                            </div>
                        </article>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    ?>
                </div>

                <!-- main posts loop -->
                <?php if (have_posts()): ?>
                    <div class="swtk-row">

                          <?php while(have_posts()): the_post(); ?>
                            <article class="swtk-post-index" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <div class="swtk-post-image">
                                    <?php if (has_post_thumbnail()):  ?>
                                        <img src="<?php the_post_thumbnail_url(); ?>" alt="">
                                    <?php endif; ?>
                                </div>
                                <div class="swtk-post-text">
                                    <!-- post header -->
                                    <div class="swtk-post-title">
                                        <?php the_title(); ?>
                                    </div>
                                    <!-- post before main text -->
                                    <div class="swtk-post-before">
                                        <div class="post-author">
                                            <?php the_author(); ?>
                                        </div>
                                        <div class="swtk-post-date">
                                            <?php the_date(); ?>
                                        </div>
                                    </div>
                                    <div class="swtk-post-content">
                                        <?php the_excerpt(); ?>
                                    </div>
                                    <div class="swtk-post-categories">
                                        <?php the_category(); ?>
                                    </div>
                                    <div class="swtk-post-tags">
                                        <?php the_tags(); ?>
                                    </div>
                                    <div class="swtk-post-link">
                                        <a href="<?php echo (get_permalink()); ?>"><?php _e('More...','sass-wordpress-theming-kit') ?></a>
                                    </div>
                                </div>
                            </article>
                          <?php endwhile; ?>
                    </div>
                    <div class="swtk-pagination">
                        <?php the_posts_pagination([
                                'screen_reader_text' => ''
                            ]);
                        ?>
                    </div>
                <?php endif; ?>
            </div>
            <!-- posts -->

            <!-- right sidebar -->
            <div class="swtk-vertical-sidebar swtk-right-sidebar">
                <?php dynamic_sidebar('right-sidebar'); ?>
            </div>
        </div>



  <?php get_footer(); ?>
