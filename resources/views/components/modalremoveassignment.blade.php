<x-button xs negative spinner outline squared icon="user-remove" wire:click.prevent="confirm({{ $id }})" :key="time().$id" id="deleterecord-{{ $id }}" />
