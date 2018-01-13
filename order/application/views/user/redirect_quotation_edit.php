
<?php echo form_open('user_controller/quotation_edit', array('autocomplete' => 'off', 'class' => 'redirect-form')); ?>

<input type="hidden" name="quotation_id" value="<?php echo $quotation_id; ?>">
<input type="submit" value="Submit" class="hidden">

<?php echo form_close(); ?>

