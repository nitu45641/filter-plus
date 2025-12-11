<?php

   defined( 'ABSPATH' ) || die();

   $prev = $page - 1;
   $next = $page + 1;

   // Fix: Only render pagination if $totalPages is set and > 1
   if (!isset($totalPages) || $totalPages < 2) {
       return;
   }

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
         data-page="<?php if($page <= 1){ echo '0'; } else { echo intval($prev); } ?>">
            <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z"/></svg>
         </li>
         <?php for($i = $page; $i <= $page + 3; $i++ ): ?>
            <?php if( ($page < $totalPages - $i) || ( ( $totalPages - $page) == 8 ) ){ ?>
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
         data-page="<?php if($page >= $totalPages){ echo '0'; } else {echo intval($next); } ?>">
         <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
         </li>
         <?php endif; ?>
   <?php } ?>
</ul>