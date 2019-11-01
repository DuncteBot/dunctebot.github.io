@extends('layouts.base_minimal')

@section('title', 'List of commands')

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
                <input id="search_input" type="text" placeholder="Search for commands">
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <table class="striped responsive-table">
                    <thead>
                    <tr>
                        <th>Command</th>
                        <th>Description</th>
                    </tr>
                    </thead>

                    <tbody id="display">
                        @generateCommands
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const commandsRaw = @insertCommandsJson;
        const prefix = '{!! $prefix !!}';
    </script>
    <script src="/js/commandSearch.js"></script>
@endpush
