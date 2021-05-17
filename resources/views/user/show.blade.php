@extends('template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    {{$user}}
                    {{$infos}}
                    {{$bases}}
                    @for($i=0;$i<count($bases);$i++)
                    {{$bases[$i]}}
                    {{$infos[$i]}}
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
