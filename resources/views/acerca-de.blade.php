@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
    @if($info)
    <div class="card border-primary">
            <div class="card-header text-center border-primary" style="text-align:justify"><h3>{{ $info->empresa }}</h3></div>
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-primary">
                            <div class="card-header text-center border-primary"><strong>¿Quiénes somos?</strong></div>
                            <div class="card-body" style="text-align:justify;">
                                {{ $info->quienes_somos }}
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="border-primary"/>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card border-primary">
                            <div class="card-header text-center border-primary"><strong>Visión</strong></div>
                            <div class="card-body"  style="text-align:justify">{{ $info->vision }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-primary">
                            <div class="card-header text-center border-primary"><strong>Misión</strong></div>
                            <div class="card-body"  style="text-align:justify">{{ $info->mision }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-primary">
                            <div class="card-header text-center border-primary"><strong>Valores</strong></div>
                            <div class="card-body"  style="text-align:justify">{!! $info->valores !!}</div>
                        </div>
                    </div>
                </div>
                <hr class="border-primary"/>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-primary">
                            <div class="card-body text-center border-primary">
                                <strong>Tel.:</strong> {{ $info->telefono }},  {{ $info->direccion }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    @endif
    </div>
</div>
@endsection