@php
    $title = __('User') . ': ' . $user->name;
@endphp
@extends('layouts.my')
@section('content')
<h1>{{ $title }}</h1>

@can('edit', $user)
<!-- 編集・削除ボタン -->
<div>
    <a href="{{ url('users/'.$user->id.'/edit') }}" class="btn btn-primary">
        {{ __('Edit') }}
    </a>
    <!-- 削除ボタンは後で正式なものに置き換えます
    <a href="#" class="btn btn-danger">
        {{ __('Delete') }}
    </a>
    -->
    @component('components.btn-del')
        @slot('table', 'users')
        @slot('id', $user->id)
    @endcomponent
</div>
@endcan

<!-- ユーザー1件の情報 -->
<dl class="row">
    <dt class="col-md-2">{{ __('ID') }}</dt>
    <dd class="col-md-10">{{ $user->id }}</dd>
    <dt class="col-md-2">{{ __('Name') }}</dt>
    <dd class="col-md-10">{{ $user->name }}</dd>
    <dt class="col-md-2">{{ __('Email') }}</dt>
    <dd class="col-md-10">{{ $user->email }}</dd>
</dl>

<h2>{{ __('Posts') }}</h2>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>{{ __('Title') }}</th>
                <th>{{ __('Body') }}</th>
                <th>{{ __('Created') }}</th>
                <th>{{ __('Updated') }}</th>
                @can('edit', $user)
                <th></th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach ($user->posts as $post)
                <tr>
                    <td>
                        <a href="{{ url('posts/'.$post->id) }}">
                            {{ $post->title }}
                        </a>
                    </td>
                    <td>{{ $post->body }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td>{{ $post->updated_at }}</td>
                    @can('edit', $user)
                    <td nowrap>
                        <a href="{{ url('posts/'.$post->id.'/edit') }}" class="btn btn-primary">
                            {{ __('Edit') }}
                        </a>
                        @component('components.btn-del')
                            @slot('table', 'posts')
                            @slot('id', $post->id)
                        @endcomponent
                    </td>
                    @endcan
                 </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $user->posts->links() }}

@endsection
