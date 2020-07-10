<?php
class Uploads {

    private $ci;
    private $imageLocation = './assets/upload/';
    private $allowedType = 'xlsx';
    private $name = 'data_peserta';

    function __construct() {
        $this->ci = & get_instance();
    }

    function setLocation($location)
    {
        $this->imageLocation = $location;

        return $this;
    }

    function setType($type)
    {
        $this->allowedType = $type;

        return $this;
    }

    function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    function uploadImage($uploadName, $required = false)
    {
        $config['upload_path'] = $this->imageLocation;
        $config['allowed_types'] = $this->allowedType;
        $config['max_size'] = '1000';
        $config['encrypt_name'] = TRUE;

        $this->ci->load->library('Handle_file', $config);

        if(!$this->ci->handle_file->do_upload($uploadName))
        {
            if (!$required) 
            {
                if ($_FILES[$uploadName]['name'] == '') 
                {
                    return (object)array('status' => true, 'message' =>  null, 'imageName' => null);
                }
            }

            return (object)array('status' => false, 'message' =>  $this->ci->handle_file->display_errors(), 'imageName' => null);
        }
        else
        {
            $image = $this->ci->handle_file->data();
            $imageName = $image['file_name'];
            // $this->compressImage($imageName);

            return (object)array('status' => 'error', 'message' =>  'Berhasil menambahkan foto', 'imageName' => $imageName);
        }
    }

    function uploadFile($uploadName, $required = false)
    {
        $config['allowed_types'] = $this->allowedType;
        $config['upload_path'] = $this->imageLocation;
        $config['file_name'] = $this->name;
        $config['overwrite'] = TRUE;

        $this->ci->load->library('upload', $config);

        if(!$this->ci->upload->do_upload($uploadName))
        {
            if (!$required) 
            {
                if ($_FILES[$uploadName]['name'] == '') 
                {
                    return (object)array('status' => true, 'message' =>  null, 'imageName' => null);
                }
            }
           
            return (object)array('status' => false, 'message' =>  $this->ci->upload->display_errors(), 'imageName' => null);

        }
        else
        {
            $image = $this->ci->upload->data();
            $imageName = $image['file_name'];

            return (object)array('status' => true, 'message' =>  'Berhasil menambahkan file', 'imageName' => $imageName);
        }
    }

    function compressImage($imageName)
    {
        $config['image_library']    = 'gd2';
        $config['source_image']     = $this->imageLocation.$imageName;
        $config['new_image']        = $this->imageLocation.$imageName;
        $config['create_thumb']     = FALSE;
        $config['maintain_ratio']   = TRUE;
        $config['quality']          = '100%';
        $config['width']            = 500;
        $config['height']           = 500;

        $this->ci->load->library('image_lib', $config);
        $this->ci->image_lib->resize();
        $this->ci->image_lib->clear();
    }

}
