<div class="page-header">
    <div class="row">
        <div class="col">
            <h3 class="page-title">{{ $title }}</h3>
                <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('dashboard')}}">{{ $li_1 }}</a></li>
                <li class="breadcrumb-item active">{{ $li_2 }}</li>
                @if(isset($li_3))
                <li class="breadcrumb-item">{{ $li_3 }}</li>
                @endif
                @if(isset($li_4))
                <li class="breadcrumb-item active">{{ $li_4 }}</li>
                @endif
            </ul>
        </div>

        @if(isset($action_button))
        <div class="col-auto float-end ms-auto">
            {!! $action_button !!}
        </div>
        @endif
    </div>
</div>
<!-- /Page Header -->
