<!-- Blog -->
<section class="blog bgwhite p-t-94 p-b-65">
    <div class="container">
        <div class="sec-title p-b-52">
            <h3 class="m-text5 t-center">
                Discussion
            </h3>
        </div>

        <div class="row">

            @foreach($data_discussions as $dataDiscussion)

            <div class="col-sm-10 col-md-4 p-b-30 m-l-r-auto">
                <!-- Block3 -->
                <div class="block3">

                    <div class="block3-txt p-t-14">
                        <h4 class="p-b-7">
                            <a href="#" class="m-text11">
                                {{ $dataDiscussion->title }}
                            </a>
                        </h4>

                        <span class="s-text6">By</span> <span class="s-text7">{{ $dataDiscussion->user->name }}</span>
                        <span class="s-text6">on</span> <span class="s-text7">{{ \Carbon\Carbon::parse($dataDiscussion->created_at)->format('M d, Y') }}</span>

                        <p class="s-text8 p-t-16">

                        </p>
                    </div>
                </div>
            </div>

            @endforeach

        </div>
    </div>
</section>