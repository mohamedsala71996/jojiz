 <!--====== Section Intro start ======-->
 <div class="u-s-p-b-30 pb-0">
     <div class="section__intro u-s-m-b-10">
         <div class="container">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="section__text-wrap d-flex justify-content-between">

                         <div>
                             <h1 class="section__heading u-c-secondary u-s-m-b-12 u-s-m-t-20">
                                 @lang('frontend.Categories')
                                 <br>
                             </h1>
                             <span class="section__span u-c-silver">@lang('frontend.Get up for new categories') </span>
                         </div>
                         <a class="custom-btn2 btn-10" href="{{ route('shop') }}"><span>@lang('frontend.View More')</span></a>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!--======Section Intro end ======-->

     <!--====== Category Products section start ======-->
     <div class="section__content">
         <div class="container">
             <div class="slider-fouc">
                 <div class="owl-carousel category-slider " data-item="4">
                     @foreach ($categories as $category)
                         <div class="u-s-m-b-30">
                             <div class="product-o category-card product-o--radius product-o--hover-on text-center">
                                 <div class="product-o__wrap category-photo">
                                     <a class="aspect aspect--bg-grey aspect--square u-d-block"
                                         href="{{ route('category.product', $category->slug) }}">
                                         <img class="aspect__img" src="{{ asset($category->image) }}"
                                             alt="Category Image" />
                                     </a>
                                 </div>
                                 {{-- <div class="product-o__action-wrap category-shop">
                                     <ul class="product-o__action-list">
                                         <li>
                                             <a class="" data-weightid="" data-sizeid="10" data-variationid="31"
                                                 data-id="15" href="{{ route('category.product', $category->slug) }}"
                                                 data-tooltip="tooltip" data-placement="top" title=""
                                                 data-original-title="Continue Shopping"><i
                                                     class="fa-solid fa-bag-shopping"></i>
                                             </a>
                                         </li>

                                     </ul>
                                 </div> --}}
                                 <span class=" category-name">
                                     <a
                                         href="{{ route('category.product', $category->slug) }}">{{ $category->category_name }}</a>
                                 </span>
                             </div>
                         </div>
                     @endforeach

                 </div>
             </div>
         </div>
     </div>
 </div>
