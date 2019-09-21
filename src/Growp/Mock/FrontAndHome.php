<?php

namespace Growp\Mock;

use Growp\Mock\BaseMock;

/**
 * トップページとブログのトップページを自動作成する
 */
class FrontAndHome extends BaseMock {

	public function __construct() {
		parent::__construct( "frontandhome-mock" );
	}

	protected function run() {
		$this->insert_post( array(
			'post_title'   => "トップページ",
			'post_type'    => 'page',
			'post_content' => "",
			'post_name'    => "top",
			'post_status'  => "publish",
		) );

		$this->insert_post( array(
			'post_title'   => "お知らせ",
			'post_type'    => 'page',
			'post_content' => "",
			'post_name'    => "news",
			'post_status'  => "publish",
		) );

		$top_id  = $this->get_insert_id( 'top' );
		$home_id = $this->get_insert_id( 'home' );

		update_option( 'page_on_front', $top_id );
		update_option( 'page_for_posts', $home_id );
		update_option( 'show_on_front', "page" );
	}
}
