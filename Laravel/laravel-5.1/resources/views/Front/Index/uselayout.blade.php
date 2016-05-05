@extends('Front.layouts.main')

@section('title','title标题')

@section('sidebar')
    @parent  {{-- 调用父层 不替换  --}}

    Add Some

@endsection

@section('content')

    New Content

    {{ time() }}
    <pre>
    {{ var_dump($_SERVER) }}
    </pre>

    @{{ Yuan yang }}

    {{ $name or 'name not exists' }}
    {!! $xss !!}
    {{ $xss }}

    <?php
        echo $xss;
    ?>

    {{-- aaaaa注释  --}}

    {{ session('status') }}
    @include('Front.layouts.include')
@endsection