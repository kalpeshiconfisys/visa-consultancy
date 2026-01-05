@extends('admin.layouts.app')

@section('title', ' ')

@section('content')
    <div class="content-wrapper d-flex justify-content-center">
        <div class="col-12 col-xl-11 col-lg-9 col-md-10 m-auto">

            <div class="card shadow-sm border-0 rounded-4 my-4">
                <div class="card-body p-4">
                    <!-- Dashboard Greeting -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card shadow-sm rounded-4 p-4">
                                <h2 class="fw-bold">Welcome, Admin!</h2>
                                <p class="text-muted fs-6">Manage visas, clients, and applications efficiently from your
                                    dashboard.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Summary Cards -->
                    <div class="row g-4 mb-4">
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="card shadow-sm border-0 rounded-4 p-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 50px; height:50px;">
                                        <i class="fa-solid fa-passport"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="mb-0">Visa Categories</h5>
                                        <span class="text-muted fs-6">25</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="card shadow-sm border-0 rounded-4 p-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 50px; height:50px;">
                                        <i class="fa-solid fa-file-invoice"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="mb-0">Visa Applications</h5>
                                        <span class="text-muted fs-6">120</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="card shadow-sm border-0 rounded-4 p-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 50px; height:50px;">
                                        <i class="fa-solid fa-users"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="mb-0">Clients</h5>
                                        <span class="text-muted fs-6">80</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="card shadow-sm border-0 rounded-4 p-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 50px; height:50px;">
                                        <i class="fa-solid fa-calendar-check"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="mb-0">Appointments</h5>
                                        <span class="text-muted fs-6">15</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Section -->
                    <div class="row g-4 mb-4">

                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <div class="card shadow-sm rounded-4 p-3">
                                <h5 class="fw-bold mb-3">Application Status</h5>
                                <canvas id="statusChart" height="250"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Applications Table -->
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="card shadow-sm rounded-4 p-3">
                                <h5 class="fw-bold mb-3">Recent Visa Applications</h5>
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Applicant Name</th>
                                                <th>Visa Type</th>
                                                <th>Status</th>
                                                <th>Submission Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>John Doe</td>
                                                <td>Tourist Visa</td>
                                                <td><span class="badge bg-warning">Pending</span></td>
                                                <td>2026-01-01</td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-outline-secondary"><i
                                                            class="fa-solid fa-eye"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Jane Smith</td>
                                                <td>Work Visa</td>
                                                <td><span class="badge bg-success">Approved</span></td>
                                                <td>2026-01-01</td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-outline-secondary"><i
                                                            class="fa-solid fa-eye"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Michael Brown</td>
                                                <td>Student Visa</td>
                                                <td><span class="badge bg-danger">Rejected</span></td>
                                                <td>2026-01-02</td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-outline-secondary"><i
                                                            class="fa-solid fa-eye"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Monthly Applications Chart
        const ctx = document.getElementById('applicationsChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Applications',
                    data: [12, 19, 14, 25, 20, 30, 22, 18, 28, 35, 40, 45],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });

        // Application Status Pie Chart
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Approved', 'Pending', 'Rejected'],
                datasets: [{
                    label: 'Applications',
                    data: [50, 30, 20],
                    backgroundColor: ['#198754', '#ffc107', '#dc3545']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    </script>
@endsection
