<form class="cfptwc-contact-form" id="cfptwc-contact-form" method="post" action="<?php the_permalink(); ?>">

    <div id="cfptwc-status-msg"></div>


    <p class="cfptwc-notes">
        <span id="email-notes"><?php _e('Your email address will not be published', 'contact-from-product-tab-woocommerce'); ?>.</span>
        <?php _e('Required fields are marked', 'contact-from-product-tab-woocommerce'); ?> <span class="required">*</span>
    </p>

    <?php
    if ( ! is_user_logged_in()){
        ?>


        <p class="cfptwc-form-author">
            <label for="author_name"><?php _e('Name', 'contact-from-product-tab-woocommerce'); ?> <span class="required">*</span></label>
            <input type="text" required="" aria-required="true" size="30" value="" name="author_name" id="author_name">
        </p>

        <p class="cfptwc-form-email">
            <label for="email"><?php _e('Email', 'contact-from-product-tab-woocommerce'); ?> <span class="required">*</span></label>
            <input type="email" required="" aria-required="true" size="30" value="" name="email" id="email">
        </p>
        <?php
    }
    ?>

    <p class="cfptwc-form-subject">
        <label for="author"><?php _e('Subject', 'contact-from-product-tab-woocommerce'); ?> <span class="required">*</span></label>
        <input type="text" required="" aria-required="true" size="30" value="" name="subject" id="subject">
    </p>


    <?php

    $cfptwc_custom_fields = get_option('cfptwc_custom_fields');

    if ($cfptwc_custom_fields && is_array($cfptwc_custom_fields)){
        foreach ($cfptwc_custom_fields as $wtcf_key => $wtcf_value){

            switch ($wtcf_value['field_type']){
                case 'text':
                    ?>
                    <p class="cfptwc-form-<?php echo $wtcf_value['field_name']; ?>">
                        <label for="<?php echo $wtcf_value['field_name']; ?>">
                            <?php echo $wtcf_value['field_title']; ?>
                            <?php echo $wtcf_value['field_required'] == '1'? '<span class="required">*</span> ':''; ?>
                        </label>
                        <input type="text" <?php echo $wtcf_value['field_required'] == '1'? ' required="" aria-required="true" ':''; ?>  size="30" value="" name="<?php echo $wtcf_value['field_name']; ?>" id="<?php echo $wtcf_value['field_name']; ?>">
                    </p>

                    <?php
                    break;
                case 'textarea':
                    ?>

                    <p class="cfptwc-form-<?php echo $wtcf_value['field_name']; ?>">
                        <label for="<?php echo $wtcf_value['field_name']; ?>">
                            <?php echo $wtcf_value['field_title']; ?>
                            <?php echo $wtcf_value['field_required'] == '1'? '<span class="required">*</span> ':''; ?>
                        </label>
                        <textarea  <?php echo $wtcf_value['field_required'] == '1'? ' required="" aria-required="true" ':''; ?>  rows="4" cols="45"  name="<?php echo $wtcf_value['field_name']; ?>" id="<?php echo $wtcf_value['field_name']; ?>"></textarea>
                    </p>

                    <?php
                    break;
                case 'select':
                    ?>

                    <p class="cfptwc-form-<?php echo $wtcf_value['field_name']; ?>">
                        <label for="<?php echo $wtcf_value['field_name']; ?>">
                            <?php echo $wtcf_value['field_title']; ?>
                            <?php echo $wtcf_value['field_required'] == '1'? '<span class="required">*</span> ':''; ?>
                        </label>

                        <select <?php echo $wtcf_value['field_required'] == '1'? ' required="" aria-required="true" ':''; ?>  name="<?php echo $wtcf_value['field_name']; ?>" id="<?php echo $wtcf_value['field_name']; ?>" >
                            <option value=""> <?php _e('Select option', 'contact-from-product-tab-woocommerce'); ?> </option>
                            <?php
                            if ( ! empty($wtcf_value['field_value'])){
                                $options = explode(',', $wtcf_value['field_value']);

                                foreach ($options as $option){
                                    echo "<option value='{$option}'> {$option} </option>";
                                }
                            }
                            ?>
                        </select>
                    </p>

                    <?php
                    break;
                case 'checkbox':
                    ?>

                    <p class="cfptwc-form-<?php echo $wtcf_value['field_name']; ?>">
                        <label for="<?php echo $wtcf_value['field_name']; ?>">
                            <?php echo $wtcf_value['field_title']; ?>
                            <?php echo $wtcf_value['field_required'] == '1'? '<span class="required">*</span> ':''; ?>
                        </label>

                            <?php
                            if ( ! empty($wtcf_value['field_value'])){
                                $options = explode(',', $wtcf_value['field_value']);
                                $i = 0;
                                foreach ($options as $option){
                                    $i++;
                                    ?>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" value="<?php echo $option; ?>" name="<?php echo $wtcf_value['field_name']; ?>[]" id="<?php echo $wtcf_value['field_name']; ?>"> <?php echo $option; ?></label>
                                    <?php
                                }
                            }
                            ?>
                    </p>

                    <?php
                    break;
                case 'radio':
                    ?>

                    <p class="cfptwc-form-<?php echo $wtcf_value['field_name']; ?>">
                        <label for="<?php echo $wtcf_value['field_name']; ?>">
                            <?php echo $wtcf_value['field_title']; ?>
                            <?php echo $wtcf_value['field_required'] == '1'? '<span class="required">*</span> ':''; ?>
                        </label>

                        <?php
                        if ( ! empty($wtcf_value['field_value'])){
                            $options = explode(',', $wtcf_value['field_value']);
                            $i = 0;
                            foreach ($options as $option){
                                $i++;
                                ?>
                                <label class="radio-inline">
                                    <input type="radio" <?php echo $wtcf_value['field_required'] == '1'? ' required="" aria-required="true" ':''; ?>  value="<?php echo $option; ?>" name="<?php echo $wtcf_value['field_name']; ?>" id="<?php echo $wtcf_value['field_name']; ?>"> <?php echo $option; ?></label>
                                <?php
                            }
                        }
                        ?>
                    </p>
                    <?php
                    break;
            }

        }
    }
    ?>




    <p class="comment-form-comment">
        <label for="message"><?php _e('Message', 'contact-from-product-tab-woocommerce'); ?><span class="required">*</span></label>
        <textarea required="" aria-required="true" rows="4" cols="45" name="message" id="message"></textarea>
    </p>

    <p class="form-submit">
        <input type="submit" value="<?php _e('Submit', 'contact-from-product-tab-woocommerce'); ?>" class="submit" id="cfptwc_submit" name="cfptwc_submit">
        <input type="hidden" id="cfptwc_product_id" value="<?php the_ID(); ?>" name="cfptwc_product_id">

    <span class="cfptwc-loading" style="display: none;">
        <img src="<?php echo CFPTWC_URL.'assets/img/loading.gif' ?>" />
    </span>

    </p>
</form>