@extends('frontend.layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/cookbookalgolia.css') }}">
@endpush

@section('content')


  <!-- Breadcrumb Section Begin -->
  <section class="hero">
      <div class="hero__item set-bg" data-setbg="{{asset('frontend/img/cookbook.jpg')}}" style="background-size: cover; margin-top: -1rem; margin-bottom: -2rem;">
        <div class="hero__text">
          <span>Tajamandi CookBook</span>
          <h2>Recipes <br />Different Receipes given by different people</h2>

          {{-- <a href="#" class="primary-btn">SHOP NOW</a> --}}
        </div>
      </div>
    </section>
    <!-- Breadcrumb Section End -->

<div class="container">
      <!-- ============= COMPONENT ============== -->
      <nav class="navbar navbar-expand-lg navbar-dark cbnav" >
        <div class="container-fluid">
          <a class="navbar-brand" href="{{route('cookbook')}}">TajaRecipe</a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#main_nav"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="main_nav">
            <ul class="navbar-nav">

                @foreach ($navbaritems as $navbaritem)
                <li class="nav-item dropdown has-megamenu cbdrop px-4">
                    <a
                      class="nav-link dropdown-toggle cblink"
                      href="#"
                      data-bs-toggle="dropdown"
                    >
                      {{$navbaritem->navbar_item}}
                    </a>
                    <div class="dropdown-menu megamenu" role="menu">
                      <div class="row g-3">
                        @php
                            $categories = DB::table('cookbook_categories')->where('cookbooknavbar_id', $navbaritem->id)->where('status', 1)->get();
                        @endphp
                        @foreach ($categories as $category)
                            <div class="col-lg-3 col-6">
                                <div class="col-megamenu">
                                <h6 class="title">{{$category->category}}</h6>
                                <ul class="list-unstyled">
                                    @php
                                        $subcategories = DB::table('cookbook_subcategories')->where('cookbookcategory_id', $category->id)->where('status', 1)->get();
                                    @endphp
                                    @foreach ($subcategories as $subcategory)
                                        <li><a href="{{route('cookbooksubcategories', [$subcategory->id, $subcategory->slug])}}">{{$subcategory->subcategory}}</a></li>
                                    @endforeach
                                </ul>
                                </div>
                                <!-- col-megamenu.// -->
                            </div>
                          <!-- end col-3 -->

                        @endforeach

                      </div>
                      <!-- end row -->
                    </div>
                    <!-- dropdown-mega-menu.// -->
                  </li>
                @endforeach


            </ul>
          </div>
          <!-- navbar-collapse.// -->
        </div>
        <!-- container-fluid.// -->
      </nav>
      <!-- ============= COMPONENT END// ============== -->
      </div>

  <!-- Blog Section Begin -->
  <section class="blog spad">

      <div class="container">

        <div class="row">

          <div class="col-lg-10 col-md-12">
          <div class="section-title">
        <h2>Tajamandi Recipes</h2>
      </div>
            <div class="row pb-3 d-md-flex d-sm-flex d-xs-flex justify-content-center justify-content-lg-start">
                @if (count($cookbookitems) == 0)
                    None Available
                @endif
                @foreach ($cookbookitems as $cookbookitem)
                <div class="col-lg-4 col-md-5 col-sm-6 ">
                    <div class="blog__item recipe-border">
                      <div class="blog__item__pic">
                        <a href="{{route('recipe', [$cookbookitem->id, $cookbookitem->slug])}}"><img src="{{Storage::disk('uploads')->url($cookbookitem->itemimage)}}" alt="Image of Recipe"/></a>
                      </div>
                      <div class="blog__item__text">
                      <div class="recipe-time">{{$cookbookitem->timetocook}}</div>
                        <ul>
                          <li><i class="fa fa-calendar-o"></i> {{date('F d, Y', strtotime($cookbookitem->created_at))}}</li>
                          <li> </li>
                          <li>
                              @php
                                  $ingredientcount = DB::table('ingredients')->where('cookbookitem_id', $cookbookitem->id)->count();
                              @endphp
                            <i class="fa fa-shopping-basket"></i> Ingredients- {{$ingredientcount}}
                          </li>
                        </ul>
                        <h5><a href="{{route('recipe', [$cookbookitem->id, $cookbookitem->slug])}}">{{$cookbookitem->itemname}}</a></h5>
                        <p>
                          {!! $cookbookitem->description !!}
                        </p>
                      </div>
                    </div>
                  </div>
                @endforeach



              <div class="col-lg-12 pt-5 text-center">
                {{-- <div class="product__pagination blog__pagination"> --}}
                  {{-- <a href="#">1</a>
                  <a href="#">2</a>
                  <a href="#">3</a>
                  <a href="#"><i class="fa fa-long-arrow-right"></i></a> --}}
                  {{ $cookbookitems->links() }}
                {{-- </div> --}}
              </div>
            </div>
          </div>

<!-- additional details column -->
<div class="col-lg-2 col-md-12 col-sm-12">

  <div class="blog__sidebar">

    <div class="blog__sidebar__search">
                           {{-- <form action="#">
                                <input type="text" placeholder="Search...">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form> --}}
                            <div class="aa-input-container" id="aa-input-container">
                                <input type="search" id="aa-search-input-cookbookalgolia" class="aa-input-cookbooksearch" placeholder="Search Cookbook" name="search"
                                    autocomplete="off" />
                                <svg class="aa-input-icon" viewBox="654 -372 1664 1664">
                                    <path d="M1806,332c0-123.3-43.8-228.8-131.5-316.5C1586.8-72.2,1481.3-116,1358-116s-228.8,43.8-316.5,131.5  C953.8,103.2,910,208.7,910,332s43.8,228.8,131.5,316.5C1129.2,736.2,1234.7,780,1358,780s228.8-43.8,316.5-131.5  C1762.2,560.8,1806,455.3,1806,332z M2318,1164c0,34.7-12.7,64.7-38,90s-55.3,38-90,38c-36,0-66-12.7-90-38l-343-342  c-119.3,82.7-252.3,124-399,124c-95.3,0-186.5-18.5-273.5-55.5s-162-87-225-150s-113-138-150-225S654,427.3,654,332  s18.5-186.5,55.5-273.5s87-162,150-225s138-113,225-150S1262.7-372,1358-372s186.5,18.5,273.5,55.5s162,87,225,150s113,138,150,225  S2062,236.7,2062,332c0,146.7-41.3,279.7-124,399l343,343C2305.7,1098.7,2318,1128.7,2318,1164z" />
                                </svg>
                            </div>
     </div>
  </div>
  <div class="blog__sidebar__item">
                            <h4>Latest Categories</h4>
                            <div class="blog__sidebar__item__tags">

                                @foreach ($latestcategories as $latest)
                                    <a href="{{route('cookbooksubcategories', [$latest->id, $latest->slug])}}">{{$latest->subcategory}}</a>
                                @endforeach
                            </div>
                        </div>




</div>
        </div>
      </div>
    </section>
    <!-- Blog Section End -->




@endsection
@push('scripts')
<script src="{{ asset('frontend/js/cookbookalgolia.js') }}"></script>
@endpush
