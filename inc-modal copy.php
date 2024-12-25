<!-- /martina/wp-content/plugins/modal-scroll-img/inc-modal.php
最初は単体でテストする URLも直に開くためのもの -->

    
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<?php 
// ホームページの場合は処理しない
if ( !is_home() && !is_front_page() ) {
    // 現在のページのカテゴリを取得
    $cat = get_the_category(); 
    
    // カテゴリーが存在し、配列の0番目に値がある場合のみ処理を実行
    if ( !empty($cat) && isset($cat[0]) && isset($cat[0]->cat_ID) ) {
        $cat_id = $cat[0]->cat_ID; // 取得したカテゴリーのIDを取り出す
        
        // 指定したカテゴリの場合
        if ( !empty($scroll_data['cat_ID']) && in_array( $cat_id, $scroll_data['cat_ID'] ) ) {
?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal Ads : minke2410/test</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <a href="<?= esc_url( $scroll_data["url"] ) ?>">
          <img src="<?= esc_url( $scroll_data["image_path"] ) ?>" alt="">
        </a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<?php 
        } // in_arrayチェックの終了
    } // カテゴリー存在チェックの終了
} // ホームページチェックの終了
?>
  

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" ></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
  // ↑ jQueryの読み込みを待ってから実行
      var myModal = new bootstrap.Modal(
        document.getElementById('exampleModal')
      );

    // モーダルを表示 v5
    // myModal.show();


    jQuery(function ($) {
      // ↑ この中なら $ が使える
      let notYet = true ;  // もう出た､出てないの変数｡ 初回は映る
      // ロード時
      modalShow();


      // スクロール時イベント発火
      $(window).on("scroll", function() {
        let y = $(window).scrollTop();
        console.log( y );
        modalShow();
      });


      // ロード時とスクロール時にこの関数を呼び出す
      function modalShow(){
        let y = $(window).scrollTop();
        let top = '<?= $scroll_data["top"] ?>' ; // int 700

        console.log( y );
        if(y >= top && notYet ){
          //modalをコードで出す ver4で
          myModal.show(); 
          notYet = false; // グローバルをfalseを代入
        }
      }


    });
  })

</script>