@extends('template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    {{$user}}
                    {{$base}}
                    {{$info}}
                    <form method="POST" action="{{route('user_info.update',$info->id)}}">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-group row">
                            <label for="info">情報</label>
                            <textarea class="form-control @error('info') is-invalid @enderror" id="info" name="info" rows="10">{{ $info->info }}</textarea>
                            @error('info')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group row mb-0">
                            <button type="submit" class="btn btn-primary btn-block">
                                変更
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection