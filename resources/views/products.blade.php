@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Products') }}</div>

                <div class="card-body">
                    <a href="{{url('manage-product')}}" class="btn btn-secondary">Add Product</a>
                </div>

            </div>
        </div>


        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Product List') }}</div>

                <div class="card-body">
                    <form action="">

                        <select name="category">
                            @foreach($categoryData as $k=>$v)
                            <option value="{{$v->id}}" <?php echo $categoryFilter==$v->id?'selected="selected"':'';?>>{{$v->name}}</option>
                            @endforeach
                        </select>

                        <input type="text" name="min_price" placeholder="Add Minimum range price" />
                        <input type="text" name="max_price" placeholder="Add Maximum range price" />
                        <input type="submit" value="search" />

                    </form>

                    <table class="table table-striped">
                        <thead>
                            <th> Sr.No.</th>
                            <th> Name</th>
                            <th> Price</th>
                            <th> Category</th>
                            <th> Stock Available</th>
                            <th>Status</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </thead>

                        <tbody>
                            @foreach($products as $key=> $product)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->categoryName}}</td>
                                <td>{{$product->StockName}}</td>
                                <td>{{$product->status}}</td>
                                <td>{{$product->created_at}}</td>
                                <td>
                                    <a href="{{url('manage-product/'.base64_encode($product->id))}}" class="btn btn-primary">Edit</a>
                                    &nbsp;
                                    <a href="{{url('delete-product/'.base64_encode($product->id))}}" class="btn btn-danger">Delete</a>
                                </td>

                            </tr>
                            @endforeach


                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
    @endsection
