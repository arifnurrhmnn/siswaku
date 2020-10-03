@if (Session::has('flash_message'))
    <div class="alert alert-success {{ Session::has('penting') ? 'alert-important' : ''}}">
        {{ Session::get('flash_message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif