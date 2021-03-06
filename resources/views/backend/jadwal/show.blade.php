@extends('backend.includes.app')

@section('content')

    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Transactions</h2>
                <p class="dashboard-subtitle">
                    Big result start from the small one
                </p>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('jadwal.create') }}" class="btn btn-success">Tambahkan Jadwal</a>
                    <a href="{{ route('getJadwal') }}" class="btn btn-success">Lihat Jadwal</a>
                </div>
            </div>
            <div class="dashboard-content">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="sell" role="tabpanel" aria-labelledby="sell-tab">
                        <div class="row mt-3">
                            <div class="col-12 mt-2">
                                <a class="card card-list d-block" href="/dashboard-transactions-details.html">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div id='calendar' class="text-center"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card col-md-3">
                                                <h3 class="mt-4"> Leave Information </h3>
                                                <table class="table table-hover mt-3">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Employee Name</th>
                                                            <th scope="col">Start Date</th>
                                                            <th scope="col">End Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($data as $item)
                                                            <tr>
                                                                <th scope="row">{{ $item->user->EmployeeName }}</th>
                                                                <td>{{ $item->Date_start }}</td>
                                                                <td>{{ $item->Date_end }}</td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $.ajax({
                url: '/getLeave/',
                type: 'get',
                dataType: 'json',
                success: function(r) {

                    console.log(r.data)
                    BuildCalendar(r.data);
                },
                error: function(e) {
                    sweetAlert("Load data gagal !!", "Error :" + e, "error");
                }
            })


        });

        function BuildCalendar(dataBirthDate) {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: '',
                    center: 'title',
                    right: 'prev,next today',

                },
                aspectRatio: 2,
                buttonText: {
                    today: 'Today',
                    month: 'Month',
                },
                themeSystem: 'default',
                events: dataBirthDate
            });
            calendar.render();
        }
    </script>


@endsection
