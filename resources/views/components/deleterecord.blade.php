<x-button xs negative spinner outline squared icon="trash" wire:click.prevent="confirm({{ $id }})" :key="time().$id" id="deleterecord-{{ $id }}" />
