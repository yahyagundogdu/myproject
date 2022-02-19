@extends('frontend.app')

@section('keywords', $page->keywords)
@section('description', $page->description)


@section('content')

    @include('frontend.include.slider')
    @include('frontend.include.bottom_slider_icon')
    <section class="products">

        <div class="container">

            <header>
                <div class="row">
                    <div class="col-md-offset-2 col-md-8 text-center">
                        <h2 class="title">Popular products</h2>
                        <div class="text">
                            <p>Check out our latest collections</p>
                        </div>
                    </div>
                </div>
            </header>

            <div class="row">
                <div class="col-md-4 col-xs-6">

                    <article>
                        <div class="info">
                            <span class="add-favorite added">
                                <a href="javascript:void(0);" data-title="Add to favorites"
                                    data-title-added="Added to favorites list"><i class="icon icon-heart"></i></a>
                            </span>
                            <span>
                                <a href="#productid1" class="mfp-open" data-title="Quick wiew"><i
                                        class="icon icon-eye"></i></a>
                            </span>
                        </div>
                        <div class="btn btn-add">
                            <i class="icon icon-cart"></i>
                        </div>
                        <div class="figure-grid">
                            <div class="image">
                                <a href="#productid1" class="mfp-open">
                                    <img src="/frontend/assets/images/product-1.png" alt="" width="360" />
                                </a>
                            </div>
                            <div class="text">
                                <h2 class="title h4"><a href="product.html">Green corner</a></h2>
                                <sub>$ 1499,-</sub>
                                <sup>$ 1099,-</sup>
                                <span class="description clearfix">Gubergren amet dolor ea diam takimata consetetur
                                    facilisis blandit et aliquyam lorem ea duo labore diam sit et consetetur
                                    nulla</span>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-md-4 col-xs-6">
                    <article>
                        <div class="info">
                            <span class="add-favorite">
                                <a href="javascript:void(0);" data-title="Add to favorites"
                                    data-title-added="Added to favorites list"><i class="icon icon-heart"></i></a>
                            </span>
                            <span>
                                <a href="#productid1" class="mfp-open" data-title="Quick wiew"><i
                                        class="icon icon-eye"></i></a>
                            </span>
                        </div>
                        <div class="btn btn-add">
                            <i class="icon icon-cart"></i>
                        </div>
                        <div class="figure-grid">
                            <div class="image">
                                <a href="#productid1" class="mfp-open">
                                    <img src="/frontend/assets/images/product-2.png" alt="" width="360" />
                                </a>
                            </div>
                            <div class="text">
                                <h2 class="title h4"><a href="product.html">Laura</a></h2>
                                <sub>$ 3999,-</sub>
                                <sup>$ 3499,-</sup>
                                <span class="description clearfix">Gubergren amet dolor ea diam takimata consetetur
                                    facilisis blandit et aliquyam lorem ea duo labore diam sit et consetetur
                                    nulla</span>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-md-4 col-xs-6">
                    <article>
                        <div class="info">
                            <span class="add-favorite">
                                <a href="javascript:void(0);" data-title="Add to favorites"
                                    data-title-added="Added to favorites list"><i class="icon icon-heart"></i></a>
                            </span>
                            <span>
                                <a href="#productid1" class="mfp-open" data-title="Quick wiew"><i
                                        class="icon icon-eye"></i></a>
                            </span>
                        </div>
                        <div class="btn btn-add">
                            <i class="icon icon-cart"></i>
                        </div>
                        <div class="figure-grid">
                            <span class="label label-warning">New</span>
                            <div class="image">
                                <a href="#productid1" class="mfp-open">
                                    <img src="/frontend/assets/images/product-3.png" alt="" width="360" />
                                </a>
                            </div>
                            <div class="text">
                                <h2 class="title h4"><a href="product.html">Nude</a></h2>
                                <sup>$ 2999,-</sup>
                                <span class="description clearfix">Gubergren amet dolor ea diam takimata consetetur
                                    facilisis blandit et aliquyam lorem ea duo labore diam sit et consetetur
                                    nulla</span>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-md-4 col-xs-6">
                    <article>
                        <div class="info">
                            <span class="add-favorite">
                                <a href="javascript:void(0);" data-title="Add to favorites"
                                    data-title-added="Added to favorites list"><i class="icon icon-heart"></i></a>
                            </span>
                            <span>
                                <a href="#productid1" class="mfp-open" data-title="Quick wiew"><i
                                        class="icon icon-eye"></i></a>
                            </span>
                        </div>
                        <div class="btn btn-add">
                            <i class="icon icon-cart"></i>
                        </div>
                        <div class="figure-grid">
                            <div class="image">
                                <a href="#productid1" class="mfp-open">
                                    <img src="/frontend/assets/images/product-4.png" alt="" width="360" />
                                </a>
                            </div>
                            <div class="text">
                                <h2 class="title h4"><a href="product.html">Aurora</a></h2>
                                <sup>$ 299,-</sup>
                                <span class="description clearfix">Gubergren amet dolor ea diam takimata consetetur
                                    facilisis blandit et aliquyam lorem ea duo labore diam sit et consetetur
                                    nulla</span>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-md-4 col-xs-6">
                    <article>
                        <div class="info">
                            <span class="add-favorite added">
                                <a href="javascript:void(0);" data-title="Add to favorites"
                                    data-title-added="Added to favorites list"><i class="icon icon-heart"></i></a>
                            </span>
                            <span>
                                <a href="#productid1" class="mfp-open" data-title="Quick wiew"><i
                                        class="icon icon-eye"></i></a>
                            </span>
                        </div>
                        <div class="btn btn-add">
                            <i class="icon icon-cart"></i>
                        </div>
                        <div class="figure-grid">
                            <span class="label label-info">-50%</span>
                            <div class="image">
                                <a href="#productid1" class="mfp-open">
                                    <img src="/frontend/assets/images/product-5.png" alt="" width="360" />
                                </a>
                            </div>
                            <div class="text">
                                <h2 class="title h4"><a href="product.html">Dining set</a></h2>
                                <sub>$ 1999,-</sub>
                                <sup>$ 1499,-</sup>
                                <span class="description clearfix">Gubergren amet dolor ea diam takimata consetetur
                                    facilisis blandit et aliquyam lorem ea duo labore diam sit et consetetur
                                    nulla</span>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-md-4 col-xs-6">
                    <article>
                        <div class="info">
                            <span class="add-favorite">
                                <a href="javascript:void(0);" data-title="Add to favorites"
                                    data-title-added="Added to favorites list"><i class="icon icon-heart"></i></a>
                            </span>
                            <span>
                                <a href="#productid1" class="mfp-open" data-title="Quick wiew"><i
                                        class="icon icon-eye"></i></a>
                            </span>
                        </div>
                        <div class="btn btn-add">
                            <i class="icon icon-cart"></i>
                        </div>
                        <div class="figure-grid">
                            <div class="image">
                                <a href="#productid1" class="mfp-open">
                                    <img src="/frontend/assets/images/product-6.png" alt="" width="360" />
                                </a>
                            </div>
                            <div class="text">
                                <h2 class="title h4"><a href="product.html">Seat chair</a></h2>
                                <sup>$ 896,-</sup>
                                <span class="description clearfix">Gubergren amet dolor ea diam takimata consetetur
                                    facilisis blandit et aliquyam lorem ea duo labore diam sit et consetetur
                                    nulla</span>
                            </div>
                        </div>
                    </article>
                </div>
            </div>

            <div class="wrapper-more">
                <a href="products-grid.html" class="btn btn-main">View store</a>
            </div>

            <div class="popup-main mfp-hide" id="productid1">

                <div class="product">

                    <div class="popup-title">
                        <div class="h1 title">Laura <small>product category</small></div>
                    </div>

                    <div class="owl-product-gallery">
                        <img src="/frontend/assets/images/product-1.png" alt="" width="640" />
                        <img src="/frontend/assets/images/product-2.png" alt="" width="640" />
                        <img src="/frontend/assets/images/product-3.png" alt="" width="640" />
                        <img src="/frontend/assets/images/product-4.png" alt="" width="640" />
                    </div>



                    <div class="popup-content">
                        <div class="product-info-wrapper">
                            <div class="row">



                                <div class="col-sm-6">
                                    <div class="info-box">
                                        <strong>Maifacturer</strong>
                                        <span>Brand name</span>
                                    </div>
                                    <div class="info-box">
                                        <strong>Materials</strong>
                                        <span>Wood, Leather, Acrylic</span>
                                    </div>
                                    <div class="info-box">
                                        <strong>Availability</strong>
                                        <span><i class="fa fa-check-square-o"></i> in stock</span>
                                    </div>
                                </div>



                                <div class="col-sm-6">
                                    <div class="info-box">
                                        <strong>Available Colors</strong>
                                        <div class="product-colors clearfix">
                                            <span class="color-btn color-btn-red"></span>
                                            <span class="color-btn color-btn-blue checked"></span>
                                            <span class="color-btn color-btn-green"></span>
                                            <span class="color-btn color-btn-gray"></span>
                                            <span class="color-btn color-btn-biege"></span>
                                        </div>
                                    </div>
                                    <div class="info-box">
                                        <strong>Choose size</strong>
                                        <div class="product-colors clearfix">
                                            <span class="color-btn color-btn-biege">S</span>
                                            <span class="color-btn color-btn-biege checked">M</span>
                                            <span class="color-btn color-btn-biege">XL</span>
                                            <span class="color-btn color-btn-biege">XXL</span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>



                    <div class="popup-table">
                        <div class="popup-cell">
                            <div class="price">
                                <span class="h3">$ 1999,00 <small>$ 2999,00</small></span>
                            </div>
                        </div>
                        <div class="popup-cell">
                            <div class="popup-buttons">
                                <a href="product.html"><span class="icon icon-eye"></span> <span
                                        class="hidden-xs">View more</span></a>
                                <a href="javascript:void(0);"><span class="icon icon-cart"></span> <span
                                        class="hidden-xs">Buy</span></a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </section>



    <section class="stretcher-wrapper">

        <header class="hidden">

            <div class="container">
                <div class="row">
                    <div class="col-md-offset-2 col-md-8 text-center">
                        <h1 class="h2 title">Popular categories</h1>
                        <div class="text">
                            <p>
                                Whether you are changing your home, or moving into a new one, you will find a huge
                                selection of quality living room furniture,
                                bedroom furniture, dining room furniture and the best value at Furniture factory
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </header>



        <ul class="stretcher">



            <li class="stretcher-item" style="background-image:url(assets/images/gallery-1.jpg);">

                <div class="stretcher-logo">
                    <div class="text">
                        <span class="f-icon f-icon-bedroom"></span>
                        <span class="text-intro">Bedroom</span>
                    </div>
                </div>

                <figure>
                    <h4>Modern furnishing projects</h4>
                    <figcaption>New furnishing ideas</figcaption>
                </figure>

                <a href="#">Anchor link</a>
            </li>



            <li class="stretcher-item" style="background-image:url(assets/images/gallery-2.jpg);">

                <div class="stretcher-logo">
                    <div class="text">
                        <span class="f-icon f-icon-sofa"></span>
                        <span class="text-intro">Living room</span>
                    </div>
                </div>

                <figure>
                    <h4>Furnishing and complements</h4>
                    <figcaption>Discover the design table collection</figcaption>
                </figure>

                <a href="#">Anchor link</a>
            </li>



            <li class="stretcher-item" style="background-image:url(assets/images/gallery-3.jpg);">

                <div class="stretcher-logo">
                    <div class="text">
                        <span class="f-icon f-icon-office"></span>
                        <span class="text-intro">Office</span>
                    </div>
                </div>

                <figure>
                    <h4>Which is Best for Your Home</h4>
                    <figcaption>Wardrobes vs Walk-In Closets</figcaption>
                </figure>

                <a href="#">Anchor link</a>
            </li>



            <li class="stretcher-item" style="background-image:url(assets/images/gallery-4.jpg);">

                <div class="stretcher-logo">
                    <div class="text">
                        <span class="f-icon f-icon-bathroom"></span>
                        <span class="text-intro">Bathroom</span>
                    </div>
                </div>

                <figure>
                    <h4>Keeping Things Minimal</h4>
                    <figcaption>Creating Your Very Own Bathroom</figcaption>
                </figure>

                <a href="#">Anchor link</a>
            </li>



            <li class="stretcher-item more">
                <div class="more-icon">
                    <span data-title-show="Show more" data-title-hide="+"></span>
                </div>
                <a href="#"></a>
            </li>

        </ul>
    </section>



    <section class="blog blog-block">

        <div class="container">



            <header>
                <div class="row">
                    <div class="col-md-offset-2 col-md-8 text-center">
                        <h2 class="title">Interior ideas</h2>
                        <div class="text">
                            <p>Keeping things minimal</p>
                        </div>
                    </div>
                </div>
            </header>

            <div class="row">



                <div class="col-sm-4">
                    <article>
                        <a href="article.html">
                            <div class="image">
                                <img src="/frontend/assets/images/project-1.jpg" alt="" />
                            </div>
                            <div class="entry entry-block">
                                <div class="date">28 Mart 2017</div>
                                <div class="title">
                                    <h2 class="h3">Creating the Perfect Gallery Wall </h2>
                                </div>
                                <div class="description">
                                    <p>
                                        You’ve finally reached this point in your life- you’ve bought your first
                                        home, moved
                                        into your very own apartment, moved out of the dorm room or you’re finally
                                        downsizing
                                        after all of your kids have left the nest.
                                    </p>
                                </div>
                            </div>
                            <div class="show-more">
                                <span class="btn btn-main btn-block">Read more</span>
                            </div>
                        </a>
                    </article>
                </div>



                <div class="col-sm-4">
                    <article>
                        <a href="article.html">
                            <div class="image">
                                <img src="/frontend/assets/images/project-2.jpg" alt="" />
                            </div>
                            <div class="entry entry-block">
                                <div class="date">25 Mart 2017</div>
                                <div class="title">
                                    <h2 class="h3">Making the Most Out of Your Kids Old Bedroom</h2>
                                </div>
                                <div class="description">
                                    <p>
                                        You’ve finally reached this point in your life- you’ve bought your first
                                        home, moved
                                        into your very own apartment, moved out of the dorm room or you’re finally
                                        downsizing
                                        after all of your kids have left the nest.
                                    </p>
                                </div>
                            </div>
                            <div class="show-more">
                                <span class="btn btn-main btn-block">Read more</span>
                            </div>
                        </a>
                    </article>
                </div>



                <div class="col-sm-4">
                    <article>
                        <a href="article.html">
                            <div class="image">
                                <img src="/frontend/assets/images/project-3.jpg" alt="" />
                            </div>
                            <div class="entry entry-block">
                                <div class="date">28 Mart 2017</div>
                                <div class="title">
                                    <h2 class="h3">Have a look at our new projects!</h2>
                                </div>
                                <div class="description">
                                    <p>
                                        You’ve finally reached this point in your life- you’ve bought your first
                                        home, moved
                                        into your very own apartment, moved out of the dorm room or you’re finally
                                        downsizing
                                        after all of your kids have left the nest.
                                    </p>
                                </div>
                            </div>
                            <div class="show-more">
                                <span class="btn btn-main btn-block">Read more</span>
                            </div>
                        </a>
                    </article>
                </div>

            </div>



            <div class="wrapper-more">
                <a href="ideas.html" class="btn btn-main">View all posts</a>
            </div>

        </div>

    </section>



    <section class="banner" style="background-image:url(assets/images/gallery-4.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-2 col-md-8 text-center">
                    <h2 class="title">Our story</h2>
                    <p>
                        We believe in creativity as one of the major forces of progress. With this idea, we traveled
                        throughout Italy to find exceptional
                        artisans and bring their unique handcrafted objects to connoisseurs everywhere.
                    </p>
                    <p><a href="about.html" class="btn btn-clean">Read full story</a></p>
                </div>
            </div>
        </div>
    </section>



    <section class="blog">

        <div class="container">



            <header>
                <div class="row">
                    <div class="col-md-offset-2 col-md-8 text-center">
                        <h1 class="h2 title">Blog</h1>
                        <div class="text">
                            <p>Latest news from the blog</p>
                        </div>
                    </div>
                </div>
            </header>

            <div class="row">



                <div class="col-sm-4">
                    <article>
                        <a href="article.html">
                            <div class="image" style="background-image:url(assets/images/blog-1.jpg)">
                                <img src="/frontend/assets/images/blog-1.jpg" alt="" />
                            </div>
                            <div class="entry entry-table">
                                <div class="date-wrapper">
                                    <div class="date">
                                        <span>MAR</span>
                                        <strong>08</strong>
                                        <span>2017</span>
                                    </div>
                                </div>
                                <div class="title">
                                    <h2 class="h5">The 3 Tricks that Quickly Became Rules</h2>
                                </div>
                            </div>
                            <div class="show-more">
                                <span class="btn btn-main btn-block">Read more</span>
                            </div>
                        </a>
                    </article>
                </div>



                <div class="col-sm-4">
                    <article>
                        <a href="article.html">
                            <div class="image" style="background-image:url(assets/images/blog-2.jpg)">
                                <img src="/frontend/assets/images/blog-1.jpg" alt="" />
                            </div>
                            <div class="entry entry-table">
                                <div class="date-wrapper">
                                    <div class="date">
                                        <span>MAR</span>
                                        <strong>03</strong>
                                        <span>2017</span>
                                    </div>
                                </div>
                                <div class="title">
                                    <h2 class="h5">Decorating When You're Starting Out or Starting Over
                                    </h2>
                                </div>
                            </div>
                            <div class="show-more">
                                <span class="btn btn-main btn-block">Read more</span>
                            </div>
                        </a>
                    </article>
                </div>



                <div class="col-sm-4">
                    <article>
                        <a href="article.html">
                            <div class="image" style="background-image:url(assets/images/blog-8.jpg)">
                                <img src="/frontend/assets/images/blog-8.jpg" alt="" />
                            </div>
                            <div class="entry entry-table">
                                <div class="date-wrapper">
                                    <div class="date">
                                        <span>MAR</span>
                                        <strong>01</strong>
                                        <span>2017</span>
                                    </div>
                                </div>
                                <div class="title">
                                    <h2 class="h5">What does your favorite dining chair say about you?
                                    </h2>
                                </div>
                            </div>
                            <div class="show-more">
                                <span class="btn btn-main btn-block">Read more</span>
                            </div>
                        </a>
                    </article>
                </div>

            </div>



            <div class="wrapper-more">
                <a href="blog-grid.html" class="btn btn-main">View all posts</a>
            </div>

        </div>

    </section>



    <section class="instagram">



        <header>
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-2 col-md-8 text-center">
                        <h2 class="h2 title">Follow us <i class="fa fa-instagram fa-2x"></i> Instagram </h2>
                        <div class="text">
                            <p>@InstaFurnitureFactory</p>
                        </div>
                    </div>
                </div>
            </div>
        </header>



        <div class="gallery clearfix">
            <a class="item" href="#">
                <img src="/frontend/assets/images/square-1.jpg" alt="Alternate Text" />
            </a>
            <a class="item" href="#">
                <img src="/frontend/assets/images/square-2.jpg" alt="Alternate Text" />
            </a>
            <a class="item" href="#">
                <img src="/frontend/assets/images/square-3.jpg" alt="Alternate Text" />
            </a>
            <a class="item" href="#">
                <img src="/frontend/assets/images/square-4.jpg" alt="Alternate Text" />
            </a>
            <a class="item" href="#">
                <img src="/frontend/assets/images/square-5.jpg" alt="Alternate Text" />
            </a>
            <a class="item" href="#">
                <img src="/frontend/assets/images/square-6.jpg" alt="Alternate Text" />
            </a>

        </div>


    </section>
@endsection
