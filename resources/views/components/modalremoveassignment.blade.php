<x-button xs negative outline squared icon="user-remove" wire:click.prevent="confirm({{ $id }})" :key="time().$id" id="deleterecord-{{ $id }}" />
