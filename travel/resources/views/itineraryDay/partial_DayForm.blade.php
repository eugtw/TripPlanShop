
<div class="form-group">
    {!! Form::label('day_num', 'Day # of this itinerary', ['class'=>'col-sm-3 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::number('day_num', null, ['placeholder' => '','class'=>'form-control', 'min'=>'1']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('title', 'Title', ['class'=>'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::text('title', null, ['placeholder' => 'Title','class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('intro', 'Day Intro', ['class'=>'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::textarea('intro',null, ['placeholder' => 'breifly describe what happens in this day',
        'class'=>'form-control editor', 'rows'=>'5']) !!}
    </div>

    <!--
    <script>
        CKEDITOR.replace( 'nono',{

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
    </script> -->
</div>

<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9 top-buffer">
        {!! Form::submit($SubmitButtonText, ['class'=>'btn itit-footer-button btn-primary sr-only']) !!}
    </div>

</div>

<hr class="top-buffer">



