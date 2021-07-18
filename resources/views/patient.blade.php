@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <h1 style="text-align: center">Patient Management System</h1>
    <a class="btn btn-success mb-3" href="javascript:void(0)" id="createNewPatient"> Create New Patient</a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Age</th>
                <th width="100px">Action</th>
                <th width="100px">Add/View Latest Report</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
   
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="addForm" name="addForm" class="form-horizontal">
                   <input type="hidden" name="patient_id" id="patient_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-12">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="" maxlength="300" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="age" class="col-sm-2 control-label">Age</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="age" name="age" placeholder="Enter mobile number" value="" maxlength="10" required>
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection  

@section('pagescript')
<script type="text/javascript">
  $(function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('patients.index') }}",
        columns: [
            {data: 'id', name: 'patient_id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'age', name: 'age'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            {data: 'add-report', name: 'add-report', orderable: false, searchable: false},
        ]
    });
    $('#createNewPatient').click(function () {
        $('#saveBtn').val("create-patient");
        // $('#patient_id').val('');
        $('#addForm').trigger("reset");
        $('#modelHeading').html("Create New Patient");
        $('#ajaxModel').modal('show');
    });
    $('body').on('click', '.editPatient', function () {
      var patient_id = $(this).data('id');
      $.get("{{ route('patients.index') }}" +'/' + patient_id +'/edit', function (data) {
          $('#modelHeading').html("Edit Patient");
          $('#saveBtn').val("edit-patient");
          $('#ajaxModel').modal('show');
          $('#patient_id').val(data.id);
          $('#name').val(data.name);
          $('#email').val(data.email);
          $('#age').val(data.age);
      })
   });
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Save');
    
        $.ajax({
          data: $('#addForm').serialize(),
          url: "{{ route('patients.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
     
              $('#addForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();
         
          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
    });
    
    $('body').on('click', '.deletePatient', function () {
     
        var patient_id = $(this).data("id");
        confirm("Are You sure want to delete !");
      
        $.ajax({
            type: "DELETE",
            url: "{{ route('patients.store') }}"+'/'+patient_id,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
     
  });
</script>
@endsection