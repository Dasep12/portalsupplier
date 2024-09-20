<!-- jQuery UI -->
<script src="{{ asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

<!-- jQuery Scrollbar -->
<script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>


<!-- Chart JS -->
<script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>

<!-- jQuery Sparkline -->
<script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Chart Circle -->
<script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js') }}"></script>

<!-- Datatables -->
<script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>

<!-- Bootstrap Notify -->
<script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

<!-- jQuery Vector Maps -->
<script src="{{ asset('assets/js/plugin/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>

<!-- Sweet Alert -->
<script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

<!-- Atlantis JS -->
<script src="{{ asset('assets/js/atlantis.min.js') }}"></script>

<!-- Atlantis DEMO methods, don't include it in your project! -->
<script src="{{ asset('assets/js/setting-demo.js') }}"></script>


<script>
   // Override default pager icons

   var jqgridPage = ['jqGridPager', 'jqGridPager2']

   for (let jk = 0; jk < jqgridPage.length; jk++) {
      $grid = $("#" + jqgridPage[jk]);
      $pager = $grid.closest(".ui-jqgrid").find(".ui-pg-table");

      var icon = $pager.find(".ui-pg-button>span.ui-icon-seek-first");
      icon.removeClass("ui-icon ui-icon-seek-first");
      icon.addClass("fas fa-angle-double-left");

      $pager.find(".ui-pg-button>span.ui-icon-seek-prev")
         .removeClass("ui-icon ui-icon-seek-prev")
         //.addClass("ui-icon ui-icon-arrowthick-1-w")
         .addClass("fas fa-angle-left");

      $pager.find(".ui-pg-button>span.ui-icon-seek-next")
         .removeClass("ui-icon ui-icon-seek-next")
         //.addClass("ui-icon ui-icon-arrowthick-1-e")
         .addClass("fas fa-angle-right");

      $pager.find(".ui-pg-button>span.ui-icon-seek-end")
         .removeClass("ui-icon ui-icon-seek-end")
         .addClass("fas fa-angle-double-right");
   }


   function updateClock() {
      var now = new Date();

      // Array of weekday names
      var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

      // Array of month names
      var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

      // Get day of the week, day of the month, month, and year
      var dayName = days[now.getDay()];
      var day = now.getDate();
      var month = months[now.getMonth()];
      var year = now.getFullYear();

      // Extract hours, minutes, and seconds
      var hours = now.getHours();
      var minutes = now.getMinutes();
      var seconds = now.getSeconds();

      // Add leading zeros if needed
      hours = hours < 10 ? '0' + hours : hours;
      minutes = minutes < 10 ? '0' + minutes : minutes;
      seconds = seconds < 10 ? '0' + seconds : seconds;

      // Format the full date and time string
      var timeString = dayName + ', ' + day + ' ' + month + ' ' + year + ' ' + hours + ':' + minutes + ':' + seconds;

      // Display the time in the div with id "digitalClock"
      document.getElementById('digitalClock').innerHTML = timeString;
   }

   // Update the clock every second
   setInterval(updateClock, 1000);

   // Call the function once to show the clock immediately
   updateClock();
</script>
</body>

</html>