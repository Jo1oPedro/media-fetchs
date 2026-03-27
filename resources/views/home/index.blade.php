@extends("layouts.app")

@section("title", "Download Home Page")

@section("content")
    <x-header />
    <main>
        <x-home.download-panel />
        <x-home.cta-panel />
    </main>
    <x-home.footer />
@endsection

@push("scripts")
    @vite("resources/js/download/download-panel.js")
@endpush
