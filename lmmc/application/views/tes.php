<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="<?php echo base_url(); ?>assets/data/js/jquery.min.js"></script>
</head>
<body>

</body>

<script type="text/javascript">
	
	$.ajax({
		url: '<?php echo base_url('bot/poll') ?>',
		async: true,
		success: function(res)
		{
			$('body').html(res);
			console.log(res)
		}
	})
	
	
</script>
</html>