@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Admins</h1>
@stop

@section('content')
    <div class="modal fade" id="modal-add" aria-modal="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Add</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form role="form" _lpchecked="1" method="POST" action="{{route('submit_service')}}">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" placeholder="Name" name="name">
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="Email" name="email">
                  </div>
                  <div class="form-group">
                    <label>Code</label>
                    <input type="text" class="form-control" placeholder="Time" name="time">
                  </div>
                </div>
                <!-- /.card-body -->
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-edit" aria-modal="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form role="form" method="POST" action="{{route('edit_service')}}">
                @csrf
                <input type="hidden" name="id">
                <div class="card-body">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" placeholder="Name" name="name">
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="Email" name="email">
                  </div>
                  <?php if (isset($code)) {?>
                    <?php if ($code == 1) { ?>
                      <div class="form-group">
                        <label>Code</label>
                        <input type="text" class="form-control" placeholder="Code" name="code">
                      </div>
                    <?php } ?>
                  <?php } ?>
                </div>
                <!-- /.card-body -->
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <div class="card">
      <!-- /.card-header -->
      <div class="card-body">
        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                      <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Code</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            $ct = 1;
                            if (isset($data)) {
                                foreach ($data as $item) {
                                    echo "<tr><td>".$ct."</td>";
                                    echo "<td>".$item->name."</td>";
                                    echo "<td>".$item->email."</td>";
                                    echo "<td>".$item->code."</td>";
                                    echo '<td><a href="#" data-toggle="modal" data-target="#modal-edit" class="modal-edit" data-id="'.$item->id.'" data-name="'.$item->name.'" data-email="'.$item->email.'" data-code="'.$item->code.'"><i class="fas fa-edit"></i></a>';
                                    echo '<a href="'.route('delete_admins', ['id' => $item->id]).'" style="padding-left: 15px; color: red" data-id="'.$item->id.'" onclick="return'. " confirm('Are you sure you want to delete this entry?'".')"><i class="fas fa-user-times"></i></a></td>';
                                    $ct++;
                                }
                            }
                        ?>
                      </tbody>
                      <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Code</th>
                            <th>Action</th>
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

      $('.modal').on('hidden.bs.modal', function (e) {
        $(this)
          .find("input,textarea,select")
             .val('')
             .end()
          .find("input[type=checkbox], input[type=radio]")
             .prop("checked", "")
             .end();
      });

      $(document).on('click', '.modal-edit', function(){
        var id = $(this).data('id');
        var name = $(this).data('name');
        var email = $(this).data('email');
        var code = $(this).data('code');

        $('#modal-edit input[name="id"]').val(id);
        $('#modal-edit input[name="name"]').val(name);
        $('#modal-edit input[name="email"]').val(email);
        $('#modal-edit input[name="code"]').val(code);
      });
    </script>
@stop