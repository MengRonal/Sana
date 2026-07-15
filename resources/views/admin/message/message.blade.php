
<div class="toast-container position-fixed top-0 end-0 p-3" >

    @if (Session::has('user_status'))
        <div class="toast align-items-center text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ Session::get('user_status') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>

    @elseif(Session::has('delete_success'))
        <div class="toast align-items-center text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ Session::get('delete_success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"aria-label="Close"></button>
            </div>
        </div>
    @elseif(Session::has('update_success'))
        <div class="toast" role="alert" aria-live="polite" aria-atomic="true" data-bs-delay="10000">
            <div role="alert" aria-live="assertive" aria-atomic="true">{{ Session::get('update_success') }}</div>
        </div>
    @endif

</div>