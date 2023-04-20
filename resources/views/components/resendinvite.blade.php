<x-button xs squared teal icon="mail" wire:click.prevent="resendinvite({{ $id }})" :key="time() . $id"
    id="resendinvite-{{ $id }}" />
