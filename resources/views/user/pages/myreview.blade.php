@extends('frontend.layouts.master')

@section('frontend_content')
    @include('user.include.bredcrumb', ['bredcrumb_title' => 'Profile'])
    <style>
        #checked {
            color: orange;
        }
        .star{
            font-size: 8px !important;
            text-align: center;
            margin-top: 16px;
        }
        .fa-star{
            font-size: 34px;
            margin-right: 12px;
        }
    </style>
    <div class="u-s-p-b-60">
        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="dash">
                <div class="container">
                    <div class="row">

                        @include('user.include.left-sidebar')

                        <div class="col-lg-9 col-md-12">
                            <div class="m-order__get">
                                <div class="row mb-4">
                                    <div class="col-lg-2">
                                        <img src="{{asset($product->productvariations[0]->image)}}" alt="" style="width: 100%;border-radius:4px;">
                                    </div>
                                    <div class="col-lg-6">
                                        <h6 style="font-size: 20px;color: black;font-weight: bold;">{{$product->product_name}}</h6>
                                    </div>
                                </div>
                                <form name="form" method="POST" action="{{url('user/store-review')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mb-4 pb-4">
                                        <label for="" style="font-size: 22px;color: black;font-weight: bold;">@lang("backend.Select Product Rating") </label>
                                        <div class="star">
                                            <span class="fas fa-star" onclick="checked('1')" id="checked1"></span>
                                            <span class="fas fa-star" onclick="checked('2')" id="checked2"></span>
                                            <span class="fas fa-star" onclick="checked('3')" id="checked3"></span>
                                            <span class="fas fa-star" onclick="checked('4')" id="checked4"></span>
                                            <span class="fas fa-star" onclick="checked('5')" id="checked5"></span>
                                        </div>
                                    </div>
                                    @if(isset($review))
                                        <input type="hidden" value="{{ $review->id }}" name="review_id"
                                        id="review_id">
                                    @endif
                                    <input type="hidden" value="{{ $product->id }}" name="product_id"
                                        id="product_id">
                                    <div class="form-group mb-4 mt-4 pb-4">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label for="" style="font-size: 22px;color: black;font-weight: bold;">@lang("frontend.Add Photos Images")</label>
                                                <input class="form-control mt-2" name="image[]" id="PostImage" onchange="prevPost_Img()" multiple type="file">
                                            </div>
                                            <div class="col-lg-8" id="prevFile">
                                                @if(isset($review))
                                                    <div class="postImg" style="width:25%;float:left;position:relative;">
                                                        <img src="` + i.url + `" alt="" id="previewImage" style="border-radius: 10px;width:100%;padding:5px;">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="rating" id="rating">
                                    @if (Auth::id())
                                        <input type="hidden" value="{{ Auth::id() }}" name="user_id"
                                            id="user_id">
                                    @else
                                    @endif
                                    <div class="form-group mb-3">
                                        <label for="" style="font-size: 22px;color: black;font-weight: bold;">@lang("frontend.Add Written Review") </label>
                                        <textarea class="form-control mt-2" name="messages" id="messages" rows="4">@if(isset($review)){{$review->text}}@endif</textarea>
                                    </div>
                                    <br>
                                    <div class="form-group mt-2" style="text-align: right">
                                        <div class="submitBtnSCourse">
                                            <button type="submit" name="btn"
                                                class="btn btn-primary AddReviewBtn btn-block" style="font-size: 18px;">@if(isset($review)) @lang("frontend.Resubmit") @else @lang("backend.Submit") @endif @lang("frontend.Review")</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Content ======-->
    </div>
    @if(isset($review))
        <script>
            $(document).ready( function(){
                checked('<?php echo $review->rating ?>');
                var postImages = JSON.parse('<?php echo $review->image ?>');
                var postImage = "";
                $('#prevFile').html('');
                postImages.forEach((i) => {
                    postImage += `<img src="../../public/images/review/` + i + `" alt="" id="previewImage"
                        style="border-radius: 10px;width: 150px;padding:5px;">`;
                });
                $('#prevFile').html(postImage);
            });
        </script>
    @endif

    <script>
        function checked(id) {
            if (id == 1) {
                $('#checked' + id).css('color', 'orange');
                $('#checked2').css('color', 'black');
                $('#checked3').css('color', 'black');
                $('#checked4').css('color', 'black');
                $('#checked5').css('color', 'black');
            } else if (id == 2) {
                $('#checked1').css('color', 'orange');
                $('#checked' + id).css('color', 'orange');
                $('#checked3').css('color', 'black');
                $('#checked4').css('color', 'black');
                $('#checked5').css('color', 'black');
            } else if (id == 3) {
                $('#checked1').css('color', 'orange');
                $('#checked2').css('color', 'orange');
                $('#checked' + id).css('color', 'orange');
                $('#checked4').css('color', 'black');
                $('#checked5').css('color', 'black');
            } else if (id == 4) {
                $('#checked1').css('color', 'orange');
                $('#checked2').css('color', 'orange');
                $('#checked3').css('color', 'orange');
                $('#checked' + id).css('color', 'orange');
                $('#checked5').css('color', 'black');
            } else if (id == 5) {
                $('#checked1').css('color', 'orange');
                $('#checked2').css('color', 'orange');
                $('#checked3').css('color', 'orange');
                $('#checked4').css('color', 'orange');
                $('#checked' + id).css('color', 'orange');
            } else {

            }

            $('#rating').val(id);
        }

        var PostImages = [];

        function prevPost_Img() {
            var PostImage = document.getElementById('PostImage').files;

            for (i = 0; i < PostImage.length; i++) {
                if (check_duplicate(PostImage[i].name)) {
                    PostImages.push({
                        "name": PostImage[i].name,
                        "url": URL.createObjectURL(PostImage[i]),
                        "file": PostImage[i],
                    });
                } else {
                    alert(PostImage[i].name + 'is already added to your list');
                }
            }

            document.getElementById("prevFile").innerHTML = PostImage_show();

        }

        function check_duplicate(name) {
            var PostImage = true;
            if (PostImages.length > 0) {
                for (e = 0; e < PostImages.length; e++) {
                    if (PostImages[e].name == name) {
                        PostImage = false;
                        break;
                    }
                }
            }
            return PostImage;
        }

        function PostImage_show() {
            var PostImage = "";
            PostImages.forEach((i) => {
                PostImage += `<div class="postImg" style="width:25%;float:left;position:relative;">
                                    <img src="` + i.url + `" alt="" id="previewImage" style="border-radius: 10px;width:100%;padding:5px;">
                                    <span onclick="removeSelectedPostImage(` + PostImages.indexOf(i) + `)" style="position: absolute;right: 0;cursor: pointer;font-size: 31px;color: red;margin-top: -8px;margin-right: 8px;">&times</span>
                                </div>`;
            })
            return PostImage;
        }

        function removeSelectedPostImage(e) {
            PostImages.splice(e, 1);
            document.getElementById("prevFile").innerHTML = PostImage_show();
        }
    </script>
@endsection
