@extends('layouts.plain')

@push('page-title', 'Trang chủ')

@push('extra-css')
    <link href="/public/css/index.css?t={{time()}}" rel="stylesheet">
@endpush

@section('page-content')
    <!-- Slider start -->
    <div class="banner-slider-container">
        <div id="carouselBanners" class="carousel slide carousel-fade h-100" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" style="background-image: url('/public/img/sliders/banner3.jpg');">

                </div>
                <div class="carousel-item" style="background-image: url('/public/img/sliders/banner2.jpg');">

                </div>
                <div class="carousel-item" style="background-image: url('/public/img/sliders/banner.jpg');">

                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselBanners" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Ảnh trước</span>
            </a>
            <a class="carousel-control-next" href="#carouselBanners" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Ảnh kế</span>
            </a>
        </div>
    </div>
    <!-- Slider end -->

    <!--Furniture start-->
   
    <!--Furniture end-->

    <!--Project Start-->
    <div class="project-wrap">
        <div class="project-heading">
            <div class="container">
                <div class="title">
                    <h1>Dự án <span>nổi bật</span></h1>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quam nisi, sollicitudin venenatis nisl id, iaculis pharetra quam. Vivamus cursus est vel sagittis tristique. Nunc vel ligula mollis, imperdiet dolor quis, consectetur magna. Duis facilisis tempor lectus tempus dignissim.</p>
            </div>
        </div>
        <div class="row gx-0">
            <div class="col-md-4">
                <div class="projectImg"><img src="/public/uploads/portfolios/portfolio1.jpg" class="w-100" alt="">
                    <div class="service-overlay">
                        <div class="heading"><a href="#">Interior Design</a></div>
                        <p>Design & Consult</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="projectImg"><img src="/public/uploads/portfolios/portfolio2.jpg" class="w-100" alt="">
                    <div class="service-overlay">
                        <div class="heading"><a href="#">Interior Design</a></div>
                        <p>Design & Consult</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="projectImg"><img src="/public/uploads/portfolios/portfolio3.jpg" class="w-100" alt="">
                    <div class="service-overlay">
                        <div class="heading"><a href="#">Interior Design</a></div>
                        <p>Design & Consult</p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="projectImg"><img src="/public/uploads/portfolios/portfolio4.jpg" class="w-100" alt="">
                    <div class="service-overlay">
                        <div class="heading"><a href="#">Interior Design</a></div>
                        <p>Design & Consult</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="projectImg"><img src="/public/uploads/portfolios/portfolio5.jpg" class="w-100" alt="">
                    <div class="service-overlay">
                        <div class="heading"><a href="#">Interior Design</a></div>
                        <p>Design & Consult</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row gx-0">
            <div class="col-md-3">
                <div class="projectImg"><img src="/public/uploads/portfolios/portfolio7.jpg" class="w-100" alt="">
                    <div class="service-overlay">
                        <div class="heading"><a href="#">Interior Design</a></div>
                        <p>Design & Consult</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="projectImg"><img src="/public/uploads/portfolios/portfolio8.jpg" class="w-100" alt="">
                    <div class="service-overlay">
                        <div class="heading"><a href="#">Interior Design</a></div>
                        <p>Design & Consult</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="projectImg"><img src="/public/uploads/portfolios/portfolio9.jpg" class="w-100" alt="">
                    <div class="service-overlay">
                        <div class="heading"><a href="#">Interior Design</a></div>
                        <p>Design & Consult</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Project End-->
 <!--Welcome start-->
    <div class="welcome-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="title">
                        <h1><span>Chúc mừng đến với</span> UniqueHouse <strong>Architecture</strong></h1>
                    </div>
                    <h3>Đơn vị tiên phong trong lĩnh vực thiết kế nội thất.</h3>
                    <p>Với đội ngũ kỹ sư trẻ đầy sáng tạo và năng động, chúng tôi đã mang đến cho khách hàng những sản phẩm thiết kế vô cùng hiện đại, sang trọng, ...  </p>
                    <div class="welcome-content-box row">
                        <div class="col-md-4 col-sm-4 welcome-box">
                            <div class="houseIcon"><img src="/public/img/house.png" alt=""></div>
                            <h4>Biệt thự - Nhà phố</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis facilisis leo eget.</p>
                        </div>
                        <div class="col-md-4 col-sm-4 welcome-box">
                            <div class="houseIcon"><img src="/public/img/house2.png" alt=""></div>
                            <h4>Nhà hàng - Cà phê</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis facilisis leo eget.</p>
                        </div>
                        <div class="col-md-4 col-sm-4 welcome-box">
                            <div class="houseIcon"><img src="/public/img/house5.png" alt=""></div>
                            <h4>Khu nghỉ dưỡng - Spa</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis facilisis leo eget.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 aboutImage">
                    @foreach(\App\Models\AboutUsImage::where('show','Y')->limit(1)->get() as $aboutUsImage)
                         <div class="welImg" style=" overflow: hidden;"><img src="{{$aboutUsImage->image_path}}" alt=""></div>
                         <div class="text-block"><span class="text-block-hightlight">{{ $aboutUsImage->description }}</span></div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
     <!--Welcome end-->
    <!--Team Start-->
    <div class="team-wrap">
        <div class="container">
            <div class="title">
                <h1>Đội ngũ <span>Ưu tú</span></h1>
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quam nisi, sollicitudin venenatis nisl id, iaculis pharetra quam. Vivamus cursus est vel sagittis tristique. Nunc vel ligula mollis, imperdiet dolor quis, consectetur magna. Duis facilisis tempor lectus tempus dignissim.</p>
            <div class="clearfix"></div>
            <ul class="row">
                @foreach($teamMembers as $teamMember)
                <li class="col-md-3 col-sm-6">
                    <div class="teamImg">
                        <img src="{{$teamMember->avatar_path}}" alt="{{$teamMember->full_name}}">
                    </div>
                    <div class="teamInfo">
                        <h3>{{$teamMember->full_name}}</h3>
                        <div class="designation">{{$teamMember->title}}</div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <!--Team End-->

@endsection
