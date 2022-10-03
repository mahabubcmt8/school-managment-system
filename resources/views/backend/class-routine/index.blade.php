@extends('layouts.backend.app')
@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12 ">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active">Class routine</li>
                    <li class="breadcrumb-item active">Get Routine</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table m-b-0 table-bordered text-light text-center table-striped">
                            <tbody>
                            <tr>
                                <th>Sunday</th>
                                @foreach ($routine as $row)
                                    @if ($row->getRoutine->day === "Sunday")
                                        <td>
                                            <span title="Subject">{{ $row->subject->name }}<br></span>
                                            <span title="Class Room">{{ $row->class_room->room_no }}<br></span>
                                            <span title="Teacher">{{ $row->teacher->name }}<br></span>
                                            <span title="Time">{{ '(' . $row->start_time . ' - ' . $row->end_time . ')' }}<br></span>
                                        </td>
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                <th>Monday</th>
                                @foreach ($routine as $row)
                                    @if ($row->getRoutine->day === "Monday")
                                        <td>
                                            <span title="Subject">{{ $row->subject->name }}<br></span>
                                            <span title="Class Room">{{ $row->class_room->room_no }}<br></span>
                                            <span title="Teacher">{{ $row->teacher->name }}<br></span>
                                            <span title="Time">{{ '(' . $row->start_time . ' - ' . $row->end_time . ')' }}<br></span>
                                        </td>
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                <th>Tuesday</th>
                                @foreach ($routine as $row)
                                    @if ($row->getRoutine->day === "Tuesday")
                                        <td>
                                            <span title="Subject">{{ $row->subject->name }}<br></span>
                                            <span title="Class Room">{{ $row->class_room->room_no }}<br></span>
                                            <span title="Teacher">{{ $row->teacher->name }}<br></span>
                                            <span title="Time">{{ '(' . $row->start_time . ' - ' . $row->end_time . ')' }}<br></span>
                                        </td>
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                <th>Wednesday</th>
                                @foreach ($routine as $row)
                                    @if ($row->getRoutine->day === "Wednesday")
                                        <td>
                                            <span title="Subject">{{ $row->subject->name }}<br></span>
                                            <span title="Class Room">{{ $row->class_room->room_no }}<br></span>
                                            <span title="Teacher">{{ $row->teacher->name }}<br></span>
                                            <span title="Time">{{ '(' . $row->start_time . ' - ' . $row->end_time . ')' }}<br></span>
                                        </td>
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                <th>Thursday</th>
                                @foreach ($routine as $row)
                                    @if ($row->getRoutine->day === "Thursday")
                                        <td>
                                            <span title="Subject">{{ $row->subject->name }}<br></span>
                                            <span title="Class Room">{{ $row->class_room->room_no }}<br></span>
                                            <span title="Teacher">{{ $row->teacher->name }}<br></span>
                                            <span title="Time">{{ '(' . $row->start_time . ' - ' . $row->end_time . ')' }}<br></span>
                                        </td>
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                <th>Friday</th>
                                @foreach ($routine as $row)
                                    @if ($row->getRoutine->day === "Friday")
                                        <td>
                                            <span title="Subject">{{ $row->subject->name }}<br></span>
                                            <span title="Class Room">{{ $row->class_room->room_no }}<br></span>
                                            <span title="Teacher">{{ $row->teacher->name }}<br></span>
                                            <span title="Time">{{ '(' . $row->start_time . ' - ' . $row->end_time . ')' }}<br></span>
                                        </td>
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                <th>Saturday</th>
                                @foreach ($routine as $row)
                                    @if ($row->getRoutine->day === "Saturday")
                                        <td>
                                            <span title="Subject">{{ $row->subject->name }}<br></span>
                                            <span title="Class Room">{{ $row->class_room->room_no }}<br></span>
                                            <span title="Teacher">{{ $row->teacher->name }}<br></span>
                                            <span title="Time">{{ '(' . $row->start_time . ' - ' . $row->end_time . ')' }}<br></span>
                                        </td>
                                    @endif
                                @endforeach
                            </tr>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
