<?php
global $post;
?>
<?php include CFPTWC_DIR.'/admin/view/themeqx_promotions.php'; ?>
<table class="widefat striped ">

    <?php
    echo " <tr><th width='150'>".__('Subject', 'contact-from-product-tab-woocommerce')."</th><td> {$post->post_title} </td> </tr>";
    echo " <tr><th>".__('Product Name', 'contact-from-product-tab-woocommerce')."</th><td> ".get_the_title($post->post_parent)." </td> </tr>";
    $content = json_decode($post->post_content);
    if ($content){
        foreach($content as $key => $value){
            echo " <tr><th>".ucwords(str_replace('_', ' ', $key))."</th><td> {$value} </td> </tr>";
        }
    }
    echo " <tr><th>".__('Time', 'contact-from-product-tab-woocommerce')."</th><td> ".date(get_option('date_format'), strtotime($post->post_date))." ".date(get_option('time_format'), strtotime($post->post_date))." </td> </tr>";

    ?>

</table>

