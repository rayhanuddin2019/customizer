
  
  <footer class="ts-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                
                    <!-- footer social end-->

                    <?php if ( has_nav_menu( 'footermenu' ) ) : ?>
                        <div class="footer-menu text-center mb-25">
                            <?php
                                // footer Nav
                                wp_nav_menu( array(
                                    'theme_location' => 'footermenu',
                                    'depth'          => 1,
                                 
                                ) );
                            ?>
                        </div><!-- footer menu end-->
                    <?php endif; ?>
                    
                    <div class="copyright-text text-center">
                     <p>
                        &copy; 2019, ts. All rights reserved
                     </p>
                    </div>
                          
                    <div class="BackTo">
                     <a href="#" class="fa fa-angle-up" aria-hidden="true"></a>
                     </div>
            
                </div>
            </div>
        </div>
    </footer>
