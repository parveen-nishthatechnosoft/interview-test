@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">


        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Product Information') }}</div>

                <div class="card-body">

                    <form action="" id="productForm" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" class="form-control" name="productName" placeholder="Product Name" value="{{$productInfo->name??''}}" />
                        </div>
                        <div class="form-group">
                            <label>Product Image</label>
                            <input type="file" class="form-control" name="product_image" />
                            @if(!empty($productInfo))
                            <img src="{{url('images/'.$productInfo->image)}}" />
                            @endif


                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" name="category">
                                @foreach($categoryData as $k => $v)
                                <option value="{{$v->id}}" <?php echo !empty($productInfo)&&$productInfo->category_id== $v->id?'selected="selected"':'';?>>{{$v->name}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Stock</label>
                            <select class="form-control" name="stock">
                                @foreach($stockData as $k => $v)
                                <option value="{{$v->id}}" <?php echo !empty($productInfo)&&$productInfo->stock_id== $v->id?'selected="selected"':'';?>>{{$v->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Product Price</label>
                            <input type="text" class="form-control" name="product_price" value="{{$productInfo->price??''}}" />
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="active" <?php echo !empty($productInfo)&&$productInfo->status=='active'?'selected="selected"':'';?>>Active</option>
                                <option value="inactive" <?php echo !empty($productInfo)&&$productInfo->status=='inactive'?'selected="selected"':'';?>>Inactive</option>

                            </select>
                        </div>

                        <div class="form-group">

                            <input type="submit" class="btn btn-primary" value="Save" />
                            <a href="{{url('product-list')}}" class="btn btn-warning">Cancel</a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
    @endsection
