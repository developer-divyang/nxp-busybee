		<a class="clear">{{ __('New Conversation(s).') }}</a>
		@if(count($datas) > 0)
		<a id="conv-notf-clear" data-href="{{ route('conv-notf-clear') }}" class="clear" href="javascript:;">
			{{ __('Clear All') }}
		</a>
		<ul>
			@foreach($datas as $data)
			<li>
				<a href="{{ route('admin-order-show',$data->order_id) }}"> <i class="fas fa-envelope"></i> You Have a New Message from  {{ $data->user->name }} on {{ $data->order->order_number }} </a>
			</li>
			@endforeach

		</ul>

		@else

		<a class="clear" href="javascript:;">
			{{ __('No New Notifications.') }}
		</a>

		@endif