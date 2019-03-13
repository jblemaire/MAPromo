@extends('layouts.app')

@section('content')
    <?php $old_magasin=0; ?>
    <div class="accordion" id="accordionPromo">
        @foreach($adhesions as $adhesion)
            @if($adhesion->idMagasin !== $old_magasin)
                @if($old_magasin !== 0)
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">
                            <a data-toggle="collapse" data-parent="#accordionPromo" href="#collapse{{$adhesion->idMagasin}}">{{$adhesion->nomMagasin}}
                            </a>
                        </h4>
                    </div>
                    <div id="collapse{{$adhesion->idMagasin}}" class="collapse">
                        <div class="card-body">
                            <div class="accordion" id="accordion{{$adhesion->idMagasin}}">
            @endif
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="mb-0">
                                            <a data-toggle="collapse" data-parent="#accordion{{$adhesion->idMagasin}}" href="#collapsePromo{{$adhesion->idPromo}}">{{$adhesion->libPromo}}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapsePromo{{$adhesion->idPromo}}" class="collapse">
                                        <div class="card-body">{{$adhesion->libPromo}}</div>
                                    </div>
                                </div>
                <?php $old_magasin = $adhesion->idMagasin; ?>
        @endforeach
                            </div>
                        </div>
                    </div>
                </div>
    </div>
@endsection