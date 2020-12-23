@extends("base")
@section("content")
<div class="container mt-5">
    <h3 class="mb-5" style="text-align: -webkit-center; color:#2F2F2F">Cart List</h3>
    <a href="/ordernow" class="btn btn-success">Oder Now</a>
    @foreach($products as $item)
        <div class="row mb-3 mt-3 p-4" style="border-bottom: 1px solid #ccc">
                <div class="col-sm-3" style="text-align: -webkit-center;">
                    <a href="detail/{{$item->id}}">
                        <div style="float:left;">
                            <img class="d-block" style="height:150px;" src="{{$item->gallery}}">
                        </div>
                    </a>
                </div>
                <div class="col-sm-7">
                    <a href="detail/{{$item->id}}">
                        <div>
                                <h4 style="color: #2F2F2F;">{{$item->name}}</h4>

                                <h6 style="color: #2F2F2F;">${{$item->price}}</h6>
                                <p style="color: #434343;">{{$item->description}}</p>
                        </div>
                    </a>
                </div>
                <div class="col-sm-2" style="text-align: -webkit-center;">
                    <a href="/removecart/{{$item->cart_id}}" class="btn btn-warning">Remove</a>
                </div>
        </div>
    @endforeach
    <a href="/ordernow" class="btn btn-success">Oder Now</a>

</div>
@endsection
