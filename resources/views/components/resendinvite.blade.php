<x-button xs squared teal outline spinner icon="mail" wire:click.prevent="resendinvite({{ $id }})" :key="time() . $id"
    id="resendinvite-{{ $id }}" />
