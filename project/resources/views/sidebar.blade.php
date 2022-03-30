
@extends('full-calender')


@section('name')
<nav>
    <img src="/images/iti-logo.png" alt="itilogo" height="80px" width="100px">
    <h1 class="text-center bg-danger text-white rounded-pill" style="margin: 20px">Course</h1> <hr>
    <section class="text-center"><b>Budget Section</b></section> <hr>
    <div class="btn-group">
    <form>

        <label><b>Program: </b></label> <br>
        <select class="form-control-plaintext text-white" value="program">
            <option class="bg-secondary" value="ITP">
                Intensive Training Program
                <!-- ITP -->
            </option>
            <option class="bg-secondary" value="STP">
                Summer Training Program
                <!-- STP -->
            </option>
        </select>

        <br>
        <label><b>Branch: </b></label> <br>
        <select value="intake" class="form-control-plaintext text-white">
            <option selected class="bg-secondary" value="ITP 2021/2022">
                Minia
            </option>
        </select>

        <br>

<form name="form1" id="form1" action="/action_page.php">
<label><b>Intake: </b></label> <br>
<select name="Branch" id="Branch" class="bg-secondary form-control-plaintext text-white">
<option value="" selected="selected">Select Quarter</option>
</select>
<br>
<label><b>Track: </b></label> <br>
<select name="Track" id="Track" class="bg-secondary form-control-plaintext text-white">
<option value="" selected="selected">Select Track </option>
</select>
<br>
<label><b>Track Courses: </b></label> <br>
<select name="Track Courses" id="Track Courses" size="5" aria-label="size 3 select example" class=" bg-secondary form-control-plaintext text-white">
<option value="" selected="selected"> Select Course</option>
</select>
<br>
{{-- <input type="submit" value="Submit" >   --}}
</form>



    </form>
</nav>   
@endsection

