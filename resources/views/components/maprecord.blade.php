<x-button xs squared positive icon="map"
    onclick="Livewire.emit('openModal', '{{ $route }}', {{ json_encode([$id]) }})" :key="time() . $id"
    id="maprecord-{{ $id }}" />
