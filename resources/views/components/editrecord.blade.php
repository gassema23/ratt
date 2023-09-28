<x-button xs squared teal spinner outline icon="pencil" onclick="Livewire.emit('openModal', '{{ $route }}', {{ json_encode([$id]) }})" :key="time().$id" id="editrecord-{{ $id }}" />
