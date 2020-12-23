@extends("base")
@section("content")
<div style="height: 600px;">
    <!--Search Wrapper-->
    <div class="mt-5" style="text-align: -webkit-center;">
    <h3>Search Product Result</h3>
    @foreach($results as $item)
        <a href="detail/{{$item['id']}}">
        <div style="float:left; width:20%;">
            <img class="d-block" style="height:150px;" src="{{$item['gallery']}}">
            <div>
                <h6>{{$item['name']}}</h6>
                <h6>${{$item['price']}}</h6>
            </div>
        </a>
        </div>
    @endforeach
    </div>
</div>
@endsection
