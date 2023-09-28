<x-button xs squared spinner teal icon="user-add" onclick="Livewire.emit('openModal', '{{ $route }}', {{ json_encode([$id]) }})" :key="time().$id" id="modalrecord-{{ $id }}"/>
