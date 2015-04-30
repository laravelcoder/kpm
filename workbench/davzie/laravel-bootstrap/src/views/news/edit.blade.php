@extends('laravel-bootstrap::layouts.interface-edit')

@section('title')
    Редагування новини
@stop

@section('breadcrumbs')
    <li><a href="{{action($module . '@getIndex')}}">Новини</a></li>
    <li class="active">Редагування новини</li>
@stop

@section('heading')
    <h1>Редагування новини</h1>
@stop

@section('form-items')

    <div class="form-group">
        {{ Form::label( "title" , 'Назва' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "title" , Input::old( "title", $item->title ) , array( 'class'=>'form-control' , 'placeholder'=>'Назва', 'data-slug' => $item->slug ? '':'[name=slug]' ) ) }}
        </div>
    </div>

    {{Form::hidden('lang_id', Input::old('lang_id', $item->lang_id), array())}}

    <div class="form-group">
        {{ Form::label( "slug" , 'Аліас' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "slug" , Input::old( "slug", $item->slug ) , array( 'class'=>'form-control' , 'placeholder'=>'Аліас' ) ) }}
        </div>
    </div>
    @include('laravel-bootstrap::partials.upload', ['name' => 'photo_storage_id', 'label' => 'Фото', 'path' => $path['photo_storage_id'], 'value' => $item->photo_storage_id, 'dir' => 'news'])
    <div class="form-group">
        {{ Form::label( "descr" , 'Короткий опис' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::textarea( "descr" , Input::old( "descr", $item->descr ) , array( 'class'=>'form-control' , 'placeholder'=>'Короткий опис', 'rows' => 10 ) ) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label( "body" , 'Контент' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::textarea( "body" , Input::old( "body", $item->body ) , array( 'class'=>'form-control rich' , 'placeholder'=>'Контент', 'rows' => 30 ) ) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label( "time_publish" , 'Дата публікації' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "time_publish" , Input::old( "time_publish", $item->time_publish ) , array( 'class'=>'form-control datetimepicker' , 'placeholder'=>'Дата публікації' ) ) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label( "meta_keywords" , 'Ключові слова' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "meta_keywords" , Input::old( "meta_keywords", $item->meta_keywords ) , array( 'class'=>'form-control' , 'placeholder'=>'Ключові слова' ) ) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label( "meta_descr" , 'Мета опис' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "meta_descr" , Input::old( "meta_descr", $item->meta_descr ) , array( 'class'=>'form-control' , 'placeholder'=>'Мета опис' ) ) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label( "rubrics" , 'Рубрики' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::select( "rubrics[]" , $rubrics, Input::old( "rubrics", $item->rubrics_ids() ) , array( 'class'=>'form-control sel2', 'multiple') ) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label( "is_active" , 'Активна' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{Form::hidden('is_active', 0)}}
            {{ Form::checkbox( "is_active" , Input::old("is_active", 1), $item->is_active) }}
        </div>
    </div>

@stop

@section('form-additional-block')
    <a href="{{action($module . '@getIndex')}}" class="btn btn-danger">Назад</a>
@stop
