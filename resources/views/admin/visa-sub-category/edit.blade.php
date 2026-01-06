@extends('admin.layouts.app')

@section('title', 'Edit Visa Sub Category')

@section('content')

    <style>
        .bullet-remove-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #dc3545;
            border: none;
            color: white;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: 0.2s;
        }

        .bullet-remove-btn:hover {
            background: #b02a37;
        }
    </style>

    <div class="content-wrapper d-flex justify-content-center">
        <div class="col-12 col-xl-10 col-lg-10 col-md-11 m-auto">

            <div class="card shadow-sm border-0 rounded-4 my-4">
                <div class="card-body p-4">

                    <div class="d-flex justify-content-between mb-3">
                        <h4 class="fw-bold">Edit Visa Sub Category</h4>
                        <a href="{{ route('admin.visa-sub-category.index') }}" class="btn btn-outline-danger">
                            Back
                        </a>
                    </div>

                    <form action="{{ route('admin.visa-sub-category.update', $subCategories->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        {{-- CATEGORY --}}
                        <div class="mb-4">
                            <label class="fw-bold mb-1">Select Visa Category</label>
                            <select name="category_id" class="form-control" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ $subCategories->category_id == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- CONTENT TYPE --}}
                        <div class="mb-4">
                            <label class="fw-bold mb-1">Content Type</label>
                            <div class="col-10 mb-4"> 
                                <select id="contentType" class="form-control" name="content_type" required>
                                    <option value="both" {{ $subCategories->content_type == 'both' ? 'selected' : '' }}>
                                        Description + Bullets
                                    </option>

                                    <option value="description"
                                        {{ $subCategories->content_type == 'description' ? 'selected' : '' }}>
                                        Only Description
                                    </option>

                                    <option value="bullets"
                                        {{ $subCategories->content_type == 'bullets' ? 'selected' : '' }}>
                                        Only Bullets
                                    </option>
                                </select>
                            </div>

                        </div>

                        {{-- MAIN FORM BOX --}}
                        <div id="subCategoryWrapper">

                            @php
                                $bullets = $subCategories->bullets ? json_decode($subCategories->bullets, true) : [];
                            @endphp

                            <div class="subCategoryBox card p-3 mb-3 border rounded shadow-sm" data-index="0">

                                <h6 class="fw-bold text-primary mb-2">Sub Category</h6>

                                <input type="hidden" name="id[]" value="{{ $subCategories->id }}">

                                {{-- TITLE --}}
                                <label class="fw-bold">Title</label>
                                <input type="text" name="title[]" value="{{ $subCategories->title }}"
                                    class="form-control" required>

                                {{-- DESCRIPTION --}}
                                <div class="mt-2 descBox">
                                    <label class="fw-bold">Description</label>
                                    <textarea name="description[]" class="form-control" rows="2">{{ $subCategories->description }}</textarea>
                                </div>

                                {{-- BULLETS --}}
                                <div class="mt-2 bulletsArea">
                                    <label class="fw-bold">Bullets</label>

                                    <div class="bulletWrapper">

                                        @if (count($bullets) > 0)
                                            @foreach ($bullets as $b)
                                                <div class="bulletItem input-group mb-2 align-items-center">
                                                    <input type="text" name="bullets[0][]" value="{{ $b }}"
                                                        class="form-control">
                                                    <button type="button"
                                                        class="bullet-remove-btn removeBullet ms-2">✕</button>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="bulletItem input-group mb-2 align-items-center">
                                                <input type="text" name="bullets[0][]" class="form-control"
                                                    placeholder="Enter bullet">
                                                <button type="button"
                                                    class="bullet-remove-btn removeBullet ms-2">✕</button>
                                            </div>
                                        @endif

                                    </div>

                                    <button type="button" class="btn btn-sm btn-success addBullet rounded-pill mt-1">
                                        + Add Bullet
                                    </button>

                                </div>

                            </div>

                        </div>

                        {{-- ACTION BUTTONS --}}
                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" name="publish_is" value="1"
                                class="btn btn-secondary px-4 rounded-pill">
                                Save as Draft
                            </button>

                            <button type="submit" name="publish_is" value="2"
                                class="btn btn-success px-4 rounded-pill">
                                Update & Publish
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        // CONTENT RULE
        function applyContentRule(box) {
            let type = $("#contentType").val();

            if (type === "description") {
                box.find(".descBox").show();
                box.find(".bulletsArea").hide();
            } else if (type === "bullets") {
                box.find(".descBox").hide();
                box.find(".bulletsArea").show();
            } else {
                box.find(".descBox").show();
                box.find(".bulletsArea").show();
            }
        }

        // APPLY INITIALLY
        applyContentRule($(".subCategoryBox"));

        // ON CHANGE TYPE
        $("#contentType").on("change", function() {
            $(".subCategoryBox").each(function() {
                applyContentRule($(this));
            });
        });

        // ADD BULLET
        $(document).on("click", ".addBullet", function() {

            let box = $(this).closest(".subCategoryBox");
            let idx = box.data("index");

            box.find(".bulletWrapper").append(`
        <div class="bulletItem input-group mb-2 align-items-center">
            <input type="text" name="bullets[${idx}][]" class="form-control" placeholder="Enter bullet">
            <button type="button" class="bullet-remove-btn removeBullet ms-2">✕</button>
        </div>
    `);
        });

        // REMOVE BULLET
        $(document).on("click", ".removeBullet", function() {
            $(this).closest(".bulletItem").remove();
        });
    </script>

@endsection
