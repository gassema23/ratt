<x-button xs squared teal spinner icon="eye" onclick="Livewire.emit('openModal', '{{ $route }}', {{ json_encode([$id]) }})" :key="time().$id" id="modalshowrecord-{{ $id }}"/>
