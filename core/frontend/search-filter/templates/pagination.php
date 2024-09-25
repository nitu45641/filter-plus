<?php

   defined( 'ABSPATH' ) || die();

   $prev = $page - 1;
   $next = $page + 1;
?>
<ul class="pagination">
   <?php
      if( $totalPages <= 7 ){
          for($i = 1; $i <= $totalPages; $i++ ){ ?>
            <li class="page-item <?php if($page == $i) {echo 'active'; } ?>" data-page="<?php echo intval($i); ?>">
                <?php echo intval($i); ?>
            </li>
        <?php } ?>
   <?php }else{ ?> 
         <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>"
         data-page="<?php if($page <= 1){ echo '#'; } else { echo "?page=" . esc_attr($page - 1); } ?>">
            <?php esc_html_e( 'Previous','filter-plus'); ?>
         </li>
         <?php for($i = $page; $i <= $page + 3; $i++ ): ?>
         <?php if($page < $totalPages - $i){ ?>
                  <li class="page-item <?php if($page == $i) {echo 'active'; } ?>" data-page="<?php echo intval($i); ?>">
                     <?php echo intval($i); ?>
                  </li>
            <?php } ?>
         <?php endfor; ?>
         <span>....</span>
         <?php for($i = 0; $i <= 3; $i++ ): ?>
         <?php if($totalPages > $page - 4 -  $i){ ?>
            <li class="page-item <?php if($page == $totalPages - (4 - $i)) {echo 'active'; } ?>"
            data-page="<?php echo intval($totalPages - (4 - $i)); ?>">
            <?php echo intval($totalPages - (4 - $i)); ?>
            </li>
         <?php } ?>
         <?php endfor; ?>

         <?php if($totalPages !== $page + 1 ) : ?>
         <li class="page-item <?php if($page >= $totalPages) { echo 'disabled'; } ?>"
         data-page="<?php if($page >= $totalPages){ echo '#'; } else {echo esc_html($next); } ?>">
            <?php esc_html_e('Next','filter-plus'); ?>
         </li>
         <?php endif; ?>
   <?php } ?>
</ul>