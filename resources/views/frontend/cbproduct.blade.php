@extends('frontend.layouts.app')

@section('content')


    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg mt-3" style="background-repeat: no-repeat; background-size:cover;background-position:top center;" data-setbg="{{asset('frontend/img/breadcrumb.jpg')}}">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <div class="breadcrumb__text">
              <h2>Vegetable’s Package</h2>
              <div class="breadcrumb__option">
                <span>Vegetable’s Package</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-6">
            <div class="product__details__pic">
              <div class="product__details__pic__item">
                <img
                  class="product__details__pic__item--large"
                  src="{{asset('frontend/img/product/details/product-details-1.jpg')}}"
                  alt=""
                />
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-6">
            <div class="product__details__text">
              <h3>Vetgetable’s Package</h3>
              <div class="product__details__rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-half-o"></i>
                <span>(18 reviews)</span>
              </div>
              <div class="col-lg-12">
                <div class="blog__details__author">
                  <div class="blog__details__author__pic">
                    <img src="{{asset('frontend/img/blog/details/details-author.jpg')}}" alt="" />
                  </div>
                  <div class="blog__details__author__text">
                    <h6>Michael Scofield</h6>
                    <span>Chinese Chef</span>
                  </div>
                </div>
              </div>

              <p class="py-3">
                Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.
                Vestibulum ac diam sit amet quam vehicula elementum sed sit amet
                dui. Sed porttitor lectus nibh. Vestibulum ac diam sit amet quam
                vehicula elementum sed sit amet dui. Proin eget tortor risus.
              </p>

              <div class="col-lg-8 col-md-7 order-md-1 order-1 py-2">
                <div class="blog__details__content">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="blog__details__widget">
                        <ul>
                          <li><span>Categories:</span> Food</li>
                          <li>
                            <span>Tags:</span> All, Trending, Cooking, Healthy
                            Food, Life Style
                          </li>
                        </ul>
                        <div class="blog__details__social pb-4">
                          <a href="#"><i class="fa fa-facebook"></i></a>
                          <a href="#"><i class="fa fa-twitter"></i></a>
                          <a href="#"><i class="fa fa-google-plus"></i></a>
                          <a href="#"><i class="fa fa-linkedin"></i></a>
                          <a href="#"><i class="fa fa-envelope"></i></a>
                        </div>
                        <div>
                          <a href="#" class="primary-btn">Learn More</a>
                          <a href="#" class="heart-icon"
                            ><span class="icon_heart_alt"></span
                          ></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-12 d-flex justify-content-center text-center pt-4">
            <div class="recipe-info">
              <div class="recipe-info-text">
                <h3>Serving</h3>
                <h2>02</h2>
              </div>
            </div>
            <div class="recipe-info">
              <div class="recipe-info-text">
                <h3>Ingredients</h3>
                <h2>12</h2>
              </div>
            </div>
            <div class="recipe-info">
              <div class="recipe-info-text">
                <h3>Prep Time</h3>
                <h2>20 min</h2>
              </div>
            </div>
            <div class="recipe-info">
              <div class="recipe-info-text">
                <h3>Cooking Time</h3>
                <h2>25 min</h2>
              </div>
            </div>
          </div>

          <div class="col-lg-12">
            <div class="product__details__tab">
              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                  <a
                    class="nav-link active"
                    data-toggle="tab"
                    href="#tabs-1"
                    role="tab"
                    aria-selected="true"
                    >Ingredients</a
                  >
                </li>
                <li class="nav-item">
                  <a
                    class="nav-link"
                    data-toggle="tab"
                    href="#tabs-2"
                    role="tab"
                    aria-selected="false"
                    >Steps</a
                  >
                </li>
                <li class="nav-item">
                  <a
                    class="nav-link"
                    data-toggle="tab"
                    href="#tabs-3"
                    role="tab"
                    aria-selected="false"
                    >Comments <span>(1)</span></a
                  >
                </li>
              </ul>

              <div class="tab-content">
                <div class="tab-pane active" id="tabs-1" role="tabpanel">
                  <div class="product__details__tab__desc">
                    <h3>Main Ingredients</h3>
                    <div class="row ingredient-bg">
                      <div class="col-md-6 col-sm-6 ingredient-lg-4">
                        <div class="ingredient">
                          <div
                            class="ingredient__pic set-bg"
                            data-setbg="{{asset('frontend/img/product/product-1.jpg')}}"
                          ></div>
                          <div class="ingredient__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                          </div>
                        </div>
                      </div>
                      <div class="ingredient-lg-4 col-md-6 col-sm-6">
                        <div class="ingredient">
                          <div
                            class="ingredient__pic set-bg"
                            data-setbg="{{asset('frontend/img/product/product-2.jpg')}}"
                          ></div>
                          <div class="ingredient__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                          </div>
                        </div>
                      </div>
                      <div class="ingredient-lg-4 col-md-6 col-sm-6">
                        <div class="ingredient">
                          <div
                            class="ingredient__pic set-bg"
                            data-setbg="{{asset('frontend/img/product/product-3.jpg')}}"
                          ></div>
                          <div class="ingredient__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                          </div>
                        </div>
                      </div>
                      <div class="ingredient-lg-4 col-md-6 col-sm-6">
                        <div class="ingredient">
                          <div
                            class="ingredient__pic set-bg"
                            data-setbg="{{asset('frontend/img/product/product-4.jpg')}}"
                          ></div>
                          <div class="ingredient__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                          </div>
                        </div>
                      </div>
                      <div class="ingredient-lg-4 col-md-6 col-sm-6">
                        <div class="ingredient">
                          <div
                            class="ingredient__pic set-bg"
                            data-setbg="{{asset('frontend/img/product/product-5.jpg')}}"
                          ></div>
                          <div class="ingredient__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="tabs-2" role="tabpanel">
                  <div class="product__details__tab__desc">
                    <h6>Cooking Steps</h6>
                    <pre>
                      Step 1 :
                      Take a large non-stick pan and saute the pork bacon slices till they are crisp.
                      Step 2 :
                      Now chop the bacons into small pieces.
                      Step 3 :
                      Add chopped onions to the pan, drizzle olive oil and stir till they are soft.
                      Step 4 :
                      Pour in the sliced mushrooms, chopped bacons,garlic, pepper, salt and sage.
                      Step 5 : Stir till the mushrooms are brownish.
                      Step 6 : Add water/broth and simmer.
                      Step 7 : Sprinkle grated cheddar over the top surface, serve when the cheese melts.
                    </pre>
                  </div>
                </div>
                <div class="tab-pane" id="tabs-3" role="tabpanel">
                  <div class="product__details__tab__desc">
                    <h6>Comments</h6>
                    <p>Here will be the reviews or comments</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
      <div class="container">
      <div class="section-title">
        <h2>Shop Ingredients</h2>
      </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="shoping__cart__table">
              <table>
                <thead>
                  <tr>
                    <th class="shoping__product">Products</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="shoping__cart__item">
                      <img src="{{asset('frontend/img/cart/cart-1.jpg')}}" alt="" />
                      <h5>Vegetable’s Package</h5>
                    </td>
                    <td class="shoping__cart__price">$55.00</td>
                    <td class="shoping__cart__quantity">
                      <div class="quantity">
                        <div class="pro-qty">
                          <input type="text" value="1" />
                        </div>
                      </div>
                    </td>
                    <td>
                      <a href="#" class="primary-btn">Add to Cart</a>
                    </td>
                  </tr>
                  <tr>
                    <td class="shoping__cart__item">
                      <img src="{{asset('frontend/img/cart/cart-2.jpg')}}" alt="" />
                      <h5>Fresh Garden Vegetable</h5>
                    </td>
                    <td class="shoping__cart__price">$39.00</td>
                    <td class="shoping__cart__quantity">
                      <div class="quantity">
                        <div class="pro-qty">
                          <input type="text" value="1" />
                        </div>
                      </div>
                    </td>
                    <td>
                      <a href="#" class="primary-btn">Add to Cart</a>
                    </td>
                  </tr>
                  <tr>
                    <td class="shoping__cart__item">
                      <img src="{{asset('frontend/img/cart/cart-3.jpg')}}" alt="" />
                      <h5>Organic Bananas</h5>
                    </td>
                    <td class="shoping__cart__price">$69.00</td>
                    <td class="shoping__cart__quantity">
                      <div class="quantity">
                        <div class="pro-qty">
                          <input type="text" value="1" />
                        </div>
                      </div>
                    </td>
                    <td>
                      <a href="#" class="primary-btn">Add to Cart</a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Shoping Cart Section End -->




@endsection
