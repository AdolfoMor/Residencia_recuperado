@extends("layouts.main")

@section("main-container")

        <div id="Header_wrapper">
            <div id="Subheader" style="padding:125px 0;">
                <div class="container">
                    <div class="column one">
                        <h1 class="title">Projects</h1>
                    </div>
                </div>
            </div>
        </div>
        <div id="Content">
            <div class="content_wrapper clearfix">
                <div class="sections_group">

                    <div class="section section-filters">
                        <div class="section_wrapper clearfix">
                            <div id="Filters" class="column one  isotope-filters only only-categories">
                                <ul class="filters_buttons">
                                    <li class="label">
                                        Filter by
                                    </li>
                                    <li class="categories">
                                        <a class="open" href="#"><i class="icon-docs"></i>Categories<i class="icon-down-dir"></i></a>
                                    </li>
                                    <li class="reset">
                                        <a class="close" data-rel="*" href="projects.html"><i class="icon-cancel"></i> Show all</a>
                                    </li>
                                </ul>
                                <div class="filters_wrapper" data-cat="">
                                    <ul class="categories">
                                        <li class="reset-inner current-cat">
                                            <a class="close" data-rel="*" href="projects.html">All</a>
                                        </li>
                                        <li class="appartments">
                                            <a data-rel=".category-appartments" href="portfolio-item.html">Appartments</a>
                                        </li>
                                        <li class="commercial">
                                            <a data-rel=".category-commercial" href="portfolio-item.html">Commercial</a>
                                        </li>
                                        <li class="housing">
                                            <a data-rel=".category-housing" href="portfolio-item.html">Housing</a>
                                        </li>
                                        <li class="close">
                                            <a href="#"><i class="icon-cancel"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section">
                        <div class="section_wrapper clearfix">
                            <div class="column one column_portfolio">
                                <div class="portfolio_wrapper isotope_wrapper">
                                    <ul class="portfolio_group lm_wrapper isotope grid col-2">
                                        <li class="portfolio-item isotope-item category-commercial category-housing  has-thumbnail">
                                            <div class="portfolio-item-fw-bg">
                                                <div class="portfolio-item-fill"></div>
                                                <div class="list_style_header">
                                                    <h3 class="entry-title"><a class="link" href="portfolio-item.html">An laoreet arcu ac</a></h3>
                                                    <div class="links_wrapper">
                                                        <a href="#" class="button button_js portfolio_prev_js"><span class="button_icon"><i class="icon-up-open"></i></span></a><a href="#" class="button button_js portfolio_next_js"><span class="button_icon"><i class="icon-down-open"></i></span></a>
                                                        <a
                                                            href="portfolio-item.html" class="button button_left button_theme button_js"><span class="button_icon"><i class="icon-link"></i></span><span class="button_label">Read more</span></a>
                                                    </div>
                                                </div>
                                                <div class="image_frame scale-with-grid">
                                                    <div class="image_wrapper">
                                                        <a href="portfolio-item.html">
                                                            <div class="mask"></div>
                                                            <img src="images/builder2-portfolio-single6-960x720.jpg" class="scale-with-grid wp-post-image" />
                                                        </a>
                                                        <div class="image_links double">
                                                            <a href="images/builder2-portfolio-single6-1200x800.jpg" class="zoom" rel="prettyphoto"><i class="icon-search"></i></a><a href="portfolio-item.html" class="link"><i class="icon-link"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="desc">
                                                    <div class="title_wrapper">
                                                        <h5 class="entry-title"><a class="link" href="portfolio-item.html">An laoreet arcu ac</a></h5>
                                                        <div class="button-love">
                                                            <a href="#" class="mfn-love" data-id="59"><span class="icons-wrapper"><i class="icon-heart-empty-fa"></i><i class="icon-heart-fa"></i></span><span class="label">63</span></a>
                                                        </div>
                                                    </div>
                                                    <div class="desc-wrapper"></div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="portfolio-item isotope-item category-appartments  has-thumbnail">
                                            <div class="portfolio-item-fw-bg">
                                                <div class="portfolio-item-fill"></div>
                                                <div class="list_style_header">
                                                    <h3 class="entry-title"><a class="link" href="portfolio-item.html">Sed porta neque</a></h3>
                                                    <div class="links_wrapper">
                                                        <a href="#" class="button button_js portfolio_prev_js"><span class="button_icon"><i class="icon-up-open"></i></span></a><a href="#" class="button button_js portfolio_next_js"><span class="button_icon"><i class="icon-down-open"></i></span></a>
                                                        <a
                                                            href="portfolio-item.html" class="button button_left button_theme button_js"><span class="button_icon"><i class="icon-link"></i></span><span class="button_label">Read more</span></a>
                                                    </div>
                                                </div>
                                                <div class="image_frame scale-with-grid">
                                                    <div class="image_wrapper">
                                                        <a href="portfolio-item.html">
                                                            <div class="mask"></div>
                                                            <img src="images/builder2-portfolio-single5-960x720.jpg" class="scale-with-grid wp-post-image" />
                                                        </a>
                                                        <div class="image_links double">
                                                            <a href="images/builder2-portfolio-single5-1200x800.jpg" class="zoom" rel="prettyphoto"><i class="icon-search"></i></a><a href="portfolio-item.html" class="link"><i class="icon-link"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="desc">
                                                    <div class="title_wrapper">
                                                        <h5 class="entry-title"><a class="link" href="portfolio-item.html">Sed porta neque</a></h5>
                                                        <div class="button-love">
                                                            <a href="#" class="mfn-love" data-id="60"><span class="icons-wrapper"><i class="icon-heart-empty-fa"></i><i class="icon-heart-fa"></i></span><span class="label">74</span></a>
                                                        </div>
                                                    </div>
                                                    <div class="desc-wrapper"></div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="portfolio-item isotope-item category-commercial  has-thumbnail">
                                            <div class="portfolio-item-fw-bg">
                                                <div class="portfolio-item-fill"></div>
                                                <div class="list_style_header">
                                                    <h3 class="entry-title"><a class="link" href="portfolio-item.html">Vestibulum sollicitudin</a></h3>
                                                    <div class="links_wrapper">
                                                        <a href="#" class="button button_js portfolio_prev_js"><span class="button_icon"><i class="icon-up-open"></i></span></a><a href="#" class="button button_js portfolio_next_js"><span class="button_icon"><i class="icon-down-open"></i></span></a>
                                                        <a
                                                            href="portfolio-item.html" class="button button_left button_theme button_js"><span class="button_icon"><i class="icon-link"></i></span><span class="button_label">Read more</span></a>
                                                    </div>
                                                </div>
                                                <div class="image_frame scale-with-grid">
                                                    <div class="image_wrapper">
                                                        <a href="portfolio-item.html">
                                                            <div class="mask"></div>
                                                            <img src="images/builder2-portfolio-single3-960x720.jpg" class="scale-with-grid wp-post-image" />
                                                        </a>
                                                        <div class="image_links double">
                                                            <a href="images/builder2-portfolio-single3-1200x800.jpg" class="zoom" rel="prettyphoto"><i class="icon-search"></i></a><a href="portfolio-item.html" class="link"><i class="icon-link"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="desc">
                                                    <div class="title_wrapper">
                                                        <h5 class="entry-title"><a class="link" href="portfolio-item.html">Vestibulum sollicitudin</a></h5>
                                                        <div class="button-love">
                                                            <a href="#" class="mfn-love" data-id="61"><span class="icons-wrapper"><i class="icon-heart-empty-fa"></i><i class="icon-heart-fa"></i></span><span class="label">100</span></a>
                                                        </div>
                                                    </div>
                                                    <div class="desc-wrapper"></div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="portfolio-item isotope-item category-appartments category-commercial category-housing  has-thumbnail">
                                            <div class="portfolio-item-fw-bg">
                                                <div class="portfolio-item-fill"></div>
                                                <div class="list_style_header">
                                                    <h3 class="entry-title"><a class="link" href="portfolio-item.html">Phasellus rhoncus</a></h3>
                                                    <div class="links_wrapper">
                                                        <a href="#" class="button button_js portfolio_prev_js"><span class="button_icon"><i class="icon-up-open"></i></span></a><a href="#" class="button button_js portfolio_next_js"><span class="button_icon"><i class="icon-down-open"></i></span></a>
                                                        <a
                                                            href="portfolio-item.html" class="button button_left button_theme button_js"><span class="button_icon"><i class="icon-link"></i></span><span class="button_label">Read more</span></a>
                                                    </div>
                                                </div>
                                                <div class="image_frame scale-with-grid">
                                                    <div class="image_wrapper">
                                                        <a href="portfolio-item.html">
                                                            <div class="mask"></div>
                                                            <img src="images/builder2-portfolio-single2-960x720.jpg" class="scale-with-grid wp-post-image" />
                                                        </a>
                                                        <div class="image_links double">
                                                            <a href="images/builder2-portfolio-single2-1200x800.jpg" class="zoom" rel="prettyphoto"><i class="icon-search"></i></a><a href="portfolio-item.html" class="link"><i class="icon-link"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="desc">
                                                    <div class="title_wrapper">
                                                        <h5 class="entry-title"><a class="link" href="portfolio-item.html">Phasellus rhoncus</a></h5>
                                                        <div class="button-love">
                                                            <a href="#" class="mfn-love" data-id="62"><span class="icons-wrapper"><i class="icon-heart-empty-fa"></i><i class="icon-heart-fa"></i></span><span class="label">60</span></a>
                                                        </div>
                                                    </div>
                                                    <div class="desc-wrapper"></div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="portfolio-item isotope-item category-commercial  has-thumbnail">
                                            <div class="portfolio-item-fw-bg">
                                                <div class="portfolio-item-fill"></div>
                                                <div class="list_style_header">
                                                    <h3 class="entry-title"><a class="link" href="portfolio-item.html">Etiam aliquam ante</a></h3>
                                                    <div class="links_wrapper">
                                                        <a href="#" class="button button_js portfolio_prev_js"><span class="button_icon"><i class="icon-up-open"></i></span></a><a href="#" class="button button_js portfolio_next_js"><span class="button_icon"><i class="icon-down-open"></i></span></a>
                                                        <a
                                                            href="portfolio-item.html" class="button button_left button_theme button_js"><span class="button_icon"><i class="icon-link"></i></span><span class="button_label">Read more</span></a>
                                                    </div>
                                                </div>
                                                <div class="image_frame scale-with-grid">
                                                    <div class="image_wrapper">
                                                        <a href="portfolio-item.html">
                                                            <div class="mask"></div>
                                                            <img src="images/builder2-portfolio-single1-960x720.jpg" class="scale-with-grid wp-post-image" />
                                                        </a>
                                                        <div class="image_links double">
                                                            <a href="images/builder2-portfolio-single1-1200x800.jpg" class="zoom" rel="prettyphoto"><i class="icon-search"></i></a><a href="portfolio-item.html" class="link"><i class="icon-link"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="desc">
                                                    <div class="title_wrapper">
                                                        <h5 class="entry-title"><a class="link" href="portfolio-item.html">Etiam aliquam ante</a></h5>
                                                        <div class="button-love">
                                                            <a href="#" class="mfn-love" data-id="58"><span class="icons-wrapper"><i class="icon-heart-empty-fa"></i><i class="icon-heart-fa"></i></span><span class="label">97</span></a>
                                                        </div>
                                                    </div>
                                                    <div class="desc-wrapper"></div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="portfolio-item isotope-item category-appartments  has-thumbnail">
                                            <div class="portfolio-item-fw-bg">
                                                <div class="portfolio-item-fill"></div>
                                                <div class="list_style_header">
                                                    <h3 class="entry-title"><a class="link" href="portfolio-item/portfolio-item.html">Etiam venenatis enim</a></h3>
                                                    <div class="links_wrapper">
                                                        <a href="#" class="button button_js portfolio_prev_js"><span class="button_icon"><i class="icon-up-open"></i></span></a><a href="#" class="button button_js portfolio_next_js"><span class="button_icon"><i class="icon-down-open"></i></span></a>
                                                        <a
                                                            href="portfolio-item/portfolio-item.html" class="button button_left button_theme button_js"><span class="button_icon"><i class="icon-link"></i></span><span class="button_label">Read more</span></a>
                                                    </div>
                                                </div>
                                                <div class="image_frame scale-with-grid">
                                                    <div class="image_wrapper">
                                                        <a href="portfolio-item/portfolio-item.html">
                                                            <div class="mask"></div>
                                                            <img src="images/builder2-portfolio-single4-960x720.jpg" class="scale-with-grid wp-post-image" />
                                                        </a>
                                                        <div class="image_links double">
                                                            <a href="images/builder2-portfolio-single4-1200x800.jpg" class="zoom" rel="prettyphoto"><i class="icon-search"></i></a><a href="portfolio-item/portfolio-item.html" class="link"><i class="icon-link"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="desc">
                                                    <div class="title_wrapper">
                                                        <h5 class="entry-title"><a class="link" href="portfolio-item/portfolio-item.html">Etiam venenatis enim</a></h5>
                                                        <div class="button-love">
                                                            <a href="#" class="mfn-love" data-id="45"><span class="icons-wrapper"><i class="icon-heart-empty-fa"></i><i class="icon-heart-fa"></i></span><span class="label">101</span></a>
                                                        </div>
                                                    </div>
                                                    <div class="desc-wrapper"></div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection