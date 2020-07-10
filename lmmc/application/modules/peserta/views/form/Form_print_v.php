<style>
    /* SCALING UNTUK PRINT VIEW AZMI-METHOD */
    .scale8 {
        transform: scale(0.75, 0.75);
        display: inline-block;
        position: absolute;
        right: 0px;
        top: 0px;
        transform-origin: top;
        /* margin-top: -2.5%; */

        /* margin-left: 10%; */
        /* margin-right: -18%; */

    }
</style>

<div class="scale8">
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
            $i = 0;
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
                            echo '<img src="' . base_url('peserta/barcode') . '/' . $hasilBarcode . '">';
                        }
                        ?>
                    </td>
                </tr>
            </tbody>

        </table>

    </div>
</div>


<script>
    function x() {
        var content = tinyMCE.get('article').getBody().innerHTML;
        $('[id=bodyDiv]').html(content)
    }
    $('button').on('click', function(e) {
        x();
    })
    $(document).ready(function() {
        tinyMCE.init({
            selector: '#article',
            height: 300,
            theme: 'modern',
            plugins: 'print preview fullpage paste searchreplace autolink directionality bbcode visual' +
                'blocks visualchars fullscreen image link media template codesample table charmap' +
                ' hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor word' +
                'count spellchecker  imagetools media  link contextmenu colorpicker textpattern h' +
                'elp',
            toolbar1: 'formatselect | fontsizeselect | bold italic strikethrough forecolor backcolor | ' +
                'link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent ' +
                'indent  | removeformat',
            image_advtab: true,
            templates: [{
                title: 'Test template 1',
                content: 'Test 1'
            }, {
                title: 'Test template 2',
                content: 'Test 2'
            }],
            content_css: ['//fonts.googleapis.com/css?family=Lato:300,300i,400,400i'],
            content_style: 'table, th, td {padding: 7px;border: 1px solid black;}',
            table_default_attributes: {
                'border': '1'
            },
            table_default_styles: {
                'border-collapse': 'collapse',
                'width': '100%',
                'margin-bottom': '10px',
                'cellpadding': '10'
            },
            table_responsive_width: true,
            fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt"
        });
    });
</script>

</html>