<x-button xs squared teal icon="eye" onclick="Livewire.emit('openModal', '{{ $route }}', {{ json_encode([$id]) }})" :key="time().$id" id="modalshowrecord-{{ $id }}"/>
