<?php	
/*
  Plugin Name: modal scroll img
  Description: スクロールで画像がモーダル表示
*/


/* 管理画面にオリジナルメニューを追加する */
add_action( 'admin_menu', 

function (){
  add_menu_page( 
    'モーダル画像', 
    'モーダル画像',
    'manage_options', 
    'custompage', 
    'my_custom_menu_page', //←この名前の関数呼び出し
    plugins_url('/img/icon-modal.png', __FILE__),
    80
  ); 
  }
);


function my_custom_menu_page(){
  require_once 'admin-setting.php';
}



//記事本文をカスタマイズする用のフィルターフック「the_content」は、引数として記事本文のHTMLを引数として受け取ることができます。
add_filter( 'the_content', 
  function ( $content ) : string{
    // wp-option から指定したキーで値を取得する関数
    $scroll_data = unserialize(get_option('modal_scroll_geoge'));
    echo '<!-- DEBUG';
    var_dump($scroll_data);
    echo '-->';
    
    include_once "inc-modal.php";
    return $content  ;
  }
  // ボタンクリックではなく、スクロールでモーダルを出さなくてはならない。やりかたを調べましょう
);
