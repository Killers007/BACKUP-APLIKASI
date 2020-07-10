<section  id="content">
	<section class="hbox stretch">  
		<section class="vbox">
			<header class="header bg-white b-b b-light">
				<section class="row m-b-md" style="">
					<div class="col-xs-8">
						<h1 class="m-b-xs text-black hidden-xs"><small><span class="text-black">Setting Navigasi</span><span style="font-size: 14px"> </span></small></h1>
					</div>
					<div class="col-xs-4 m-t-lg pull-right">
						<a type="button" class="btnShowModal btn btn-primary pull-right" data-toggle="modal" data-target="#modal-edit"  style="margin-right:5px"><i class="fa  fa-plus"></i> <span class="hidden-xs">Tambah Menu</span></a>
					</div>
				</section>
			</header> 
			<section class="scrollable space padder">

				<div class="box-body">
					<div class="row" style="margin: 0px;"> 

						<section class="panel"> 

							<div class="panel-body"> 
								<div class="tab-content"> 
									<div class="col-md-3">

									</div>
									<div class="col-md-6">
										<div class="dd nestable1">
											<ol class="dd-list">

											</ol>
										</div>
									</div>
									<div class="col-md-3">

									</div>
								</div> 
							</div> 
						</section>

					</div>
				</div>
				<a type="button" class="btnSimpanNav btn btn-success pull-right" style="margin-right:5px"><i class="fa  fa-save"></i> <span class="">Simpan</span></a>



				<!--begin::Modal-->
				<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">

						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
								<h4 class="modal-title"><span class="modalLabel"></span> Menu Navigasi</h4>
							</div>
							<?php echo form_open_multipart('', 'id="formData" class="kt-form kt-form--label-right"'); ?> 
							<div class="modal-body">
								<div class="box-body">
									<div id="group-nama" class="form-group">
										<label>Nama Navigasi <span class="text-danger">*</span></label>
										<div class="kt-input-icon">
											<input type="text" class="form-control" name="navNama" placeholder="">
											<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
										</div>
										<div class="cleanError navNama"></div>
									</div>

									<div id="group-nama" class="form-group">
										<label>Nama Modul <span class="text-danger">*</span></label>
										<div class="kt-input-icon">
											<?php echo form_dropdown('navModul', $selectModul, date('Y'), array('id' => 'selectTahun','class' => 'form-control', 'style' => 'width:100%')); ?>
											<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
										</div>
										<div class="cleanError navModul"></div>
									</div>

									<div id="group-nama" class="form-group">
										<div class="row">
											<div class="col-md-10">
												<label>Url <span class="text-danger">* <small><i>The link of menu Example : <span id="lblExample"></span></i></small></span></label>
												<div class="kt-input-icon">
													<input type="text" class="form-control" name="navUrl" placeholder="">
													<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
												</div>
												<div class="cleanError navUrl"></div>
											</div>
											<div class="col-md-2">
												<label>Icon <span class="text-danger">*</span></label>
												<div class="kt-input-icon hidden">
													<input type="text" class="form-control" name="navIcon" placeholder="">
													<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
												</div>
												<div class="cleanError navIcon"></div>
												<a class="btn btn-default btn-circle btn-select-icon btn-flat" data-original-title="" title=""><span class="icon-preview-item text-aqua"><i class="fa fa-lg fa-battery-1"></i></span></a>
											</div>
										</div>
									</div>

              <!--   <div id="group-nama" class="form-group">
                  <label>Icon <span class="text-danger">*</span></label>
                  <div class="kt-input-icon hidden">
                    <input type="text" class="form-control" name="navIcon" placeholder="">
                    <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
                  </div>
                  <div class="cleanError navIcon"></div>
                  <a class="btn btn-default btn-circle btn-xl btn-select-icon btn-flat" data-original-title="" title=""><span class="icon-preview-item text-aqua"><i class="fa fa-lg fa-battery-1"></i></span></a>
              </div> -->

          </div>
      </div>
      <div class="modal-footer" style="margin-right: -50px">
      	<button type="button" class="btn btn-success btnAddMenu" data-dismiss='modal'><span class="" ><span class="fa  fa-save"></span> Tambah</span></button>
      	<button type="button" class="btn btn-success btnChangeMenu" data-dismiss='modal'><span class=""><span class="fa  fa-save"></span> Ubah</span></button>
      </div>
      <?php echo form_close(); ?>
  </div>
</div>
</div>
<!--end::Modal-->

<br>
<br>
<br>
<br>
</section>
</section>          
</section>
</section>

<style type="text/css">
	.btn-circle.btn-xl {
		width: 70px;
		height: 70px;
		padding: 10px 16px;
		border-radius: 35px;
		font-size: 24px;
		line-height: 1.33;
	}

	.btn-circle {
		width: 40px;
		height: 40px;
		padding: 6px 0px;
		border-radius: 35px;
		text-align: center;
		font-size: 16px;
		line-height: 1.42857;
	}

</style>

<link rel="stylesheet" href="<?php echo base_url('assets') ?>/js/nestable/nestable.css" type="text/css" /> 
<script src="<?php echo base_url('assets') ?>/js/nestable/jquery.nestable.js"></script>
<script type="text/javascript">

	$(document).ready(function() {

		var _role = 'superadmin';
		var _saved = false;

		$('select[name="navModul"]').chosen({'width': '100%'});

		var updateOutput = function(e) {
			var list   = e.length ? e : $(e.target),
			output = list.data('output');   

			if (window.JSON) {
				console.log(list.nestable('serialize'));              
				var data = list.nestable('serialize');

				if (_saved) 
				{
					$.ajax({
						url: '<?php echo current_url() ?>',
						type: 'POST',
						dataType: 'JSON',
						data: {nav: data, role: _role},
						beforeSend: function()
						{
							btnLoading('.btnSimpanNav');
						},
						success: function(res)
						{
							btnNormal('.btnSimpanNav');
							toastr[res.status](res.message);
							_saved = false;

							if (res.status != 'error') 
							{
								setTimeout(function(){
									window.location = '<?php echo base_url('navigasi') ?>'
								}, 1000);
							}
						},

					})
				}
			} 
		};

		renderMenu();
		function renderMenu()
		{
			$.ajax({
				url: '<?php echo current_url() ?>',
				type: 'POST',
				dataType: 'JSON',
				data: {role: _role},
				beforeSend: function()
				{
					btnLoading('.btnSimpanNav');
				},
				success: function(res)
				{
					templateNestable(res);
					$('.dd-list').find('.pull-right').hide();
					btnNormal('.btnSimpanNav');
				},
			})
		}

		function templateNestable(data)
		{
			var text = '';

			$.each(data, function(index, value) {

				_uuid = uuidv4();
				text += `<li id="`+_uuid+`" class="dd-item dd3-item" data-modules="`+value.modules+`" data-label="`+value.label+`" data-url="`+value.url+`" data-icon="`+value.icon+`">
				<div class="dd-handle dd3-handle"><span><br></span></div>
				<div class="dd3-content">
				<span id="icon_`+_uuid+`" class="`+value.icon+`"></span> <span class="namaLabel_`+_uuid+`">`+value.label+`</span>
				<span class="pull-right">
				<a data-toggle="modal" data-target="#modal-edit" class="btnEditMenu"><i class="fa fa-pencil icon-muted fa-fw m-r-xs"></i></a>
				<a class="btnDeleteMenu"><i class="fa fa-times icon-muted fa-fw"></i></a>                  
				</span>
				</div>`;

				if (value.child.length != 0) 
				{
					text += `<ol>`;
					$.each(value.child, function(index, values) {
						_uuid = uuidv4();
						text += `<li id="`+_uuid+`" class="dd-item dd3-item" data-label="`+values.label+`" data-modules="`+values.modules+`" data-url="`+values.url+`" data-icon="`+values.icon+`">
						<div class="dd-handle dd3-handle"><span><br></span></div>
						<div class="dd3-content">
						<span id="icon_`+_uuid+`" class="`+values.icon+`"></span> <span class="namaLabel_`+_uuid+`">`+values.label+`</span>
						<span class="pull-right">
						<a data-toggle="modal" data-target="#modal-edit" class="btnEditMenu"><i class="fa fa-pencil icon-muted fa-fw m-r-xs"></i></a>
						<a class="btnDeleteMenu"><i class="fa fa-times icon-muted fa-fw"></i></a>                  
						</span>
						</div>
						</li>`;
					});

					text += `</ol>`;
				}
				text += `</li>`;
			});

			$('.dd-list').html('');
			$('.dd-list').append(text);

		}

		var nav = $('.nestable1').nestable({
			group: 2,
			maxDepth: 2,
		})
		.on('change', updateOutput);

		$(document).on('click', '.btnToggle', function(event) {
			_role = $(this).data('id');
			renderMenu();
		});

		$(document).on('mouseover', '.dd3-content', function(event) {
			$('.dd-list').find('.pull-right').hide();
			$(this).find('.pull-right').show();
		});

		$(document).on('mouseleave', '.dd3-content', function(event) {
			$('.dd-list').find('.pull-right').hide();
		});

		$(document).on('click', '.btnSimpanNav', function(event) {
			_saved = true;
			$(nav).trigger('change');
		});

		$(document).on('change', 'select[name="navModul"]', function(event) {
			$('#lblExample').html($(this).val());
		});

		$(document).on('click', '.btnDeleteMenu', function(event) {
			$(this).parent().parent().parent().remove();
		});

		var _active_uuid;
		$(document).on('click', '.btnEditMenu', function(event) {
			var data = $(this).parent().parent().parent().data();

			_active_uuid = $(this).parent().parent().parent().prop('id');
			$('.btnAddMenu').hide();
			$('.btnChangeMenu').show();

			$('input[name="navNama"]').val(data.label);
			$('select[name="navModul"]').val(data.modules).trigger('chosen:updated');
			$('input[name="navIcon"]').val(data.icon);
			$('input[name="navUrl"]').val(data.url);
			$('.icon-preview-item').find('i').attr('class', data.icon);

			console.log(data)
		});

		$(document).on('click', '.btnAddMenu', function(event) {
			var data = $('#formData').serializeArray();
			$('#formData').trigger('reset');
      // $('.icon-preview-item').find('i').attr('class', '');

      templateMenu(data);
  });

		$(document).on('click', '.btnShowModal', function(event) {

			$('.btnAddMenu').show();
			$('.btnChangeMenu').hide();
			$('#formData').trigger('reset');
      // $('.icon-preview-item').find('i').attr('class', '');

  });

		$(document).on('click', '.btnChangeMenu', function(event) {
			var data = $('#formData').serializeArray();

			$('#'+_active_uuid).find('.namaLabel_'+_active_uuid).html(data[0].value);
			$('#'+_active_uuid).data('label', data[0].value);
			$('#'+_active_uuid).data('url', data[2].value);
			$('#'+_active_uuid).data('modules', data[1].value);
			$('#'+_active_uuid).data('icon', ''+data[3].value);
			$('#'+_active_uuid).find('#icon_'+_active_uuid).attr('class', ''+data[3].value);
		});

		function uuidv4() {
			return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
				var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
				return v.toString(16);
			});
		}

		function templateMenu(data)
		{
			_uuidv4 = uuidv4();
			text = `<li id="`+_uuidv4+`" class="dd-item dd3-item" data-modules="`+data[1].value+`" data-label="`+data[0].value+`" data-url="`+data[2].value+`" data-icon="fa `+data[3].value+`">
			<div class="dd-handle dd3-handle"><span><br></span></div>
			<div class="dd3-content">
			<span id="icon_`+_uuidv4+`" class="fa `+data[3].value+`"></span> <span class="namaLabel_`+_uuidv4+`">`+data[0].value+`</span>
			<span class="pull-right">
			<a data-toggle="modal" data-target="#modal-edit" class="btnEditMenu"><i class="fa fa-pencil icon-muted fa-fw m-r-xs"></i></a>
			<a class="btnDeleteMenu"><i class="fa fa-times icon-muted fa-fw"></i></a>                  
			</span>
			</div>
			</li>`;

			$('.dd-list').append(text);
		}

		toastConfig();
		function toastConfig(){
			toastr.options = {
				"closeButton": false,
				"debug": false,
				"newestOnTop": false,
				"progressBar": false,
				"positionClass": "toast-top-right",
				"preventDuplicates": true,
				"onclick": null,
				"showDuration": "300",
				"hideDuration": "1000",
				"timeOut": "5000",
				"extendedTimeOut": "1000",
				"showEasing": "swing",
				"hideEasing": "linear",
				"showMethod": "fadeIn",
				"hideMethod": "fadeOut"
			}
		}

		function cleanError()
		{
			$('.cleanlabel').html('');
		}

		var btnText;
		function btnLoading(selector)
		{
			btnText = $(selector).html();
			$(selector).html('<i class="fa fa-spinner fa-spin"></i> Loading .....');
			$(selector).attr('disabled', 'true');
		}

		function btnNormal(selector)
		{
			$(selector).html(btnText);
			$(selector).removeAttr('disabled');
		}
		/* ----------------------   END  ----------------------*/

		$('.btn-select-icon').click(function(event) {
			event.preventDefault();

			$('#modalIcon').modal('show');
		});

		$('.icon-container').click(function(event) {
			$('#modalIcon').modal('hide');
			var icon = $(this).find('.icon-class').html();

			icon = $.trim(icon);

			$('input[name="navIcon"]').val(icon);

			$('.icon-preview-item .fa').attr('class', 'fa fa-lg '+icon);
		});

		$('#find-icon').keyup(function(event) {
			$('.icon-container').hide();
			var search = $(this).val();

			$('.icon-class').each(function(index, el) {
				var str = $(this).html();
				var patt = new RegExp(search);
				var res = patt.test(str);

				if (res) {
					$(this).parent('.icon-container').show();
				}
			});
		});

		$('.category-icon').each(function(index) {
			$('#category-icon-filter').append('<option value="'+$(this).attr('id')+'">'+$(this).attr('id')+'</option>');
		});

		$('#category-icon-filter').change(function(event) {
			var type = $('#category-icon-filter').val();
			$('.category-icon').hide();
			$('.category-icon#'+type).show();

			if (type == 'all') {
				$('.category-icon').show();
			}
		});

	});

