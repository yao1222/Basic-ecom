@extends("base")
@section("content")
<div class="container mt-5">
    <h3 class="mb-5" style="text-align: -webkit-center; color:#2F2F2F">Total</h3>
    <table class="table">
        <thead class="thead-light">
            <tr>
            <th scope="col">訂購人</th>
            <th scope="col">Email</th>
            <th scope="col">訂單總金額</th>
            </tr>
        </thead>
        <tbody>

            <tr>
            <th scope="row">{{$userName}}</th>
            <td>{{$userEmail}}</td>
            <td>${{$total}}</td>
            </tr>
        </tbody>
    </table>
    <form action="/orderplace" method="POST">
    @csrf
        <div class="form-group">
            <textarea name="address" placeholder="請填寫寄送地址" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label>付款方式：</label><br><br>
            <input type="radio" value="online" name="payment"><span>信用卡線上付款</span><br><br>
            <input type="radio" value="ATM" name="payment"><span>ATM</span><br><br>
            <input type="radio" value="Delivery" name="payment"><span>貨到付款</span><br><br>
        </div>
        <button type="submit" class="btn btn-primary">確認</button><br>
    </form>
    <br>
    <a href="/cartlist" class="btn btn-success">返回購物車</a>
</div>
@endsection
