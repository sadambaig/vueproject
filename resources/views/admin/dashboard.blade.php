@extends('partials.main')
@section('content')
<section class="content container-fluid">

	<main-app></main-app>
</section>
@endsection
@section('scripts')
<script src="{{ asset('public/bower_components/ckeditor/ckeditor.js') }}"></script>

{{-- <script>
CKEDITOR.replace('description')
                      
                </script> --}}
@endsection
