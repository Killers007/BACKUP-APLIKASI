<html>

<head>
    <title>Berkas LMMC</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <style>
        body {
            font-family: 'Roboto';
            font-size: 13px;
        }

        .info {
            font-size: 13;
        }

        html {
            font-family: verdana, arial, sans-serif;
            font-size: 13px;
        }

        .gridtable {
            font-size: 11px;
            color: #333333;
            border-width: 1px;
            border-color: #666666;
            border-collapse: collapse;
        }

        .gridtable th,
        .gridtable tr {
            border-width: 1px;
            padding: 15px;
            border-style: solid;
            border-color: #666666;
        }

        .gridtable td,
        .gridtable th {
            border-width: 1px;
            padding: 10px;
            border-style: solid;
            border-color: #666666;
        }

        table.header {
            font-size: 11px;
            color: #333333;
            border-width: 0px;
            border-color: #666666;
            border-collapse: collapse;
        }

        table.header th {
            border-width: 0px;
            padding: 8px;
            border-style: solid;
            border-color: #666666;
            background-color: #dedede;
        }

        table.header td {
            border-width: 0px;
            padding: 8px;
            border-style: solid;
            border-color: #666666;
            background-color: #ffffff;
        }

        .tidak_hadir {
            background-color: antiquewhite;
            -webkit-print-color-adjust: exact;
        }

        .nafza_positif {
            background-color: aliceblue;
            -webkit-print-color-adjust: exact;
        }

        #keterangan {
            font-size: small;
        }

        .h1 {
            font-size: 22px;
            font-weight: bold;
            margin-top: -12px;
            margin-top: 1px;
        }

        .h2 {
            font-size: 16px;
            font-weight: bold;
            margin-top: 0px;
        }

        page[size='A4'] {
            background: white;
            width: 21cm;
            height: 28.7cm;
            display: block;
            margin: 0 auto;
            padding-left: 25px;
            padding-right: 25px;
            padding-top: 25px;
            margin-bottom: 0.5cm;
            border: 1px solid #dadada
        }

        media print {

            body,
            page[size='A4'] {
                margin: 0;
                padding-left: 0px;
                padding-right: 0px;
                border: 0px
            }
        }
        }

        .page_break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <page class="page_break" <?php echo (!$isPdf) ? "size='A4'" : '' ?>>
        <img src="<?php echo FCPATH . '/assets/img/header.png' ?>" style="width:100%;height:auto;">
        <center>
            <p>FORMULIR TEST KESEHATAN SELEKSI PENERIMAAN MAHASISWA BARU JALUR APA</p>
            <h3 class="f_ss" style="margin:8px"><?php echo strtoupper($data->klinikNama); ?></h3>
            <?php
            if ($form == "4") {
                echo '<img style="margin-bottom:10px" src="' . base_url('peserta/barcode') . '/' . $hasilBarcode . '">';
            }
            ?>
        </center>
        <table style="border-collapse: collapse; width: 100%; margin-bottom: 10px;" border="0" data-mce-style="border-collapse: collapse; width: 100%; margin-bottom: 10px;">
            <tbody>
                <?php
                $i =  0;
                $key = '';
                foreach ($userdata as $usd) {
                    echo '
                    <tr>
                    <td style="width: 33.5425%;">' . $usd . '</td>
                    <td style="width: 1.3947%;">:</td>
                    <td style="width: 65.0628%;">' . $pd[$i] . '</td>';
                    if ($i == 0) {
                        echo '<td rowspan="7">';
                        echo '<img src="' . FCPATH . 'assets/mecha/upload' . '/' . $foto . '" style="max-height:130px;">';
                        echo '</td>';
                    }
                    echo '</tr>';
                    $i++;
                }
                ?>
            </tbody>
        </table>
        <div>

            <?php
            echo $data->klinikFormhtml;
            ?>


        </div>
        <div>
            <table style="border-collapse: collapse; width: 100%; margin-bottom: 10px;" border="0" data-mce-style="border-collapse: collapse; width: 100%; margin-bottom: 10px;">
                <tbody>

                    <tr>
                        <td style="text-align: right !important;">

                            <?php
                            if ($form !== "4") {
                                echo '<img src="data:image/png;base64, ' . $barcode . '">';
                            }
                            ?>
                        </td>
                    </tr>
                </tbody>

            </table>

        </div>
    </page>
</body>

</html>