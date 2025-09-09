<div class="d-flex justify-content-center mt-2">
    <div class="input-group" style="width: 140px;">
        <button type="button" class="btn btn-outline-secondary" wire:click="decrease">−</button>
        <input type="number" class="form-control text-center" wire:model="quantity" min="1">
        <button type="button" class="btn btn-outline-secondary" wire:click="increase">+</button>
    </div>
    <button class="btn btn-primary ms-2" wire:click="addToCart">Add to Cart</button>
</div>
