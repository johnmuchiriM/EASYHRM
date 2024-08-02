@if ($message = Session::get('success'))
        <div id="toast-container" class="toast-top-right">
               <div class="toast toast-success" aria-live="assertive" style="">
                        <div class="toast-message">{{ $message }}</div>
                </div>
        </div>
@endif

@if ($message = Session::get('error'))
        <div id="toast-container" class="toast-top-right">
                <div class="toast toast-error" aria-live="assertive" style="">
                        <div class="toast-message">{{ $message }}</div>
                </div>
        </div>
@endif
