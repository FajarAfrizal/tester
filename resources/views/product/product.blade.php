@extends('layouts._main')
@section('content')

    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2>
                            Product
                        </h2>
                        <a href="" class="btn btn-primary mb-4" data-bs-toggle="modal"
                            data-bs-target="#modalCreate">Create</a>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product as $item)
                                    <tr>
                                        <td scope="row"></td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->stock}}</td>
                                        <td>{{$item->price}}</td>
                                        <td>
                                            <div class="d-flex justify-content-start">
                                                <button class="btn btn-success mx-4" data-bs-toggle="modal"
                                                    data-bs-target="#modalStock-{{$item->id}}">
                                                    <i class='bx bx-plus'></i>Tambah Stock
                                                </button>
                                                <button class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#modalEdit-{{$item->id}}">
                                                    <i class='bx bxs-pencil'></i>
                                                </button>
                                                <form action="{{ route('deleteProduct', ['id' => $item->id ])}}" class="px-4" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger"><i
                                                            class='bx bx-trash'></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Modal Edit-->
                                    <div class="modal fade" id="modalEdit-{{$item->id}}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body" style="margin-top: -20px;">
                                                    <form action="{{ route('updateProduct', ['id' => $item->id])}}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="row">
                                                            <div class="row g-3">
                                                                <div class="col">
                                                                    <label class="col-md-12">Nama Produk <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        name="name" aria-label="Name Product"
                                                                        value="{{ $item->name}}">
                                                                </div>
                                                                <div class="col">
                                                                    <label class="col-md-12">Stock Produk <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="number" class="form-control"
                                                                        name="stock" value="{{$item->stock}}" aria-label="stock"
                                                                        disabled>
                                                                </div>
                                                            </div>
                                                            <div class="row g-3">
                                                                <div class="col">
                                                                    <label class="col-md-12">Price Produk <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        name="price" id="" value="{{$item->price}}"
                                                                        aria-label="price">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer"
                                                            style="margin-bottom: -30px; margin-top:20px;">
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Stock-->
                                    <div class="modal fade" id="modalStock-{{$item->id}}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Stock</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body" style="margin-top: -20px;">
                                                    <form action="{{ route('updateStockProduct', ['id' => $item->id])}}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="row">
                                                            <div class="row g-3">
                                                                <div class="col">
                                                                    <label class="col-md-12">Nama Produk <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        name="name" aria-label="Name Product"
                                                                        value="{{$item->name}}" disabled>
                                                                </div>
                                                                <div class="col">
                                                                    <label class="col-md-12">Stock Produk <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="number" class="form-control"
                                                                        name="stock" aria-label="stock">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer"
                                                            style="margin-bottom: -30px; margin-top:20px;">
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- Modal Create-->
                    <div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Create Product</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="margin-top: -20px;">
                                    <form action="{{ route('addProduct') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="row g-3">
                                                <div class="col">
                                                    <input type="text" class="form-control" name="name"
                                                        placeholder="Name Product" aria-label="Name Product">
                                                </div>
                                                <div class="col">
                                                    <input type="number" class="form-control" name="stock"
                                                        placeholder="stock" aria-label="stock">
                                                </div>
                                            </div>
                                            <div class="row g-3">
                                                <div class="col">
                                                    <input type="text" class="form-control" id="rupiah2"
                                                        name="price" placeholder="price" aria-label="price">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer" style="margin-bottom: -30px; margin-top:20px;">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
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

@endsection
