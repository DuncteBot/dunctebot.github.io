@extends('layouts.base')

@section('title', 'Live Server Count')

@section('content')
    <section class="center flow-text">
        <h1>DuncteBot is currently in <span id="server_count">0</span> servers</h1>
        <h3><a href="{!! $botInvite !!}" target="_blank">Click here to invite</a></h3>
    </section>
@endsection

@push('scripts')
    <script src="/js/countUp.js"></script>
    <script>
        let options = {
            useEasing: true,
            useGrouping: true,
            separator: ',',
            decimal: '.'
        };
        let counter = new CountUp('server_count', 0, 0, 0, 2, options);
        if (!counter.error) {
            counter.start();
        } else {
            console.error(counter.error);
        }
        //Load the server data every 10 seconds
        setInterval(read, 10000);

        function read() {
            fetch("{!! $apiPrefix !!}/getServerCount")
                .then(r => r.json())
                .then(data => counter.update(data.server_count));
        }

        read();
    </script>
@endpush
