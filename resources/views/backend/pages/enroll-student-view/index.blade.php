@extends('backend.layout.master')

@push('backendCss')

    <link href="{{asset('backend')}}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css"
          rel="stylesheet" type="text/css">
    <link href="{{asset('backend')}}/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
          rel="stylesheet" type="text/css">

    <style>
        @media print {
            .main-content {
                padding: 50px;
            }
        }
    </style>
@endpush

@section ('contents')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Student History</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Invoices</a></li>
                        <li class="breadcrumb-item active">Invoice Detail</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row" id="printBody">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-6">
                            <div>

                                <h5 class="font-size-14 mb-2">{{$enrollment->student->name}}</h5>
                                <p class="mb-1">{{$enrollment->student->address ?? ''}}</p>
                                <p class="mb-1">{{$enrollment->student->email ?? ''}}</p>
                                <p>{{$enrollment->student->phone}}</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div>
                                <div>
                                    <h5 class="font-size-15">Enroll Date:</h5>
                                    <p>{{$enrollment->enrolled_at->format('M d,Y')}}</p>
                                </div>
                                @php
                                    $total_marks = $grades->sum(function ($grade) {
                                    return $grade->assessment->total_marks;
                                    });

                                @endphp
                                <div>
                                    <h5 class="font-size-15">Marks Obtain:</h5>
                                    <p>{{$grades->sum('marks_obtained') ?? '0'}}/{{$total_marks ?? '0'}}</p>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="py-2 mt-3">
                        <h5 class="font-size-15">Exam History</h5>
                    </div>
                    <div class="p-4 border rounded">
                        <div class="table-responsive">
                            <table class="table table-nowrap align-middle mb-0">
                                <thead>
                                <tr>
                                    <th style="width: 70px;">No.</th>
                                    <th>Exam Title</th>
                                    <th class="text-end" style="width: 120px;">Total marks</th>
                                    <th class="text-end" style="width: 120px;">Obtained marks</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($grades as $key=> $grade)
                                    <tr>
                                        <th scope="row">{{$key+1}}</th>
                                        <td>
                                            <h5 class="font-size-15 mb-1">{{$grade->assessment->title}}</h5>
                                        </td>
                                        <td class="text-end">{{$grade->assessment->total_marks}}</td>
                                        <td class="text-end">{{$grade->marks_obtained}}</td>
                                    </tr>
                                @empty
                                @endforelse

                                <tr>
                                    <th scope="row" colspan="3" class="border-0 text-end">Marks Obtained</th>
                                    <td class="border-0 text-end"><h4
                                                class="m-0">{{$grades->sum('marks_obtained') ?? '0'}}</h4></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-print-none mt-3">
                        <div class="float-end">
                            <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i
                                        class="fa fa-print"></i> Print Report</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('backendJs')

    {{--  CkEditor CDN  --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('backend')}}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('backend')}}/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

@endpush