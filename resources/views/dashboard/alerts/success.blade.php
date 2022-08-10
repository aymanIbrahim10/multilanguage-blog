@if(Session::has('success'))
    <div class="row" style="margin-bottom: 10px;margin-left: 15px;
    margin-right: 15px;">
            <button type="text" class="btn btn-lg btn-block btn-outline-success mb-2"
                    id="type-error">{{Session::get('success')}}
            </button>
    </div>
@endif
