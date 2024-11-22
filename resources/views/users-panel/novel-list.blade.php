@extends('users-panel.master')
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
                <h3 class="card-title"> Novel List</h3>
                <a href="{{route('user-add-novel')}}"><button class="btn btn-primary float-right">ADD</button></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SR.NO.</th>
                    <th>TITILE</th>
                    <th>DOCUMENT</th>
                    <th>STATUS</th>
                    <th>APPROVED</th>
                    <th>ACTION</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i=1;
                    ?>
                    @foreach($novel_list as $novel)
                    <tr>
                      <td>{{$i++}}</td>
                      <td>{{$novel->title}}</td>
                      <td>
                          <a href="{{ asset($novel->document) }}" target="_blank">
                            <img style="width:40px;" src="{{ asset($novel->document) }}" alt="">
                              </a>
                          </td>
                      <td>
                        <button class="btn {{ $novel->status == 1 ? 'btn-success' : 'btn-danger' }}">
                          {{ $novel->status == 1 ? 'Active' : 'In-Active' }}
                        </button>
                      </td>
                      <td>
                      @if($novel->check_status == 0)
                          <button class="btn btn-warning">Pending</button>
                      @elseif($novel->check_status == 1)
                          <button class="btn btn-success">Approved</button>
                      @elseif($novel->check_status == 2)
                          <button class="btn btn-danger">Rejected</button>
                      @else
                          <button class="btn btn-secondary">Unknown Status</button>
                      @endif
                  </td>
                    <td>               
                      <a href="{{url('user-edit-novel/'.$novel->id)}}"><i class="fa fa-edit text-primary"></i>
                    

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
  @stop