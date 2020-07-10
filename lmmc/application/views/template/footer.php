 </section>
 </section>
 </section>

 <!-- Bootstrap -->
 <script src="<?php echo base_url(); ?>assets/data/js/bootstrap.js"></script>
 <!-- App -->
 <!-- <script src="<?php echo base_url(); ?>assets/data/js/app.js"></script> -->
 <script src="<?php echo base_url(); ?>assets/data/js/slimscroll/jquery.slimscroll.min.js"></script>

 <script src="<?php echo base_url(); ?>assets/data/js/sortable/jquery.sortable.js"></script>
 <!-- <script src="<?php echo base_url(); ?>assets/data/js/app.plugin.js"></script> -->
 <!-- markdown -->
 <script src="<?php echo base_url(); ?>assets/data/js/markdown/epiceditor.min.js"></script>
 <!--<script src="<?php echo base_url(); ?>assets/data/js/markdown/demo.js"></script>-->
 <script src="<?php echo base_url(); ?>assets/data/js/chosen/chosen.jquery.min.js"></script>
 <script src="<?php echo base_url(); ?>assets/data/js/spinner/jquery.bootstrap-touchspin.min.js"></script>
 <script src="<?php echo base_url(); ?>assets/data/js/typehead/typeahead.bundle.min.js"></script>
 <!--<script src="<?php echo base_url(); ?>assets/data/js/typehead/demo.js"></script>-->
 <script src="<?php echo base_url(); ?>assets/data/js/app.plugin.js"></script>

 <!-- DATA TABES SCRIPT -->
 <script src="<?php echo base_url(); ?>assets/js/fileinput.min.js" type="text/javascript"></script>

 <script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.js" type="text/javascript"></script>
 <script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.js" type="text/javascript"></script>
 <script src="<?php echo base_url('assets/data/js/datatables/dataTables.buttons.min.js'); ?>"></script>
 <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
 <script src="<?php echo base_url('assets/js/xls/jszip.js'); ?>"></script>
 <!-- Toastr -->
 <script src="<?php echo base_url('assets/plugins/toastr/toastr.js'); ?>"></script>
 <!--Upload Photo JS-->
 <script src="<?php echo base_url(); ?>assets/data/js/upload/upload.js" type="text/javascript" />
 </script>
 <!--Datepicker-->
 <script src="<?php echo base_url(); ?>assets/data/js/datepicker/bootstrap-datepicker.js" type="text/javascript" />
 </script>
 <!--Datetimepicker-->
 <!-- <script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.min.js" type="text/javascript" /></script> -->
 <script src="<?php echo base_url(); ?>assets/js/sweetalert.min.js" type="text/javascript" />
 </script>
 <script src="<?php echo base_url(); ?>assets/js/moment.js" type="text/javascript" />
 </script>
 <script src="https://portal.ulm.ac.id//assets/js/app.js"></script>
 <script src="https://portal.ulm.ac.id//assets/js/app.plugin.js"></script>

 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/data/datetimepicker/css/bootstrap-datetimepicker.min.css') ?>">
 <script type="text/javascript" src="<?php echo base_url('assets/data/datetimepicker/js/bootstrap-datetimepicker.min.js') ?>"></script>
 <!-- page script -->
 <script>
   $(document).ready(function() {
     $('[data-toggle="tooltip"]').tooltip();
   });
   //date
   $('.datepicker').datepicker({
     autoclose: true,
     format: 'yyyy-mm-dd',
   });

   function toastConfig(status = null, message = null, title = null) {
     toastr.options = {
       "closeButton": false,
       "debug": false,
       "newestOnTop": true,
       "progressBar": false,
       "positionClass": "toast-top-right",
       "preventDuplicates": false,
       "onclick": null,
       "showDuration": "300",
       "hideDuration": "1000",
       "timeOut": "5000",
       "extendedTimeOut": "1000",
       "showEasing": "swing",
       "hideEasing": "linear",
       "showMethod": "fadeIn",
       "hideMethod": "fadeOut"
     }

     toastr[status](message, title);

   }
 </script>
 </body>

 </html>