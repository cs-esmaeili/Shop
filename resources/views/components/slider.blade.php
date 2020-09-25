<div id="{{ $id }}" class="{{ $class }}" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach($images as $item)
            @if($loop->index == 0)
                <li data-target="#{{ $id }}" data-slide-to="0" class="active"></li>
            @else
                <li data-target="#{{ $id }}" data-slide-to="{{ $loop->index }}"></li>
            @endif
        @endforeach
    </ol>
    <div class="carousel-inner">
        @foreach($images as $item)
            @if($loop->index == 0)
                <div class="carousel-item active">
                    <img src="{{ $item }}" class="d-block w-100" height="{{ $height }}">
                </div>
            @else
                <div class="carousel-item">
                    <img src="{{ $item }}" class="d-block w-100" height="{{ $height }}">
                </div>
            @endif
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#{{ $id }}" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#{{ $id }}" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>


