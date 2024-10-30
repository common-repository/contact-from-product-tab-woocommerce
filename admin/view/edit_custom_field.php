<?php
$cfptwc_field = get_option('cfptwc_custom_fields');
$previous_field = $cfptwc_field[$field_name];
?>

<table class="widefat striped ">
    <tbody>

    <tr>

        <td><?php _e('Field Type', 'contact-from-product-tab-woocommerce') ?></td>
        <td>
            <select id="cfptwc_field_type" name="cfptwc_custom_fields[field_type]">
                <option value="text" <?php echo $previous_field['field_type'] == 'text'? 'selected':''; ?> >Text</option>
                <option value="textarea" <?php echo $previous_field['field_type'] == 'textarea'? 'selected':''; ?> >Textarea</option>
                <option value="select" <?php echo $previous_field['field_type'] == 'select'? 'selected':''; ?> >Select</option>
                <option value="checkbox" <?php echo $previous_field['field_type'] == 'checkbox'? 'selected':''; ?> >Checkbox</option>
                <option value="radio" <?php echo $previous_field['field_type'] == 'radio'? 'selected':''; ?> >Radio</option>
            </select>
        </td>
    </tr>

    <tr>
        <td class="row-actions visible">
            <?php _e('Field Title', 'contact-from-product-tab-woocommerce') ?> <span class="delete"><a>*</a></span>
        </td>
        <td>
            <input type="text" name="cfptwc_custom_fields[field_title]" id="cfptwc_field_title" class="form-control" placeholder="<?php _e('Field Title', 'contact-from-product-tab-woocommerce') ?>" value="<?php echo $previous_field['field_title']; ?>" />
        </td>
    </tr>


    <tr>
        <td class="row-actions visible">
            <?php _e('Field Name', 'contact-from-product-tab-woocommerce') ?>  <span class="delete"><a>*</a></span>
        </td>
        <td>
            <input type="text" name="cfptwc_custom_fields[field_name]" id="cfptwc_field_name" class="form-control" placeholder="<?php _e('Field Name', 'contact-from-product-tab-woocommerce') ?>" value="<?php echo $previous_field['field_name']; ?>" />
            <p class="help-block">
                <?php _e('Field name without any space and special character', 'contact-from-product-tab-woocommerce'); ?>
            </p>
        </td>
    </tr>

    <tr>
        <td><?php _e('Value', 'contact-from-product-tab-woocommerce') ?></td>
        <td>
            <textarea name="cfptwc_custom_fields[field_value]" id="cfptwc_field_value"><?php echo $previous_field['field_value']; ?></textarea>
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
                <input type="radio" name="cfptwc_custom_fields[field_required]" id="cfptwc_field_required1" value="1"  <?php echo $previous_field['field_required'] == '1' ? 'checked="checked"' : ''; ?> > <?php _e('Yes', 'contact-from-product-tab-woocommerce') ?>
            </label>
            <label class="radio-inline" for="cfptwc_field_required0">
                <input type="radio" name="cfptwc_custom_fields[field_required]" id="cfptwc_field_required0" value="0"  <?php echo $previous_field['field_required'] == '0' ? 'checked="checked"' : ''; ?> > <?php _e('No', 'contact-from-product-tab-woocommerce') ?>
            </label>
        </td>
    </tr>

    </tbody>
</table>