<script src="{{asset('js')}}/jquery-3.4.1.min.js"></script>
<script src="{{asset('js')}}/bootstrap.bundle.min.js"></script>
<script src="{{asset('js')}}/script.js"></script>

<script src="{{ asset('js/app.js')}}"></script>

@stack('js')

<script>
    {{--$(document).ready(function (){--}}
    {{--    $(document).on('submit','.formSearch',function (e){--}}
    {{--        e.preventDefault()--}}

    {{--        var ih = $('#searchInput').val();--}}

    {{--        $.ajaxSetup({--}}
    {{--            headers: {--}}
    {{--                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
    {{--            }--}}
    {{--        });--}}

    {{--        $.ajax({--}}
    {{--            type: "post",--}}
    {{--            url: "{{route('ajax.search')}}",--}}
    {{--            data: {"ih":ih},--}}
    {{--            success: function (data) {--}}


    {{--                $('#navbar_main').addClass('showCanvas');--}}

    {{--                console.log(data['data'][0])--}}

    {{--                if (data['message'] === 'ok')--}}
    {{--                {--}}

    {{--                    /*  slider  */--}}
    {{--                    slider(data);--}}
    {{--                    slider_carousel(data)--}}

    {{--                    $('.ihNumber').html(`--}}
    {{--                            <p>`+ data['data'][0].ih +` <span class=" ml-1"><img src="images/ih-check.png" alt='Accurate address'> (95%)</span></p>--}}
    {{--                        `);--}}

    {{--                    $('#get-address').html('appartment : '+ data['data'][0].full_address)--}}

    {{--                    $('#landmark').html(data['data'][0].landmark)--}}
    {{--                }--}}
    {{--                /*if (data["data"]["type"] == 'success') {--}}
    {{--                    toastr.success(data["data"]["message"])--}}
    {{--                } else {--}}
    {{--                    toastr.error(data["data"]["message"])--}}
    {{--                }*/--}}
    {{--            },--}}
    {{--            error: function (data) {--}}
    {{--                console.log(data)--}}
    {{--            }--}}
    {{--        });--}}

    {{--        function slider_carousel(data)--}}
    {{--        {--}}

    {{--            var elements = `--}}
    {{--                            <img data-target="#carouselExampleIndicators" data-slide-to="0" class="active" src="`+ data['data'][0].image1 +`" alt="first slide">--}}
    {{--                        `;--}}
    {{--            if(data['data'][0].image2) {--}}
    {{--                elements += `--}}
    {{--                                <img data-target="#carouselExampleIndicators" data-slide-to="1" width="30" src="`+ data['data'][0].image2 +`"--}}
    {{--                                 alt="second slide">--}}
    {{--                            `;--}}
    {{--            }--}}
    {{--            if(data['data'][0].image3) {--}}
    {{--                elements += `--}}
    {{--                                <img data-target="#carouselExampleIndicators" data-slide-to="2" width="30" src="`+ data['data'][0].image3 +`"--}}
    {{--                                 alt="second slide">--}}
    {{--                            `;--}}
    {{--            }--}}
    {{--            if(data['data'][0].image4) {--}}
    {{--                elements += `--}}
    {{--                                <img data-target="#carouselExampleIndicators" data-slide-to="3" width="30" src="`+ data['data'][0].image4 +`"--}}
    {{--                                 alt="second slide">--}}
    {{--                            `;--}}
    {{--            }--}}
    {{--            $('#slider-carousel').html(elements);--}}
    {{--        }--}}

    {{--        function slider(data)--}}
    {{--        {--}}
    {{--            var elements = `--}}
    {{--                            <div class="carousel-item active">--}}
    {{--                                <img class="d-block w-100" src="`+ data['data'][0].image1 +`" alt="First slide">--}}
    {{--                            </div>--}}
    {{--                        `;--}}
    {{--            if(data['data'][0].image2) {--}}
    {{--                elements += `--}}
    {{--                                <div class="carousel-item">--}}
    {{--                                    <img class="d-block w-100" src="`+ data['data'][0].image2 +`" alt="Second slide">--}}
    {{--                                </div>--}}
    {{--                            `;--}}
    {{--            }--}}
    {{--            if(data['data'][0].image3) {--}}
    {{--                elements += `--}}
    {{--                                <div class="carousel-item">--}}
    {{--                                    <img class="d-block w-100" src="`+ data['data'][0].image3 +`" alt="Third slide">--}}
    {{--                                </div>--}}
    {{--                            `;--}}
    {{--            }--}}
    {{--            if(data['data'][0].image4) {--}}
    {{--                elements += `--}}
    {{--                                <div class="carousel-item">--}}
    {{--                                    <img class="d-block w-100" src="`+ data['data'][0].image4 +`" alt="forth slide">--}}
    {{--                                </div>--}}
    {{--                            `;--}}
    {{--            }--}}

    {{--            $('#slider').html(elements);--}}
    {{--        }--}}
    {{--    });--}}
    {{--});--}}
</script>
