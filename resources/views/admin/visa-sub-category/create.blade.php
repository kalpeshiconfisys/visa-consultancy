@extends('admin.layouts.app')

@section('title', 'Add Visa Sub Category')

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

    <div class="content-wrapper d-flex justify-content-center fw-bold fst-italic">
        <div class="col-12 col-xl-10 col-lg-10 col-md-11 m-auto">
            <div class="card shadow-sm border-0 rounded-4 my-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between mb-3">
                        <h4 class="fw-bold">Add Visa Sub Category</h4>
                        <a href="{{ route('admin.visa-sub-category.index') }}" class="btn btn-outline-danger">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </div>
                    <form action="{{ route('admin.visa-sub-category.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class=" col-6 mb-4">
                                <label class="fw-bold mb-1">Select Visa Category</label>
                                <select name="category_id" class="form-control" required>
                                    <option value="" disabled selected>Select Category</option>
                                    @foreach ($categories as $cat)
                                        <option class="fw-bold" value="{{ $cat->id }}">{{ $cat->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class=" col-6 mb-4">
                                <label class="fw-bold mb-1">Content Type</label>
                                <select id="contentType" class="form-control" name="content_type" required>
                                    <option class="fw-bold" value="both">Description + Bullets</option>
                                    <option class="fw-bold" value="description">Only Description</option>
                                    <option class="fw-bold" value="bullets">Only Bullets</option>
                                </select>
                            </div>
                        </div>
                        <div id="subCategoryWrapper">
                            <div class="subCategoryBox card p-3 mb-3 border rounded shadow-sm">
                                <div class="mt-2">
                                    <label class="fw-bold">Title</label>
                                    <input type="text" name="title[]" class="form-control" placeholder="Enter Title"
                                        required>
                                </div>
                                <div class="mt-2 descBox">
                                    <label class="fw-bold">Description</label>
                                    <textarea name="description[]" class="form-control" rows="2" placeholder="Enter Description" required></textarea>
                                </div>
                                <div class="mt-2 bulletsArea">
                                    <label class="fw-bold">Bullets</label>
                                    <div class="row bulletItem mb-2 align-items-center">
                                        <div class="col-10">
                                            <input type="text" name="bullets[0][]" class="form-control"
                                                placeholder="Enter bullet">
                                        </div>
                                        <div class="col-2 text-start mt-0 ">
                                            <button type="button" class="bullet-remove-btn removeBullet">
                                                ✕
                                            </button>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-success addBullet  fst-italic">
                                        + Add Bullet
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" name="publish_is" value="1"
                                class="btn btn-secondary px-4   fst-italic">
                                Draft
                            </button>
                            <button type="submit" name="publish_is" value="2"
                                class="btn btn-secondary px-4   fst-italic">
                                Publish
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        let index = 1;
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
        applyContentRule($(".subCategoryBox"));
        $("#contentType").on("change", function() {
            $(".subCategoryBox").each(function() {
                applyContentRule($(this));
            });
        });
        $("#addMore").click(function() {
            let box = $(".subCategoryBox").first().clone();
            box.find("input").val("");
            box.find("textarea").val("");
            box.find(".removeBox").removeClass("d-none");
            box.find(".bulletItem").not(":first").remove();
            box.find("input[name^='bullets']").attr("name", "bullets[" + index + "][]");
            $("#subCategoryWrapper").append(box);
            applyContentRule(box);
            index++;
        });

        $(document).on("click", ".removeBox", function() {
            $(this).closest(".subCategoryBox").remove();
        });

        $(document).on("click", ".addBullet", function() {
            let bulletBox = $(this).closest(".bulletsArea");
            let html = `
                <div class="row bulletItem mb-2 align-items-center">
                    <div class="col-10">
                        <input type="text"
                            name="bullets[` + (index - 1) + `][]"
                            class="form-control"
                            placeholder="Enter bullet">
                    </div>
                    <div class="col-2 text-start">
                        <button type="button"
                            class="bullet-remove-btn removeBullet">
                            ✕
                        </button>
                    </div>
                </div>
            `;
            bulletBox.find(".addBullet").before(html);
        });

        $(document).on("click", ".removeBullet", function() {
            $(this).closest(".bulletItem").remove();
        });
    </script>

@endsection
