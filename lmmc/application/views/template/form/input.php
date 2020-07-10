<?php 
$attr = '';
foreach ($attribute as $key => $value) {
	$attr .= "$key = \"$value\" ";
}
?>

<?php $addon = explode('|', $addon) ?>
<?php $input = '<input '. $attr .' type="'. $type .'" name="'. $field .'" class="form-control '.$rounded.'" value="'. @$value .'" placeholder="'. $placeholder .'">' ?>
<?php if ($inputType == 'textbox' && $layout == 'horizontal'): ?>
<!-- TEXTBOX -->
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $label ?><?php echo $required ?></label>
		<div class="col-sm-9">
				<?php if (@current($addon) != NULL): ?>
					<div class="input-group">
						<?php if (@end($addon) == 'depan'): ?>
							<span class="input-group-addon"><?php echo @($addon[0]) ?></span>
							<?php echo $input ?>
						<?php elseif(@end($addon) == 'belakang'): ?>
							<?php echo $input ?>
							<span class="input-group-addon"><?php echo @($addon[0]) ?></span>
						<?php endif ?>
					</div>
				<?php else: ?>
					<?php echo $input ?>
				<?php endif ?>
			<span class="help-block m-b-none cleanError <?php echo $field ?>"></span>
		</div>
	</div>
<?php elseif ($inputType == 'textbox' && $layout == 'vertical'): ?>
	<div class="form-group">
		<label class="control-label"><?php echo $label ?><?php echo $required ?></label>
			<?php if (@current($addon) != NULL): ?>
				<div class="input-group">
					<?php if (@end($addon) == 'depan'): ?>
						<span class="input-group-addon"><?php echo @($addon[0]) ?></span>
						<?php echo $input ?>
					<?php elseif(@end($addon) == 'belakang'): ?>
						<?php echo $input ?>
						<span class="input-group-addon"><?php echo @($addon[0]) ?></span>
					<?php endif ?>
				</div>
			<?php else: ?>
				<?php echo $input ?>
			<?php endif ?>
		<div>
			<span class="help-block m-b-none cleanError <?php echo $field ?>"></span>
		</div>
	</div>
<?php endif ?>

<?php if ($inputType == 'textarea' && $layout == 'horizontal'): ?>
<!-- TEXTAREA -->
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $label ?><?php echo $required ?></label>
		<div class="col-sm-9">
			<textarea <?php echo $attr ?> name="<?php echo $field ?>" class="form-control" rows="6" data-minwords="6" data-required="true" style="resize: vertical;" placeholder="<?php echo $placeholder ?>"><?php echo @$value ?></textarea>
			<span class="help-block m-b-none cleanError <?php echo $field ?>"></span>
		</div>
	</div>
<?php elseif ($inputType == 'textarea' && $layout == 'vertical'): ?>
	<div class="form-group">
		<label class="control-label"><?php echo $label ?><?php echo $required ?></label>
		<textarea <?php echo $attr ?> name="<?php echo $field ?>" class="form-control" rows="6" data-minwords="6" data-required="true" style="resize: vertical;" placeholder="<?php echo $placeholder ?>"><?php echo @$value ?></textarea>
		<div>
			<span class="help-block m-b-none cleanError <?php echo $field ?>"></span>
		</div>
	</div>
<?php endif ?>

<?php if ($inputType == 'checkbox'){ 
	$text = '';

	foreach ($data as $key => $value) {
		$text .= '<div class="'.$type.' i-checks"> <label> <input '.$attr.' type="'.$type.'" name="'.$field.'" value="'.$key.'"> <i></i> '.$value.' </label> 
		</div>';
	}
} ?>

<?php if ($inputType == 'checkbox' && $layout == 'horizontal'): ?>
<!-- CHECKBOX -->
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $label ?><?php echo $required ?></label>
		<div class="col-sm-9">
			<?php echo $text ?>
			<span class="help-block m-b-none cleanError <?php echo $field ?>"></span>
		</div>
	</div>
<?php elseif ($inputType == 'checkbox' && $layout == 'vertical'): ?>
	<div class="form-group">
		<label class="control-label"><?php echo $label ?><?php echo $required ?></label>
		<div>
			<?php echo $text ?>
			<span class="help-block m-b-none cleanError <?php echo $field ?>"></span>
		</div>
	</div>
<?php endif ?>

<?php if ($inputType == 'dropdown' && $layout == 'horizontal'): ?>
<!-- DROPDAOWN -->
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $label ?><?php echo $required ?></label>
		<div class="col-sm-9">
			<?php echo form_dropdown($field, $data, '', array('class' => 'form-control', 'style' => 'width:100%')); ?>
			<span class="help-block m-b-none cleanError <?php echo $field ?>"></span>
		</div>
	</div>
<?php elseif ($inputType == 'dropdown' && $layout == 'vertical'): ?>
	<div class="form-group">
		<label class="control-label"><?php echo $label ?><?php echo $required ?></label>
		<div>
			<?php echo form_dropdown($field, $data, '', array('class' => 'form-control', 'style' => 'width:100%')); ?>
			<span class="help-block m-b-none cleanError <?php echo $field ?>"></span>
		</div>
	</div>
<?php endif ?>