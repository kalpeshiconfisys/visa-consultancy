@extends('admin.layouts.app')

@section('title', 'Edit Visa Category')

@section('content')

    <div class="content-wrapper d-flex justify-content-center">
        <div class="col-12 col-xl-10 col-lg-9 col-md-10 m-auto">
            <div class="card shadow-sm border-0 rounded-4 my-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="fw-bold m-0">Edit Visa Category</h4>
                        <a href="{{ url('admin/visa-category') }}" class="btn btn-outline-danger">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </div>
                    <form action="{{ url('admin/visa-category/update', trim(base64_encode($visaCategory->id), '=')) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row g-4">
                            <div class="col-lg-7 col-md-12">
                                <div>
                                    <label class="form-label">Visa Title</label>
                                    <input type="text" class="form-control" name="title" id="title"
                                        placeholder="Enter Visa Category Title"
                                        value="{{ old('title', $visaCategory->title) }}" required>
                                </div>
                                <div class="mt-3">
                                    <label class="form-label">Short Description</label>
                                    <textarea class="form-control" name="short_description" rows="2" placeholder="Write short introduction..."
                                        required>{{ old('short_description', $visaCategory->short_description) }}</textarea>
                                </div>
                                <div class="mt-3">
                                    <label class="form-label">Full Description</label>
                                    <textarea id="editor" class="form-control" name="description" rows="5" placeholder="Write full details..."
                                        required>{{ old('description', $visaCategory->description) }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-12">
                                <div class="mt-3">
                                    <label class="form-label">Featured Image</label>
                                    <input type="file" class="form-control" name="image" id="imageInput"
                                        accept="image/png,image/jpeg,image/webp">
                                    @if ($visaCategory->image)
                                        <div class="mt-3"> <img id="previewImage" src="{{ $visaCategory->image }}"
                                                class="img-fluid rounded shadow-sm border"
                                                style="width:120px;border-radius:8px;">
                                        </div>
                                    @endif
                                </div>
                                 <div class="mt-3">
                                    <label class="form-label">Category Logo</label>
                                    <input type="file" class="form-control" name="category_logo" id="imageInputLogo"
                                        accept="image/png,image/jpeg,image/webp">
                                    @if ($visaCategory->category_logo)
                                        <div class="mt-3"> <img id="previewImageLogo"
                                                src="{{ $visaCategory->category_logo }}"
                                                class="img-fluid rounded shadow-sm border"
                                                style="width:120px;border-radius:8px;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" name="publish_is" value="1" class="btn btn-secondary px-4">
                                Draft
                            </button>
                                <button type="submit" name="publish_is" value="2" class="btn btn-secondary px-4">
                                    Update
                                </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- CKEditor -->
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // // CKEDITOR
            // ClassicEditor
            //     .create(document.querySelector('#editor'))
            //     .catch(error => console.error(error));

            // IMAGE PREVIEW
            const imgInput = document.getElementById("imageInput");
            const preview = document.getElementById("previewImage");

            imgInput.addEventListener("change", function(e) {
                const file = e.target.files[0];
                if (file) {
                    preview.src = URL.createObjectURL(file);
                }
            });
        }); 


        document.addEventListener("DOMContentLoaded", function() {

            // IMAGE PREVIEW
            const imgInput = document.getElementById("imageInputLogo");
            const preview = document.getElementById("previewImageLogo");

            imgInput.addEventListener("change", function(e) {
                const file = e.target.files[0];
                if (file) {
                    preview.src = URL.createObjectURL(file);
                }
            });
        });

        $(document).ready(function() {

            $('#editor').summernote({
                height: 600,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear', 'italic']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['codeview', 'help']]
                ],
                callbacks: {
                    onImageUpload: function(files) {
                        var maxFileSize = 3 * 1024 * 1024;

                        for (var i = 0; i < files.length; i++) {
                            var file = files[i];

                            if (file.size <= maxFileSize) {
                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    $('#post_content').summernote('insertImage', e.target.result);
                                };
                                reader.readAsDataURL(file);
                            } else {
                                alert('Image size exceeds the 3 MB limit.');
                            }
                        }
                    }
                }
            });

        });
    </script>

@endsection
