@extends('admin.layouts.app')

@section('title', 'Visa Category Details')

@section('content')
    <div class="container-fluid">


        <div class="row">
            <div class="col-8 m-auto">
                <div style="border-bottom:1px solid #e0e2e6;">
                    <div class="breadcrumb-bar">
                        <a href="{{ route('admin.visa-sub-category.index') }}"
                            class="d-inline-flex align-items-center text-decoration-none">
                            <span class="breadcrumb-icon me-2">
                                <i class="fas fa-arrow-left"></i>
                            </span>
                            Visa Sub Category Details
                        </a>
                    </div>
                </div>

                <div class="employee-section-header d-flex align-items-center justify-content-between"
                    style="border-bottom:1px solid #e0e2e6;">
                    <div>
                        <h3 class="fw-bold">{{ $visaSubCategory->title }}</h3>
                    </div>
                    <div class="d-flex align-items-center">

                        <!-- Edit Button -->
                        <a href="{{ route('admin.visa-sub-category.edit', trim(base64_encode($visaSubCategory->id), '=')) }}"
                            class="icon-btn icon-btn-edit me-2" title="Edit">
                            <i class="fas fa-pencil-alt"></i>
                        </a>

                        <!-- Delete Button Trigger -->
                        <button type="button" class="icon-btn icon-btn-delete" title="Delete" data-bs-toggle="modal"
                            data-bs-target="#deleteVisaModal{{ $visaSubCategory->id }}">
                            <i class="fa fa-trash-alt" aria-hidden="true"></i>
                        </button>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteVisaModal{{ $visaSubCategory->id }}" tabindex="-1"
                            aria-labelledby="deleteVisaModalLabel{{ $visaSubCategory->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteVisaModalLabel{{ $visaSubCategory->id }}">Confirm
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
                                            action="{{ route('admin.visa-sub-category.destroy', trim(base64_encode($visaSubCategory->id), '=')) }}"
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


        <div class="row justify-content-center mt-4">
            <div class="col-lg-7 col-md-9">
                <div class="card border-1 position-relative" style="border-color:#d3d6db;">
                    <div class="card-header position-absolute" style="border-bottom:none; top:-20px;">
                        <span
                            style="background:#868e96; color:#fff; padding:2px 18px; border-radius:2px; font-size:1rem; font-weight:500; top:18px; left:20px;">
                            VISA SUB CATEGORY DETAILS
                        </span>
                    </div>
                    <div class="card-body pt-4">
                        <table class="table mb-0" style="border: none;">
                            <tbody>
                                <tr class="border-bottom">
                                    <td class="fw-bold" style="width:180px; border:none;">Title</td>
                                    <td style="border:none;">{{ $visaSubCategory->title }}</td>
                                </tr>
                                @if ($visaSubCategory->content_type == 'description' || $visaSubCategory->content_type == 'both')
                                    <tr class="border-bottom">
                                        <td class="fw-bold" style="border:none;">Description</td>
                                        <td style="border:none;">{!! nl2br(e($visaSubCategory->description)) !!}</td>
                                    </tr>
                                @endif
                                <tr class="border-bottom">
                                    <td class="fw-bold" style="border:none;">Publish Status</td>
                                    <td style="border:none;">
                                        @if ($visaSubCategory->publish_is == 2)
                                            <span class="badge bg-success">Published</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Draft</span>
                                        @endif
                                    </td>
                                </tr>
                                @if ($visaSubCategory->content_type == 'bullets' || $visaSubCategory->content_type == 'both')
                                    <tr class="border-bottom">
                                        <td class="fw-bold" style="border:none;">Bullets</td>
                                        <td>
                                            @php
                                                $bullets = is_array($visaSubCategory->bullets)
                                                    ? $visaSubCategory->bullets
                                                    : json_decode($visaSubCategory->bullets, true);
                                            @endphp

                                            @if (!empty($bullets))
                                                <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#bulletsModal">
                                                    View Bullets
                                                </button>
                                            @else
                                                <span class="text-muted">No bullets available</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                                <tr class="border-bottom">
                                    <td class="fw-bold" style="border:none;">Date</td>
                                    <td style="border:none;">
                                        {{ $visaSubCategory->date_modified
                                            ? \Carbon\Carbon::parse($visaSubCategory->date_modified)->timezone('Asia/Kolkata')->format('d/m/Y h:i A')
                                            : '-' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="modal fade" id="viewImageModal" tabindex="-1" aria-labelledby="viewImageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-body p-0">
                    <img id="previewImage" src="" class="img-fluid w-100" alt="Visa Category Image">
                </div>
            </div>
        </div>
    </div>

     
    @if (!empty($bullets))
        <div class="modal fade" id="bulletsModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content shadow-lg border-0">

                    <div class="modal-header bg-secondary text-white">
                        <h5 class="modal-title">
                            <i class="fa-solid fa-list-check me-2"></i>
                            Visa Sub Category Bullets
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="p-2">
                            <ul class="m-0 p-0">
                                @foreach ($bullets as $b)
                                    <li class="mb-2 d-flex">
                                        <i class="fa-solid fa-check text-success me-2 mt-1"></i>
                                        <span>{!! $b !!}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>

                </div>
            </div>
        </div>
    @endif

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
