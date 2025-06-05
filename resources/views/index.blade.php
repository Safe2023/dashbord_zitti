<!-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection -->

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- All Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="">
    <meta name="keywords" content="admin dashboard, admin template, administration, analytics, bootstrap, cafe admin, elegant, food, health, kitchen, modern, responsive admin dashboard, restaurant dashboard">
    <meta name="description" content="Discover Davur - the ultimate admin dashboard and Bootstrap 5 template. Specially designed for professionals, and for business. Davur provides advanced features and an easy-to-use interface for creating a top-quality website with frontend">
    <meta property="og:title" content="Davur : Restaurant Admin Dashboard + FrontEnd">
    <meta property="og:description" content="Discover Davur - the ultimate admin dashboard and Bootstrap 5 template. Specially designed for professionals, and for business. Davur provides advanced features and an easy-to-use interface for creating a top-quality website with frontend">
    <meta property="og:image" content="social-image.png">
    <meta name="format-detection" content="telephone=no">

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    <title>Davur : Restaurant Admin Dashboard + FrontEnd</title>

    <!-- Favicon icon -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="vendor/chartist/css/chartist.min.css">
    <link href="../../cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>

    <div class="content-body">
        <div class="container-fluid">
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="page-titles">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0)">CMS</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="javascript:void(0)">Blog</a>
                            </li>
                        </ol>
                    </div>
                    <div class="filter cm-content-box box-primary">
                        <div class="content-title">
                            <div class="cpa">
                                <i class="fa-solid fa-filter me-2"></i>Filter
                            </div>
                            <div class="tools">
                                <a
                                    href="javascript:void(0);"
                                    class="expand SlideToolHeader"><i class="fal fa-angle-down"></i></a>
                            </div>
                        </div>
                        <div class="cm-content-body form excerpt">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-3 col-sm-6">
                                        <input
                                            type="text"
                                            class="form-control mb-3 mb-xl-0"
                                            id="exampleFormControlInput1"
                                            placeholder="Title" />
                                    </div>
                                    <div
                                        class="col-xl-3 col-sm-6 mb-3 mb-xl-0">
                                        <select
                                            class="default-select dashboard-select-2 wide w-100">
                                            <option selected>
                                                Select Status
                                            </option>
                                            <option value="1">
                                                Published
                                            </option>
                                            <option value="2">
                                                Draft
                                            </option>
                                            <option value="3">
                                                Trash
                                            </option>
                                            <option value="4">
                                                Private
                                            </option>
                                            <option value="5">
                                                Pending
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-xl-3 col-sm-6">
                                        <input
                                            id="datepicker"
                                            class="form-control mb-3 mb-xl-0" />
                                    </div>
                                    <div class="col-xl-3 col-sm-6">
                                        <button
                                            class="btn btn-primary"
                                            title="Click here to Search"
                                            type="button">
                                            <i
                                                class="fa fa-search me-1"></i>Filter
                                        </button>
                                        <button
                                            class="btn btn-danger light"
                                            title="Click here to remove filter"
                                            type="button">
                                            Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <ul class="d-flex align-items-center flex-wrap">
                            <li>
                                <a
                                    href="add-blog.html"
                                    class="btn btn-primary">Add Blog</a>
                            </li>
                            <li>
                                <a
                                    href="blog-category.html"
                                    class="btn btn-primary mx-1">Blog Category</a>
                            </li>
                            <li>
                                <a
                                    href="blog-category.html"
                                    class="btn btn-primary mt-sm-0 mt-1">Add Blog Category</a>
                            </li>
                        </ul>
                    </div>
                    <div class="filter cm-content-box box-primary">
                        <div class="content-title">
                            <div class="cpa">
                                <i
                                    class="fa-solid fa-file-lines me-1"></i>Blogs List
                            </div>
                            <div class="tools">
                                <a
                                    href="javascript:void(0);"
                                    class="expand SlideToolHeader"><i class="fal fa-angle-down"></i></a>
                            </div>
                        </div>
                        <div class="cm-content-body form excerpt">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table
                                        class="table table-responsive-sm mb-0">
                                        <thead>
                                            <tr>
                                                <th style="">
                                                    <div
                                                        class="form-check">
                                                        <input
                                                            class="form-check-input"
                                                            type="checkbox"
                                                            value=""
                                                            id="checkAll" />
                                                        <label
                                                            class="form-check-label"
                                                            for="checkAll">
                                                        </label>
                                                    </div>
                                                </th>
                                                <th>
                                                    <strong>S.No</strong>
                                                </th>
                                                <th>
                                                    <strong>Title</strong>
                                                </th>
                                                <th>
                                                    <strong>Modified</strong>
                                                </th>
                                                <th>
                                                    <strong>Status</strong>
                                                </th>
                                                <th style="width: 85px">
                                                    <strong>Actions</strong>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div
                                                        class="form-check">
                                                        <input
                                                            class="form-check-input"
                                                            type="checkbox"
                                                            value=""
                                                            id="flexCheckDefault-1" />
                                                        <label
                                                            class="form-check-label"
                                                            for="flexCheckDefault-1">
                                                        </label>
                                                    </div>
                                                </td>
                                                <td><b>1</b></td>
                                                <td>
                                                    How To Teach Fitness
                                                    Like A Pro.
                                                </td>
                                                <td>01 August 2023</td>
                                                <td
                                                    class="recent-stats">
                                                    <i
                                                        class="fa fa-circle text-success me-1"></i>Successful
                                                </td>
                                                <td>
                                                    <a
                                                        href="javascript:void(0);"
                                                        class="btn btn-primary shadow btn-xs sharp rounded-circle me-1"><i
                                                            class="fa fa-pencil"></i></a>
                                                    <a
                                                        href="javascript:void(0);"
                                                        class="btn btn-danger shadow btn-xs sharp rounded-circle"><i
                                                            class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div
                                                        class="form-check">
                                                        <input
                                                            class="form-check-input"
                                                            type="checkbox"
                                                            value=""
                                                            id="flexCheckDefault-2" />
                                                        <label
                                                            class="form-check-label"
                                                            for="flexCheckDefault-2">
                                                        </label>
                                                    </div>
                                                </td>
                                                <td><b>2</b></td>
                                                <td>
                                                    Quick and Easy Fix
                                                    For Your Fitness.
                                                </td>
                                                <td>01 August 2023</td>
                                                <td
                                                    class="recent-stats">
                                                    <i
                                                        class="fa fa-circle text-danger me-1"></i>Canceled
                                                </td>
                                                <td>
                                                    <a
                                                        href="javascript:void(0);"
                                                        class="btn btn-primary shadow btn-xs sharp rounded-circle me-1"><i
                                                            class="fa fa-pencil"></i></a>
                                                    <a
                                                        href="javascript:void(0);"
                                                        class="btn btn-danger shadow btn-xs sharp rounded-circle"><i
                                                            class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div
                                                        class="form-check">
                                                        <input
                                                            class="form-check-input"
                                                            type="checkbox"
                                                            value=""
                                                            id="flexCheckDefault-3" />
                                                        <label
                                                            class="form-check-label"
                                                            for="flexCheckDefault-3">
                                                        </label>
                                                    </div>
                                                </td>
                                                <td><b>3</b></td>
                                                <td>
                                                    Things That Make You
                                                    Love Fitness.
                                                </td>
                                                <td>01 August 2023</td>
                                                <td
                                                    class="recent-stats">
                                                    <i
                                                        class="fa fa-circle text-warning me-1"></i>Pending
                                                </td>
                                                <td>
                                                    <a
                                                        href="javascript:void(0);"
                                                        class="btn btn-primary shadow btn-xs sharp rounded-circle me-1"><i
                                                            class="fa fa-pencil"></i></a>
                                                    <a
                                                        href="javascript:void(0);"
                                                        class="btn btn-danger shadow btn-xs sharp rounded-circle"><i
                                                            class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div
                                                        class="form-check">
                                                        <input
                                                            class="form-check-input"
                                                            type="checkbox"
                                                            value=""
                                                            id="flexCheckDefault-4" />
                                                        <label
                                                            class="form-check-label"
                                                            for="flexCheckDefault-4">
                                                        </label>
                                                    </div>
                                                </td>
                                                <td><b>4</b></td>
                                                <td>
                                                    How to keep your
                                                    Body.
                                                </td>
                                                <td>01 August 2023</td>
                                                <td
                                                    class="recent-stats">
                                                    <i
                                                        class="fa fa-circle text-warning me-1"></i>pending
                                                </td>
                                                <td>
                                                    <a
                                                        href="javascript:void(0);"
                                                        class="btn btn-primary shadow btn-xs sharp rounded-circle me-1"><i
                                                            class="fa fa-pencil"></i></a>
                                                    <a
                                                        href="javascript:void(0);"
                                                        class="btn btn-danger shadow btn-xs sharp rounded-circle"><i
                                                            class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div
                                                        class="form-check">
                                                        <input
                                                            class="form-check-input"
                                                            type="checkbox"
                                                            value=""
                                                            id="flexCheckDefault-5" />
                                                        <label
                                                            class="form-check-label"
                                                            for="flexCheckDefault-5">
                                                        </label>
                                                    </div>
                                                </td>
                                                <td><b>5</b></td>
                                                <td>Relax Your Body</td>
                                                <td>01 August 2023</td>
                                                <td
                                                    class="recent-stats">
                                                    <i
                                                        class="fa fa-circle text-danger me-1"></i>Canceled
                                                </td>
                                                <td>
                                                    <a
                                                        href="javascript:void(0);"
                                                        class="btn btn-primary shadow btn-xs sharp rounded-circle me-1"><i
                                                            class="fa fa-pencil"></i></a>
                                                    <a
                                                        href="javascript:void(0);"
                                                        class="btn btn-danger shadow btn-xs sharp rounded-circle"><i
                                                            class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div
                                                        class="form-check">
                                                        <input
                                                            class="form-check-input"
                                                            type="checkbox"
                                                            value=""
                                                            id="flexCheckDefault-6" />
                                                        <label
                                                            class="form-check-label"
                                                            for="flexCheckDefault-6">
                                                        </label>
                                                    </div>
                                                </td>
                                                <td><b>6</b></td>
                                                <td>
                                                    Origins Of
                                                    Meditation
                                                </td>
                                                <td>01 June 2023</td>
                                                <td
                                                    class="recent-stats">
                                                    <i
                                                        class="fa fa-circle text-success me-1"></i>Successful
                                                </td>
                                                <td>
                                                    <a
                                                        href="javascript:void(0);"
                                                        class="btn btn-primary shadow btn-xs sharp rounded-circle me-1"><i
                                                            class="fa fa-pencil"></i></a>
                                                    <a
                                                        href="javascript:void(0);"
                                                        class="btn btn-danger shadow btn-xs sharp rounded-circle"><i
                                                            class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div
                                                        class="form-check">
                                                        <input
                                                            class="form-check-input"
                                                            type="checkbox"
                                                            value=""
                                                            id="flexCheckDefault-7" />
                                                        <label
                                                            class="form-check-label"
                                                            for="flexCheckDefault-7">
                                                        </label>
                                                    </div>
                                                </td>
                                                <td><b>7</b></td>
                                                <td>
                                                    Meditation Workshop
                                                </td>
                                                <td>01 May 2023</td>
                                                <td
                                                    class="recent-stats">
                                                    <i
                                                        class="fa fa-circle text-success me-1"></i>Successful
                                                </td>
                                                <td>
                                                    <a
                                                        href="javascript:void(0);"
                                                        class="btn btn-primary shadow btn-xs sharp rounded-circle me-1"><i
                                                            class="fa fa-pencil"></i></a>
                                                    <a
                                                        href="javascript:void(0);"
                                                        class="btn btn-danger shadow btn-xs sharp rounded-circle"><i
                                                            class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div
                                    class="d-flex align-items-center justify-content-xl-between flex-wrap justify-content-center mt-3">
                                    <small>Page 1 of 5, showing 2 records
                                        out of 8 total, starting on
                                        record 1, ending on 2</small>
                                    <nav
                                        aria-label="Page navigation example">
                                        <ul
                                            class="pagination mb-2 mb-sm-0">
                                            <li class="page-item">
                                                <a
                                                    class="page-link"
                                                    href="javascript:void(0);"><i
                                                        class="fa-solid fa-angle-left"></i></a>
                                            </li>
                                            <li class="page-item">
                                                <a
                                                    class="page-link"
                                                    href="javascript:void(0);">1</a>
                                            </li>
                                            <li class="page-item">
                                                <a
                                                    class="page-link"
                                                    href="javascript:void(0);">2</a>
                                            </li>
                                            <li class="page-item">
                                                <a
                                                    class="page-link"
                                                    href="javascript:void(0);">3</a>
                                            </li>
                                            <li class="page-item">
                                                <a
                                                    class="page-link"
                                                    href="javascript:void(0);"><i
                                                        class="fa-solid fa-angle-right"></i></a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>