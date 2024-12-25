<?php
if (
    !empty($_POST['image_path']) &&
    !empty($_POST['cat_ID']) &&
    !empty($_POST['top']) &&
    !empty($_POST['url'])
) {
    // 権限チェック
    if (!current_user_can('manage_options')) {
        wp_die('この操作を実行する権限がありません');
    }

    // nonce チェック
    if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'modal_scroll_geoge_nonce')) {
        wp_die('セキュリティチェックに失敗しました');
    }

    $serialzie = serialize($_POST);
    $res = update_option('modal_scroll_geoge', $serialzie);

    if ($res) {
        echo "追加しました";
    } else {
        echo "追加できませんでした";
    }
}
?>

<h2>モーダルで出す画像を指定</h2>

<form action="" method="post">
    <?php wp_nonce_field('modal_scroll_geoge_nonce'); ?>
    <div class="container w-50">
        <div class="input-group ">
            <div class="input-group-text">/wp-content/uploads/</div>
            <input type="text" class="form-control" value="2024/12/679.jpg"
            name="image_path" required>
        </div>
        
        <div class="input-group mt-5 px-5">
            <label>カテゴリ選択(複数可)</label>
            <select class="form-select mx-5" multiple aria-label="Default select example"
            name="cat_ID[]" required>
            <?php
                $categories = get_categories();
                foreach( $categories as $category ) {
                    echo "<option value='$category->cat_ID'>$category->name</option>";
                }
            ?>
            </select>
        </div>

        <div class="input-group mt-5 px-5">
            <label>表示位置(TOPからのpx指定)</label>
            <input type="text" class="form-control mx-5" value="600" name="top"> px
        </div>

        <div class="input-group mt-5">
            <div class="input-group-text">URL</div>
            <input type="url" class="form-control" placeholder="https://abcd.efg?p=123"
            name="url">
        </div>

        <button type="submit" class="btn btn-primary mt-5">Submit</button>
    </div>
</form>
