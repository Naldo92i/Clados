@extends('layouts.app')

@section('content')
    <div class="banner-carousel banner-carousel-1 mb-0">
        @foreach($sliders as $item)
            <div class="banner-carousel banner-carousel-2 mb-0">
                <div class="banner-carousel-item" style="background-image:url({{asset('custom/sliders/'.$item->image)}})">
                    <div class="container">
                        <div class="box-slider-content">
                            <div class="box-slider-text">
                                <h3 class="box-slide-sub-title">{{$item->title2}}</h3>
                                <h2 class="box-slide-title">{{$item->title1}}</h2>
                                <p>
                                    <a href="{{$item->url}}" target="_blank" class="slider btn btn-primary">Plus de details</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <section class="call-to-action-box no-padding">
        <div class="container">
            <div class="action-style-box">
                <div class="row align-items-center">
                    <div class="col-md-8 text-center text-md-left">
                        <div class="call-to-action-text">
                            <h3 class="action-title">ESTA, UNE CULTURE DU NUMERIQUE !</h3>
                        </div>
                    </div><!-- Col end -->
                    <div class="col-md-4 text-center text-md-right mt-3 mt-md-0">
                        <div class="call-to-action-btn">
                            <a class="btn btn-dark" href="{{route('admission')}}">Rejoindre ESTA</a>
                        </div>
                    </div><!-- col end -->
                </div><!-- row end -->
            </div><!-- Action style box -->
        </div><!-- Container end -->
    </section>

    <section id="ts-features" class="ts-features">
        <div class="container">

            <div class="row mb-5">
                <div class="col-lg-6">
                    <h3 class="column-title">{{ $about->title }}</h3>
                    <p>{!! (strlen($about->content) > 1947) ? substr($about->content,0,1947).'...' : $about->content  !!}
                        <a style="color: orange" href="">Lire la suite</a>
                    </p>

                </div>

                <div class="col-lg-6 mt-5 mt-lg-0">

                </div><!-- Col end -->
            </div>
        </div>
    </section>

    <section id="ts-features" class="project-area solid-bg">
        <div class="container">
            <div class="row">
            <div class="col-lg-12 order-1 order-lg-0">

                <div class="sidebar sidebar-left">
                    <div class="widget recent-posts">
                        <h3 class="widget-title">
                            <header class="frame-header">
                                <div class="city_about_list">
                                    <div class="section_heading"><span>Actualités récentes sur</span>
                                    </div>
                                </div>
                                <div class="city_about_list">
                                    <div class="section_heading"><h2>ESTA</h2>
                                    </div>
                                </div>
                            </header>
                        </h3>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">

                                    @foreach ($news as $new)
                                        <div class="col-lg-4 col-sm-6 mb-5">
                                            <div class="ts-team-wrapper">
                                                <div class="team-img-wrapper" style="height: 150px">
                                                    <img style="width: auto; height: 163px" loading="lazy" src="{{ asset('custom/actuality/'.$new->file) }}" class="img-fluid" alt="team-img">
                                                </div>
                                                <div class="ts-team-content-classic">
                                                    <h3 class="ts-name">{{ $new->title }}</h3>
                                                    <p class="ts-designation">Publié le {{ date('d/m/Y', strtotime($new->created_at)) }}</p>
                                                    <p class="ts-description" style="max-block-size: 60px">{{ (strlen($new->content) > 40) ? substr($new->content,0,40).'...' : $new->content }}</p>
                                                </div>
                                            </div>
                                            <div>
                                                <a href="{{ route('news') }}" class="btn btn-primary" target="_blank" rel="noopener noreferrer">Voir plus</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="col-sm-12 mb-5" >
                                    <div class="sidebar sidebar-right">
                                        <div class="widget recent-posts">
                                            <h3 class="widget-title">Newsletter</h3>

                                            <div class="city_news_feild">
                                                <h4>Inscription</h4>
                                                <p>Rester informer sur ESTA</p>
                                                <form name="log" action="" method="post">

                                                    <div class="city_news_search">
                                                        <input placeholder="Votre Adresse Email ici" class="form-control" type="text" name="tx_fpnewsletter_pi1[log][email]" value="" required="required">
                                                        <br>
                                                        <input class="btn btn-primary border-color color" type="submit" value="Inscription">
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
        </div>
    </section>


    <section id="ts-features" >
        <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-4 mt-lg-0">
                <h3 class="into-sub-title"><i class="fa fa-cube"></i> Nos formations</h3>
                <p>L'ESTA propose trois types de formations : la formation initiale, la formation continue qualifiante et la formation diplômante. </p>

                <div class="accordion accordion-group" id="our-values-accordion">
                    <div class="row">
                        @foreach(\App\Models\Formation::all() as $item)
                            <div class="col-md-6">
                            <div class="card">
                                <div class="card-header p-0 bg-transparent" id="headingTwo">
                                    <h2 class="mb-0">
                                        <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#{{$item->uniq_name}}" aria-expanded="false" aria-controls="collapseTwo">
                                            {{$item->name}}
                                        </button>
                                    </h2>
                                </div>
                                <div id="{{$item->uniq_name}}" class="collapse" aria-labelledby="headingTwo" data-parent="#our-values-accordion">
                                    <div class="card-body">
                                        {{$item->description}}<br>
                                        <a href="{{ route('formation.show', $item->uniq_name) }}" style="color: orange" class="btn-link font-weight-bolder"><u>Voir plus</u></a>
                                    </div>
                                </div>
                            </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
        </div>
    </section>


@include('layouts.blocks.facts-counter')

    <section id="ts-team" class="ts-team">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-12">
                    <h3 class="section-sub-title">Nos partenaires</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="row all-clients">
                        @foreach($partners as $item)
                        <div class="col-sm-3 col-6">
                            <figure class="clients-logo">
                                <a title="{{$item->name}}" href="{{$item->url}}" target="_blank"><img loading="lazy" class="img-fluid" src="{{ asset('custom/partners/'.$item->image) }}" alt="clients-logo" /></a>
                            </figure>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

@include('layouts.blocks.testomonial-n-clients')


@endsection
