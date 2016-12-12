@extends("layouts.admin.app")

@section("content")
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">
                    @lang('admin.list', ['name' => 'Category'])
                </h3>
            </div>

            <div class="col-lg-12">
                @include('admin.shared.flash')
            </div>

            @if (count($categories))
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th class="colum" width="10%">@lang('admin.label.index')</th>
                            <th class="colum">@lang('admin.category', ['name' => 'Name'])</th>
                            <th class="colum">@lang('admin.sort')</th>
                            <th class="colum" width="10%">@lang('admin.label.edit')</th>
                            <th class="colum" width="10%">@lang('admin.label.delete')</th>
                            <th class="colum">@lang('admin.sub_category')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $key => $category)
                            <tr class="odd gradeX" align="center">
                                <td>{!! $key + 1 !!}</td>
                                <td><a href="#">{!! $category->name !!}</a></td>
                                <td>{!! $category->sort !!}</td>
                                <td class="center" width="10%">
                                    <i class="fa fa-pencil fa-fw"></i>
                                </td>
                                <td class="center" width="10%">
                                </td>
                                <td width="10%">
                                    <button class="btn btn-primary" data-toggle="modal"
                                        data-target=".bs-example-modal-lg">@lang('admin.sub')
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h4 align="center">@lang('admin.message.empty_data', ['name' => 'Category'])</h4>
            @endif
            <div class='col-lg-7' align='right'>
                {!! $categories->render() !!}
            </div>
        </div>
    </div>
</div>

<div class="modal fade bs-example-modal-lg"
    tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        aaaa
        </div>
    </div>
</div>
@stop
