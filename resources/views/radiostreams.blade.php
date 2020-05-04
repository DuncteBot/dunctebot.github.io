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
                <h6><strong>NOTE:</strong> This radio list is huge and search is slow atm, this is being worked on (<span id="size">Loading page...</span> radio streams in this list)</h6>
                <input id="search_input" type="text" placeholder="Search for radio streams">
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <table class="striped">
                    <thead>
                    <tr>
                        <th>Station name</th>
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
        window.searchData = @insertRadioJson;
        id("size").innerHTML = window.searchData.length;
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.9.1/underscore-min.js" crossorigin="anonymous" async defer></script>
    <script src="/js/radioSearch.js?v=4" async defer></script>
@endpush
