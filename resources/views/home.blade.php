@extends('layouts.backend.app')
@section('css')
    <style>
        .clock {
            font-size: 35px;
            font-family: "Arial";
            letter-spacing: 3px;
            font-weight: 600;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card p-3 text-center">
                <blockquote class="blockquote mb-0 border-dark">
                    <h5><strong>WELCOME TO OUR SCHOOL</strong></h5>
                    <h2><strong>{{ config('site.title') }}</strong></h2>
                    <ul class="social-links list-unstyled mt-3 mb-0">
                        <li>
                            <a class="btn btn-default bg-info text-white" href="{{ config('site.facebook') }}" target="_blank"
                                data-toggle="tooltip" data-placement="top" data-original-title="Facebook"><i class="fa-brands fa-facebook"></i></i>
                            </a>
                        </li>
                        <li>
                            <a class="btn btn-default bg-info text-white" href="{{ config('site.twitter') }}" target="_blank"
                                data-toggle="tooltip" data-placement="top" data-original-title="Twitter">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a class="btn btn-default bg-info text-white" href="{{ config('site.youtube') }}" target="_blank"
                                data-toggle="tooltip" data-placement="top" data-original-title="Youtube"><i class="fa-brands fa-youtube"></i>
                            </a>
                        </li>
                        <li>
                            <a class="btn btn-default bg-info text-white" href="{{ config('site.linkedin') }}" target="_blank"
                                data-toggle="tooltip" data-placement="top" data-original-title="Linkedin"><i class="fa-brands fa-linkedin"></i></a>
                        </li>
                    </ul>
                </blockquote>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <blockquote class="blockquote mb-0 border-dark">
                        <div id="MyClockDisplay" class="clock my-4" onload="showTime()"></div>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card p-3">
                <blockquote class="blockquote mb-0 border-dark">
                    <div class="clearfix">
                        <div class="float-left">
                            <img src="{{ asset('backend/assets/images/users.png') }}" alt="student" width="70px">
                        </div>
                        <div class="number float-right text-right">
                            <h3><span class="font700">{{ $users ? : '' }}</span></h3>
                            <h5><strong>Total Employee</strong></h5>
                        </div>
                    </div>
                </blockquote>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card p-3">
                <blockquote class="blockquote mb-0 border-dark">
                    <div class="clearfix">
                        <div class="float-left">
                            <img src="{{ asset('backend/assets/images/users.png') }}" alt="student" width="70px">
                        </div>
                        <div class="number float-right text-right">
                            <h3><span class="font700">500</span></h3>
                            <h5><strong>Total Teachers</strong></h5>
                        </div>
                    </div>
                </blockquote>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card p-3">
                <blockquote class="blockquote mb-0 border-dark">
                    <div class="clearfix">
                        <div class="float-left">
                            <img src="{{ asset('backend/assets/images/users.png') }}" alt="student" width="70px">
                        </div>
                        <div class="number float-right text-right">
                            <h3><span class="font700">{{ $student }}</span></h3>
                            <h5><strong>Total Student</strong></h5>
                        </div>
                    </div>
                </blockquote>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card p-3">
                <blockquote class="blockquote mb-0 border-dark">
                    <div class="clearfix">
                        <div class="float-left">
                            <h5><strong>Total Expense</strong></h5>
                        </div>
                        <div class="number float-right text-right">
                            <h3><span class="font700">$100</span></h3>

                        </div>
                    </div>
                </blockquote>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card p-3">
                <blockquote class="blockquote mb-0 border-dark">
                    <div class="clearfix">
                        <div class="float-left">
                            <h5><strong>Total Department</strong></h5>
                        </div>
                        <div class="number float-right text-right">
                            <h3><span class="font700">5</span></h3>
                        </div>
                    </div>
                </blockquote>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card p-3">
                <blockquote class="blockquote mb-0 border-dark">
                    <div class="clearfix">
                        <div class="float-left">
                            <h5><strong>Upcoming Exam</strong></h5>
                        </div>
                        <div class="number float-right text-right">
                            <h3><span class="font700">{{ $student }}</span></h3>

                        </div>
                    </div>
                </blockquote>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function showTime() {
            var date = new Date();
            var h = date.getHours(); // 0 - 23
            var m = date.getMinutes(); // 0 - 59
            var s = date.getSeconds(); // 0 - 59
            var session = "AM";

            if (h == 0) {
                h = 12;
            }

            if (h > 12) {
                h = h - 12;
                session = "PM";
            }

            h = (h < 10) ? "0" + h : h;
            m = (m < 10) ? "0" + m : m;
            s = (s < 10) ? "0" + s : s;

            var time = h + ":" + m + ":" + s + " " + session;
            document.getElementById("MyClockDisplay").innerText = time;
            document.getElementById("MyClockDisplay").textContent = time;

            setTimeout(showTime, 1000);
        }

        showTime();
    </script>
@endsection
