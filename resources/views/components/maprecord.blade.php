<x-button xs squared teal icon="map" spinner
    onclick="Livewire.emit('openModal', '{{ $route }}', {{ json_encode([$id]) }})" :key="time() . $id"
    id="maprecord-{{ $id }}" />
