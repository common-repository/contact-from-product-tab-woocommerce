<div class="wrap">

    <?php include 'themeqx_promotions.php';
    $option = maybe_unserialize(get_option('themeqx_cfptwc_option'));


    ?>

    <form method="post" id="cfptwc_settings_form" action="" enctype="multipart/form-data">


        <div id="cfptwc-tabs">
            <ul class="nav-tab-wrapper">
                <li><a href="#tabs-1" class="nav-tab"><?php _e('General settings', 'contact-from-product-tab-woocommerce'); ?></a></li>
                <li><a href="#tabs-2" class="nav-tab"><?php _e('Email', 'contact-from-product-tab-woocommerce'); ?></a></li>
                <li><a href="#tabs-3" class="nav-tab"><?php _e('Custom fields', 'contact-from-product-tab-woocommerce'); ?></a></li>
            </ul>
            <div id="tabs-1">

                <div class="postbox">
                    <h3 class="hndle"><i class="dashicons-before dashicons-editor-alignleft"></i> <?php _e('General settings', 'contact-from-product-tab-woocommerce'); ?></h3>
                    <div class="inside">

                        <table class="widefat striped ">
                            <tbody>

                            <tr>
                                <td> <?php _e('Receiving email address', 'contact-from-product-tab-woocommerce'); ?></td>
                                <td>
                                    <input type="text" value="<?php echo get_cfptwc_option('receiving_email_address')? get_cfptwc_option('receiving_email_address') : get_option('admin_email'); ?>" size="30" name="themeqx_cfptwc_settings[receiving_email_address]">
                                </td>
                            </tr>

                            <tr>
                                <td> <?php _e('Form submited message', 'contact-from-product-tab-woocommerce'); ?></td>
                                <td>
                                    <input type="text" value="<?php echo get_cfptwc_option('form_submit_msg') ?>" size="30" name="themeqx_cfptwc_settings[form_submit_msg]">
                                </td>
                            </tr>

                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
            <div id="tabs-2">

                <table class="widefat striped ">
                    <tbody>
                    <tr>
                        <td> <p><?php _e('Enable email notification to admin', 'contact-from-product-tab-woocommerce'); ?></p></td>
                        <td>
                            <label>
                                <input type="radio" name="themeqx_cfptwc_settings[enable_email_notification_to_admin]" value="1" <?php echo (get_cfptwc_option('enable_email_notification_to_admin') == 1)? 'checked':'' ?> />
                                <?php _e('Yes', 'contact-from-product-tab-woocommerce'); ?>
                            </label>
                            <label>
                                <input type="radio" name="themeqx_cfptwc_settings[enable_email_notification_to_admin]" value="0" <?php echo (get_cfptwc_option('enable_email_notification_to_admin') == '0')? 'checked':'' ?> />
                                <?php _e('No', 'contact-from-product-tab-woocommerce'); ?>
                            </label>

                            <p class="howto"><?php _e('Admin will get an email notification if someone contact with product tab contact form', 'contact-from-product-tab-woocommerce'); ?></p>
                        </td>
                    </tr>

                    <tr>
                        <td> <?php _e('Admin email notification subject', 'contact-from-product-tab-woocommerce'); ?></td>
                        <td>
                            <input type="text" value="<?php echo get_cfptwc_option('admin_email_notification_subject'); ?>" size="30" name="themeqx_cfptwc_settings[admin_email_notification_subject]" />
                        </td>
                    </tr>


                    <tr>
                        <td> <p><?php _e('Admin email notification template', 'contact-from-product-tab-woocommerce'); ?></p></td>
                        <td>
                            <p><?php _e('Template variable you can use', 'contact-from-product-tab-woocommerce'); ?><br />
                                <code>{sender_name}, {message}, {product_name}, {subject}</code>
                            </p>
                            <textarea name="themeqx_cfptwc_settings[admin_email_notification_template]" cols="50" rows="8"><?php echo get_cfptwc_option('admin_email_notification_template'); ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td> <p><?php _e('Enable email notification to user', 'contact-from-product-tab-woocommerce'); ?></p></td>
                        <td>
                            <label>
                                <input type="radio" name="themeqx_cfptwc_settings[send_email_to_user_after_contact]" value="1" <?php echo (get_cfptwc_option('send_email_to_user_after_contact') == 1)? 'checked':'' ?> />
                                <?php _e('Yes', 'contact-from-product-tab-woocommerce'); ?>
                            </label>
                            <label>
                                <input type="radio" name="themeqx_cfptwc_settings[send_email_to_user_after_contact]" value="0" <?php echo (get_cfptwc_option('send_email_to_user_after_contact') == 0)? 'checked':'' ?> />
                                <?php _e('No', 'contact-from-product-tab-woocommerce'); ?>
                            </label>

                            <p class="howto"><?php _e('Form submitted user will get an email if you enable', 'contact-from-product-tab-woocommerce'); ?></p>
                        </td>
                    </tr>

                    <tr>
                        <td> <?php _e('Sender email subject', 'contact-from-product-tab-woocommerce'); ?></td>
                        <td>
                            <input type="text" value="<?php echo get_cfptwc_option('sender_email_subject'); ?>" size="30" name="themeqx_cfptwc_settings[sender_email_subject]" />
                        </td>
                    </tr>


                    <tr>
                        <td> <p><?php _e('Send email to user template', 'contact-from-product-tab-woocommerce'); ?></p></td>
                        <td>

                            <p><?php _e('Template variable you can use', 'contact-from-product-tab-woocommerce'); ?><br />
                                <code>{sender_name}, {message}, {product_name}, {subject}</code>
                            </p>

                            <textarea name="themeqx_cfptwc_settings[email_content_after_contact]" cols="50" rows="8"><?php echo get_cfptwc_option('email_content_after_contact'); ?></textarea>
                        </td>
                    </tr>
                    




                    </tbody>
                </table>



            </div>





            <div id="tabs-3">


                <div id="cfptwc_custom_field_input_area">
                    <table class="widefat striped ">
                        <tbody>

                        <tr>

                            <td><?php _e('Field Type', 'contact-from-product-tab-woocommerce') ?></td>
                            <td>
                                <select id="cfptwc_field_type" name="cfptwc_custom_fields[field_type]">
                                    <option value="text">Text</option>
                                    <option value="textarea">Textarea</option>
                                    <option value="select">Select</option>
                                    <option value="checkbox">Checkbox</option>
                                    <option value="radio">Radio</option>
                                </select>
                            </td>
                        </tr>



                        <tr>
                            <td class="row-actions visible">
                                <?php _e('Field Title', 'contact-from-product-tab-woocommerce') ?> <span class="delete"><a>*</a></span>
                            </td>
                            <td>
                                <input type="text" name="cfptwc_custom_fields[field_title]" id="cfptwc_field_title" class="form-control" placeholder="<?php _e('Field Title', 'contact-from-product-tab-woocommerce') ?>" />
                            </td>
                        </tr>


                        <tr>
                            <td class="row-actions visible">
                                <?php _e('Field Name', 'contact-from-product-tab-woocommerce') ?>  <span class="delete"><a>*</a></span>
                            </td>
                            <td>
                                <input type="text" name="cfptwc_custom_fields[field_name]" id="cfptwc_field_name" class="form-control" placeholder="<?php _e('Field Name', 'contact-from-product-tab-woocommerce') ?>" />
                                <p class="help-block">
                                    <?php _e('Field name without any space and special character', 'contact-from-product-tab-woocommerce'); ?>
                                </p>
                            </td>
                        </tr>

                        <tr>
                            <td><?php _e('Value', 'contact-from-product-tab-woocommerce') ?></td>
                            <td>
                                <textarea name="cfptwc_custom_fields[field_value]" id="cfptwc_field_value"></textarea>
                                <p class="help-block">
                                    <?php _e('If you using select/radio button/checkbox, then enter each option value by separating comma', 'contact-from-product-tab-woocommerce'); ?> <br /><br />
                                    <?php _e('Example: Option1,Option2,Option3', 'contact-from-product-tab-woocommerce'); ?> <br />
                                </p>
                            </td>
                        </tr>

                        <tr>
                            <td><?php _e('Required', 'contact-from-product-tab-woocommerce') ?></td>
                            <td>
                                <label class="radio-inline" for="cfptwc_field_required1">
                                    <input type="radio" name="cfptwc_custom_fields[field_required]" id="cfptwc_field_required1" value="1" checked="checked"> <?php _e('Yes', 'contact-from-product-tab-woocommerce') ?>
                                </label>
                                <label class="radio-inline" for="cfptwc_field_required0">
                                    <input type="radio" name="cfptwc_custom_fields[field_required]" id="cfptwc_field_required0" value="0" > <?php _e('No', 'contact-from-product-tab-woocommerce') ?>
                                </label>
                            </td>
                        </tr>

                        </tbody>
                    </table>

                </div>

                <?php
                $cfptwc_custom_fields = get_option('cfptwc_custom_fields');
                if ($cfptwc_custom_fields && is_array($cfptwc_custom_fields)){
                    echo "<h3>".__('Custom Fields', 'contact-from-product-tab-woocommerce')."</h3>";
                    echo '<table class="widefat striped ">';

                    echo '<tr><th>'.__('Field Type', 'contact-from-product-tab-woocommerce').'</th><th>'.__('Field Title', 'contact-from-product-tab-woocommerce').'</th><th>'.__('Field Name', 'contact-from-product-tab-woocommerce').'</th><th>'.__('Value', 'contact-from-product-tab-woocommerce').'</th><th>'.__('Required', 'contact-from-product-tab-woocommerce').'</th> <th>#</th></tr>';

                    foreach ($cfptwc_custom_fields as $key => $value){
                        echo "<tr>";
                        echo "<td>{$value['field_type']}</td> <td>{$value['field_title']}</td>";
                        echo "<td>{$value['field_name']}</td> <td>{$value['field_value']}</td>";
                        echo "<td>"; echo ($value['field_required']) ? 'Yes' : 'No';  echo "</td>";

                        echo "<td>
<a href='javascript:;' class='button button-primary cfptwc_custom_field_edit_btn' data-field-name='{$key}'><i class='dashicons dashicons-edit'></i></a> 
<a href='javascript:;' class='button cfptwc_custom_field_delete_btn' data-field-name='{$key}'><i class='dashicons dashicons-trash'></i></a> </td>";
                        echo "</tr>";
                    }
                    echo '</table>';
                }

                ?>


            </div>


        </div>

        <h3>&nbsp;</h3>
        <button type="submit" value="save" class="button button-primary button-large" name="cfptwc_settings_save_btn"><?php _e('Save', 'contact-from-product-tab-woocommerce'); ?></button>

    </form>

</div>


