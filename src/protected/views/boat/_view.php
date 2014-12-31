<?php
/* @var $this BoatController */
/* @var $data Boats */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('timestamp')); ?>:</b>
	<?php echo CHtml::encode($data->timestamp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sail')); ?>:</b>
	<?php echo CHtml::encode($data->sail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('model')); ?>:</b>
	<?php echo CHtml::encode($data->model); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phrf')); ?>:</b>
	<?php echo CHtml::encode($data->phrf); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FridayNightClass')); ?>:</b>
	<?php echo CHtml::encode($data->FridayNightClass); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('rollerFurling')); ?>:</b>
	<?php echo CHtml::encode($data->rollerFurling); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('skipper')); ?>:</b>
	<?php echo CHtml::encode($data->skipper); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('length')); ?>:</b>
	<?php echo CHtml::encode($data->length); ?>
	<br />

	*/ ?>

</div>