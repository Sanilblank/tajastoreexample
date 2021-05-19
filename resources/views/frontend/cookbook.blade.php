@extends('frontend.layouts.app')

@section('content')


  <!-- Breadcrumb Section Begin -->
  <section class="hero">
      <div class="hero__item set-bg" data-setbg="{{asset('frontend/img/hero/banner.jpg')}}">
        <div class="hero__text">
          <span>FRUIT FRESH</span>
          <h2>Vegetable <br />100% Organic</h2>
          <p>Free Pickup and Delivery Available</p>
          <a href="#" class="primary-btn">SHOP NOW</a>
        </div>
      </div>
    </section>
    <!-- Breadcrumb Section End -->

<div class="container">
      <!-- ============= COMPONENT ============== -->
      <nav class="navbar navbar-expand-lg navbar-dark cbnav" >
        <div class="container-fluid">
          <a class="navbar-brand" href="#">TajaRecipe</a>
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
              <li class="nav-item dropdown has-megamenu cbdrop">
                <a
                  class="nav-link dropdown-toggle cblink"
                  href="#"
                  data-bs-toggle="dropdown"
                >
                  Mega menu
                </a>
                <div class="dropdown-menu megamenu" role="menu">
                  <div class="row g-3">
                    <div class="col-lg-3 col-6">
                      <div class="col-megamenu">
                        <h6 class="title">Title Menu One</h6>
                        <ul class="list-unstyled">
                          <li><a href="#">Custom Menu</a></li>
                          <li><a href="#">Custom Menu</a></li>
                          <li><a href="#">Custom Menu</a></li>
                          <li><a href="#">Custom Menu</a></li>
                          <li><a href="#">Custom Menu</a></li>
                          <li><a href="#">Custom Menu</a></li>
                        </ul>
                      </div>
                      <!-- col-megamenu.// -->
                    </div>
                    <!-- end col-3 -->
                    <div class="col-lg-3 col-6">
                      <div class="col-megamenu">
                        <h6 class="title">Title Menu Two</h6>
                        <ul class="list-unstyled">
                          <li><a href="#">Custom Menu</a></li>
                          <li><a href="#">Custom Menu</a></li>
                          <li><a href="#">Custom Menu</a></li>
                          <li><a href="#">Custom Menu</a></li>
                          <li><a href="#">Custom Menu</a></li>
                          <li><a href="#">Custom Menu</a></li>
                        </ul>
                      </div>
                      <!-- col-megamenu.// -->
                    </div>
                    <!-- end col-3 -->
                    <div class="col-lg-3 col-6">
                      <div class="col-megamenu">
                        <h6 class="title">Title Menu Three</h6>
                        <ul class="list-unstyled">
                          <li><a href="#">Custom Menu</a></li>
                          <li><a href="#">Custom Menu</a></li>
                          <li><a href="#">Custom Menu</a></li>
                          <li><a href="#">Custom Menu</a></li>
                          <li><a href="#">Custom Menu</a></li>
                          <li><a href="#">Custom Menu</a></li>
                        </ul>
                      </div>
                      <!-- col-megamenu.// -->
                    </div>
                    <div class="col-lg-3 col-6">
                      <div class="col-megamenu">
                        <h6 class="title">Title Menu Four</h6>
                        <ul class="list-unstyled">
                          <li><a href="#">Custom Menu</a></li>
                          <li><a href="#">Custom Menu</a></li>
                          <li><a href="#">Custom Menu</a></li>
                          <li><a href="#">Custom Menu</a></li>
                          <li><a href="#">Custom Menu</a></li>
                          <li><a href="#">Custom Menu</a></li>
                        </ul>
                      </div>
                      <!-- col-megamenu.// -->
                    </div>
                    <!-- end col-3 -->
                  </div>
                  <!-- end row -->
                </div>
                <!-- dropdown-mega-menu.// -->
              </li>
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
              <div class="col-lg-4 col-md-5 col-sm-6 ">
                <div class="blog__item recipe-border">
                  
                  <div class="blog__item__pic">
                    <img src="{{asset('frontend/img/blog/blog-2.jpg')}}" alt="" />
                  </div>
                  <div class="blog__item__text">
                  <div class="recipe-time">15min</div>
                    <ul>
                      <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                      <li><i class="fa fa-comment-o"></i> 5</li>
                      <li>
                        <i class="fa fa-shopping-basket"></i> Ingredients- 15
                      </li>
                    </ul>
                    <h5><a href="{{route('recipe')}}">6 ways to prepare breakfast for 30</a></h5>
                    <p>
                      Sed quia non numquam modi tempora indunt ut labore et
                      dolore magnam aliquam quaerat
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-5 col-sm-6 ">
                <div class="blog__item recipe-border">
                  
                  <div class="blog__item__pic">
                    <img src="{{asset('frontend/img/blog/blog-2.jpg')}}" alt="" />
                  </div>
                  <div class="blog__item__text">
                  <div class="recipe-time">15min</div>
                    <ul>
                      <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                      <li><i class="fa fa-comment-o"></i> 5</li>
                      <li>
                        <i class="fa fa-shopping-basket"></i> Ingredients- 15
                      </li>
                    </ul>
                    <h5><a href="{{route('recipe')}}">6 ways to prepare breakfast for 30</a></h5>
                    <p>
                      Sed quia non numquam modi tempora indunt ut labore et
                      dolore magnam aliquam quaerat
                    </p>
                  </div>
                </div>
              </div>
            
              <div class="col-lg-4 col-md-5 col-sm-6 ">
                <div class="blog__item recipe-border">
                  
                  <div class="blog__item__pic">
                    <img src="{{asset('frontend/img/blog/blog-2.jpg')}}" alt="" />
                  </div>
                  <div class="blog__item__text">
                  <div class="recipe-time">15min</div>
                    <ul>
                      <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                      <li><i class="fa fa-comment-o"></i> 5</li>
                      <li>
                        <i class="fa fa-shopping-basket"></i> Ingredients- 15
                      </li>
                    </ul>
                    <h5><a href="{{route('recipe')}}">6 ways to prepare breakfast for 30</a></h5>
                    <p>
                      Sed quia non numquam modi tempora indunt ut labore et
                      dolore magnam aliquam quaerat
                    </p>
                  </div>
                </div>
              </div>
    
              <div class="col-lg-4 col-md-5 col-sm-6 ">
                <div class="blog__item recipe-border">
                  
                  <div class="blog__item__pic">
                    <img src="{{asset('frontend/img/blog/blog-2.jpg')}}" alt="" />
                  </div>
                  <div class="blog__item__text">
                  <div class="recipe-time">15min</div>
                    <ul>
                      <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                      <li><i class="fa fa-comment-o"></i> 5</li>
                      <li>
                        <i class="fa fa-shopping-basket"></i> Ingredients- 15
                      </li>
                    </ul>
                    <h5><a href="{{route('recipe')}}">6 ways to prepare breakfast for 30</a></h5>
                    <p>
                      Sed quia non numquam modi tempora indunt ut labore et
                      dolore magnam aliquam quaerat
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-5 col-sm-6 ">
                <div class="blog__item recipe-border">
                  
                  <div class="blog__item__pic">
                    <img src="{{asset('frontend/img/blog/blog-2.jpg')}}" alt="" />
                  </div>
                  <div class="blog__item__text">
                  <div class="recipe-time">15min</div>
                    <ul>
                      <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                      <li><i class="fa fa-comment-o"></i> 5</li>
                      <li>
                        <i class="fa fa-shopping-basket"></i> Ingredients- 15
                      </li>
                    </ul>
                    <h5><a href="{{route('recipe')}}">6 ways to prepare breakfast for 30</a></h5>
                    <p>
                      Sed quia non numquam modi tempora indunt ut labore et
                      dolore magnam aliquam quaerat
                    </p>
                  </div>
                </div>
              </div>
    
      

              <div class="col-lg-12 pt-5">
                <div class="product__pagination blog__pagination">
                  <a href="#">1</a>
                  <a href="#">2</a>
                  <a href="#">3</a>
                  <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                </div>
              </div>
            </div>
          </div>

<!-- additional details column -->
<div class="col-lg-2 col-md-12 col-sm-12">

  <div class="blog__sidebar">

    <div class="blog__sidebar__search">
                           <form action="#">
                                <input type="text" placeholder="Search...">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
     </div>
  </div>
  <div class="blog__sidebar__item">
                            <h4>Search By</h4>
                            <div class="blog__sidebar__item__tags">
                                <a href="#">Apple</a>
                                <a href="#">Beauty</a>
                                <a href="#">Vegetables</a>
                                <a href="#">Fruit</a>
                                <a href="#">Healthy Food</a>
                                <a href="#">Lifestyle</a>
                            </div>
                        </div>




</div>
        </div>
      </div>
    </section>
    <!-- Blog Section End -->




@endsection
