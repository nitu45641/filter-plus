<?php

namespace FilterPlus\Core\Frontend\SearchFilter\Templates;

use FilterPlus\Utils\Singleton;

/**
 * Templates
 *
 * @since 1.0.0
 */
class Templates {

	use Singleton;

    /**
	 * Pagination
	 *
	 * @param mixed $pages
	 * @return string
	 */
	public function pagination( $args ) {
		extract( $args );
		$html = '';
		if ( ($totalPages == 0) || ($totalPages == 1) ) {
			return $html = '';
		}

		if ( $template == 'pagination' ) {

			ob_start();
			if ( file_exists(plugin_dir_path( __FILE__ ) . '/pagination.php') ) {
				include __DIR__ . '/pagination.php';
			}
			$html = ob_get_clean();
		}
		else if ( $template == 'loadmore' ) {
			$loadmore = esc_html__( 'Load More', 'filter-plus' );
			if ( $page < $totalPages ) {
				$html = '<li
				class="load-more"
				data-page=' . intval( $page + 1 ) .
				'>'
				. $loadmore . '</li>';
			}
		}

		return $html;
	}

}