@extends('layout')

@section('content')

<div class="mt-5">
  <div class="text-center">
      <h2>Laravel 8 Crud With Employee Information</h2>
      <a class="btn btn-success" href="{{ url('students') }}">Click to Yajara Datatable</a>
  </div>
  @if ($message = Session::get('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ $message }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  <a class="btn btn-warning float-right mb-2" href="{{ route('employees.create') }}">Add</a>
  <table class="table">
    <thead>
        <tr class="table-primary">
          <td>#</td>
          <td>Avatar</td>
          <td>Name</td>
          <td>Email</td>
          <td>Phone</td>
          <td>Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($employees as $key => $employee)
        <tr>
            <td>{{ ++$key}}</td>
            <td><img src="{{ asset('images/'.$employee->image)}}" alt="Image" width="50" height="50" /></td>
            <td>{{$employee->full_name}}</td>
            <td>{{$employee->email}}</td>
            <td>{{$employee->phone}}</td>
            <td class="text-center">
                <a class="btn btn-info btn-sm" href="{{ route('employees.show', $employee->id) }}">Show</a>
                <a href="{{ route('employees.edit', $employee->id)}}" class="btn btn-success btn-sm">Edit</a>
                <a class="btn btn-danger btn-sm" href="javascript:;" onclick="confirmDelete('{{$employee->id}}')">Delete</a>
                <form id="delete-employee-{{$employee->id}}" action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display: none;">
                  
                  @method('DELETE')
                  @csrf
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
  <div class="d-flex justify-content-center">
    {!! $employees->links() !!}
  </div>
<div>
@endsection
<script type="text/javascript">
	function confirmDelete(id){
        let choice = confirm("Are You sure, You want to Delete this record ?")
        if(choice){
          document.getElementById('delete-employee-'+id).submit();
        }
    }
</script>