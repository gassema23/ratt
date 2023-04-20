<x-button xs negative outline squared icon="trash" wire:click.prevent="confirm({{ $id }})" :key="time().$id" id="deleterecord-{{ $id }}" />
