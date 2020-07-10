<?php

use Dompdf\Dompdf;
use Dompdf\Options;

class Report_peserta extends MY_Controller
{
    private $modul = 'report/report_peserta';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Report_peserta_m', 'rp_m');
    }

    public function ringkasan($is = NULL)
    {
        $report_data = $this->rp_m->report_data();

        $package = [
            'rd' => $report_data,
            'modul' => $this->modul,
            'isPdf' => FALSE,
            'isPdfTest' => FALSE,
        ];

        if ($is == 'pdf') {
            $package['isPdf'] = TRUE;
        }

        // download as excel
        if ($is == 'xls') {
            $data = $this->bermasalah_generate_data();

            $this->rp_m->excelize_ringkasan($data);
            exit;
        }


        if ($package['isPdf'] == TRUE) {
            if ($package['isPdfTest'] == TRUE) {
                $this->load->view('report_peserta/bermasalah_pdf_v', $package);
            } else {
                $options = new Options();
                $options->set('isRemoteEnabled', TRUE);

                $dompdf = new Dompdf($options);

                $dompdf->setPaper('A4', 'landscape');

                $html =  $this->load->view('report_peserta/bermasalah_pdf_v', $package, $package['isPdf']);

                $dompdf->load_html($html);

                $dompdf->render();

                $dompdf->stream('LMMC.pdf', array('Attachment' => 0));
            }
        } else {
            $this->layout->render('report_peserta/bermasalah', $package);
        }
        // $this->load->library('Pdf');

        // $this->pdf->setPaper('A4', 'potrait');
        // $this->pdf->filename = "form.pdf";
        // $this->pdf->load_view('report_peserta/bermasalah.php', $package);
        // exit;
    }

    public function bermasalah_generate_data()
    {
        // Cari data
        $rd = $this->rp_m->report_data();
        $side_title = [
            'JUMLAH MAHASISWA TERDAFTAR',
            'JUMLAH MAHASISWA TERCATAT',
            'POSITIF NAFZA',
            'NEGATIF NAFZA',
            'BUTA WARNA',
            'TIDAK BUTA WARNA',
            'TES FISIK (FK & FKG)',
            'TES GIGI (FKG)',
        ];

        // Generate table
        $data = array();
        $no = 1;
        $i = 0;
        foreach ($side_title as $st) {
            if ($rd[$i][0] == 0) {
                $rd[$i][0] = "-";
            }
            if ($rd[$i][1] == 0) {
                $rd[$i][1] = "-";
            }
            if ($rd[$i][2] == 0) {
                $rd[$i][2] = "-";
            }
            $row = array();

            $row[] = $st;
            $row[] = $rd[$i][0];
            $row[] = $rd[$i][1];
            $row[] = $rd[$i][2];
            $row[] = '';
            $data[] = $row;
            $no++;
            $i++;
        }
        return $data;
    }

    public function bermasalah_request()
    {

        $data = $this->bermasalah_generate_data();


        // Response
        $output = [
            "data" => $data,
        ];

        echo json_encode($output);
    }

    public function detail_ringkasan($is = NULL)
    {
        $report_data = $this->rp_m->get_bermasalah();

        // echo "<pre>";
        // print_r($report_data);
        // echo "</pre>";
        // exit;

        $package = [
            'rd' => $report_data,
            'modul' => $this->modul,
            'isPdf' => FALSE,
            'isPdfTest' => FALSE,
        ];

        if ($is) {
            $package['isPdf'] = TRUE;
        }

        // download as excel
        if ($is == 'xls') {
            $this->rp_m->excelize_detail_ringkasan($report_data);
            exit;
        }

        if ($package['isPdf'] == TRUE) {
            if ($package['isPdfTest'] == TRUE) {
                $this->load->view('report_peserta/detail_ringkasan_pdf_v', $package);
            } else {
                $options = new Options();
                $options->set('isRemoteEnabled', TRUE);

                $dompdf = new Dompdf($options);

                $dompdf->setPaper('A4', 'landscape');

                $html = $this->load->view('report_peserta/detail_ringkasan_pdf_v', $package, $package['isPdf']);

                $dompdf->load_html($html);

                $dompdf->render();

                $dompdf->stream('LMMC.pdf', array('Attachment' => 0));
            }
        } else {
            $this->layout->render('report_peserta/detail_ringkasan_v', $package);
        }
    }

    public function detail_ringkasan_request()
    {
        // Cari data
        $report_data = $this->rp_m->get_bermasalah();

        // Generate table
        $data = array();
        $no = 1;

        foreach ($report_data as $r) {
            $row = array();

            $row[] = $no;
            $row[] = $r->pesertaNoregis;
            $row[] = $r->pesertaNama;
            $row[] = $r->knkdtNamahasil;
            $row[] = $r->prodiNamaResmi;
            $data[] = $row;
            $no++;
        }

        // Response
        $output = [
            "data" => $data,
        ];

        echo json_encode($output);
    }
}
