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
                <div class="input-field">
                    <label for="search_input">Search for commands</label>
                    <input id="search_input" type="text">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <table class="striped">

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
    <script src="/js/commandSearch.js?v=2"></script>
@endpush
