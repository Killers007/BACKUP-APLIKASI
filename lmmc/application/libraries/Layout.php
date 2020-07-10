<?php
class Layout
{
    private $ci;
    function __construct()
    {
        $this->ci = &get_instance();;
    }
    public $header = 'template/header';
    public $footer = 'template/footer';

    function render($view, $data = null, $menu = NULL)
    {
        $_jalur = $this->jalurAktif();

        if (empty($_jalur)) 
        {
            $_resJalur = '<span class="label label-warning">Setting jalur terlebih dahulu</span>';

            if (str_replace('index.php/', '', current_url()) != base_url('jalur_masuk')) 
            {
                redirect(base_url('jalur_masuk'));
            }
        }
        else
        {
            $_resJalur = @("{$_jalur->jalurNama} -  {$_jalur->jalurTahun}");
        }

        $data['menu'] = $this->menuDb();

        // echo "<pre>";
        // print_r($data['menu']);
        // echo "</pre>";exit;

        $data['jalur'] =$_resJalur;

        $this->ci->load->view($this->header, $data);
        $this->ci->load->view($view);
        $this->ci->load->view($this->footer);
    }

    function cek_tanggal_periksa()
    {
        $this->ci->db->where("pesertaNoregis", $this->ci->session->user['noregis']);
        $this->ci->db->where("pesertaTanggalperiksa < DATE(NOW())");
        return $this->ci->db->get('lmmc_m_peserta')->num_rows();
    }

    function mechapp_render($view, $data = null, $menu = null)
    {
        $header = 'template/mechapp/header';
        $footer = 'template/mechapp/footer';
        $data['changeAsuransi'] = false;$this->cek_tanggal_periksa();

        $this->ci->load->view($header, $data);
        $this->ci->load->view($view);
        $this->ci->load->view($footer);
    }

    function dokter_render($view, $data = null, $menu = null)
    {
        $header = 'template/dokter/header';
        $footer = 'template/dokter/footer';
        $data['menus'] = $this->menu();

        $this->ci->load->view($header, $data);
        $this->ci->load->view($view);
        $this->ci->load->view($footer);
    }

    private function menu()
    {
        $sess = $this->ci->session->userdata('user');

        if ($sess['role'] == 'dokter') 
        {
            return array(
                array(
                    'label' => 'Dashboard',
                    'link' => 'dashboard',
                    'method' => 'dashboard',
                ),
                array(
                    'label' => 'Jadwal Jaga',
                    'link' => 'jadwal',
                    'method' => 'jadwal',
                ),
                array(
                    'label' => 'Hasil Pemeriksaan',
                    'link' => 'hasil_pemeriksaan',
                    'method' => 'hasil_pemeriksaan',
                ),
                array(
                    'label' => 'Ganti Password',
                    'link' => 'ganti_password',
                    'method' => 'ganti_password',
                ),
                array(
                    'label' => 'Logout',
                    'link' => 'logout',
                    'method' => 'logout',
                ),
            );
        } 
        else
        {
            return array(
                // array(
                //     'label' => 'Login',
                //     'link' => 'index',
                //     'method' => 'index',
                // ),
            );
        }
    }

    function renderPartial($view, $data = null)
    {
        $this->ci->load->view($view, $data);
    }

    function makeNested($source) 
    {
        $nested = array();

        foreach ( $source as &$s ) {
            if ( is_null($s['navParentid']) ) {
                $nested[] = &$s;
            }
            else {
                $pid = $s['navParentid'];
                if ( isset($source[$pid]) ) {

                    if ( !isset($source[$pid]['child']) ) {
                        $source[$pid]['child'] = array();
                    }

                    $source[$pid]['child'][] = &$s;
                }
            }
        }
        return $nested;
    }

