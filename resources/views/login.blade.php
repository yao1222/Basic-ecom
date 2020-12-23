@extends("base")
@section("content")
<div class="container mt-5">
<h2 class="mb-1" style="text-align: -webkit-center; color:#2F2F2F">登入</h2>
<h3 class="mb-1" style="text-align: -webkit-center; color:#2F2F2F">Login</h3>
    <div class="row">
        <div class="col-sm-4 offset-md-4 mt-5">
            <form action="/login" method="POST">
            @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" name='email' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name='password' class="form-control" id="exampleInputPassword1">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
