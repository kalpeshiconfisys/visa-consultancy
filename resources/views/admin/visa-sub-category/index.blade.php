@extends('admin.layouts.app')
@section('title', 'Visa Category List')
@section('content')
    <div class="content-wrapper d-flex justify-content-center">
        <div class="col-12 col-xl-11 col-lg-9 col-md-10 m-auto">
            <div class="card shadow-sm border-0 rounded-0 my-4">
                <div class="card-body p-4">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title text-dark fw-bold m-0">Visa Sub Category List</h4>
                        </div>
                        <a href="{{ url('admin/visa-sub-category/create') }}"
                            class="btn app-btn-primary rounded-circle d-flex align-items-center  justify-content-center btn btn-sm btn-outline-secondary rounded-pill px-2  "
                            style="width:35px; height:35px;">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table align-middle" style="min-width: 1000px;">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-dark">#</th>
                                        <th class="text-dark">Title</th>
                                        <th class="text-dark"> Status</th>
                                        <th class="text-dark">Date</th>
                                        <th class="text-dark">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($subCategories as $key => $category)
                                        <tr>
                                            <td>{{ $subCategories->firstItem() + $key }}</td>
                                            <td>{{ $category->title }}</td>
                                            <td>
                                                @if ($category->publish_is == 1)
                                                    <span class="text-danger">Draft</span>
                                                @else
                                                    <span class="text-success">Publish</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $category->date_modified
                                                    ? \Carbon\Carbon::parse($category->date_modified)->timezone('Asia/Kolkata')->format('d/m/Y h:i A')
                                                    : '-' }}
                                            </td>

                                            <td>
                                                <div class="d-flex align-items-center gap-2">

                                                    {{-- VIEW --}}
                                                    <a href="{{ url('admin/visa-sub-category/show/' . trim(base64_encode($category->id), '=')) }}"
                                                        class="btn btn-sm btn-outline-secondary rounded-pill px-2  ">
                                                        <i class="fa-solid fa-eye me-1"></i>
                                                    </a>

                                                    {{-- EDIT --}}


                                                    <a href="{{ route('admin.visa-sub-category.edit', trim(base64_encode($category->id), '=')) }}"
                                                        class="btn btn-sm btn-outline-secondary rounded-pill px-2">
                                                        <i class="fa-solid fa-pen-to-square me-1"></i>
                                                    </a>
                                                    {{-- DELETE --}}
                                                    <button class="btn btn-sm btn-outline-secondary rounded-pill px-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $category->id }}">
                                                        <i class="fa-solid fa-trash me-1"></i>
                                                    </button>

                                                </div>
                                                {{-- Delete Modal --}}
                                                <div class="modal fade" id="deleteModal{{ $category->id }}" tabindex="-1"
                                                    aria-labelledby="deleteModalLabel{{ $category->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="deleteModalLabel{{ $category->id }}">
                                                                    Confirm Delete
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <div class="modal-body">
                                                                Are you sure you want to delete this category?
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    Cancel
                                                                </button>

                                                                <form
                                                                    action="{{ route('admin.visa-sub-category.destroy' , trim(base64_encode($category->id), '=')) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">
                                                                        Yes, Delete
                                                                    </button>
                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">No Visa Categories found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-end mt-1">
                            {{ $subCategories->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
