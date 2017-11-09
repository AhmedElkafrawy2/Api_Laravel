@if(isset($type) && isset($message))
	@if($type == 'success')
		<div class="alert alert-success alert-dismissable">
		 	<button type="button" class="close" id="close_flash" data-dismiss="alert" aria-hidden="true">×
		 	</button>
		 	<i class="icon-check-sign"></i> {{$message}}
		</div>
	@else	
		<div class="alert alert-error alert-dismissable">
			<button type="button" class="close" id="close_flash" data-dismiss="alert" aria-hidden="true">×
			</button>
			<i class="icon-check-sign"></i> {{$message}}
		</div>
	@endif
@elseif(count($errors) > 0)
    <div class="alert alert-warning alert-dismissable">
        <button type="button" class="close" id="close_flash" data-dismiss="alert" aria-hidden="true">×
        </button>
        <i class="icon-check-sign"></i> 
        @foreach($errors as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif