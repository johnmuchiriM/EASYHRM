@extends('admin.layouts.app')
@section('title', __('tasks::lang.task-history'))
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-phone icon-gradient bg-premium-dark">
                    </i>
                </div>
                <div>
                    @include('admin.layouts.breadcumb')
                    <div class="page-title-subheading">{{ __('tasks::lang.here-you-can-see-task-list') }}</div>
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{route('task.mytasks')}}"
                        class="btn create-modal mr-2 mb-2 btn-success btn-shadow"></i>{{ __('tasks::lang.back') }}</a>
                </div>
            </div>
        </div>
    </div>
    @if(count($taskComment)>0)
    @foreach ($taskComment as $comment)
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="row">
                        <form action="{{route('task.mytask.history.update',$comment->id)}}" id="idForm{{$comment->id}}" class="comment-form" method="post">
                            @csrf
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="d-flex">
                                        <div>
                                            <label for="projecttitle">{{ __('tasks::lang.task-comment') }}</label>
                                        </div>
                                        <div class="ml-auto">
                                            {{ __('tasks::lang.created-at') }} : {{formatDate($comment->created_at)}}
                                            <span class="ml-4">{{ __('tasks::lang.updated-at') }} : {{formatDate($comment->updated_at)}}</span>
                                        </div>
                                    </div>
                                    <textarea name="comment" cols="30" rows="5" class="form-control"
                                        id="elm1">{{$comment->comment}}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary mb-2 task-comment">{{ __('tasks::lang.update-task-comment') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @else
    <p>{{ __('tasks::lang.no-comment-yet') }}</p>
    @endif
</div>
@push('scripts')
<script>
    $(function () {
        if ($("#elm2").length > 0) {
            tinymce.init({
                readonly: 1,
                selector: "textarea#elm2",
                content_style: ".mce-content-body {font-size:20px;font-family:Arial,sans-serif;}",
                theme: "modern",
                height: 200,
            });
        }
    });

    $(document).on('click','.comment-form', function(){
        var formId = $(this).attr('id');
        $("#"+formId).submit(function (e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            let data = $("#" + formId).serialize(); // get all form information
            let url = $("#" + formId).attr('action'); // get form url
            axios({
                    method: 'POST',
                    url: url,
                    params: {
                        data: data
                    },
                })
                .then((res) => {
                    swal("{{ __('tasks::lang.comment-updated') }}", {
                                icon: "success",
                            });
                })
                .catch((err) => {
                    throw err
            });
        });
    });
    

</script>
@endpush
@endsection
