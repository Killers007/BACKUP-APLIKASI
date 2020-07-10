<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    table,
    th,
    td {
        border: 1px solid black;
        padding: 3px 8px;
        font-weight: bold;

    }

    .tdb {
        padding: 40px 8px;
    }

    .tdcenter {
        text-align: center;
    }

    .scale8 {

        transform: scale(0.75, 0.75);
        display: inline-block;
        position: absolute;
        right: 0px;
        top: 0px;
        transform-origin: top;
        margin-top: -2.5%;

        margin-left: 10%;
        margin-right: -18%;

    }
</style>
<div class="">
    <div name="table">
        <p><b>
                Lampiran 1
            </b></p>
        <p><b>
                RINGKASAN
            </b></p>
        <table>
            <thead>
                <tr>
                    <td width="100">

                    </td>
                    <td class="tdcenter" width="20">
                        EKSAKTA
                    </td>
                    <td class="tdcenter" width="20">
                        NON <br> EKSAKTA
                    </td>
                    <td class="tdcenter" width="20">
                        JUMLAH
                    </td>
                    <td class="tdcenter" width="20">
                        CATATAN
                    </td>
                </tr>
            </thead>
            <tbody>
                <?php
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
                ?>
                <?php
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
                    echo '
                    <tr>
                        <td class="tdb">
                            ' . $st . '
                        </td>
                        <td class="tdb tdcenter">
                        ' . $rd[$i][0] . '
                        </td>
                        <td class="tdb tdcenter">
                        ' . $rd[$i][1] . '
                        </td>
                        <td class="tdb tdcenter">
                        ' . $rd[$i][2] . '
                        </td>
                        <td class="tdb tdcenter">

                        </td>
                    </tr>
                    ';
                    $i++;
                }
                ?>
            </tbody>
        </table>
        <br>

    </div>
    <div name="footer">
    </div>


</div>