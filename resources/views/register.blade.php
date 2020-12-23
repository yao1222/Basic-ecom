@extends("base")
@section("content")
<div class="container mt-5">
<h2 class="mb-1" style="text-align: -webkit-center; color:#2F2F2F">註冊</h2>
<h3 class="mb-1" style="text-align: -webkit-center; color:#2F2F2F">Register</h3>
    <div class="row">
        <div class="col-sm-4 offset-md-4 mt-5">
            <form action="/register" method="POST">
            @csrf
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">使用者名稱 / User Name</label>
                    <input type="text" name='name' class="form-control" placeholder="user name" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" name='email' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  placeholder="email" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">密碼 / Password</label>
                    <input type="password" name='password' class="form-control" id="exampleInputPassword1" placeholder="password" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">確認密碼 / Check Password</label>
                    <input type="password" name='password_check' class="form-control" id="exampleInputPassword1" placeholder="check password" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
