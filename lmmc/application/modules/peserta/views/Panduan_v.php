<!-- NEWS -->
<div class="arlo_tm_section isipad" id="rightpart" hidden>
    <div class="arlo_tm_home_news ">
        <div class="col-md-12">
            <div class="arlo_title_holder">
                <h3>Panduan</h3>

                <br>
            </div>
        </div>
        <div class="col-md-12">
            <img src="<?php
                        if ($dt) {
                            echo base_url('peserta/image/path_foto_panduan/') . $dt->panduanGambar;
                        } else {
                            echo '';
                        }


                        ?>" alt="" />
        </div>
        <div class="col-md-12" style="margin-left:20px">

            <p><?php
                if ($dt) {
                    echo $dt->panduanDeskripsi;
                } else {
                    echo '';
                }

                ?></p>

        </div>
    </div>
</div>
<!-- /NEWS -->