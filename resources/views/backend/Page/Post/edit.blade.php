@extends('backend.layout.layout');
@section('title')
    Quản lý nhóm bài viết
@endsection

@section('content')
 
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title" style="min-height:60px">
                {{ Breadcrumbs::render('post-edit') }}           
                    <h5 style="margin-top: 6px">{{ $filter['update']['title'] }}</h5>

            </div>
            <form action="{{ route('private-system.management.post.update',$post->id) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                @method('PUT')
              <div style="display: flex;justify-content:space-between;width:100%;margin-top:20px">
                  <div class="col-lg-10">
                       <div >
                           <div class="ibox-content">
                                    <div style="margin: 20px 0px;">
                                        <h3 class="text-success">{{ $filter['create']['general-information'] }}</h3>
                                    </div>

                                    <div class="" style="margin-top: 5px">
                                            <div class="form-group">                               
                                                <label class="col-sm-2 control-label">Tiêu đề nhóm bài viết (*)</label>
                                                <div class="col-sm-10">
                                                    <input type="text" value="{{ old('name',$post->name) }}" name="name" class="form-control onchange_title_seo_input">
                                                </div>         
                                            </div>
                                            @if ($errors->has('name'))
                                            <div class="mt-3 text-left text-danger italic" style="position: relative;left:130px">{{ $errors->first('name') }}(*)</div>
                                        @endif
                                    </div>
                                    {{-- @dd($post->post_cataloge->categories->id) --}}
                                    <div class="" style="margin-top: 14px">
                                        <div class="form-group">                               
                                            <label class="col-sm-2 control-label">Mô tả (*)</label>
                                            <div class="col-sm-10">
                                                <textarea data-target="desc" id="desc" name="desc" class="form-control ckEdition">
                                                    {!! old('desc',$post->desc) !!}
                                                </textarea>
                                            </div>         
                                        </div>
                                        @if ($errors->has('desc'))
                                        <div class="mt-3 text-left text-danger italic" style="position: relative;left:130px">{{ $errors->first('desc') }}(*)</div>
                                    @endif
                                </div>
                                <div class="" style="margin-top: 5px">
                                    <div class="form-group">                               
                                        <label class="col-sm-2 control-label">Nội dung (*)</label>
                                        <div class="col-sm-10">
                                            <textarea data-target="content" id="content" name="content" class="form-control ckEdition">
                                                {!! old('content',$post->content) !!}
                                            </textarea>
                                        </div>         
                                    </div>
                                    @if ($errors->has('content'))
                                    <div class="mt-3 text-left text-danger italic" style="position: relative;left:130px">{{ $errors->first('content') }}(*)</div>
                                @endif
                            </div>                     
                           </div>
                        
                       </div>
                       <div>
                           @include('backend.component.album',['data' => $post,'title' => $filter['update']['title'],'name'=>'album'])
                       </div>
                       <div>
                           @include('backend.component.seo',['data' => $post,'title' => $filter['update']['SEO-title']])
                       </div>                 
                   </div>
                   @php
                        $arrayCategories = [];
                        $arrayPush = [];
                        foreach ($post->post_cateloge_post as $key => $value) {
                            $arrayCategories[] =  $value->pivot->post_cateloge_id;
                        };
                        if(!empty($arrayCategories)) {
                            foreach ($arrayCategories as $item) {
                                $arrayPush[]  = \App\Models\PostCataloges::find($item)->id;

                            }
                        }
                   @endphp
                   <div class="col-lg-3">
                    <div style="height: 100%">
                        <div class="ibox-content">
                            <div style="margin: 20px 0px;">
                                <h3 class="text-success">{{ $filter['create']['infomation-contact'] }}</h3>
                            </div>
                            <div class="form-group" style="margin-top: 8px"><label class="control-label">Chọn danh mục cha (*)</label>
                                <div class="">
                                    <select class="form-control select2" name="post_cateloge_id">
                                            <option value="1">Root</option>
                                        @foreach ($categories as $category)
                                            <option {{ old('post_cateloge_id',$post->post_cataloge->id) == $category->id ? 'selected' : '' }}  value="{{ $category->id }}">
                                                {{ str_repeat('|---',($category->depth > 0) ? $category->depth : 0) }}{{ $category->post_cateloges_transltate->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                 @if ($errors->has('post_cateloge_id'))
                                    <div class="mt-3 text-left text-danger italic" style="position: relative;left:130px">{{ $errors->first('post_cateloge_id') }}(*)</div>
                                @endif
                            </div>
                         
                            <div class="form-group" style="margin-top: 8px"><label class="control-label">{{ $filter['create']['category_backup'] }}(*)</label>
                                <div class="">
                                    
                                    <select class="form-control select2" name="categories_sublist[]" multiple="multiple">                                         
                                        @foreach ($categories as $key => $category)
                                            <option 
                                            {{ in_array($category->id,old('categories_sublist',$arrayPush)) == true ? 'selected' : '' }}
                                            value="{{$category->id }}">
                                                {{ str_repeat('|---',($category->depth > 0) ? $category->depth : 0) }}{{ $category->post_cateloges_transltate->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                 @if ($errors->has('categories_sublist'))
                                    <div class="mt-3 text-left text-danger italic" style="position: relative;left:-1px;top:10px;">{{ $errors->first('categories_sublist') }}(*)</div>
                                @endif
                            </div>
                            <div class="form-group" style="margin-top: 40px"><label class="control-label">Hình ảnh nhóm bài viết (*)</label>
                                <div class="ckfinder_2" style="border: 1px solid #ccc;cursor: pointer;" data-type="image">
                                    <input type="text" name="image" hidden value="{{ old('image',$post->image) }}" >
                                    <img class="image_post_cataloge" style="width:100%" src={{ old('image',$post->image) ?? "https://res.cloudinary.com/dcbsaugq3/image/upload/v1710723724/ogyz2vbqsnizetsr3vbm.jpg" }} alt="">
                                </div>
                                @if ($errors->has('image'))
                                    <div class="mt-3 text-left text-danger italic" >{{ $errors->first('image') }}(*)</div>
                                @endif
                               
                            </div>
                        </div>

                        <div class="ibox-content" style="margin-top:30px" >
                            <div style="margin: 20px 0px;">
                                <h3 class="text-success">{{ $filter['create']['infomation-advance'] }}</h3>
                            </div>
                            <div class="form-group" style="margin-top: 8px"><label class="control-label">Chọn tình trạng (*)</label>
                                <div class="">
                                    <select class="form-control select2" name="status">
                                        @foreach ($filter['create']['status'] as $key =>  $status)
                                            <option {{ old('status',$post->status) == $key ? 'selected' : '' }} value="{{ $key }}">{{ $status }}</option>
                                                 
                                         @endforeach                                   
                                    </select>
                                </div>
                                 @if ($errors->has('status'))
                                    <div class="mt-3 text-left text-danger italic">{{ $errors->first('status') }}(*)</div>
                                @endif
                            </div>
                            <div class="form-group" style="margin-top: 8px"><label class="control-label">Chọn mục điều hướng (*)</label>
                                <div class="">
                                    <select class="form-control select2" name="follow">
                                        @foreach ($filter['create']['follow'] as $key =>  $follow)        
                                            <option {{ old('follow',$post->follow) == $key ? 'selected' : '' }}  value="{{ $key }}">{{ $follow }}</option>
                                            @endforeach   
                                    </select>
                                </div>
                                 @if ($errors->has('follow'))
                                    <div class="mt-3 text-left text-danger italic">{{ $errors->first('follow') }}(*)</div>
                                @endif
                            </div>
                        </div>
                    </div>
                     
                   </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                 <div class="col-sm-4 col-sm-offset-2">
                     <button class="btn btn-primary" type="submit">Cập nhật</button>
                 </div>
            </form>
                
            </div>
            
         
        </div>
    </div>
@endsection