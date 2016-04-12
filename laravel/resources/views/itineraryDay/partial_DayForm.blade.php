<!--
<div class="form-group">
    {!! Form::label('title', 'Title', ['class'=>'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::text('title', null, ['placeholder' => 'Title','class'=>'form-control']) !!}
    </div>
</div> -->

<div class="form-group">
    {!! Form::label('image', 'Cover Image: ', ['class'=>'col-sm-3 control-label']) !!}
    <div class="col-sm-5">
        {!! Form::text('image', null, ['placeholder'=>'use default image if left empty','class'=>'form-control']) !!}
    </div>
    <div class="col-sm-3">
        <button class="btn btn-info popup_selector" data-inputid="image" type="button">Browse Images</button>
    </div>
</div>

<div class="form-group">
    {!! Form::label('day_of_itinerary', 'Day # of this itinerary', ['class'=>'col-sm-3 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::number('day_of_itinerary', null, ['placeholder' => '','class'=>'form-control', 'min'=>'1']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('intro', 'Day Intro', ['class'=>'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::textarea('intro',null, ['placeholder' => 'breifly describe what happens in this day',
        'class'=>'form-control', 'rows'=>'5']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('budget', 'Budget/person', ['class'=>'col-sm-3 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('budget', null, ['placeholder' => '(optional) how much to bring?','class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('day_cities', 'Cities to Visit (A,B,C)', ['class'=>'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::text('day_cities',null, ['placeholder' => 'Vancouver, Richmond...etc','class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('places', 'Places to Visit (A,B,C)', ['class'=>'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::textarea('places',null, ['placeholder' => 'Effiel Tower, City Hall, GoodFaith...etc','class'=>'form-control', 'rows'=>'3']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('experience', 'Experiences in this day', ['class'=>'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::select('experience[]',$exp ,null , ['id'=>'experience-select2','multiple'=>'multiple','placeholder' => 'experience','class'=>'form-control']) !!}
    </div>
</div>
<script>
    $('#experience-select2').select2({
        maximumSelectionLength: '{{ env('MAX_DAY_EXP') }}'
    });
</script>

<hr class="top-buffer">

<div class="form-group">
    {!! Form::label('summary', 'Day Details', ['class'=>'col-sm-3 control-label day_details_title']) !!}
    <div class="col-sm-12 top-buffer">
        {!! Form::textarea('summary', null, ['placeholder' => 'type your Day summary here','class'=>'form-control', 'id'=>'summary']) !!} </div>


    <script>
       CKEDITOR.replace( 'summary',{

            extraAllowedContent : 'iframe[*]',
            filebrowserBrowseUrl: '/elfinder/ckeditor',
            uiColor : '#9AB8F3',
            height: '35em',
            width: '100%'
        });

        CKEDITOR.on('dialogDefinition', function(ev) {
            var editor = ev.editor;
            var dialogName = ev.data.name;
            var dialogDefinition = ev.data.definition;

            if (dialogName == 'image2') {
                var infoTab = dialogDefinition.getContents( 'info' );
                infoTab.remove( 'align' ); //Remove Element Border From Tab Info
                //infoTab.remove( 'hSpace' ); //Remove Element Horizontal Space From Tab Info
                //infoTab.remove( 'txtVSpace' ); //Remove Element Vertical Space From Tab Info
               // infoTab.remove( 'width' ); //Remove Element Width From Tab Info
                //infoTab.remove( 'height' ); //Remove Element Height From Tab Info

                //Remove tab Link
                //dialogDefinition.removeContents( 'Link' );
            }
        });
    </script>
</div>
<div class="form-group">
    <div class="col-sm-offset-3 col-sm-5 top-buffer">
        {!! Form::submit($SubmitButtonText, ['class'=>'itit-btn itit-footer-button btn-primary']) !!}
    </div>
</div>

<!--
<div id="editor1">
    your content here
</div>
<script type="text/javascript">
    editor = new Dante.Editor(
            {
                el: "#editor1",
                upload_url: "{{ route('itinerary-day.danteImageUpload', $day) }}", //it expect an url string in response like /your/server/image.jpg or http://app.com/images/image.jpg
                store_url: "" //post to save

            }
    );
    editor.start()
</script> -->