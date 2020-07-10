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

    img {}

    td.container>div {
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    td.container {
        height: 20px;
    }
</style>

<div class="scale8">
    <img src="<?php echo base_url('assets/img/header.png') ?>" style="width:100%;height:auto;">
    <center>
        <p>KARTU PEMERIKSAAN KESEHATAN</p>
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
                    echo '<img src="' . base_url('assets/mecha/upload') . '/' . $foto . '" style="max-height:130px;">';
                    echo '</td>';
                }
                echo '</tr>';
                $i++;
            }
            ?>
        </tbody>
    </table>
    <div>
        <table style="border-collapse: collapse; width: 100%; margin-bottom: 10px; height: 40px;" border="1" data-mce-style="border-collapse: collapse; width: 100%; margin-bottom: 10px; height: 40px;">
            <tbody>

                <tr>
                    <th>
                        Jenis Pemeriksaan
                    </th>
                    <th>
                        Tanda Tangan Petugas Pemeriksaan
                    </th>
                </tr>
                <?php
                foreach ($form as $key => $value) {
                    echo '
                <tr>
                    <td style="width: 47.3873%; height: 50; text-align: center;">
                        ' . $value->klinikNama . '
                    </td>
                    <td class="container">
                        <center>............................</center>
                    </td>   
                </tr>';
                }
                ?>
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