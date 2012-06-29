<?php
echo validation_errors();
echo form_open(site_url('vendor/add_item'));

$name = array(
              'name'        => 'name',
              'id'          => 'name',
              'value'       => '',
              'maxlength'   => '100',
              'size'        => '50'
            );
echo form_label('Name:','name');
echo form_input($name);

$initPrice = array(
              'name'        => 'initPrice',
              'id'          => 'initPrice',
              'value'       => '',
              'maxlength'   => '100',
              'size'        => '50'
            );
echo form_label('Initial Price:','initPrice');
echo form_input($initPrice);

$basePrice = array(
              'name'        => 'basePrice',
              'id'          => 'basePrice',
              'value'       => '',
              'maxlength'   => '100',
              'size'        => '50'
            );
echo form_label('Base Price:','basePrice');
echo form_input($basePrice);

$quantity = array(
              'name'        => 'quantity',
              'id'          => 'quantity',
              'value'       => '',
              'maxlength'   => '100',
              'size'        => '50'
            );
echo form_label('Total Quantity:','quantity');
echo form_input($quantity);

echo form_reset('reset','Reset');
echo form_submit('submit','Submit');
echo form_close();
?>