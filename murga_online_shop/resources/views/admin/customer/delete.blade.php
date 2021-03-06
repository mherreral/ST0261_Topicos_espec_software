@extends('layouts.admin')
@section('title', $viewData['title'])
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $viewData['title'] }}</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <ul id="errors" class="alert alert-danger list-unstyled">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <form method="POST" action="{{ route('admin.customer.save') }}">
                            @csrf
                            <select name="deleteId">
                                @foreach ($viewData['customers'] as $customer)
                                    <option value={{ $customer->getId() }}>{{ $customer->getId() }}.
                                        {{ $customer->getName() }}</option>
                                @endforeach
                            </select>
                            <input type="submit" class="btn btn-primary" value="Delete" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
