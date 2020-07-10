<style>
    table {
        border-collapse: collapse;
        margin: 0px;
        width: 100%;
    }

    table,
    th,
    td {
        border: 1px solid black;
        padding: 3px;
        font-weight: bold;

    }

    .tdb {
        padding: 3px 8px;
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
<div name="table">
    <p><b>
            Lampiran 2
        </b></p>
    <p><b>
            DETAIL DARI RINGKASAN
        </b></p>
    <table style="margin:0px">
        <thead>
            <tr>
                <th class="tdcenter" width="10%">
                    NO
                </th>
                <th class="tdcenter">
                    NO. REGISTRASI
                </th>
                <th class="tdcenter" width="150">
                    NAMA MAHASISWA
                </th>
                <th class="tdcenter" width="150">
                    RINCIAN MASALAH
                </th>
                <th class="tdcenter" width="100">
                    PRODI
                </th>
                <th class="tdcenter" width="100">
                    FAKULTAS
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($rd as $r) {
                echo '
                    <tr>
                        <td class="tdcenter">
                        ' . $i . '
                        </td>
                        <td class="tdcenter">
                        ' . $r->pesertaNoregis . '
                        </td>
                        <td class="tdcenter">
                        ' . $r->pesertaNama . '
                        </td>';

                echo '
                        <td class="tdcenter">
                        ' . $r->knkdtNamahasil . '
                        </td>';

                echo '
                        <td class="tdcenter">
                        ' . $r->prodiNamaResmi . '
                        </td>
                        <td class="tdcenter">
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