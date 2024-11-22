@extends('admin-panel.master')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Novel List</h1>
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
                        <h3 class="card-title">Novel List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SR.NO.</th>
                                    <th>ADDED BY</th>
                                    <th>TITLE</th>
                                    <th>DOCUMENT</th>
                                    <th>STATUS</th>
                                    <th>APPROVED</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach($novel_list as $novel)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $novel->name }}</td>
                                    <td>{{ $novel->title }}</td>
                                    <td>
                                        <a href="{{ asset($novel->document) }}" target="_blank">
                                            <img style="width:40px;" src="{{ asset($novel->document) }}" alt="">
                                        </a>
                                    </td>
                                    <td>
                                    <select name="status" class="form-control change_status" data-novel-id="{{ $novel->id }}">
                                            <option value="1" @selected($novel->status == 1)>Active</option>
                                            <option value="0" @selected($novel->status == 0)>In-Active</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="check_status" class="form-control check_status" data-novel-id="{{ $novel->id }}">
                                            <option value="0" @selected($novel->check_status == 0)>Pending</option>
                                            <option value="1" @selected($novel->check_status == 1)>Approved</option>
                                            <option value="2" @selected($novel->check_status == 2)>Rejected</option>
                                        </select>
                                    </td>
                                    <td>
                                        <a href="{{url('admin-edit-novel/'.$novel->id)}}"><i class="fa fa-edit text-primary"></i>
                                        <a href="{{url('admin-novel-delete/'.$novel->id)}}"><i class="fas fa-trash-alt text-danger"></i></a>
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

<script>
  $(function () {
    // Use a class instead of ID for multiple elements
    $('.check_status').on('change', function () {
        var status = $(this).val(); // Get the selected status value
        var novelId = $(this).data('novel-id'); // Get the novel ID from the select element's data attribute
        
        $.ajax({
            url: '/admin-novel-check-status', // Your endpoint to update the status
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // Include CSRF token for security
                id: novelId,
                check_status: status
            },
            success: function(res) {
                toastr.success(res.message);
            },
            error: function(xhr) {
                console.error('Error: ' + xhr.error);
            }
        });
    });
    $('.change_status').on('change', function () {
        var status = $(this).val(); // Get the selected status value
        var novelId = $(this).data('novel-id'); // Get the novel ID from the select element's data attribute
        
        $.ajax({
            url: '/admin-novel-status',  // Your endpoint to update the status
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // Include CSRF token for security
                id: novelId,
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
