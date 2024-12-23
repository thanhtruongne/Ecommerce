@extends('backend.layout.layout');
@section('title')
    Quản lý Promotion
@endsection
@section('content')
   
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title" style="min-height:60px">
                {{ Breadcrumbs::render('promotion-create') }}              
            </div>       
            <form action="{{ route('private-system.management.promotion.store') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                <div>
                    <div class="row" style="width:100%;margin-top:20px">  
                            @if ($errors->any())
                                <div class="alert alert-danger" style="margin: 0 -15px 0 15px">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                    </div>                         
                </div>            
                <div class="" style="margin: 0">
                    <div class="row">                       
                            <div class="col-lg-8">
                                <div>
                                    <div class="ibox-title" style="min-height:60px">                          
                                        Thông tin chung
                                    </div>  
                                    <div class="ibox-content">
                                        <div class="" style="display: flex;justify-content:space-between">
                                            <div class="form-group col-lg-5">                               
                                                <label class="control-label" style="margin-bottom:10px">Tên chương trình (*)</label>
                                                <div class="">
                                                   <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                                </div>           
                                            </div>
                                            <div class="form-group col-lg-5">                               
                                                <label class="control-label" style="margin-bottom:10px">Mã khuyến mãi (*)</label>
                                                <div class="">
                                                   <input type="text"  name="code" value="{{ old('code') }}" class="form-control">
                                                </div>           
                                            </div>
                                        </div>
                                        <div class="form-group" style="padding: 0 15px">                               
                                            <label class="control-label" style="margin-bottom:10px">Mô tả khuyến mãi (*)</label>
                                            <div class="">
                                              <textarea name="desc" id="" cols="30" class="form-control" rows="10" style="width:100%">
                                                 {!! old('desc') !!}
                                              </textarea>
                                            </div>           
                                        </div>
                                    </div>
                                </div>
                                <div style="margin: 20px 0">
                                    <div class="ibox-title" style="min-height:60px">                          
                                        Chi tiết thông tin khuyến mãi
                                    </div>                          
                                    @php
                                        $promotion_product = __('model.promotion_product');
                                             
                                    @endphp
                                    <div class="ibox-content">
                                        <div class="form-group" style="padding: 0 15px">                               
                                            <label class="control-label" style="margin-bottom:10px">Chọn hình thức khuyến mãi (*)</label>
                                            <select data-product="{{ json_encode($promotion_product) }}" name="promotionMethod" class="form-control method_select_promotion" id="">
                                                <option value="">Chọn hình thức khuyến mãi</option>
                                                @foreach (__('model.promotion') as $key =>  $promotion)
                                                    <option 
                                                    
                                                    value="{{ $key }}">{{ $promotion }}</option>
                                                @endforeach
                                            </select>          
                                        </div>
                                        <div class="render_here_method">
                                           {{-- render  --}}
                                           <div class="promotion_container hidden">
                                                <div class="choose_version_product">
                                                    <select name="discountMethodProduct" class="form-control select2 choose_product_promo" id="">
                                                        <option value="">Chọn sản phẩm khuyến mãi</option>
                                                        @foreach ($promotion_product as $key =>  $product_promotion)
                                                            <option value="{{ $key }}">{{ $product_promotion }}</option>
                                                        @endforeach
                                                    </select>   
                                                </div>
                                                <div  style="margin-top:20px ">
                                                  
                                                </div>
                                           </div>
                                           
                                        </div>
                                      
                                    </div>
                                </div>
                            </div>
                         
                            <div class="col-lg-4">
                                <div>
                                    <div class="ibox-title" style="min-height:60px">                          
                                       Thời gian thiết lập
                                    </div>                        
                                    <div class="ibox-content">
                                        <div class="" style="margin-top: 8px">
                                            <label class="control-label"  style="margin-bottom:8px">Thời gian bắt đầu</label>
                                            <div class="">
                                                <input type="text"  value="{{ old('startDate') }}" name="startDate" class="form-control datepicker">
                                            </div>
                                           
                                        </div>
                                        <div class="" style="margin-top: 8px">
                                            <label class="control-label"  style="margin-bottom:8px">Thời gian kết thúc (*)</label>
                                            <div class="">
                                                <input type="text" value="{{ old('endDate') }}"  name="endDate" class="form-control datepicker">
                                            </div>
                                         
                                        </div>

                                        <div class="" style="margin-top: 16px">
                                            <input type="checkbox" 
                                                {{ old('neverEndDate') == 'choose' ? 'checked' : '' }}
                                                value="choose" 
                                                class="no_date_promotion" id="no_date_promotion" name="neverEndDate">  
                                            <label 
                                            for="no_date_promotion"
                                                style="position: relative; top: -2px;" 
                                                class="control-label">
                                                Không có mốc thời gian kết thúc(*)
                                           </label>                         
                                        </div>
                                    </div>
                                </div>
                                {{-- <div style="margin: 20px 0">
                                    <div class="ibox-title" style="min-height:60px">                          
                                        Nguôn khách áp dụng
                                    </div>                        
                                    <div class="ibox-content">
                                        <div class="" style="margin-top: 8px">
                                            <input type="radio" 
                                                {{ old('apply') == 'apply_all' ? 'checked' : '' }}
                                                id="all" value="apply_all" data-id="choose_apply_all"
                                                class="choose_apply_source" 
                                                name="apply">
                                            <label for="all" class="control-label" style="margin-bottom:8px;position:relative;top:-2px">
                                              Áp dụng cho nguồn khách  (*)
                                            </label>    
                                        </div>
                                        <div class="" style="margin-top: 8px">
                                            <input type="radio" 
                                                {{ old('apply') == 'apply' ? 'checked' : '' }} 
                                                data-model="Source" 
                                                id="choose" 
                                                value="apply"
                                                data-id="choose_apply"  
                                                class="choose_apply_source" 
                                                name="apply">
                                            <label for="choose" class="control-label" style="margin-bottom:8px;position:relative;top:-2px">
                                               Chọn nguồn khách áp dụng (*)
                                            </label>    
                                        </div>
                                        <div 
                                        class="form-group choose_customer_hidden_change
                                         {{ !empty(old('apply')) && old('apply') == 'apply' ? '' : 'hidden' }}" 
                                         style="margin-top: 8px;padding: 0 15px" >
                                            @if (!empty(old('apply')) && old('apply') == 'apply')
                                               <select name="applyValue[]" id="" class="select2 form-control" multiple="multiple">
                                                    @foreach ($source as $key =>  $item)
                                                        <option 
                                                            data-model="{{ $item->name }}"  
                                                            {{ in_array($item->id,old('applyValue') ?? []) == true ? 'selected' : '' }}
                                                            value="{{ $item->id }}">
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                               </select>
                                            @endif
                                        </div>
                                    </div>
                                </div> --}}

                                {{-- <div style="margin: 20px 0">
                                    <div class="ibox-title" style="min-height:60px">                          
                                        Đối tượng áp dụng
                                    </div>                        
                                    <div class="ibox-content">
                                        <div class="" style="margin-top: 8px">
                                            <input 
                                                    type="radio" 
                                                    id="all_customer" 
                                                    {{ old('Customer') == 'Customer_all' ? 'checked' : '' }}
                                                    data-id="all_customer"  
                                                    value="Customer_all" 
                                                    class="customer" 
                                                    name="Customer">
                                            <label for="all_customer" class="control-label" style="margin-bottom:8px;position:relative;top:-2px">
                                              Áp dụng cho tất cả khách hàng  (*)
                                            </label>    
                                        </div>
                                        <div class="" style="margin-top: 8px">
                                                <input  type="radio" 
                                                        data-model="CustomerCateloge" 
                                                        {{ old('Customer') == 'Customer' ? 'checked' : '' }}
                                                        id="choose_customer" 
                                                        value="Customer" data-id="customer" 
                                                        class="customer" name="Customer">
                                                <label for="choose_customer" class="control-label" style="margin-bottom:8px;position:relative;top:-2px">
                                                    Chọn nguồn khách hàng (*)
                                                </label>    
                                        </div>
                                        <div class="form-group render_this_select2 {{ old('Customer') == 'Customer' ? '' : 'hidden' }}" style="margin-top: 8px;padding: 0 15px" >
                                                <select name="CustomerValue[]" id="" multiple="multiple" class="select2 form-control onchange_delicate_this">
                                                      @foreach (__('model.CustomerCateloge') as $index => $customerCateloge)
                                                        <option 
                                                            data-model="{{ $customerCateloge['name'] }}"
                                                            {{ in_array($customerCateloge['id'],old('CustomerValue') ?? []) == true ? 'selected' : '' }}
                                                            value="{{ $customerCateloge['id'] }}">{{ $customerCateloge['name'] }}
                                                        </option>
                                                      @endforeach
                                                </select>
                                        </div>
                                        <div class="render_attrbute_promotion">
                                           
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                                
                    </div>
                </div>  
               
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                     <div class="col-sm-4 col-sm-offset-2">
                         <button type="submit" class="btn btn-primary" type="submit">Tạo mới</button>
                     </div>
                    </div>
                </form>
                    {{-- Phân loại tìm kiếm sản phẩm --}}
                    <input type="hidden" name="input_product_and_quanity" value="{{ json_encode(__('model.promotion_product')) }}">
                    {{-- Khai báo phần CustomerValue --}}
                    <input type="hidden" name="ConditionItemSelected" value="{{ json_encode(old('CustomerValue'))}}">
                    @if (!empty(old('CustomerValue'))) {
                        @foreach (old('CustomerValue') as $item)
                            <input type="hidden" name="condition_input_{{ $item }}" value="{{ json_encode( old($item)) }}">
                        @endforeach
                    }               
                    @endif
                    {{-- preload_amount_method --}}
                    <input type="hidden" name="preload_promotionMethod" value="{{ old('promotionMethod') }}">
                    {{-- Choose discount_for_single_product --}}
                    <input type="hidden" name="product_and_quanity" value="{{ old('discountMethodProduct') }}">

                    {{-- promotion_order_amount_range --}}
                    <input type="hidden" name="order_range_promotion_detail" value="{{ json_encode(old('promotion_order')) }}">
                   
    </div>
    @include('backend.Page.sale.promotion.component.modal');
@endsection
