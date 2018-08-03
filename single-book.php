<?php get_header();?>


      <!-- Content Area -->
      <div class="content-area single-page mt-5 mb-5">
        <div class="container">
          <div class="row">
			<?php while ( have_posts() ) : the_post(); ?>
            <div class="col-md-5 mb-4">
              <?php the_post_thumbnail('full', array('class'=>'img-fluid')); ?>
            </div>
            <div class="col-md-7">
              <div class="book-details">
                <h2><?php the_title();?></h2>
				<?php
					$book_sub_title = get_post_meta( get_the_ID(), 'book_sub_title', true );
					$book_author = get_post_meta( get_the_ID(), 'book_author', true );
				?>
                <h3 class="sub-title"><?php echo $book_sub_title; ?></h3>
                <h4 class="author"><?php echo $book_author; ?></h4>
                <div class="content">
					<?php  the_content();?>
				</div>
              </div><!-- /.book-details -->
            </div>
			<?php endwhile; ?>
          </div><!-- /.row -->
        </div><!-- /.container -->
      </div><!-- /.content-area -->


<?php get_footer(); ?>