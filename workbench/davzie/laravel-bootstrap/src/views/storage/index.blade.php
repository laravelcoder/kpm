@extends('laravel-bootstrap::layouts.interface')

@section('title')
    Файли
@stop

@section('breadcrumbs')
    <li class="active">Файли</li>
@stop

@section('content')

    <div class="pull-right">
        @if (allowed('storage', 'new'))
        <a href="{{$object_url . '/add-dir/' . $dir_id}}" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-plus"></i> Створити папку</a>
        @endif

        @include('laravel-bootstrap::partials.simple-upload')
    </div>
    <h1>Файли</h1>

    {{-- The error / success messaging partial --}}
    @include('laravel-bootstrap::partials.messaging')

        <table class="table table-condensed storage">
            <thead>
                <tr>
                    <th width="60"></th>
                    <th>Назва</th>
                    <th>Розмір</th>
                    <th>Тип</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @if ($dir)
                    <tr>
                        <td><i class="folder icon icon-folder-open"></i></td>
                        <td><a href="{{$object_url.'/'.$dir->parent_id}}">Назад</a></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endif
                @forelse($items as $item)
                    <tr>
                        <td>
                            @if ($item->is_dir == 1)
                                <i class="folder icon icon-folder-open"></i>
                            @else
                                <img src="{{$item->thumbs['100x']}}" class="thumbnail" width="40" height="40" style="margin-bottom: 0px;" alt="">
                            @endif
                        </td>
                        <td>
                            @if ($item->is_dir)
                                <a href="{{$object_url . '/' . $item->id}}">{{$item->filename}}</a>
                            @else
                                <a href="{{$object_url . '/file/' . $item->id}}">{{$item->filename}}</a>
                            @endif
                        </td>
                        <td>
                            @if ($item->is_dir)
                                -
                            @else
                                {{round($item->size/1000, 1)}} KB
                            @endif
                        </td>
                        <td>{{$item->type}}</td>
                        <td>
                            <div class="btn-group">
                                    @if (allowed('storage', 'delete'))
                                    <a href="{{$delete_url.$item->id.'/?token='.Hash::make('delete')}}" class="js-delete btn btn-danger btn-xs" data-message="Видалити?"><i class="glyphicon glyphicon-trash"></i></a>
                                    @endif
                                    @if (!$item->is_dir)
                                        @if (allowed('storage', 'file'))
                                        <a href="{{$object_url.'/file/'.$item->id}}" class="btn btn-default btn-xs"><i class="icon icon-eye-open"></i></a>
                                        @endif
                                        <a href="#" data-path="{{$item->path}}" class="js-get-path btn btn-default btn-xs">Отримати шлях</a>
                                    @else
                                        <a href="{{$object_url.'/'.$item->id}}" class="btn btn-default btn-xs"><i class="icon icon-eye-open"></i></a>
                                    @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="alert alert-info">
                                <strong>Список порожній</strong>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    <div class="pull-left">
        {{$items->links()}}
    </div>

@stop