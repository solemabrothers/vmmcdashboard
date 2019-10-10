{{--/**--}}
 {{--* Created by PhpStorm.--}}
 {{--* User: SOLEMA--}}
 {{--* Date: 15/06/2018--}}
 {{--* Time: 16:53--}}
 {{--*/--}}

@extends('.home')

@section('content')

 <body>

 <div class="row">
  <div class="col-md-6">
   <!-- Line chart -->
   <div class="box box-primary">
    <div class="box-header with-border">
     <i class="fa fa-bar-chart-o"></i>

     <h3 class="box-title">Line Chart Distributions</h3>

     <div class="container" id="district">

    </div>
    <div class="box-body">
     <div id="line-chart" style="height: 300px;"></div>
    </div>
    <!-- /.box-body-->
   </div>
   <!-- /.box -->

  </div>

 </div>
 </div>
 <script src="plugins/jquery/jquery.min.js"></script>
 <!-- jQuery UI 1.11.4 -->
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
 <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
 <script>
     $.widget.bridge('uibutton', $.ui.button)
 </script>

 <script src="//code.jquery.com/jquery.js"></script>
 <!-- DataTables -->
 <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
 <!-- Bootstrap JavaScript -->
 <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
 <!-- App scripts -->
 <!-- Bootstrap 4 -->
 <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
 <!-- Morris.js charts -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
 <script src="plugins/morris/morris.min.js"></script>
 <!-- Sparkline -->
 <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
 <!-- jvectormap -->
 <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
 <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
 <!-- jQuery Knob Chart -->
 <script src="plugins/knob/jquery.knob.js"></script>
 <!-- daterangepicker -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
 <script src="plugins/daterangepicker/daterangepicker.js"></script>
 <!-- datepicker -->
 <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
 <!-- Bootstrap WYSIHTML5 -->
 <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
 <!-- Slimscroll -->
 <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
 <!-- FastClick -->
 <script src="plugins/fastclick/fastclick.js"></script>
 <!-- AdminLTE App -->
 <script src="dist/js/adminlte.js"></script>
 <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
 <script src="dist/js/pages/dashboard.js"></script>
 <!-- AdminLTE for demo purposes -->
 <script src="dist/js/demo.js"></script>
 </body>
 <script src="https://code.highcharts.com/highcharts.js"></script>
 <script src="https://code.highcharts.com/modules/series-label.js"></script>
 <script src="https://code.highcharts.com/modules/exporting.js"></script>
 <script src="https://code.highcharts.com/modules/export-data.js"></script>
 <script type="text/javascript" charset="utf8" src="{{URL::asset('js/highCharts.js')}}"></script>
 <!-- Bootstrap 3.3.6 -->

 <!-- Page script -->
 </body>
 @endsection