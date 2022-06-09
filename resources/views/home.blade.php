@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">All Registrants</h3>

      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
            <div class="col-sm-2">
                <a href="{{route('delete_registrant')}}" class="btn btn-danger btn-block btn-sm" id="clear-regist" onclick="return confirm('Are you sure you want to delete all the registrants?')"><i class="fas fa-user-times"></i> Clear Registrants</a>
            </div>
        </div>
        <br>
        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                      <thead>
                        <tr>
                            <th>No</th>
                            <th>No. Urut</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Age</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Service</th>
                            <th>Beban Doa</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            $ct = 1;
                            if (isset($data)) {
                                foreach ($data as $item) {
                                    echo "<tr><td>".$ct."</td>";
                                    echo "<td>".$item->id."</td>";
                                    echo "<td>".$item->name."</td>";
                                    echo "<td>".$item->email."</td>";
                                    echo "<td>".$item->age."</td>";
                                    echo "<td>".$item->phone."</td>";
                                    echo "<td>".$item->address."</td>";
                                    echo "<td>".$item->svc_name.' - '.$item->svc_time."</td>";
                                    echo "<td>".$item->pokok_doa."</td>";
                                    $ct++;
                                }
                            }
                        ?>
                      </tbody>
                      <tfoot>
                        <tr>
                            <th>No</th>
                            <th>No. Urut</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Age</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Service</th>
                            <th>Beban Doa</th>
                        </tr>
                      </tfoot>
                    </table>
      </div>
    </div>
@stop

@section('css')
    <!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
@stop

@section('js')
    <script>
        $(function () {
            $("#example1").DataTable({
              "responsive": true, "lengthChange": false, "autoWidth": false,
              "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": false,
              "ordering": true,
              "info": true,
              "autoWidth": false,
              "responsive": true,
            });
          });
    </script>
@stop