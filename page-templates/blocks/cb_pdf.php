<?php
$attachment_id = get_field('file');
$pdf_thumbnail = wp_get_attachment_image_src($attachment_id, 'medium', true);
$file_path = get_attached_file($attachment_id);
$file_size = filesize($file_path);
$file_url = wp_get_attachment_url($attachment_id);

?>
<section class="pdf_thumbnail">
    <div class="container-xl">
        <a class="pdf_thumbnail__card" href="<?=$file_url?>" target="_blank">
            <?php
            if ($pdf_thumbnail) {
                echo '<img src="' . esc_url($pdf_thumbnail[0]) . '" alt="PDF Thumbnail">';
            }
            if (get_field('caption')) {
                ?>
            <div class="pdf_thumbnail__caption"><?=get_field('caption')?></div>
                <?php
            }
            ?>
            <div class="pdf_thumbnail__size"><i class="fa-solid fa-file-pdf"></i> <span>Download PDF (<?=formatBytes($file_size)?>)</span></div>
        </a>
    </div>
</section>