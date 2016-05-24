@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">Edit Profile</h2>
                {!! Form::open(['route'=>['user.update',Auth::user()],  'method'=>'PATCH','class'=>'form-horizontal','files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('avatar', 'Your Avatar: ', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-2 col-xs-4">
                        <img class="img-circle img-responsive"
                             src="{{ ($user->profile->avatar == null  ? env('USER_AVATAR_PATH') . 'default_user.jpg' : $user->profile->avatar) }}">
                    </div>
                    <div class="col-sm-3">
                        {!! Form::file('avatar', null, ['placeholder'=>'image of you','class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div>
                        {!! Form::label('blog_link', 'Personal Blog Link:', ['class'=>'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-addon">Http://</div>
                                {!! Form::text('blog_link', isset($user->profile->blog_link) ? $user->profile->blog_link : '', ['placeholder'=>'blog address','class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                @if(Auth::check() && Auth::user()->stripe_active)
                <div class="form-group">
                    <div>
                        {!! Form::label('contact_email', 'Contact Email:', ['class'=>'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            {!! Form::email('contact_email', isset($user->profile->contact_email) ? $user->profile->contact_email : '', ['placeholder'=>'contact email address','class'=>'form-control', 'required']) !!}
                        </div>
                    </div>
                </div>
                @endif
                <div class="form-group">
                    <div>
                        {!! Form::label('about_yourself', 'Somthing About You:', ['class'=>'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            {!! Form::textarea('about_yourself', isset($user->profile->about_yourself) ? $user->profile->about_yourself : '',
                            ['placeholder'=>'Something about you','class'=>'form-control', 'rows'=>'5', 'required']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div>
                        {!! Form::label('travel_style', 'Travel Style:', ['class'=>'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            {!! Form::textarea('travel_style', isset($user->profile->travel_style) ? $user->profile->travel_style : '',
                            ['placeholder'=>'Your Travel Style','class'=>'form-control', 'rows'=>'5', 'required']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        {!! Form::submit('Save Changes', ['class'=>'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop