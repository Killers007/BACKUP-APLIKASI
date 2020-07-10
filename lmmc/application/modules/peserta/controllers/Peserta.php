<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * Description of MY_Controller
 *
 * @author azmi.adhani@ulm.ac.id
 */
class Peserta extends MY_Controller
{
    private $modul = 'peserta';

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Peserta_m", "db_mecha");
        $this->load->library('session');
    }

    public function index()
    {
        redirect(base_url('peserta/beranda'));
    }

    public function test()
    {
        // $this->layout->mechapp_render('test');
        $this->load->view('test');
    }

    public function get_session()
    {

        if ($this->session->userdata('user')) {
            $sess = $this->session->userdata('user');
            if ($sess['role'] !== 'peserta') {
                redirect(base_url('peserta/masuk'));
            } else if ($sess['role'] == 'peserta') {
                return $sess;
            }
        } else {
            redirect(base_url('peserta/masuk'));
        }
    }

    public function main()
    {
        // if (!$this->acl->cek_akses_module($this->role, $this->modul, 'baca')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);

        $sess = $this->get_session();

        $dt_peserta = $this->db_mecha->get_data_peserta($sess['noregis']);
        $package = [
            'dpes' => $dt_peserta,
            'navi' => $navi,
        ];

        // r($package);
        $this->layout->mechapp_render('Main_v', $package);
    }

    public function beranda()
    {

        // if (!$this->acl->cek_akses_module($this->role, $this->modul, 'baca')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);

        $navi = 'beranda';
        $sess = $this->get_session();

        $dt_peserta = $this->db_mecha->get_data_peserta($sess['noregis']);
        $package = [
            'dpes' => $dt_peserta,
            'navi' => $navi,
        ];

        // r($package);
        $this->layout->mechapp_render('Beranda_v', $package);
    }

    public function pengumuman()
    {
        // if (!$this->acl->cek_akses_module($this->role, $this->modul, 'baca')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);

        $navi = 'pengumuman';

        $sess = $this->get_session();

        $dt_peserta = $this->db_mecha->get_jalur_by_peserta($sess['noregis']);


        $package = [
            'db' => $dt_peserta,
            'navi' => $navi,
        ];

        // r($package);
        $this->layout->mechapp_render('Pengumuman_v', $package);
    }

    public function bio()
    {
        // if (!$this->acl->cek_akses_module($this->role, $this->modul, 'tulis')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);
        $navi = 'biodata';

        $sess = $tahis->get_session();
        $dt_peserta = $this->db_mecha->get_data_peserta($sess['noregis']);
        $package = [
            'dpes' => $dt_peserta,
            'navi' => $navi
        ];

        // r($package);
        $this->layout->mechapp_render('Biodata_v', $package);
    }

    public function bio_update()
    {
        // if (!$this->acl->cek_akses_module($this->role, $this->modul, 'tulis')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);
        // echo "<pre>";
        // print_r ($this->input->post());
        // echo "</pre>";
        // exit;
        $validasi = $this->db_mecha->bio_update();
        echo json_encode($validasi);
    }

    public function biodata()
    {
        // if (!$this->acl->cek_akses_module($this->role, $this->modul, 'tulis')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);

        $navi = 'biodata';
        $sess = $this->get_session();
        $dt_peserta_old = $this->db_mecha->get_data_peserta($sess['noregis']);
        $dt_peserta = (array) $dt_peserta_old;
        $input = $this->db_mecha->arr_input();

        if ($dt_peserta['pesertaTanggallahir']) {
            $dt_peserta['pesertaTanggallahir'] = strtotime($dt_peserta['pesertaTanggallahir']);
            $dt_peserta['pesertaTanggallahir'] = date('d-m-Y', $dt_peserta['pesertaTanggallahir']);
        }

        $package = [
            'dpes' => $dt_peserta,
            'navi' => $navi,
            'input' => $input,
            'tidaklengkap' => 0,
        ];

        if (
            !$dt_peserta_old->pesertaNama || !$dt_peserta_old->pesertaAlamat
            || !$dt_peserta_old->pesertaTempatlahir || !$dt_peserta_old->pesertaNohp
            || !$dt_peserta_old->pesertaFoto
        ) {
            $package['tidaklengkap'] = 1;
        }

        // r($package);
        $this->layout->mechapp_render('Bio_v2', $package);
    }

    public function panduan()
    {

        $navi = 'panduan';
        $package = [];
        $package['navi'] = $navi;

        $dt = $this->db_mecha->get_data_panduan();

        if (!$dt) {
            $this->layout->mechapp_render('Maintenance_v', $package);
            // return 0; // stop but still loading page
        } else {
            $package['dt'] = $dt;
            $this->layout->mechapp_render('Panduan_v', $package);
        }
    }
    function date_convert($tanggal = null, $format = 'Y-m-d')
    {
        // if (!$this->acl->cek_akses_module($this->role, $this->modul, 'baca')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);

        if ($tanggal == null) {
            $tanggal = date('Y-m-d');
        } else {
            $tanggal = date('Y-m-d H:i:s', strtotime($tanggal));
        }

        $hari = array(
            1 => 'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu'
        );

        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $split    = explode('-', $tanggal);

        $num = date('N', strtotime($tanggal));

        return $data = (object) array(
            'dayName' => $hari[$num],
            'monthName' => $bulan[intval($split[1])],
            'month' => intval($split[1]),
            'year' => intval($split[0]),
            'day' => intval($split[2]),
            'format' => date($format, strtotime($tanggal)),
            'default' => intval($split[2]) . ' ' . $bulan[intval($split[1])] . ' ' . intval($split[0]),
            'formatFull' => intval($split[2]) . ' ' . $bulan[intval($split[1])] . ' ' . intval($split[0]) . ', ' . date('h:i A', strtotime($tanggal)),
        );
    }

    function image($path = '', $fileName = '')
    {
        $this->load->library(
            'Handle_file',
            array(
                'upload_path' => $this->config->item($path),
                'allowed_mimes' => ['image/jpeg', 'image/png', 'image/jpg'],
            ),
            'handle'
        );

        echo $this->handle->do_download($fileName);
    }

    function file($path = '', $fileName = '')
    {
        // if (!$this->acl->cek_akses_module($this->role, $this->modul, 'baca')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);

        $this->load->library(
            'Handle_file',
            array(
                'upload_path' => $this->config->item($path),
                'allowed_mimes' => ['application/pdf'],
            ),
            'handle'
        );

        echo $this->handle->do_download($fileName);
    }

    public function administrasi()
    {
        // if (!$this->acl->cek_akses_module($this->role, $this->modul, 'baca')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);

        $navi = 'administrasi';
        $package = [];
        $sess = $this->get_session();
        $dt_peserta = $this->db_mecha->get_data_peserta($sess['noregis']);

        if (
            !$dt_peserta->pesertaNama || !$dt_peserta->pesertaAlamat || !$dt_peserta->pesertaTempatlahir
            || !$dt_peserta->pesertaNohp || !$dt_peserta->pesertaFoto
        ) {
            redirect(base_url('peserta/biodata/1'));
        }

        // if ($dt_peserta->pesertaIsBpjs || $dt_peserta->pesertaIsDanaSehat) {
        if ($dt_peserta->pesertaTanggalperiksa) {
            $tanggal = $this->date_convert($dt_peserta->pesertaTanggalperiksa);
        }

        $dt = $this->db_mecha->get_data_formNama();
        $form = $this->db_mecha->get_form($dt_peserta);
        $kategori = $this->db_mecha->get_kategori($dt_peserta);
        $biaya = $this->db_mecha->get_biaya($dt_peserta)->tagihanBiaya;
        $biaya = $this->db_mecha->convert_to_rupiah(round($biaya));
        $package = [
            'dt' => $form,
            'dt_pes' => $dt_peserta,
            'navi' => $navi,
            'biaya' => $biaya,
            'tanggal' => NULL,
            'mulaiBiaya' => date('d-m-Y H:i:s', strtotime($dt_peserta->tagihanWaktuberlaku)),
            'akhirBiaya' => date('d-m-Y H:i:s', strtotime($dt_peserta->tagihanWaktuberakhir)),
        ];

        if ($dt_peserta->pesertaTanggalperiksa) {
            $package['tanggal'] = $tanggal->dayName . ', ' . $tanggal->default;
        }

        if (!$biaya) {
            $this->layout->mechapp_render('Maintenance_v', $package);
        } else {
            $this->layout->mechapp_render('Administrasi_v', $package);
        }
        // } else {
        // redirect(base_url('peserta/asuransi_kesehatan'));
        // }



        // r($package);
    }

    public function hasil()
    {
        // ** Revisi 17 Maret 2020 : disable hasil
        show_error('Halaman tidak ditemukan');
        exit;

        $aksi_modul = 'baca';
        $navi = 'hasil';
        $package = [];
        $sess = $this->get_session();
        $dt_peserta = $this->db_mecha->get_data_peserta($sess['noregis']);
        $hasil = $this->db_mecha->get_hasil($sess['noregis']);

        if (
            !$dt_peserta->pesertaNama || !$dt_peserta->pesertaAlamat || !$dt_peserta->pesertaTempatlahir
            || !$dt_peserta->pesertaNohp || !$dt_peserta->pesertaFoto
        ) {
            redirect(base_url('peserta/biodata/1'));
        }

        $package = [
            'navi' => $navi,
            'peserta' => $dt_peserta,
            'hasil' => $hasil,
        ];

        $this->layout->mechapp_render('Hasil_v', $package);
    }

    function getFile($fileName = '')
    {
        // if (!$this->acl->cek_akses_module($this->role, $this->modul, 'baca')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);

        $this->load->library(
            'Handle_file',
            array(
                'upload_path' => $this->db_mecha->fileBPJS,
                'allowed_mimes' => ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'],
            ),
            'handle'
        );

        echo $this->handle->do_download($fileName);
    }

    public function asuransi_kesehatan()
    {
        // if (!$this->acl->cek_akses_module($this->role, $this->modul, 'tulis')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);

        if ($this->input->is_ajax_request()) {
            $isBpjs = $this->input->post('bpjs');
            $isDana = 0; //($isBpjs == 1)?0:1;
            $this->load->library('form_validation');

            $this->form_validation->set_error_delimiters('<span class="text-danger" ">', '</span>');
            $this->form_validation->set_rules($this->db_mecha->rulesBPJS($isBpjs));

            if (!$this->form_validation->run()) {
                $res = array();

                $res['status'] = false;

                foreach ($this->db_mecha->rulesBPJS($isBpjs) as $value) {

                    $res['error'][$value['field']] = form_error($value['field']);
                }

                echo json_encode($res);
            } else {
                $this->load->library('Uploads');
                $this->uploads->setLocation($this->db_mecha->fileBPJS);
                $this->uploads->setType('jpeg|png|pdf|jpg');

                $imageName = NULL;

                $image = $this->uploads->uploadImage('fileBpjs', $isBpjs);

                if (!$image->status) {
                    $res['status'] = false;

                    $res['error']['fileBpjs'] = $image->message;

                    echo json_encode($res);
                    exit;
                } else {
                    if ($isBpjs) {
                        $data['pesertaNoBpjs'] = $this->input->post('noBpjs');
                        $imageName = $image->imageName;
                    }
                }

                $data['pesertaIsBpjs'] = $isBpjs;
                $data['pesertaIsDanaSehat'] = $isDana;
                $data = $this->db_mecha->setBPJS($data, $imageName);

                echo json_encode($data);
            }
        } else {
            $aksi_modul = 'baca';
            $navi = 'asuransi_kesehatan';
            $package = [];
            $sess = $this->get_session();
            $dt_peserta = $this->db_mecha->get_data_peserta($sess['noregis']);

            if (
                !$dt_peserta->pesertaNama || !$dt_peserta->pesertaAlamat || !$dt_peserta->pesertaTempatlahir
                || !$dt_peserta->pesertaNohp || !$dt_peserta->pesertaFoto
            ) {
                redirect(base_url('peserta/biodata/1'));
            }

            $package = [
                'navi' => $navi,
                'peserta' => $dt_peserta,
            ];

            $this->layout->mechapp_render('Asuransi_kesehatan_v', $package);
        }
    }



    public function masuk()
    {
        if ($this->session->userdata('user')) {
            if ($this->session->user['role'] == 'dokter') {
                redirect(base_url('dokter/'));
            } else if ($this->session->userdata('user') !== 'peserta') {
                redirect(base_url('welcome'));
            } else if ($this->session->userdata('user') == 'peserta') {
                redirect(base_url('peserta/beranda'));
            }
        }
        $navi = 'masuk';

        $package = [
            'jalur_aktif' => $this->db_mecha->getJalurActive()->jalurNama,
            'navi' => $navi
        ];

        // r($package);
        $this->layout->mechapp_render('Masuk_v', $package);
    }

    public function masuk_request()
    {
        $validasi = $this->db_mecha->masuk_validasi();

        echo json_encode($validasi);
    }

    public function sess_check()
    {
        if (ENVIRONMENT == 'development') {
            echo "<pre>";
            print_r($this->session->userdata());
            echo "</pre>";
            exit;
        } else {
            redirect(base_url('peserta/masuk'));
        }
    }

    public function logout()
    {
        // if (!$this->acl->cek_akses_module($this->role, $this->modul, 'baca')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);

        $this->session->sess_destroy();

        redirect(base_url('peserta/masuk'));
    }

    public function def()
    {
        if (!$this->acl->cek_akses_module($this->role, $this->modul, 'baca')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);

        $this->layout->mechapp_render('Mecha_welcome_v');
    }

    public function req_v()
    {
        // if (!$this->acl->cek_akses_module($this->role, $this->modul, 'baca')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);

        $what = $this->input->post('what');

        if ($what) {
            $sess = $this->get_session();
            $dt_peserta = $this->db_mecha->get_data_peserta($sess['noregis']);
            $package = [
                'dpes' => $dt_peserta
            ];
            if ($what == 'beranda') {
                $data = $this->load->view('Beranda_v', $package, TRUE);
            } else if ($what == 'biodata') {
                $data = $this->load->view('Biodata_v', $package, TRUE);
            } else if ($what == 'panduan') {
                $data = $this->load->view('Panduan_v', $package, TRUE);
            }
            $output = [
                'content' =>  $data
            ];
        }
        echo json_encode($output);
    }



    public function qrcode($id = NULL)
    {
        // if (!$this->acl->cek_akses_module($this->role, $this->modul, 'baca')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);

        if ($id == NULL) {
            redirect(base_url('peserta/beranda'));
        } else {
            $this->load->library('qrcode/Qrlib');
            QRcode::png(htmlspecialchars($id), false, 'h', 6, 1);
        }
    }

    public function barcode($id = NULL)
    {
        // if (!$this->acl->cek_akses_module($this->role, $this->modul, 'baca')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);

        if ($id == NULL) {
            redirect(base_url('peserta/beranda'));
        } else {
            $this->load->library('zend');
            $this->zend->load('Zend/Barcode');
            $barcodeOptions = array(
                'text' => $id,
                // 'drawText' => false,
                'barHeight' => 20,
                'factor' => 1,
            );

            $imageResource = Zend_Barcode::factory('code128', 'image', $barcodeOptions, array())->draw();
            ob_start();
            imagepng($imageResource);
            imagedestroy($imageResource);
            // Capture the output
            $imagedata = ob_get_contents();
            // Clear the output buffer
            ob_end_clean();
            return base64_encode($imagedata);
        }
    }

    public function formulir_new($test = NULL)
    {
        if (!$this->db_mecha->tagihanIslunas()) show_error("Tagihan Harus di Bayar Terlebih dahulu", 401);

        $sess = $this->get_session();
        $dt = $this->db_mecha->get_data_peserta($sess['noregis']);
        $form = $this->db_mecha->get_form($dt);
        $jalur = $this->db_mecha->get_jalur($dt->pesertaJalurid);
        // $allForm = $this->db_mecha->get_all_form();

        $tanggal = $this->date_convert($dt->pesertaTanggalperiksa);

        $biaya = $this->db_mecha->get_biaya($dt)->tagihanBiaya;
        $biaya = $this->db_mecha->convert_to_rupiah(round($biaya));

        $pd = [
            'Hari / Tanggal' => '.................... (Diisi Pihak Pemeriksa)',
            'Nama' => $dt->pesertaNama,
            'Nomor Test Peserta' => $dt->pesertaNoregis,
            'Fakultas / Program Studi' => $dt->fakNamaResmi . ' / ' . $dt->prodiNamaResmi,
            'Nomor Telepon / Hp' => $dt->pesertaNohp,
            'Jalur' => $jalur->jalurNama,
        ];

        if ($dt->pesertaTanggalperiksa) {
            $pd['Hari / Tanggal'] = $tanggal->dayName . ', ' . $tanggal->default;
        }

        $pdnew = $this->db_mecha->post_to_array($pd);

        // Barcode to base64
        $data = [];
        $allBarcode = [];
        foreach ($form as $f) {
            $data[] = $this->db_mecha->get_form_byid($f->klinikId);
            $barcode = $this->barcode($f->klinikId . '-LMMC-' . $pdnew[2]);
            $allBarcode[] = $barcode;
        }

        $userdata = array(
            // 'No Token',
            'Hari / Tanggal',
            'Nama',
            'Nomor Test Peserta',
            'Fakultas / Program Studi',
            'Nomor Telepon / Hp',
            'Jalur',
        );
        $path_header = './assets/img/';
        $ulm = base64_encode(file_get_contents($path_header . 'ulm_kop.png'));
        $lmmc = base64_encode(file_get_contents($path_header . 'lmmc_kop.png'));

        $kop = '
        <table style="order-collapse: collapse; width: 100%; " border="0">
            <td align="center" width="15%">
                <img src="data:image/png;base64, ' . $ulm . '" style="width:80px;height:auto;">
            </td>
            <td align="center" width="70%">
                <h3 style="margin:0px">
                    KEMENTRIAN PENDIDIKAN DAN KEBUDAYAAN<br>UNIVERSITAS LAMBUNG MANGKURAT</h3>
                <h2 style="margin:0px">
                    LAMBUNG MANGKURAT MEDICAL CENTRE</h2>
                <p style="font-family:Times New Roman;margin:0px">
                    JL. Brigjen Hasan Basry Kotak Pos 219 Banjarmasin 70123</p>
            </td>
            <td align="center" width="15%">
                <img src="data:image/png;base64, ' . $lmmc . '" style="width:80px;height:auto;">
            </td>
        </table>
        <hr style="height:3px;background-color:black;">
        ';

        $pack = [
            'data' => $data,
            'pd' => $pdnew,
            'userdata' => $userdata,
            'foto' => $this->config->item('path_foto_peserta') . $dt->pesertaFoto,
            'isPdf' => true,
            'formList' => $form,
            'barcode' => $allBarcode,
            'biaya' => $biaya,
            'token' => $dt->tagihanVoucher,
            'kop' => $kop,
            'mulaiBiaya' => date('d-m-Y H:i:s', strtotime($dt->tagihanWaktuberlaku)),
            'akhirBiaya' => date('d-m-Y H:i:s', strtotime($dt->tagihanWaktuberakhir)),

        ];

        if ($test) {
            $pack['isPdf'] = FALSE;
            $pack['foto'] = base_url('peserta/image/path_foto_peserta/') . $dt->pesertaFoto;
        }

        if ($pack['isPdf'] == TRUE) {
            $options = new Options();
            $options->set('isRemoteEnabled', TRUE);

            $dompdf = new Dompdf($options);

            $dompdf->setPaper('A4', 'portrait');

            $html = $this->load->view('form/Formulir_new_v.php', $pack, $pack['isPdf']);
            $dompdf->load_html($html);

            $dompdf->render();

            $dompdf->stream('LMMC-' . $dt->pesertaNoregis . '.pdf', array('Attachment' => 0));
        } else {
            $this->load->view('form/Formulir_new_v.php', $pack);
        }
    }

    public function formulir($id)
    {
        exit;
        $sess = $this->get_session();
        $dt = $this->db_mecha->get_data_peserta($sess['noregis']);
        $form = $this->db_mecha->get_form($dt);

        $formId = $id;
        $vd_formulir = false;
        foreach ($form as $value) {
            if ($value->klinikId == $formId) {
                $vd_formulir = true;
            }
        }

        if ($vd_formulir == false) {
            show_404();
        } else {
            $sess = $this->get_session();

            $data = $this->db_mecha->get_form_byid($formId);
            $hasil_form = $this->db_mecha->get_hasil_form($dt->pesertaNoregis, $formId);
            $jalur = $this->db_mecha->get_jalur($dt->pesertaJalurid);

            $pd = [
                'Hari / Tanggal' => '.................... (Diisi Pihak Pemeriksa)',
                'Nama' => $dt->pesertaNama,
                'Nomor Test Peserta' => $dt->pesertaNoregis,
                'Fakultas / Program Studi' => $dt->prodiNamaResmi,
                'Nomor Telepon / Hp' => $dt->pesertaNohp,
                'Jalur' => $jalur->jalurNama,
            ];
            $pdnew = $this->db_mecha->post_to_array($pd);

            $userdata = array(
                // 'No Token',
                'Hari / Tanggal',
                'Nama',
                'Nomor Test Peserta',
                'Fakultas / Program Studi',
                'Nomor Telepon / Hp',
                'Jalur',
            );

            $pack = [
                'data' => $data,
                'pd' => $pdnew,
                'userdata' => $userdata,
                'form' => $formId,
                'hasilBarcode' => $data->klinikId . '-LMMC-' . $pdnew[2],
                'foto' => $dt->pesertaFoto,
                'isPdf' => TRUE
            ];
            // DISABLE SEMENTARA
            // $this->load->library('Pdf');

            // $this->pdf->setPaper('A4', 'potrait');
            // $this->pdf->filename = "form.pdf";
            // $this->pdf->load_view('form/Form_print_v.php', $pack);
            $barcode = $this->barcode('3-LMMC-1614');
            $pack['barcode'] = $barcode;

            if ($pack['isPdf'] == TRUE) {
                $options = new Options();
                $options->set('isRemoteEnabled', TRUE);

                $dompdf = new Dompdf($options);

                $dompdf->setPaper('A4', 'portrait');

                $html = $this->load->view('form/Form_test_v.php', $pack, $pack['isPdf']);
                $dompdf->load_html($html);

                $dompdf->render();

                $dompdf->stream('LMMC.pdf', array('Attachment' => 0));
            } else {
                $this->load->view('form/Form_test_v.php', $pack);
            }
        }
    }
}
