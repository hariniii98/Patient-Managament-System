@extends('layouts.app')
@section('style')
    <style>
        table, th, td {
            border: 1px solid black;
            text-align: center;
        }
        .red{
            background-color: #bb2124;
            color: #ffffff;
        }
        .green{
            background-color:#22bb33;
            color: #ffffff;
        }
        .fa-thumbs-down{
            color:#bb2124;
        }
        .fa-thumbs-up{
            color:#22bb33;
        }
    </style>
@endsection
@section('content')
    
    <div class="container-fluid px-5 mt-5">
        <h3>Patient Name: {{$patient->name}}</h3>
        <h6>Patient Age: {{$patient->age}}</h6>
        <button type="button" class="btn btn-warning mb-3" data-bs-toggle="modal" data-bs-target="#ajaxReportModel">
            Add Latest Report
          </button>
          @if($records_count > 0)
        <table>
            <thead>
                <th style="width:160px;">Parameters</th>
                @foreach($patient_all_reports as $patient_all_report)
                        <td>Date : {{$patient_all_report->created_at->format('m/d/Y')}}</td>
                @endforeach
                <td style="width:140px;">Optimal Range</td>
             <tbody>
                <tr>
                    <td>Glucose @if(isset($last_2)) @if($last_1->glucose > $last_2->glucose && $last_1->glucose >= $glucose->min_optimal_range && $last_1->glucose <= $glucose->max_optimal_range)<i class="fa fa-thumbs-up"></i> @else <i class="fa fa-thumbs-down"></i> @endif @endif</td>
                    @foreach($patient_all_reports as $patient_all_report)
                        <td class="@if($patient_all_report->glucose >= $glucose->min_optimal_range && $patient_all_report->glucose <= $glucose->max_optimal_range) green @else red @endif">{{$patient_all_report->glucose}}</td>
                    @endforeach
                    <td>{{$glucose->min_optimal_range}} - {{$glucose->max_optimal_range}}</td>
                </tr>
                <tr>
                    <td>Insulin - Fasting  @if(isset($last_2))@if($last_1->insulin_fasting > $last_2->insulin_fasting && $last_1->insulin_fasting >= $insulin_fasting->min_optimal_range && $last_1->insulin_fasting <= $insulin_fasting->max_optimal_range)<i class="fa fa-thumbs-up"></i> @else <i class="fa fa-thumbs-down"></i> @endif @endif</td>
                    @foreach($patient_all_reports as $patient_all_report)
                        <td class="@if($patient_all_report->insulin_fasting >= $insulin_fasting->min_optimal_range && $patient_all_report->insulin_fasting <= $insulin_fasting->max_optimal_range) green @else red @endif">{{$patient_all_report->insulin_fasting}}</td>
                    @endforeach
                    <td>{{$insulin_fasting->min_optimal_range}} - {{$insulin_fasting->max_optimal_range}}</td>
                </tr>
                <tr>
                    <td>Albumin  @if(isset($last_2))@if($last_1->albumin > $last_2->albumin && $last_1->albumin >= $albumin->min_optimal_range && $last_1->albumin <= $albumin->max_optimal_range)<i class="fa fa-thumbs-up"></i> @else <i class="fa fa-thumbs-down"></i> @endif @endif</td>
                    @foreach($patient_all_reports as $patient_all_report)
                        <td class="@if($patient_all_report->albumin >= $albumin->min_optimal_range && $patient_all_report->albumin <= $albumin->max_optimal_range) green @else red @endif">{{$patient_all_report->albumin}}</td>
                    @endforeach
                    <td>{{$albumin->min_optimal_range}} - {{$albumin->max_optimal_range}}</td>
                </tr>
                <tr>
                    <td>Calcium  @if(isset($last_2))@if($last_1->calcium > $last_2->calcium && $last_1->calcium >= $calcium->min_optimal_range && $last_1->calcium <= $calcium->max_optimal_range)<i class="fa fa-thumbs-up"></i> @else <i class="fa fa-thumbs-down"></i> @endif @endif</td>
                    @foreach($patient_all_reports as $patient_all_report)
                        <td class="@if($patient_all_report->calcium >= $calcium->min_optimal_range && $patient_all_report->calcium <= $calcium->max_optimal_range) green @else red @endif">{{$patient_all_report->calcium}}</td>
                    @endforeach
                    <td>{{$calcium->min_optimal_range}} - {{$calcium->max_optimal_range}}</td>
                </tr>
            </tbody>
          </table>
          @else
          <p>No records!</p>
          @endif
    </div>
      <div class="modal fade" id="ajaxReportModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading">Add Report</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="col-sm-12 control-label">Patient Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="patient_name" name="patient_name" value="{{$patient->name}}" maxlength="50" readonly>
                        </div>
                    </div>
                    <form id="addReportForm" name="addReportForm" class="form-horizontal">
                        <input type="hidden" name="patient_id" id="patient_id" value="{{$patient_id}}">
                        <div class="form-group">
                            <label for="glucose" class="col-sm-12 control-label">Glucose</label>
                            <div class="col-sm-12">
                                <input type="number" step=".01" class="form-control" id="glucose" name="glucose" placeholder="Enter Blood Test Value" value="" maxlength="10" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="insulin_fasting" class="col-sm-12 control-label">Insulin - Fasting</label>
                            <div class="col-sm-12">
                                <input type="number" step=".01" class="form-control" id="insulin_fasting" name="insulin_fasting" placeholder="Enter Blood Test Value" value="" maxlength="10" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="albumin" class="col-sm-12 control-label">Albumin</label>
                            <div class="col-sm-12">
                                <input type="number" step=".01" class="form-control" id="albumin" name="albumin" placeholder="Enter Blood Test Value" value="" maxlength="10" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="calcium" class="col-sm-12 control-label">Calcium</label>
                            <div class="col-sm-12">
                                <input type="number" step=".01" class="form-control" id="calcium" name="calcium" placeholder="Enter Blood Test Value" value="" maxlength="10" required>
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="saveReportBtn" value="create" onclick="addReport()">Save
                        </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('pagescript')
    <script>
        function addReport(){
            $('modelHeading').html('Add Latest Report');
            var patient_id = $('#patient_id').val();
            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            $.ajax({
                data: $('#addReportForm').serialize(),
                url: "{{ route('patients.reports.add') }}",
                type: "POST",
                success: function (data) {
                    location.replace('/patient-report/'+patient_id);
                    $('#ajaxReportModel').modal('hide');
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    </script>
</body>
</html>