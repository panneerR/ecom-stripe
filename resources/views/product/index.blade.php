<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Com Stripe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row text-center my-4">
            @foreach($data as $product)
            <div class="col-sm-3 my-4">
                <img class="img img-fluid" style="width: 50%" src="{{asset('images/product.jpg')}}">
                <h4>{{$product->name}}</h4>
                <h6>Rs. {{$product->price}}</h6>
                <form class="form-group" method="POST" action="{{route('checkout',$product->id)}}">
                    @csrf
                    <button type="submit" class="btn btn-primary">Buy Now</button>
                </form>
                <hr/>
            </div>
            @endforeach
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
