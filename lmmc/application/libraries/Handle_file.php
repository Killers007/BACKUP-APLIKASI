<?php
require_once FCPATH . "system/libraries/Upload.php";

class Handle_file extends CI_Upload
{
	/**
	 * @var array
	 */
	public $allowed_mimes = array();

	public function do_download($filename)
	{
		//Sanitasi filename dari backslash folder
		$filename = basename($filename);
		$fullpath = $this->upload_path . $filename;

		if (file_exists($fullpath)) {
			$this->_file_mime_type(['tmp_name' => $fullpath, 'type' => 'none']);

			//Check allowed mime tidak boleh kosong
			if (count($this->allowed_mimes) == 0) {
				throw new ErrorException("Allowed Mime must defined !");
			}

			//Apakah mime dari file termasuk dalam whitelist
			if (!in_array($this->file_type, $this->allowed_mimes)) {
				$this->error_msg[] = "Mime file type is not allowed to download !";
				return false;
			}

			header('Content-Type: ' . $this->file_type);
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($fullpath));
			ob_end_flush();
			readfile($fullpath);
			return true;
		}
		$this->error_msg[] = "File does not exist!";
		return false;
	}

	/**
	 * Perform the file upload
	 *
	 * @param string $field
	 * @return    bool
	 */
	public function do_upload($field = 'userfile')
	{

		// Is $_FILES[$field] set? If not, no reason to continue.
		if (isset($_FILES[$field])) {
			$_file = $_FILES[$field];
		} // Does the field name contain array notation?
		elseif (($c = preg_match_all('/(?:^[^\[]+)|\[[^]]*\]/', $field, $matches)) > 1) {
			$_file = $_FILES;
			for ($i = 0; $i < $c; $i++) {
				// We can't track numeric iterations, only full field names are accepted
				if (($field = trim($matches[0][$i], '[]')) === '' OR !isset($_file[$field])) {
					$_file = NULL;
					break;
				}

				$_file = $_file[$field];
			}
		}


		if (!isset($_file)) {
			$this->set_error('upload_no_file_selected', 'debug');
			return FALSE;
		}

		// Is the upload path valid?
		if (!$this->validate_upload_path()) {
			// errors will already be set by validate_upload_path() so just return FALSE
			return FALSE;
		}

		// Was the file able to be uploaded? If not, determine the reason why.
		if (!is_uploaded_file($_file['tmp_name'])) {
			$error = isset($_file['error']) ? $_file['error'] : 4;

			switch ($error) {
				case UPLOAD_ERR_INI_SIZE:
					$this->set_error('upload_file_exceeds_limit', 'info');
					break;
				case UPLOAD_ERR_FORM_SIZE:
					$this->set_error('upload_file_exceeds_form_limit', 'info');
					break;
				case UPLOAD_ERR_PARTIAL:
					$this->set_error('upload_file_partial', 'debug');
					break;
				case UPLOAD_ERR_NO_FILE:
					$this->set_error('upload_no_file_selected', 'debug');
					break;
				case UPLOAD_ERR_NO_TMP_DIR:
					$this->set_error('upload_no_temp_directory', 'error');
					break;
				case UPLOAD_ERR_CANT_WRITE:
					$this->set_error('upload_unable_to_write_file', 'error');
					break;
				case UPLOAD_ERR_EXTENSION:
					$this->set_error('upload_stopped_by_extension', 'debug');
					break;
				default:
					$this->set_error('upload_no_file_selected', 'debug');
					break;
			}

			return FALSE;
		}

		// Set the uploaded data as class variables
		$this->file_temp = $_file['tmp_name'];
		$this->file_size = $_file['size'];

		// Skip MIME type detection?
		if ($this->detect_mime !== FALSE) {
			$this->_file_mime_type($_file);
		}

		$this->file_type = preg_replace('/^(.+?);.*$/', '\\1', $this->file_type);
		$this->file_type = strtolower(trim(stripslashes($this->file_type), '"'));
		$this->file_name = $this->_prep_filename($_file['name']);
		$this->file_ext = $this->get_extension($this->file_name);
		$this->client_name = $this->file_name;

		// Is the file type allowed to be uploaded?
		if (!$this->is_allowed_filetype()) {
			$this->set_error('upload_invalid_filetype', 'debug');
			return FALSE;
		}

		// if we're overriding, let's now make sure the new name and type is allowed
		if ($this->_file_name_override !== '') {
			$this->file_name = $this->_prep_filename($this->_file_name_override);

			// If no extension was provided in the file_name config item, use the uploaded one
			if (strpos($this->_file_name_override, '.') === FALSE) {
				$this->file_name .= $this->file_ext;
			} else {
				// An extension was provided, let's have it!
				$this->file_ext = $this->get_extension($this->_file_name_override);
			}

			if (!$this->is_allowed_filetype(TRUE)) {
				$this->set_error('upload_invalid_filetype', 'debug');
				return FALSE;
			}
		}

		// Convert the file size to kilobytes
		if ($this->file_size > 0) {
			$this->file_size = round($this->file_size / 1024, 2);
		}

		// Is the file size within the allowed maximum?
		if (!$this->is_allowed_filesize()) {
			$this->set_error('upload_invalid_filesize', 'info');
			return FALSE;
		}

		// Are the image dimensions within the allowed size?
		// Note: This can fail if the server has an open_basedir restriction.
		if (!$this->is_allowed_dimensions()) {
			$this->set_error('upload_invalid_dimensions', 'info');
			return FALSE;
		}

		// Sanitize the file name for security
		$this->file_name = $this->_CI->security->sanitize_filename($this->file_name);

		// Truncate the file name if it's too long
		if ($this->max_filename > 0) {
			$this->file_name = $this->limit_filename_length($this->file_name, $this->max_filename);
		}

		// Remove white spaces in the name
		if ($this->remove_spaces === TRUE) {
			$this->file_name = preg_replace('/\s+/', '_', $this->file_name);
		}

		if ($this->file_ext_tolower && ($ext_length = strlen($this->file_ext))) {
			// file_ext was previously lower-cased by a get_extension() call
			$this->file_name = substr($this->file_name, 0, -$ext_length) . $this->file_ext;
		}

		/*
		 * Validate the file name
		 * This function appends an number onto the end of
		 * the file if one with the same name already exists.
		 * If it returns false there was a problem.
		 */
		$this->orig_name = $this->file_name;
		if (FALSE === ($this->file_name = $this->set_filename($this->upload_path, $this->file_name))) {
			return FALSE;
		}

		/*
		 * Run the file through the XSS hacking filter
		 * This helps prevent malicious code from being
		 * embedded within a file. Scripts can easily
		 * be disguised as images or other file types.
		 */
		if ($this->xss_clean && $this->do_xss_clean() === FALSE) {
			$this->set_error('upload_unable_to_write_file', 'error');
			return FALSE;
		}

		// Is it an image?
		if ((strtolower($this->file_ext) == '.jpg' || strtolower($this->file_ext) == '.jpeg' || strtolower($this->file_ext) == '.png') &&
			($this->file_type == 'image/jpeg' || $this->file_type == 'image/png') && getimagesize($this->file_temp)) {

			// Strip any metadata, by re-encoding image (Note, using php-Imagick is recommended over php-GD)
			if ($this->file_type == 'image/jpeg') {
				$img = imagecreatefromjpeg($this->file_temp);
				imagejpeg($img, $this->file_temp, 100);
			} else {
				$img = imagecreatefrompng($this->file_temp);
				imagepng($img, $this->file_temp, 9);
			}
			imagedestroy($img);

			/*
			 * Move the file to the final destination
			 * To deal with different server configurations
			 * we'll attempt to use copy() first. If that fails
			 * we'll use move_uploaded_file(). One of the two should
			 * reliably work in most environments
			 */
			if (!@copy($this->file_temp, $this->upload_path . $this->file_name)) {
				if (!@move_uploaded_file($this->file_temp, $this->upload_path . $this->file_name)) {
					$this->set_error('upload_destination_error', 'error');
					return FALSE;
				}
			}

			// Delete any temp files
			if (file_exists($this->file_temp))
				unlink($this->file_temp);
		} else {
			if($this->is_image === false){
				if (!@copy($this->file_temp, $this->upload_path . $this->file_name)) {
					if (!@move_uploaded_file($this->file_temp, $this->upload_path . $this->file_name)) {
						$this->set_error('upload_destination_error', 'error');
						return FALSE;
					}
				}
			}else {
				$this->set_error('upload_invalid_filetype', 'error');
				return FALSE;
			}
		}


		/*
		 * Set the finalized image dimensions
		 * This sets the image width/height (assuming the
		 * file was an image). We use this information
		 * in the "data" function.
		 */
		$this->set_image_properties($this->upload_path . $this->file_name);

		return TRUE;
	}
}
