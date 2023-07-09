<style>
    label{
        margin-top: 15px;
        margin-bottom: 10px;
        color: black;
    }
</style>
@extends('layouts.sneat')

@section('content')
<div class="portlet-title">
    <div style="display: inline-block; margin: 15px; font-size: 25px; font-weight: bold;">
        Add New Buyer
    </div>
</div>
<form method="POST" action="{{route('buyer.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmaill">Nama Buyer :</label>
        <input type="text" name="namaBuyer" class="form-control" id="namaBuyer" aria-describedby="nameHelp">

        <label for="exampleInputEmaill">Username : </label>
        <input type="text" name="username" class="form-control" id="username" aria-describedby="nameHelp">

        <label for="exampleInputEmaill">Email : </label>
        <input type="text" name="email" class="form-control" id="email" aria-describedby="nameHelp">

        <label for="exampleInputEmaill">Password : </label>
        <input type="password" name="password" class="form-control" id="password" aria-describedby="nameHelp">

        <label for="exampleInputEmaill">Birthdate : </label>
        <input type="date" name="birthdate" class="form-control" id="birthdate" aria-describedby="nameHelp">

        <label for="exampleInputEmaill">Phone : </label>
        <input type="text" name="phone" class="form-control" id="phone" aria-describedby="nameHelp">
        
        <label for="exampleInputEmaill">address : </label>
        <input type="text" name="address" class="form-control" id="address" aria-describedby="nameHelp">

        <div class="radio-group">
            <label for="exampleInputEmaill">Gender : </label>
            <input type="radio" name="gender" id="pria" aria-describedby="nameHelp" value="male" checked>Pria
            <input type="radio" name="gender" id="wanita" aria-describedby="nameHelp" value="female">Wanita
        </div>
          

    </div>
    <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Submit</button>
</form>
@endsection

