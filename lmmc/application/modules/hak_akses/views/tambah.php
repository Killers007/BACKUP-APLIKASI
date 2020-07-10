<div class="content-wrapper">
    <section class="content-header">
        <h1>Tambah Hak Akses<small> User</small></h1>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body">
                <?php
                $this->view('_form', array(
                    'model' => $model,
                    'new' => $new,
                    'listRole' => $listRole,
                    'listModul' => $listModul,
                        )
                );
                ?>
            </div>
        </div>
    </section>
</div>


