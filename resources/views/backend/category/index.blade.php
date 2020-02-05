@extends('backend.layout.master')
@section('title','Quản lý danh mục')
@section('content')


<div class="panel panel-primary">
    <!-- Default panel contents -->
    <div class="panel-heading">Danh sách danh mục</div>
    <div class="panel-body">
        
            <a href="{{route('category.create')}}" class="btn btn-success">Thêm mới</a>
    </div>
    @php
        $cap=1;
    @endphp
    <!-- Table -->
    @include('backend.category.list_category')
</div>

@stop()
@section('js')

@stop()