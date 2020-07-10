<?php
//untuk mengetahui bulan bulan
if ( ! function_exists('custom_input'))
{
    function custom_input($name, $type, $label = 'Default', $vertical = 'horizontal', $config = array())
    {
    	$required = isset($config['required'])?'<span class="text-danger">*</span>':'';

    	if ($vertical == 'horizontal') 
    	{
	        return '<div class="form-group">
						<label class="col-lg-3 control-label">'.$label.' '.$required.'</label>
						<div class="col-lg-9">
							<input type="'.$type.'" name="'.$name.'" class="form-control" placeholder="'.@$config['placeholder'].'">
							<span class="help-block m-b-none cleanError '.$name.'"></span>
						</div>
					</div>';
    	}
    	else
    	{
    		return '<div class="form-group">
                      <label class="control-label">'.$label.' '.$required.'</label>
                      <input type="'.$type.'" name="'.$name.'" class="form-control" placeholder="'.@$config['placeholder'].'"">
                      <div>
                      	<span class="help-block m-b-none cleanError '.$name.'"></span>
                      </div>
                    </div>';
    	}

    }
}

if ( ! function_exists('custom_radio'))
{
    function custom_radio($variable = array(), $name, $type, $label = 'Default', $vertical = 'horizontal', $config = array())
    {
    	$required = isset($config['required'])?'<span class="text-danger">*</span>':'';

    	$text = '';

    	foreach ($variable as $key => $value) {
    		$text .= '<div class="radio i-checks"> <label> <input  type="'.$type.'" name="'.$name.'" value="'.$key.'"> <i></i> '.$value.' </label> 
                                </div>';
    	}

    	if ($vertical == 'horizontal') 
    	{
	        return '<div class="form-group">
                      <label class="col-sm-3 control-label">'.$label.' '.$required.'</label>
                      <div class="col-sm-9">
                        '.$text.'
                      	<span class="help-block m-b-none cleanError '.$name.'"></span>
                      </div>
                    </div>';
    	}
    	else
    	{
    		return '<div class="form-group">
                      <label class="control-label">'.$label.' '.$required.'</label>
                      <div>
                        '.$text.'
                      	<span class="help-block m-b-none cleanError '.$name.'"></span>
                      </div>
                    </div>';

    	}

    }
}
 
?>