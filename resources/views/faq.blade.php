@extends('layouts.base')

@section('title', 'Frequently asked questions')

@section('content')
    <div class="row">
        <div class="col s12">
            <h3>FAQ</h3>
            <p>Here are some commonly asked questions, if these answers do not answer your question please join our <a
                    href="https://dunctebot.link/server">discord server</a> for support</p>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            @faq
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.collapsible');
            M.Collapsible.init(elems, {
                accordion: false
            });
        });
    </script>
@endpush
