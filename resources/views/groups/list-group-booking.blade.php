<div class="list-group" id="list-group-booking" style="overflow-y: auto">
    @foreach ($groups as $group)
    <a data-id="{{ $group->id }}" class="list-group-item list-group-item-action">
        {{ ucfirst($group->name) }}
      </a>
    @endforeach
</div>