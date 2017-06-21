@extends('layouts.app')

@section('content')
    <form role="form" ng-app="booksApp" ng-controller="usersController" style="direction: RTL">
        <center>
            <h2>إضافه عضو جديد</h2>
        </center>
    
        <div class="form-group">
            <label for="">الاسم *</label>
            <input type="text" class="form-control" ng-model="user.name" required placeholder="الاسم">
        </div>

        <div class="form-group">
            <label for="">البريد الالكتروني *</label>
            <input type="text" class="form-control" ng-model="user.email" required placeholder="البريد الالكتروني">
        </div>
    
        <div class="form-group">
            <label for="">كلمة المرور *</label>
            <input type="password" class="form-control" ng-model="user.password" required placeholder="كلمة المرور">
        </div>

        <div class="form-group">
            <label for="">تأكيد كلمه المرور *</label>
            <input type="password" class="form-control" ng-model="user.password_confirmation" required placeholder="تأكيد كلمه المرور">
        </div>
                
        <br>

        <center>
            <button style="width: 50%" ng-click="newUser($event)" ng-disabled="!user.name || !user.email || !user.password" class="btn btn-primary">إضافه</button>
        </center>
        {{csrf_field()}}
    </form>
@stop