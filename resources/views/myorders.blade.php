@extends("base")
@section("content")
<div class="container mt-5">
    <h3 class="mb-5" style="text-align: -webkit-center; color:#2F2F2F">My Orders</h3>
    @foreach($orders as $item)
        <div class="row mb-3 mt-3 p-4" style="border-bottom: 1px solid #ccc">
                <div class="col-sm-3" style="text-align: -webkit-center;">
                    <a href="detail/{{$item->id}}">
                        <div style="float:left;">
                            <img class="d-block" style="height:150px;" src="{{$item->gallery}}">
                        </div>
                    </a>
                </div>
                <div class="col-sm-9 pl-5">
                    <a href="detail/{{$item->id}}">
                        <div>
                                <h5 style="color: #2F2F2F;">{{$item->name}}</h5>

                                <p style="color: #434343;">Delivery Status: {{$item->status}}</p>
                                <p style="color: #434343;">Address: {{$item->address}}</p>
                                <p style="color: #434343;">Payment Status: {{$item->payment_status}}</p>
                                <p style="color: #434343;">Payment Method: {{$item->payment_method}}</p>
                        </div>
                    </a>
                </div>
        </div>
    @endforeach

</div>
@endsection
