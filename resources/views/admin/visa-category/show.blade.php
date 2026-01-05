@extends('admin.layouts.app')

@section('title', 'Visa Category Details')

@section('content')
    <div class="container-fluid">

        <!-- Breadcrumb & Header -->
        <div class="row">
            <div class="col-8 m-auto">
                <div style="border-bottom:1px solid #e0e2e6;">
                    <div class="breadcrumb-bar">
                        <a href="{{ url('admin/visa-category') }}"
                            class="d-inline-flex align-items-center text-decoration-none">
                            <span class="breadcrumb-icon me-2">
                                <i class="fas fa-arrow-left"></i>
                            </span>
                            Visa Category Details
                        </a>
                    </div>
                </div>

                <div class="employee-section-header d-flex align-items-center justify-content-between"
                    style="border-bottom:1px solid #e0e2e6;">
                    <div>
                        <h3 class="fw-bold">{{ $visaCategory->title }}</h3>
                    </div>
                    <div class="d-flex align-items-center">

                        <!-- Edit Button -->
                        <a href="{{ url('admin/visa-category/edit', trim(base64_encode($visaCategory->id), '=')) }}"
                            class="icon-btn icon-btn-edit me-2" title="Edit">
                            <i class="fas fa-pencil-alt"></i>
                        </a>

                        <!-- Delete Button Trigger -->
                        <button type="button" class="icon-btn icon-btn-delete" title="Delete" data-bs-toggle="modal"
                            data-bs-target="#deleteVisaModal{{ $visaCategory->id }}">
                            <i class="fa fa-trash-alt" aria-hidden="true"></i>
                        </button>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteVisaModal{{ $visaCategory->id }}" tabindex="-1"
                            aria-labelledby="deleteVisaModalLabel{{ $visaCategory->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteVisaModalLabel{{ $visaCategory->id }}">Confirm
                                            Delete</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this Visa Category?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <form
                                            action="{{ url('admin/visa-category/destroy', trim(base64_encode($visaCategory->id), '=')) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Details Card -->
        <div class="row justify-content-center mt-4">
            <div class="col-lg-7 col-md-9">
                <div class="card border-1 position-relative" style="border-color:#d3d6db;">
                    <div class="card-header position-absolute" style="border-bottom:none; top:-20px;">
                        <span
                            style="background:#868e96; color:#fff; padding:2px 18px; border-radius:2px; font-size:1rem; font-weight:500; top:18px; left:20px;">
                            VISA CATEGORY DETAILS
                        </span>
                    </div>
                    <div class="card-body pt-4">
                        <table class="table mb-0" style="border: none;">
                            <tbody>
                                <tr class="border-bottom">
                                    <td class="fw-bold" style="width:180px; border:none;">Title</td>
                                    <td style="border:none;">{{ $visaCategory->title }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <td class="fw-bold" style="border:none;">Short Description</td>
                                    <td style="border:none;">{{ $visaCategory->short_description }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <td class="fw-bold" style="border:none;">Description</td>
                                    <td style="border:none;">{!! nl2br(e($visaCategory->description)) !!}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <td class="fw-bold" style="border:none;">Publish Status</td>
                                    <td style="border:none;">
                                        @if ($visaCategory->publish_is == 2)
                                            <span class="badge bg-success">Published</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Draft</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <td class="fw-bold" style="border:none;">Image</td>
                                    <td style="border:none;">
                                        @php
                                            $img = $visaCategory->image;
                                            $src = null;
                                            $filePath = null;

                                            if ($img) {
                                                if (Str::startsWith($img, ['http://', 'https://'])) {
                                                    $src = $img;
                                                } elseif (Str::startsWith($img, ['/uploads', 'uploads'])) {
                                                    $cleanPath = ltrim($img, '/');
                                                    $src = asset($cleanPath);
                                                    $filePath = public_path($cleanPath);
                                                } else {
                                                    $src = asset('uploads/visa-category/' . $img);
                                                    $filePath = public_path('uploads/visa-category/' . $img);
                                                }
                                            }
                                        @endphp

                                        @if ($src && (!$filePath || file_exists($filePath)))
                                            <img src="{{ $src }}" class="img-fluid rounded shadow-sm border"
                                                alt="Visa Image" style="width:120px;border-radius:8px;">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif


                                    </td>

                                </tr>
                                <tr class="border-bottom">
                                    <td class="fw-bold" style="border:none;">Category Logo</td>
                                    <td style="border:none;">
                                        @php
                                            $img = $visaCategory->category_logo;
                                            $src = null;
                                            $filePath = null;

                                            if ($img) {
                                                if (Str::startsWith($img, ['http://', 'https://'])) {
                                                    $src = $img;
                                                } elseif (Str::startsWith($img, ['/uploads', 'uploads'])) {
                                                    $cleanPath = ltrim($img, '/');
                                                    $src = asset($cleanPath);
                                                    $filePath = public_path($cleanPath);
                                                } else {
                                                    $src = asset('uploads/category-logo/' . $img);
                                                    $filePath = public_path('uploads/category_logo/' . $img);
                                                }
                                            }
                                        @endphp
                                        @if ($src && (!$filePath || file_exists($filePath)))
                                            <img src="{{ $src }}" class="img-fluid rounded shadow-sm border"
                                                alt="Visa Image" style="width:120px;border-radius:8px;">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Preview Modal -->
    <div class="modal fade" id="viewImageModal" tabindex="-1" aria-labelledby="viewImageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-body p-0">
                    <img id="previewImage" src="" class="img-fluid w-100" alt="Visa Category Image">
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var viewImageModal = document.getElementById('viewImageModal');
            viewImageModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var img = button.src || button.getAttribute('src');
                var previewImage = document.getElementById('previewImage');
                previewImage.src = img;
            });
        });
    </script>
@endpush
