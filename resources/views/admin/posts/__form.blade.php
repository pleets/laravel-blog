<div class="row">
    <div class="col-sm-9" style="border-right: dashed 1px #d6d6d6">
        <div class="form-row">
            <div class="form-group col-sm-6">
                {{ Form::label('title', __('posts.fields.title')) }}
                {{ Form::text('title', $post->title, [
                    'class' => 'form-control',
                    'placeholder' => strtolower(__('posts.fields.title')),
                    ]) }}
            </div>
            <div class="form-group col-sm-6">
                {{ Form::label('category_id', __('posts.fields.category')) }}
                {{ Form::select('category_id', $categories, $post->category_id, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-sm-6">
                {{ Form::label('tags', __('posts.fields.tags')) }}
                {{ Form::select('tags[]', $tags, $post->tags->pluck('tag_id'), [
                    'class' => 'custom-select',
                    'multiple' => 'multiple',
                    'size' => 3
                    ]) }}
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-sm-12">
                {{ Form::label('content', __('posts.fields.content')) }}
                {{ Form::textarea('content', $post->content, ['class' => 'form-control']) }}
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-row">
            <div class="form-group col-sm-12">
                {{ Form::label('published_at', __('posts.fields.published_at')) }}
                {{ Form::date('published_at', $post->published_at ?? date('Y-m-d'), [
                    'class' => 'form-control'
                    ]) }}
            </div>
            <div class="form-group col-sm-12">
                {{ Form::label('url_path', __('posts.fields.url')) }}
                {{ Form::text('url_path', $post->url_path, [
                    'class' => 'form-control',
                    ]) }}
            </div>
            <div class="form-group col-sm-12">
                {{ Form::label('description', __('posts.fields.description')) }}
                {{ Form::text('description', $post->description, [
                    'class' => 'form-control',
                    'placeholder' => strtolower(__('posts.fields.description')),
                    ]) }}
            </div>
            <div class="form-group col-sm-12">
                {{ Form::label('image', __('posts.fields.image')) }}
                {{ Form::text('image', $post->image, [
                    'class' => 'form-control',
                    ]) }}
            </div>
        </div>
    </div>
</div>
