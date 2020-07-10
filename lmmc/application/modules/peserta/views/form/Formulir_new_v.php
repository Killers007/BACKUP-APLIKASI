<html>

<head>
    <title>Berkas Tes Pemeriksaan Kesehatan - LMMC</title>
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
            page-break-before: always;
        }
    </style>
</head>

<body>
    <page <?php echo (!$isPdf) ? "size='A4'" : '' ?>>

        <?php echo $kop ?>
        <center>
            <h2><b>INFORMASI PEMBAYARAN</b></h2>
        </center>
        <table style="border-collapse: collapse; width: 100%; " border="0" data-mce-style="border-collapse: collapse; width: 100%;">
            <tbody>
                <?php
                $a = 0;
                $key = '';
                foreach ($userdata as $usd) {
                    if ($a !== 0) {
                        echo '
                        <tr>
                        <td style="width: 33.5425%;">' . $usd . '</td>
                        <td style="width: 1.3947%;">:</td>
                        <td style="width: 65.0628%;">' . $pd[$a] . '</td>';
                        if ($a == 1) {
                            echo '<td rowspan="6">';
                            echo '<img src="' . $foto . '" style="max-height:110px;">';
                            echo '</td>';
                        }
                        echo '</tr>';
                    }
                    $a++;
                }
                ?>
            </tbody>
        </table>
        <div style="background-color:antiquewhite">
            <center>
                <p>TOKEN PEMBAYARAN : </p>
                <p style=" margin-top:-10px"><b style="font-size:20px"><?php echo $token ?></b></p>

                <p>JUMLAH YANG HARUS DIBAYAR :</p>
                <p style="margin-top:-10px"><b style="font-size:20px"><?php echo $biaya ?></b></p>

                <p><i style="font-size:15px;color:red"> Pembayaran bisa dilakukan lewat Teller atau ATM pada <br> Bank yang sudah bekerja sama dengan ULM (BNI, Mandiri, BTN). <br>
                        Pembayaran tes kesehatan bisa dilakukan <br> mulai tanggal <?php echo $mulaiBiaya; ?> sampai dengan 24-04-2020 23:59:00<!-- <?php echo $akhirBiaya; ?> --></i> </p>
            </center>
        </div>
    </page>
    <page class="page_break " <?php echo (!$isPdf) ? "size='A4'" : '' ?>>
        <?php echo $kop ?>

        <center>
            <h2><b>KARTU PEMERIKSAAN KESEHATAN</b></h2>
        </center>
        <table style="border-collapse: collapse; width: 100%; " border="0" data-mce-style="border-collapse: collapse; width: 100%;">
            <tbody>
                <?php
                $a = 0;
                $key = '';
                foreach ($userdata as $usd) {
                    echo '
                    <tr>
                    <td style="width: 33.5425%;">' . $usd . '</td>
                    <td style="width: 1.3947%;">:</td>
                    <td style="width: 65.0628%;">' . $pd[$a] . '</td>';
                    if ($a == 0) {
                        echo '<td rowspan="7">';
                        echo '<img src="' . $foto . '" style="max-height:110px;">';
                        echo '</td>';
                    }
                    echo '</tr>';
                    $a++;
                }
                ?>
            </tbody>
        </table>
        <div>
            <table style="border-collapse: collapse; width: 100%; margin-bottom: 10px; height: 40px;" border="1" data-mce-style="border-collapse: collapse; width: 100%; margin-bottom: 10px; height: 40px;">
                <tbody>

                    <tr>
                        <th>
                            <center>
                                Jenis Pemeriksaan
                            </center>
                        </th>
                        <th>
                            <center>

                                Tanda Tangan Petugas Pemeriksaan
                            </center>
                        </th>
                    </tr>
                    <?php
                    $i = 0;
                    foreach ($formList as $key => $value) {
                        echo '
                        <tr>
                            <td style="width: 47.3873%; height: 50; text-align: center;">
                                ' . $value->klinikNama . '<br>
                            </td>
                            <td class="container">
                                <center>............................</center>
                            </td>   
                        </tr>';
                        $i++;
                    }
                    ?>
                </tbody>

            </table>
        </div>
    </page>
    <page class="page_break " <?php echo (!$isPdf) ? "size='A4'" : '' ?>>
        <?php echo $kop ?>
        <center>
            <h2><b>KARTU PEMERIKSAAN KESEHATAN</b></h2>
        </center>
        <table style="border-collapse: collapse; width: 100%; " border="0" data-mce-style="border-collapse: collapse; width: 100%;">
            <tbody>
                <?php
                $a = 0;
                $key = '';
                foreach ($userdata as $usd) {
                    echo '
                    <tr>
                    <td style="width: 33.5425%;">' . $usd . '</td>
                    <td style="width: 1.3947%;">:</td>
                    <td style="width: 65.0628%;">' . $pd[$a] . '</td>';
                    if ($a == 0) {
                        echo '<td rowspan="7">';
                        echo '<img src="' . $foto . '" style="max-height:110px;">';
                        echo '</td>';
                    }
                    echo '</tr>';
                    $a++;
                }
                ?>
            </tbody>
        </table>
        <div>
            <table style="border-collapse: collapse; width: 100%; margin-bottom: 10px; height: 40px;" border="1" data-mce-style="border-collapse: collapse; width: 100%; margin-bottom: 10px; height: 40px;">
                <tbody>

                    <tr>
                        <th>
                            <center>
                                Jenis Pemeriksaan
                            </center>
                        </th>

                    </tr>
                    <?php
                    $i = 0;
                    foreach ($formList as $key => $value) {
                        echo '
                        <tr>
                            <td style="width: 47.3873%; height: 50; text-align: center;">
                                ' . $value->klinikNama . '<br>
                            <img src="data:image/png;base64, ' . $barcode[$i] . '">
                            </td>
                        </tr>';
                        $i++;
                    }
                    echo '<tr><td><center><h2>Serahkan lembar ini ke pihak pemeriksa.</h2></center></td></tr>';

                    ?>
                </tbody>

            </table>
        </div>
    </page>

</body>

</html>