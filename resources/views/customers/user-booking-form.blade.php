<div class="list-group" id="list-group-customer">
    @foreach ($customers as $customer)
    <a data-id="{{ $customer->id }}" class="list-group-item list-group-item-action">
        {{ ucfirst($customer->name) }} - {{$customer->phone ?? ''}}
      </a>
    @endforeach
</div>
