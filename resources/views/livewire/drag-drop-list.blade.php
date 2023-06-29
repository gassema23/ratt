<ul wire:sortable="updateTaskOrder">
    @foreach ($items as $k=>$v)
        <li wire:sortable.item="{{ $v }}" wire:key="task-{{ $k }}">
            <h4 wire:sortable.handle>{{ $v }}</h4>
        </li>
    @endforeach
</ul>
