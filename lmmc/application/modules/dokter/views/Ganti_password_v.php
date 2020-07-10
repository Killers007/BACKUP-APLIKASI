<div class="arlo_tm_section" id="contact">
	<div class="arlo_tm_contact_wrapper_all">
		<div class="arlo_tm_contact">
			<div class="container">
				<div class="arlo_title_holder">
					<h3>Ganti Password</h3>
				</div>
				<div class="contact_inner">
					
					<div class="right wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay="0.2s">
						<form method="post" >
							<div class="input_wrap">
								<ul id="group-nama" class="form-group">
                                    <b>Password lama</b>
                                    <li class="kt-input-icon">
                                        <input name="password" type="text" placeholder="Password Lama" /><br>
                                        <div class="cleanError password alert alert-danger hide" hide style="margin: 0px; display: block;">

                                        </div>
                                    </li>
                                </ul>

								<ul id="group-nama" class="form-group">
                                    <b>Password Baru</b>
                                    <li class="kt-input-icon">
                                        <input name="new" type="password" placeholder="Password Baru" /><br>
                                        <div class="cleanError new alert alert-danger hide" hide style="margin: 0px; display: block;">

                                        </div>
                                    </li>
                                </ul>

								<ul id="group-nama" class="form-group">
                                    <b>Ulangi Password Baru</b>
                                    <li class="kt-input-icon">
                                        <input name="retype" type="password" placeholder="Ulangi Password Baru" /><br>
                                        <div class="cleanError retype alert alert-danger hide" hide style="margin: 0px; display: block;">

                                        </div>
                                    </li>
                                </ul>
								<div class="arlo_tm_button" data-color="pink">
									<a id="send_message" class="btnSimpan" href="#"><span>Submit</span>	</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
    
    $(document).ready(function() {

        $(document).on('click', '.btnSimpan', function(event) {
            event.preventDefault();

            var data = $('form').serialize();

            $.ajax({
                url: '<?php echo current_url() ?>',
                type: 'POST',
                dataType: 'JSON',
                data: data,
                beforeSend: function()
                {
                    btnLoading('.btnSimpan');
                    cleanError();
                },
                complete: function()
                {
                    btnNormal('.btnSimpan');
                },
                success: function(res)
                {
                    if (!res.status) 
                    {
                        getError(res)
                    }
                    else if (res.status == 'success')
                    {
                        window.location = '<?php echo base_url('dokter') ?>/dashboard';
                        toastr[res.status](res.message);
                    }
                    else
                    {
                        cleanError();
                        toastr[res.status](res.message);
                    }


                }
            })

        });

        function getError(data)
        {
            $.each(data.error, function(index, el) 
            {
                $('.'+index).html(el);
                $('.'+index).addClass('hide');

                if (el != '') 
                {
                    $('.'+index).removeClass('hide');
                }


            }); 
        }

        function cleanError()
        {
            $('.cleanError').html('');
            $('.cleanError').parent().removeClass('has-error');
            $('.cleanError').addClass('hide');
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

    });
</script>