</script>

<div class="modal fade " tabindex="-1" role="dialog" id="modalIcon">
	<div class="modal-dialog full-width modal-lg" role="document">
		<div class="modal-content">

			<div class="modal-body">
				<div style="padding: 10px;">
					<div class="row">
						<br>

						<div class="col-sm-4  col-sm-4">

							<select  class="form-control " name="category-icon-filter" id="category-icon-filter" tabi-ndex="5" data-placeholder="Select Parent">
							</select>
						</div>
						<div class="col-sm-4  col-sm-4">
						</div>
						<div class="col-sm-4  col-sm-4">
							<div class="input-group input-search">
								<input id="find-icon" class="form-control" name="find-icon" placeholder="Find icons" type="text">
								<span class="input-group-btn">
									<button class="btn btn-default"><i class="fa fa-search"></i></button>
								</span>
							</div>
						</div>
					</div>
					<hr>
					<div style="max-height: 450px; overflow: auto; padding: 20px;">

						<section class="category-icon"  id="web-application">
							<h4 class="page-header">Web Application Icons</h4>

							<div class="row list-icon">                  
								<div class="col-md-3 col-sm-4 icon-container "><i class="fa fa-adjust"></i> <span class="icon-class">fa fa-adjust</span> </div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-anchor"></i> <span class="icon-class">fa fa-anchor</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-archive"></i> <span class="icon-class">fa fa-archive</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-arrows"></i> <span class="icon-class">fa fa-arrows</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-arrows-h"></i> <span class="icon-class">fa fa-arrows-h</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-arrows-v"></i> <span class="icon-class">fa fa-arrows-v</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-asterisk"></i> <span class="icon-class">fa fa-asterisk</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-ban"></i> <span class="icon-class">fa fa-ban</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-bar-chart-o"></i> <span class="icon-class">fa fa-bar-chart-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-barcode"></i> <span class="icon-class">fa fa-barcode</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-bars"></i> <span class="icon-class">fa fa-bars</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-beer"></i> <span class="icon-class">fa fa-beer</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-bell"></i> <span class="icon-class">fa fa-bell</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-bell-o"></i> <span class="icon-class">fa fa-bell-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-bolt"></i> <span class="icon-class">fa fa-bolt</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-book"></i> <span class="icon-class">fa fa-book</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-bookmark"></i> <span class="icon-class">fa fa-bookmark</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-bookmark-o"></i> <span class="icon-class">fa fa-bookmark-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-briefcase"></i> <span class="icon-class">fa fa-briefcase</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-bug"></i> <span class="icon-class">fa fa-bug</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-building-o"></i> <span class="icon-class">fa fa-building-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-bullhorn"></i> <span class="icon-class">fa fa-bullhorn</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-bullseye"></i> <span class="icon-class">fa fa-bullseye</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-calendar"></i> <span class="icon-class">fa fa-calendar</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-calendar-o"></i> <span class="icon-class">fa fa-calendar-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-camera"></i> <span class="icon-class">fa fa-camera</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-camera-retro"></i> <span class="icon-class">fa fa-camera-retro</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-caret-square-o-down"></i> <span class="icon-class">fa fa-caret-square-o-down</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-caret-square-o-left"></i> <span class="icon-class">fa fa-caret-square-o-left</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-caret-square-o-right"></i> <span class="icon-class">fa fa-caret-square-o-right</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-caret-square-o-up"></i> <span class="icon-class">fa fa-caret-square-o-up</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-certificate"></i> <span class="icon-class">fa fa-certificate</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-check"></i> <span class="icon-class">fa fa-check</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-check-circle"></i> <span class="icon-class">fa fa-check-circle</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-check-circle-o"></i> <span class="icon-class">fa fa-check-circle-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-check-square"></i> <span class="icon-class">fa fa-check-square</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-check-square-o"></i> <span class="icon-class">fa fa-check-square-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-circle"></i> <span class="icon-class">fa fa-circle</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-circle-o"></i> <span class="icon-class">fa fa-circle-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-clock-o"></i> <span class="icon-class">fa fa-clock-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-cloud"></i> <span class="icon-class">fa fa-cloud</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-cloud-download"></i> <span class="icon-class">fa fa-cloud-download</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-cloud-upload"></i> <span class="icon-class">fa fa-cloud-upload</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-code"></i> <span class="icon-class">fa fa-code</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-code-fork"></i> <span class="icon-class">fa fa-code-fork</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-coffee"></i> <span class="icon-class">fa fa-coffee</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-cog"></i> <span class="icon-class">fa fa-cog</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-cogs"></i> <span class="icon-class">fa fa-cogs</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-comment"></i> <span class="icon-class">fa fa-comment</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-comment-o"></i> <span class="icon-class">fa fa-comment-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-comments"></i> <span class="icon-class">fa fa-comments</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-comments-o"></i> <span class="icon-class">fa fa-comments-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-compass"></i> <span class="icon-class">fa fa-compass</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-credit-card"></i> <span class="icon-class">fa fa-credit-card</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-crop"></i> <span class="icon-class">fa fa-crop</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-crosshairs"></i> <span class="icon-class">fa fa-crosshairs</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-cutlery"></i> <span class="icon-class">fa fa-cutlery</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-dashboard"></i> <span class="icon-class">fa fa-dashboard <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-desktop"></i> <span class="icon-class">fa fa-desktop</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-dot-circle-o"></i> <span class="icon-class">fa fa-dot-circle-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-download"></i> <span class="icon-class">fa fa-download</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-edit"></i> <span class="icon-class">fa fa-edit <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-ellipsis-h"></i> <span class="icon-class">fa fa-ellipsis-h</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-ellipsis-v"></i> <span class="icon-class">fa fa-ellipsis-v</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-envelope"></i> <span class="icon-class">fa fa-envelope</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-envelope-o"></i> <span class="icon-class">fa fa-envelope-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-eraser"></i> <span class="icon-class">fa fa-eraser</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-exchange"></i> <span class="icon-class">fa fa-exchange</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-exclamation"></i> <span class="icon-class">fa fa-exclamation</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-exclamation-circle"></i> <span class="icon-class">fa fa-exclamation-circle</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-exclamation-triangle"></i> <span class="icon-class">fa fa-exclamation-triangle</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-external-link"></i> <span class="icon-class">fa fa-external-link</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-external-link-square"></i> <span class="icon-class">fa fa-external-link-square</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-eye"></i> <span class="icon-class">fa fa-eye</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-eye-slash"></i> <span class="icon-class">fa fa-eye-slash</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-female"></i> <span class="icon-class">fa fa-female</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-fighter-jet"></i> <span class="icon-class">fa fa-fighter-jet</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-film"></i> <span class="icon-class">fa fa-film</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-filter"></i> <span class="icon-class">fa fa-filter</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-fire"></i> <span class="icon-class">fa fa-fire</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-fire-extinguisher"></i> <span class="icon-class">fa fa-fire-extinguisher</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-flag"></i> <span class="icon-class">fa fa-flag</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-flag-checkered"></i> <span class="icon-class">fa fa-flag-checkered</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-flag-o"></i> <span class="icon-class">fa fa-flag-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-flash"></i> <span class="icon-class">fa fa-flash <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-flask"></i> <span class="icon-class">fa fa-flask</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-folder"></i> <span class="icon-class">fa fa-folder</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-folder-o"></i> <span class="icon-class">fa fa-folder-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-folder-open"></i> <span class="icon-class">fa fa-folder-open</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-folder-open-o"></i> <span class="icon-class">fa fa-folder-open-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-frown-o"></i> <span class="icon-class">fa fa-frown-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-gamepad"></i> <span class="icon-class">fa fa-gamepad</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-gavel"></i> <span class="icon-class">fa fa-gavel</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-gear"></i> <span class="icon-class">fa fa-gear <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-gears"></i> <span class="icon-class">fa fa-gears <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-gift"></i> <span class="icon-class">fa fa-gift</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-glass"></i> <span class="icon-class">fa fa-glass</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-globe"></i> <span class="icon-class">fa fa-globe</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-group"></i> <span class="icon-class">fa fa-group <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-hdd-o"></i> <span class="icon-class">fa fa-hdd-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-headphones"></i> <span class="icon-class">fa fa-headphones</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-heart"></i> <span class="icon-class">fa fa-heart</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-heart-o"></i> <span class="icon-class">fa fa-heart-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-home"></i> <span class="icon-class">fa fa-home</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-inbox"></i> <span class="icon-class">fa fa-inbox</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-info"></i> <span class="icon-class">fa fa-info</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-info-circle"></i> <span class="icon-class">fa fa-info-circle</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-key"></i> <span class="icon-class">fa fa-key</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-keyboard-o"></i> <span class="icon-class">fa fa-keyboard-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-laptop"></i> <span class="icon-class">fa fa-laptop</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-leaf"></i> <span class="icon-class">fa fa-leaf</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-legal"></i> <span class="icon-class">fa fa-legal <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-lemon-o"></i> <span class="icon-class">fa fa-lemon-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-level-down"></i> <span class="icon-class">fa fa-level-down</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-level-up"></i> <span class="icon-class">fa fa-level-up</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-lightbulb-o"></i> <span class="icon-class">fa fa-lightbulb-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-location-arrow"></i> <span class="icon-class">fa fa-location-arrow</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-lock"></i> <span class="icon-class">fa fa-lock</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-magic"></i> <span class="icon-class">fa fa-magic</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-magnet"></i> <span class="icon-class">fa fa-magnet</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-mail-forward"></i> <span class="icon-class">fa fa-mail-forward <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-mail-reply"></i> <span class="icon-class">fa fa-mail-reply <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-mail-reply-all"></i> <span class="icon-class">fa fa-mail-reply-all</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-male"></i> <span class="icon-class">fa fa-male</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-map-marker"></i> <span class="icon-class">fa fa-map-marker</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-meh-o"></i> <span class="icon-class">fa fa-meh-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-microphone"></i> <span class="icon-class">fa fa-microphone</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-microphone-slash"></i> <span class="icon-class">fa fa-microphone-slash</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-minus"></i> <span class="icon-class">fa fa-minus</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-minus-circle"></i> <span class="icon-class">fa fa-minus-circle</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-minus-square"></i> <span class="icon-class">fa fa-minus-square</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-minus-square-o"></i> <span class="icon-class">fa fa-minus-square-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-mobile"></i> <span class="icon-class">fa fa-mobile</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-mobile-phone"></i> <span class="icon-class">fa fa-mobile-phone <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-money"></i> <span class="icon-class">fa fa-money</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-moon-o"></i> <span class="icon-class">fa fa-moon-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-music"></i> <span class="icon-class">fa fa-music</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-pencil"></i> <span class="icon-class">fa fa-pencil</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-pencil-square"></i> <span class="icon-class">fa fa-pencil-square</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-pencil-square-o"></i> <span class="icon-class">fa fa-pencil-square-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-phone"></i> <span class="icon-class">fa fa-phone</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-phone-square"></i> <span class="icon-class">fa fa-phone-square</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-picture-o"></i> <span class="icon-class">fa fa-picture-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-plane"></i> <span class="icon-class">fa fa-plane</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-plus"></i> <span class="icon-class">fa fa-plus</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-plus-circle"></i> <span class="icon-class">fa fa-plus-circle</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-plus-square"></i> <span class="icon-class">fa fa-plus-square</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-plus-square-o"></i> <span class="icon-class">fa fa-plus-square-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-power-off"></i> <span class="icon-class">fa fa-power-off</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-print"></i> <span class="icon-class">fa fa-print</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-puzzle-piece"></i> <span class="icon-class">fa fa-puzzle-piece</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-qrcode"></i> <span class="icon-class">fa fa-qrcode</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-question"></i> <span class="icon-class">fa fa-question</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-question-circle"></i> <span class="icon-class">fa fa-question-circle</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-quote-left"></i> <span class="icon-class">fa fa-quote-left</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-quote-right"></i> <span class="icon-class">fa fa-quote-right</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-random"></i> <span class="icon-class">fa fa-random</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-refresh"></i> <span class="icon-class">fa fa-refresh</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-reply"></i> <span class="icon-class">fa fa-reply</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-reply-all"></i> <span class="icon-class">fa fa-reply-all</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-retweet"></i> <span class="icon-class">fa fa-retweet</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-road"></i> <span class="icon-class">fa fa-road</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-rocket"></i> <span class="icon-class">fa fa-rocket</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-rss"></i> <span class="icon-class">fa fa-rss</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-rss-square"></i> <span class="icon-class">fa fa-rss-square</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-search"></i> <span class="icon-class">fa fa-search</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-search-minus"></i> <span class="icon-class">fa fa-search-minus</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-search-plus"></i> <span class="icon-class">fa fa-search-plus</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-share"></i> <span class="icon-class">fa fa-share</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-share-square"></i> <span class="icon-class">fa fa-share-square</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-share-square-o"></i> <span class="icon-class">fa fa-share-square-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-shield"></i> <span class="icon-class">fa fa-shield</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-shopping-cart"></i> <span class="icon-class">fa fa-shopping-cart</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-sign-in"></i> <span class="icon-class">fa fa-sign-in</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-sign-out"></i> <span class="icon-class">fa fa-sign-out</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-signal"></i> <span class="icon-class">fa fa-signal</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-sitemap"></i> <span class="icon-class">fa fa-sitemap</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-smile-o"></i> <span class="icon-class">fa fa-smile-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-sort"></i> <span class="icon-class">fa fa-sort</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-sort-alpha-asc"></i> <span class="icon-class">fa fa-sort-alpha-asc</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-sort-alpha-desc"></i> <span class="icon-class">fa fa-sort-alpha-desc</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-sort-amount-asc"></i> <span class="icon-class">fa fa-sort-amount-asc</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-sort-amount-desc"></i> <span class="icon-class">fa fa-sort-amount-desc</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-sort-asc"></i> <span class="icon-class">fa fa-sort-asc</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-sort-desc"></i> <span class="icon-class">fa fa-sort-desc</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-sort-down"></i> <span class="icon-class">fa fa-sort-down <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-sort-numeric-asc"></i> <span class="icon-class">fa fa-sort-numeric-asc</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-sort-numeric-desc"></i> <span class="icon-class">fa fa-sort-numeric-desc</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-sort-up"></i> <span class="icon-class">fa fa-sort-up <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-spinner"></i> <span class="icon-class">fa fa-spinner</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-square"></i> <span class="icon-class">fa fa-square</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-square-o"></i> <span class="icon-class">fa fa-square-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-star"></i> <span class="icon-class">fa fa-star</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-star-half"></i> <span class="icon-class">fa fa-star-half</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-star-half-empty"></i> <span class="icon-class">fa fa-star-half-empty <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-star-half-full"></i> <span class="icon-class">fa fa-star-half-full <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-star-half-o"></i> <span class="icon-class">fa fa-star-half-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-star-o"></i> <span class="icon-class">fa fa-star-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-subscript"></i> <span class="icon-class">fa fa-subscript</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-suitcase"></i> <span class="icon-class">fa fa-suitcase</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-sun-o"></i> <span class="icon-class">fa fa-sun-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-superscript"></i> <span class="icon-class">fa fa-superscript</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-tablet"></i> <span class="icon-class">fa fa-tablet</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-tachometer"></i> <span class="icon-class">fa fa-tachometer</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-tag"></i> <span class="icon-class">fa fa-tag</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-tags"></i> <span class="icon-class">fa fa-tags</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-tasks"></i> <span class="icon-class">fa fa-tasks</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-terminal"></i> <span class="icon-class">fa fa-terminal</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-thumb-tack"></i> <span class="icon-class">fa fa-thumb-tack</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-thumbs-down"></i> <span class="icon-class">fa fa-thumbs-down</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-thumbs-o-down"></i> <span class="icon-class">fa fa-thumbs-o-down</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-thumbs-o-up"></i> <span class="icon-class">fa fa-thumbs-o-up</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-thumbs-up"></i> <span class="icon-class">fa fa-thumbs-up</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-ticket"></i> <span class="icon-class">fa fa-ticket</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-times"></i> <span class="icon-class">fa fa-times</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-times-circle"></i> <span class="icon-class">fa fa-times-circle</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-times-circle-o"></i> <span class="icon-class">fa fa-times-circle-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-tint"></i> <span class="icon-class">fa fa-tint</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-toggle-down"></i> <span class="icon-class">fa fa-toggle-down <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-toggle-left"></i> <span class="icon-class">fa fa-toggle-left <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-toggle-right"></i> <span class="icon-class">fa fa-toggle-right <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-toggle-up"></i> <span class="icon-class">fa fa-toggle-up <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-trash-o"></i> <span class="icon-class">fa fa-trash-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-trophy"></i> <span class="icon-class">fa fa-trophy</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-truck"></i> <span class="icon-class">fa fa-truck</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-umbrella"></i> <span class="icon-class">fa fa-umbrella</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-unlock"></i> <span class="icon-class">fa fa-unlock</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-unlock-alt"></i> <span class="icon-class">fa fa-unlock-alt</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-unsorted"></i> <span class="icon-class">fa fa-unsorted <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-upload"></i> <span class="icon-class">fa fa-upload</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-user"></i> <span class="icon-class">fa fa-user</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-users"></i> <span class="icon-class">fa fa-users</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-video-camera"></i> <span class="icon-class">fa fa-video-camera</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-volume-down"></i> <span class="icon-class">fa fa-volume-down</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-volume-off"></i> <span class="icon-class">fa fa-volume-off</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-volume-up"></i> <span class="icon-class">fa fa-volume-up</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-warning"></i> <span class="icon-class">fa fa-warning <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-wheelchair"></i> <span class="icon-class">fa fa-wheelchair</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-wrench"></i> <span class="icon-class">fa fa-wrench</span></div>

							</div>

						</section>

						<section class="category-icon"  id="form-control">
							<h4 class="page-header">Form Control Icons</h4>

							<div class="row list-icon">

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-check-square"></i> <span class="icon-class">fa fa-check-square</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-check-square-o"></i> <span class="icon-class">fa fa-check-square-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-circle"></i> <span class="icon-class">fa fa-circle</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-circle-o"></i> <span class="icon-class">fa fa-circle-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-dot-circle-o"></i> <span class="icon-class">fa fa-dot-circle-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-minus-square"></i> <span class="icon-class">fa fa-minus-square</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-minus-square-o"></i> <span class="icon-class">fa fa-minus-square-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-plus-square"></i> <span class="icon-class">fa fa-plus-square</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-plus-square-o"></i> <span class="icon-class">fa fa-plus-square-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-square"></i> <span class="icon-class">fa fa-square</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-square-o"></i> <span class="icon-class">fa fa-square-o</span></div>

							</div>

						</section>

						<section class="category-icon"  id="currency">
							<h4 class="page-header">Currency Icons</h4>

							<div class="row list-icon">



								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-bitcoin"></i> <span class="icon-class">fa fa-bitcoin <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-btc"></i> <span class="icon-class">fa fa-btc</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-cny"></i> <span class="icon-class">fa fa-cny <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-dollar"></i> <span class="icon-class">fa fa-dollar <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-eur"></i> <span class="icon-class">fa fa-eur</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-euro"></i> <span class="icon-class">fa fa-euro <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-gbp"></i> <span class="icon-class">fa fa-gbp</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-inr"></i> <span class="icon-class">fa fa-inr</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-jpy"></i> <span class="icon-class">fa fa-jpy</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-krw"></i> <span class="icon-class">fa fa-krw</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-money"></i> <span class="icon-class">fa fa-money</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-rmb"></i> <span class="icon-class">fa fa-rmb <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-rouble"></i> <span class="icon-class">fa fa-rouble <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-rub"></i> <span class="icon-class">fa fa-rub</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-ruble"></i> <span class="icon-class">fa fa-ruble <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-rupee"></i> <span class="icon-class">fa fa-rupee <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-try"></i> <span class="icon-class">fa fa-try</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-turkish-lira"></i> <span class="icon-class">fa fa-turkish-lira <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-usd"></i> <span class="icon-class">fa fa-usd</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-won"></i> <span class="icon-class">fa fa-won <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-yen"></i> <span class="icon-class">fa fa-yen <span class="text-muted">(alias)</span></span></div>

							</div>

						</section>

						<section class="category-icon"  id="text-editor">
							<h4 class="page-header">Text Editor Icons</h4>

							<div class="row list-icon">



								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-align-center"></i> <span class="icon-class">fa fa-align-center</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-align-justify"></i> <span class="icon-class">fa fa-align-justify</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-align-left"></i> <span class="icon-class">fa fa-align-left</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-align-right"></i> <span class="icon-class">fa fa-align-right</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-bold"></i> <span class="icon-class">fa fa-bold</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-chain"></i> <span class="icon-class">fa fa-chain <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-chain-broken"></i> <span class="icon-class">fa fa-chain-broken</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-clipboard"></i> <span class="icon-class">fa fa-clipboard</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-columns"></i> <span class="icon-class">fa fa-columns</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-copy"></i> <span class="icon-class">fa fa-copy <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-cut"></i> <span class="icon-class">fa fa-cut <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-dedent"></i> <span class="icon-class">fa fa-dedent <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-eraser"></i> <span class="icon-class">fa fa-eraser</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-file"></i> <span class="icon-class">fa fa-file</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-file-o"></i> <span class="icon-class">fa fa-file-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-file-text"></i> <span class="icon-class">fa fa-file-text</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-file-text-o"></i> <span class="icon-class">fa fa-file-text-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-files-o"></i> <span class="icon-class">fa fa-files-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-floppy-o"></i> <span class="icon-class">fa fa-floppy-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-font"></i> <span class="icon-class">fa fa-font</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-indent"></i> <span class="icon-class">fa fa-indent</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-italic"></i> <span class="icon-class">fa fa-italic</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-link"></i> <span class="icon-class">fa fa-link</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-list"></i> <span class="icon-class">fa fa-list</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-list-alt"></i> <span class="icon-class">fa fa-list-alt</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-list-ol"></i> <span class="icon-class">fa fa-list-ol</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-list-ul"></i> <span class="icon-class">fa fa-list-ul</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-outdent"></i> <span class="icon-class">fa fa-outdent</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-paperclip"></i> <span class="icon-class">fa fa-paperclip</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-paste"></i> <span class="icon-class">fa fa-paste <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-repeat"></i> <span class="icon-class">fa fa-repeat</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-rotate-left"></i> <span class="icon-class">fa fa-rotate-left <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-rotate-right"></i> <span class="icon-class">fa fa-rotate-right <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-save"></i> <span class="icon-class">fa fa-save <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-scissors"></i> <span class="icon-class">fa fa-scissors</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-strikethrough"></i> <span class="icon-class">fa fa-strikethrough</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-table"></i> <span class="icon-class">fa fa-table</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-text-height"></i> <span class="icon-class">fa fa-text-height</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-text-width"></i> <span class="icon-class">fa fa-text-width</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-th"></i> <span class="icon-class">fa fa-th</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-th-large"></i> <span class="icon-class">fa fa-th-large</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-th-list"></i> <span class="icon-class">fa fa-th-list</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-underline"></i> <span class="icon-class">fa fa-underline</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-undo"></i> <span class="icon-class">fa fa-undo</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-unlink"></i> <span class="icon-class">fa fa-unlink <span class="text-muted">(alias)</span></span></div>

							</div>

						</section>

						<section class="category-icon"  id="directional">
							<h4 class="page-header">Directional Icons</h4>

							<div class="row list-icon">



								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-angle-double-down"></i> <span class="icon-class">fa fa-angle-double-down</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-angle-double-left"></i> <span class="icon-class">fa fa-angle-double-left</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-angle-double-right"></i> <span class="icon-class">fa fa-angle-double-right</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-angle-double-up"></i> <span class="icon-class">fa fa-angle-double-up</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-angle-down"></i> <span class="icon-class">fa fa-angle-down</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-angle-left"></i> <span class="icon-class">fa fa-angle-left</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-angle-right"></i> <span class="icon-class">fa fa-angle-right</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-angle-up"></i> <span class="icon-class">fa fa-angle-up</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-arrow-circle-down"></i> <span class="icon-class">fa fa-arrow-circle-down</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-arrow-circle-left"></i> <span class="icon-class">fa fa-arrow-circle-left</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-arrow-circle-o-down"></i> <span class="icon-class">fa fa-arrow-circle-o-down</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-arrow-circle-o-left"></i> <span class="icon-class">fa fa-arrow-circle-o-left</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-arrow-circle-o-right"></i> <span class="icon-class">fa fa-arrow-circle-o-right</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-arrow-circle-o-up"></i> <span class="icon-class">fa fa-arrow-circle-o-up</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-arrow-circle-right"></i> <span class="icon-class">fa fa-arrow-circle-right</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-arrow-circle-up"></i> <span class="icon-class">fa fa-arrow-circle-up</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-arrow-down"></i> <span class="icon-class">fa fa-arrow-down</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-arrow-left"></i> <span class="icon-class">fa fa-arrow-left</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-arrow-right"></i> <span class="icon-class">fa fa-arrow-right</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-arrow-up"></i> <span class="icon-class">fa fa-arrow-up</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-arrows"></i> <span class="icon-class">fa fa-arrows</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-arrows-alt"></i> <span class="icon-class">fa fa-arrows-alt</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-arrows-h"></i> <span class="icon-class">fa fa-arrows-h</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-arrows-v"></i> <span class="icon-class">fa fa-arrows-v</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-caret-down"></i> <span class="icon-class">fa fa-caret-down</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-caret-left"></i> <span class="icon-class">fa fa-caret-left</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-caret-right"></i> <span class="icon-class">fa fa-caret-right</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-caret-square-o-down"></i> <span class="icon-class">fa fa-caret-square-o-down</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-caret-square-o-left"></i> <span class="icon-class">fa fa-caret-square-o-left</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-caret-square-o-right"></i> <span class="icon-class">fa fa-caret-square-o-right</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-caret-square-o-up"></i> <span class="icon-class">fa fa-caret-square-o-up</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-caret-up"></i> <span class="icon-class">fa fa-caret-up</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-chevron-circle-down"></i> <span class="icon-class">fa fa-chevron-circle-down</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-chevron-circle-left"></i> <span class="icon-class">fa fa-chevron-circle-left</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-chevron-circle-right"></i> <span class="icon-class">fa fa-chevron-circle-right</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-chevron-circle-up"></i> <span class="icon-class">fa fa-chevron-circle-up</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-chevron-down"></i> <span class="icon-class">fa fa-chevron-down</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-chevron-left"></i> <span class="icon-class">fa fa-chevron-left</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-chevron-right"></i> <span class="icon-class">fa fa-chevron-right</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-chevron-up"></i> <span class="icon-class">fa fa-chevron-up</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-hand-o-down"></i> <span class="icon-class">fa fa-hand-o-down</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-hand-o-left"></i> <span class="icon-class">fa fa-hand-o-left</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-hand-o-right"></i> <span class="icon-class">fa fa-hand-o-right</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-hand-o-up"></i> <span class="icon-class">fa fa-hand-o-up</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-long-arrow-down"></i> <span class="icon-class">fa fa-long-arrow-down</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-long-arrow-left"></i> <span class="icon-class">fa fa-long-arrow-left</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-long-arrow-right"></i> <span class="icon-class">fa fa-long-arrow-right</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-long-arrow-up"></i> <span class="icon-class">fa fa-long-arrow-up</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-toggle-down"></i> <span class="icon-class">fa fa-toggle-down <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-toggle-left"></i> <span class="icon-class">fa fa-toggle-left <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-toggle-right"></i> <span class="icon-class">fa fa-toggle-right <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-toggle-up"></i> <span class="icon-class">fa fa-toggle-up <span class="text-muted">(alias)</span></span></div>

							</div>

						</section>

						<section class="category-icon"  id="video-player">
							<h4 class="page-header">Video Player Icons</h4>

							<div class="row list-icon">



								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-arrows-alt"></i> <span class="icon-class">fa fa-arrows-alt</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-backward"></i> <span class="icon-class">fa fa-backward</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-compress"></i> <span class="icon-class">fa fa-compress</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-eject"></i> <span class="icon-class">fa fa-eject</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-expand"></i> <span class="icon-class">fa fa-expand</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-fast-backward"></i> <span class="icon-class">fa fa-fast-backward</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-fast-forward"></i> <span class="icon-class">fa fa-fast-forward</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-forward"></i> <span class="icon-class">fa fa-forward</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-pause"></i> <span class="icon-class">fa fa-pause</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-play"></i> <span class="icon-class">fa fa-play</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-play-circle"></i> <span class="icon-class">fa fa-play-circle</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-play-circle-o"></i> <span class="icon-class">fa fa-play-circle-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-step-backward"></i> <span class="icon-class">fa fa-step-backward</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-step-forward"></i> <span class="icon-class">fa fa-step-forward</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-stop"></i> <span class="icon-class">fa fa-stop</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-youtube-play"></i> <span class="icon-class">fa fa-youtube-play</span></div>

							</div>

						</section>

						<section class="category-icon"  id="brand">
							<h4 class="page-header">Brand Icons</h4>

							<div class="alert alert-success">
								<ul class="margin-bottom-none padding-left-lg">
									<li>All brand icons are trademarks of their respective owners.</li>
									<li>The use of these trademarks does not indicate endorsement of the trademark holder by Font Awesome, nor vice versa.</li>
								</ul>

							</div>

							<div class="row list-icon">



								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-adn"></i> <span class="icon-class">fa fa-adn</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-android"></i> <span class="icon-class">fa fa-android</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-apple"></i> <span class="icon-class">fa fa-apple</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-bitbucket"></i> <span class="icon-class">fa fa-bitbucket</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-bitbucket-square"></i> <span class="icon-class">fa fa-bitbucket-square</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-bitcoin"></i> <span class="icon-class">fa fa-bitcoin <span class="text-muted">(alias)</span></span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-btc"></i> <span class="icon-class">fa fa-btc</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-css3"></i> <span class="icon-class">fa fa-css3</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-dribbble"></i> <span class="icon-class">fa fa-dribbble</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-dropbox"></i> <span class="icon-class">fa fa-dropbox</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-facebook"></i> <span class="icon-class">fa fa-facebook</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-facebook-square"></i> <span class="icon-class">fa fa-facebook-square</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-flickr"></i> <span class="icon-class">fa fa-flickr</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-foursquare"></i> <span class="icon-class">fa fa-foursquare</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-github"></i> <span class="icon-class">fa fa-github</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-github-alt"></i> <span class="icon-class">fa fa-github-alt</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-github-square"></i> <span class="icon-class">fa fa-github-square</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-gittip"></i> <span class="icon-class">fa fa-gittip</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-google-plus"></i> <span class="icon-class">fa fa-google-plus</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-google-plus-square"></i> <span class="icon-class">fa fa-google-plus-square</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-html5"></i> <span class="icon-class">fa fa-html5</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-instagram"></i> <span class="icon-class">fa fa-instagram</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-linkedin"></i> <span class="icon-class">fa fa-linkedin</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-linkedin-square"></i> <span class="icon-class">fa fa-linkedin-square</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-linux"></i> <span class="icon-class">fa fa-linux</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-maxcdn"></i> <span class="icon-class">fa fa-maxcdn</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-pagelines"></i> <span class="icon-class">fa fa-pagelines</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-pinterest"></i> <span class="icon-class">fa fa-pinterest</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-pinterest-square"></i> <span class="icon-class">fa fa-pinterest-square</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-renren"></i> <span class="icon-class">fa fa-renren</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-skype"></i> <span class="icon-class">fa fa-skype</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-stack-exchange"></i> <span class="icon-class">fa fa-stack-exchange</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-stack-overflow"></i> <span class="icon-class">fa fa-stack-overflow</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-trello"></i> <span class="icon-class">fa fa-trello</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-tumblr"></i> <span class="icon-class">fa fa-tumblr</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-tumblr-square"></i> <span class="icon-class">fa fa-tumblr-square</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-twitter"></i> <span class="icon-class">fa fa-twitter</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-twitter-square"></i> <span class="icon-class">fa fa-twitter-square</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-vimeo-square"></i> <span class="icon-class">fa fa-vimeo-square</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-vk"></i> <span class="icon-class">fa fa-vk</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-weibo"></i> <span class="icon-class">fa fa-weibo</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-windows"></i> <span class="icon-class">fa fa-windows</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-xing"></i> <span class="icon-class">fa fa-xing</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-xing-square"></i> <span class="icon-class">fa fa-xing-square</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-youtube"></i> <span class="icon-class">fa fa-youtube</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-youtube-play"></i> <span class="icon-class">fa fa-youtube-play</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-youtube-square"></i> <span class="icon-class">fa fa-youtube-square</span></div>

							</div>
						</section>

						<section class="category-icon"  id="medical">
							<h4 class="page-header">Medical Icons</h4>

							<div class="row list-icon">

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-ambulance"></i> <span class="icon-class">fa fa-ambulance</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-h-square"></i> <span class="icon-class">fa fa-h-square</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-hospital-o"></i> <span class="icon-class">fa fa-hospital-o</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-medkit"></i> <span class="icon-class">fa fa-medkit</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-plus-square"></i> <span class="icon-class">fa fa-plus-square</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-stethoscope"></i> <span class="icon-class">fa fa-stethoscope</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-user-md"></i> <span class="icon-class">fa fa-user-md</span></div>

								<div class="col-md-3 col-sm-4 icon-container"><i class="fa fa-wheelchair"></i> <span class="icon-class">fa fa-wheelchair</span></div>

							</div>

						</section>

						<section class="category-icon"  id="275">
							<h4 class="page-header">275 Icon</h4>

							<div class="row list-icon">
								<div class="col-md-3 col-sm-4 icon-container">
									<i class="i i-move"></i><span class="icon-class">i i-move
									</span></div>
									<div class="col-md-3 col-sm-4 icon-container">
										<i class="i i-move-vertical"></i><span class="icon-class">i i-move-vertical
										</span></div>
										<div class="col-md-3 col-sm-4 icon-container">
											<i class="i i-resize-enlarge"></i><span class="icon-class">i i-resize-enlarge
											</span></div>
											<div class="col-md-3 col-sm-4 icon-container">
												<i class="i i-resize-shrink"></i><span class="icon-class">i i-resize-shrink
												</span></div>
												<div class="col-md-3 col-sm-4 icon-container">
													<i class="i i-move-horizontal"></i><span class="icon-class">i i-move-horizontal
													</span></div>
													<div class="col-md-3 col-sm-4 icon-container">
														<i class="i i-download"></i><span class="icon-class">i i-download
														</span></div>
														<div class="col-md-3 col-sm-4 icon-container">
															<i class="i i-upload"></i><span class="icon-class">i i-upload
															</span></div>
															<div class="col-md-3 col-sm-4 icon-container">
																<i class="i i-cloud-download"></i><span class="icon-class">i i-cloud-download
																</span></div>
																<div class="col-md-3 col-sm-4 icon-container">
																	<i class="i i-cloud-upload"></i><span class="icon-class">i i-cloud-upload
																	</span></div>
																	<div class="col-md-3 col-sm-4 icon-container">
																		<i class="i i-circleleft"></i><span class="icon-class">i i-circleleft
																		</span></div>
																		<div class="col-md-3 col-sm-4 icon-container">
																			<i class="i i-circledown"></i><span class="icon-class">i i-circledown
																			</span></div>
																			<div class="col-md-3 col-sm-4 icon-container">
																				<i class="i i-circleup"></i><span class="icon-class">i i-circleup
																				</span></div>
																				<div class="col-md-3 col-sm-4 icon-container">
																					<i class="i i-circleright"></i><span class="icon-class">i i-circleright
																					</span></div>
																					<div class="col-md-3 col-sm-4 icon-container">
																						<i class="i i-home"></i><span class="icon-class">i i-home
																						</span></div>
																						<div class="col-md-3 col-sm-4 icon-container">
																							<i class="i i-download3"></i><span class="icon-class">i i-download3
																							</span></div>
																							<div class="col-md-3 col-sm-4 icon-container">
																								<i class="i i-pin"></i><span class="icon-class">i i-pin
																								</span></div>
																								<div class="col-md-3 col-sm-4 icon-container">
																									<i class="i i-pictures"></i><span class="icon-class">i i-pictures
																									</span></div>
																									<div class="col-md-3 col-sm-4 icon-container">
																										<i class="i i-share3"></i><span class="icon-class">i i-share3
																										</span></div>
																										<div class="col-md-3 col-sm-4 icon-container">
																											<i class="i i-pencil2"></i><span class="icon-class">i i-pencil2
																											</span></div>
																											<div class="col-md-3 col-sm-4 icon-container">
																												<i class="i i-mail2"></i><span class="icon-class">i i-mail2
																												</span></div>
																												<div class="col-md-3 col-sm-4 icon-container">
																													<i class="i i-support"></i><span class="icon-class">i i-support
																													</span></div>
																													<div class="col-md-3 col-sm-4 icon-container">
																														<i class="i i-asc"></i><span class="icon-class">i i-asc
																														</span></div>
																														<div class="col-md-3 col-sm-4 icon-container">
																															<i class="i i-dsc"></i><span class="icon-class">i i-dsc
																															</span></div>
																															<div class="col-md-3 col-sm-4 icon-container">
																																<i class="i i-ok"></i><span class="icon-class">i i-ok
																																</span></div>
																																<div class="col-md-3 col-sm-4 icon-container">
																																	<i class="i i-error"></i><span class="icon-class">i i-error
																																	</span></div>
																																	<div class="col-md-3 col-sm-4 icon-container">
																																		<i class="i i-expand"></i><span class="icon-class">i i-expand
																																		</span></div>
																																		<div class="col-md-3 col-sm-4 icon-container">
																																			<i class="i i-collapse"></i><span class="icon-class">i i-collapse
																																			</span></div>                
																																			<div class="col-md-3 col-sm-4 icon-container">
																																				<i class="i i-screen"></i><span class="icon-class">i i-screen
																																				</span></div>
																																				<div class="col-md-3 col-sm-4 icon-container">
																																					<i class="i i-phone3"></i><span class="icon-class">i i-phone3
																																					</span></div>
																																					<div class="col-md-3 col-sm-4 icon-container">
																																						<i class="i i-phone-portrait"></i><span class="icon-class">i i-phone-portrait
																																						</span></div>
																																						<div class="col-md-3 col-sm-4 icon-container">
																																							<i class="i i-phone-landscape"></i><span class="icon-class">i i-phone-landscape
																																							</span></div>
																																							<div class="col-md-3 col-sm-4 icon-container">
																																								<i class="i i-tablet"></i><span class="icon-class">i i-tablet
																																								</span></div>
																																								<div class="col-md-3 col-sm-4 icon-container">
																																									<i class="i i-tablet-landscape"></i><span class="icon-class">i i-tablet-landscape
																																									</span></div>
																																									<div class="col-md-3 col-sm-4 icon-container">
																																										<i class="i i-laptop"></i><span class="icon-class">i i-laptop
																																										</span></div>
																																										<div class="col-md-3 col-sm-4 icon-container">
																																											<i class="i i-cube"></i><span class="icon-class">i i-cube
																																											</span></div>
																																											<div class="col-md-3 col-sm-4 icon-container">
																																												<i class="i i-chart"></i><span class="icon-class">i i-chart
																																												</span></div>
																																												<div class="col-md-3 col-sm-4 icon-container">
																																													<i class="i i-graph"></i><span class="icon-class">i i-graph
																																													</span></div>
																																													<div class="col-md-3 col-sm-4 icon-container">
																																														<i class="i i-meter"></i><span class="icon-class">i i-meter
																																														</span></div>
																																														<div class="col-md-3 col-sm-4 icon-container">
																																															<i class="i i-heart2"></i><span class="icon-class">i i-heart2
																																															</span></div>
																																															<div class="col-md-3 col-sm-4 icon-container">
																																																<i class="i i-star2"></i><span class="icon-class">i i-star2
																																																</span></div>
																																																<div class="col-md-3 col-sm-4 icon-container">
																																																	<i class="i i-stack"></i><span class="icon-class">i i-stack
																																																	</span></div>
																																																	<div class="col-md-3 col-sm-4 icon-container">
																																																		<i class="i i-tv"></i><span class="icon-class">i i-tv
																																																		</span></div>
																																																		<div class="col-md-3 col-sm-4 icon-container">
																																																			<i class="i i-user2"></i><span class="icon-class">i i-user2
																																																			</span></div>
																																																			<div class="col-md-3 col-sm-4 icon-container">
																																																				<i class="i i-users2"></i><span class="icon-class">i i-users2
																																																				</span></div>
																																																				<div class="col-md-3 col-sm-4 icon-container">
																																																					<i class="i i-search2"></i><span class="icon-class">i i-search2
																																																					</span></div>
																																																					<div class="col-md-3 col-sm-4 icon-container">
																																																						<i class="i i-zoom-in2"></i><span class="icon-class">i i-zoom-in2
																																																						</span></div>
																																																						<div class="col-md-3 col-sm-4 icon-container">
																																																							<i class="i i-zoom-out2"></i><span class="icon-class">i i-zoom-out2
																																																							</span></div>
																																																							<div class="col-md-3 col-sm-4 icon-container">
																																																								<i class="i i-slider-v"></i><span class="icon-class">i i-slider-v
																																																								</span></div>
																																																								<div class="col-md-3 col-sm-4 icon-container">
																																																									<i class="i i-slider"></i><span class="icon-class">i i-slider
																																																									</span></div>
																																																									<div class="col-md-3 col-sm-4 icon-container">
																																																										<i class="i i-stats"></i><span class="icon-class">i i-stats
																																																										</span></div>
																																																										<div class="col-md-3 col-sm-4 icon-container">
																																																											<i class="i i-bars"></i><span class="icon-class">i i-bars
																																																											</span></div>
																																																											<div class="col-md-3 col-sm-4 icon-container">
																																																												<i class="i i-arrow-up-left2"></i><span class="icon-class">i i-arrow-up-left2
																																																												</span></div>
																																																												<div class="col-md-3 col-sm-4 icon-container">
																																																													<i class="i i-arrow-up2"></i><span class="icon-class">i i-arrow-up2
																																																													</span></div>
																																																													<div class="col-md-3 col-sm-4 icon-container">
																																																														<i class="i i-arrow-up-right2"></i><span class="icon-class">i i-arrow-up-right2
																																																														</span></div>
																																																														<div class="col-md-3 col-sm-4 icon-container">
																																																															<i class="i i-arrow-right2"></i><span class="icon-class">i i-arrow-right2
																																																															</span></div>
																																																															<div class="col-md-3 col-sm-4 icon-container">
																																																																<i class="i i-arrow-down-right2"></i><span class="icon-class">i i-arrow-down-right2
																																																																</span></div>
																																																																<div class="col-md-3 col-sm-4 icon-container">
																																																																	<i class="i i-arrow-down-2"></i><span class="icon-class">i i-arrow-down-2
																																																																	</span></div>
																																																																	<div class="col-md-3 col-sm-4 icon-container">
																																																																		<i class="i i-arrow-down-left-2"></i><span class="icon-class">i i-arrow-down-left-2
																																																																		</span></div>
																																																																		<div class="col-md-3 col-sm-4 icon-container">
																																																																			<i class="i i-arrow-left2"></i><span class="icon-class">i i-arrow-left2
																																																																			</span></div>
																																																																			<div class="col-md-3 col-sm-4 icon-container">
																																																																				<i class="i i-file-pdf"></i><span class="icon-class">i i-file-pdf
																																																																				</span></div>
																																																																				<div class="col-md-3 col-sm-4 icon-container">
																																																																					<i class="i i-file-openoffice"></i><span class="icon-class">i i-file-openoffice
																																																																					</span></div>
																																																																					<div class="col-md-3 col-sm-4 icon-container">
																																																																						<i class="i i-file-word"></i><span class="icon-class">i i-file-word
																																																																						</span></div>
																																																																						<div class="col-md-3 col-sm-4 icon-container">
																																																																							<i class="i i-file-excel"></i><span class="icon-class">i i-file-excel
																																																																							</span></div>
																																																																							<div class="col-md-3 col-sm-4 icon-container">
																																																																								<i class="i i-file-zip"></i><span class="icon-class">i i-file-zip
																																																																								</span></div>
																																																																								<div class="col-md-3 col-sm-4 icon-container">
																																																																									<i class="i i-file-powerpoint"></i><span class="icon-class">i i-file-powerpoint
																																																																									</span></div>
																																																																									<div class="col-md-3 col-sm-4 icon-container">
																																																																										<i class="i i-file-xml"></i><span class="icon-class">i i-file-xml
																																																																										</span></div>
																																																																										<div class="col-md-3 col-sm-4 icon-container">
																																																																											<i class="i i-file-css"></i><span class="icon-class">i i-file-css
																																																																											</span></div>
																																																																											<div class="col-md-3 col-sm-4 icon-container">
																																																																												<i class="i i-video"></i><span class="icon-class">i i-video
																																																																												</span></div>
																																																																												<div class="col-md-3 col-sm-4 icon-container">
																																																																													<i class="i i-settings"></i><span class="icon-class">i i-settings
																																																																													</span></div>
																																																																													<div class="col-md-3 col-sm-4 icon-container">
																																																																														<i class="i i-camera"></i><span class="icon-class">i i-camera
																																																																														</span></div>
																																																																														<div class="col-md-3 col-sm-4 icon-container">
																																																																															<i class="i i-tag"></i><span class="icon-class">i i-tag
																																																																															</span></div>
																																																																															<div class="col-md-3 col-sm-4 icon-container">
																																																																																<i class="i i-bulb"></i><span class="icon-class">i i-bulb
																																																																																</span></div>
																																																																																<div class="col-md-3 col-sm-4 icon-container">
																																																																																	<i class="i i-location"></i><span class="icon-class">i i-location
																																																																																	</span></div>
																																																																																	<div class="col-md-3 col-sm-4 icon-container">
																																																																																		<i class="i i-eye2"></i><span class="icon-class">i i-eye2
																																																																																		</span></div>
																																																																																		<div class="col-md-3 col-sm-4 icon-container">
																																																																																			<i class="i i-bubble"></i><span class="icon-class">i i-bubble
																																																																																			</span></div>
																																																																																			<div class="col-md-3 col-sm-4 icon-container">
																																																																																				<i class="i i-mail"></i><span class="icon-class">i i-mail
																																																																																				</span></div>
																																																																																				<div class="col-md-3 col-sm-4 icon-container">
																																																																																					<i class="i i-paperplane"></i><span class="icon-class">i i-paperplane
																																																																																					</span></div>
																																																																																					<div class="col-md-3 col-sm-4 icon-container">
																																																																																						<i class="i i-data"></i><span class="icon-class">i i-data
																																																																																						</span></div>
																																																																																						<div class="col-md-3 col-sm-4 icon-container">
																																																																																							<i class="i i-t-shirt"></i><span class="icon-class">i i-t-shirt
																																																																																							</span></div>
																																																																																							<div class="col-md-3 col-sm-4 icon-container">
																																																																																								<i class="i i-lab"></i><span class="icon-class">i i-lab
																																																																																								</span></div>
																																																																																								<div class="col-md-3 col-sm-4 icon-container">
																																																																																									<i class="i i-calendar"></i><span class="icon-class">i i-calendar
																																																																																									</span></div>
																																																																																									<div class="col-md-3 col-sm-4 icon-container">
																																																																																										<i class="i i-earth"></i><span class="icon-class">i i-earth
																																																																																										</span></div>
																																																																																										<div class="col-md-3 col-sm-4 icon-container">
																																																																																											<i class="i i-world"></i><span class="icon-class">i i-world
																																																																																											</span></div>
																																																																																											<div class="col-md-3 col-sm-4 icon-container">
																																																																																												<i class="i i-vynil"></i><span class="icon-class">i i-vynil
																																																																																												</span></div>
																																																																																												<div class="col-md-3 col-sm-4 icon-container">
																																																																																													<i class="i i-gauge"></i><span class="icon-class">i i-gauge
																																																																																													</span></div>
																																																																																													<div class="col-md-3 col-sm-4 icon-container">
																																																																																														<i class="i i-statistics"></i><span class="icon-class">i i-statistics
																																																																																														</span></div>
																																																																																														<div class="col-md-3 col-sm-4 icon-container">
																																																																																															<i class="i i-arrow-left3"></i><span class="icon-class">i i-arrow-left3
																																																																																															</span></div>
																																																																																															<div class="col-md-3 col-sm-4 icon-container">
																																																																																																<i class="i i-arrow-down3"></i><span class="icon-class">i i-arrow-down3
																																																																																																</span></div>
																																																																																																<div class="col-md-3 col-sm-4 icon-container">
																																																																																																	<i class="i i-arrow-up3"></i><span class="icon-class">i i-arrow-up3
																																																																																																	</span></div>
																																																																																																	<div class="col-md-3 col-sm-4 icon-container">
																																																																																																		<i class="i i-arrow-right3"></i><span class="icon-class">i i-arrow-right3
																																																																																																		</span></div>
																																																																																																		<div class="col-md-3 col-sm-4 icon-container">
																																																																																																			<i class="i i-arrow-left4"></i><span class="icon-class">i i-arrow-left4
																																																																																																			</span></div>
																																																																																																			<div class="col-md-3 col-sm-4 icon-container">
																																																																																																				<i class="i i-arrow-down4"></i><span class="icon-class">i i-arrow-down4
																																																																																																				</span></div>
																																																																																																				<div class="col-md-3 col-sm-4 icon-container">
																																																																																																					<i class="i i-arrow-up4"></i><span class="icon-class">i i-arrow-up4
																																																																																																					</span></div>
																																																																																																					<div class="col-md-3 col-sm-4 icon-container">
																																																																																																						<i class="i i-arrow-right4"></i><span class="icon-class">i i-arrow-right4
																																																																																																						</span></div>
																																																																																																						<div class="col-md-3 col-sm-4 icon-container">
																																																																																																							<i class="i i-arrow-left5"></i><span class="icon-class">i i-arrow-left5
																																																																																																							</span></div>
																																																																																																							<div class="col-md-3 col-sm-4 icon-container">
																																																																																																								<i class="i i-arrow-down5"></i><span class="icon-class">i i-arrow-down5
																																																																																																								</span></div>
																																																																																																								<div class="col-md-3 col-sm-4 icon-container">
																																																																																																									<i class="i i-arrow-up5"></i><span class="icon-class">i i-arrow-up5
																																																																																																									</span></div>
																																																																																																									<div class="col-md-3 col-sm-4 icon-container">
																																																																																																										<i class="i i-arrow-right5"></i><span class="icon-class">i i-arrow-right5
																																																																																																										</span></div>
																																																																																																										<div class="col-md-3 col-sm-4 icon-container">
																																																																																																											<i class="i i-search"></i><span class="icon-class">i i-search
																																																																																																											</span></div>
																																																																																																											<div class="col-md-3 col-sm-4 icon-container">
																																																																																																												<i class="i i-list"></i><span class="icon-class">i i-list
																																																																																																												</span></div>
																																																																																																												<div class="col-md-3 col-sm-4 icon-container">
																																																																																																													<i class="i i-add-to-list"></i><span class="icon-class">i i-add-to-list
																																																																																																													</span></div>
																																																																																																													<div class="col-md-3 col-sm-4 icon-container">
																																																																																																														<i class="i i-list2"></i><span class="icon-class">i i-list2
																																																																																																														</span></div>
																																																																																																														<div class="col-md-3 col-sm-4 icon-container">
																																																																																																															<i class="i i-play"></i><span class="icon-class">i i-play
																																																																																																															</span></div>
																																																																																																															<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																<i class="i i-pause"></i><span class="icon-class">i i-pause
																																																																																																																</span></div>
																																																																																																																<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																	<i class="i i-stop"></i><span class="icon-class">i i-stop
																																																																																																																	</span></div>
																																																																																																																	<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																		<i class="i i-backward"></i><span class="icon-class">i i-backward
																																																																																																																		</span></div>
																																																																																																																		<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																			<i class="i i-forward"></i><span class="icon-class">i i-forward
																																																																																																																			</span></div>
																																																																																																																			<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																				<i class="i i-feed"></i><span class="icon-class">i i-feed
																																																																																																																				</span></div>
																																																																																																																				<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																					<i class="i i-switch"></i><span class="icon-class">i i-switch
																																																																																																																					</span></div>
																																																																																																																					<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																						<i class="i i-clock2"></i><span class="icon-class">i i-clock2
																																																																																																																						</span></div>
																																																																																																																						<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																							<i class="i i-health"></i><span class="icon-class">i i-health
																																																																																																																							</span></div>
																																																																																																																							<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																								<i class="i i-pencil"></i><span class="icon-class">i i-pencil
																																																																																																																								</span></div>
																																																																																																																								<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																									<i class="i i-minus2"></i><span class="icon-class">i i-minus2
																																																																																																																									</span></div>
																																																																																																																									<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																										<i class="i i-plus2"></i><span class="icon-class">i i-plus2
																																																																																																																										</span></div>
																																																																																																																										<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																											<i class="i i-stats"></i><span class="icon-class">i i-stats
																																																																																																																											</span></div>
																																																																																																																											<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																												<i class="i i-paperclip"></i><span class="icon-class">i i-paperclip
																																																																																																																												</span></div>
																																																																																																																												<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																													<i class="i i-keyboard"></i><span class="icon-class">i i-keyboard
																																																																																																																													</span></div>
																																																																																																																													<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																														<i class="i i-mic"></i><span class="icon-class">i i-mic
																																																																																																																														</span></div>
																																																																																																																														<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																															<i class="i i-heart"></i><span class="icon-class">i i-heart
																																																																																																																															</span></div>
																																																																																																																															<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																<i class="i i-layout"></i><span class="icon-class">i i-layout
																																																																																																																																</span></div>
																																																																																																																																<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																	<i class="i i-layout2"></i><span class="icon-class">i i-layout2
																																																																																																																																	</span></div>
																																																																																																																																	<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																		<i class="i i-layout3"></i><span class="icon-class">i i-layout3
																																																																																																																																		</span></div>
																																																																																																																																		<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																			<i class="i i-cloud"></i><span class="icon-class">i i-cloud
																																																																																																																																			</span></div>
																																																																																																																																			<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																				<i class="i i-info"></i><span class="icon-class">i i-info
																																																																																																																																				</span></div>
																																																																																																																																				<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																					<i class="i i-question"></i><span class="icon-class">i i-question
																																																																																																																																					</span></div>
																																																																																																																																					<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																						<i class="i i-notification"></i><span class="icon-class">i i-notification
																																																																																																																																						</span></div>
																																																																																																																																						<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																							<i class="i i-libreoffice"></i><span class="icon-class">i i-libreoffice
																																																																																																																																							</span></div>
																																																																																																																																							<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																								<i class="i i-headphones"></i><span class="icon-class">i i-headphones
																																																																																																																																								</span></div>
																																																																																																																																								<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																									<i class="i i-copy2"></i><span class="icon-class">i i-copy2
																																																																																																																																									</span></div>
																																																																																																																																									<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																										<i class="i i-copy3"></i><span class="icon-class">i i-copy3
																																																																																																																																										</span></div>
																																																																																																																																										<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																											<i class="i i-paste"></i><span class="icon-class">i i-paste
																																																																																																																																											</span></div>
																																																																																																																																											<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																												<i class="i i-spinner"></i><span class="icon-class">i i-spinner
																																																																																																																																												</span></div>
																																																																																																																																												<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																													<i class="i i-plus"></i><span class="icon-class">i i-plus
																																																																																																																																													</span></div>
																																																																																																																																													<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																														<i class="i i-minus"></i><span class="icon-class">i i-minus
																																																																																																																																														</span></div>
																																																																																																																																														<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																															<i class="i i-cancel"></i><span class="icon-class">i i-cancel
																																																																																																																																															</span></div>
																																																																																																																																															<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																<i class="i i-images"></i><span class="icon-class">i i-images
																																																																																																																																																</span></div>
																																																																																																																																																<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																	<i class="i i-logout"></i><span class="icon-class">i i-logout
																																																																																																																																																	</span></div>
																																																																																																																																																	<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																		<i class="i i-login"></i><span class="icon-class">i i-login
																																																																																																																																																		</span></div>
																																																																																																																																																		<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																			<i class="i i-infinity"></i><span class="icon-class">i i-infinity
																																																																																																																																																			</span></div>
																																																																																																																																																			<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																				<i class="i i-docs"></i><span class="icon-class">i i-docs
																																																																																																																																																				</span></div>
																																																																																																																																																				<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																					<i class="i i-landscape"></i><span class="icon-class">i i-landscape
																																																																																																																																																					</span></div>
																																																																																																																																																					<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																						<i class="i i-portrait"></i><span class="icon-class">i i-portrait
																																																																																																																																																						</span></div>
																																																																																																																																																						<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																							<i class="i i-share"></i><span class="icon-class">i i-share
																																																																																																																																																							</span></div>
																																																																																																																																																							<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																								<i class="i i-youtube"></i><span class="icon-class">i i-youtube
																																																																																																																																																								</span></div>
																																																																																																																																																								<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																									<i class="i i-checkmark"></i><span class="icon-class">i i-checkmark
																																																																																																																																																									</span></div>
																																																																																																																																																									<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																										<i class="i i-notice"></i><span class="icon-class">i i-notice
																																																																																																																																																										</span></div>
																																																																																																																																																										<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																											<i class="i i-link"></i><span class="icon-class">i i-link
																																																																																																																																																											</span></div>
																																																																																																																																																											<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																												<i class="i i-link2"></i><span class="icon-class">i i-link2
																																																																																																																																																												</span></div>
																																																																																																																																																												<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																													<i class="i i-popup"></i><span class="icon-class">i i-popup
																																																																																																																																																													</span></div>
																																																																																																																																																													<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																														<i class="i i-publish"></i><span class="icon-class">i i-publish
																																																																																																																																																														</span></div>
																																																																																																																																																														<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																															<i class="i i-browser"></i><span class="icon-class">i i-browser
																																																																																																																																																															</span></div>
																																																																																																																																																															<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																<i class="i i-checkmark2"></i><span class="icon-class">i i-checkmark2
																																																																																																																																																																</span></div>
																																																																																																																																																																<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																	<i class="i i-cross2"></i><span class="icon-class">i i-cross2
																																																																																																																																																																	</span></div>
																																																																																																																																																																	<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																		<i class="i i-question2"></i><span class="icon-class">i i-question2
																																																																																																																																																																		</span></div>
																																																																																																																																																																		<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																			<i class="i i-info2"></i><span class="icon-class">i i-info2
																																																																																																																																																																			</span></div>
																																																																																																																																																																			<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																				<i class="i i-loop"></i><span class="icon-class">i i-loop
																																																																																																																																																																				</span></div>
																																																																																																																																																																				<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																					<i class="i i-retweet"></i><span class="icon-class">i i-retweet
																																																																																																																																																																					</span></div>
																																																																																																																																																																					<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																						<i class="i i-arrow"></i><span class="icon-class">i i-arrow
																																																																																																																																																																						</span></div>
																																																																																																																																																																						<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																							<i class="i i-arrow2"></i><span class="icon-class">i i-arrow2
																																																																																																																																																																							</span></div>
																																																																																																																																																																							<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																								<i class="i i-shuffle"></i><span class="icon-class">i i-shuffle
																																																																																																																																																																								</span></div>
																																																																																																																																																																								<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																									<i class="i i-ccw"></i><span class="icon-class">i i-ccw
																																																																																																																																																																									</span></div>
																																																																																																																																																																									<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																										<i class="i i-cycle"></i><span class="icon-class">i i-cycle
																																																																																																																																																																										</span></div>
																																																																																																																																																																										<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																											<i class="i i-cw"></i><span class="icon-class">i i-cw
																																																																																																																																																																											</span></div>
																																																																																																																																																																											<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																												<i class="i i-switch"></i><span class="icon-class">i i-switch
																																																																																																																																																																												</span></div>
																																																																																																																																																																												<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																													<i class="i i-back"></i><span class="icon-class">i i-back
																																																																																																																																																																													</span></div>                                
																																																																																																																																																																													<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																														<i class="i i-code"></i><span class="icon-class">i i-code
																																																																																																																																																																														</span></div>
																																																																																																																																																																														<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																															<i class="i i-vcard"></i><span class="icon-class">i i-vcard
																																																																																																																																																																															</span></div>
																																																																																																																																																																															<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																<i class="i i-googleplus"></i><span class="icon-class">i i-googleplus
																																																																																																																																																																																</span></div>
																																																																																																																																																																																<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																	<i class="i i-facebook"></i><span class="icon-class">i i-facebook
																																																																																																																																																																																	</span></div>
																																																																																																																																																																																	<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																		<i class="i i-twitter"></i><span class="icon-class">i i-twitter
																																																																																																																																																																																		</span></div>
																																																																																																																																																																																		<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																			<i class="i i-rss"></i><span class="icon-class">i i-rss
																																																																																																																																																																																			</span></div>
																																																																																																																																																																																			<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																				<i class="i i-signal"></i><span class="icon-class">i i-signal
																																																																																																																																																																																				</span></div>
																																																																																																																																																																																				<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																					<i class="i i-flow-tree"></i><span class="icon-class">i i-flow-tree
																																																																																																																																																																																					</span></div>
																																																																																																																																																																																					<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																						<i class="i i-domain3"></i><span class="icon-class">i i-domain3
																																																																																																																																																																																						</span></div>
																																																																																																																																																																																						<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																							<i class="i i-trashcan"></i><span class="icon-class">i i-trashcan
																																																																																																																																																																																							</span></div>
																																																																																																																																																																																							<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																								<i class="i i-book"></i><span class="icon-class">i i-book
																																																																																																																																																																																								</span></div>
																																																																																																																																																																																								<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																									<i class="i i-bars"></i><span class="icon-class">i i-bars
																																																																																																																																																																																									</span></div>
																																																																																																																																																																																									<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																										<i class="i i-stopwatch"></i><span class="icon-class">i i-stopwatch
																																																																																																																																																																																										</span></div>
																																																																																																																																																																																										<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																											<i class="i i-map2"></i><span class="icon-class">i i-map2
																																																																																																																																																																																											</span></div>
																																																																																																																																																																																											<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																												<i class="i i-checkmark"></i><span class="icon-class">i i-checkmark
																																																																																																																																																																																												</span></div>
																																																																																																																																																																																												<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																													<i class="i i-sun"></i><span class="icon-class">i i-sun
																																																																																																																																																																																													</span></div>
																																																																																																																																																																																													<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																														<i class="i i-clip"></i><span class="icon-class">i i-clip
																																																																																																																																																																																														</span></div>
																																																																																																																																																																																														<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																															<i class="i i-study"></i><span class="icon-class">i i-study
																																																																																																																																																																																															</span></div>
																																																																																																																																																																																															<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																<i class="i i-music"></i><span class="icon-class">i i-music
																																																																																																																																																																																																</span></div>
																																																																																																																																																																																																<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																	<i class="i i-params"></i><span class="icon-class">i i-params
																																																																																																																																																																																																	</span></div>
																																																																																																																																																																																																	<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																		<i class="i i-stack3"></i><span class="icon-class">i i-stack3
																																																																																																																																																																																																		</span></div>
																																																																																																																																																																																																		<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																			<i class="i i-arrow-down"></i><span class="icon-class">i i-arrow-down
																																																																																																																																																																																																			</span></div>
																																																																																																																																																																																																			<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																				<i class="i i-arrow-down-left"></i><span class="icon-class">i i-arrow-down-left
																																																																																																																																																																																																				</span></div>
																																																																																																																																																																																																				<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																					<i class="i i-arrow-down-right"></i><span class="icon-class">i i-arrow-down-right
																																																																																																																																																																																																					</span></div>
																																																																																																																																																																																																					<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																						<i class="i i-arrow-left"></i><span class="icon-class">i i-arrow-left
																																																																																																																																																																																																						</span></div>
																																																																																																																																																																																																						<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																							<i class="i i-arrow-right"></i><span class="icon-class">i i-arrow-right
																																																																																																																																																																																																							</span></div>
																																																																																																																																																																																																							<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																								<i class="i i-arrow-up-right"></i><span class="icon-class">i i-arrow-up-right
																																																																																																																																																																																																								</span></div>
																																																																																																																																																																																																								<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																									<i class="i i-arrow-up"></i><span class="icon-class">i i-arrow-up
																																																																																																																																																																																																									</span></div>
																																																																																																																																																																																																									<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																										<i class="i i-arrow-up-left"></i><span class="icon-class">i i-arrow-up-left
																																																																																																																																																																																																										</span></div>
																																																																																																																																																																																																										<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																											<i class="i i-compass"></i><span class="icon-class">i i-compass
																																																																																																																																																																																																											</span></div>
																																																																																																																																																																																																											<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																												<i class="i i-users3"></i><span class="icon-class">i i-users3
																																																																																																																																																																																																												</span></div>
																																																																																																																																																																																																												<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																													<i class="i i-user3"></i><span class="icon-class">i i-user3
																																																																																																																																																																																																													</span></div>
																																																																																																																																																																																																													<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																														<i class="i i-camera2"></i><span class="icon-class">i i-camera2
																																																																																																																																																																																																														</span></div>
																																																																																																																																																																																																														<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																															<i class="i i-file"></i><span class="icon-class">i i-file
																																																																																																																																																																																																															</span></div>
																																																																																																																																																																																																															<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																<i class="i i-file2"></i><span class="icon-class">i i-file2
																																																																																																																																																																																																																</span></div>
																																																																																																																																																																																																																<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																	<i class="i i-file-plus"></i><span class="icon-class">i i-file-plus
																																																																																																																																																																																																																	</span></div>
																																																																																																																																																																																																																	<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																		<i class="i i-file-minus"></i><span class="icon-class">i i-file-minus
																																																																																																																																																																																																																		</span></div>
																																																																																																																																																																																																																		<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																			<i class="i i-file-check"></i><span class="icon-class">i i-file-check
																																																																																																																																																																																																																			</span></div>
																																																																																																																																																																																																																			<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																				<i class="i i-file-remove"></i><span class="icon-class">i i-file-remove
																																																																																																																																																																																																																				</span></div>
																																																																																																																																																																																																																				<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																					<i class="i i-file-copy"></i><span class="icon-class">i i-file-copy
																																																																																																																																																																																																																					</span></div>
																																																																																																																																																																																																																					<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																						<i class="i i-stack2"></i><span class="icon-class">i i-stack2
																																																																																																																																																																																																																						</span></div>
																																																																																																																																																																																																																						<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																							<i class="i i-folder"></i><span class="icon-class">i i-folder
																																																																																																																																																																																																																							</span></div>
																																																																																																																																																																																																																							<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																								<i class="i i-folder-upload"></i><span class="icon-class">i i-folder-upload
																																																																																																																																																																																																																								</span></div>
																																																																																																																																																																																																																								<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																									<i class="i i-folder-download"></i><span class="icon-class">i i-folder-download
																																																																																																																																																																																																																									</span></div>
																																																																																																																																																																																																																									<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																										<i class="i i-folder-minus"></i><span class="icon-class">i i-folder-minus
																																																																																																																																																																																																																										</span></div>
																																																																																																																																																																																																																										<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																											<i class="i i-folder-plus"></i><span class="icon-class">i i-folder-plus
																																																																																																																																																																																																																											</span></div>
																																																																																																																																																																																																																											<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																												<i class="i i-folder2"></i><span class="icon-class">i i-folder2
																																																																																																																																																																																																																												</span></div>
																																																																																																																																																																																																																												<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																													<i class="i i-folder-open"></i><span class="icon-class">i i-folder-open
																																																																																																																																																																																																																													</span></div>
																																																																																																																																																																																																																													<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																														<i class="i i-tag2"></i><span class="icon-class">i i-tag2
																																																																																																																																																																																																																														</span></div>
																																																																																																																																																																																																																														<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																															<i class="i i-cart"></i><span class="icon-class">i i-cart
																																																																																																																																																																																																																															</span></div>
																																																																																																																																																																																																																															<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																<i class="i i-phone"></i><span class="icon-class">i i-phone
																																																																																																																																																																																																																																</span></div>
																																																																																																																																																																																																																																<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																	<i class="i i-phone2"></i><span class="icon-class">i i-phone2
																																																																																																																																																																																																																																	</span></div>
																																																																																																																																																																																																																																	<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																		<i class="i i-local"></i><span class="icon-class">i i-local
																																																																																																																																																																																																																																		</span></div>
																																																																																																																																																																																																																																		<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																			<i class="i i-alarm"></i><span class="icon-class">i i-alarm
																																																																																																																																																																																																																																			</span></div>
																																																																																																																																																																																																																																			<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																				<i class="i i-clock"></i><span class="icon-class">i i-clock
																																																																																																																																																																																																																																				</span></div>
																																																																																																																																																																																																																																				<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																					<i class="i i-history"></i><span class="icon-class">i i-history
																																																																																																																																																																																																																																					</span></div>
																																																																																																																																																																																																																																					<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																						<i class="i i-stopclock"></i><span class="icon-class">i i-stopclock
																																																																																																																																																																																																																																						</span></div>
																																																																																																																																																																																																																																						<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																							<i class="i i-rotate"></i><span class="icon-class">i i-rotate
																																																																																																																																																																																																																																							</span></div>
																																																																																																																																																																																																																																							<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																								<i class="i i-rotate2"></i><span class="icon-class">i i-rotate2
																																																																																																																																																																																																																																								</span></div>
																																																																																																																																																																																																																																								<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																									<i class="i i-redo"></i><span class="icon-class">i i-redo
																																																																																																																																																																																																																																									</span></div>
																																																																																																																																																																																																																																									<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																										<i class="i i-undo"></i><span class="icon-class">i i-undo
																																																																																																																																																																																																																																										</span></div>                
																																																																																																																																																																																																																																										<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																											<i class="i i-chat"></i><span class="icon-class">i i-chat
																																																																																																																																																																																																																																											</span></div>
																																																																																																																																																																																																																																											<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																												<i class="i i-chat2"></i><span class="icon-class">i i-chat2
																																																																																																																																																																																																																																												</span></div>
																																																																																																																																																																																																																																												<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																													<i class="i i-chat3"></i><span class="icon-class">i i-chat3
																																																																																																																																																																																																																																													</span></div>
																																																																																																																																																																																																																																													<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																														<i class="i i-data2"></i><span class="icon-class">i i-data2
																																																																																																																																																																																																																																														</span></div>
																																																																																																																																																																																																																																														<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																															<i class="i i-spin"></i><span class="icon-class">i i-spin
																																																																																																																																																																																																																																															</span></div>
																																																																																																																																																																																																																																															<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																<i class="i i-health2"></i><span class="icon-class">i i-health2
																																																																																																																																																																																																																																																</span></div>
																																																																																																																																																																																																																																																<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																	<i class="i i-cog2"></i><span class="icon-class">i i-cog2
																																																																																																																																																																																																																																																	</span></div>
																																																																																																																																																																																																																																																	<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																		<i class="i i-bulb"></i><span class="icon-class">i i-bulb
																																																																																																																																																																																																																																																		</span></div>
																																																																																																																																																																																																																																																		<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																			<i class="i i-rating"></i><span class="icon-class">i i-rating
																																																																																																																																																																																																																																																			</span></div>
																																																																																																																																																																																																																																																			<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																				<i class="i i-rating2"></i><span class="icon-class">i i-rating2
																																																																																																																																																																																																																																																				</span></div>
																																																																																																																																																																																																																																																				<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																					<i class="i i-rating3"></i><span class="icon-class">i i-rating3
																																																																																																																																																																																																																																																					</span></div>
																																																																																																																																																																																																																																																					<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																						<i class="i i-grid"></i><span class="icon-class">i i-grid
																																																																																																																																																																																																																																																						</span></div>
																																																																																																																																																																																																																																																						<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																							<i class="i i-grid2"></i><span class="icon-class">i i-grid2
																																																																																																																																																																																																																																																							</span></div>
																																																																																																																																																																																																																																																							<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																								<i class="i i-grid3"></i><span class="icon-class">i i-grid3
																																																																																																																																																																																																																																																								</span></div>
																																																																																																																																																																																																																																																								<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																									<i class="i i-ellipsis"></i><span class="icon-class">i i-ellipsis
																																																																																																																																																																																																																																																									</span></div>
																																																																																																																																																																																																																																																									<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																										<i class="i i-dot"></i><span class="icon-class">i i-dot
																																																																																																																																																																																																																																																										</span></div>
																																																																																																																																																																																																																																																										<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																											<i class="i i-dots"></i><span class="icon-class">i i-dots
																																																																																																																																																																																																																																																											</span></div>
																																																																																																																																																																																																																																																											<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																												<i class="i i-bar"></i><span class="icon-class">i i-bar
																																																																																																																																																																																																																																																												</span></div>
																																																																																																																																																																																																																																																												<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																													<i class="i i-bar2"></i><span class="icon-class">i i-bar2
																																																																																																																																																																																																																																																													</span></div>
																																																																																																																																																																																																																																																													<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																														<i class="i i-bars3"></i><span class="icon-class">i i-bars3
																																																																																																																																																																																																																																																														</span></div>                
																																																																																																																																																																																																																																																														<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																															<i class="i i-menu"></i><span class="icon-class">i i-menu
																																																																																																																																																																																																																																																															</span></div>
																																																																																																																																																																																																																																																															<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																																<i class="i i-menu2"></i><span class="icon-class">i i-menu2
																																																																																																																																																																																																																																																																</span></div>
																																																																																																																																																																																																																																																																<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																																	<i class="i i-download2"></i><span class="icon-class">i i-download2
																																																																																																																																																																																																																																																																	</span></div>
																																																																																																																																																																																																																																																																	<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																																		<i class="i i-upload2"></i><span class="icon-class">i i-upload2
																																																																																																																																																																																																																																																																		</span></div>
																																																																																																																																																																																																																																																																		<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																																			<i class="i i-eye"></i><span class="icon-class">i i-eye
																																																																																																																																																																																																																																																																			</span></div>
																																																																																																																																																																																																																																																																			<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																																				<i class="i i-eye-slash"></i><span class="icon-class">i i-eye-slash
																																																																																																																																																																																																																																																																				</span></div>
																																																																																																																																																																																																																																																																				<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																																					<i class="i i-bookmark"></i><span class="icon-class">i i-bookmark
																																																																																																																																																																																																																																																																					</span></div>
																																																																																																																																																																																																																																																																					<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																																						<i class="i i-up"></i><span class="icon-class">i i-up
																																																																																																																																																																																																																																																																						</span></div>
																																																																																																																																																																																																																																																																						<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																																							<i class="i i-right"></i><span class="icon-class">i i-right
																																																																																																																																																																																																																																																																							</span></div>
																																																																																																																																																																																																																																																																							<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																																								<i class="i i-down"></i><span class="icon-class">i i-down
																																																																																																																																																																																																																																																																								</span></div>
																																																																																																																																																																																																																																																																								<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																																									<i class="i i-left"></i><span class="icon-class">i i-left
																																																																																																																																																																																																																																																																									</span></div>
																																																																																																																																																																																																																																																																									<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																																										<i class="i i-check"></i><span class="icon-class">i i-check
																																																																																																																																																																																																																																																																										</span></div>
																																																																																																																																																																																																																																																																										<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																																											<i class="i i-checked"></i><span class="icon-class">i i-checked
																																																																																																																																																																																																																																																																											</span></div>
																																																																																																																																																																																																																																																																											<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																																												<i class="i i-popout"></i><span class="icon-class">i i-popout
																																																																																																																																																																																																																																																																												</span></div>
																																																																																																																																																																																																																																																																												<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																																													<i class="i i-newtab"></i><span class="icon-class">i i-newtab
																																																																																																																																																																																																																																																																													</span></div>
																																																																																																																																																																																																																																																																													<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																																														<i class="i i-map"></i><span class="icon-class">i i-map
																																																																																																																																																																																																																																																																														</span></div>
																																																																																																																																																																																																																																																																														<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																																															<i class="i i-layer"></i><span class="icon-class">i i-layer
																																																																																																																																																																																																																																																																															</span></div>
																																																																																																																																																																																																																																																																															<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																																																<i class="i i-layer2"></i><span class="icon-class">i i-layer2
																																																																																																																																																																																																																																																																																</span></div>
																																																																																																																																																																																																																																																																																<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																																																	<i class="i i-like"></i><span class="icon-class">i i-like
																																																																																																																																																																																																																																																																																	</span></div>
																																																																																																																																																																																																																																																																																	<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																																																		<i class="i i-dislike"></i><span class="icon-class">i i-dislike
																																																																																																																																																																																																																																																																																		</span></div>
																																																																																																																																																																																																																																																																																		<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																																																			<i class="i i-football"></i><span class="icon-class">i i-football
																																																																																																																																																																																																																																																																																			</span></div>
																																																																																																																																																																																																																																																																																			<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																																																				<i class="i i-hexagon-o"></i><span class="icon-class">i i-hexagon-o
																																																																																																																																																																																																																																																																																				</span></div>
																																																																																																																																																																																																																																																																																				<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																																																					<i class="i i-hexagon"></i><span class="icon-class">i i-hexagon
																																																																																																																																																																																																																																																																																					</span></div>
																																																																																																																																																																																																																																																																																					<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																																																						<i class="i i-hexagon2-o"></i><span class="icon-class">i i-hexagon2-o
																																																																																																																																																																																																																																																																																						</span></div>
																																																																																																																																																																																																																																																																																						<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																																																							<i class="i i-hexagon2"></i><span class="icon-class">i i-hexagon2
																																																																																																																																																																																																																																																																																							</span></div>
																																																																																																																																																																																																																																																																																							<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																																																								<i class="i i-circle-o"></i><span class="icon-class">i i-circle-o
																																																																																																																																																																																																																																																																																								</span></div>
																																																																																																																																																																																																																																																																																								<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																																																									<i class="i i-circle"></i><span class="icon-class">i i-circle
																																																																																																																																																																																																																																																																																									</span></div>
																																																																																																																																																																																																																																																																																									<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																																																										<i class="i i-circle-sm-o"></i><span class="icon-class">i i-circle-sm-o
																																																																																																																																																																																																																																																																																										</span></div>
																																																																																																																																																																																																																																																																																										<div class="col-md-3 col-sm-4 icon-container">
																																																																																																																																																																																																																																																																																											<i class="i i-circle-sm"></i><span class="icon-class">i i-circle-sm
																																																																																																																																																																																																																																																																																											</span></div>
																																																																																																																																																																																																																																																																																										</div>

																																																																																																																																																																																																																																																																																									</section>


																																																																																																																																																																																																																																																																																								</div>
																																																																																																																																																																																																																																																																																							</div>
																																																																																																																																																																																																																																																																																						</div>
																																																																																																																																																																																																																																																																																						<div class="modal-footer">
																																																																																																																																																																																																																																																																																						</div>
																																																																																																																																																																																																																																																																																					</div><!-- /.modal-content -->
																																																																																																																																																																																																																																																																																				</div><!-- /.modal-dialog -->
																																																																																																																																																																																																																																																																																			</div><!-- /.modal -->
