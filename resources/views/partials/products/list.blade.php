
@isset($products)
    @foreach($products as $product)
        <div class="row product-show product-show-list">
            <div class="col-sm-5 product-img">
                <img src="{{ asset($product->img) }}" alt="" class="image-response">
            </div>
            @if($product->is_top)
                <span class="top">Top</span>
            @elseif($product->is_new)
                <span class="new">New</span>
            @endif
            <div class="col-sm-7">
                <div class="caption">
                    @if(! is_null($product->old_price))
                        <span class="new-price">${{ $product->price }}</span>
                        <span class="old-price">${{ $product->old_price }}</span>
                    @else
                        <span class="price">${{ $product->price }}</span>
                    @endif
                    <a href="{{ route('product', ['product' => $product->id]) }}" class="title">{{ $product->title }}</a>
                    <p class="short-content">
                        {{ str_limit($product->description) }}
                    </p>
                    <button class="my-btn btn-black">
                        <i class="fa fa-cart-plus fa-lg" aria-hidden="true"></i> @lang('button.add_to_cart')
                    </button>
                    <div class="rating">
                        <div class="stars">
                            @for($i = 1; $i <= 5; $i++)
                                <span class="glyphicon glyphicon-star{{ ($i <= round($product->reviews->avg('rating'))) ? '' : '-empty'}}"></span>
                            @endfor
                        </div>
                        <div class="avg-rating">{{ round($product->reviews->avg('rating'), 1) }}</div>
                        <div class="count">
                            {{ $product->reviews->count() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @if($products->isEmpty())
        <h2 class="color-black text-center">@lang('page.products_empty')</h2>
    @endif
@endisset