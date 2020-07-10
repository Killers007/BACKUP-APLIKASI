<script src="<?php echo base_url('assets/mecha/js/jquery.js') ?>"></script>

<script src="<?php echo base_url('assets/mecha/js/plugins.js') ?>"></script>

<script src="<?php echo base_url('assets/mecha/js/bootstrap-datepicker.js') ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/mecha/css/bootstrap-datepicker3.min.css') ?>" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/data/css/bootstrap.min.css" type="text/css" />

<pre>
<b>Note:</b>
using <a href="getbootstrap.com/">bootstrap 3.2.0</a> and <a href="https://github.com/eternicode/bootstrap-datepicker">eternicode bootstrap-datepicker</a>
</pre>
<pre>
<b>@import css</b>
&lt;link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
&lt;link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
</pre>
<pre>
<b>@import js</b>
jQuery.js
&lt;script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js">&lt;/script>
&lt;script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js">&lt;/script>
</pre>
<label>Select Date: </label>
<div id="datepicker" class="input-group date" data-date-format="mm-dd-yyyy">
    <input class="form-control" type="text" readonly />
    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
</div>

<script>
    $(document).ready(function() {
        $("#datepicker").datepicker({
            autoclose: true,
            todayHighlight: true
        }).datepicker('update', new Date());
    });
</script>