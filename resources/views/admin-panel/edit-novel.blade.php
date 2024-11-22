@extends('admin-panel.master')
  @section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Novel</h1>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> Edit Novel</h3>
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
              <form action="{{route('admin-update-novel')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="Title">Title</label>
                    <input type="hidden" class="form-control" id="id" placeholder="Id" name="id" value="{{$novel->id}}" required>
                    <input type="text" class="form-control" id="title" placeholder="Title" name="title" value="{{$novel->title}}" required>
                    @if ($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                  @endif	
                </div>
                <div class="form-group">
                    <label for="Description">Description</label>
                    <div id="editor" class="form-control" style="min-height: 150px;">{!! $novel->description !!}</div>
                    <input type="hidden" name="description" id="description" value="" required>
                </div>
                @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                  @endif	
                <div class="form-group">
                    <label for="file-upload">Please select and upload a document in JPG, PNG format.</label>
                    <div id="drop-area" style="border: 2px dashed #ccc; padding: 20px; text-align: center;">
                        <p>Drag & drop an image file here, or click to select a file</p>
                        <input type="file" name="document" class="form-control" id="file-upload" accept=".jpg, .jpeg, .png" style="display:none;">
                    </div>
                    @if ($errors->has('document'))
                        <span class="text-danger">{{ $errors->first('document') }}</span>
                  @endif
                    <div id="preview" style="margin-top: 20px;">
                        <img style="max-width: 100%; max-height: 200px;" src="{{$novel->document}}" alt="">
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Update</button>
            </form>

              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
    </section>
  </div>
<script>
    const dropArea = document.getElementById('drop-area');
    const fileInput = document.getElementById('file-upload');
    const preview = document.getElementById('preview');
    dropArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropArea.style.backgroundColor = '#f0f0f0'; // Highlight area
    });

    dropArea.addEventListener('dragleave', () => {
        dropArea.style.backgroundColor = ''; // Reset area
    });

    dropArea.addEventListener('drop', (e) => {
        e.preventDefault();
        dropArea.style.backgroundColor = ''; // Reset area
        const files = e.dataTransfer.files;
        handleFileUpload(files[0]);
    });
    dropArea.addEventListener('click', () => {
        fileInput.click();
    });
    fileInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        handleFileUpload(file);
    });
    function handleFileUpload(file) {
        if (file && (file.type === 'image/jpeg' || file.type === 'image/png')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '100%';
                img.style.maxHeight = '200px';
                preview.innerHTML = ''; // Clear any previous preview
                preview.appendChild(img);
            }
            reader.readAsDataURL(file);
        } else {
            alert('Please upload a valid image file (JPG, PNG).');
        }
    }
</script>

@stop