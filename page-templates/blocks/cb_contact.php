<section class="contact py-5">
    <div class="container-xl">
        <div class="row">
            <div class="col-md-6">
                <ul class="fa-ul">
                    <li class="mb-4"><span class="fa-li"><i class="fa-solid fa-map-marker-alt"></i></span>
                        <?=get_field('office_address_1','options')?></li>
                    <li class="mb-4"><span class="fa-li"><i class="fa-solid fa-map-marker-alt"></i></span>
                        <?=get_field('office_address_2','options')?></li>
                    <li class="mb-4"><span class="fa-li"><i class="fa-solid fa-phone"></i></span>
                        <a href="tel:<?=get_field('contact_phone','options')?>"><?=get_field('contact_phone','options')?></a></li>
                    <li><span class="fa-li"><i class="fa-solid fa-envelope"></i></span>
                        <a href="mailto:<?=get_field('contact_email','options')?>"><?=get_field('contact_email','options')?></a></li>
                </ul>
            </div>
            <div class="col-md-6">
                <?php echo do_shortcode('[gravityform id="1" title="false"]'); ?>
            </div>
        </div>
    </div>
</section>