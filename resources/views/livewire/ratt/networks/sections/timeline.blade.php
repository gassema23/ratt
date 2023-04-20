<div>
    <script type="text/javascript" defer>
        google.charts.load("current", {
            packages: ["timeline"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var container = document.getElementById('timeline');
            var chart = new google.visualization.Timeline(container);
            var dataTable = new google.visualization.DataTable();
            dataTable.addColumn({
                type: 'string',
                id: 'Team'
            });
            dataTable.addColumn({
                type: 'string',
                id: 'Name'
            });
            dataTable.addColumn({
                type: 'date',
                id: 'Start'
            });
            dataTable.addColumn({
                type: 'date',
                id: 'End'
            });
            dataTable.addRows([
                @foreach ($tasks as $task)
                    [
                        "{{ $task->team->name }}",
                        "{{ $task->task->name }}",
                        new Date({{ \Carbon\Carbon::parse($task->network->started_at)->year }},{{ \Carbon\Carbon::parse($task->network->started_at)->month }},{{ \Carbon\Carbon::parse($task->network->started_at)->day }}),
                        new Date({{ \Carbon\Carbon::parse($task->due_date)->year }},{{ \Carbon\Carbon::parse($task->due_date)->month }},{{ \Carbon\Carbon::parse($task->due_date)->day }})
                    ],
                @endforeach
            ]);
            chart.draw(dataTable);
        }
    </script>
    <x-card>
        <div id="timeline"></div>
    </x-card>
</div>
