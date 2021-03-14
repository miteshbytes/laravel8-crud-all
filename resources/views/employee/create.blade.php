  
@extends('layout')
@section('css')
<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">    
@endsection
@section('content')
<div class="pull-right mt-2">
    <a class="btn btn-primary" href="{{ route('employees.index') }}"> Back</a>
</div>
<div class="card mt-1">
  <div class="card-header">
    Create Employee
  </div>

  <div class="card-body">
      <form action="@if(isset($employee)) {{route('employees.update', $employee)}} @else {{ route('employees.store') }} @endif" method="POST" enctype="multipart/form-data">
          <div class="form-group">
              @csrf
              @if(isset($employee))
                @method('PUT')
              @endif
              <label for="first_name">First Name *</label>
              <input type="text" class="form-control" name="first_name" value="{{ old('first_name', @$employee->first_name) }}"/>
              @error('first_name')
                  <div class="text-danger">{{ $message }}</div>
              @enderror
          </div>
          <div class="form-group">
              <label for="last_name">Last Name *</label>
              <input type="text" class="form-control" name="last_name" value="{{ old('last_name', @$employee->last_name) }}"/>
              @error('last_name')
                  <div class="text-danger">{{ $message }}</div>
              @enderror
          </div>
          <div class="form-group">
              <label for="email">Email *</label>
              <input type="email" class="form-control" name="email" value="{{ old('email', @$employee->email) }}"/>
              @error('email')
                  <div class="text-danger">{{ $message }}</div>
              @enderror
          </div>
          @if(Route::currentRouteName() == "employees.create")
          <div class="form-group">
              <label for="password">Password *</label>
              <input type="password" class="form-control" name="password"/>
              @error('password')
                  <div class="text-danger">{{ $message }}</div>
              @enderror
          </div>
          @endif
          <div class="form-group">
              <label for="phone">Phone *</label>
              <input type="tel" class="form-control" name="phone" value="{{ old('phone', @$employee->phone) }}"/>
              @error('phone')
                  <div class="text-danger">{{ $message }}</div>
              @enderror
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="gender">Gender *</label><br>
              <label><input type="radio" name="gender" value="male" {{ old("gender", @$employee->gender) == 'male' ? 'checked' : '' }}> Male</label>
              <label><input type="radio" name="gender" value="female" {{ old("gender", @$employee->gender) == 'female' ? 'checked' : '' }}> Female</label>
              @error('gender')
                  <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group col-md-6">
            <label for="city">City *</label><br>
              <select class="form-control" name="city">
                  <option value="">Select city</option>
                  <option value="Ahmedabad" {{ old("city", @$employee->city) == 'Ahmedabad' ? 'selected' : '' }}>Ahmedabad</option>
                  <option value="Mehsana" {{ old("city", @$employee->city) == 'Mehsana' ? 'selected' : '' }}>Mehsana</option>
                  <option value="Surat" {{ old("city", @$employee->city) == 'Surat' ? 'selected' : '' }}>Surat</option>
                  <option value="Rajkot" {{ old("city", @$employee->city) == 'Rajkot' ? 'selected' : '' }}>Rajkot</option>
                  <option value="Patan" {{ old("city", @$employee->city) == 'Patan' ? 'selected' : '' }}>Patan</option>
                  <option value="Surendranagar" {{ old("city", @$employee->city) == 'Surendranagar' ? 'selected' : '' }}>Surendranagar</option>
              </select>
              @error('city')
                  <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
          @if(isset($employee))
          @php
           $skills = $employee->skills;
           $hobbies = $employee->hobbies;
          @endphp
          @endif
           <div class="form-group">
              <label>Skill *</label><br>
              <label><input type="checkbox" name="skills[]" value="Laravel" {{ (isset($employee) && in_array('Laravel', $skills)) ? 'checked' : '' }} {{ (is_array(old('skills')) && in_array('Laravel', old('skills'))) ? ' checked' : '' }}> Laravel</label>
              <label><input type="checkbox" name="skills[]" value="JQuery" {{ (isset($employee) && in_array('JQuery', $skills)) ? 'checked' : '' }} {{ (is_array(old('skills')) && in_array('JQuery', old('skills'))) ? ' checked' : '' }}> JQuery</label>
              <label><input type="checkbox" name="skills[]" value="Bootstrap" {{ (isset($employee) && in_array('Bootstrap', $skills)) ? 'checked' : '' }} {{ (is_array(old('skills')) && in_array('Bootstrap', old('skills'))) ? ' checked' : '' }}> Bootstrap</label>
              <label><input type="checkbox" name="skills[]" value="Codeigniter" {{ (isset($employee) && in_array('Codeigniter', $skills)) ? 'checked' : '' }} {{ (is_array(old('skills')) && in_array('Codeigniter', old('skills'))) ? ' checked' : '' }}> Codeigniter</label>
              <label><input type="checkbox" name="skills[]" value="JQuery UI" {{ (isset($employee) && in_array('JQuery UI', $skills)) ? 'checked' : '' }} {{ (is_array(old('skills')) && in_array('JQuery UI', old('skills'))) ? ' checked' : '' }}> JQuery UI</label>
              @error('skills')
                  <div class="text-danger">{{ $message }}</div>
              @enderror
          </div>
          <div class="form-group">
              <label for="hobbies" class="form-control-label">Hobbies *</label>
              <select id="selectHobbies" name="hobbies[]" class="form-control" multiple>
                  {{-- <option value="">Select Users</option> --}}
                  <option value="Playing" {{ (isset($employee) && in_array('Playing', $hobbies)) ? 'selected' : '' }} {{ (is_array(old('hobbies')) && in_array('Playing', old('hobbies'))) ? ' selected' : '' }}>Playing</option>
                  <option value="Reading" {{ (isset($employee) && in_array('Reading', $hobbies)) ? 'selected' : '' }} {{ (is_array(old('hobbies')) && in_array('Reading', old('hobbies'))) ? ' selected' : '' }}>Reading</option>
                  <option value="Travelling" {{ (isset($employee) && in_array('Travelling', $hobbies)) ? 'selected' : '' }} {{ (is_array(old('hobbies')) && in_array('Travelling', old('hobbies'))) ? ' selected' : '' }}>Travelling</option>
                  <option value="Photography" {{ (isset($employee) && in_array('Photography', $hobbies)) ? 'selected' : '' }} {{ (is_array(old('hobbies')) && in_array('Photography', old('hobbies'))) ? ' selected' : '' }}>Photography</option>
                  <option value="Dancing" {{ (isset($employee) && in_array('Dancing', $hobbies)) ? 'selected' : '' }} {{ (is_array(old('hobbies')) && in_array('Dancing', old('hobbies'))) ? ' selected' : '' }}>Dancing</option>
              </select>
              @error('hobbies')
                  <div class="text-danger">{{ $message }}</div>
              @enderror
          </div>
          <div class="form-group">
              <label for="about_us" class="form-control-label">About Us</label>
          <textarea class="form-control" name="about_us" rows="4">{{ old('about_us', @$employee->about_us) }}</textarea>
           </div>
           <div class="form-group">
              <label for="image">Profile Image</label>
              <input type="file" class="form-control" name="image" id="image"/>
              @error('image')
                  <div class="text-danger">{{ $message }}</div>
              @enderror
              @if(Route::currentRouteName() == "employees.edit")
                <img src="{{ asset('images/'.$employee->image)}}" class="img-thumbnail" width="100" />
              @endif
              <div class="col-md-12 mb-2">
                  <img id="preview-image-before-upload" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                      alt="preview image" class="img-thumbnail" width="100">
              </div>
          </div>
        <button type="submit" class="btn btn-block btn-primary">{{ (isset($employee)) ? 'Update User' : 'Add User' }}</button>
      </form>
  </div>
</div>
@endsection
@section('script')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
    $('#selectHobbies').select2();
    $(document).ready(function (e) {
 
   
   $('#image').change(function(){
            
    let reader = new FileReader();
 
    reader.onload = (e) => { 
 
      $('#preview-image-before-upload').attr('src', e.target.result); 
    }
 
    reader.readAsDataURL(this.files[0]); 
   
   });
   
});
</script>    
@endsection