    private function menuDb($role = 'admin')
    {
        $role = $this->ci->session->user['role'];
        $this->ci->db->select('navNama as label, navIcon as icon, navUrl as url, navId, navParentid, navModul as modules');
        $this->ci->db->join('hak_akses', 'modul = navModul', 'left');


        if ($role != 'superadmin')
        {
            $this->ci->db->group_start();
            $this->ci->db->where('role', $role);
            $this->ci->db->where('hak', 'BACA');
            $this->ci->db->group_end();
        }
        else
        {
            $this->ci->db->or_where('navModul !=', '');
        }

        $this->ci->db->or_where('navModul', '');

        $this->ci->db->order_by('navSort', 'asc');
        $data = $this->ci->db->get('lmmc_nav')->result_array();
        
        $res = [];

        foreach ($data as $key => $value) {
            $res[$value['navId']] = $value;
        }
    
        return $this->makeNested($res);

        // foreach ($data as $key => $value) {
        //     $_temp = [];

        //     $_temp = array(
        //         'label' => $value->navNama,
        //         'modules' => $value->navModul,
        //         'url' => $value->navUrl,
        //         'icon' => $value->navIcon,
        //     );

        //     if ($value->navParentid == null) {
        //         $res[$value->navId] = array_merge($_temp, ['child' => []]);
        //     } else {
        //         $res[$value->navParentid]['child'][$value->navId] = $_temp;
        //     }
        // }

        // return $res;
    }

    private function jalurAktif()
    {
        $this->ci->db->where('jalurIsactive', '1');
        return $this->ci->db->get('lmmc_m_jalur')->row();
    }

    const TEXTBOX   = 'textbox';
    const TEXTAREA  = 'textarea';
    const CHECKBOX  = 'checkbox';
    const DROPDOWN  = 'dropdown';

    /**
     * Tampung semua field input
     * @var string
     */
    public $_allFieldInput = '';

    /**
     * layout vertikal dan horizontal
     * @var string
     */
    private $_layout = 'vertical';

    function setVertical()
    {
        $this->_layout = 'vertical';
        return $this;
    }

    function setHorizontal()
    {
        $this->_layout = 'horizontal';
        return $this;
    }

    function getLayout()
    {
        return $this->_layout;
    }

    /**
     * [modifData description]
     * @param  [array] &$data [description]
     * @return [type]        [description]
     */
    function modifData(&$data)
    {
        $data['layout']         = $this->_layout;

        $data['inputType']      = @$data['inputType']?$data['inputType']:'textbox';
        $data['data']           = @$data['data']?$data['data']:array();
        $data['type']           = @$data['type']?$data['type']:'text';
        $data['field']          = @$data['field']?$data['field']:null;
        $data['placeholder']    = @$data['placeholder']?$data['placeholder']:'';
        $data['label']          = @$data['label']?$data['label']:'Default';
        $data['attribute']      = @$data['attribute']?$data['attribute']:array();
        $data['required']       = @strstr($data['rules'], 'required')?'<span class="text-danger">*</span>':'';
        $data['addon']          = @$data['addon']?@$data['addon']:NULL;
        $data['rounded']        = @$data['rounded']?'rounded':NULL;

        $this->_allFieldInput   .= $this->ci->load->view('template/form/input', $data, TRUE);

        return $this;
    }


    /**
     * Menambahkan textbox
     * Ex. $this->layout->addTextbox(['label' => 'Nama Jalur', 'field' => 'jalurNama', 'type' => 'text', 'required' => true]);
     * @param array $data [description]
     */
    function addTextbox($data = array())
    {
        $data['inputType'] = self::TEXTBOX;

        $this->modifData($data);
    }

    function addTextarea($data = array())
    {
        $data['inputType'] = self::TEXTAREA;

        $this->modifData($data);
    }

    function addCheckbox($data = array())
    {
        $data['inputType'] = self::CHECKBOX;
        
        $this->modifData($data);
    }

    function addDropdown($data = array())
    {
        $data['inputType'] = self::DROPDOWN;
        
        $this->modifData($data);
    }

    function generateForm($batch = null)
    {
        if (is_array($batch)) 
        {
            foreach ($batch as $key => $array) 
            {
                $this->modifData($array);
            }
        }

        return $this->_allFieldInput;
    }

}
