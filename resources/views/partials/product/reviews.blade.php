
<div class="reviews">
    <h3 class="color-black">@lang('page.reviews_head')</h3>
    @isset($reviews)
        <div class="reviews-list">
            @include('partials.product.review')
        </div>
        @if ($reviews->isEmpty())
            <h4 class="color-black text-center">@lang('page.reviews_empty')</h4>
        @endif
    @endisset

    <div class="center-container">
        <button class="my-btn btn-black" id="showMoreReviews" data-route="{{ route('product', ['product' => $product->id]) }}" data-load="@lang('button.load')" data-text="@lang('button.show_more')">
            @lang('button.show_more')
        </button>
    </div>

    <div class="add-review">
        <h3 class="color-black">@lang('page.add_reviews')</h3>
        <form action="">
            <div class="form-group">
                <div class="stars">
                    <div class="star-cont">
                        <input class="star star-5" id="star-5" type="radio" name="rating" value="5"/>
                        <label class="star star-5" for="star-5"></label>
                        <input class="star star-4" id="star-4" type="radio" name="rating" value="4"/>
                        <label class="star star-4" for="star-4"></label>
                        <input class="star star-3" id="star-3" type="radio" name="rating" value="3"/>
                        <label class="star star-3" for="star-3"></label>
                        <input class="star star-2" id="star-2" type="radio" name="rating" value="2"/>
                        <label class="star star-2" for="star-2"></label>
                        <input checked class="star star-1" id="star-1" type="radio" name="rating" value="1"/>
                        <label class="star star-1" for="star-1"></label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="name">@lang('form.name')</label>
                <input type="text" class="form-control" id="name" required minlength="2" maxlength="255">
            </div>
            <div class="form-group">
                <label for="title">@lang('form.brief')</label>
                <input type="text" class="form-control" id="title" required maxlength="255">
            </div>
            <div class="form-group">
                <label for="text">@lang('form.review')</label>
                <textarea name="" id="text" rows="4" class="form-control" required></textarea>
            </div>
            <button type="submit" class="my-btn btn-black">@lang('form.send')</button>
        </form>
    </div>
</div>