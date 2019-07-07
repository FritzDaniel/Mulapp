<!-- Blog -->
<section class="blog bgwhite p-t-94 p-b-65">
    <div class="container">
        <div class="sec-title p-b-52">
            <h3 class="m-text5 t-center">
                Articles
            </h3>
        </div>

        <div class="row">

            @foreach($data_articles as $dataArticle)

                <div class="col-sm-10 col-md-4 p-b-30 m-l-r-auto">
                    <!-- Block3 -->
                    <div class="block3">
                        <a href="#" class="block3-img dis-block hov-img-zoom">
                            <img src="{{ asset('assets/uploads/thumbnail/'.$dataArticle->thumbnail ) }}" alt="IMG-BLOG" height="300" width="250">
                        </a>

                        <div class="block3-txt p-t-14">
                            <h4 class="p-b-7">
                                <a href="#" class="m-text11">
                                    {{ substr($dataArticle->title,0,40) }}
                                </a>
                            </h4>

                            <span class="s-text6">By</span> <span class="s-text7">{{ $dataArticle->user->name }}</span>
                            <span class="s-text6">on</span> <span class="s-text7">{{ \Carbon\Carbon::parse($dataArticle->created_at)->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>

            @endforeach

        </div>
    </div>
</section>