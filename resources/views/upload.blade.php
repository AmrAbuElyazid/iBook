@extends('layouts.app')

@section('content')
    <form action="" method="POST" role="form" enctype="multipart/form-data" style="direction: RTL">
        <center>
            <h2>إضافه كتاب جديد</h2>
        </center>
    
        <div class="form-group">
            <label for="">إسم الكتاب *</label>
            <input type="text" class="form-control" name="book_name" placeholder="إسم الكتاب" required>
        </div>

        <div class="form-group">
            <label for="">مؤلف الكتاب</label>
            <input type="text" class="form-control" name="book_author" placeholder="مؤلف الكتاب">
        </div>
    
        <div class="form-group">
            <label for="">تاريخ النشر</label>
            <input type="text" class="form-control" name="book_date" placeholder="تاريخ النشر">
        </div>

        <div class="form-group">
            <label for="">وصف الكتاب</label>
            <input type="text" class="form-control" name="book_desc" placeholder="وصف الكتاب">
        </div>
        
        <div class="form-group">
            <label for="">اختر الكتاب *</label>
            <input type="file" class="form-control" name="book_file" placeholder="اختر الكتاب" required="">
        </div>

        <div class="form-group">
            <label for="">اختر تصنيف الكتاب *</label>
            <select name="category" id="input" class="form-control" required="required">
                @foreach (DB::table('cats')->get() as $category)
                    <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                @endforeach
            </select>
        </div>
        <br>

        <center style="padding-bottom: 100px">
            <button style="width: 50%" type="submit" class="btn btn-primary">إضافه</button>
        </center>
        {{csrf_field()}}
    </form>
@stop