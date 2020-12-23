@extends("base")
@section("content")
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-6">
            <img class="d-block" style="height:350px;" src="{{$detail['gallery']}}">
        </div>
        <div class="col-sm-6">
        <a href="/">Go Back</a>
        <h2>{{$detail['name']}}</h2>
        <h3>${{$detail['price']}}</h3>
        <h6>{{$detail['description']}}</h6>
        <p>[{{$detail['category']}}]</p>
        <br><br>
        <form action="/add_to_cart" method="POST">
        @csrf
            <input type="hidden" name="product_id" value="{{$detail['id']}}">
            <button class="btn btn-primary" type="submit">Add to Cart</button>
        </form>
        <br><br>
        <button class="btn btn-success">Buy Now</button>
        <br><br>
        </div>
    </div>
</div>
@endsection
