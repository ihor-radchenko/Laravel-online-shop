
<h2 class="text-center color-black">
    Новинки
</h2>

<div class="container">
    <div class="row">
        @isset($new_products)
            @foreach($new_products as $product)
                @if($product->is_new === 1)
                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail product-show">
                            <div class="img-wrapper">
                                <img src="{{ asset($product->img) }}" alt="">
                            </div>
                            <span class="new">New</span>
                            <div class="caption">
                                @if(! is_null($product->old_price))
                                    <span class="new-price">${{ $product->price }}</span>
                                    <span class="old-price">${{ $product->old_price }}</span>
                                @else
                                    <span class="price">${{ $product->price }}</span>
                                @endif
                                <a href="{{ route('product', ['id' => $product->id]) }}" class="title">{{ $product->title }}</a>
                                <button class="my-btn btn-black">
                                    <i class="fa fa-cart-plus fa-lg" aria-hidden="true"></i> Добавить в корзину
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endisset
    </div>
</div>