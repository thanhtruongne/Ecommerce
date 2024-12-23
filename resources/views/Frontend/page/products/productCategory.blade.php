@extends('Frontend.layout.layout')
@section('title')
   Laptop
@endsection

@section('content')
@php
    $breadcum = [
        [
            'name' => 'Quản lý sản phâm',
            'url' => ''
        ],
        [
            'name' => 'Danh mục sản phẩm',
            'url' => ''
        ],
    ];
@endphp
    <div class="container">
        <div class="w-100">
            <div class="breadcrumbs css-seb2g4">
                @include('Frontend.component.breadcrumbs',$breadcum)
            </div>
            <div class="css-rf24tk" style="padding:0px">
                <div class="teko-row css-ezmamy" style="margin-left: -8px;margin-right: -8px;row-gap: 16px;">
                    {{-- sidebar --}}
                    @include('Frontend.page.products.components.sidebar',['filters' => $filters])

                    <div class="teko-col teko-col-10 css-17ajfcv" style="padding: 0 8px"> 
                        <div class="css-1of9xbq">
                            <div class="teko-row justify-content-start css-iv0lz5">
                                <h1 class="7nrxrf"> {{ ucfirst($productCategory->name) }}</h1> 
                                <div class="css-18xfrv">(200 sản phẩm)</div>
                            </div>

                            {{-- brand --}}
                            <div class="css-mhnea9">
                                @if (isset($childCatehgory) && !empty($childCatehgory))
                                    @foreach ($childCatehgory as $descentan)
                                        <a href="#" data-id="{{ $descentan->id }}" class="css-1h3fn00">
                                            <button class="css-uros0k">
                                                <div class="w-100 h-100">
                                                    <img class="w-100 h-100 object-fit-contain" src="{{$descentan->icon}}" alt="">
                                                </div>
                                            </button>
                                        </a>
                                    @endforeach
                                @endif
                               
                            </div>

                            {{-- nhu cầu --}}
                            {{-- <div class="" style="border-style: none;border-width: 1px;border-color: unset;opacity: 1;margin-top: 0.75rem;margin-bottom: 0.25rem">
                                <h2 class="css-1xw9vei">Chọn theo nhu cầu</h2>
                                <div class="css-9hrw0v" style="overflow: hidden"> 
                                    <a href="" class="css-1h3fn00">
                                        <div class="css-1kkr1rl">
                                        
                                            <div class="" style="position: relative;display: inline-block;overflow: hidden;height: 90px;width: 90px;">
                                                <img class="w-100 object-fit-contain" height="90"  src="https://lh3.googleusercontent.com/qB66Bo3zMseXCcuk_VTXoLuj4J7a-hBm5G0sa5cgHWnsPb3SnZdNxadBlQhHum8fl9fFHh82BDbh6yt254908rZr30Metr1t=rw" alt="">
                                            </div>
                                            <div class="d-flex justify-content-center align-items-center">
                                                <div class="css-1fvto6t">Laptop AI</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div> --}}
                        </div>

                        <div class="css-qc5ueq w-100">
                            {{-- sort --}}
                             @include('Frontend.page.products.components.sort')
                             {{-- products --}}
                             @include('Frontend.page.products.components.products')
                        </div>
                    </div>

                    {{-- desc sluig --}}
                </div>
            </div>
            <div class="w-100">
                 {{-- @include('Frontend.page.products.components.descSlug',['desc' => $productCategory->description]) --}}
            </div>
        </div>
    </div>


@push('scripts')
   <script>
        //gọi data khi click vào data
        renderProductCategoryFirstTime();
   </script>
   
@endpush

@endsection