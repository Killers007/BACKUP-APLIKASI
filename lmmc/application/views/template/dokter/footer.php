<!-- FOOTER -->
<!-- <div class="arlo_tm_section">
  <div class="arlo_tm_footer">
    <div class="container">
      <div class="footer_inner">
        <div class="copyright wow fadeInLeft" data-wow-duration="0.8s">
          <p>Copyright &copy; 2019. Template has been designed by <a href="https://themeforest.net/user/marketify">Marketify</a></p>
        </div>
        <div class="top wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay="0.2s">
          <span></span>
          <a href="#"></a>
        </div>
      </div>
    </div>
  </div>
</div> -->
<!-- /FOOTER -->
</div>
</div>
<!-- /RIGHTPART -->
</div>
</div>
<!-- / WRAPPER ALL -->


<!-- /SCRIPTS -->
<script>
  $(document).ready(function() {
    $('[id="rightpart"]').stop().fadeIn('slow');

    var $window = $(window);
    var $pane = $('#pane1');

    function checkWidth() {
      var windowsize = $window.width();
      if (windowsize < 1040) {
        if ($('#mys').hasClass('opened') == false) {
          $('#navcol').trigger("click");
        }
      } else {
        if ($('#mys').hasClass('opened') == true) {
          $('#navcol').trigger("click");
        }
      }
    }
    $(window).resize(function() {
      checkWidth();
    });
    checkWidth();
  });


  function req_v(what) {
    $('#rightpart').hide();
    $('#rightpart').html('');
    $.ajax({
      type: "POST",
      url: 'peserta/req_v',
      data: {
        'what': what
      },
      dataType: 'json',
      success: function(data) {
        $('#rightpart').html(data.content);
        $('#rightpart').stop().fadeIn('fast');
        // will first fade out the loading animation 
      },
      error: function(request, error) {
        // alert("Request: " + JSON.stringify(request));
      }
    });
  }
</script>
</body>

</html>