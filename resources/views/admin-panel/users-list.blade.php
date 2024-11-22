@extends('admin-panel.master')
  @section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User List</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> User List</h3>

              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SR.NO.</th>
                    <th>NAME</th>
                    <th>MOBILE NUMBER</th>
                    <th>EMAIL-ID</th>
                    <th>STATUS</th>
                    <th>ACTION</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i=1;
                    ?>
                    @foreach($users as $user)
                    <tr>
                      <td>{{$i++}}</td>
                      <td>{{$user->name}}</td>
                      <td>{{$user->mobile_number}}</td>
                      <td>{{$user->email}}</td>
                      <td>
                        <select name="status" class="form-control change_status" data-user-id="{{ $user->id }}">
                                <option value="1" @selected($user->status == 1)>Active</option>
                                <option value="0" @selected($user->status == 0)>In-Active</option>
                            </select>
                        </td>
                      <td>
                    <a href="{{url('admin-user-delete/'.$user->id)}}"><i class='fas fa-trash-alt text-danger'></i></a>

                    </a>   
                    </td>
                  </tr>
                    @endforeach
                  </tbody>
                 
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <script>
  $(function () {
    $('.change_status').on('change', function () {
        var status = $(this).val(); // Get the selected status value
        var userId = $(this).data('user-id'); // Get the novel ID from the select element's data attribute
        
        $.ajax({
            url: '/admin-user-status',  // Your endpoint to update the status
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // Include CSRF token for security
                id: userId,
                status: status
            },
            success: function (res) {
                // Using toastr for success notification
                toastr.success(res.message);
            },
            error: function (xhr) {
                // Using toastr for error notification
                console.error('Error: ' + xhr.responseText);
                toastr.error('Failed to update status. Please try again.');
            }
        });
    });
});
</script>
  @stop