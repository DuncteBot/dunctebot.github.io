@extends('layouts.base')

@section('title', 'List of radio streams')

@section('content')
    <style>
        table {
            word-wrap: break-word;
            overflow: hidden;
        }
    </style>

    <div>
        <div class="row"></div>
        <div class="row">
            <div class="col s12">
                <input id="search_input" type="text" placeholder="Search for radio streams">
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <table class="striped">
                    <thead>
                    <tr>
                        <th>Command</th>
                        <th>Website</th>
                    </tr>
                    </thead>

                    <tbody id="display">
                        @generateRadioList
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const searchData = @insertRadioJson;
    </script>
    <script src="/js/radioSearch.js"></script>
@endpush
