<x-button xs squared teal icon="pencil" onclick="Livewire.emit('openModal', '{{ $route }}', {{ json_encode([$id]) }})" :key="time().$id" id="editrecord-{{ $id }}" />
