@extends("base")
@section("content")
<div style="height: 600px;">
    <div id="carouselExampleIndicators" style="background:black" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>

    <div class="carousel-inner" style="text-align: -webkit-center;">
    @foreach($products as $item)
            <div class="carousel-item {{ $item['id']==1 ? 'active':'' }}">
                <a href="detail/{{$item['id']}}">
                <img class="d-block" style="height: 300px;" src="{{$item['gallery']}}" alt="First slide">
                </a>
            </div>
    @endforeach
    </div>

    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    </div>

    <!--Trending Wrapper-->

    <div class="mt-5" style="text-align: -webkit-center;">
    <h3>Trending Product</h3>
    @foreach($products as $item)
        <a href="detail/{{$item['id']}}">
        <div style="float:left; width:20%;">
            <img class="d-block" style="height:100px;" src="{{$item['gallery']}}">
            <div>
                <h6>{{$item['name']}}</h6>
            </div>
        </a>
        </div>
    @endforeach
    </div>
</div>
@endsection
