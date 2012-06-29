<h1>Create deal for <?php echo $item->name; ?></h1>
<?php
echo validation_errors();
echo form_open(site_url('vendor/create/deal/'.$item->itemId));

$item = array(
              'name'        => 'item',
              'id'          => 'item',
              'value'       => $item->itemId
            );
form_hidden($item);

$startDate = array(
              'name'        => 'startDate',
              'id'          => 'startDate',
              'class'          => 'span2 datepicker',
              'value'       => '2012/2/12',
              'maxlength'   => '100',
              // 'size'        => '50',
              'data-date'   =>'2012-2-12',
              'data-date-format' => 'yyyy/mm/dd'
            );
echo form_label('Start Date:','startDate');
echo form_input($startDate);

$endDate = array(
              'name'        => 'endDate',
              'id'          => 'endDate',
              'value'       => '',
              'maxlength'   => '100',
              'size'        => '50',
              'class'          => 'span2 datepicker',
              'value'       => '2012/2/12',
              'data-date'   =>'2012-2-12',
              'data-date-format' => 'yyyy/mm/dd'
            );
echo form_label('End Date:','endDate');
echo form_input($endDate);


echo form_reset('reset','Reset');
echo form_submit('submit','Submit');
echo form_close();
?>
