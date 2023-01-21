<div class="container-lg">
    @if(isset($success))
    <div class="alert alert-success my-3" role="alert">
        {{$success}}
    </div>
    @endif
    @if(isset($error))
        <div class="alert alert-danger my-3" role="alert">
            {{$error}}
        </div>
        @endif
</div>